<?php

declare(strict_types=1);
/**
 * /src/Api/V1/DTO/AcaoTransicaoWorkflow.php.
 */

namespace SuppCore\AdministrativoBackend\Api\V1\DTO;

use Nelmio\ApiDocBundle\Annotation\Model;
use SuppCore\AdministrativoBackend\Api\V1\DTO\TipoAcaoWorkflow as TipoAcaoWorkflowDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\TransicaoWorkflow as TransicaoWorkflowDTO;
use SuppCore\AdministrativoBackend\DTO\RestDto;
use SuppCore\AdministrativoBackend\DTO\Traits\Blameable;
use SuppCore\AdministrativoBackend\DTO\Traits\IdUuid;
use SuppCore\AdministrativoBackend\DTO\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\DTO\Traits\Timeblameable;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\TipoAcaoWorkflow as TipoAcaoWorkflowEntity;
use SuppCore\AdministrativoBackend\Entity\TransicaoWorkflow as TransicaoWorkflowEntity;
use SuppCore\AdministrativoBackend\Form\Annotations as Form;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;
use OpenApi\Annotations as OA;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class AcaoTransicaoWorkflow.
 *
 * @DTOMapper\JsonLD(
 *     jsonLDId="/v1/administrativo/acao_transicao_workflow/{id}",
 *     jsonLDType="AcaoTransicaoWorkflow",
 *     jsonLDContext="/api/doc/#model-AcaoTransicaoWorkflow"
 * )
 *
 * @Form\Form()
 */
class AcaoTransicaoWorkflow extends RestDto
{
    use IdUuid;
    use Timeblameable;
    use Blameable;
    use Softdeleteable;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=false
     * )
     *
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $contexto = null;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\TransicaoWorkflow",
     *     required=true
     * )
     *
     * @OA\Property(ref=@Model(type=TransicaoWorkflowDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\TransicaoWorkflow")
     */
    protected ?EntityInterface $transicaoWorkflow = null;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\TipoAcaoWorkflow",
     *     required=true
     * )
     *
     * @OA\Property(ref=@Model(type=TipoAcaoWorkflowDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\TipoAcaoWorkflow")
     */
    protected ?EntityInterface $tipoAcaoWorkflow = null;

    /**
     * @return EntityInterface|TransicaoWorkflowDTO|TransicaoWorkflowEntity|null
     */
    public function getTransicaoWorkflow(): ?EntityInterface
    {
        return $this->transicaoWorkflow;
    }

    /**
     * @param EntityInterface|TransicaoWorkflowDTO|TransicaoWorkflowEntity|null $transicaoWorkflow
     */
    public function setTransicaoWorkflow(?EntityInterface $transicaoWorkflow): self
    {
        $this->setVisited('transicaoWorkflow');

        $this->transicaoWorkflow = $transicaoWorkflow;

        return $this;
    }

    public function getContexto(): ?string
    {
        return $this->contexto;
    }

    public function setContexto(?string $contexto): self
    {
        $this->setVisited('contexto');

        $this->contexto = $contexto;

        return $this;
    }

    /**
     * @return EntityInterface|TipoAcaoWorkflowDTO|TipoAcaoWorkflowEntity|null
     */
    public function getTipoAcaoWorkflow(): ?EntityInterface
    {
        return $this->tipoAcaoWorkflow;
    }

    /**
     * @param EntityInterface|TipoAcaoWorkflowDTO|TipoAcaoWorkflowEntity|null $tipoAcaoWorkflow
     */
    public function setTipoAcaoWorkflow(?EntityInterface $tipoAcaoWorkflow): self
    {
        $this->setVisited('tipoAcaoWorkflow');

        $this->tipoAcaoWorkflow = $tipoAcaoWorkflow;

        return $this;
    }
}
