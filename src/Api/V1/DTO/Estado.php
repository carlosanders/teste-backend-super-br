<?php

declare(strict_types=1);
/**
 * /src/Api/V1/DTO/Estado.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\DTO;

use DMS\Filter\Rules as Filter;
use Nelmio\ApiDocBundle\Annotation\Model;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Pais as PaisDTO;
use SuppCore\AdministrativoBackend\DTO\RestDto;
use SuppCore\AdministrativoBackend\DTO\Traits\Ativo;
use SuppCore\AdministrativoBackend\DTO\Traits\Blameable;
use SuppCore\AdministrativoBackend\DTO\Traits\IdUuid;
use SuppCore\AdministrativoBackend\DTO\Traits\Nome;
use SuppCore\AdministrativoBackend\DTO\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\DTO\Traits\Timeblameable;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\Pais as PaisEntity;
use SuppCore\AdministrativoBackend\Form\Annotations as Form;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;
use SuppCore\AdministrativoBackend\Validator\Constraints as AppAssert;
use OpenApi\Annotations as OA;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Estado.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @AppAssert\DtoUniqueEntity(
 *      fieldMapping = {"nome": "nome"},
 *      entityClass="SuppCore\AdministrativoBackend\Entity\Estado",
 *      message = "Campo já está em utilização!"
 * )
 *
 * @DTOMapper\JsonLD(
 *     jsonLDId="/v1/administrativo/estado/{id}",
 *     jsonLDType="Estado",
 *     jsonLDContext="/api/doc/#model-Estado"
 * )
 *
 * @Form\Form()
 */
class Estado extends RestDto
{
    use IdUuid;
    use Nome;
    use Ativo;
    use Timeblameable;
    use Blameable;
    use Softdeleteable;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=true
     * )
     *
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Filter\ToUpper(encoding="UTF-8")
     *
     * @Assert\NotBlank(
     *     message="O campo não pode estar em branco!"
     * )
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     * @Assert\Length(
     *     min = 2,
     *     exactMessage="O campo deve ter caracteres!",
     *     max = 2
     * )
     *
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $uf = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Pais",
     *     required=true
     * )
     *
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @OA\Property(ref=@Model(type=PaisDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Pais")
     */
    protected ?EntityInterface $pais = null;

    /**
     * Set uf.
     */
    public function setUf(?string $uf): self
    {
        $this->setVisited('uf');

        $this->uf = $uf;

        return $this;
    }

    /**
     * Get uf.
     */
    public function getUf(): ?string
    {
        return $this->uf;
    }

    /**
     * @return EntityInterface|PaisDTO|PaisEntity|null
     */
    public function getPais(): ?EntityInterface
    {
        return $this->pais;
    }

    /**
     * @param EntityInterface|PaisDTO|PaisEntity|null $pais
     */
    public function setPais(?EntityInterface $pais): self
    {
        $this->setVisited('pais');

        $this->pais = $pais;

        return $this;
    }
}
