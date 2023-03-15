<?php

declare(strict_types=1);
/**
 * /src/Entity/Colaborador.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Gedmo\Mapping\Annotation as Gedmo;
use SuppCore\AdministrativoBackend\Doctrine\ORM\Enableable\Enableable;
use SuppCore\AdministrativoBackend\Entity\Traits\Blameable;
use SuppCore\AdministrativoBackend\Entity\Traits\Id;
use SuppCore\AdministrativoBackend\Entity\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\Entity\Traits\Timestampable;
use SuppCore\AdministrativoBackend\Entity\Traits\Uuid;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Colaborador.
 *
 *  @ORM\Table(
 *     name="ad_colaborador",
 * )
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @Gedmo\Loggable
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 *
 * @UniqueEntity(
 *     fields = {"usuario"},
 *     message = "Usuário já está associado a um colaborador"
 * )
 *
 * @Enableable()
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Colaborador implements EntityInterface
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
        $this->afastamentos = new ArrayCollection();
        $this->lotacoes = new ArrayCollection();
    }

    /**
     * @Assert\NotNull(
     *     message="Campo não pode ser nulo!"
     * )
     *
     * @Gedmo\Versioned
     *
     * @ORM\ManyToOne(
     *     targetEntity="Cargo"
     * )
     * @ORM\JoinColumn(
     *     name="cargo_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected Cargo $cargo;

    /**
     * @Assert\NotNull(
     *     message="Campo não pode ser nulo!"
     * )
     *
     * @Gedmo\Versioned
     *
     * @ORM\ManyToOne(
     *     targetEntity="ModalidadeColaborador"
     * )
     * @ORM\JoinColumn(
     *     name="mod_colaborador_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected ModalidadeColaborador $modalidadeColaborador;

    /**
     * @var Usuario
     *
     * @ORM\OneToOne(
     *     targetEntity="Usuario",
     *     inversedBy="colaborador",
     *     cascade={"persist"}
     * )
     * @ORM\JoinColumn(
     *     name="usuario_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?Usuario $usuario = null;

    /**
     * @var Collection|ArrayCollection|ArrayCollection<Afastamento>
     *
     * @ORM\OneToMany(
     *     targetEntity="Afastamento",
     *     mappedBy="colaborador",
     *     cascade={"all"}
     * )
     */
    protected $afastamentos;

    /**
     * @var Collection|ArrayCollection|ArrayCollection<Lotacao>
     *
     * @ORM\OneToMany(
     *     targetEntity="Lotacao",
     *     mappedBy="colaborador",
     *     cascade={"all"}
     * )
     */
    protected $lotacoes;

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
     * @param Cargo $cargo
     *
     * @return Colaborador
     */
    public function setCargo(Cargo $cargo): self
    {
        $this->cargo = $cargo;

        return $this;
    }

    /**
     * @return Cargo
     */
    public function getCargo(): Cargo
    {
        return $this->cargo;
    }

    /**
     * @param Usuario $usuario
     *
     * @return Colaborador
     */
    public function setUsuario(?Usuario $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * @return Usuario
     */
    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    /**
     * @param ModalidadeColaborador $modalidadeColaborador
     *
     * @return Colaborador
     */
    public function setModalidadeColaborador(ModalidadeColaborador $modalidadeColaborador): self
    {
        $this->modalidadeColaborador = $modalidadeColaborador;

        return $this;
    }

    /**
     * @return ModalidadeColaborador
     */
    public function getModalidadeColaborador(): ModalidadeColaborador
    {
        return $this->modalidadeColaborador;
    }

    /**
     * @param Afastamento $afastamento
     *
     * @return Colaborador
     */
    public function addAfastamento(Afastamento $afastamento): self
    {
        if (!$this->afastamentos->contains($afastamento)) {
            $this->afastamentos[] = $afastamento;
            $afastamento->setColaborador($this);
        }

        return $this;
    }

    /**
     * @param Afastamento $afastamento
     *
     * @return Colaborador
     */
    public function removeAfastamento(Afastamento $afastamento): self
    {
        if ($this->afastamentos->contains($afastamento)) {
            $this->afastamentos->removeElement($afastamento);
        }

        return $this;
    }

    /**
     * @return Collection|ArrayCollection|ArrayCollection<Afastamento>
     */
    public function getAfastamentos(): Collection
    {
        return $this->afastamentos;
    }

    /**
     * @param Lotacao $lotacao
     *
     * @return Colaborador
     */
    public function addLotacao(Lotacao $lotacao): self
    {
        if (!$this->lotacoes->contains($lotacao)) {
            $this->lotacoes[] = $lotacao;
            $lotacao->setColaborador($this);
        }

        return $this;
    }

    /**
     * @param Lotacao $lotacao
     *
     * @return Colaborador
     */
    public function removeLotacao(Lotacao $lotacao): self
    {
        if ($this->lotacoes->contains($lotacao)) {
            $this->lotacoes->removeElement($lotacao);
        }

        return $this;
    }

    /**
     * @return Collection|ArrayCollection|ArrayCollection<Lotacao>
     */
    public function getLotacoes(): Collection
    {
        return $this->lotacoes;
    }

    /**
     * Set ativo.
     *
     * @param bool $ativo
     *
     * @return Colaborador
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
