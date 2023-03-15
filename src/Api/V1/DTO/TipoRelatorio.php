<?php

declare(strict_types=1);
/**
 * /src/Api/V1/DTO/TipoRelatorio.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\DTO;

use DMS\Filter\Rules as Filter;
use Nelmio\ApiDocBundle\Annotation\Model;
use SuppCore\AdministrativoBackend\Api\V1\DTO\EspecieRelatorio as EspecieRelatorioDTO;
use SuppCore\AdministrativoBackend\DTO\RestDto;
use SuppCore\AdministrativoBackend\DTO\Traits\Ativo;
use SuppCore\AdministrativoBackend\DTO\Traits\Blameable;
use SuppCore\AdministrativoBackend\DTO\Traits\IdUuid;
use SuppCore\AdministrativoBackend\DTO\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\DTO\Traits\Timeblameable;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\EspecieRelatorio as EspecieRelatorioEntity;
use SuppCore\AdministrativoBackend\Form\Annotations as Form;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;
use OpenApi\Annotations as OA;

/**
 * Class TipoRelatorio.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @DTOMapper\JsonLD(
 *     jsonLDId="/v1/administrativo/tipo_relatorio/{id}",
 *     jsonLDType="TipoRelatorio",
 *     jsonLDContext="/api/doc/#model-TipoRelatorio"
 * )
 *
 * @Form\Form()
 */
class TipoRelatorio extends RestDto
{
    use IdUuid;
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
     *
     * @OA\Property(type="string")
     *
     * @DTOMapper\Property()
     */
    protected ?string $nome = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=true
     * )
     *
     * @OA\Property(type="string")
     *
     * @DTOMapper\Property()
     */
    protected ?string $templateHTML = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=true
     * )
     *
     * @OA\Property(type="string")
     *
     * @DTOMapper\Property()
     */
    protected ?string $DQL = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=false
     * )
     *
     * @OA\Property(type="string")
     *
     * @DTOMapper\Property()
     */
    protected ?string $parametros = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=true
     * )
     *
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     *
     * @OA\Property(type="string")
     *
     * @DTOMapper\Property()
     */
    protected ?string $descricao = null;

    /**
     * @var EspecieRelatorioDTO|EspecieRelatorioEntity|EntityInterface|int|null
     *
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\EspecieRelatorio",
     *     required=true
     * )
     *
     * @OA\Property(ref=@Model(type=EspecieRelatorioDTO::class))
     *
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\EspecieRelatorio")
     */
    private $especieRelatorio;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\NumberType",
     *     required=false
     * )
     *
     * @OA\Property(type="integer")
     *
     * @DTOMapper\Property()
     */
    protected ?int $limite = null;

    /**
     * TipoRelatorio constructor.
     */
    public function __construct()
    {
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    /**
     * @return TipoRelatorio
     */
    public function setNome(?string $nome): self
    {
        $this->setVisited('nome');
        $this->nome = $nome;

        return $this;
    }

    public function getTemplateHTML(): ?string
    {
        return $this->templateHTML;
    }

    /**
     * @return TipoRelatorio
     */
    public function setTemplateHTML(?string $templateHTML): self
    {
        $this->setVisited('templateHTML');
        $this->templateHTML = $templateHTML;

        return $this;
    }

    public function getDQL(): ?string
    {
        return $this->DQL;
    }

    /**
     * @return TipoRelatorio
     */
    public function setDQL(?string $DQL): self
    {
        $this->setVisited('DQL');
        $this->DQL = $DQL;

        return $this;
    }

    public function getParametros(): ?string
    {
        return $this->parametros;
    }

    /**
     * @return TipoRelatorio
     */
    public function setParametros(?string $parametros): self
    {
        $this->setVisited('parametros');
        $this->parametros = $parametros;

        return $this;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    /**
     * @return TipoRelatorio
     */
    public function setDescricao(?string $descricao): self
    {
        $this->setVisited('descricao');
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * @return int|EntityInterface|EspecieRelatorio|EspecieRelatorioEntity|null
     */
    public function getEspecieRelatorio()
    {
        return $this->especieRelatorio;
    }

    /**
     * @param int|EntityInterface|EspecieRelatorio|EspecieRelatorioEntity|null $especieRelatorio
     *
     * @return TipoRelatorio
     */
    public function setEspecieRelatorio($especieRelatorio): self
    {
        $this->setVisited('especieRelatorio');
        $this->especieRelatorio = $especieRelatorio;

        return $this;
    }

    public function getLimite(): ?int
    {
        return $this->limite;
    }

    /**
     * @return TipoRelatorio
     */
    public function setLimite(?int $limite): self
    {
        $this->setVisited('limite');
        $this->limite = $limite;

        return $this;
    }
}
