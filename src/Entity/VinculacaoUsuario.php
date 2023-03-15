<?php

declare(strict_types=1);
/**
 * /src/Entity/VinculacaoUsuario.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Entity;

use Doctrine\ORM\Mapping as ORM;
use Exception;
use Gedmo\Mapping\Annotation as Gedmo;
use SuppCore\AdministrativoBackend\Entity\Traits\Blameable;
use SuppCore\AdministrativoBackend\Entity\Traits\Id;
use SuppCore\AdministrativoBackend\Entity\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\Entity\Traits\Timestampable;
use SuppCore\AdministrativoBackend\Entity\Traits\Uuid;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class VinculacaoUsuario.
 *
 *  @ORM\Table(
 *     name="ad_vinc_usuario",
 *     uniqueConstraints={
 *          @ORM\UniqueConstraint(columns={"usuario_id", "usuario_vinculado_id", "apagado_em"})
 *     }
 * )
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @UniqueEntity(
 *     fields = {"usuario", "usuarioVinculado", "apagadoEm"},
 *     message = "Usuários já se encontram vinculados!"
 * )
 *
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 *
 * @Gedmo\Loggable
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class VinculacaoUsuario implements EntityInterface
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
     *     targetEntity="Usuario",
     *     inversedBy="vinculacoesUsuarios"
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
     *     targetEntity="Usuario",
     *     inversedBy="vinculacoesUsuariosPrincipais"
     * )
     * @ORM\JoinColumn(
     *     name="usuario_vinculado_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected Usuario $usuarioVinculado;

    /**
     * @Gedmo\Versioned
     * @ORM\Column(
     *     type="boolean",
     *     nullable=false
     * )
     */
    protected bool $encerraTarefa = false;

    /**
     * @Gedmo\Versioned
     * @ORM\Column(
     *     type="boolean",
     *     nullable=false
     * )
     */
    protected bool $criaOficio = false;

    /**
     * @Gedmo\Versioned
     * @ORM\Column(
     *     type="boolean",
     *     nullable=false
     * )
     */
    protected bool $criaMinuta = false;

    /**
     * @Gedmo\Versioned
     * @ORM\Column(
     *     type="boolean",
     *     nullable=false
     * )
     */
    protected bool $compartilhaTarefa = false;

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
     * @return VinculacaoUsuario
     */
    public function setUsuario(Usuario $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * @return Usuario
     */
    public function getUsuarioVinculado(): Usuario
    {
        return $this->usuarioVinculado;
    }

    /**
     * @param Usuario $usuarioVinculado
     *
     * @return VinculacaoUsuario
     */
    public function setUsuarioVinculado(Usuario $usuarioVinculado): self
    {
        $this->usuarioVinculado = $usuarioVinculado;

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
     * @return VinculacaoUsuario
     */
    public function setEncerraTarefa(bool $encerraTarefa): self
    {
        $this->encerraTarefa = $encerraTarefa;

        return $this;
    }

    /**
     * @return bool
     */
    public function getCriaOficio(): bool
    {
        return $this->criaOficio;
    }

    /**
     * @param bool $criaOficio
     *
     * @return VinculacaoUsuario
     */
    public function setCriaOficio(bool $criaOficio): self
    {
        $this->criaOficio = $criaOficio;

        return $this;
    }

    /**
     * @return bool
     */
    public function getCriaMinuta(): bool
    {
        return $this->criaMinuta;
    }

    /**
     * @param bool $criaMinuta
     *
     * @return VinculacaoUsuario
     */
    public function setCriaMinuta(bool $criaMinuta): self
    {
        $this->criaMinuta = $criaMinuta;

        return $this;
    }

    /**
     * @return bool
     */
    public function getCompartilhaTarefa(): bool
    {
        return $this->compartilhaTarefa;
    }

    /**
     * @param bool $compartilhaTarefa
     *
     * @return VinculacaoUsuario
     */
    public function setCompartilhaTarefa(bool $compartilhaTarefa): self
    {
        $this->compartilhaTarefa = $compartilhaTarefa;

        return $this;
    }
}
