<?php

declare(strict_types=1);
/**
 * /src/DTO/Traits/IdUuid.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DTO\Traits;

use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;
use OpenApi\Annotations as OA;

/**
 * Trait IdUuid.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
trait IdUuid
{
    /**
     * @OA\Property(type="integer")
     * @DTOMapper\Property()
     */
    protected ?int $id = null;

    /**
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $uuid = null;

    /**
     * @return int|null
     *
     * @OA\Property(type="integer")
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     *
     * @return self
     */
    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    /**
     * @param string|null $uuid
     *
     * @return self
     */
    public function setUuid(?string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }
}
