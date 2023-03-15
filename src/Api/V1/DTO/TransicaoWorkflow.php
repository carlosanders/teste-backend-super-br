<?php

declare(strict_types=1);

namespace SuppCore\AdministrativoBackend\Api\V1\DTO;

use Nelmio\ApiDocBundle\Annotation\Model;
use SuppCore\AdministrativoBackend\Api\V1\DTO\EspecieAtividade as EspecieAtividadeDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\VinculacaoTransicaoWorkflow as VinculacaoTransicaoWorkflowDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\EspecieTarefa as EspecieTarefaDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Workflow as WorkflowDTO;
use SuppCore\AdministrativoBackend\DTO\RestDto;
use SuppCore\AdministrativoBackend\DTO\Traits\Blameable;
use SuppCore\AdministrativoBackend\DTO\Traits\IdUuid;
use SuppCore\AdministrativoBackend\DTO\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\DTO\Traits\Timeblameable;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\EspecieAtividade as EspecieAtividadeEntity;
use SuppCore\AdministrativoBackend\Entity\EspecieTarefa as EspecieTarefaEntity;
use SuppCore\AdministrativoBackend\Entity\Workflow as WorkflowEntity;
use SuppCore\AdministrativoBackend\Form\Annotations as Form;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;
use OpenApi\Annotations as OA;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as Serializer;

/**
 * Class TransicaoWorkflow.
 *
 * @author  Felipe Pena <felipe.pena@datainfo.inf.br>
 *
 * @DTOMapper\JsonLD(
 *     jsonLDId="/v1/administrativo/transicao_workflow/{id}",
 *     jsonLDType="TransicaoWorkflow",
 *     jsonLDContext="/api/doc/#model-TransicaoWorkflow"
 * )
 *
 * @Form\Form()
 */
class TransicaoWorkflow extends RestDto
{
    use Blameable;
    use Timeblameable;
    use Softdeleteable;
    use IdUuid;

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
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\EspecieAtividade",
     *     required=true
     * )
     *
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @OA\Property(ref=@Model(type=EspecieAtividadeDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\EspecieAtividade")
     */
    protected ?EntityInterface $especieAtividade = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\EspecieTarefa",
     *     required=true
     * )
     *
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @OA\Property(ref=@Model(type=EspecieTarefaDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\EspecieTarefa")
     */
    protected ?EntityInterface $especieTarefaFrom = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\EspecieTarefa",
     *     required=true
     * )
     *
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @OA\Property(ref=@Model(type=EspecieTarefaDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\EspecieTarefa")
     */
    protected ?EntityInterface $especieTarefaTo = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\NumberType",
     *     required=true
     * )
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @OA\Property(type="integer")
     * @DTOMapper\Property()
     */
    protected ?int $qtdDiasPrazo = null;

    /**
     * @var VinculacaoTransicaoWorkflowDTO[]
     *
     * @Serializer\SkipWhenEmpty()
     *
     * @DTOMapper\Property(
     *     dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\VinculacaoTransicaoWorkflow",
     *     collection=true,
     *     dtoSetter="addVinculacaoTransicaoWorkflow",
     *     dtoGetter="getVinculacoesTransicaoWorkflow"
     * )
     */
    protected array $vinculacoesTransicaoWorkflow = [];

    /**
     * @return EntityInterface|null
     */
    public function getWorkflow(): ?EntityInterface
    {
        return $this->workflow;
    }

    /**
     * @param EntityInterface|null $workflow
     * @return TransicaoWorkflow
     */
    public function setWorkflow(?EntityInterface $workflow): TransicaoWorkflow
    {
        $this->workflow = $workflow;

        $this->setVisited('workflow');

        return $this;
    }

    /**
     * @return EntityInterface|null
     */
    public function getEspecieAtividade(): ?EntityInterface
    {
        return $this->especieAtividade;
    }

    /**
     * @param EntityInterface|null $especieAtividade
     * @return TransicaoWorkflow
     */
    public function setEspecieAtividade(?EntityInterface $especieAtividade): TransicaoWorkflow
    {
        $this->especieAtividade = $especieAtividade;

        $this->setVisited('especieAtividade');

        return $this;
    }

    /**
     * @return EntityInterface|null
     */
    public function getEspecieTarefaFrom(): ?EntityInterface
    {
        return $this->especieTarefaFrom;
    }

    /**
     * @param EntityInterface|null $especieTarefaFrom
     * @return TransicaoWorkflow
     */
    public function setEspecieTarefaFrom(?EntityInterface $especieTarefaFrom): TransicaoWorkflow
    {
        $this->especieTarefaFrom = $especieTarefaFrom;

        $this->setVisited('especieTarefaFrom');

        return $this;
    }

    /**
     * @return EntityInterface|null
     */
    public function getEspecieTarefaTo(): ?EntityInterface
    {
        return $this->especieTarefaTo;
    }

    /**
     * @param EntityInterface|null $especieTarefaTo
     * @return TransicaoWorkflow
     */
    public function setEspecieTarefaTo(?EntityInterface $especieTarefaTo): TransicaoWorkflow
    {
        $this->especieTarefaTo = $especieTarefaTo;

        $this->setVisited('especieTarefaTo');

        return $this;
    }

    /**
     * @return int|null
     */
    public function getQtdDiasPrazo(): ?int
    {
        return $this->qtdDiasPrazo;
    }

    /**
     * @param int|null $qtdDiasPrazo
     * @return TransicaoWorkflow
     */
    public function setQtdDiasPrazo(?int $qtdDiasPrazo): TransicaoWorkflow
    {
        $this->qtdDiasPrazo = $qtdDiasPrazo;
        $this->setVisited('qtdDiasPrazo');

        return $this;
    }

    /**
     * @return VinculacaoTransicaoWorkflowDTO[]
     */
    public function getVinculacoesTransicaoWorkflow(): array
    {
        return $this->vinculacoesTransicaoWorkflow;
    }

    /**
     * @param VinculacaoTransicaoWorkflowDTO $vinculacaoTransicaoWorkflow
     * @return $this
     */
    public function addVinculacaoTransicaoWorkflow(
        VinculacaoTransicaoWorkflowDTO $vinculacaoTransicaoWorkflow
    ): self {
        $this->vinculacoesTransicaoWorkflow[] = $vinculacaoTransicaoWorkflow;

        return $this;
    }

}
