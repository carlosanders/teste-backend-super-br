<?php

declare(strict_types=1);
/**
 * /src/Api/V1/DTO/ConfigModulo.php.
 *
 * @author  Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\DTO;

use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Model;
use SuppCore\AdministrativoBackend\DTO\RestDto;
use SuppCore\AdministrativoBackend\DTO\Traits\Blameable;
use SuppCore\AdministrativoBackend\DTO\Traits\Descricao;
use SuppCore\AdministrativoBackend\DTO\Traits\IdUuid;
use SuppCore\AdministrativoBackend\DTO\Traits\NomeMinusculo;
use SuppCore\AdministrativoBackend\DTO\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\DTO\Traits\Timeblameable;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Form\Annotations as Form;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Modulo as ModuloDTO;
use SuppCore\AdministrativoBackend\Entity\Modulo as ModuloEntity;
use Symfony\Component\Validator\Constraints as Assert;
use SuppCore\AdministrativoBackend\Entity\ConfigModulo as ConfigModuloEntity;
use SuppCore\AdministrativoBackend\Api\V1\DTO\ConfigModulo as ConfigModuloDTO;
use SuppCore\AdministrativoBackend\Validator\Constraints as AppAssert;
use DMS\Filter\Rules as Filter;

/**
 * Class ConfigModulo.
 *
 * @author  Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @AppAssert\DtoUniqueEntity(
 *      fieldMapping = {
 *          "sigla": "sigla",
 *          "apagadoEm": "apagadoEm"
 *      },
 *      entityClass="SuppCore\AdministrativoBackend\Entity\ConfigModulo",
 *      message = "Campo já está em utilização!"
 * )
 *
 * @DTOMapper\JsonLD(
 *     jsonLDId="/v1/administrativo/config_module/{id}",
 *     jsonLDType="ConfigModulo",
 *     jsonLDContext="/api/doc/#model-ConfigModulo"
 * )
 *
 * @Form\Form()
 */
class ConfigModulo extends RestDto
{
    use Blameable;
    use Timeblameable;
    use Softdeleteable;

    use IdUuid;
    use NomeMinusculo;
    use Descricao;

    public const ALLOWED_TYPES = [
        'string',
        'float',
        'bool',
        'int',
        'string',
        'datetime',
        'json',
    ];

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=false
     * )
     *
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $dataSchema = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=true
     * )
     *
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @Assert\Choice(choices=ConfigModuloEntity::ALLOWED_TYPES)
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $dataType = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\CheckboxType",
     *     required=false
     * )
     *
     * @OA\Property(type="boolean")
     * @DTOMapper\Property()
     */
    protected bool $mandatory = true;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\CheckboxType",
     *     required=false
     * )
     *
     * @OA\Property(type="boolean")
     * @DTOMapper\Property()
     */
    protected bool $invalid = false;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=false
     * )
     *
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $dataValue = null;

    /**
     * @var ModuloEntity|ModuloDTO|null
     *
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Modulo",
     *     required=true
     * )
     *
     * @Assert\NotBlank(
     *     message="O campo não pode estar em branco!"
     * )
     * @Assert\NotNull(
     *     message="Campo não pode ser nulo!"
     * )
     *
     * @OA\Property(ref=@Model(type="SuppCore\AdministrativoBackend\Api\V1\DTO\Modulo"))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Modulo")
     */
    protected ?EntityInterface $modulo = null;

    /**
     * @var ConfigModuloDTO|ConfigModuloEntity|null
     *
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\ConfigModulo",
     *     required=false
     * )
     *
     * @OA\Property(ref=@Model(type="SuppCore\AdministrativoBackend\Api\V1\DTO\ConfigModulo"))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\ConfigModulo")
     */
    protected ?EntityInterface $paradigma = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=false
     * )
     *
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Filter\ToUpper(encoding="UTF-8")
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $sigla = null;

    /**
     * @return string|null
     */
    public function getDataSchema(): ?string
    {
        return $this->dataSchema;
    }

    /**
     * @param string|null $dataSchema
     *
     * @return self
     * @noinspection PhpUnused
     */
    public function setDataSchema(?string $dataSchema): self
    {
        $this->setVisited('dataSchema');
        $this->dataSchema = $dataSchema;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDataType(): ?string
    {
        return $this->dataType;
    }

    /**
     * @param string|null $dataType
     *
     * @return self
     * @noinspection PhpUnused
     */
    public function setDataType(?string $dataType): self
    {
        $this->setVisited('dataType');
        $this->dataType = $dataType;

        return $this;
    }

    /**
     * @return bool
     * @noinspection PhpUnused
     */
    public function getMandatory(): bool
    {
        return $this->mandatory;
    }

    /**
     * @param bool $mandatory
     *
     * @return self
     * @noinspection PhpUnused
     */
    public function setMandatory(bool $mandatory): self
    {
        $this->setVisited('mandatory');
        $this->mandatory = $mandatory;

        return $this;
    }

    /**
     * @return bool
     * @noinspection PhpUnused
     */
    public function getInvalid(): bool
    {
        return $this->invalid;
    }

    /**
     * @param bool $invalid
     *
     * @return self
     * @noinspection PhpUnused
     */
    public function setInvalid(bool $invalid): self
    {
        $this->setVisited('invalid');
        $this->invalid = $invalid;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDataValue(): ?string
    {
        return $this->dataValue;
    }

    /**
     * @param string|null $dataValue
     *
     * @return self
     * @noinspection PhpUnused
     */
    public function setDataValue(?string $dataValue): self
    {
        $this->setVisited('dataValue');
        $this->dataValue = $dataValue;

        return $this;
    }

    /**
     * @return ModuloDTO|ModuloEntity|null
     */
    public function getModulo(): ?EntityInterface
    {
        return $this->modulo;
    }

    /**
     * @param ModuloDTO|ModuloEntity $modulo
     * @return self
     */
    public function setModulo(EntityInterface $modulo): self
    {
        $this->setVisited('modulo');
        $this->modulo = $modulo;
        return $this;
    }

    /**
     * @return ConfigModuloDTO|ConfigModuloEntity|null
     */
    public function getParadigma(): ?EntityInterface
    {
        return $this->paradigma;
    }

    /**
     * @param ConfigModuloDTO|ConfigModuloEntity|null $paradigma
     *
     * @return self
     */
    public function setParadigma(?EntityInterface $paradigma): self
    {
        $this->setVisited('paradigma');
        $this->paradigma = $paradigma;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSigla(): ?string
    {
        return $this->sigla;
    }

    /**
     * @param string|null $sigla
     * @return $this
     */
    public function setSigla(?string $sigla): self
    {
        $this->setVisited('sigla');
        $this->sigla = $sigla;

        return $this;
    }
}
