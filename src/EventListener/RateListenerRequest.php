<?php

declare(strict_types=1);

namespace SuppCore\AdministrativoBackend\EventListener;

use Redis;
use SuppCore\AdministrativoBackend\Entity\Usuario;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\RateLimiter\RateLimiterFactory;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class RateListenerRequest.
 */
class RateListenerRequest implements EventSubscriberInterface
{
    /**
     * @param RateLimiterFactory    $perUserLimiter
     * @param RateLimiterFactory    $perResourceLimiter
     * @param RateLimiterFactory    $perApiLimiter
     * @param TokenStorageInterface $tokenStorage
     * @param Redis                 $redisClient
     */
    public function __construct(
        private RateLimiterFactory $perUserLimiter,
        private RateLimiterFactory $perResourceLimiter,
        private RateLimiterFactory $perApiLimiter,
        private TokenStorageInterface $tokenStorage,
        private Redis $redisClient
    ) {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            RequestEvent::class => 'onKernelRequest',
        ];
    }

    /**
     * @param RequestEvent $event
     */
    public function onKernelRequest(
        RequestEvent $event
    ) {
        if ($this->redisClient->get('maintenance')) {
            $message = <<<MSG
            Sistema em manutenção!
            MSG;
            throw new BadRequestHttpException($message, null, 403);
        }

        if (!$this->tokenStorage->getToken() ||
            !$this->tokenStorage->getToken()->getUser() ||
            (false === ($this->tokenStorage->getToken()->getUser() instanceof Usuario))) {
            return;
        }

        if (!$event->isMainRequest()) {
            return;
        }

        $request = $event->getRequest();

        // per resource
        $resource = $event->getRequest()->attributes->get('_controller');
        $resourceLimiter = $this->perResourceLimiter->create(
            $this->tokenStorage->getToken()->getUser()->getUserIdentifier().'_'.$resource
        );
        $resourceLimit = $resourceLimiter->consume();

        if (false === $resourceLimit->isAccepted()) {
            $message = <<<MSG
            Recurso bloqueado por 2 minutos por consumo excessivo!
            MSG;
            // throw new BadRequestHttpException($message, null, 403);
        }

        $isAPI = $request->headers->get('X-RateLimit-API', null);

        if (!$isAPI) {
            // per user
            $userLimiter = $this->perUserLimiter->create($this->tokenStorage->getToken()->getUser()->getUserIdentifier());
            $userLimit = $userLimiter->consume();

            if (false === $userLimit->isAccepted()) {
                $message = <<<MSG
            Usuário bloqueado por 15 minutos por consumo excessivo!
            MSG;
                throw new BadRequestHttpException($message, null, 403);
            }
        } else {
            // per api
            $apiLimiter = $this->perApiLimiter->create($this->tokenStorage->getToken()->getUser()->getUserIdentifier());
            $apiLimit = $apiLimiter->consume();

            $headers = [
                'X-RateLimit-Remaining' => $apiLimit->getRemainingTokens(),
                'X-RateLimit-Retry-After' => $apiLimit->getRetryAfter()->getTimestamp(),
                'X-RateLimit-Limit' => $apiLimit->getLimit(),
            ];

            $request->request->add($headers);

            if (false === $apiLimit->isAccepted()) {
                $message = <<<MSG
            API bloqueada por 15 minutos por consumo excessivo!
            MSG;
                throw new BadRequestHttpException($message, null, 403);
            }
        }
    }
}
