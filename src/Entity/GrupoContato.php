<?php

declare(strict_types=1);
/**
 * /src/Entity/GrupoContato.php.
 */

namespace SuppCore\AdministrativoBackend\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Gedmo\Mapping\Annotation as Gedmo;
use SuppCore\AdministrativoBackend\Doctrine\ORM\Enableable\Enableable;
use SuppCore\AdministrativoBackend\Entity\Traits\Blameable;
use SuppCore\AdministrativoBackend\Entity\Traits\Descricao;
use SuppCore\AdministrativoBackend\Entity\Traits\Id;
use SuppCore\AdministrativoBackend\Entity\Traits\Nome;
use SuppCore\AdministrativoBackend\Entity\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\Entity\Traits\Timestampable;
use SuppCore\AdministrativoBackend\Entity\Traits\Uuid;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Class GrupoContato.
 *
 *  @ORM\Table(
 *     name="ad_grupo_contato"
 * )
 *
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 *
 * @Enableable()
 *
 */
class GrupoContato implements EntityInterface
{
    // Traits
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
        $this->contatos = new ArrayCollection();
    }

    /**
     * @ORM\Column(
     *     name="ativo",
     *     type="boolean",
     *     nullable=false
     * )
     */
    protected bool $ativo = true;

    /**
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
     * @var Collection<Contato>|ArrayCollection<Contato>
     *
     * @ORM\OneToMany(
     *     targetEntity="Contato",
     *     mappedBy="grupoContato"
     * )
     */
    protected Collection|ArrayCollection $contatos;

    /**
     * @return ArrayCollection|Collection
     */
    public function getContatos(): ArrayCollection|Collection
    {
        return $this->contatos;
    }

    /**
     * @param Contato $contato
     * @return $this
     */
    public function addContato(Contato $contato): self
    {
        if (!$this->contatos->contains($contato)) {
            $this->contatos[] = $contato;
            $contato->setGrupoContato($this);
        }

        return $this;
    }

    /**
     * @param Contato $contato
     * @return $this
     */
    public function removeContato(Contato $contato): self
    {
        if ($this->contatos->contains($contato)) {
            $this->contatos->removeElement($contato);
        }

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
     * @return $this
     */
    public function setUsuario(Usuario $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * @return bool
     */
    public function getAtivo(): bool
    {
        return $this->ativo;
    }

    /**
     * @param bool $ativo
     * @return $this
     */
    public function setAtivo(bool $ativo): self
    {
        $this->ativo = $ativo;

        return $this;
    }

}
