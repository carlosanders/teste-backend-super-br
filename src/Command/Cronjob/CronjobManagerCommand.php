<?php

declare(strict_types=1);
/**
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Command\Cronjob;

use Carbon\Carbon;
use SuppCore\AdministrativoBackend\Api\V1\Resource\CronjobResource;
use SuppCore\AdministrativoBackend\Command\Traits\SymfonyStyleTrait;
use SuppCore\AdministrativoBackend\Cronjob\CronjobExpressionServiceInterface;
use SuppCore\AdministrativoBackend\Cronjob\CronjobLoggerInterface;
use SuppCore\AdministrativoBackend\Entity\Cronjob;
use SuppCore\AdministrativoBackend\Transaction\TransactionManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;
use Throwable;

/**
 * Class CronjobManagerCommand.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class CronjobManagerCommand extends Command
{
    use SymfonyStyleTrait;

    public function __construct(
        private CronjobResource $cronJobResource,
        private TransactionManager $transactionManager,
        private CronjobExpressionServiceInterface $cronJobService,
        private CronjobLoggerInterface $logger,
    ) {
        parent::__construct('supp:cronjob:manager');
        $this->setDescription(
            'Command para execução de jobs armazenados no banco de dados conforme configuração no banco de dados'
        );
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null
     */
    protected function execute(InputInterface $input, OutputInterface $output): ?int
    {
        $dateExecucao = new Carbon();
        $jobs = array_filter(
            $this->cronJobResource->getRepository()->findBy(['ativo' => true]),
            fn(Cronjob $cronJob) => $this->cronJobService->isDue($cronJob->getPeriodicidade(), $dateExecucao)
        );

        $totalJobs = count($jobs);

        if ($totalJobs) {
            $this->logger->info(sprintf('Cronjob Manager executando %s cron job(s).', count($jobs)));
        } else {
            return 0;
        }

        $processList = [];
        foreach ($jobs as $cronJob) {
            try {
                $transactionId = $this->transactionManager->begin();
                $cronJobDTO = $this->cronJobResource->getDtoForEntity(
                    $cronJob->getId(),
                    $this->cronJobResource->getDtoClass(),
                    null,
                    $cronJob
                );

                $this->logger->info(
                    sprintf('Chamando execução do cronjob:runner para o cronjob %s', $cronJob->getId()),
                    $cronJob
                );
                $this->cronJobResource->startJob($cronJob->getId(), $cronJobDTO, $transactionId, $process);
                $processList[] = $process;
                $this->transactionManager->commit($transactionId);
            } catch (Throwable $e) {
                $this->logger->error(
                    sprintf('Erro ao iniciar execução do cronjob %s', $cronJob->getId()),
                    $e->getMessage(),
                    $cronJob
                );
            }
        }

        $terminatedCount = 0;
        while ($terminatedCount <= count($processList)) {
            foreach ($processList as $index => $process) {
                /** @var Process $process */
                if (!$process || $process->isTerminated()) {
                    unset($processList[$index]);
                    $terminatedCount++;
                }
            }
            sleep(1);
        }

        return Command::SUCCESS;
    }
}
