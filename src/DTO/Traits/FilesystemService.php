<?php

declare(strict_types=1);

namespace SuppCore\AdministrativoBackend\DTO\Traits;

use DMS\Filter\Rules as Filter;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;
use OpenApi\Annotations as OA;
use JMS\Serializer\Annotation as Serializer;

/**
 * Trait FilesystemService.
 */
trait FilesystemService
{
    /**
     * FilesystemService.
     *
     * @Serializer\Exclude()
     *
     * @Filter\Trim()
     * @Filter\StripNewlines()
     *
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $filesystemService = null;

    /**
     * Set CryptoService.
     *
     * @param string|null $filesystemService
     */
    public function setFilesystemService(string | null $filesystemService): self
    {
        $this->setVisited('filesystemService');

        $this->filesystemService = $filesystemService;

        return $this;
    }

    /**
     * Get CryptoService.
     *
     * @return string|null
     */
    public function getFilesystemService(): string | null
    {
        return $this->filesystemService;
    }
}
