<?php
declare(strict_types=1);

namespace SuppCore\AdministrativoBackend\Timeline;


use DateTime;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Usuario as UsuarioDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Tarefa as TarefaDTO;
use SuppCore\AdministrativoBackend\DTO\RestDto;
use OpenApi\Annotations as OA;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Form\Annotations as Form;
use Nelmio\ApiDocBundle\Annotation\Model;
use JMS\Serializer\Annotation as Serializer;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;


/**
 * Timeline Event Class
 */
class TimelineEvent extends RestDto
{

    /**
     * @Serializer\Exclude()
     * @OA\Property(type="integer")
     * @DTOMapper\Property()
     */
    protected ?int $id = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=false
     * )
     * @OA\Property(type="string")
     */
    protected ?string $message = '';

    /**
     * @OA\Property(type="string", format="date-time")
     * @DTOMapper\Property()
     */
    protected ?DateTime $eventDate = null;

    /**
     * @OA\Property(ref=@Model(type=UsuarioDTO::class))
     *
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Usuario")
     */
    protected RestDtoInterface $usuario;

    /**
     * @OA\Property(ref=@Model(type=TarefaDTO::class))
     *
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Tarefa")
     */
    protected RestDtoInterface $tarefa;

    /**
     * @OA\Property(ref=@Model(type=EventType::class))
     *
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Timeline\EventType")
     */
    protected RestDtoInterface $typeEvent;

    /**
     * @OA\Property(type="string")
     */
    protected ?string $objectContext = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\CheckboxType",
     *     required=false
     * )
     *
     * @OA\Property(type="boolean", default=false)
     * @DTOMapper\Property()
     */
    protected bool $lastEvent = false;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\CheckboxType",
     *     required=false
     * )
     *
     * @OA\Property(type="boolean", default=false)
     * @DTOMapper\Property()
     */
    protected bool $firstEvent = false;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @param string|null $message
     * @return self
     */
    public function setMessage(?string $message): self
    {
        $this->setVisited('message');
        $this->message = $message;

        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getEventDate(): ?DateTime
    {
        return $this->eventDate;
    }

    /**
     * @param DateTime|null $eventDate
     * @return self
     */
    public function setEventDate(?DateTime $eventDate): self
    {
        $this->setVisited('eventDate');
        $this->eventDate = $eventDate;

        return $this;
    }

    /**
     * @return RestDtoInterface
     */
    public function getUsuario(): RestDtoInterface
    {
        return $this->usuario;
    }

    /**
     * @param RestDtoInterface $usuario
     * @return self
     */
    public function setUsuario(RestDtoInterface $usuario): self
    {
        $this->setVisited('usuario');
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * @return RestDtoInterface
     */
    public function getTypeEvent(): RestDtoInterface
    {
        return $this->typeEvent;
    }

    /**
     * @param RestDtoInterface $typeEvent
     * @return self
     */
    public function setTypeEvent(RestDtoInterface $typeEvent): self
    {
        $this->setVisited('typeEvent');
        $this->typeEvent = $typeEvent;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getObjectContext(): ?string
    {
        return $this->objectContext;
    }

    /**
     * @param string|null $objectContext
     * @return self
     */
    public function setObjectContext(?string $objectContext): self
    {
        $this->setVisited('objectContext');
        $this->objectContext = $objectContext;

        return $this;
    }

    /**
     * @return RestDtoInterface
     */
    public function getTarefa(): RestDtoInterface
    {
        return $this->tarefa;
    }

    /**
     * @param RestDtoInterface $tarefa
     * @return self
     */
    public function setTarefa(RestDtoInterface $tarefa): self
    {
        $this->setVisited('tarefa');
        $this->tarefa = $tarefa;

        return $this;
    }

    /**
     * @return bool
     */
    public function getLastEvent(): bool
    {
        return $this->lastEvent;
    }

    /**
     * @param bool $lastEvent
     * @return self
     */
    public function setLastEvent(bool $lastEvent): self
    {
        $this->setVisited('lastEvent');
        $this->lastEvent = $lastEvent;

        return $this;
    }

    /**
     * @return bool
     */
    public function getFirstEvent(): bool
    {
        return $this->firstEvent;
    }

    /**
     * @param bool $firstEvent
     * @return self
     */
    public function setFirstEvent(bool $firstEvent): self
    {
        $this->setVisited('firstEvent');
        $this->firstEvent = $firstEvent;

        return $this;
    }

}
