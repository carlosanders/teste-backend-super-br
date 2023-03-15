<?php

declare(strict_types=1);
/**
 * /src/DTO/Traits/OrigemDados.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DTO\Traits;

use Nelmio\ApiDocBundle\Annotation\Model;
use SuppCore\AdministrativoBackend\Api\V1\DTO\OrigemDados as OrigemDadosDTO;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\OrigemDados as OrigemDadosEntity;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;
use OpenApi\Annotations as OA;

/**
 * Trait OrigemDados.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
trait OrigemDados
{
    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\OrigemDados",
     *     required=false,
     *     methods={
     *          @Form\Method(
     *              "createMethod",
     *              roles={
     *                  "ROLE_ROOT"
     *              }
     *          ),
     *          @Form\Method(
     *              "updateMethod",
     *              roles={
     *                  "ROLE_ROOT"
     *              }
     *          ),
     *          @Form\Method(
     *              "patchMethod",
     *              roles={
     *                  "ROLE_ROOT"
     *              }
     *          )
     *     }
     * )
     *
     * @OA\Property(ref=@Model(type=OrigemDadosDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\OrigemDados")
     */
    protected ?EntityInterface $origemDados = null;

    /**
     * @return EntityInterface|null
     */
    public function getOrigemDados(): ?EntityInterface
    {
        return $this->origemDados;
    }

    /**
     * @param EntityInterface|null $origemDados
     *
     * @return self
     */
    public function setOrigemDados(?EntityInterface $origemDados): self
    {
        $this->setVisited('origemDados');

        $this->origemDados = $origemDados;

        return $this;
    }
}
