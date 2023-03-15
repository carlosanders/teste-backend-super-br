<?php

declare(strict_types=1);
/**
 * /src/Entity/EspecieTarefa.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Entity;

use DMS\Filter\Rules as Filter;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Gedmo\Mapping\Annotation as Gedmo;
use SuppCore\AdministrativoBackend\Doctrine\ORM\Enableable\Enableable;
use SuppCore\AdministrativoBackend\Doctrine\ORM\Immutable\Immutable;
use SuppCore\AdministrativoBackend\Entity\Traits\Ativo;
use SuppCore\AdministrativoBackend\Entity\Traits\Blameable;
use SuppCore\AdministrativoBackend\Entity\Traits\Descricao;
use SuppCore\AdministrativoBackend\Entity\Traits\Id;
use SuppCore\AdministrativoBackend\Entity\Traits\Nome;
use SuppCore\AdministrativoBackend\Entity\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\Entity\Traits\Timestampable;
use SuppCore\AdministrativoBackend\Entity\Traits\Uuid;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class EspecieTarefa.
 *
 *  @ORM\Table(
 *     name="ad_especie_tarefa",
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(columns={"nome", "genero_tarefa_id", "apagado_em"}),
 *     }
 * )
 *
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 *
 * @UniqueEntity(
 *     fields = {"nome", "generoTarefa"},
 *     message = "Nome já está em utilização para esse gênero!"
 * )
 *
 * @Enableable()
 * @Immutable(fieldName="nome", expression=Immutable::EXPRESSION_IN, expressionValues="env:constantes.entidades.especie_tarefa.immutable")
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class EspecieTarefa implements EntityInterface
{
    // Traits
    use Blameable;
    use Timestampable;
    use Softdeleteable;
    use Id;
    use Uuid;
    use Nome;
    use Descricao;
    use Ativo;

    public function __construct()
    {
        $this->setUuid();
        $this->transicoesWorkflowFrom = new ArrayCollection();
        $this->transicoesWorkflowTo = new ArrayCollection();
        $this->tarefas = new ArrayCollection();
        $this->workflows = new ArrayCollection();
    }

    /**
     * @ORM\Column(
     *     name="evento",
     *     type="boolean",
     *     nullable=false
     * )
     */
    protected bool $evento = false;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(targetEntity="GeneroTarefa")
     * @ORM\JoinColumn(
     *     name="genero_tarefa_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?GeneroTarefa $generoTarefa = null;

    /**
     * @Assert\Length(
     *     max = 7,
     *     maxMessage = "O campo deve ter no máximo 7 caracteres!"
     * )
     *
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Filter\ToUpper(encoding="UTF-8")
     * @ORM\Column(
     *     name="cor_hexadecimal_primaria",
     *     type="string",
     *     nullable=true
     * )
     */
    protected ?string $corHexadecimalPrimaria = null;

    /**
     * @Assert\Length(
     *     max = 7,
     *     maxMessage = "O campo deve ter no máximo 7 caracteres!"
     * )
     *
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Filter\ToUpper(encoding="UTF-8")
     * @ORM\Column(
     *     name="cor_hexadecimal_secundaria",
     *     type="string",
     *     nullable=true
     * )
     */
    protected ?string $corHexadecimalSecundaria = null;

    /**
     * @var Collection|ArrayCollection<TransicaoWorkflow>
     *
     * @ORM\OneToMany(
     *     targetEntity="TransicaoWorkflow",
     *     mappedBy="especieTarefaTo"
     * )
     */
    protected ArrayCollection|Collection $transicoesWorkflowTo;

    /**
     * @var Collection<Tarefa>|ArrayCollection<Tarefa>
     *
     * @ORM\OneToMany(
     *     targetEntity="Tarefa",
     *     mappedBy="especieTarefa"
     * )
     */
    protected ArrayCollection|Collection $tarefas;

    /**
     * @var Collection|ArrayCollection<TransicaoWorkflow>
     *
     * @ORM\OneToMany(
     *     targetEntity="TransicaoWorkflow",
     *     mappedBy="especieTarefaFrom"
     * )
     */
    protected ArrayCollection|Collection $transicoesWorkflowFrom;

    /**
     * @var Collection|ArrayCollection<Workflow>
     *
     * @ORM\OneToMany(
     *     targetEntity="Workflow",
     *     mappedBy="especieTarefaInicial"
     * )
     */
    protected ArrayCollection|Collection $workflows;

    /**
     * @return GeneroTarefa
     */
    public function getGeneroTarefa(): GeneroTarefa
    {
        return $this->generoTarefa;
    }

    /**
     * @param GeneroTarefa $generoTarefa
     *
     * @return EspecieTarefa
     */
    public function setGeneroTarefa(GeneroTarefa $generoTarefa): self
    {
        $this->generoTarefa = $generoTarefa;

        return $this;
    }

    /**
     * Set evento.
     *
     * @param bool $evento
     *
     * @return self
     */
    public function setEvento(bool $evento): self
    {
        $this->evento = $evento;

        return $this;
    }

    /**
     * Get evento.
     *
     * @return bool
     */
    public function getEvento(): bool
    {
        return $this->evento;
    }

    /**
     * @return string|null
     */
    public function getCorHexadecimalPrimaria(): ?string
    {
        return $this->corHexadecimalPrimaria;
    }

    /**
     * @param string|null $corHexadecimalPrimaria
     *
     * @return EspecieTarefa
     */
    public function setCorHexadecimalPrimaria(?string $corHexadecimalPrimaria): self
    {
        $this->corHexadecimalPrimaria = $corHexadecimalPrimaria;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCorHexadecimalSecundaria(): ?string
    {
        return $this->corHexadecimalSecundaria;
    }

    /**
     * @param string|null $corHexadecimalSecundaria
     *
     * @return EspecieTarefa
     */
    public function setCorHexadecimalSecundaria(?string $corHexadecimalSecundaria): self
    {
        $this->corHexadecimalSecundaria = $corHexadecimalSecundaria;

        return $this;
    }

    /**
     * @return Collection|ArrayCollection|ArrayCollection<TransicaoWorkflow>
     */
    public function getTransicoesWorkflowTo(): Collection
    {
        return $this->transicoesWorkflowTo;
    }

    /**
     * @param TransicaoWorkflow $transicaoWorkflowTo
     *
     * @return EspecieTarefa
     */
    public function addTransicaoWorkflowTo(TransicaoWorkflow $transicaoWorkflowTo): EspecieTarefa
    {
        if (!$this->transicoesWorkflowTo->contains($transicaoWorkflowTo)) {
            $this->transicoesWorkflowTo->add($transicaoWorkflowTo);
            $transicaoWorkflowTo->setEspecieTarefaTo($this);
        }

        return $this;
    }

    /**
     * @param TransicaoWorkflow $transicaoWorkflowTo
     *
     * @return EspecieTarefa
     */
    public function removeTransicaoWorkflowTo(TransicaoWorkflow $transicaoWorkflowTo): EspecieTarefa
    {
        if ($this->transicoesWorkflowTo->contains($transicaoWorkflowTo)) {
            $this->transicoesWorkflowTo->removeElement($transicaoWorkflowTo);
        }

        return $this;
    }


    /**
     * @return Collection|ArrayCollection|ArrayCollection<TransicaoWorkflow>
     */
    public function getTransicoesWorkflowFrom(): Collection
    {
        return $this->transicoesWorkflowFrom;
    }

    /**
     * @param TransicaoWorkflow $transicaoWorkflowFrom
     *
     * @return EspecieTarefa
     */
    public function addTransicaoWorkflowFrom(TransicaoWorkflow $transicaoWorkflowFrom): EspecieTarefa
    {
        if (!$this->transicoesWorkflowFrom->contains($transicaoWorkflowFrom)) {
            $this->transicoesWorkflowFrom->add($transicaoWorkflowFrom);
            $transicaoWorkflowFrom->setEspecieTarefaFrom($this);
        }

        return $this;
    }

    /**
     * @param TransicaoWorkflow $transicaoWorkflowFrom
     *
     * @return EspecieTarefa
     */
    public function removeTransicaoWorkflowFrom(TransicaoWorkflow $transicaoWorkflowFrom): EspecieTarefa
    {
        if ($this->transicoesWorkflowFrom->contains($transicaoWorkflowFrom)) {
            $this->transicoesWorkflowFrom->removeElement($transicaoWorkflowFrom);
        }

        return $this;
    }


    /**
     * @return Collection|ArrayCollection|ArrayCollection<Workflow>
     */
    public function getWorkflows(): Collection
    {
        return $this->workflows;
    }

    /**
     * @param Workflow $workflow
     *
     * @return EspecieTarefa
     */
    public function addWorkflow(Workflow $workflow): EspecieTarefa
    {
        if (!$this->workflows->contains($workflow)) {
            $this->workflows->add($workflow);
            $workflow->setEspecieTarefaInicial($this);
        }

        return $this;
    }

    /**
     * @param Workflow $workflow
     *
     * @return EspecieTarefa
     */
    public function removeWorkflow(Workflow $workflow): EspecieTarefa
    {
        if ($this->workflows->contains($workflow)) {
            $this->workflows->removeElement($workflow);
        }

        return $this;
    }

    /**
     * @return Collection<Tarefa>|ArrayCollection<Tarefa>
     */
    public function getTarefas(): Collection|ArrayCollection
    {
        return $this->tarefas;
    }

    /**
     * @param Tarefa $tarefa
     *
     * @return EspecieTarefa
     */
    public function addTarefa(Tarefa $tarefa): self
    {
        if (!$this->tarefas->contains($tarefa)) {
            $this->tarefas->add($tarefa);
            $tarefa->setEspecieTarefaInicial($this);
        }

        return $this;
    }

    /**
     * @param Tarefa $tarefa
     *
     * @return EspecieTarefa
     */
    public function removeTarefa(Tarefa $tarefa): self
    {
        if ($this->tarefas->contains($tarefa)) {
            $this->tarefas->removeElement($tarefa);
        }

        return $this;
    }
}
