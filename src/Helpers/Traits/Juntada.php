<?php

declare(strict_types=1);
/**
 * /src/Helper/Managers/Traits/Juntada.php.
 *
 * @author  Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Helpers\Traits;

use Doctrine\Common\Annotations\AnnotationException;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\Exception\ORMException;
use Exception;
use ReflectionException;
use SuppCore\AdministrativoBackend\Api\V1\DTO\ComponenteDigital as ComponenteDigitalDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Documento as DocumentoDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Juntada as JuntadaDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\VinculacaoDocumento as VinculacaoDocumentoDTO;
use SuppCore\AdministrativoBackend\Api\V1\Resource\ComponenteDigitalResource;
use SuppCore\AdministrativoBackend\Api\V1\Resource\DocumentoResource;
use SuppCore\AdministrativoBackend\Api\V1\Resource\JuntadaResource;
use SuppCore\AdministrativoBackend\Api\V1\Resource\VinculacaoDocumentoResource;
use SuppCore\AdministrativoBackend\Api\V1\Resource\VolumeResource;
use SuppCore\AdministrativoBackend\Entity\ComponenteDigital;
use SuppCore\AdministrativoBackend\Entity\Documento as DocumentoEntity;
use SuppCore\AdministrativoBackend\Entity\Processo;
use SuppCore\AdministrativoBackend\Entity\Processo as ProcessoEntity;
use SuppCore\AdministrativoBackend\Entity\Setor;
use SuppCore\AdministrativoBackend\Entity\VinculacaoDocumento as VinculacaoDocumentoEntity;
use SuppCore\AdministrativoBackend\Entity\Volume;
use SuppCore\AdministrativoBackend\Transaction\TransactionManager;
use SuppCore\AdministrativoBackend\Api\V1\Resource\ModalidadeVinculacaoDocumentoResource;
use SuppCore\AdministrativoBackend\Mapper\DefaultMapper;

/**
 * Trait Juntada.
 *
 * @author  Advocacia-Geral da União <supp@agu.gov.br>
 */
trait Juntada
{
    private DocumentoResource $documentoResource;

    private ComponenteDigitalResource $componenteDigitalResource;

    private VinculacaoDocumentoResource $vinculacaoDocumentoResource;

    private ModalidadeVinculacaoDocumentoResource $modalidadeVinculacaoDocumentoResource;

    private DefaultMapper $mapper;

    private TransactionManager $transactionManager;

    private VolumeResource $volumeResource;

    private JuntadaResource $juntadaResource;

    /**
     * @required
     *
     * @param DocumentoResource $documentoResource
     * @param ComponenteDigitalResource $componenteDigitalResource
     * @param VinculacaoDocumentoResource $vinculacaoDocumentoResource
     * @param ModalidadeVinculacaoDocumentoResource $modalidadeVinculacaoDocumentoResource
     * @param DefaultMapper $mapper
     * @param TransactionManager $transactionManager
     * @param VolumeResource $volumeResource
     * @param JuntadaResource $juntadaResource
     */
    public function setDependencies(
        DocumentoResource $documentoResource,
        ComponenteDigitalResource $componenteDigitalResource,
        VinculacaoDocumentoResource $vinculacaoDocumentoResource,
        ModalidadeVinculacaoDocumentoResource $modalidadeVinculacaoDocumentoResource,
        DefaultMapper $mapper,
        TransactionManager $transactionManager,
        VolumeResource $volumeResource,
        JuntadaResource $juntadaResource
    ): void {
        $this->mapper = $mapper;
        $this->documentoResource = $documentoResource;
        $this->transactionManager = $transactionManager;
        $this->componenteDigitalResource = $componenteDigitalResource;
        $this->vinculacaoDocumentoResource = $vinculacaoDocumentoResource;
        $this->modalidadeVinculacaoDocumentoResource = $modalidadeVinculacaoDocumentoResource;
        $this->volumeResource = $volumeResource;
        $this->juntadaResource = $juntadaResource;
    }

    /**
     * @return string
     *
     * @throws Exception
     */
    protected function getTransactionId(): string
    {
        return $this->transactionManager->getCurrentTransactionId() ?:
            $this->transactionManager->begin();
    }

