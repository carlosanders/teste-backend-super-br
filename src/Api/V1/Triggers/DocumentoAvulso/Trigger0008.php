<?php

declare(strict_types=1);
/**
 * /src/Api/V1/Triggers/DocumentoAvulso/Trigger0008.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Triggers\DocumentoAvulso;

use DateInterval;
use DateTime;
use Exception;
use SuppCore\AdministrativoBackend\Api\V1\DTO\DocumentoAvulso;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Tarefa;
use SuppCore\AdministrativoBackend\Api\V1\Resource\EspecieTarefaResource;
use SuppCore\AdministrativoBackend\Api\V1\Resource\TarefaResource;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\DocumentoAvulso as DocumentoAvulsoEntity;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Repository\SetorRepository;
use SuppCore\AdministrativoBackend\Transaction\Context;
use SuppCore\AdministrativoBackend\Transaction\TransactionManager;
use SuppCore\AdministrativoBackend\Triggers\TriggerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Throwable;

/**
 * Class Trigger0008.
 *
 * @descSwagger=Se o documento avulso não estiver encerrado mas com a tarefa encerrada, abre uma nova tarefa, Se o usuário responsável estiver afastado, abre no protocolo!
 * @classeSwagger=Trigger0008
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Trigger0008 implements TriggerInterface
{
    private SetorRepository $setorRepository;
    private TarefaResource $tarefaResource;
    private EspecieTarefaResource $especieTarefaResource;

    /**
     * Trigger0008 constructor.
     */
    public function __construct(
        SetorRepository $setorRepository,
        TarefaResource $tarefaResource,
        EspecieTarefaResource $especieTarefaResource,
        private ParameterBagInterface $parameterBag,
        private TransactionManager $transactionManager
    ) {
        $this->setorRepository = $setorRepository;
        $this->tarefaResource = $tarefaResource;
        $this->especieTarefaResource = $especieTarefaResource;
    }

    public function supports(): array
    {
        return [
            DocumentoAvulso::class => [
                'beforeResponder',
            ],
        ];
    }

    /**
     * @param DocumentoAvulso|RestDtoInterface|null $restDto
     * @param DocumentoAvulsoEntity|EntityInterface $entity
     *
     * @throws Exception
     */
    public function execute(?RestDtoInterface $restDto, EntityInterface $entity, string $transactionId): void
    {
        if (!$entity->getDataHoraResposta() &&
            (!$entity->getTarefaOrigem() || $entity->getTarefaOrigem()->getDataHoraConclusaoPrazo())) {
            $setorResponsavel = $restDto->getSetorResponsavel();
            $usuarioResponsavel = $restDto->getUsuarioResponsavel();

            $inicioPrazo = new DateTime();
            $finalPrazo = new DateTime();
            $finalPrazo->add(new DateInterval('P5D'));
            $especieTarefa = $this->especieTarefaResource->findOneBy(
                [
                    'nome' => $this->parameterBag->get('constantes.entidades.especie_tarefa.const_2'),
                ]
            );

            $this->transactionManager->addContext(
                new Context(
                    'respostaDocumentoAvulso',
                    true
                ),
                $transactionId
            );

            $tarefaDTO = new Tarefa();
            $tarefaDTO->setProcesso($entity->getProcesso());
            $tarefaDTO->setEspecieTarefa($especieTarefa);
            $tarefaDTO->setSetorResponsavel($setorResponsavel);
            $tarefaDTO->setUsuarioResponsavel($usuarioResponsavel);
            $tarefaDTO->setDataHoraInicioPrazo($inicioPrazo);
            $tarefaDTO->setDataHoraFinalPrazo($finalPrazo);

            try {
                $tarefa = $this->tarefaResource->create($tarefaDTO, $transactionId);
            } catch (Throwable) {
                // afastamento do usuário responsável ou outro impedidivo para mandar ao protocolo
                $tarefaDTO->setUsuarioResponsavel(null);
                $setorResponsavel = $this->setorRepository->findProtocoloInUnidade(
                    $entity->getSetorResponsavel()->getUnidade()->getId()
                );
                $tarefaDTO->setSetorResponsavel($setorResponsavel);
                $tarefa = $this->tarefaResource->create($tarefaDTO, $transactionId);
            }

            $this->transactionManager->removeContext('respostaDocumentoAvulso', $transactionId);

            $restDto->setTarefaOrigem($tarefa);
        }
    }

    public function getOrder(): int
    {
        return 2;
    }
}
