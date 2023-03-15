<?php

declare(strict_types=1);
/**
 * /src/Command/Migration/MigrateVersionCommand.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Command\Migration;

use RuntimeException;
use SuppCore\AdministrativoBackend\Command\Traits\SymfonyStyleTrait;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Redis;

/**
 * Class MigrateVersionCommand.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class MigrateVersionCommand extends Command
{
    // Traits
    use SymfonyStyleTrait;

    private string $fromVersion = '1.9.3';
    private string $toVersion = '1.10.0';

    /**
     * MigrateVersionCommand constructor.
     *
     * @param Redis $redisClient
     */
    public function __construct(private Redis $redisClient)
    {
        parent::__construct('supp:migration:version');

        $this->setDescription(
            'Console command to migrate from '.$this->fromVersion.' to version '.$this->toVersion
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output): ?int
    {
        $io = $this->getSymfonyStyle($input, $output);

        if ($input->isInteractive()) {
            $io->info('Migration from '.$this->fromVersion.' to '.$this->toVersion.' started');
        }

        if ($this->redisClient->get('maintenance')) {
            throw new RuntimeException('Já temos uma migração em andamento!');
        }

        $this->redisClient->flushall();

        if ($input->isInteractive()) {
            $io->info('Redis flushall');
        }

        $this->redisClient->set('maintenance', $this->toVersion);

        if ($input->isInteractive()) {
            $io->info('Database migration started');
        }

        $process = new Process(
            [
                'bin/console',
                'doctrine:migrations:execute',
                '--env='.$input->getOption('env'),
                '--no-debug',
                '--no-interaction',
                '--up',
                'DoctrineMigrations\\Version20221107125028',
            ]
        );

        $process->setTimeout(3600);
        $process->setIdleTimeout(3600);

        $process->run();

        // executes after the command finishes
        if (!$process->isSuccessful()) {
            $this->redisClient->del('maintenance');
            throw new ProcessFailedException($process);
        }

        if ($input->isInteractive()) {
            $io->info('Database migration completed');
        }

        if ($input->isInteractive()) {
            $io->success('Migration completed');
        }

        $this->redisClient->del('maintenance');

        return self::SUCCESS;
    }
}
