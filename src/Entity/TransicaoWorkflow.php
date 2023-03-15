<?php

declare(strict_types=1);

namespace SuppCore\AdministrativoBackend\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Gedmo\Mapping\Annotation as Gedmo;
use SuppCore\AdministrativoBackend\Entity\Traits\Blameable;
use SuppCore\AdministrativoBackend\Entity\Traits\Id;
use SuppCore\AdministrativoBackend\Entity\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\Entity\Traits\Timestampable;
use SuppCore\AdministrativoBackend\Entity\Traits\Uuid;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Class TransicaoWorkflow.
 *
 *  @ORM\Table(
 *     name="ad_transicao_workflow",
 *     uniqueConstraints={
 *          @ORM\UniqueConstraint(
 *              columns={"workflow_id", "especie_tarefa_from_id", "especie_atividade_id", "apagado_em"}
 *          )
 *     }
 * )
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 * @UniqueEntity(
 *     fields = {"workflow", "especieTarefaFrom", "especieAtividade", "apagadoEm"},
 *     message = "Não é possível cadastrar mais de uma transição para um workflow com a mesma especie de tarefa inicial
 *                e especie de atividade!"
 * )
 * @Gedmo\Loggable
 *
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 *
 * @author  Felipe Pena <felipe.pena@datainfo.inf.br>
 */
class TransicaoWorkflow implements EntityInterface
{
    use Blameable;
    use Timestampable;
    use Softdeleteable;
    use Id;
    use Uuid;

