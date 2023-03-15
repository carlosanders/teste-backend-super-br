<?php

declare(strict_types=1);

namespace SuppCore\AdministrativoBackend\Entity\Traits;

use DMS\Filter\Rules as Filter;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Trait CryptoClassnameClass.
 */
trait CryptoService
{
    /**
     * @Gedmo\Versioned
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @ORM\Column(
     *     type="string",
     *     nullable=true
     * )
     */
    protected string|null $cryptoService = '';

    /**
     * @param string|null $cryptoService
     * @return self
     */
    public function setCryptoService(string|null $cryptoService): self
    {
        $this->cryptoService = $cryptoService;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCryptoService(): string|null
    {
        return $this->cryptoService;
    }
}
