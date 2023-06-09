<?php

declare(strict_types=1);
/**
 * /src/Api/V1/DTO/VinculacaoWorkflow.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\DTO;

use Nelmio\ApiDocBundle\Annotation\Model;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Workflow as WorkflowDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Tarefa as TarefaDTO;
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
 * Class VinculacaoWorkflow.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @DTOMapper\JsonLD(
 *     jsonLDId="/v1/administrativo/vinculacao_workflow/{id}",
 *     jsonLDType="VinculacaoWorkflow",
 *     jsonLDContext="/api/doc/#model-VinculacaoWorkflow"
 * )
 *
 * @AppAssert\DtoUniqueEntity(
 *     fieldMapping = {"workflow": "workflow", "tarefaInicial": "tarefaInicial"},
 *     entityClass="SuppCore\AdministrativoBackend\Entity\VinculacaoWorkflow",
 *     message = "O Workflow já está vinculado a uma Tarefa!"
 * )
 *
 * @Form\Form()
 */
class VinculacaoWorkflow extends RestDto
{
    use IdUuid;
    use Timeblameable;
    use Blameable;
    use Softdeleteable;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Tarefa",
     *     required=true
     * )
     *
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @OA\Property(ref=@Model(type=TarefaDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Tarefa")
     */
    protected ?EntityInterface $tarefaInicial = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Tarefa",
     *     required=true
     * )
     *
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @OA\Property(ref=@Model(type=TarefaDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Tarefa")
     */
    protected ?EntityInterface $tarefaAtual = null;

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
     *     "Symfony\Component\Form\Extension\Core\Type\CheckboxType",
     *     required=false
     * )
     *
     * @OA\Property(type="boolean", default=false)
     * @DTOMapper\Property()
     */
    protected ?bool $concluido = false;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\CheckboxType",
     *     required=false
     * )
     *
     * @OA\Property(type="boolean", default=false)
     */
    protected ?bool $transicaoFinalWorkflow = false;

    /**
     * @return EntityInterface|null
     */
    public function getTarefaInicial(): ?EntityInterface
    {
        return $this->tarefaInicial;
    }

    /**
     * @param EntityInterface|null $tarefaInicial
     * @return VinculacaoWorkflow
     */
    public function setTarefaInicial(?EntityInterface $tarefaInicial): self
    {
        $this->setVisited('tarefaInicial');
        $this->tarefaInicial = $tarefaInicial;

        return $this;
    }

    /**
     * @return EntityInterface|null
     */
    public function getTarefaAtual(): ?EntityInterface
    {
        return $this->tarefaAtual;
    }

    /**
     * @param EntityInterface|null $tarefaAtual
     * @return VinculacaoWorkflow
     */
    public function setTarefaAtual(?EntityInterface $tarefaAtual): self
    {
        $this->setVisited('tarefaAtual');
        $this->tarefaAtual = $tarefaAtual;

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
     * @return VinculacaoWorkflow
     */
    public function setWorkflow(?EntityInterface $workflow): self
    {
        $this->setVisited('workflow');
        $this->workflow = $workflow;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getConcluido(): ?bool
    {
        return $this->concluido;
    }

    /**
     * @param bool|null $concluido
     * @return VinculacaoWorkflow
     */
    public function setConcluido(?bool $concluido): self
    {
        $this->setVisited('concluido');
        $this->concluido = $concluido;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getTransicaoFinalWorkflow(): ?bool
    {
        return $this->transicaoFinalWorkflow;
    }

    /**
     * @param bool|null $transicaoFinalWorkflow
     * @return $this
     */
    public function setTransicaoFinalWorkflow(?bool $transicaoFinalWorkflow): self
    {
        $this->setVisited('transicaoFinalWorkflow');
        $this->transicaoFinalWorkflow = $transicaoFinalWorkflow;

        return $this;
    }
}