    /**
     * Constructor.
     *
     * @throws Exception
     */
    public function __construct()
    {
        $this->setUuid();
        $this->acoes = new ArrayCollection();
        $this->validacoes = new ArrayCollection();
        $this->vinculacoesTransicaoWorkflow = new ArrayCollection();
        $this->vinculacoesWorkflow = new ArrayCollection();
    }

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @Gedmo\Versioned
     *
     * @ORM\ManyToOne(
     *     targetEntity="Workflow",
     *     inversedBy="transicoesWorkflow"
     * )
     * @ORM\JoinColumn(
     *     name="workflow_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected ?Workflow $workflow = null;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @Gedmo\Versioned
     *
     * @ORM\ManyToOne(
     *     targetEntity="EspecieAtividade",
     *     inversedBy="transicoesWorkflow"
     * )
     *
     * @ORM\JoinColumn(
     *     name="especie_atividade_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected ?EspecieAtividade $especieAtividade = null;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @Gedmo\Versioned
     *
     * @ORM\ManyToOne(
     *     targetEntity="EspecieTarefa",
     *     inversedBy="transicoesWorkflowFrom"
     * )
     * @ORM\JoinColumn(
     *     name="especie_tarefa_from_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected ?EspecieTarefa $especieTarefaFrom = null;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @Gedmo\Versioned
     *
     * @ORM\ManyToOne(
     *     targetEntity="EspecieTarefa",
     *     inversedBy="transicoesWorkflowTo"
     * )
     * @ORM\JoinColumn(
     *     name="especie_tarefa_to_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected ?EspecieTarefa $especieTarefaTo = null;

    /**
     * @var Collection|ArrayCollection<VinculacaoTransicaoWorkflow>
     *
     * @ORM\OneToMany(
     *     targetEntity="VinculacaoTransicaoWorkflow",
     *     mappedBy="transicaoWorkflow",
     *     cascade={"all"}
     * )
     */
    protected ArrayCollection|Collection $vinculacoesTransicaoWorkflow;

    /**
     * @var Collection<VinculacaoWorkflow>|ArrayCollection<VinculacaoWorkflow>
     *
     * @ORM\OneToMany(
     *     targetEntity="VinculacaoWorkflow",
     *     mappedBy="workflow",
     *     cascade={"all"}
     * )
     */
    protected ArrayCollection|Collection $vinculacoesWorkflow;

    /**
     * @var Collection|ArrayCollection<AcaoTransicaoWorkflow>
     *
     * @ORM\OneToMany(
     *     targetEntity="AcaoTransicaoWorkflow",
     *     mappedBy="transicaoWorkflow"
     * )
     */
    protected ArrayCollection|Collection $acoes;

    /**
     * @var Collection<ValidacaoTransicaoWorkflow>|ArrayCollection<ValidacaoTransicaoWorkflow>
     *
     * @ORM\OneToMany(
     *     targetEntity="ValidacaoTransicaoWorkflow",
     *     mappedBy="transicaoWorkflow"
     * )
     */
    protected Collection|ArrayCollection $validacoes;

    /**
     * @ORM\Column(
     *     name="qtd_dias_prazo",
     *     type="integer",
     *     nullable=true
     * )
     */
    protected ?int  $qtdDiasPrazo = null;

    /**
     * @return Workflow
     */
    public function getWorkflow(): Workflow
    {
        return $this->workflow;
    }

    /**
     * @param Workflow $workflow
     *
     * @return $this
     */
    public function setWorkflow(Workflow $workflow): self
    {
        $this->workflow = $workflow;

        return $this;
    }

    /**
     * @return EspecieAtividade
     */
    public function getEspecieAtividade(): EspecieAtividade
    {
        return $this->especieAtividade;
    }

    /**
     * @param EspecieAtividade $especieAtividade
     *
     * @return $this
     */
    public function setEspecieAtividade(EspecieAtividade $especieAtividade): self
    {
        $this->especieAtividade = $especieAtividade;

        return $this;
    }

    /**
     * @return EspecieTarefa
     */
    public function getEspecieTarefaFrom(): EspecieTarefa
    {
        return $this->especieTarefaFrom;
    }

    /**
     * @param EspecieTarefa $especieTarefaFrom
     *
     * @return $this
     */
    public function setEspecieTarefaFrom(EspecieTarefa $especieTarefaFrom): self
    {
        $this->especieTarefaFrom = $especieTarefaFrom;

        return $this;
    }

    /**
     * @return EspecieTarefa
     */
    public function getEspecieTarefaTo(): EspecieTarefa
    {
        return $this->especieTarefaTo;
    }

    /**
     * @param EspecieTarefa $especieTarefaTo
     *
     * @return $this
     */
    public function setEspecieTarefaTo(EspecieTarefa $especieTarefaTo): self
    {
        $this->especieTarefaTo = $especieTarefaTo;

        return $this;
    }

    /**
     * @return ArrayCollection<AcaoTransicaoWorkflow>|Collection
     */
    public function getAcoes():Collection|ArrayCollection
    {
        return $this->acoes;
    }

    /**
     * @return ArrayCollection|Collection
     */
    public function getValidacoes():Collection|ArrayCollection
    {
        return $this->validacoes;
    }

    /**
     * @param ValidacaoTransicaoWorkflow $validacaoTransicaoWorkflow
     *
     * @return $this
     */
    public function addValidacao(ValidacaoTransicaoWorkflow $validacaoTransicaoWorkflow): self
    {
        if (!$this->validacoes->contains($validacaoTransicaoWorkflow)) {
            $this->validacoes->add($validacaoTransicaoWorkflow);
            $validacaoTransicaoWorkflow->setTransicaoWorkflow($this);
        }

        return $this;
    }

    /**
     * @param ValidacaoTransicaoWorkflow $validacaoTransicaoWorkflow
     *
     * @return $this
     */
    public function removeValidacao(ValidacaoTransicaoWorkflow $validacaoTransicaoWorkflow): self
    {
        if ($this->validacoes->contains($validacaoTransicaoWorkflow)) {
            $this->validacoes->removeElement($validacaoTransicaoWorkflow);
        }

        return $this;
    }

    /**
     * @param AcaoTransicaoWorkflow $acaoTransicaoWorkflow
     *
     * @return $this
     */
    public function addAcao(AcaoTransicaoWorkflow $acaoTransicaoWorkflow): self
    {
        if (!$this->acoes->contains($acaoTransicaoWorkflow)) {
            $this->acoes->add($acaoTransicaoWorkflow);
            $acaoTransicaoWorkflow->setTransicaoWorkflow($this);
        }

        return $this;
    }

    /**
     * @param AcaoTransicaoWorkflow $acaoTransicaoWorkflow
     *
     * @return $this
     */
    public function removeAcao(AcaoTransicaoWorkflow $acaoTransicaoWorkflow): self
    {
        if ($this->acoes->contains($acaoTransicaoWorkflow)) {
            $this->acoes->removeElement($acaoTransicaoWorkflow);
        }

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
     * @return $this
     */
    public function setQtdDiasPrazo(?int $qtdDiasPrazo): self
    {
        $this->qtdDiasPrazo = $qtdDiasPrazo;

        return $this;
    }

    /**
     * @return Collection<VinculacaoTransicaoWorkflow>|ArrayCollection<VinculacaoTransicaoWorkflow>
     */
    public function getVinculacoesTransicaoWorkflow(): ArrayCollection|Collection
    {
        return $this->vinculacoesTransicaoWorkflow;
    }

    /**
     * @param VinculacaoTransicaoWorkflow $vinculacaoTransicaoWorkflow
     * @return $this
     */
    public function addVinculacaoTransicaoWorkflow(
        VinculacaoTransicaoWorkflow $vinculacaoTransicaoWorkflow
    ): self
    {
        if (!$this->vinculacoesTransicaoWorkflow->contains($vinculacaoTransicaoWorkflow)) {
            $this->vinculacoesTransicaoWorkflow->add($vinculacaoTransicaoWorkflow);
            $vinculacaoTransicaoWorkflow->setTransicaoWorkflow($this);
        }

        return $this;
    }

    /**
     * @param VinculacaoTransicaoWorkflow $vinculacaoTransicaoWorkflow
     * @return $this
     */
    public function removeVinculacaoTransicaoWorkflow(
        VinculacaoTransicaoWorkflow $vinculacaoTransicaoWorkflow
    ): self
    {
        if ($this->vinculacoesTransicaoWorkflow->contains($vinculacaoTransicaoWorkflow)) {
            $this->vinculacoesTransicaoWorkflow->removeElement($vinculacaoTransicaoWorkflow);
        }

        return $this;
    }

    /**
     * @return Collection<VinculacaoWorkflow>|ArrayCollection<VinculacaoWorkflow>
     */
    public function getVinculacoesWorkflow(): ArrayCollection|Collection
    {
        return $this->vinculacoesWorkflow;
    }

    /**
     * @param VinculacaoWorkflow $vinculacaoWorkflow
     * @return $this
     */
    public function addVinculacaoWorkflow(
        VinculacaoWorkflow $vinculacaoWorkflow
    ): self
    {
        if (!$this->vinculacoesWorkflow->contains($vinculacaoWorkflow)) {
            $this->vinculacoesWorkflow->add($vinculacaoWorkflow);
        }

        return $this;
    }

    /**
     * @param VinculacaoWorkflow $vinculacaoWorkflow
     * @return $this
     */
    public function removeVinculacaoWorkflow(
        VinculacaoWorkflow $vinculacaoWorkflow
    ): self
    {
        if ($this->vinculacoesWorkflow->contains($vinculacaoWorkflow)) {
            $this->vinculacoesWorkflow->removeElement($vinculacaoWorkflow);
        }

        return $this;
    }
}
