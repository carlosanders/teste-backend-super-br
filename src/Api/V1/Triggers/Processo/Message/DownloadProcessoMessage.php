<?php

declare(strict_types=1);
/**
 * /src/Api/V1/Triggers/Processo/Message/DownloadProcessoMessage.php.
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Triggers\Processo\Message;

/**
 * Class DownloadProcessoMessage.
 */
class DownloadProcessoMessage
{
    public const DOWNLOAD_AS_PDF = 'PDF';
    public const DOWNLOAD_AS_ZIP = 'ZIP';

    /**
     * @param string $uuid
     * @param string $typeDownload
     * @param string $username
     * @param string $sequencial
     * @param int $partNumber
     */
    public function __construct(
        private string $uuid,
        private string $typeDownload,
        private string $username,
        private string $sequencial,
        private int $partNumber = 0
    ) {
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getTypeDownload(): string
    {
        return $this->typeDownload;
    }

    public function getSequencial(): string
    {
        return $this->sequencial;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return int
     */
    public function getPartNumber(): int
    {
        return $this->partNumber;
    }

    /**
     * @param int $partNumber
     * @return DownloadProcessoMessage
     */
    public function setPartNumber(int $partNumber): DownloadProcessoMessage
    {
        $this->partNumber = $partNumber;

        return $this;
    }
}
