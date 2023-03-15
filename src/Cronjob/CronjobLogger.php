<?php

declare(strict_types=1);
/**
 * /src/Cronjob/CronjobLogger.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
namespace SuppCore\AdministrativoBackend\Cronjob;

use DateTimeInterface;
use Psr\Log\LoggerInterface;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;

/**
 * Class CronjobLogger.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class CronjobLogger implements CronjobLoggerInterface
{

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(private LoggerInterface $logger)
    {
    }

    /**
     * @param string $message
     * @param EntityInterface|null $cronJob
     * @return void
     */
    public function info(string $message, ?EntityInterface $cronJob = null): void {
        $data = [];
        if ($cronJob) {
            $data = [
                'id' => $cronJob->getId(),
                'uuid' => $cronJob->getUuid(),
                'comando' => $cronJob->getComando(),
                'periodicidade' => $cronJob->getPeriodicidade()
            ];
        }

        $this->logger->info($message, $data);
    }

    /**
     * @param string $message
     * @param string $error
     * @param EntityInterface|null $cronJob
     * @return void
     */
    public function error(string $message, string $error, ?EntityInterface $cronJob = null): void {
        $data = ['error' => $error];
        if ($cronJob) {
            $data['id'] = $cronJob->getId();
            $data['uuid'] = $cronJob->getUuid();
            $data['comando'] = $cronJob->getComando();
            $data['periodicidade'] = $cronJob->getPeriodicidade();
            $data['pid'] = $cronJob->getUltimoPid();
        }

        $this->logger->error($message, $data);
    }

}
