<?php

namespace SuppCore\AdministrativoBackend\Api\V1\Triggers\Processo;

use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\Exception\ORMException;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Assunto;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Documento;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Interessado;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Juntada as JuntadaDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Processo;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Representante;
use SuppCore\AdministrativoBackend\Api\V1\Resource\AssuntoAdministrativoResource;
use SuppCore\AdministrativoBackend\Api\V1\Resource\AssuntoResource;
use SuppCore\AdministrativoBackend\Api\V1\Resource\DocumentoResource;
use SuppCore\AdministrativoBackend\Api\V1\Resource\InteressadoResource;
use SuppCore\AdministrativoBackend\Api\V1\Resource\JuntadaResource;
use SuppCore\AdministrativoBackend\Api\V1\Resource\ModalidadeInteressadoResource;
use SuppCore\AdministrativoBackend\Api\V1\Resource\NumeroUnicoDocumentoResource;
use SuppCore\AdministrativoBackend\Api\V1\Resource\RepresentanteResource;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\Juntada;
use SuppCore\AdministrativoBackend\Entity\Processo as ProcessoEntity;
use SuppCore\AdministrativoBackend\Entity\Volume;
use SuppCore\AdministrativoBackend\Triggers\TriggerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * Class Trigger0011.
 *
 * @descSwagger  =Adiciona assuntos e interessados do processo origem ao novo processo!
 * @classeSwagger=Trigger0011
 *
 * @author       Advocacia-Geral da União <supp@agu.gov.br>
 */
class Trigger0011 implements TriggerInterface
{
    private AssuntoResource $assuntoResource;
    private InteressadoResource $interessadoResource;
    private ModalidadeInteressadoResource $modalidadeInteressadoResource;
    private AssuntoAdministrativoResource $assuntoAdministrativoResource;
    private AuthorizationCheckerInterface $authorizationChecker;

    /**
     * Trigger0011 constructor.
     */
    public function __construct(
        AssuntoResource $assuntoResource,
        InteressadoResource $interessadoResource,
        ModalidadeInteressadoResource $modalidadeInteressadoResource,
        AssuntoAdministrativoResource $assuntoAdministrativoResource,
        AuthorizationCheckerInterface $authorizationChecker,
        private JuntadaResource $juntadaResource,
        private ParameterBagInterface $parameterBag,
        private DocumentoResource $documentoResource,
        private RepresentanteResource $representanteResource,
        private NumeroUnicoDocumentoResource $numeroUnicoDocumentoResource
    ) {
        $this->assuntoResource = $assuntoResource;
        $this->interessadoResource = $interessadoResource;
        $this->modalidadeInteressadoResource = $modalidadeInteressadoResource;
        $this->assuntoAdministrativoResource = $assuntoAdministrativoResource;
        $this->authorizationChecker = $authorizationChecker;
    }

    public function supports(): array
    {
        return [
            Processo::class => [
                'afterCreate',
            ],
        ];
    }

    /**
     * @param Processo|RestDtoInterface|null $restDto
     * @param ProcessoEntity|EntityInterface $entity
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function execute(?RestDtoInterface $restDto, EntityInterface $entity, string $transactionId): void
    {
        if ($restDto->getProcessoOrigem()) {
            /* @var Assunto */
            foreach ($restDto->getProcessoOrigem()->getAssuntos() as $assuntoClonado) {
                $assuntoDTO = new Assunto();
                $assuntoDTO->setProcesso($entity);
                $assuntoDTO->setAssuntoAdministrativo($assuntoClonado->getAssuntoAdministrativo());
                $assuntoDTO->setPrincipal($assuntoClonado->getPrincipal());
                $this->assuntoResource->create($assuntoDTO, $transactionId);
            }

            /* @var Interessado */
            foreach ($restDto->getProcessoOrigem()->getInteressados() as $interessadoClonado) {
                $interessadoDTO = new Interessado();
                $interessadoDTO->setPessoa($interessadoClonado->getPessoa());
                $interessadoDTO->setProcesso($entity);
                $interessadoDTO->setModalidadeInteressado($interessadoClonado->getModalidadeInteressado());
                $this->interessadoResource->create($interessadoDTO, $transactionId);

                /** @var Representante $representanteClonado */
                foreach ($interessadoClonado->getRepresentantes() as $representanteClonado) {
                    $representanteDTO = new Representante();
                    $representanteDTO->setNome($representanteClonado->getNome());
                    $representanteDTO->setInscricao($representanteClonado->getInscricao());
                    $representanteDTO->setModalidadeRepresentante($representanteClonado->getModalidadeRepresentante());
                    $representanteDTO->setInteressado($interessadoClonado);
                    $this->representanteResource->create($representanteDTO, $transactionId);
                }
            }

            if ($restDto->getProcessoOrigemIncluirDocumentos()) {
                $volumeNovo = $restDto->getVolumes()[0];
                /* @var Volume */
                foreach ($restDto->getProcessoOrigem()->getVolumes() as $volume) {
                    /** @var Juntada $juntada */
                    foreach ($volume->getJuntadas() as $juntada) {
                        if ($juntada->getAtivo()) {
                            // copia o documento
                            $documentoDTO = new Documento();
                            $documentoDTO->setSetorOrigem($juntada->getDocumento()->getSetorOrigem());
                            $documentoDTO->setTipoDocumento($juntada->getDocumento()->getTipoDocumento());
                            $documentoDTO->setProcessoOrigem($entity);

                            $numeroUnicoDocumento = $this->numeroUnicoDocumentoResource->generate(
                                $documentoDTO->getSetorOrigem(),
                                $documentoDTO->getTipoDocumento()
                            );

                            $documentoDTO->setNumeroUnicoDocumento($numeroUnicoDocumento);

                            $documentoNovo = $this->documentoResource->create($documentoDTO, $transactionId);

                            /** @var Documento $documentoDTO */
                            $documentoNovo = $this->documentoResource->clonar(
                                $juntada->getDocumento()->getId(),
                                $documentoNovo,
                                $transactionId
                            );

                            // nova juntada
                            $juntadaDTO = new JuntadaDTO();
                            $juntadaDTO->setDocumento($documentoNovo);
                            $juntadaDTO->setVolume($volumeNovo);
                            $juntadaDTO->setDescricao($juntada->getDescricao());
                            $this->juntadaResource->create($juntadaDTO, $transactionId);
                        }
                    }
                }
            }
        }

        //CASO SEJA USUÁRIO EXTERNO
        if ($restDto->getProtocoloEletronico() &&
            (false === $this->authorizationChecker->isGranted('ROLE_COLABORADOR'))) {
            $interessadoDTO = new Interessado();
            $interessadoDTO->setPessoa($restDto->getProcedencia());
            $interessadoDTO->setProcesso($entity);
            $interessadoDTO->setModalidadeInteressado(
                $this->modalidadeInteressadoResource
                    ->findOneBy(
                        ['valor' => $this->parameterBag->get('constantes.entidades.modalidade_interessado.const_1')]
                    )
            );
            $this->interessadoResource->create($interessadoDTO, $transactionId);

            $assuntoDTO = new Assunto();
            $assuntoDTO->setAssuntoAdministrativo(
                $this->assuntoAdministrativoResource
                    ->findOneBy(
                        ['nome' => $this->parameterBag->get('constantes.entidades.assunto_administrativo.const_1')]
                    )
            );
            $assuntoDTO->setPrincipal(true);
            $assuntoDTO->setProcesso($entity);
            $this->assuntoResource->create($assuntoDTO, $transactionId);
        }
    }

    public function getOrder(): int
    {
        return 11;
    }
}
