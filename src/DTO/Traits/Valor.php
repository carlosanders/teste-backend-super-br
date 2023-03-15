<?php

declare(strict_types=1);
/**
 * /src/DTO/Traits/ValorDescricao.php.
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
 * Trait ValorDescricao.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
trait Valor
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
     * @Assert\NotNull(
     *     message="O campo não pode estar em branco!"
     * )
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     * @Assert\Length(
     *     min = 3,
     *     minMessage = "O campo deve ter no mínimo 3 caracteres!",
     *     max = 255,
     *     maxMessage = "O campo deve ter no máximo 255 caracteres!"
     * )
     *
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $valor = null;

    /**
     * Set valor.
     *
     * @param string|null $valor
     *
     * @return self
     */
    public function setValor(?string $valor): self
    {
        $this->setVisited('valor');

        $this->valor = $valor;

        return $this;
    }

    /**
     * Get valor.
     *
     * @return string|null
     */
    public function getValor(): ?string
    {
        return $this->valor;
    }
}
