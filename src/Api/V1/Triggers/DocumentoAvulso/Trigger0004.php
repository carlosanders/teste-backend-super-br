<?php

declare(strict_types=1);
/**
 * /src/Api/V1/Triggers/DocumentoAvulso/Trigger0004.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Triggers\DocumentoAvulso;

use DateInterval;
use DateTime;
use Exception;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Assunto;
use SuppCore\AdministrativoBackend\Api\V1\DTO\DocumentoAvulso;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Interessado;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Juntada;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Processo;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Representante;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Tarefa;
use SuppCore\AdministrativoBackend\Api\V1\DTO\VinculacaoProcesso;
use SuppCore\AdministrativoBackend\Api\V1\Resource\AssuntoResource;
use SuppCore\AdministrativoBackend\Api\V1\Resource\DocumentoResource;
use SuppCore\AdministrativoBackend\Api\V1\Resource\EspecieTarefaResource;
use SuppCore\AdministrativoBackend\Api\V1\Resource\InteressadoResource;
use SuppCore\AdministrativoBackend\Api\V1\Resource\JuntadaResource;
use SuppCore\AdministrativoBackend\Api\V1\Resource\ProcessoResource;
use SuppCore\AdministrativoBackend\Api\V1\Resource\RepresentanteResource;
use SuppCore\AdministrativoBackend\Api\V1\Resource\TarefaResource;
use SuppCore\AdministrativoBackend\Api\V1\Resource\VinculacaoProcessoResource;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\Documento;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\Processo as ProcessoEntity;
use SuppCore\AdministrativoBackend\Repository\ClassificacaoRepository;
use SuppCore\AdministrativoBackend\Repository\EspecieProcessoRepository;
use SuppCore\AdministrativoBackend\Repository\ModalidadeMeioRepository;
use SuppCore\AdministrativoBackend\Repository\ModalidadeVinculacaoProcessoRepository;
use SuppCore\AdministrativoBackend\Repository\SetorRepository;
use SuppCore\AdministrativoBackend\Repository\VolumeRepository;
use SuppCore\AdministrativoBackend\Transaction\Context;
use SuppCore\AdministrativoBackend\Transaction\TransactionManager;
use SuppCore\AdministrativoBackend\Triggers\TriggerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

/**
 * Class Trigger0004.
 *
 * @descSwagger=Se o documento avulso for interno, autua automaticamente o ofício!
 * @classeSwagger=Trigger0004
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Trigger0004 implements TriggerInterface
{
    /**
     * Trigger0004 constructor.
     */
    public function __construct(
        private ModalidadeMeioRepository $modalidadeMeioRepository,
        private ClassificacaoRepository $classificacaoRepository,
        private EspecieProcessoRepository $especieProcessoRepository,
        private SetorRepository $setorRepository,
        private ProcessoResource $processoResource,
        private AssuntoResource $assuntoResource,
        private TarefaResource $tarefaResource,
        private DocumentoResource $documentoResource,
        private EspecieTarefaResource $especieTarefaResource,
        private InteressadoResource $interessadoResource,
        private JuntadaResource $juntadaResource,
        private RepresentanteResource $representanteResource,
        private VinculacaoProcessoResource $vinculacaoProcessoResource,
        private ModalidadeVinculacaoProcessoRepository $modalidadeVinculacaoProcessoRepository,
        private VolumeRepository $volumeRepository,
        private ParameterBagInterface $parameterBag,
        private TransactionManager $transactionManager
    ) {
    }

    public function supports(): array
    {
        return [
            DocumentoAvulso::class => [
                'beforeRemeter',
            ],
        ];
    }

    /**
     * @param DocumentoAvulso|RestDtoInterface|null $restDto
     *
     * @throws Exception
     */
    public function execute(?RestDtoInterface $restDto, EntityInterface $entity, string $transactionId): void
    {
        if ($restDto->getSetorDestino()) {
            $processoDTO = (new Processo())
                ->setUnidadeArquivistica(ProcessoEntity::UA_DOCUMENTO_AVULSO)
                ->setTipoProtocolo(ProcessoEntity::TP_NOVO)
                ->setClassificacao(
                    $this->classificacaoRepository->findOneBy(
                        ['codigo' => $this->parameterBag->get('constantes.entidades.classificacao.const_1')]
                    )
                )
                ->setModalidadeMeio(
                    $this->modalidadeMeioRepository->findOneBy(
                        ['valor' => $this->parameterBag->get('constantes.entidades.modalidade_meio.const_1')]
                    )
                )
                ->setTitulo(
                    $restDto->getEspecieDocumentoAvulso()->getNome().' ORIGINADA NO NUP '.$restDto->getProcesso()
                    ->getNUPFormatado()
                )
                ->setSetorAtual(
                    $this->setorRepository->findProtocoloInUnidade($restDto->getSetorDestino()->getId())
                )
                ->setDocumentoAvulsoOrigem($entity)
                ->setEspecieProcesso(
                    $restDto
                    ->getEspecieDocumentoAvulso()
                    ->getEspecieProcesso() ?:
                    $this
                        ->especieProcessoRepository
                        ->findOneBy([
                            'nome' => $this->parameterBag->get('constantes.entidades.especie_processo.const_1'),
                        ])
                );

            $processo = $this->processoResource->create($processoDTO, $transactionId);
            $volumeDestino = $processoDTO->getVolumes()[0];

            /** @var \SuppCore\AdministrativoBackend\Entity\Assunto $assuntoClonado */
            foreach ($restDto->getProcesso()->getAssuntos() as $assuntoClonado) {
                $assuntoDTO = (new Assunto())
                    ->setPrincipal($assuntoClonado->getPrincipal())
                    ->setAssuntoAdministrativo($assuntoClonado->getAssuntoAdministrativo())
                    ->setProcesso($processo);

                $this->assuntoResource->create($assuntoDTO, $transactionId, true);
            }

            /** @var \SuppCore\AdministrativoBackend\Entity\Interessado $interessadoClonado */
            foreach ($restDto->getProcesso()->getInteressados() as $interessadoClonado) {
                $interessadoDTO = (new Interessado())
                    ->setPessoa($interessadoClonado->getPessoa())
                    ->setModalidadeInteressado($interessadoClonado->getModalidadeInteressado())
                    ->setProcesso($processo);

                $interessado = $this->interessadoResource->create($interessadoDTO, $transactionId, true);

                /** @var \SuppCore\AdministrativoBackend\Entity\Representante $representanteClonado */
                foreach ($interessadoClonado->getRepresentantes() as $representanteClonado) {
                    $representanteDTO = (new Representante())
                        ->setNome($representanteClonado->getNome())
                        ->setInscricao($representanteClonado->getInscricao())
                        ->setModalidadeRepresentante($representanteClonado->getModalidadeRepresentante())
                        ->setInteressado($interessado);

                    $this->representanteResource->create($representanteDTO, $transactionId, true);
                }
            }

            $this->transactionManager->addContext(
                new Context(
                    'remessaDocumentoAvulso',
                    true
                ),
                $transactionId
            );

            $vinculacaoProcessoDTO = (new VinculacaoProcesso())
                ->setProcesso($restDto->getProcesso())
                ->setProcessoVinculado($processo)
                ->setModalidadeVinculacaoProcesso(
                    $this->modalidadeVinculacaoProcessoRepository
                        ->findOneBy(
                            [
                                'valor' => $this->parameterBag->get(
                                    'constantes.entidades.modalidade_vinculacao_processo.const_1'
                                ),
                            ]
                        )
                );

            $this->vinculacaoProcessoResource->create($vinculacaoProcessoDTO, $transactionId);

            $this->transactionManager->removeContext('remessaDocumentoAvulso', $transactionId);

            /** @var Documento $documento */
            $documento = $this->documentoResource
                ->clonar($restDto->getDocumentoRemessa()->getId(), null, $transactionId)
                ->setProcessoOrigem($processo);

            // juntada clonado
            $juntadaDTO = (new Juntada())
                ->setDocumento($documento)
                ->setDescricao(
                    $restDto->getEspecieDocumentoAvulso()->getNome().
                    ' - REMESSA DE OFÍCIO (ID '.$restDto->getId().') NO NUP '.$restDto->getProcesso()->getNUPFormatado()
                )
                ->setVolume($volumeDestino);

            $this->juntadaResource->create($juntadaDTO, $transactionId);

            $especieTarefa = null;

            $tarefaDTO = (new Tarefa())
                ->setProcesso($processo)
                ->setSetorResponsavel(
                    $this->setorRepository->findProtocoloInUnidade($restDto->getSetorDestino()->getId())
                )
                ->setDataHoraInicioPrazo(new DateTime())
                ->setDataHoraFinalPrazo((new DateTime())->add(new DateInterval('P5D')))
                ->setSetorOrigem($restDto->getSetorResponsavel());

            if ($restDto->getEspecieDocumentoAvulso()->getWorkflow()) {
                $tarefaDTO->setWorkflow($restDto->getEspecieDocumentoAvulso()->getWorkflow());
            } else {
                $tarefaDTO->setEspecieTarefa(
                    $restDto->getEspecieDocumentoAvulso()->getEspecieTarefa() ?:
                        $this->especieTarefaResource->findOneBy(
                            ['nome' => $this->parameterBag->get('constantes.entidades.especie_tarefa.const_2')]
                        )
                );
            }

            $this->tarefaResource->create($tarefaDTO, $transactionId);
        }

        // juntada original
        $juntadaDTO = (new Juntada())
            ->setDocumento($restDto->getDocumentoRemessa())
            ->setDocumentoAvulso($entity)
            ->setDescricao(
                $restDto->getEspecieDocumentoAvulso()->getNome().
                ' - REMESSA DE COMUNICAÇÃO (ID '.$restDto->getId().')'
            )
            ->setVolume($this->volumeRepository->findVolumeAbertoByProcessoId($restDto->getProcesso()->getId()));

        $this->juntadaResource->create($juntadaDTO, $transactionId);
    }

    public function getOrder(): int
    {
        return 2;
    }
}
