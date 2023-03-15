<?php

declare(strict_types=1);
/**
 * /src/Api/V1/DTO/VinculacaoTransicaoWorkflow.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\DTO;

use Nelmio\ApiDocBundle\Annotation\Model;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Workflow as WorkflowDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\TransicaoWorkflow as TransicaoWorkflowDTO;
use SuppCore\AdministrativoBackend\DTO\RestDto;
use SuppCore\AdministrativoBackend\DTO\Traits\Blameable;
use SuppCore\AdministrativoBackend\DTO\Traits\IdUuid;
use SuppCore\AdministrativoBackend\DTO\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\DTO\Traits\Timeblameable;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Form\Annotations as Form;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;
use SuppCore\AdministrativoBackend\Validator\Constraints as AppAssert;
use OpenApi\Annotations as OA;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class VinculacaoTransicaoWorkflow.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @DTOMapper\JsonLD(
 *     jsonLDId="/v1/administrativo/vinculacao_transicao_workflow/{id}",
 *     jsonLDType="VinculacaoTransicaoWorkflow",
 *     jsonLDContext="/api/doc/#model-VinculacaoTransicaoWorkflow"
 * )
 *
 * @AppAssert\DtoUniqueEntity(
 *     fieldMapping = {"workflow": "workflow", "transicaoWorkflow": "transicaoWorkflow"},
 *     entityClass="SuppCore\AdministrativoBackend\Entity\VinculacaoTransicaoWorkflow",
 *     message = "A transição já está vinculada a um Workflow!"
 * )
 *
 * @Form\Form()
 */
class VinculacaoTransicaoWorkflow extends RestDto
{
    use IdUuid;
    use Timeblameable;
    use Blameable;
    use Softdeleteable;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\TransicaoWorkflow",
     *     required=true
     * )
     *
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @OA\Property(ref=@Model(type=TransicaoWorkflowDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\TransicaoWorkflow")
     */
    protected ?EntityInterface $transicaoWorkflow = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Workflow",
     *     required=true
     * )
     *
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @OA\Property(ref=@Model(type=WorkflowDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Workflow")
     */
    protected ?EntityInterface $workflow = null;

    /**
     * @return EntityInterface|null
     */
    public function getTransicaoWorkflow(): ?EntityInterface
    {
        return $this->transicaoWorkflow;
    }

    /**
     * @param EntityInterface|null $transicaoWorkflow
     * @return VinculacaoTransicaoWorkflow
     */
    public function setTransicaoWorkflow(?EntityInterface $transicaoWorkflow): self
    {
        $this->setVisited('transicaoWorkflow');
        $this->transicaoWorkflow = $transicaoWorkflow;

        return $this;
    }

    /**
     * @return EntityInterface|null
     */
    public function getWorkflow(): ?EntityInterface
    {
        return $this->workflow;
    }

    /**
     * @param EntityInterface|null $workflow
     * @return VinculacaoTransicaoWorkflow
     */
    public function setWorkflow(?EntityInterface $workflow): self
    {
        $this->setVisited('workflow');
        $this->workflow = $workflow;

        return $this;
    }

}
