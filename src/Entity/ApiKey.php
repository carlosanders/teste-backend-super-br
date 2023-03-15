<?php

declare(strict_types=1);
/**
 * /src/Entity/ApiKey.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Entity;

use SuppCore\AdministrativoBackend\Entity\Traits\Id;
use SuppCore\AdministrativoBackend\Entity\Traits\Uuid;
use function array_map;
use function array_unique;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use function mb_strlen;
use function random_int;
use SuppCore\AdministrativoBackend\Entity\Traits\Blameable;
use SuppCore\AdministrativoBackend\Entity\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\Entity\Traits\Timestampable;
use SuppCore\AdministrativoBackend\Security\RolesService;
use Symfony\Bridge\Doctrine\Validator\Constraints as AssertCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class ApiKey.
 *
 * @AssertCollection\UniqueEntity("token")
 *
 *  @ORM\Table(
 *     name="ad_api_key",
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(name="uq_token", columns={"token"}),
 *     },
 * )
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class ApiKey implements EntityInterface
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
        $this->vinculacoesRoles = new ArrayCollection();

        $this->generateToken();
    }

    /**
     * @Assert\NotBlank(message="O campo não pode estar em branco!")
     * @Assert\NotNull(message="O campo não pode ser nulo!")
     * @Assert\Length(min = 40, max = 40)
     * @ORM\Column(
     *     name="token",
     *     type="string",
     *     length=40,
     *     nullable=false
     * )
     */
    protected string $token = '';

    /**
     * @ORM\Column(
     *     name="description",
     *     type="text"
     * )
     */
    protected string $description = '';

    /**
     * @var Collection|ArrayCollection|ArrayCollection<VinculacaoRole>
     *
     * @ORM\OneToMany(
     *     targetEntity="VinculacaoRole",
     *     mappedBy="apiKey",
     * )
     */
    protected $vinculacoesRoles;

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     *
     * @return ApiKey
     */
    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return ApiKey
     *
     * @throws Exception
     */
    public function generateToken(): self
    {
        $random = '';
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $max = mb_strlen($chars, '8bit') - 1;

        for ($i = 0; $i < 40; ++$i) {
            $random .= $chars[random_int(0, $max)];
        }

        return $this->setToken($random);
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return ApiKey
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|ArrayCollection|ArrayCollection<VinculacaoRole>
     */
    public function getVinculacoesRoles(): Collection
    {
        return $this->vinculacoesRoles;
    }

    /**
     * Getter for roles.
     *
     * @return string[]
     */
    public function getRoles(): array
    {
        /**
         * Lambda iterator to get usuario group role information.
         *
         * @param VinculacaoRole $vinculacaoRole
         *
         * @return string
         */
        $iterator = fn (VinculacaoRole $vinculacaoRole): string => $vinculacaoRole->getRole();

        return array_map(
            '\strval',
            array_unique(
                [...[RolesService::ROLE_API], ...$this->vinculacoesRoles->map($iterator)->toArray()]
            )
        );
    }

    /**
     * Method to attach new vinculacaoRole to current api key.
     *
     * @param VinculacaoRole $vinculacaoRole
     *
     * @return ApiKey
     */
    public function addVinculacaoRole(VinculacaoRole $vinculacaoRole): ApiKey
    {
        if (!$this->vinculacoesRoles->contains($vinculacaoRole)) {
            $this->vinculacoesRoles->add($vinculacaoRole);
            $vinculacaoRole->setApiKey($this);
        }

        return $this;
    }

    /**
     * Method to remove specified vinculacaoRole from current api key.
     *
     * @param VinculacaoRole $vinculacaoRole
     *
     * @return ApiKey
     */
    public function removeVinculacaoRole(VinculacaoRole $vinculacaoRole): ApiKey
    {
        if ($this->vinculacoesRoles->contains($vinculacaoRole)) {
            $this->vinculacoesRoles->removeElement($vinculacaoRole);
        }

        return $this;
    }

    /**
     * Method to remove all many-to-many vinculacaoRole relations from current api key.
     *
     * @return ApiKey
     */
    public function clearVinculacoesRoles(): self
    {
        $this->vinculacoesRoles->clear();

        return $this;
    }
}
