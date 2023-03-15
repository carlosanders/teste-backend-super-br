<?php

declare(strict_types=1);
/**
 * /src/Entity/ConfigModulo.php.
 *
 * @author  Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Gedmo\Mapping\Annotation as Gedmo;
use SuppCore\AdministrativoBackend\Entity\Traits\Blameable;
use SuppCore\AdministrativoBackend\Entity\Traits\Descricao;
use SuppCore\AdministrativoBackend\Entity\Traits\Id;
use SuppCore\AdministrativoBackend\Entity\Traits\NomeMinusculo;
use SuppCore\AdministrativoBackend\Entity\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\Entity\Traits\Timestampable;
use SuppCore\AdministrativoBackend\Entity\Traits\Uuid;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use DMS\Filter\Rules as Filter;

/**
 * Class ConfigModulo.
 *
 *  @ORM\Table(
 *     name="ad_config_modulo",
 *     indexes={
 *          @ORM\Index(columns={"apagado_em", "id"})
 *      },
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(columns={"sigla", "apagado_em"}),
 *     }
 * )
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 * @UniqueEntity(
 *     fields = {"sigla"},
 *     message = "Sigla já está em utilização para essa classe!"
 * )
 *
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 *
 * @author  Advocacia-Geral da União <supp@agu.gov.br>
 */
class ConfigModulo implements EntityInterface
{
    // Traits
    use Blameable;
    use Timestampable;
    use Softdeleteable;

    use Id;
    use Uuid;
    use NomeMinusculo;
    use Descricao;

    public const SCHEMA_MARCADOR = '{{uri}}';

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
     * @ORM\Column(
     *     name="data_schema",
     *     type="text",
     *     nullable=true
     * )
     *
     * @var string|null
     */
    protected ?string $dataSchema = null;

    /**
     * @Assert\Choice(choices=ConfigModulo::ALLOWED_TYPES)
     * @ORM\Column(
     *     name="data_type",
     *     type="string",
     *     nullable=false
     * )
     *
     * @var string
     */
    protected string $dataType = 'json';

    /**
     * @ORM\Column(
     *     type="boolean",
     *     nullable=false
     * )
     *
     * @var bool
     */
    protected bool $mandatory = true;

    /**
     * @ORM\Column(
     *     type="boolean",
     *     nullable=false
     * )
     *
     * @var bool
     */
    protected bool $invalid = false;

    /**
     * @ORM\Column(
     *     name="data_value",
     *     type="text",
     *     nullable=true
     * )
     *
     * @var string|null
     */
    protected ?string $dataValue = null;

    /**
     *
     * @ORM\ManyToOne(
     *     targetEntity="SuppCore\AdministrativoBackend\Entity\Modulo"
     * )
     * @ORM\JoinColumn(
     *     name="modulo_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected Modulo $modulo;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="SuppCore\AdministrativoBackend\Entity\ConfigModulo"
     * )
     * @ORM\JoinColumn(
     *     name="config_module_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?self $paradigma = null;

    /**
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Filter\ToUpper(encoding="UTF-8")
     * @ORM\Column(
     *     type="string",
     *     length=255,
     *     nullable=true
     * )
     */
    protected ?string $sigla = null;

    /**
     * ConfigModulo constructor.
     *
     * @throws Exception
     */
    public function __construct()
    {
        $this->setUuid();
    }

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
        $this->dataSchema = $dataSchema;

        return $this;
    }

    /**
     * @return string
     */
    public function getDataType(): string
    {
        return $this->dataType;
    }

    /**
     * @param string $dataType
     *
     * @return self
     * @noinspection PhpUnused
     */
    public function setDataType(string $dataType): self
    {
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
        $this->invalid = $invalid;

        return $this;
    }

    /**
     * @return string|null
     * @noinspection PhpUnused
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
        $this->dataValue = $dataValue;

        return $this;
    }

    /**
     * @return Modulo
     */
    public function getModulo(): Modulo
    {
        return $this->modulo;
    }

    /**
     * @param Modulo $modulo
     * @return self
     */
    public function setModulo(Modulo $modulo): self
    {
        $this->modulo = $modulo;

        return $this;
    }

    /**
     * @return self|null
     */
    public function getParadigma(): ?self
    {
        return $this->paradigma;
    }

    /**
     * @param self|null $paradigma
     *
     * @return self
     */
    public function setParadigma(?self $paradigma): self
    {
        $this->paradigma = $paradigma;

        return $this;
    }

    /**
     * @return string|float|bool|int|DateTime|array
     */
    public function getValue(): string|float|bool|int|DateTime|array
    {
        return match ($this->dataType) {
            'string' => $this->dataValue,
            'float' => floatval($this->dataValue),
            'bool' => boolval($this->dataValue),
            'int' => intval($this->dataValue),
            'datetime' => ((strlen($this->dataValue) === 10) ?
                DateTime::createFromFormat('d/m/Y', $this->dataValue) :
                DateTime::createFromFormat('d/m/Y H:i:s', $this->dataValue)),
            'json' => json_decode($this->dataValue, true),
        };
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
        $this->sigla = $sigla;

        return $this;
    }
}
