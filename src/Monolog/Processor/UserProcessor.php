<?php

declare(strict_types=1);
/**
 * /src/Rest/Controller.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Monolog\Processor;

use SuppCore\AdministrativoBackend\Entity\Usuario;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class UserProcessor.
 */
class UserProcessor
{
    private TokenStorageInterface $tokenStorage;

    /**
     * @var Usuario
     */
    private $user;

    /**
     * UserProcessor constructor.
     *
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @param array $record
     *
     * @return array
     */
    public function __invoke(array $record)
    {
        if (null !== $this->user) {
            $record['extra']['user']['username'] = $this->user->getUsername();
            $record['extra']['user']['nome'] = $this->user->getNome();
        } else {
            $record['extra']['user']['username'] = 'anonymous';
            $record['extra']['user']['nome'] = 'anonymous';
        }

        return $record;
    }

    /**
     * @param RequestEvent $event
     */
    public function onKernelRequest(RequestEvent $event)
    {
        if (null === $token = $this->tokenStorage->getToken()) {
            return;
        }

        if (!is_object($user = $token->getUser())) {
            // e.g. anonymous authentication
            return;
        }

        $this->user = $user;
    }
}
