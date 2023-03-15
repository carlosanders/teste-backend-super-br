<?php

declare(strict_types=1);
/**
 * /src/Api/V1/Triggers/VinculacaoEtiqueta/Trigger0005.php.
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Triggers\VinculacaoEtiqueta;

use DateTime;
use Exception;
use Symfony\Component\VarExporter\LazyObjectInterface;
use function json_decode;
use SuppCore\AdministrativoBackend\Api\V1\DTO\DocumentoAvulso;
use SuppCore\AdministrativoBackend\Api\V1\DTO\VinculacaoEtiqueta as VinculacaoEtiquetaDTO;
use SuppCore\AdministrativoBackend\Api\V1\Resource\DocumentoAvulsoResource;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\VinculacaoEtiqueta as VinculacaoEtiquetaEntity;
use SuppCore\AdministrativoBackend\Repository\EspecieDocumentoAvulsoRepository;
use SuppCore\AdministrativoBackend\Repository\ModeloRepository;
use SuppCore\AdministrativoBackend\Repository\PessoaRepository;
use SuppCore\AdministrativoBackend\Repository\SetorRepository;
use SuppCore\AdministrativoBackend\Triggers\TriggerInterface;

/**
 * Class Trigger0005.
 *
 * @descSwagger= Ação de etiqueta para gerar oficio (documento avulso) de acordo com a tarefa.
 * @classeSwagger= Trigger0005
 */
class Trigger0005 implements TriggerInterface
{
    private DocumentoAvulsoResource $documentoAvulsoResource;

    private EspecieDocumentoAvulsoRepository $especieDocumentoAvulsoRepository;
    private ModeloRepository $modeloRepository;
    private SetorRepository $setorRepository;
    private PessoaRepository $pessoaRepository;

    /**
     * Trigger0005 constructor.
     */
    public function __construct(
        DocumentoAvulsoResource $documentoAvulsoResource,
        EspecieDocumentoAvulsoRepository $especieDocumentoAvulsoRepository,
        ModeloRepository $modeloRepository,
        SetorRepository $setorRepository,
        PessoaRepository $pessoaRepository
    ) {
        $this->documentoAvulsoResource = $documentoAvulsoResource;
        $this->especieDocumentoAvulsoRepository = $especieDocumentoAvulsoRepository;
        $this->modeloRepository = $modeloRepository;
        $this->setorRepository = $setorRepository;
        $this->pessoaRepository = $pessoaRepository;
    }

    public function supports(): array
    {
        return [
            VinculacaoEtiquetaDTO::class => [
                'afterCreate',
                'afterAprovarSugestao',
            ],
        ];
    }

    /**
     * @param VinculacaoEtiquetaDTO|RestDtoInterface|null $vinculacaoEtiquetaDTO
     * @param VinculacaoEtiquetaEntity|EntityInterface    $vinculacaoEtiquetaEntity
     *
     * @throws Exception
     */
    public function execute(
        ?RestDtoInterface $vinculacaoEtiquetaDTO,
        EntityInterface $vinculacaoEtiquetaEntity,
        string $transactionId
    ): void {
        $className = $this instanceof LazyObjectInterface ? get_parent_class($this) : get_class($this);
        foreach ($vinculacaoEtiquetaDTO->getEtiqueta()->getAcoes() as $acao) {
            if (($acao->getModalidadeAcaoEtiqueta()->getTrigger() === $className)
                && $vinculacaoEtiquetaDTO->getTarefa()
                && (!$vinculacaoEtiquetaDTO->getSugestao() || $vinculacaoEtiquetaDTO->getDataHoraAprovacaoSugestao())
            ) {
                $documentoAvulsoDTO = new DocumentoAvulso();
                $documentoAvulsoDTO->setProcesso($vinculacaoEtiquetaDTO->getTarefa()->getProcesso());
                $documentoAvulsoDTO->setEspecieDocumentoAvulso(
                    $this->especieDocumentoAvulsoRepository->find(
                        json_decode($acao->getContexto(), true)['especieDocumentoAvulsoId']
                    )
                );
                $documentoAvulsoDTO->setTarefaOrigem(
                    $vinculacaoEtiquetaDTO->getTarefa()
                );
                $documentoAvulsoDTO->setModelo(
                    $this->modeloRepository->find(json_decode($acao->getContexto(), true)['modeloId'])
                );

                if (isset(json_decode($acao->getContexto(), true)['pessoaDestinoId'])) {
                    $documentoAvulsoDTO->setPessoaDestino(
                        $this->pessoaRepository->find(
                            json_decode($acao->getContexto(), true)['pessoaDestinoId']
                        )
                    );
                }

                if (isset(json_decode($acao->getContexto(), true)['setorDestinoId'])) {
                    $documentoAvulsoDTO->setSetorDestino(
                        $this->setorRepository->find(
                            json_decode($acao->getContexto(), true)['setorDestinoId']
                        )
                    );
                }

                if (isset(json_decode($acao->getContexto(), true)['mecanismoRemessa'])) {
                    $documentoAvulsoDTO->setMecanismoRemessa(
                        json_decode($acao->getContexto(), true)['mecanismoRemessa']
                    );
                }

                $dataAtual = new DateTime();
                $documentoAvulsoDTO->setDataHoraInicioPrazo($dataAtual);
                $documentoAvulsoDTO->setDocumentoRemessa(
                    $vinculacaoEtiquetaDTO->getDocumento()
                );

                if (json_decode($acao->getContexto(), true)['prazoFinal']) {
                    $dias = json_decode($acao->getContexto(), true)['prazoFinal'];
                    $documentoAvulsoDTO->setDataHoraFinalPrazo($dataAtual->modify("+$dias days"));
                }

                if (isset(json_decode($acao->getContexto(), true)['blocoResponsaveis'])) {
                    $responsaveis = json_decode($acao->getContexto(), true)['blocoResponsaveis'];
                    foreach ($responsaveis as $responsavel) {
                        if ('setor' == $responsavel['tipo']) {
                            $documentoAvulsoDTO->setSetorDestino(
                                $this->setorRepository->find($responsavel['id'])
                            );
                        }

                        if ('pessoa' == $responsavel['tipo']) {
                            $documentoAvulsoDTO->setPessoaDestino(
                                $this->pessoaRepository->find($responsavel['id'])
                            );
                        }
                        $this->documentoAvulsoResource->create($documentoAvulsoDTO, $transactionId);
                    }
                } else {
                    $this->documentoAvulsoResource->create($documentoAvulsoDTO, $transactionId);
                }
            }
        }
    }

    public function getOrder(): int
    {
        return 1;
    }
}
