<?php

declare(strict_types=1);
/**
 * /src/DTO/Traits/Ativo.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DTO\Traits;

use SuppCore\AdministrativoBackend\Form\Annotations as Form;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;
use OpenApi\Annotations as OA;

/**
 * Trait Ativo.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
trait Ativo
{
    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\CheckboxType",
     *     required=false,
     *     methods={
     *          @Form\Method(
     *              "createMethod",
     *              roles={
     *                  "ROLE_ADMIN"
     *              }
     *          ),
     *          @Form\Method(
     *              "updateMethod",
     *              roles={
     *                  "ROLE_ADMIN"
     *              }
     *          ),
     *          @Form\Method(
     *              "patchMethod",
     *              roles={
     *                  "ROLE_ADMIN"
     *              }
     *          )
     *     }
     * )
     *
     * @OA\Property(type="boolean", default=true)
     * @DTOMapper\Property()
     */
    protected ?bool $ativo = true;

    /**
     * Set ativo.
     *
     * @param bool|null $ativo
     *
     * @return self
     */
    public function setAtivo(?bool $ativo): self
    {
        $this->setVisited('ativo');

        $this->ativo = $ativo;

        return $this;
    }

    /**
     * Get ativo|null.
     *
     * @return bool|null
     */
    public function getAtivo(): ?bool
    {
        return $this->ativo;
    }
}
