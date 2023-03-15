<?php

declare(strict_types=1);

namespace SuppCore\AdministrativoBackend\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Gedmo\Mapping\Annotation as Gedmo;
use SuppCore\AdministrativoBackend\Entity\Traits\Blameable;
use SuppCore\AdministrativoBackend\Entity\Traits\Descricao;
use SuppCore\AdministrativoBackend\Entity\Traits\Id;
use SuppCore\AdministrativoBackend\Entity\Traits\Nome;
use SuppCore\AdministrativoBackend\Entity\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\Entity\Traits\Timestampable;
use SuppCore\AdministrativoBackend\Entity\Traits\Uuid;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Class Workflow.
 *
 *  @ORM\Table(
 *     name="ad_workflow",
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(columns={"nome", "apagado_em"}),
 *     }
 * )
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @Gedmo\Loggable
 *
 * @UniqueEntity(
 *     fields = {"nome"},
 *     message = "Nome já está em utilização!"
 * )
 *
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 *
 * @author  Felipe Pena <felipe.pena@datainfo.inf.br>
 */
class Workflow implements EntityInterface
{
    use Blameable;
    use Timestampable;
    use Softdeleteable;
    use Nome;
    use Descricao;
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
        $this->transicoesWorkflow = new ArrayCollection();
        $this->vinculacoesEspecieProcessoWorkflow = new ArrayCollection();
        $this->vinculacoesWorkflow = new ArrayCollection();
        $this->vinculacoesTransicaoWorkflow = new ArrayCollection();
    }

    /**
     * @var Collection<VinculacaoEspecieProcessoWorkflow>|ArrayCollection<VinculacaoEspecieProcessoWorkflow>
     *
     * @ORM\OneToMany(
     *     targetEntity="VinculacaoEspecieProcessoWorkflow",
     *     mappedBy="workflow",
     *     cascade={"all"}
     * )
     */
    protected ArrayCollection|Collection $vinculacoesEspecieProcessoWorkflow;

    /**
     * @var Collection<VinculacaoWorkflow>|ArrayCollection<VinculacaoWorkflow>
     *
     * @ORM\OneToMany(
     *     targetEntity="VinculacaoWorkflow",
     *     mappedBy="workflow"
     * )
     */
    protected Collection|ArrayCollection $vinculacoesWorkflow;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @Gedmo\Versioned
     *
     * @ORM\ManyToOne(
     *     targetEntity="EspecieTarefa",
     *     inversedBy="workflows"
     * )
     *
     * @ORM\JoinColumn(
     *     name="especie_tarefa_inicial_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected ?EspecieTarefa $especieTarefaInicial = null;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @Gedmo\Versioned
     *
     * @ORM\ManyToOne(
     *     targetEntity="GeneroProcesso",
     *     inversedBy="workflows"
     * )
     *
     * @ORM\JoinColumn(
     *     name="genero_processo_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected ?GeneroProcesso $generoProcesso = null;

    /**
     * @var Collection<TransicaoWorkflow>|ArrayCollection<TransicaoWorkflow>
     *
     * @ORM\OneToMany(
     *     targetEntity="TransicaoWorkflow",
     *     mappedBy="workflow"
     * )
     */
    protected Collection|ArrayCollection $transicoesWorkflow;

    /**
     * @var Collection<VinculacaoTransicaoWorkflow>|ArrayCollection<VinculacaoTransicaoWorkflow>
     *
     * @ORM\OneToMany(
     *     targetEntity="VinculacaoTransicaoWorkflow",
     *     mappedBy="workflow"
     * )
     */
    protected Collection|ArrayCollection $vinculacoesTransicaoWorkflow;

    /**
     * @return EspecieTarefa
     */
    public function getEspecieTarefaInicial(): EspecieTarefa
    {
        return $this->especieTarefaInicial;
    }

    /**
     * @param EspecieTarefa $especieTarefaInicial
     *
     * @return $this
     */
    public function setEspecieTarefaInicial(EspecieTarefa $especieTarefaInicial): self
    {
        $this->especieTarefaInicial = $especieTarefaInicial;

        return $this;
    }

    /**
     * @param TransicaoWorkflow $transicaoWorkflow
     *
     * @return $this
     */
    public function addTransicaoWorkflow(TransicaoWorkflow $transicaoWorkflow): self
    {
        if (!$this->transicoesWorkflow->contains($transicaoWorkflow)) {
            $this->transicoesWorkflow[] = $transicaoWorkflow;
            $transicaoWorkflow->setWorkflow($this);
        }

        return $this;
    }

    /**
     * @param TransicaoWorkflow $transicaoWorkflow
     *
     * @return $this
     */
    public function removeTransicaoWorkflow(TransicaoWorkflow $transicaoWorkflow): self
    {
        if ($this->transicoesWorkflow->contains($transicaoWorkflow)) {
            $this->transicoesWorkflow->removeElement($transicaoWorkflow);
        }

        return $this;
    }

    /**
     * @return Collection<TransicaoWorkflow>|ArrayCollection<TransicaoWorkflow>
     */
    public function getTransicoesWorkflow(): Collection|ArrayCollection
    {
        return $this->transicoesWorkflow;
    }

    /**
     * @return Collection<VinculacaoEspecieProcessoWorkflow>|ArrayCollection<VinculacaoEspecieProcessoWorkflow>
     */
    public function getVinculacoesEspecieProcessoWorkflow(): ArrayCollection|Collection
    {
        return $this->vinculacoesEspecieProcessoWorkflow;
    }

    /**
     * @param VinculacaoEspecieProcessoWorkflow $vinculacaoEspecieProcessoWorkflow
     * @return $this
     */
    public function addVinculacaoEspecieProcessoWorkflow(
        VinculacaoEspecieProcessoWorkflow $vinculacaoEspecieProcessoWorkflow
    ): self
    {
        if (!$this->vinculacoesEspecieProcessoWorkflow->contains($vinculacaoEspecieProcessoWorkflow)) {
            $this->vinculacoesEspecieProcessoWorkflow->add($vinculacaoEspecieProcessoWorkflow);
            $vinculacaoEspecieProcessoWorkflow->setWorkflow($this);
        }

        return $this;
    }

    /**
     * @param VinculacaoEspecieProcessoWorkflow $vinculacaoEspecieProcessoWorkflow
     * @return $this
     */
    public function removeVinculacaoEspecieProcessoWorkflow(
        VinculacaoEspecieProcessoWorkflow $vinculacaoEspecieProcessoWorkflow
    ): self
    {
        if ($this->vinculacoesEspecieProcessoWorkflow->contains($vinculacaoEspecieProcessoWorkflow)) {
            $this->vinculacoesEspecieProcessoWorkflow->removeElement($vinculacaoEspecieProcessoWorkflow);
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
    public function addVinculacaoWorkflow(VinculacaoWorkflow $vinculacaoWorkflow): self
    {
        if (!$this->vinculacoesWorkflow->contains($vinculacaoWorkflow)) {
            $this->vinculacoesWorkflow->add($vinculacaoWorkflow);
            $vinculacaoWorkflow->setWorkflow($this);
        }

        return $this;
    }

    /**
     * @param VinculacaoWorkflow $vinculacaoWorkflow
     * @return $this
     */
    public function removeVinculacaoWorkflow(VinculacaoWorkflow $vinculacaoWorkflow): self
    {
        if ($this->vinculacoesWorkflow->contains($vinculacaoWorkflow)) {
            $this->vinculacoesWorkflow->removeElement($vinculacaoWorkflow);
        }

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
    public function addVinculacaoTransicaoWorkflow(VinculacaoTransicaoWorkflow $vinculacaoTransicaoWorkflow): self
    {
        if (!$this->vinculacoesTransicaoWorkflow->contains($vinculacaoTransicaoWorkflow)) {
            $this->vinculacoesTransicaoWorkflow->add($vinculacaoTransicaoWorkflow);
            $vinculacaoTransicaoWorkflow->setWorkflow($this);
        }

        return $this;
    }

    /**
     * @param VinculacaoTransicaoWorkflow $vinculacaoTransicaoWorkflow
     * @return $this
     */
    public function removeVinculacaoTransicaoWorkflow(VinculacaoTransicaoWorkflow $vinculacaoTransicaoWorkflow): self
    {
        if ($this->vinculacoesTransicaoWorkflow->contains($vinculacaoTransicaoWorkflow)) {
            $this->vinculacoesTransicaoWorkflow->removeElement($vinculacaoTransicaoWorkflow);
        }

        return $this;
    }

    /**
     * @return GeneroProcesso|null
     */
    public function getGeneroProcesso(): ?GeneroProcesso
    {
        return $this->generoProcesso;
    }

    /**
     * @param GeneroProcesso|null $generoProcesso
     * @return self
     */
    public function setGeneroProcesso(?GeneroProcesso $generoProcesso): self
    {
        $this->generoProcesso = $generoProcesso;

        return $this;
    }
}
