<?php

declare(strict_types=1);
/**
 * /src/Rest/MessageHandler/PushMessageHandler.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Rest\MessageHandler;

use JMS\Serializer\SerializerInterface;
use Psr\Log\LoggerInterface;
use SuppCore\AdministrativoBackend\Repository\UsuarioRepository;
use SuppCore\AdministrativoBackend\Rest\Message\PushMessage;
use SuppCore\AdministrativoBackend\Rest\RestResource;
use SuppCore\AdministrativoBackend\Security\InternalLogInService;
use SuppCore\AdministrativoBackend\Security\RolesService;
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

    /**
     * PushMessageHandler constructor.
     */
    public function __construct(
        private HubInterface $hub,
        private ContainerInterface $container,
        private SerializerInterface $serializer,
        private LoggerInterface $logger,
        private UsuarioRepository $usuarioRepository,
        private InternalLogInService $internalLogInService
    ) {
    }

    /**
     * @param PushMessage $message
     */
    public function __invoke(PushMessage $message)
    {
        try {
            $usuario = $this->usuarioRepository->findOneBy(['username' => $message->getChannel()]);

            if ($usuario) {
                $this->internalLogInService->logUserIn($usuario);
            }

            /** @var RestResource $resource */
            $resource = $this->container->get($message->getResource());

            $entity = $resource->findOneBy(['uuid' => $message->getUuid()]);

            if ($entity) {
                $dtoMapper = $resource->getDtoMapperManager()->getMapper(
                    $resource->getDtoClass()
                );

                $dto = $dtoMapper->convertEntityToDto(
                    $entity,
                    $resource->getDtoClass(),
                    $message->getPopulate(),
                );

                $serializedDto = json_decode(
                    $this->serializer->serialize(
                        $dto,
                        'json'
                    ),
                    true
                );

                if ($message->getParentType()) {
                    $serializedDto['@parentType'] = $message->getParentType();
                }

                if ($message->getParentId()) {
                    $serializedDto['@parentId'] = $message->getParentId();
                }

                $update = new Update(
                    $message->getChannel(),
                    json_encode(
                        [$message->getOperation() => $serializedDto]
                    )
                );

                $this->hub->publish($update);
            }
        } catch (Throwable $t) {
            $this->logger->critical($t->getMessage().' - '.$t->getTraceAsString());
        }
    }
}
