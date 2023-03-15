<?php

declare(strict_types=1);
/**
 * /src/Api/V1/Triggers/Tarefa/Trigger0005.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Triggers\Tarefa;

use Exception;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Tarefa;
use SuppCore\AdministrativoBackend\Api\V1\Triggers\Favorito\Message\FavoritoMessage;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\Tarefa as TarefaEntity;
use SuppCore\AdministrativoBackend\Transaction\TransactionManager;
use SuppCore\AdministrativoBackend\Triggers\TriggerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class Trigger0005.
 *
 * @descSwagger=Seta os favoritos da tarefa criada!
 * @classeSwagger=Trigger0005
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Trigger0005 implements TriggerInterface
{
    private TokenStorageInterface $tokenStorage;

    private TransactionManager $transactionManager;

    /**
     * Trigger0005 constructor.
     */
    public function __construct(
        TokenStorageInterface $tokenStorage,
        TransactionManager $transactionManager
    ) {
        $this->tokenStorage = $tokenStorage;
        $this->transactionManager = $transactionManager;
    }

    public function supports(): array
    {
        return [
            Tarefa::class => [
                'afterCreate',
                'skipWhenCommand',
            ],
        ];
    }

    /**
     * @param Tarefa|RestDtoInterface|null $restDto
     * @param TarefaEntity|EntityInterface $entity
     *
     * @throws Exception
     */
    public function execute(?RestDtoInterface $restDto, EntityInterface $entity, string $transactionId): void
    {
        $blocoFavoritos = [];

        $blocoFavoritos[] = [
            'usuario' => $this->tokenStorage->getToken()->getUser()->getId(),
            'objectClass' => str_replace('Proxies\\__CG__\\', '', get_class($restDto->getEspecieTarefa())),
            'objectId' => $restDto->getEspecieTarefa()->getId(),
            'context' => 'tarefa_'.
                $restDto->getProcesso()->getEspecieProcesso()->getId().
                '_especie_tarefa',
        ];

        $blocoFavoritos[] = [
            'usuario' => $this->tokenStorage->getToken()->getUser()->getId(),
            'objectId' => $restDto->getSetorResponsavel()->getUnidade()->getId(),
            'objectClass' => str_replace('Proxies\\__CG__\\', '', get_class($restDto->getSetorResponsavel()->getUnidade())),
            'context' => 'tarefa_'.
                $restDto->getProcesso()->getEspecieProcesso()->getId().
                '_unidade_responsavel',
        ];

        $blocoFavoritos[] = [
            'usuario' => $this->tokenStorage->getToken()->getUser()->getId(),
            'objectId' => $restDto->getSetorResponsavel()->getId(),
            'objectClass' => str_replace('Proxies\\__CG__\\', '', get_class($restDto->getSetorResponsavel())),
            'context' => 'tarefa_'.
                $restDto->getProcesso()->getEspecieProcesso()->getId().
                '_setor_responsavel_unidade_'.$restDto->getSetorResponsavel()->getUnidade()->getId(),
        ];

        $blocoFavoritos[] = [
            'usuario' => $this->tokenStorage->getToken()->getUser()->getId(),
            'objectId' => $restDto->getUsuarioResponsavel()->getId(),
            'objectClass' => str_replace('Proxies\\__CG__\\', '', get_class($restDto->getUsuarioResponsavel())),
            'context' => 'tarefa_'.
                $restDto->getProcesso()->getEspecieProcesso()->getId().
                '_usuario_responsavel_setor_'.$restDto->getSetorResponsavel()->getId(),
        ];

        $this->transactionManager
            ->addAsyncDispatch(new FavoritoMessage(json_encode($blocoFavoritos)), $transactionId);
    }

    public function getOrder(): int
    {
        return 1;
    }
}
