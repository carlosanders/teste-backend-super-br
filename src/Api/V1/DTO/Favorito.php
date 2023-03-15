<?php

declare(strict_types=1);
/**
 * /src/Api/V1/DTO/Favorito.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\DTO;

use JMS\Serializer\Annotation as Serializer;
use Nelmio\ApiDocBundle\Annotation\Model;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Usuario as UsuarioDTO;
use SuppCore\AdministrativoBackend\DTO\RestDto;
use SuppCore\AdministrativoBackend\DTO\Traits\Blameable;
use SuppCore\AdministrativoBackend\DTO\Traits\IdUuid;
use SuppCore\AdministrativoBackend\DTO\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\DTO\Traits\Timeblameable;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\Usuario as UsuarioEntity;
use SuppCore\AdministrativoBackend\Form\Annotations as Form;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;
use OpenApi\Annotations as OA;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Favorito.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @DTOMapper\JsonLD(
 *     jsonLDId="/v1/administrativo/favorito/{id}",
 *     jsonLDType="Favorito",
 *     jsonLDContext="/api/doc/#model-Favorito"
 * )
 *
 * @Form\Form()
 */
class Favorito extends RestDto
{
    use IdUuid;
    use Blameable;
    use Softdeleteable;
    use Timeblameable;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Usuario",
     *     required=true
     * )
     *
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @OA\Property(ref=@Model(type=UsuarioDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Usuario")
     */
    protected ?EntityInterface $usuario = null;

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
    protected string $objectClass = '';

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\NumberType",
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
     * @OA\Property(type="integer", default=0)
     * @DTOMapper\Property()
     */
    protected int $objectId = 0;

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
    protected string $label = '';

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=false
     * )
     *
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected string $context = '';

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\CheckboxType",
     *     required=true
     * )
     *
     * @OA\Property(type="boolean")
     * @DTOMapper\Property()
     */
    protected bool $prioritario = false;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\NumberType",
     *     required=false
     * )
     *
     * @OA\Property(type="integer", default=0)
     * @DTOMapper\Property()
     */
    protected int $qtdUso = 0;

    /**
     * @var array
     * @Serializer\SkipWhenEmpty()
     */
    protected $objFavoritoClass = [];

    /**
     * Favorito constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return Usuario|EntityInterface|UsuarioEntity|null
     */
    public function getUsuario(): ?EntityInterface
    {
        return $this->usuario;
    }

    /**
     * @param Usuario|EntityInterface|UsuarioEntity|null $usuario
     *
     * @return Favorito
     */
    public function setUsuario(?EntityInterface $usuario): self
    {
        $this->setVisited('usuario');

        $this->usuario = $usuario;

        return $this;
    }

    public function getObjectClass(): ?string
    {
        return $this->objectClass;
    }

    /**
     * @return Favorito
     */
    public function setObjectClass(string $objectClass): self
    {
        $this->setVisited('objectClass');

        $this->objectClass = $objectClass;

        return $this;
    }

    public function getObjectId(): ?int
    {
        return $this->objectId;
    }

    /**
     * @return Favorito
     */
    public function setObjectId(int $objectId): self
    {
        $this->setVisited('objectId');

        $this->objectId = $objectId;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * @return Favorito
     */
    public function setLabel(string $label): self
    {
        $this->setVisited('label');

        $this->label = $label;

        return $this;
    }

    public function getContext(): ?string
    {
        return $this->context;
    }

    /**
     * @return Favorito
     */
    public function setContext(string $context): self
    {
        $this->setVisited('context');

        $this->context = $context;

        return $this;
    }

    public function getPrioritario(): ?bool
    {
        return $this->prioritario;
    }

    /**
     * @return Favorito
     */
    public function setPrioritario(bool $prioritario): self
    {
        $this->setVisited('prioritario');

        $this->prioritario = $prioritario;

        return $this;
    }

    public function getQtdUso(): ?int
    {
        return $this->qtdUso;
    }

    /**
     * @return Favorito
     */
    public function setQtdUso(int $qtdUso): self
    {
        $this->setVisited('qtdUso');

        $this->qtdUso = $qtdUso;

        return $this;
    }

    public function getObjFavoritoClass(): ?array
    {
        return $this->objFavoritoClass;
    }

    /**
     * @param $objFavoritoClass
     *
     * @return Favorito
     */
    public function setObjFavoritoClass($objFavoritoClass): self
    {
        $this->setVisited('objFavoritoClass');

        $this->objFavoritoClass[] = $objFavoritoClass;

        return $this;
    }
}
