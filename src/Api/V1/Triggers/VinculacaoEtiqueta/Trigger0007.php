<?php

declare(strict_types=1);
/**
 * /src/Api/V1/Triggers/VinculacaoEtiqueta/Trigger0007.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Triggers\VinculacaoEtiqueta;

use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\Exception\ORMException;
use Psr\Log\LoggerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use SuppCore\AdministrativoBackend\Api\V1\DTO\VinculacaoEtiqueta as VinculacaoEtiquetaDTO;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Triggers\TriggerInterface;

/**
 * Class Trigger0007.
 *
 * @descSwagger=Toda vinculação realizada por um usuário que não é o dono da etiqueta, marca a vinculação como sugerida.
 * @classeSwagger=Trigger0007
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Trigger0007 implements TriggerInterface
{
    /**
     * Trigger0007 constructor.
     */
    public function __construct(private TokenStorageInterface $tokenStorage) {
    }

    public function supports(): array
    {
        return [
            VinculacaoEtiquetaDTO::class => [
                'beforeCreate'
            ],
        ];
    }

    /**
     * @param RestDtoInterface|null $vinculacaoEtiquetaDTO
     * @param EntityInterface $vinculacaoEtiquetaEntity
     * @param string $transactionId
     * @return void
     * @throws NonUniqueResultException
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function execute(
        ?RestDtoInterface $vinculacaoEtiquetaDTO,
        EntityInterface $vinculacaoEtiquetaEntity,
        string $transactionId
    ): void {
        $usuarioSessao = $this->tokenStorage->getToken()?->getUser()?->getId();
        $vinculacaoEtiquetaDTO->setSugestao(
            !$vinculacaoEtiquetaDTO->getEtiqueta()->getSistema()
            && (!$usuarioSessao || $usuarioSessao !== $vinculacaoEtiquetaDTO->getEtiqueta()?->getCriadoPor()?->getId())
        );
    }

    public function getOrder(): int
    {
        return 1;
    }
}
