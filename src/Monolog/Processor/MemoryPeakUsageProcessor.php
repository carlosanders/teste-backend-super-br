<?php

declare(strict_types=1);
/**
 * /src/Rest/Controller.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Monolog\Processor;

use Monolog\Processor\MemoryProcessor;
use function sys_getloadavg;

/**
 * Injects memory_get_peak_usage in all records.
 *
 * @author Rob Jensen
 */
class MemoryPeakUsageProcessor extends MemoryProcessor
{
    /**
     * @param array $records
     *
     * @return array
     */
    public function __invoke(array $records): array
    {
        $records['extra']['memory_peak_usage_bytes'] = memory_get_peak_usage(true);
        $load = sys_getloadavg();
        $records['extra']['cpu_load'] = $load[0];

        return $records;
    }
}
