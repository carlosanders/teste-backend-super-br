<?php

declare(strict_types=1);
/**
 * /src/Api/V1/DTO/VinculacaoEtiqueta.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\DTO;

use Nelmio\ApiDocBundle\Annotation\Model;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Documento as DocumentoDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\DocumentoAvulso as DocumentoAvulsoDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Etiqueta as EtiquetaDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Processo as ProcessoDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Relatorio as RelatorioDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Tarefa as TarefaDTO;
use SuppCore\AdministrativoBackend\DTO\RestDto;
use SuppCore\AdministrativoBackend\DTO\Traits as Traits;
use SuppCore\AdministrativoBackend\Entity\Documento as DocumentoEntity;
use SuppCore\AdministrativoBackend\Entity\DocumentoAvulso as DocumentoAvulsoEntity;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\Processo as ProcessoEntity;
use SuppCore\AdministrativoBackend\Entity\Relatorio as RelatorioEntity;
use SuppCore\AdministrativoBackend\Entity\Tarefa as TarefaEntity;
use SuppCore\AdministrativoBackend\Form\Annotations as Form;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;
use OpenApi\Annotations as OA;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * Class VinculacaoEtiqueta.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @DTOMapper\JsonLD(
 *     jsonLDId="/v1/administrativo/vinculacao_etiqueta/{id}",
 *     jsonLDType="VinculacaoEtiqueta",
 *     jsonLDContext="/api/doc/#model-VinculacaoEtiqueta"
 * )
 *
 * @Form\Form()
 */
