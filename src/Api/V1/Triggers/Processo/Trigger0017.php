<?php

declare(strict_types=1);

namespace SuppCore\AdministrativoBackend\Api\V1\Triggers\Processo;

use DateInterval;
use DateTime;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\Exception\ORMException;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Processo as ProcessoDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Tarefa as TarefaDTO;
use SuppCore\AdministrativoBackend\Api\V1\Resource\SetorResource;
use SuppCore\AdministrativoBackend\Api\V1\Resource\TarefaResource;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\Processo as ProcessoEntity;
use SuppCore\AdministrativoBackend\Entity\Workflow;
use SuppCore\AdministrativoBackend\Triggers\TriggerInterface;

/**
 * Class Trigger0017.
 *
 * @descSwagger=Caso a especie de processo seja um workflow, criar a primeira tarefa do ciclo automaticamente.
 * @classeSwagger=Trigger0017
 *
 * @author  Felipe Pena <felipe.pena@datainfo.inf.br>
 */
class Trigger0017 implements TriggerInterface
{

    public function supports(): array
    {
        return [
            ProcessoDTO::class => [
                'afterCreate',
            ],
        ];
    }

    /**
     * Trigger0017 constructor.
     */
    public function __construct(
        private readonly TarefaResource $tarefaResource,
        private readonly SetorResource $setorResource,
    ) {
    }


    /**
     * @param ProcessoDTO|RestDtoInterface|null $restDto
     * @param ProcessoEntity|EntityInterface $entity
     * @param string $transactionId
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function execute(
        ProcessoDTO|RestDtoInterface|null $restDto,
        ProcessoEntity|EntityInterface $entity,
        string $transactionId
    ): void {
        /** @var Workflow $workflow */
        $workflow = $restDto
            ->getDocumentoAvulsoOrigem()
            ?->getEspecieDocumentoAvulso()
            ?->getWorkflow();

        if ($workflow) {
            $inicioPrazo = new DateTime();
            $finalPrazo = new DateTime();
            $finalPrazo->add(new DateInterval('P5D'));

            $tarefaDTO = new TarefaDTO();
            $tarefaDTO->setEspecieTarefa($workflow->getEspecieTarefaInicial());
            $tarefaDTO->setProcesso($entity);
            $tarefaDTO->setSetorOrigem($entity->getSetorAtual());
            $tarefaDTO->setDataHoraInicioPrazo($inicioPrazo);
            $tarefaDTO->setDataHoraFinalPrazo($finalPrazo);
            $tarefaDTO->setWorkflow($workflow);

            $protocolo = $this
                ->setorResource
                ->getRepository()
                ->findProtocoloInUnidade($restDto->getSetorAtual()->getUnidade()->getId());

            $tarefaDTO->setSetorOrigem($restDto->getDocumentoAvulsoOrigem()->getSetorResponsavel());
            $tarefaDTO->setSetorResponsavel($protocolo);
            $tarefaDTO->setUsuarioResponsavel(null);
            $tarefaDTO->setDistribuicaoAutomatica(true);
            $this->tarefaResource->create($tarefaDTO, $transactionId);
        }
    }

    public function getOrder(): int
    {
        return 1;
    }
}
