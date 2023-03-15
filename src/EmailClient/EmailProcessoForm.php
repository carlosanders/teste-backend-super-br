<?php
declare(strict_types=1);

namespace SuppCore\AdministrativoBackend\EmailClient;

use SuppCore\AdministrativoBackend\Api\V1\DTO\Processo as ProcessoDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\ContaEmail as ContaEmailDTO;
use SuppCore\AdministrativoBackend\DTO\RestDto;
use SuppCore\AdministrativoBackend\DTO\Traits\IdUuid;
use JMS\Serializer\Annotation as Serializer;
use OpenApi\Annotations as OA;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;
use SuppCore\AdministrativoBackend\Form\Annotations as Form;
use Nelmio\ApiDocBundle\Annotation\Model;

/**
 * Class Message
 * @package SuppCore\AdministrativoBackend\EmailProcessoForm
 * @Form\Form()
 */
class EmailProcessoForm extends RestDto
{
    use IdUuid;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=true
     * )
     * @OA\Property(type="string")
     */
    protected ?string $tipo = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=true
     * )
     * @OA\Property(type="string")
     */
    protected string|int|null $folderIdentifier = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=true
     * )
     * @OA\Property(type="string")
     */
    protected string|int|null $messageIdentifier = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Processo",
     *     required=false
     * )
     * @Serializer\Groups("default")
     * @OA\Property(ref=@Model(type=ProcessoDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Processo")
     */
    protected ?EntityInterface $processo = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\ContaEmail",
     *     required=true
     * )
     * @Serializer\Groups("default")
     * @OA\Property(ref=@Model(type=ContaEmailDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\ContaEmail")
     */
    protected ?EntityInterface $contaEmail = null;

    /**
     * @return string|null
     */
    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    /**
     * @param string|null $tipo
     * @return self
     */
    public function setTipo(string $tipo): self
    {
        $this->setVisited('tipo');
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * @return string|int|null
     */
    public function getFolderIdentifier(): string|int|null
    {
        return $this->folderIdentifier;
    }

    /**
     * @param string|int|null $folderIdentifier
     * @return self
     */
    public function setFolderIdentifier(string|int|null $folderIdentifier): self
    {
        $this->setVisited('folderIdentifier');
        $this->folderIdentifier = $folderIdentifier;

        return $this;
    }

    /**
     * @return string|int|null
     */
    public function getMessageIdentifier(): string|int|null
    {
        return $this->messageIdentifier;
    }

    /**
     * @param string|int|null $messageIdentifier
     * @return self
     */
    public function setMessageIdentifier(string|int|null $messageIdentifier): self
    {
        $this->setVisited('messageIdentifier');
        $this->messageIdentifier = $messageIdentifier;

        return $this;
    }

    /**
     * @return EntityInterface|null
     */
    public function getProcesso(): ?EntityInterface
    {
        return $this->processo;
    }

    /**
     * @param EntityInterface|null $processo
     * @return self
     */
    public function setProcesso(?EntityInterface $processo): self
    {
        $this->setVisited('processo');
        $this->processo = $processo;

        return $this;
    }

    /**
     * @return EntityInterface|null
     */
    public function getContaEmail(): ?EntityInterface
    {
        return $this->contaEmail;
    }

    /**
     * @param EntityInterface|null $contaEmail
     * @return self
     */
    public function setContaEmail(?EntityInterface $contaEmail): self
    {
        $this->setVisited('contaEmail');
        $this->contaEmail = $contaEmail;

        return $this;
    }
}
