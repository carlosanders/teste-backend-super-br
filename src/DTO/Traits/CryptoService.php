<?php

declare(strict_types=1);

namespace SuppCore\AdministrativoBackend\DTO\Traits;

use DMS\Filter\Rules as Filter;
use SuppCore\AdministrativoBackend\Api\V1\DTO\ComponenteDigital;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;
use OpenApi\Annotations as OA;
use JMS\Serializer\Annotation as Serializer;

/**
 * Trait CryptoService.
 */
trait CryptoService
{
    /**
     * CryptoService.
     *
     * @Serializer\Exclude()
     *
     * @Filter\Trim()
     * @Filter\StripNewlines()
     *
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $cryptoService = null;

    /**
     * Set CryptoService.
     *
     * @param string|null $cryptoService
     * @return ComponenteDigital|CryptoService
     */
    public function setCryptoService(string | null $cryptoService): self
    {
        $this->setVisited('cryptoService');

        $this->cryptoService = $cryptoService;

        return $this;
    }

    /**
     * Get CryptoService.
     *
     * @return string|null
     */
    public function getCryptoService(): string | null
    {
        return $this->cryptoService;
    }
}
