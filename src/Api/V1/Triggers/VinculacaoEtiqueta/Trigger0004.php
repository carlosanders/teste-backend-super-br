<?php

declare(strict_types=1);
/**
 * /src/Api/V1/Triggers/VinculacaoEtiqueta/Trigger0004.php.
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Triggers\VinculacaoEtiqueta;

use Exception;
use Symfony\Component\VarExporter\LazyObjectInterface;
use function json_decode;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Compartilhamento;
use SuppCore\AdministrativoBackend\Api\V1\DTO\VinculacaoEtiqueta as VinculacaoEtiquetaDTO;
use SuppCore\AdministrativoBackend\Api\V1\Resource\CompartilhamentoResource;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\VinculacaoEtiqueta as VinculacaoEtiquetaEntity;
use SuppCore\AdministrativoBackend\Repository\UsuarioRepository;
use SuppCore\AdministrativoBackend\Triggers\TriggerInterface;

/**
 * Class Trigger0004.
 *
 * @descSwagger= Ação de etiqueta para compartilhar tarefa com outro usuário.
 * @classeSwagger= Trigger0004
 */
class Trigger0004 implements TriggerInterface
{
    private CompartilhamentoResource $compartilhamentoResource;

    private UsuarioRepository $usuarioRepository;

    /**
     * Trigger0004 constructor.
     */
    public function __construct(
        CompartilhamentoResource $compartilhamentoResource,
        UsuarioRepository $usuarioRepository
    ) {
        $this->compartilhamentoResource = $compartilhamentoResource;
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
                $compartilhamentoDTO = new Compartilhamento();
                $compartilhamentoDTO->setUsuario(
                    $this->usuarioRepository->find(json_decode($acao->getContexto(), true)['usuarioId'])
                );
                $compartilhamentoDTO->setTarefa(
                    $vinculacaoEtiquetaDTO->getTarefa()
                );
                $this->compartilhamentoResource->create($compartilhamentoDTO, $transactionId);
            }
        }
    }

    public function getOrder(): int
    {
        return 1;
    }
}
