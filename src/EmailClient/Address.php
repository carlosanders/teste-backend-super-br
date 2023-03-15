<?php
declare(strict_types=1);

namespace SuppCore\AdministrativoBackend\EmailClient;


use SuppCore\AdministrativoBackend\DTO\RestDto;
use OpenApi\Annotations as OA;
use SuppCore\AdministrativoBackend\DTO\Traits\IdUuid;
use SuppCore\AdministrativoBackend\Form\Annotations as Form;
use Nelmio\ApiDocBundle\Annotation\Model;

/**
 * Class Address
 * @package SuppCore\AdministrativoBackend\EmailClient
 */
class Address extends RestDto
{
    use IdUuid;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=false
     * )
     * @OA\Property(type="string")
     */
    protected ?string $email = '';

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=false
     * )
     * @OA\Property(type="string")
     */
    protected ?string $name = '';

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=false
     * )
     * @OA\Property(type="string")
     */
    protected ?string $full = '';

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     * @return Address
     */
    public function setEmail(?string $email): Address
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return Address
     */
    public function setName(?string $name): Address
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFull(): ?string
    {
        return $this->full;
    }

    /**
     * @param string|null $full
     * @return Address
     */
    public function setFull(?string $full): Address
    {
        $this->full = $full;

        return $this;
    }
}
