<?php

declare(strict_types=1);
/**
 * /src/Entity/Contato.php.
 */

namespace SuppCore\AdministrativoBackend\Entity;

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
 * Class Contato.
 *
 *  @ORM\Table(
 *     name="ad_contato"
 * )
 *
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 *
 */
class Contato implements EntityInterface
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
    }

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(
     *     targetEntity="TipoContato"
     * )
     * @ORM\JoinColumn(
     *     name="tipo_contato_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected TipoContato $tipoContato;


    /**
     * @ORM\ManyToOne(
     *     targetEntity="Setor"
     * )
     * @ORM\JoinColumn(
     *     name="setor_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?Setor $setor = null;


    /**
     * @ORM\ManyToOne(
     *     targetEntity="Setor"
     * )
     * @ORM\JoinColumn(
     *     name="unidade_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?Setor $unidade = null;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="Usuario"
     * )
     * @ORM\JoinColumn(
     *     name="usuario_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?Usuario $usuario = null;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(
     *     targetEntity="GrupoContato",
     *     inversedBy="contatos"
     * )
     * @ORM\JoinColumn(
     *     name="grupo_contato_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected GrupoContato $grupoContato;

    /**
     * @return TipoContato
     */
    public function getTipoContato(): TipoContato
    {
        return $this->tipoContato;
    }

    /**
     * @param TipoContato $tipoContato
     * @return self
     */
    public function setTipoContato(TipoContato $tipoContato): self
    {
        $this->tipoContato = $tipoContato;

        return $this;
    }

    /**
     * @return Setor|null
     */
    public function getSetor(): ?Setor
    {
        return $this->setor;
    }

    /**
     * @param Setor|null $setor
     * @return self
     */
    public function setSetor(?Setor $setor): self
    {
        $this->setor = $setor;

        return $this;
    }

    /**
     * @return Setor|null
     */
    public function getUnidade(): ?Setor
    {
        return $this->unidade;
    }

    /**
     * @param Setor|null $unidade
     * @return self
     */
    public function setUnidade(?Setor $unidade): self
    {
        $this->unidade = $unidade;

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
     * @param Usuario $usuario
     * @return self
     */
    public function setUsuario(Usuario $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * @return GrupoContato|null
     */
    public function getGrupoContato(): ?GrupoContato
    {
        return $this->grupoContato;
    }

    /**
     * @param GrupoContato|null $grupoContato
     * @return $this
     */
    public function setGrupoContato(?GrupoContato $grupoContato): self
    {
        $this->grupoContato = $grupoContato;

        return $this;
    }

}
