<?php

declare(strict_types=1);

namespace SuppCore\AdministrativoBackend\Entity\Traits;

use DMS\Filter\Rules as Filter;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Trait FilesystemService.
 */
trait FilesystemService
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
    protected string|null $filesystemService = '';

    /**
     * @param string|null $filesystemService
     * @return self
     */
    public function setFilesystemService(string|null $filesystemService): self
    {
        $this->filesystemService = $filesystemService;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFilesystemService(): string|null
    {
        return $this->filesystemService;
    }
}
