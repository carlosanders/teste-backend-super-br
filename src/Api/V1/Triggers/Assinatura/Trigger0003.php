<?php

declare(strict_types=1);
/**
 * /src/Api/V1/Triggers/Assinatura/Trigger0003.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Triggers\Assinatura;

use Exception;
use RuntimeException;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Assinatura;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\EARQ\EARQEventoPreservacaoLoggerInterface;
use SuppCore\AdministrativoBackend\Entity\Assinatura as AssinaturaEntity;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\Usuario;
use SuppCore\AdministrativoBackend\Security\LdapService;
use SuppCore\AdministrativoBackend\Transaction\TransactionManager;
use SuppCore\AdministrativoBackend\Triggers\TriggerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Process\Process;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Throwable;

/**
 * Class Trigger0003.
 *
 * @descSwagger=Seta manualmente o criadoPor, exceto no contexto de clone!
 * @classeSwagger=Trigger0003
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Trigger0003 implements TriggerInterface
{
    /**
     * Trigger0003 constructor.
     */
    public function __construct(
        private TokenStorageInterface $tokenStorage,
        private TransactionManager $transactionManager
    ) {
    }

    public function supports(): array
    {
        return [
            Assinatura::class => [
                'afterCreate',
                'skipWhenCommand',
            ],
        ];
    }

    /**
     * @param Assinatura|RestDtoInterface|null $restDto
     * @param AssinaturaEntity|EntityInterface $entity
     *
     * @throws Exception
     */
    public function execute(?RestDtoInterface $restDto, EntityInterface $entity, string $transactionId): void
    {
        if (!$this->transactionManager->getContext('clonarAssinatura', $transactionId) &&
            $this->tokenStorage->getToken() &&
            $this->tokenStorage->getToken()->getUser()) {
            /** @var Usuario $usuario */
            $usuario = $this->tokenStorage->getToken()->getUser();
            $entity->setCriadoPor(
                $usuario
            );
        }

        if ($this->transactionManager->getContext('clonarAssinatura', $transactionId)) {
            $entity->setCriadoPor(
                $restDto->getCriadoPor()
            );
        }
    }

    public function getOrder(): int
    {
        return 1;
    }
}
