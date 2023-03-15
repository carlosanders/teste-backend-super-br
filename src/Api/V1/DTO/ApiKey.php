<?php

declare(strict_types=1);
/**
 * /src/Api/V1/DTO/ApiKey.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\DTO;

use SuppCore\AdministrativoBackend\DTO\RestDto;
use SuppCore\AdministrativoBackend\DTO\Traits\Blameable;
use SuppCore\AdministrativoBackend\DTO\Traits\IdUuid;
use SuppCore\AdministrativoBackend\DTO\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\DTO\Traits\Timeblameable;
use SuppCore\AdministrativoBackend\Form\Annotations as Form;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;
use SuppCore\AdministrativoBackend\Validator\Constraints as AppAssert;
use OpenApi\Annotations as OA;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class ApiKey.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @DTOMapper\JsonLD(
 *     jsonLDId="/v1/administrativo/api_key/{id}",
 *     jsonLDType="ApiKey",
 *     jsonLDContext="/api/doc/#model-ApiKey"
 * )
 *
 * @AppAssert\DtoUniqueEntity(
 *      fieldMapping = {"token": "token"},
 *      entityClass="SuppCore\AdministrativoBackend\Entity\ApiKey",
 *      message = "Campo já está em utilização!"
 * )
 *
 * @Form\Form()
 */
class ApiKey extends RestDto
{
    use IdUuid;
    use Timeblameable;
    use Blameable;
    use Softdeleteable;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=true
     * )
     *
     * @Assert\NotBlank(
     *     message="O campo não pode estar em branco!"
     * )
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $description = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=false
     * )
     *
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $token = null;

    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @return ApiKey
     */
    public function setToken(string $token): self
    {
        $this->setVisited('token');

        $this->token = $token;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return ApiKey
     */
    public function setDescription(string $description): self
    {
        $this->setVisited('description');

        $this->description = $description;

        return $this;
    }
}
