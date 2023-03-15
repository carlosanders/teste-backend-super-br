<?php

declare(strict_types=1);
/**
 * /src/Api/V1/Triggers/VinculacaoEtiqueta/Trigger0003.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Triggers\VinculacaoEtiqueta;

use Exception;
use Symfony\Component\VarExporter\LazyObjectInterface;
use function json_decode;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Tarefa;
use SuppCore\AdministrativoBackend\Api\V1\DTO\VinculacaoEtiqueta as VinculacaoEtiquetaDTO;
use SuppCore\AdministrativoBackend\Api\V1\Resource\TarefaResource;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Repository\SetorRepository;
use SuppCore\AdministrativoBackend\Repository\UsuarioRepository;
use SuppCore\AdministrativoBackend\Triggers\TriggerInterface;

/**
 * Class Trigger0003.
 *
 * @descSwagger= Ação de etiqueta para redistribuir automaticamente a tarefa.
 * @classeSwagger= Trigger0003
 */
class Trigger0003 implements TriggerInterface
{
    private TarefaResource $tarefaResource;

    private UsuarioRepository $usuarioRepository;
    private SetorRepository $setorRepository;

    /**
     * Trigger0003 constructor.
     */
    public function __construct(
        SetorRepository $setorRepository,
        TarefaResource $tarefaResource,
        UsuarioRepository $usuarioRepository
    ) {
        $this->setorRepository = $setorRepository;
        $this->tarefaResource = $tarefaResource;
        $this->usuarioRepository = $usuarioRepository;
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
                $tarefaEntity = $vinculacaoEtiquetaDTO->getTarefa();
                $tarefaDTO = $this->tarefaResource->getDtoForEntity(
                    $tarefaEntity->getId(),
                    Tarefa::class,
                    null,
                    $tarefaEntity
                );

                $tarefaDTO->setUsuarioResponsavel(null);
                $tarefaDTO->setSetorResponsavel(
                    $this->setorRepository->find(
                        json_decode($acao->getContexto(), true)['setorResponsavelId']
                    )
                );

                if (isset(json_decode($acao->getContexto(), true)['usuarioId'])) {
                    $tarefaDTO->setUsuarioResponsavel(
                        $this->usuarioRepository->find(json_decode($acao->getContexto(), true)['usuarioId'])
                    );
                }
                $this->tarefaResource->update($tarefaDTO->getId(), $tarefaDTO, $transactionId);
            }
        }
    }

    public function getOrder(): int
    {
        return 1;
    }
}
