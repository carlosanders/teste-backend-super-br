<?php

declare(strict_types=1);
/**
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Command\Cronjob;

use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Cronjob as CronjobDTO;
use SuppCore\AdministrativoBackend\Api\V1\Resource\CronjobResource;
use SuppCore\AdministrativoBackend\Command\Traits\SymfonyStyleTrait;
use SuppCore\AdministrativoBackend\Cronjob\CronjobLoggerInterface;
use SuppCore\AdministrativoBackend\Entity\Cronjob as CronjobEntity;
use SuppCore\AdministrativoBackend\Security\RolesService;
use SuppCore\AdministrativoBackend\Transaction\TransactionManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Http\Authenticator\Token\PostAuthenticationToken;
use Throwable;

/**
 * Class CronjobManagerCommand.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class CronjobRunnerCommand extends Command
{
    use SymfonyStyleTrait;

    public function __construct(
        private CronjobResource $cronJobResource,
        private CronjobLoggerInterface $logger,
        private RolesService $rolesService,
        private TokenStorageInterface $tokenStorage,
        private TransactionManager $transactionManager
    ) {
        parent::__construct('supp:cronjob:runner');
        $this->setDescription('Command que realiza a execução do job com base no id');
    }

    protected function configure(): void
    {
        parent::configure();
        $this->addOption(
                'job',
                'j',
                InputOption::VALUE_REQUIRED,
                'Id do job a ser executado'
            );

    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null
     * @throws ORMException
     * @throws OptimisticLockException
     */
    protected function execute(InputInterface $input, OutputInterface $output): ?int
    {
        $io = $this->getSymfonyStyle($input, $output);
        try {
            $transactionId = $this->transactionManager->begin();
            /** @var CronjobDTO $dto */
            $dto = $this->cronJobResource->getDtoForEntity(
                (int) $input->getOption('job'),
                $this->cronJobResource->getDtoClass(),
            );

            $usuario = $dto->getUsuarioUltimaExecucao()
                ?? $dto->getAtualizadoPor()
                ?? $dto->getCriadoPor();

            $token = new PostAuthenticationToken(
                $usuario,
                'login',
                $this->rolesService->getContextualRoles($usuario)
            );

            $token->setAttribute('username', $usuario->getUsername());
            $this->tokenStorage->setToken($token);

            $this->logger->info(
                sprintf('Iniciando execução do comando do cronjob %s', $input->getOption('job')),
                $dto
            );

            $entity = $this->cronJobResource->executeJobCommand($dto->getId(), $dto, $transactionId, $process);
            $this->transactionManager->commit($transactionId);

            if ($entity->getStatusUltimaExecucao() === CronjobEntity::ST_EXECUCAO_SUCESSO) {
                $this->logger->info(
                    sprintf('Finalizando execução do comando do cronjob %s com sucesso.', $input->getOption('job')),
                    $dto
                );
            } else {
                $this->logger->error(
                    sprintf('Erro na execução do comando do cronjob %s.', $input->getOption('job')),
                    $process->getErrorOutput(),
                    $dto
                );
            }

        } catch (Throwable $e) {
            $this->logger->error(
                sprintf('Erro na execução do cronjob:runner durante execução do cronjob %s.', $input->getOption('job')),
                $e->getMessage()
            );

            if (isset($dto) && $dto) {
                $transactionId = $this->transactionManager->begin();
                $dto->setStatusUltimaExecucao(CronjobEntity::ST_EXECUCAO_ERRO);
                $this->cronJobResource->update($dto->getId(), $dto, $transactionId);
                $this->transactionManager->commit($transactionId);
            }

            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
