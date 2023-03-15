<?php
declare(strict_types=1);

namespace SuppCore\AdministrativoBackend\EmailClient;

use DateTime;
use SuppCore\AdministrativoBackend\DTO\RestDto;
use SuppCore\AdministrativoBackend\DTO\Traits\IdUuid;
use JMS\Serializer\Annotation as Serializer;
use OpenApi\Annotations as OA;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;
use SuppCore\AdministrativoBackend\Form\Annotations as Form;
use Nelmio\ApiDocBundle\Annotation\Model;

/**
 * Class Message
 * @package SuppCore\AdministrativoBackend\EmailClient
 */
class Message extends RestDto
{
    use IdUuid;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=false
     * )
     * @OA\Property(type="string")
     */
    protected ?string $subject = '';

    /**
     * @OA\Property(type="string", format="date-time")
     * @DTOMapper\Property()
     */
    protected ?DateTime $date = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=false
     * )
     * @Serializer\Groups("default")
     * @OA\Property(type="string")
     */
    protected ?string $htmlBody = '';

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\CheckboxType",
     *     required=false,
     * )
     *
     * @OA\Property(type="boolean", default=false)
     */
    protected ?bool $readed = false;

    /**
     * @OA\Property(ref=@Model(type=Folder::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\EmailClient\Address")
     */
    protected ?Folder $folder = null;

    /**
     * @OA\Property(ref=@Model(type=Address::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\EmailClient\Address")
     */
    protected ?Address $from = null;

    /**
     * @Serializer\SkipWhenEmpty()
     * @OA\Property(ref=@Model(type=Address::class))
     */
    protected array $to = [];

    /**
     * @Serializer\SkipWhenEmpty()
     * @OA\Property(ref=@Model(type=Attachment::class))
     */
    protected array $attachments = [];

    /**
     * @Serializer\SkipWhenEmpty()
     * @OA\Property(ref=@Model(type=Address::class))
     */
    protected array $cc = [];

    /**
     * @Serializer\SkipWhenEmpty()
     * @OA\Property(ref=@Model(type=Address::class))
     */
    protected array $bcc = [];

    /**
     * @return Address|null
     */
    public function getFrom(): ?Address
    {
        return $this->from;
    }

    /**
     * @param Address|null $from
     * @return Message
     */
    public function setFrom(?Address $from): Message
    {
        $this->from = $from;

        return $this;
    }

    /**
     * @return array
     */
    public function getTo(): array
    {
        return $this->to;
    }

    /**
     * @param array $to
     * @return Message
     */
    public function setTo(array $to): Message
    {
        $this->to = $to;

        return $this;
    }

    /**
     * @param Address $to
     * @return Message
     */
    public function addTo(Address $to): Message
    {
        $this->to[] = $to;

        return $this;
    }

    /**
     * @return array
     */
    public function getCc(): array
    {
        return $this->cc;
    }

    /**
     * @param array $cc
     * @return Message
     */
    public function setCc(array $cc): Message
    {
        $this->cc = $cc;

        return $this;
    }

    /**
     * @param Address $cc
     * @return Message
     */
    public function addCc(Address $cc): Message
    {
        $this->cc[] = $cc;

        return $this;
    }

    /**
     * @return array
     */
    public function getBcc(): array
    {
        return $this->bcc;
    }

    /**
     * @param array $bcc
     * @return Message
     */
    public function setBcc(array $bcc): Message
    {
        $this->bcc = $bcc;

        return $this;
    }

    /**
     * @param Address $bcc
     * @return Message
     */
    public function addBcc(Address $bcc): Message
    {
        $this->bcc[] = $bcc;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSubject(): ?string
    {
        return $this->subject;
    }

    /**
     * @param string|null $subject
     * @return Message
     */
    public function setSubject(?string $subject): Message
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getDate(): ?DateTime
    {
        return $this->date;
    }

    /**
     * @param DateTime|null $date
     * @return Message
     */
    public function setDate(?DateTime $date): Message
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getHtmlBody(): ?string
    {
        return $this->htmlBody;
    }

    /**
     * @param string|null $htmlBody
     * @return Message
     */
    public function setHtmlBody(?string $htmlBody): Message
    {
        $this->htmlBody = $htmlBody;

        return $this;
    }

    /**
     * @return Folder|null
     */
    public function getFolder(): ?Folder
    {
        return $this->folder;
    }

    /**
     * @param Folder|null $folder
     * @return Message
     */
    public function setFolder(?Folder $folder): Message
    {
        $this->folder = $folder;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getReaded(): ?bool
    {
        return $this->readed;
    }

    /**
     * @param bool|null $readed
     * @return Message
     */
    public function setReaded(?bool $readed): Message
    {
        $this->readed = $readed;

        return $this;
    }

    /**
     * @return array
     */
    public function getAttachments(): array
    {
        return $this->attachments;
    }

    /**
     * @param array $attachments
     * @return Message
     */
    public function setAttachments(array $attachments): Message
    {
        $this->attachments = $attachments;

        return $this;
    }

    /**
     * @param Attachment $attachment
     * @return Message
     */
    public function addAttachment(Attachment $attachment): Message
    {
        $this->attachments[] = $attachment;

        return $this;
    }
}
