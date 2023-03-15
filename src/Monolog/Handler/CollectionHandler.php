<?php

declare(strict_types=1);

namespace SuppCore\AdministrativoBackend\Monolog\Handler;

use Monolog\Handler\AbstractProcessingHandler;

/**
 * Handler that saves all records to him self.
 */
class CollectionHandler extends AbstractProcessingHandler
{
    /**
     * @var array
     */
    private $records = [];

    /**
     * {@inheritdoc}
     */
    protected function write(array $record): void
    {
        $this->records[] = $record;
    }

    /**
     * Returns recorded data.
     *
     * @return array
     */
    public function getRecords(): array
    {
        return $this->records;
    }

    /**
     * Clears recorded data.
     */
    public function clearRecords()
    {
        $this->records = [];
    }
}
