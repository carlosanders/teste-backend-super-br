<?php

declare(strict_types=1);
/**
 * /src/Api/V1/Triggers/Tarefa/Trigger0001.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Triggers\Tarefa;

use Exception;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Tarefa;
use SuppCore\AdministrativoBackend\Api\V1\Resource\TarefaResource;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\Tarefa as TarefaEntity;
use SuppCore\AdministrativoBackend\Triggers\TriggerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class Trigger0001.
 *
 * @descSwagger=Distribuição automática caso não seja informado um usuário responsável!
 * @classeSwagger=Trigger0001
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Trigger0001 implements TriggerInterface
{
    /**
     * Trigger0001 constructor.
     *
     * @param TokenStorageInterface $tokenStorage
     * @param TarefaResource        $tarefaResource
     */
    public function __construct(
        private TokenStorageInterface $tokenStorage,
        private TarefaResource $tarefaResource
    ) {
    }

    public function supports(): array
    {
        return [
            Tarefa::class => [
                'beforeCreate',
                'beforeUpdate',
                'beforePatch',
            ],
        ];
    }

    /**
     * @param Tarefa|RestDtoInterface|null $tarefaDto
     * @param TarefaEntity|EntityInterface $tarefaEntity
     *
     * @throws Exception
     */
    public function execute(
        Tarefa | RestDtoInterface | null $tarefaDto,
        TarefaEntity | EntityInterface $tarefaEntity,
        string $transactionId
    ): void {
        if ($tarefaDto &&
            !$tarefaDto->getDataHoraConclusaoPrazo() &&
            !$tarefaDto->getUsuarioResponsavel()) {
            $usuarios = $this->tarefaResource->retornaUsuariosRegraDistribuicao(
                $tarefaDto,
                $this->tarefaResource->retornaRegraDistribuicao($tarefaDto, $tarefaEntity)
            );

            $tarefaDto->setDistribuicaoAutomatica(true);

            $this->tarefaResource->trataDistribuicao($tarefaDto, $usuarios);
        }
    }

    public function getOrder(): int
    {
        return 2;
    }
}
