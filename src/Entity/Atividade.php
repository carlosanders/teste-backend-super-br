<?php

declare(strict_types=1);
/**
 * /src/Entity/Atividade.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Entity;

use DateTime;
use DMS\Filter\Rules as Filter;
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

/**
 * Class Atividade.
 *
 *  @ORM\Table(
 *     name="ad_atividade",
 * )
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Atividade implements EntityInterface
{
    // Traits
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
        $this->juntadas = new ArrayCollection();
    }

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     * @ORM\Column(
     *     type="datetime",
     *     name="data_hora_conclusao",
     *     nullable=false
     * )
     */
    protected DateTime $dataHoraConclusao;

    /**
     * @Assert\Length(
     *     max = 255,
     *     maxMessage = "Campo deve ter no máximo {{ limit }} letras ou números"
     * )
     *
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Filter\ToUpper(encoding="UTF-8")
     * @ORM\Column(
     *     type="string",
     *     name="observacao",
     *     nullable=true
     * )
     */
    protected ?string $observacao = null;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     * @ORM\Column(
     *     type="boolean",
     *     name="encerra_tarefa",
     *     nullable=false
     * )
     */
    protected bool $encerraTarefa = false;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(
     *     targetEntity="EspecieAtividade"
     * )
     * @ORM\JoinColumn(
     *     name="especie_atividade_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected EspecieAtividade $especieAtividade;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(
     *     targetEntity="Setor"
     * )
     * @ORM\JoinColumn(
     *     name="setor_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected Setor $setor;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(
     *     targetEntity="Usuario"
     * )
     * @ORM\JoinColumn(
     *     name="usuario_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected Usuario $usuario;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(
     *     targetEntity="Tarefa",
     *     inversedBy="atividades"
     * )
     * @ORM\JoinColumn(
     *     name="tarefa_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected Tarefa $tarefa;

    /**
     * @ORM\OneToOne(
     *     targetEntity="Tarefa",
     *     inversedBy="atividadeAprovacao"
     * )
     * @ORM\JoinColumn(
     *     name="tarefa_aprovacao_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?Tarefa $tarefaAprovacao = null;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="Documento"
     * )
     * @ORM\JoinColumn(
     *     name="documento_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?Documento $documento = null;

    /**
     * @var Collection|ArrayCollection<Juntada>
     *
     * @ORM\OneToMany(
     *     targetEntity="Juntada",
     *     mappedBy="atividade"
     * )
     */
    protected $juntadas;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="Workflow"
     * )
     * @ORM\JoinColumn(
     *     name="workflow_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?Workflow $workflow = null;


    /**
     * @Filter\StripTags()
     * @Filter\Trim()
     *
     * @ORM\Column(type="string", name="info_complementar_1", nullable=true)
     */
    private ?string $informacaoComplementar1 = null;

    /**
     * @Filter\StripTags()
     * @Filter\Trim()
     *
     * @ORM\Column(type="string", name="info_complementar_2", nullable=true)
     */
    private ?string $informacaoComplementar2 = null;

    /**
     * @Filter\StripTags()
     * @Filter\Trim()
     *
     * @ORM\Column(type="string", name="info_complementar_3", nullable=true)
     */
    private ?string $informacaoComplementar3 = null;

    /**
     * @Filter\StripTags()
     * @Filter\Trim()
     *
     * @ORM\Column(type="string", name="info_complementar_4", nullable=true)
     */
    private ?string $informacaoComplementar4 = null;

    /**
     * @return DateTime
     */
    public function getDataHoraConclusao(): DateTime
    {
        return $this->dataHoraConclusao;
    }

    /**
     * @param DateTime $dataHoraConclusao
     *
     * @return self
     */
    public function setDataHoraConclusao(DateTime $dataHoraConclusao): self
    {
        $this->dataHoraConclusao = $dataHoraConclusao;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getObservacao(): ?string
    {
        return $this->observacao;
    }

    /**
     * @param string|null $observacao
     *
     * @return self
     */
    public function setObservacao(?string $observacao): self
    {
        $this->observacao = $observacao;

        return $this;
    }

    /**
     * @return bool
     */
    public function getEncerraTarefa(): bool
    {
        return $this->encerraTarefa;
    }

    /**
     * @param bool $encerraTarefa
     *
     * @return self
     */
    public function setEncerraTarefa(bool $encerraTarefa): self
    {
        $this->encerraTarefa = $encerraTarefa;

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
     * @return self
     */
    public function setEspecieAtividade(EspecieAtividade $especieAtividade): self
    {
        $this->especieAtividade = $especieAtividade;

        return $this;
    }

    /**
     * @return Setor
     */
    public function getSetor(): Setor
    {
        return $this->setor;
    }

    /**
     * @param Setor $setor
     *
     * @return self
     */
    public function setSetor(Setor $setor): self
    {
        $this->setor = $setor;

        return $this;
    }

    /**
     * @return Usuario
     */
    public function getUsuario(): Usuario
    {
        return $this->usuario;
    }

    /**
     * @param Usuario $usuario
     *
     * @return self
     */
    public function setUsuario(Usuario $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * @return Tarefa
     */
    public function getTarefa(): Tarefa
    {
        return $this->tarefa;
    }

    /**
     * @param Tarefa $tarefa
     *
     * @return self
     */
    public function setTarefa(Tarefa $tarefa): self
    {
        $this->tarefa = $tarefa;

        return $this;
    }

    /**
     * @return Tarefa
     */
    public function getTarefaAprovacao(): Tarefa
    {
        return $this->tarefaAprovacao;
    }

    /**
     * @param Tarefa $tarefaAprovacao
     *
     * @return self
     */
    public function setTarefaAprovacao(Tarefa $tarefaAprovacao): self
    {
        $this->tarefaAprovacao = $tarefaAprovacao;

        return $this;
    }

    /**
     * @return Documento|null
     */
    public function getDocumento(): ?Documento
    {
        return $this->documento;
    }

    /**
     * @param Documento|null $documento
     *
     * @return self
     */
    public function setDocumento(?Documento $documento): self
    {
        $this->documento = $documento;

        return $this;
    }

    /**
     * @param Juntada $juntada
     *
     * @return self
     */
    public function addJuntada(Juntada $juntada): self
    {
        if (!$this->juntadas->contains($juntada)) {
            $this->juntadas[] = $juntada;
            $juntada->setAtividade($this);
        }

        return $this;
    }

    /**
     * @param Juntada $juntada
     *
     * @return self
     */
    public function removeJuntada(Juntada $juntada): self
    {
        if ($this->juntadas->contains($juntada)) {
            $this->juntadas->removeElement($juntada);
        }

        return $this;
    }

    /**
     * @return Collection|ArrayCollection<Juntada>
     */
    public function getJuntadas(): Collection|ArrayCollection
    {
        return $this->juntadas;
    }

    /**
     * @return Workflow|null
     */
    public function getWorkflow(): ?Workflow
    {
        return $this->workflow;
    }

    /**
     * @param Workflow|null $workflow
     *
     * @return self
     */
    public function setWorkflow(?Workflow $workflow): self
    {
        $this->workflow = $workflow;

        return $this;
    }


    /**
     * @return string|null
     */
    public function getInformacaoComplementar1(): ?string
    {
        return $this->informacaoComplementar1;
    }

    /**
     * @param string|null $informacaoComplementar1
     * @return self
     */
    public function setInformacaoComplementar1(?string $informacaoComplementar1): self
    {
        $this->informacaoComplementar1 = $informacaoComplementar1;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getInformacaoComplementar2(): ?string
    {
        return $this->informacaoComplementar2;
    }

    /**
     * @param string|null $informacaoComplementar2
     * @return self
     */
    public function setInformacaoComplementar2(?string $informacaoComplementar2): self
    {
        $this->informacaoComplementar2 = $informacaoComplementar2;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getInformacaoComplementar3(): ?string
    {
        return $this->informacaoComplementar3;
    }

    /**
     * @param string|null $informacaoComplementar3
     * @return self
     */
    public function setInformacaoComplementar3(?string $informacaoComplementar3): self
    {
        $this->informacaoComplementar3 = $informacaoComplementar3;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getInformacaoComplementar4(): ?string
    {
        return $this->informacaoComplementar4;
    }

    /**
     * @param string|null $informacaoComplementar4
     * @return self
     */
    public function setInformacaoComplementar4(?string $informacaoComplementar4): self
    {
        $this->informacaoComplementar4 = $informacaoComplementar4;

        return $this;
    }
}
