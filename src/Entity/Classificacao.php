<?php

declare(strict_types=1);
/**
 * /src/Entity/Classificacao.php.
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
use SuppCore\AdministrativoBackend\Entity\Traits\Blameable;
use SuppCore\AdministrativoBackend\Entity\Traits\Id;
use SuppCore\AdministrativoBackend\Entity\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\Entity\Traits\Timestampable;
use SuppCore\AdministrativoBackend\Entity\Traits\Uuid;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Classificacao.
 *
 *  @ORM\Table(
 *     name="ad_classificacao",
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(columns={"nome", "parent_id", "codigo", "apagado_em"}),
 *     }
 * )
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 *
 * @Gedmo\Loggable
 * @Gedmo\Tree(type="nested")
 *
 *  @UniqueEntity(
 *     fields = {"nome", "parent", "codigo"},
 *     message = "Nome já está em utilização para essa classe!"
 * )
 *
 * @Enableable()
 * @Immutable(fieldName="codigo", expression=Immutable::EXPRESSION_IN, expressionValues="env:constantes.entidades.classificacao.immutable")
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Classificacao implements EntityInterface
{
    // Traits
    use Blameable;
    use Softdeleteable;
    use Timestampable;
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
        $this->children = new ArrayCollection();
    }

    /**
     * @Assert\NotBlank(
     *     message="Campo não pode estar em branco."
     * )
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     * @Assert\Length(
     *     min = 3,
     *     max = 255,
     *     minMessage = "Campo ter no mínimo {{ limit }} letras ou números",
     *     maxMessage = "Campo deve ter no máximo {{ limit }} letras ou números"
     * )
     *
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Filter\ToUpper(encoding="UTF-8")
     *
     * @Gedmo\Versioned
     * @ORM\Column(
     *     type="string",
     *     nullable=false
     * )
     */
    protected string $nome;

    /**
     * @Gedmo\Versioned
     *
     * @ORM\ManyToOne(
     *     targetEntity="ModalidadeDestinacao"
     * )
     * @ORM\JoinColumn(
     *     name="mod_destinacao_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?ModalidadeDestinacao $modalidadeDestinacao = null;

    /**
     * @Gedmo\Versioned
     * @ORM\Column(
     *     name="corrente_ano",
     *     type="integer",
     *     nullable=true
     * )
     */
    protected ?int $prazoGuardaFaseCorrenteAno = null;

    /**
     * @Gedmo\Versioned
     * @ORM\Column(
     *     name="corrente_mes",
     *     type="integer",
     *     nullable=true
     * )
     */
    protected ?int $prazoGuardaFaseCorrenteMes = null;

    /**
     * @Gedmo\Versioned
     * @ORM\Column(
     *     name="corrente_dia",
     *     type="integer",
     *     nullable=true
     * )
     */
    protected ?int $prazoGuardaFaseCorrenteDia = null;

    /**
     * @Gedmo\Versioned
     *
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Filter\ToUpper(encoding="UTF-8")
     * @ORM\Column(
     *     name="corrente_evento",
     *     type="string",
     *     nullable=true
     * )
     */
    protected ?string $prazoGuardaFaseCorrenteEvento = null;

    /**
     * @Gedmo\Versioned
     * @ORM\Column(
     *     name="intermediaria_ano",
     *     type="integer",
     *     nullable=true
     * )
     */
    protected ?int $prazoGuardaFaseIntermediariaAno = null;

    /**
     * @Gedmo\Versioned
     * @ORM\Column(
     *     name="intermediaria_mes",
     *     type="integer",
     *     nullable=true
     * )
     */
    protected ?int $prazoGuardaFaseIntermediariaMes = null;

    /**
     * @Gedmo\Versioned
     * @ORM\Column(
     *     name="intermediaria_dia",
     *     type="integer",
     *     nullable=true
     * )
     */
    protected ?int $prazoGuardaFaseIntermediariaDia = null;

    /**
     * @Gedmo\Versioned
     *
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Filter\ToUpper(encoding="UTF-8")
     * @ORM\Column(
     *     name="intermediaria_evento",
     *     type="string",
     *     nullable=true
     * )
     */
    protected ?string $prazoGuardaFaseIntermediariaEvento = null;

    /**
     * @Assert\NotBlank(
     *     message="Campo não pode estar em branco."
     * )
     * @Assert\Regex(
     *     pattern="/[A-Z0-9]+/",
     *     message="O codigo do assuntoAdministrativo dever ter possuir apenas letras maiúsculas ou números."
     * )
     * @Assert\NotNull(
     *     message="Campo não pode ser nulo!"
     * )
     * @Assert\Length(
     *     min = 3,
     *     max = 25,
     *     minMessage = "O codigo deve ter no mínimo {{ limit }} letras ou números",
     *     maxMessage = "O codigo deve ter no máximo {{ limit }} letras ou números"
     * )
     *
     * @Gedmo\Versioned
     * @ORM\Column(
     *     type="string",
     *     length=25,
     *     nullable=false
     * )
     */
    protected string $codigo;

    /**
     * @Gedmo\Versioned
     * @ORM\Column(
     *     name="ativo",
     *     type="boolean",
     *     nullable=false
     * )
     */
    protected bool $ativo = true;

    
    /**
     * @Assert\NotNull(
     *     message="Campo não pode ser nulo!"
     * )
     *
     * @Gedmo\Versioned
     * @ORM\Column(
     *     type="boolean",
     *     nullable=false
     * )
     */
    protected bool $permissaoUso = true;

    /**
     * @Assert\Length(
     *     max = 500,
     *     maxMessage = "Campo deve ter no máximo {{ limit }} letras ou números"
     * )
     *
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Filter\ToUpper(encoding="UTF-8")
     * @ORM\Column(
     *     type="string",
     *     length=500,
     *     nullable=true
     * )
     */
    protected ?string $observacao = null;

    /**
     * @Gedmo\TreeLeft
     * @ORM\Column(name="lft", type="integer")
     */
    protected int $lft;

    /**
     * @Gedmo\TreeLevel
     * @ORM\Column(name="lvl", type="integer")
     */
    protected int $lvl;

    /**
     * @Gedmo\TreeRight
     * @ORM\Column(name="rgt", type="integer")
     */
    protected int $rgt;

    /**
     * @Gedmo\TreeRoot
     * @ORM\Column(name="root", type="integer")
     */
    protected int $root;

    /**
     * @Gedmo\Versioned
     * @Gedmo\TreeParent
     *
     * @ORM\ManyToOne(targetEntity="Classificacao", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected ?Classificacao $parent = null;

    /**
     * @var Collection|ArrayCollection|Collection<Classificacao>|ArrayCollection<Classificacao>
     *
     * @ORM\OneToMany(targetEntity="Classificacao", mappedBy="parent")
     * @ORM\OrderBy({"lft" = "ASC"})
     */
    protected $children;

    /**
     * @return string
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     *
     * @return Classificacao
     */
    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * @return ModalidadeDestinacao|null
     */
    public function getModalidadeDestinacao(): ?ModalidadeDestinacao
    {
        return $this->modalidadeDestinacao;
    }

    /**
     * @param ModalidadeDestinacao|null $modalidadeDestinacao
     *
     * @return Classificacao
     */
    public function setModalidadeDestinacao(?ModalidadeDestinacao $modalidadeDestinacao): self
    {
        $this->modalidadeDestinacao = $modalidadeDestinacao;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPrazoGuardaFaseCorrenteAno(): ?int
    {
        return $this->prazoGuardaFaseCorrenteAno;
    }

    /**
     * @param int|null $prazoGuardaFaseCorrenteAno
     *
     * @return Classificacao
     */
    public function setPrazoGuardaFaseCorrenteAno(?int $prazoGuardaFaseCorrenteAno): self
    {
        $this->prazoGuardaFaseCorrenteAno = $prazoGuardaFaseCorrenteAno;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPrazoGuardaFaseCorrenteMes(): ?int
    {
        return $this->prazoGuardaFaseCorrenteMes;
    }

    /**
     * @param int|null $prazoGuardaFaseCorrenteMes
     *
     * @return Classificacao
     */
    public function setPrazoGuardaFaseCorrenteMes(?int $prazoGuardaFaseCorrenteMes): self
    {
        $this->prazoGuardaFaseCorrenteMes = $prazoGuardaFaseCorrenteMes;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPrazoGuardaFaseCorrenteDia(): ?int
    {
        return $this->prazoGuardaFaseCorrenteDia;
    }

    /**
     * @param int|null $prazoGuardaFaseCorrenteDia
     *
     * @return Classificacao
     */
    public function setPrazoGuardaFaseCorrenteDia(?int $prazoGuardaFaseCorrenteDia): self
    {
        $this->prazoGuardaFaseCorrenteDia = $prazoGuardaFaseCorrenteDia;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPrazoGuardaFaseCorrenteEvento(): ?string
    {
        return $this->prazoGuardaFaseCorrenteEvento;
    }

    /**
     * @param string|null $prazoGuardaFaseCorrenteEvento
     *
     * @return Classificacao
     */
    public function setPrazoGuardaFaseCorrenteEvento(?string $prazoGuardaFaseCorrenteEvento): self
    {
        $this->prazoGuardaFaseCorrenteEvento = $prazoGuardaFaseCorrenteEvento;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPrazoGuardaFaseIntermediariaAno(): ?int
    {
        return $this->prazoGuardaFaseIntermediariaAno;
    }

    /**
     * @param int|null $prazoGuardaFaseIntermediariaAno
     *
     * @return Classificacao
     */
    public function setPrazoGuardaFaseIntermediariaAno(?int $prazoGuardaFaseIntermediariaAno): self
    {
        $this->prazoGuardaFaseIntermediariaAno = $prazoGuardaFaseIntermediariaAno;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPrazoGuardaFaseIntermediariaMes(): ?int
    {
        return $this->prazoGuardaFaseIntermediariaMes;
    }

    /**
     * @param int|null $prazoGuardaFaseIntermediariaMes
     *
     * @return Classificacao
     */
    public function setPrazoGuardaFaseIntermediariaMes(?int $prazoGuardaFaseIntermediariaMes): self
    {
        $this->prazoGuardaFaseIntermediariaMes = $prazoGuardaFaseIntermediariaMes;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPrazoGuardaFaseIntermediariaDia(): ?int
    {
        return $this->prazoGuardaFaseIntermediariaDia;
    }

    /**
     * @param int|null $prazoGuardaFaseIntermediariaDia
     *
     * @return Classificacao
     */
    public function setPrazoGuardaFaseIntermediariaDia(?int $prazoGuardaFaseIntermediariaDia): self
    {
        $this->prazoGuardaFaseIntermediariaDia = $prazoGuardaFaseIntermediariaDia;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPrazoGuardaFaseIntermediariaEvento(): ?string
    {
        return $this->prazoGuardaFaseIntermediariaEvento;
    }

    /**
     * @param string|null $prazoGuardaFaseIntermediariaEvento
     *
     * @return Classificacao
     */
    public function setPrazoGuardaFaseIntermediariaEvento(?string $prazoGuardaFaseIntermediariaEvento): self
    {
        $this->prazoGuardaFaseIntermediariaEvento = $prazoGuardaFaseIntermediariaEvento;

        return $this;
    }

    /**
     * @return string
     */
    public function getCodigo(): string
    {
        return $this->codigo;
    }

    /**
     * @param string $codigo
     *
     * @return Classificacao
     */
    public function setCodigo(string $codigo): self
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * @return bool
     */
    public function getPermissaoUso(): bool
    {
        return $this->permissaoUso;
    }

    /**
     * @param bool $permissaoUso
     *
     * @return Classificacao
     */
    public function setPermissaoUso(bool $permissaoUso): self
    {
        $this->permissaoUso = $permissaoUso;

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
     * @return Classificacao
     */
    public function setObservacao(?string $observacao): self
    {
        $this->observacao = $observacao;

        return $this;
    }

    /**
     * @return Classificacao|null
     */
    public function getParent(): ?Classificacao
    {
        return $this->parent;
    }

    /**
     * @param Classificacao|null $parent
     *
     * @return Classificacao
     */
    public function setParent(?Classificacao $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection|ArrayCollection|ArrayCollection<Classificacao>
     */
    public function getChildren(): Collection
    {
        return $this->children;
    }

    /**
     * @return int
     */
    public function getLvl(): int
    {
        return $this->lvl;
    }

    /**
     * Set ativo.
     *
     * @param bool $ativo
     *
     * @return self
     */
    public function setAtivo(bool $ativo): self
    {
        $this->ativo = $ativo;

        return $this;
    }

    /**
     * Get ativo.
     *
     * @return bool
     */
    public function getAtivo(): bool
    {
        return $this->ativo;
    }
}
