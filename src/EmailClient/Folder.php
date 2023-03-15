<?php
declare(strict_types=1);

namespace SuppCore\AdministrativoBackend\EmailClient;

use SuppCore\AdministrativoBackend\DTO\RestDto;
use SuppCore\AdministrativoBackend\DTO\Traits\IdUuid;
use JMS\Serializer\Annotation as Serializer;
use OpenApi\Annotations as OA;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;
use SuppCore\AdministrativoBackend\Form\Annotations as Form;
use Nelmio\ApiDocBundle\Annotation\Model;

/**
 * Class Folder
 * @package SuppCore\AdministrativoBackend\EmailClient
 */
class Folder extends RestDto
{
    use IdUuid;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=false
     * )
     * @OA\Property(type="string")
     */
    protected ?string $path = '';

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
    protected ?string $parsedName = '';

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=false
     * )
     * @OA\Property(type="string")
     */
    protected ?string $fullname = '';

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\CheckboxType",
     *     required=false,
     * )
     *
     * @OA\Property(type="boolean", default=false)
     * @DTOMapper\Property()
     */
    protected ?bool $hasChildren = false;

    /**
     * @Serializer\SkipWhenEmpty()
     * @OA\Property(ref=@Model(type=Folder::class))
     */
    protected array $childrens = [];

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\NumberType",
     *     required=false
     * )
     * @OA\Property(type="integer")
     */
    protected ?int $totalMessages = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\NumberType",
     *     required=false
     * )
     * @OA\Property(type="integer")
     */
    protected ?int $recentMessages = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\NumberType",
     *     required=false
     * )
     * @OA\Property(type="integer")
     */
    protected ?int $unreadMessages = null;

    /**
     * @return string|null
     */
    public function getPath(): ?string
    {
        return $this->path;
    }

    /**
     * @param string|null $path
     * @return Folder
     */
    public function setPath(?string $path): Folder
    {
        $this->path = $path;

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
     * @return Folder
     */
    public function setName(?string $name): Folder
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getParsedName(): ?string
    {
        return $this->parsedName;
    }

    /**
     * @param string|null $parsedName
     * @return Folder
     */
    public function setParsedName(?string $parsedName): Folder
    {
        $this->parsedName = $parsedName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFullname(): ?string
    {
        return $this->fullname;
    }

    /**
     * @param string|null $fullname
     * @return Folder
     */
    public function setFullname(?string $fullname): Folder
    {
        $this->fullname = $fullname;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getHasChildren(): ?bool
    {
        return $this->hasChildren;
    }

    /**
     * @param bool|null $hasChildren
     * @return Folder
     */
    public function setHasChildren(?bool $hasChildren): Folder
    {
        $this->hasChildren = $hasChildren;

        return $this;
    }

    /**
     * @return array
     */
    public function getChildrens(): array
    {
        return $this->childrens;
    }

    /**
     * @param array $childrens
     * @return Folder
     */
    public function setChildrens(array $childrens): Folder
    {
        $this->childrens = $childrens;

        return $this;
    }

    /**
     * @param Folder $folder
     * @return Folder
     */
    public function addChildren(Folder $folder): Folder
    {
        $this->childrens[] = $folder;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getTotalMessages(): ?int
    {
        return $this->totalMessages;
    }

    /**
     * @param int|null $totalMessages
     * @return Folder
     */
    public function setTotalMessages(?int $totalMessages): Folder
    {
        $this->totalMessages = $totalMessages;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getRecentMessages(): ?int
    {
        return $this->recentMessages;
    }

    /**
     * @param int|null $recentMessages
     * @return Folder
     */
    public function setRecentMessages(?int $recentMessages): Folder
    {
        $this->recentMessages = $recentMessages;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getUnreadMessages(): ?int
    {
        return $this->unreadMessages;
    }

    /**
     * @param int|null $unreadMessages
     * @return Folder
     */
    public function setUnreadMessages(?int $unreadMessages): Folder
    {
        $this->unreadMessages = $unreadMessages;

        return $this;
    }
}
