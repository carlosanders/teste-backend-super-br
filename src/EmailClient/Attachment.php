<?php
declare(strict_types=1);

namespace SuppCore\AdministrativoBackend\EmailClient;


use SuppCore\AdministrativoBackend\DTO\RestDto;
use OpenApi\Annotations as OA;
use SuppCore\AdministrativoBackend\DTO\Traits\IdUuid;
use SuppCore\AdministrativoBackend\Form\Annotations as Form;
use JMS\Serializer\Annotation as Serializer;
use Nelmio\ApiDocBundle\Annotation\Model;

/**
 * Class Attachment
 * @package SuppCore\AdministrativoBackend\EmailClient
 */
class Attachment extends RestDto
{
    use IdUuid;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=false
     * )
     *
     * @Serializer\Accessor(getter="getContent",setter="setContent")
     *
     * @OA\Property(type="string")
     */
    protected ?string $content = '';

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=false
     * )
     *
     * @OA\Property(type="string")
     */
    protected ?string $mimetype = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=true
     * )
     *
     * @OA\Property(type="string")
     */
    protected ?string $fileName = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=true
     * )
     *
     * @OA\Property(type="string")
     */
    protected ?string $extension = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=true
     * )
     *
     * @OA\Property(type="string")
     */
    protected ?string $imgSrc = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=true
     * )
     *
     * @OA\Property(type="string")
     */
    protected ?string $disposition = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\NumberType",
     *     required=false
     * )
     *
     * @OA\Property(type="integer")
     */
    protected ?int $size = null;

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string|null $content
     * @return Attachment
     */
    public function setContent(?string $content): Attachment
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMimetype(): ?string
    {
        return $this->mimetype;
    }

    /**
     * @param string|null $mimetype
     * @return Attachment
     */
    public function setMimetype(?string $mimetype): Attachment
    {
        $this->mimetype = $mimetype;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    /**
     * @param string|null $fileName
     * @return Attachment
     */
    public function setFileName(?string $fileName): Attachment
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getImgSrc(): ?string
    {
        return $this->imgSrc;
    }

    /**
     * @param string|null $imgSrc
     * @return Attachment
     */
    public function setImgSrc(?string $imgSrc): Attachment
    {
        $this->imgSrc = $imgSrc;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDisposition(): ?string
    {
        return $this->disposition;
    }

    /**
     * @param string|null $disposition
     * @return Attachment
     */
    public function setDisposition(?string $disposition): Attachment
    {
        $this->disposition = $disposition;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getSize(): ?int
    {
        return $this->size;
    }

    /**
     * @param int|null $size
     * @return Attachment
     */
    public function setSize(?int $size): Attachment
    {
        $this->size = $size;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getExtension(): ?string
    {
        return $this->extension;
    }

    /**
     * @param string|null $extension
     * @return Attachment
     */
    public function setExtension(?string $extension): Attachment
    {
        $this->extension = $extension;

        return $this;
    }
}
