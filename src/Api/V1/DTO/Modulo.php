<?php

/** @noinspection PhpUnused */
declare(strict_types=1);
/**
 * /src/Api/V1/DTO/Modulo.php.
 *
 * @author  Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\DTO;

use DMS\Filter\Rules as Filter;
use SuppCore\AdministrativoBackend\DTO\RestDto;
use SuppCore\AdministrativoBackend\DTO\Traits\Blameable;
use SuppCore\AdministrativoBackend\DTO\Traits\Descricao;
use SuppCore\AdministrativoBackend\DTO\Traits\IdUuid;
use SuppCore\AdministrativoBackend\DTO\Traits\Nome;
use SuppCore\AdministrativoBackend\DTO\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\DTO\Traits\Timeblameable;
use SuppCore\AdministrativoBackend\Form\Annotations as Form;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;
use SuppCore\AdministrativoBackend\Mapper\Annotations\Mapper;
use SuppCore\AdministrativoBackend\DTO\Traits\Ativo;
use SuppCore\AdministrativoBackend\DTO\Traits\Sigla;
use OpenApi\Annotations as OA;

/**
 * Class Modulo.
 *
 * @author  Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @Mapper(class="SuppCore\AdministrativoBackend\Mapper\DefaultMapper")
 *
 * @Form\Form()
 * @DTOMapper\JsonLD(
 *     jsonLDId="/v1/administrativo/modelo/{id}",
 *     jsonLDType="Modulo",
 *     jsonLDContext="/api/doc/#model-Modulo"
 * )
 */
class Modulo extends RestDto
{
    use Timeblameable;
    use Blameable;
    use Softdeleteable;

    use IdUuid;
    use Nome;
    use Descricao;
    use Sigla;
    use Ativo;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=false
     * )
     *
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     *
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $prefixo = null;

    /**
     * Modulo constructor.
     */
    public function __construct()
    {
        $this->setAtivo(true);
    }

    /**
     * @return string|null
     */
    public function getPrefixo(): ?string
    {
        return $this->prefixo;
    }

    /**
     * @param string|null $prefixo
     *
     * @return Modulo
     */
    public function setPrefixo(?string $prefixo): self
    {
        $this->setVisited('prefixo');
        $this->prefixo = $prefixo;

        return $this;
    }
}
