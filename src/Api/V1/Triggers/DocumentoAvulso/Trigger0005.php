<?php

declare(strict_types=1);

/**
 * /src/Api/V1/Triggers/DocumentoAvulso/Trigger0005.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Triggers\DocumentoAvulso;

use DateInterval;
use DateTime;
use Exception;
use SuppCore\AdministrativoBackend\Api\V1\DTO\DocumentoAvulso;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Juntada;
use SuppCore\AdministrativoBackend\Api\V1\DTO\OrigemDados;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Tarefa;
use SuppCore\AdministrativoBackend\Api\V1\Resource\ComponenteDigitalResource;
use SuppCore\AdministrativoBackend\Api\V1\Resource\DocumentoResource;
use SuppCore\AdministrativoBackend\Api\V1\Resource\EspecieTarefaResource;
use SuppCore\AdministrativoBackend\Api\V1\Resource\JuntadaResource;
use SuppCore\AdministrativoBackend\Api\V1\Resource\OrigemDadosResource;
use SuppCore\AdministrativoBackend\Api\V1\Resource\TarefaResource;
use SuppCore\AdministrativoBackend\Api\V1\Resource\VolumeResource;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\DocumentoAvulso as DocumentoAvulsoEntity;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\Usuario;
use SuppCore\AdministrativoBackend\Repository\SetorRepository;
use SuppCore\AdministrativoBackend\Transaction\Context;
use SuppCore\AdministrativoBackend\Transaction\TransactionManager;
use SuppCore\AdministrativoBackend\Triggers\TriggerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class Trigger0005.
 *
 * @descSwagger=Processa a resposta de um documento avulso!
 * @classeSwagger=Trigger0005
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Trigger0005 implements TriggerInterface
{
    private SetorRepository $setorRepository;

    private TarefaResource $tarefaResource;

    private EspecieTarefaResource $especieTarefaResource;

    private JuntadaResource $juntadaResource;

    private TokenStorageInterface $tokenStorage;

    private VolumeResource $volumeResource;

    private OrigemDadosResource $origemDadosResource;

    /**
     * Trigger0005 constructor.
     */
    public function __construct(
        SetorRepository $setorRepository,
        TarefaResource $tarefaResource,
        EspecieTarefaResource $especieTarefaResource,
        JuntadaResource $juntadaResource,
        VolumeResource $volumeResource,
        OrigemDadosResource $origemDadosResource,
        TokenStorageInterface $tokenStorage,
        private ParameterBagInterface $parameterBag,
        private TransactionManager $transactionManager
    ) {
        $this->setorRepository = $setorRepository;
        $this->tarefaResource = $tarefaResource;
        $this->especieTarefaResource = $especieTarefaResource;
        $this->juntadaResource = $juntadaResource;
        $this->volumeResource = $volumeResource;
        $this->origemDadosResource = $origemDadosResource;
        $this->tokenStorage = $tokenStorage;
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
        $agora = new DateTime();
        $documento = $restDto->getDocumentoResposta();
        $this->transactionManager->addContext(
            new Context(
                'respostaDocumentoAvulso',
                true
            ),
            $transactionId
        );
        // complementação de resposta?
        if ($entity->getDataHoraResposta()) {
            $restDto->setDocumentoResposta($entity->getDocumentoResposta());

            if ($this->validaIntervalo($entity->getDataHoraResposta(), $agora)) {
                // tarefa de distribuição para a complementação caso tenha passado mais de 15 minutos
                $inicioPrazo = new DateTime();
                $finalPrazo = new DateTime();
                $finalPrazo->add(new DateInterval('P5D'));
                $especieTarefa = $this->especieTarefaResource->findOneBy(
                    [
                        'nome' => $this->parameterBag->get('constantes.entidades.especie_tarefa.const_2'),
                    ]
                );

                $protocolo = $this->setorRepository->findProtocoloInUnidade(
                    $entity->getSetorResponsavel()->getUnidade()->getId()
                );

                $tarefaDTO = new Tarefa();
                $tarefaDTO->setProcesso($entity->getProcesso());
                $tarefaDTO->setEspecieTarefa($especieTarefa);
                $tarefaDTO->setSetorResponsavel($protocolo);
                $tarefaDTO->setDataHoraInicioPrazo($inicioPrazo);
                $tarefaDTO->setDataHoraFinalPrazo($finalPrazo);

                $this->tarefaResource->create($tarefaDTO, $transactionId);
            }
        } else {
            // atualiza a data e hora de resposta
            $restDto->setDataHoraResposta($agora);

            if (null !== $this->tokenStorage->getToken()) {
                $restDto->setUsuarioResposta($this->tokenStorage->getToken()->getUser());
            }
            // se tarefa originária ainda estiver aberta e fora da caixa de entrada, recoloca ela lá
            if ($restDto->getTarefaOrigem() &&
                !$restDto->getTarefaOrigem()->getDataHoraConclusaoPrazo() &&
                $restDto->getTarefaOrigem()->getFolder()) {
                /** @var Tarefa $tarefaDTO */
                $tarefaDTO = $this->tarefaResource->getDtoForEntity(
                    $restDto->getTarefaOrigem()->getId(),
                    Tarefa::class
                );
                $tarefaDTO->setFolder(null);
                $this->tarefaResource->update($restDto->getTarefaOrigem()->getId(), $tarefaDTO, $transactionId);
            }
        }

        // juntada
        $juntadaDTO = new Juntada();
        $juntadaDTO->setDocumento($documento);
        $juntadaDTO->setDescricao(
            $entity->getEspecieDocumentoAvulso()->getNome().
            ' - RESPOSTA DE COMUNICAÇÃO (ID '.$entity->getId().')'
        );

        $volume = $this->volumeResource->getRepository()->findVolumeAbertoByProcessoId(
            $entity->getProcesso()->getId()
        );

        $juntadaDTO->setVolume($volume);

        // VERIFICA SE O DOCUMENTO FOI CRIADO VIA BARRAMENTO
        if ($documento->getOrigemDados() &&
            'BARRAMENTO_PEN' === $documento->getOrigemDados()->getFonteDados()) {
            $numeracaoSequencial = $this->juntadaResource->getRepository()->findMaxNumeracaoSequencialByProcessoId(
                $entity->getProcesso()->getId()
            ) + 1;

            // CRIA ORIGEM DADOS PARA A JUNTADA
            $origemJuntadaDTO = new OrigemDados();
            $origemJuntadaDTO->setServico('sapiens_barramento');
            $origemJuntadaDTO->setFonteDados($documento->getOrigemDados()->getFonteDados());
            $origemJuntadaDTO->setDataHoraUltimaConsulta(new DateTime());
            $origemJuntadaDTO->setIdExterno($documento->getOrigemDados()->getIdExterno()); // ID EXTERNO SERÁ O NRE
            $origemJuntadaDTO->setStatus(1);
            $origemDadosJuntadaEntity = $this->origemDadosResource->create($origemJuntadaDTO, $transactionId);

            $juntadaDTO->setNumeracaoSequencial($numeracaoSequencial);
            $juntadaDTO->setVinculada(false);
            $juntadaDTO->setOrigemDados($origemDadosJuntadaEntity);
        }

        $this->juntadaResource->create($juntadaDTO, $transactionId);
    }

    /**
     * @param $date
     * @param $agora
     *
     * @return bool
     */
    private function validaIntervalo(DateTime $date, DateTime $agora)
    {
        $interval = $date->diff($agora);
        if ($interval->y > 0 || $interval->m > 0 || $interval->d > 0 || $interval->h > 0) {
            return true;
        }
        if ($interval->i < 15) {
            return false;
        }

        return true;
    }

    public function getOrder(): int
    {
        return 2;
    }
}
