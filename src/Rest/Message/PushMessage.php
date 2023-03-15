<?php

declare(strict_types=1);
/**
 * /src/Rest/Message/PushMessage.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Rest\Message;

/**
 * Class PushMessage.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class PushMessage
{
    private ?string $channel = null;

    private ?string $uuid = null ;

    private ?string $operation = 'AddData';

    // para o caso de addChildData
    private ?string $parentType = null;

    private ?int $parentId = null;

    private ?string $resource = null;

    private array $populate = [];

    /**
     * @param string|null $channel
     * @return void
     */
    public function setChannel(?string $channel): void
    {
        $this->channel = $channel;
    }

    /**
     * @return string|null
     */
    public function getChannel(): ?string
    {
        return $this->channel;
    }

    /**
     * @param string|null $operation
     * @return void
     */
    public function setOperation(?string $operation): void
    {
        $this->operation = $operation;
    }

    /**
     * @return string|null
     */
    public function getOperation(): ?string
    {
        return $this->operation;
    }

    /**
     * @param string|null $uuid
     * @return void
     */
    public function setUuid(?string $uuid): void
    {
        $this->uuid = $uuid;
    }

    /**
     * @return string|null
     */
    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    /**
     * @return string|null
     */
    public function getResource(): ?string
    {
        return $this->resource;
    }

    /**
     * @param string|null $resource
     * @return void
     */
    public function setResource(?string $resource): void
    {
        $this->resource = $resource;
    }

    /**
     * @return array
     */
    public function getPopulate(): array
    {
        return $this->populate;
    }

    /**
     * @param array $populate
     */
    public function setPopulate(array $populate): void
    {
        $this->populate = $populate;
    }

    /**
     * @return string|null
     */
    public function getParentType(): ?string
    {
        return $this->parentType;
    }

    /**
     * @param string|null $parentType
     * @return void
     */
    public function setParentType(?string $parentType): void
    {
        $this->parentType = $parentType;
    }

    /**
     * @return int|null
     */
    public function getParentId(): ?int
    {
        return $this->parentId;
    }

    /**
     * @param int|null $parentId
     * @return void
     */
    public function setParentId(?int $parentId): void
    {
        $this->parentId = $parentId;
    }
}
