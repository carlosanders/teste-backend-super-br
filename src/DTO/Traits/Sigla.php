<?php

declare(strict_types=1);
/**
 * /src/DTO/Traits/SiglaDescricao.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DTO\Traits;

use DMS\Filter\Rules as Filter;
use SuppCore\AdministrativoBackend\Form\Annotations as Form;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;
use OpenApi\Annotations as OA;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Trait SiglaDescricao.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
trait Sigla
{
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
     * @Assert\Regex(
     *     pattern="/[A-Z0-9]+/",
     *     message="A sigla do template deve possuir apenas letras maiúsculas ou números."
     * )
     * @Assert\Length(
     *     min = 3,
     *     max = 25,
     *     minMessage = "A sigla deve ter no mínimo {{ limit }} letras ou números",
     *     maxMessage = "A sigla deve ter no máximo {{ limit }} letras ou números"
     * )
     *
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $sigla = null;

    /**
     * Set sigla.
     *
     * @param string|null $sigla
     *
     * @return self
     */
    public function setSigla(?string $sigla): self
    {
        $this->setVisited('sigla');

        $this->sigla = $sigla;

        return $this;
    }

    /**
     * Get sigla.
     *
     * @return string|null
     */
    public function getSigla(): ?string
    {
        return $this->sigla;
    }
}
