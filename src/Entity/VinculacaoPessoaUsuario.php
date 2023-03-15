<?php

declare(strict_types=1);
/**
 * /src/Entity/VinculacaoPessoaUsuario.php.
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
 * Class VinculacaoPessoaUsuario.
 *
 *  @ORM\Table(
 *     name="ad_vinc_pessoa_usuario",
 *     uniqueConstraints={
 *          @ORM\UniqueConstraint(columns={"pessoa_id", "usuario_vinculado_id", "apagado_em"})
 *     }
 * )
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @UniqueEntity(
 *     fields = {"pessoa", "usuarioVinculado", "apagadoEm"},
 *     message = "Usuário já se encontram vinculado a essa pessoa!"
 * )
 *
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 *
 * @Gedmo\Loggable
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class VinculacaoPessoaUsuario implements EntityInterface
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
     *     targetEntity="Pessoa"
     * )
     * @ORM\JoinColumn(
     *     name="pessoa_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected Pessoa $pessoa;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(
     *     targetEntity="Usuario",
     *     inversedBy="vinculacoesPessoasUsuarios"
     * )
     * @ORM\JoinColumn(
     *     name="usuario_vinculado_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected Usuario $usuarioVinculado;

    /**
     * @return Pessoa
     */
    public function getPessoa(): Pessoa
    {
        return $this->pessoa;
    }

    /**
     * @param Pessoa $pessoa
     *
     * @return self
     */
    public function setPessoa(Pessoa $pessoa): self
    {
        $this->pessoa = $pessoa;

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
     * @return self
     */
    public function setUsuarioVinculado(Usuario $usuarioVinculado): self
    {
        $this->usuarioVinculado = $usuarioVinculado;

        return $this;
    }
}
