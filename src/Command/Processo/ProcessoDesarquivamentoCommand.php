<?php

declare(strict_types=1);
/**
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Command\Processo;

use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\Exception\ORMException;
use Psr\Log\LoggerInterface;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Transicao as TransicaoDTO;
use SuppCore\AdministrativoBackend\Api\V1\Resource\ModalidadeFaseResource;
use SuppCore\AdministrativoBackend\Api\V1\Resource\ModalidadeTransicaoResource;
use SuppCore\AdministrativoBackend\Api\V1\Resource\ProcessoResource;
use SuppCore\AdministrativoBackend\Api\V1\Resource\TransicaoResource;
use SuppCore\AdministrativoBackend\Command\Traits\SymfonyStyleTrait;
use SuppCore\AdministrativoBackend\Repository\ProcessoRepository;
use SuppCore\AdministrativoBackend\Transaction\TransactionManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Throwable;

/**
 * Class ProcessoDesarquivamentoCommand.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class ProcessoDesarquivamentoCommand extends Command
{
    use SymfonyStyleTrait;

    private LoggerInterface $logger;

    private ProcessoRepository $processoRepository;

    private ProcessoResource $processoResource;

    private ModalidadeFaseResource $modalidadeFaseResource;

    private TransicaoResource $transicaoResource;

    private ModalidadeTransicaoResource $modalidadeTransicaoResource;

    private TransactionManager $transactionManager;

    /**
     * ProcessoDesarquivamentoCommand constructor.
     * @param LoggerInterface $logger
     * @param ProcessoRepository $processoRepository
     * @param ProcessoResource $processoResource
     * @param ModalidadeFaseResource $modalidadeFaseResource
     * @param TransicaoResource $transicaoResource
     * @param ModalidadeTransicaoResource $modalidadeTransicaoResource
     * @param TransactionManager $transactionManager
     */
    public function __construct(
        LoggerInterface $logger,
        ProcessoRepository $processoRepository,
        ProcessoResource $processoResource,
        ModalidadeFaseResource $modalidadeFaseResource,
        TransicaoResource $transicaoResource,
        ModalidadeTransicaoResource $modalidadeTransicaoResource,
        TransactionManager $transactionManager
    ) {
        parent::__construct('supp:administrativo:processo:desarquivamento');

        $this->logger = $logger;
        $this->processoRepository = $processoRepository;
        $this->processoResource = $processoResource;
        $this->modalidadeFaseResource = $modalidadeFaseResource;
        $this->transicaoResource = $transicaoResource;
        $this->modalidadeTransicaoResource = $modalidadeTransicaoResource;
        $this->transactionManager = $transactionManager;

        $this->setDescription('Command para desarquivamento de processos agendados');
    }

    /** @noinspection PhpMissingParentCallCommonInspection */

    /**
     * Executes the current command.
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int|null
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    protected function execute(InputInterface $input, OutputInterface $output): ?int
    {
        $io = $this->getSymfonyStyle($input, $output);
        $processos = $this->processoRepository->findProcessosDesarquivamento();
        $outputCode = Command::SUCCESS;
        $totalDesarquivamentos = 0;

        try {
            if ($processos) {
                $transactionId = $this->transactionManager->begin();

                foreach ($processos as $processo) {
                    $processoDTO = $this->processoResource->getDtoForEntity(
                        $processo->getId(),
                        $this->processoResource->getDtoClass(),
                        null,
                        $processo
                    );

                    $transicaoDTO = new TransicaoDTO();
                    $transicaoDTO->setProcesso($processo);
                    $transicaoDTO->setModalidadeTransicao(
                        $this->modalidadeTransicaoResource->findOneBy(['valor' => 'DESARQUIVAMENTO'])
                    );
                    $transicaoDTO->setMetodo('automático por agendamento via sistema');
                    $this->transicaoResource->create($transicaoDTO, $transactionId);

                    $processoDTO->setModalidadeFase($this->modalidadeFaseResource->findOneBy(['valor' => 'CORRENTE']));
                    $this->processoResource->update($processo->getId(), $processoDTO, $transactionId);

                    ++$totalDesarquivamentos;
                }

                $this->transactionManager->commit($transactionId);
            }
        } catch (Throwable $t) {
            $outputCode = Command::FAILURE;
            $this->logger->critical($t->getMessage().$t->getTraceAsString());
            throw $t;
        }

        if ($input->isInteractive()) {
            $io->success($message ?? 'Total de '.$totalDesarquivamentos.' processo(s) desarquivado(s).');
        }

        return $outputCode;
    }
}
