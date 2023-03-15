<?php

declare(strict_types=1);
/**
 * /src/Counter/MessageHandler/PushMessageHandler.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Counter\MessageHandler;

use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use SuppCore\AdministrativoBackend\Counter\Message\PushMessage;
use SuppCore\AdministrativoBackend\Rest\RestResource;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Throwable;

/**
 * Class NotificacaoMessageHandler.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
#[AsMessageHandler]
class PushMessageHandler
{
    private HubInterface $hub;
    private ContainerInterface $container;
    private EntityManagerInterface $entityManager;
    private LoggerInterface $logger;

    /**
     * PushMessageHandler constructor.
     *
     * @param HubInterface           $hub
     * @param ContainerInterface     $container
     * @param EntityManagerInterface $entityManager
     * @param LoggerInterface        $logger
     */
    public function __construct(
        HubInterface $hub,
        ContainerInterface $container,
        EntityManagerInterface $entityManager,
        LoggerInterface $logger
    ) {
        $this->hub = $hub;
        $this->container = $container;
        $this->entityManager = $entityManager;
        $this->logger = $logger;
    }

    /**
     * @param PushMessage $message
     */
    public function __invoke(PushMessage $message)
    {
        try {
            /** @var RestResource $resource */
            $resource = $this->container->get($message->getResource());

            if ($message->getDesabilitaSoftDeleteable()) {
                if (array_key_exists('softdeleteable', $this->entityManager->getFilters()->getEnabledFilters())) {
                    $this->entityManager->getFilters()->disable('softdeleteable');
                }
            }

            if (!$message->getUseSelectForCount()) {
                $count = $resource->count(
                    $message->getCriteria()
                );
            } else {
                try {
                    $count = $resource->find($message->getCriteria())['total'];
                } catch (Throwable $e) {
                    $count = 0;
                }
            }

            if ($message->getDesabilitaSoftDeleteable()) {
                if (!array_key_exists('softdeleteable', $this->entityManager->getFilters()->getEnabledFilters())) {
                    $this->entityManager->getFilters()->enable('softdeleteable');
                }
            }

            $update = new Update(
                $message->getChannel(),
                json_encode(
                    [
                        'counter' => [
                            'identifier' => $message->getIdentifier(),
                            'count' => $count,
                        ],
                    ]
                )
            );

            $this->hub->publish($update);
        } catch (Throwable $t) {
            $this->logger->critical($t->getMessage().' - '.$t->getTraceAsString());
        }
    }
}
