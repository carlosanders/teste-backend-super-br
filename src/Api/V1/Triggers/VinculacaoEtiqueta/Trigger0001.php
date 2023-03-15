<?php

declare(strict_types=1);
/**
 * /src/Api/V1/Triggers/VinculacaoEtiqueta/Trigger0001.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Triggers\VinculacaoEtiqueta;

use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\Exception\ORMException;
use Exception;
use Symfony\Component\VarExporter\LazyObjectInterface;
use function json_decode;
use SuppCore\AdministrativoBackend\Api\V1\DTO\ComponenteDigital as ComponenteDigitalDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\VinculacaoEtiqueta as VinculacaoEtiquetaDTO;
use SuppCore\AdministrativoBackend\Api\V1\Resource\ComponenteDigitalResource;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\VinculacaoEtiqueta as VinculacaoEtiquetaEntity;
use SuppCore\AdministrativoBackend\Repository\ModeloRepository;
use SuppCore\AdministrativoBackend\Triggers\TriggerInterface;

/**
 * Class Trigger0001.
 *
 * @descSwagger= Ação de etiqueta para gerar uma minuta na tarefa de acordo com o modelo pré-selecionado
 * @classeSwagger=Trigger0001
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Trigger0001 implements TriggerInterface
{
    private ComponenteDigitalResource $componenteDigitalResource;

    private ModeloRepository $modeloRepository;

    /**
     * Trigger0001 constructor.
     */
    public function __construct(
        ComponenteDigitalResource $componenteDigitalResource,
        ModeloRepository $modeloRepository
    ) {
        $this->componenteDigitalResource = $componenteDigitalResource;
        $this->modeloRepository = $modeloRepository;
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
     * @param RestDtoInterface|null $vinculacaoEtiquetaDTO
     * @param EntityInterface $vinculacaoEtiquetaEntity
     * @param string $transactionId
     * @return void
     * @throws NonUniqueResultException
     * @throws ORMException
     * @throws OptimisticLockException
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
                $modelo = $this->modeloRepository->find(json_decode($acao->getContexto(), true)['modeloId']);
                $componenteDigitalDTO = new ComponenteDigitalDTO();
                $componenteDigitalDTO->setTarefaOrigem($vinculacaoEtiquetaDTO->getTarefa());
                $componenteDigitalDTO->setModelo($modelo);
                $componenteDigitalDTO->setFileName($modelo->getNome().'.html');
                $this->componenteDigitalResource->create($componenteDigitalDTO, $transactionId);
            }
        }
    }

    public function getOrder(): int
    {
        return 1;
    }
}
