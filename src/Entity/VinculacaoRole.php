<?php

declare(strict_types=1);
/**
 * /src/Entity/VinculacaoRole.php.
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
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * Class VinculacaoRole.
 *
 *  @ORM\Table(
 *     name="ad_vinc_role",
 *     uniqueConstraints={
 *          @ORM\UniqueConstraint(columns={"usuario_id", "role", "apagado_em"})
 *     }
 * )
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @UniqueEntity(
 *     fields = {"usuario", "role", "apagadoEm"},
 *     message = "Usuário já possui a role!"
 * )
 *
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class VinculacaoRole implements EntityInterface
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
     * @ORM\Column(
     *     type="string",
     *     nullable=false
     * )
     */
    protected string $role;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="Usuario",
     *     inversedBy="vinculacoesRoles"
     * )
     * @ORM\JoinColumn(
     *     name="usuario_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?Usuario $usuario = null;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="ApiKey",
     *     inversedBy="vinculacoesRoles"
     * )
     * @ORM\JoinColumn(
     *     name="api_key_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?ApiKey $apiKey = null;

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @param string $role
     *
     * @return VinculacaoRole
     */
    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return Usuario|null
     */
    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    /**
     * @param Usuario|null $usuario
     *
     * @return VinculacaoRole
     */
    public function setUsuario(?Usuario $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * @return ApiKey|null
     */
    public function getApiKey(): ?ApiKey
    {
        return $this->apiKey;
    }

    /**
     * @param ApiKey|null $apiKey
     *
     * @return VinculacaoRole
     */
    public function setApiKey(?ApiKey $apiKey): self
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * @param ExecutionContextInterface $context
     *
     * @Assert\Callback
     */
    public function isValid(ExecutionContextInterface $context): void
    {
        if (($this->getUsuario() && $this->getApiKey()) ||
            (!$this->getUsuario() && !$this->getApiKey())) {
            $context->buildViolation('A vinculacaoRole deve ter usuario ou apikey!')
                ->atPath('id')
                ->addViolation();
        }
    }
}