class VinculacaoEtiqueta extends RestDto
{
    use Traits\VinculacaoEtiqueta;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Etiqueta",
     *     required=true,
     *     methods={
     *          @Form\Method(
     *              "createMethod"
     *          ),
     *          @Form\Method(
     *              "updateMethod",
     *              roles={
     *                  "ROLE_ROOT"
     *              }
     *          ),
     *          @Form\Method(
     *              "patchMethod",
     *              roles={
     *                  "ROLE_ROOT"
     *              }
     *          )
     *     }
     * )
     *
     * @OA\Property(ref=@Model(type=EtiquetaDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Etiqueta")
     */
    protected ?EntityInterface $etiqueta = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Tarefa",
     *     required=false,
     *     methods={
     *          @Form\Method(
     *              "createMethod"
     *          ),
     *          @Form\Method(
     *              "updateMethod",
     *              roles={
     *                  "ROLE_ROOT"
     *              }
     *          ),
     *          @Form\Method(
     *              "patchMethod",
     *              roles={
     *                  "ROLE_ROOT"
     *              }
     *          )
     *     }
     * )
     *
     * @OA\Property(ref=@Model(type=TarefaDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Tarefa")
     */
    protected ?EntityInterface $tarefa = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Documento",
     *     required=false,
     *     methods={
     *          @Form\Method(
     *              "createMethod"
     *          ),
     *          @Form\Method(
     *              "updateMethod",
     *              roles={
     *                  "ROLE_ROOT"
     *              }
     *          ),
     *          @Form\Method(
     *              "patchMethod",
     *              roles={
     *                  "ROLE_ROOT"
     *              }
     *          )
     *     }
     * )
     *
     * @OA\Property(ref=@Model(type=DocumentoDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Documento")
     */
    protected ?EntityInterface $documento = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Processo",
     *     required=false,
     *     methods={
     *          @Form\Method(
     *              "createMethod"
     *          ),
     *          @Form\Method(
     *              "updateMethod",
     *              roles={
     *                  "ROLE_ROOT"
     *              }
     *          ),
     *          @Form\Method(
     *              "patchMethod",
     *              roles={
     *                  "ROLE_ROOT"
     *              }
     *          )
     *     }
     * )
     *
     * @OA\Property(ref=@Model(type=ProcessoDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Processo")
     */
    protected ?EntityInterface $processo = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\DocumentoAvulso",
     *     required=false,
     *     methods={
     *          @Form\Method(
     *              "createMethod"
     *          ),
     *          @Form\Method(
     *              "updateMethod",
     *              roles={
     *                  "ROLE_ROOT"
     *              }
     *          ),
     *          @Form\Method(
     *              "patchMethod",
     *              roles={
     *                  "ROLE_ROOT"
     *              }
     *          )
     *     }
     * )
     *
     * @OA\Property(ref=@Model(type=DocumentoAvulsoDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\DocumentoAvulso")
     */
    protected ?EntityInterface $documentoAvulso = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Relatorio",
     *     required=false
     * )
     *
     * @OA\Property(ref=@Model(type=RelatorioDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Relatorio")
     */
    protected ?EntityInterface $relatorio = null;

    /**
     * @return EntityInterface|TarefaDTO|TarefaEntity|null
     */
    public function getTarefa(): ?EntityInterface
    {
        return $this->tarefa;
    }

    /**
     * @param EntityInterface|TarefaDTO|TarefaEntity|null $tarefa
     */
    public function setTarefa(?EntityInterface $tarefa): self
    {
        $this->setVisited('tarefa');

        $this->tarefa = $tarefa;

        return $this;
    }

    /**
     * @return EntityInterface|DocumentoDTO|DocumentoEntity|null
     */
    public function getDocumento(): ?EntityInterface
    {
        return $this->documento;
    }

    /**
     * @param EntityInterface|DocumentoDTO|DocumentoEntity|null $documento
     */
    public function setDocumento(?EntityInterface $documento): self
    {
        $this->setVisited('documento');

        $this->documento = $documento;

        return $this;
    }

    /**
     * @return EntityInterface|ProcessoDTO|ProcessoEntity|null
     */
    public function getProcesso(): ?EntityInterface
    {
        return $this->processo;
    }

    /**
     * @param EntityInterface|ProcessoDTO|ProcessoEntity|null $processo
     */
    public function setProcesso(?EntityInterface $processo): self
    {
        $this->setVisited('processo');

        $this->processo = $processo;

        return $this;
    }

    /**
     * @return EntityInterface|DocumentoAvulsoDTO|DocumentoAvulsoEntity|null
     */
    public function getDocumentoAvulso(): ?EntityInterface
    {
        return $this->documentoAvulso;
    }

    /**
     * @param EntityInterface|DocumentoAvulsoDTO|DocumentoAvulsoEntity|null $documentoAvulso
     */
    public function setDocumentoAvulso(?EntityInterface $documentoAvulso): self
    {
        $this->setVisited('documentoAvulso');

        $this->documentoAvulso = $documentoAvulso;

        return $this;
    }

    /**
     * @return EntityInterface|RelatorioDTO|RelatorioEntity|null
     */
    public function getRelatorio(): ?EntityInterface
    {
        return $this->relatorio;
    }

    /**
     * @param EntityInterface|RelatorioDTO|RelatorioEntity|null $relatorio
     */
    public function setRelatorio(?EntityInterface $relatorio): self
    {
        $this->setVisited('relatorio');

        $this->relatorio = $relatorio;

        return $this;
    }

    /**
     * @Assert\Callback
     */
    public function isValid(ExecutionContextInterface $context): void
    {
        $campos = [
            $this->getUsuario(),
            $this->getSetor(),
            $this->getModalidadeOrgaoCentral(),
            $this->getUnidade(),
            $this->getTarefa(),
            $this->getProcesso(),
            $this->getDocumento(),
            $this->getDocumentoAvulso(),
            $this->getRelatorio(),
            $this->getExtensionObjectClass()
        ];

        // Limpa os campos vazios
        $camposPreenchidos = array_filter($campos);

        if (count($camposPreenchidos) > 1) {
            $context
                ->buildViolation('A vinculacaoEtiqueta deve ser realizada com apenas um vínculo')
                ->atPath('id')
                ->addViolation();
        }

        if (!count($camposPreenchidos)) {
            $context
                ->buildViolation('A vinculacaoEtiqueta deve ter um vínculo')
                ->atPath('id')
                ->addViolation();
        }
    }
}