    /**
     * @param DocumentoEntity $documento
     * @param ProcessoEntity|null $processoOrigem
     * @param Setor|null $setorOrigem
     *
     * @return DocumentoEntity
     *
     * @throws AnnotationException
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws ReflectionException
     * @throws Exception
     */
    protected function clonaDocumento(
        DocumentoEntity $documento,
        ?ProcessoEntity $processoOrigem = null,
        ?Setor $setorOrigem = null
    ): DocumentoEntity {
        /** @var DocumentoDTO $documentoDTO */
        $documentoDTO = $this
            ->mapper
            ->createDTOFromEntity(DocumentoDTO::class, $documento);

        if ($setorOrigem) {
            $documentoDTO->setSetorOrigem($setorOrigem);
        }

        if ($processoOrigem) {
            $documentoDTO->setProcessoOrigem($processoOrigem);
        }

        $documentoEntity =
            $this
                ->documentoResource
                ->create($documentoDTO, $this->getTransactionId());

        $componentesDigitais = $this->transactionManager->getScheduledEntities(
            ComponenteDigital::class,
            $this->getTransactionId()
        );

        $componentesDigitais = (new ArrayCollection($componentesDigitais))
            ->filter(fn(ComponenteDigital $c) => $c->getDocumento()->getUuid() === $documento->getUuid());

        /** @var ComponenteDigital $componenteDigital */
        foreach ($componentesDigitais as $componenteDigital) {
            $modeloEntity = $componenteDigital->getModelo();

            /** @var ComponenteDigitalDTO $componenteDigitalDTO */
            $componenteDigitalDTO = $this
                ->mapper
                ->createDTOFromEntity(ComponenteDigitalDTO::class, $componenteDigital);

            $componenteDigitalDTO->setDocumento($documentoEntity);
            $componenteDigitalDTO->setModelo(null);

            $componenteDigitalEntity = $this
                ->componenteDigitalResource
                ->create($componenteDigitalDTO, $this->getTransactionId());

            $componenteDigitalEntity->setModelo($modeloEntity);
        }

        return $documentoEntity;
    }

    /**
     * @param DocumentoEntity $documento
     * @param DocumentoEntity $documentoVinculado
     * @param $transactionId
     *
     * @return VinculacaoDocumentoEntity
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    protected function vincularDocumentos(
        DocumentoEntity $documento,
        DocumentoEntity $documentoVinculado,
        $transactionId
    ): VinculacaoDocumentoEntity {
        $vinculacaoDocumento = new VinculacaoDocumentoDTO();
        $vinculacaoDocumento->setDocumento($documento);
        $vinculacaoDocumento->setDocumentoVinculado($documentoVinculado);
        $vinculacaoDocumento->setModalidadeVinculacaoDocumento(
            $this
                ->modalidadeVinculacaoDocumentoResource
                ->getRepository()
                ->findOneBy(['valor' => 'ANEXO'])
        );

        return $this
            ->vinculacaoDocumentoResource
            ->create($vinculacaoDocumento, $transactionId);
    }

    /**
     * @param array|ProcessoEntity $processos
     * @param array|DocumentoEntity $documentos
     * @param string $tituloMovimento
     * @param bool $clonaDocumentos
     *
     * @throws NonUniqueResultException
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws Exception
     */
    protected function juntarDocumentos(
        array|ProcessoEntity $processos,
        array|DocumentoEntity $documentos,
        string $tituloMovimento,
        bool $clonaDocumentos = true
    ): void {
        if (!$processos || !$documentos) {
            return;
        }

        $documentos = is_array($documentos) ? $documentos : [$documentos];
        $processos = is_array($processos) ? $processos : [$processos];
        foreach ($processos as $processo) {
            $processosSemRepeticao[$processo->getUuid()] = $processo;
        }

        /** @noinspection PhpDeprecatedStdLibCallInspection */
        $documentoPrincipal = current($documentos);
        foreach ($processosSemRepeticao ?? [] as $processo) {
            try {
                $documentoPrincipalEntity = !$clonaDocumentos ?
                    $documentoPrincipal :
                    $this->clonaDocumento(
                        $documentoPrincipal,
                        $processo,
                        $processo->getSetorAtual()
                    );

                if (count($documentos) > 1) {
                    foreach ($documentos as $documento) {
                        if ($documento->getUuid() === $documentoPrincipal->getUuid()) {
                            continue;
                        }

                        $documentoVinculadoEntity = !$clonaDocumentos ?
                            $documentoPrincipal :
                            $this->clonaDocumento(
                                $documento,
                                $processo,
                                $processo->getSetorAtual()
                            );

                        $this->vincularDocumentos(
                            $documentoPrincipalEntity,
                            $documentoVinculadoEntity,
                            $this->getTransactionId()
                        );
                    }
                }
            } catch (AnnotationException|OptimisticLockException|ORMException|ReflectionException) {
                return;
            }

            // juntada
            $volume = null !== $processo->getId() ?
                $this
                    ->volumeResource
                    ->getRepository()
                    ->findVolumeAbertoByProcessoId($processo->getId()) :

                (new ArrayCollection(
                    $this->transactionManager->getScheduledEntities(Volume::class, $this->getTransactionId())
                ))
                    ->filter(fn(Volume $v) => $v->getProcesso()->getUuid() === $processo->getUuid())
                    ->first();

            // cria a juntada do boleto clonado e da memória de cálculo (vinculada)
            $juntadaDTO = new JuntadaDTO();
            $juntadaDTO->setDescricao($tituloMovimento);
            $juntadaDTO->setDocumento($documentoPrincipalEntity);
            $juntadaDTO->setVolume($volume);

            $this->juntadaResource->create($juntadaDTO, $this->getTransactionId());
        }
    }
}
