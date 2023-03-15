<?php

namespace SuppCore\AdministrativoBackend\Timeline;

use SuppCore\AdministrativoBackend\DTO\RestDto;
use OpenApi\Annotations as OA;
use JMS\Serializer\Annotation as Serializer;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;

/**
 * Type Event Class
 */
class EventType extends RestDto
{

    /**
     * @Serializer\Exclude()
     * @OA\Property(type="integer")
     * @DTOMapper\Property()
     */
    protected ?int $id = null;

    /**
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $name = null;

    /**
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $action = null;

    /**
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $objectClass = null;

    /**
     * @OA\Property(type="integer")
     */
    protected ?int $objectId = null;

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
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return self
     */
    public function setName(?string $name): self
    {
        $this->setVisited('name');
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAction(): ?string
    {
        return $this->action;
    }

    /**
     * @param string|null $action
     * @return self
     */
    public function setAction(?string $action): self
    {
        $this->setVisited('action');
        $this->action = $action;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getObjectClass(): ?string
    {
        return $this->objectClass;
    }

    /**
     * @param string|null $objectClass
     * @return self
     */
    public function setObjectClass(?string $objectClass): self
    {
        $this->setVisited('objectClass');
        $this->objectClass = $objectClass;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getObjectId(): ?int
    {
        return $this->objectId;
    }

    /**
     * @param int|null $objectId
     * @return self
     */
    public function setObjectId(?int $objectId): self
    {
        $this->setVisited('objectId');
        $this->objectId = $objectId;

        return $this;
    }
}
