<?php

declare(strict_types=1);

namespace SuppCore\AdministrativoBackend\Api\V1\Triggers\Distribuicao;

use Exception;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Distribuicao as DistribuicaoDTO;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\Distribuicao as DistribuicaoEntity;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\RegrasEtiqueta\Message\RegrasEtiquetaMessage;
use SuppCore\AdministrativoBackend\Repository\ModalidadeEtiquetaRepository;
use SuppCore\AdministrativoBackend\Transaction\TransactionManager;
use SuppCore\AdministrativoBackend\Triggers\TriggerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

/**
 * Class Trigger0001.
 *
 * @descSwagger  =Processa as regras de etiquetagem automatica da tarefa após a distribuição
 * @classeSwagger=Trigger0001
 *
 * @author       Advocacia-Geral da União <supp@agu.gov.br>
 */
class Trigger0001 implements TriggerInterface
{
    private TransactionManager $transactionManager;
    private ModalidadeEtiquetaRepository $modalidadeEtiquetaRepository;

    /**
     * Trigger0001 constructor.
     */
    public function __construct(
        TransactionManager $transactionManager,
        ModalidadeEtiquetaRepository $modalidadeEtiquetaRepository,
        private ParameterBagInterface $parameterBag
    ) {
        $this->transactionManager = $transactionManager;
        $this->modalidadeEtiquetaRepository = $modalidadeEtiquetaRepository;
    }

    public function supports(): array
    {
        return [
            DistribuicaoDTO::class => [
                'afterCreate',
            ],
        ];
    }

    /**
     * @param DistribuicaoDTO|RestDtoInterface|null $restDto
     * @param DistribuicaoEntity|EntityInterface    $entity
     *
     * @throws Exception
     */
    public function execute(?RestDtoInterface $restDto, EntityInterface $entity, string $transactionId): void
    {
        $regrasEtiquetaMessage = new RegrasEtiquetaMessage();
        $regrasEtiquetaMessage->setUuid($entity->getTarefa()->getUuid());
        $regrasEtiquetaMessage->setResource('SuppCore\AdministrativoBackend\Api\V1\Resource\TarefaResource');
        $regrasEtiquetaMessage->setVinculacaoResource(
            'SuppCore\AdministrativoBackend\Api\V1\Resource\VinculacaoEtiquetaResource'
        );
        $regrasEtiquetaMessage->setEntityName('SuppCore\AdministrativoBackend\Entity\Tarefa');
        $regrasEtiquetaMessage->setModalidadeEtiquetaId(
            $this->modalidadeEtiquetaRepository
                ->findOneBy(['valor' => $this->parameterBag->get('constantes.entidades.modalidade_etiqueta.const_1')])->getId()
        );
        if (!$restDto->getUsuarioAnterior() || ($restDto->getUsuarioAnterior()->getId() !==
                $restDto->getUsuarioPosterior()->getId())) {
            $regrasEtiquetaMessage->setUsuarioId($restDto->getTarefa()->getUsuarioResponsavel()->getId());
        }
        if (!$restDto->getSetorAnterior() || ($restDto->getSetorAnterior()->getId() !==
                $restDto->getSetorPosterior()->getId())) {
            $regrasEtiquetaMessage->setSetorId($restDto->getTarefa()->getSetorResponsavel()->getId());
        }
        if (!$restDto->getSetorAnterior() || ($restDto->getSetorAnterior()->getUnidade()->getId() !==
                $restDto->getSetorPosterior()->getUnidade()->getId())) {
            $regrasEtiquetaMessage->setUnidadeId($restDto->getTarefa()->getSetorResponsavel()->getUnidade()->getId());
        }
        if (!$restDto->getSetorAnterior() ||
            ($restDto->getSetorAnterior()->getUnidade()->getModalidadeOrgaoCentral()->getId() !==
                $restDto->getSetorPosterior()->getUnidade()->getModalidadeOrgaoCentral()->getId())) {
            $regrasEtiquetaMessage->setModalidadeOrgaoCentralId(
                $restDto->getTarefa()->getSetorResponsavel()->getUnidade()->getModalidadeOrgaoCentral()->getId()
            );
        }
        $this->transactionManager->addAsyncDispatch($regrasEtiquetaMessage, $transactionId);
    }

    public function getOrder(): int
    {
        return 1;
    }
}
