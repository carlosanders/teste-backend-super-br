<?php

declare(strict_types=1);
/**
 * /src/Command/User/DocumentoLimpezaDataHoraValidadeCommand.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Command\Documento;

use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\Exception\ORMException;
use Psr\Log\LoggerInterface;
use SuppCore\AdministrativoBackend\Command\Traits\SymfonyStyleTrait;
use SuppCore\AdministrativoBackend\Repository\DocumentoRepository;
use SuppCore\AdministrativoBackend\Transaction\TransactionManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Throwable;

/**
 * Class DocumentoLimpezaDataHoraValidadeCommand.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class DocumentoLimpezaDataHoraValidadeCommand extends Command
{
    use SymfonyStyleTrait;

    private LoggerInterface $logger;

    private DocumentoRepository $documentoRepository;

    private TransactionManager $transactionManager;

    /**
     * DocumentoLimpezaDataHoraValidadeCommand constructor.
     *
     * @param LoggerInterface     $logger
     * @param DocumentoRepository $documentoRepository
     * @param TransactionManager  $transactionManager
     */
    public function __construct(
        LoggerInterface $logger,
        DocumentoRepository $documentoRepository,
        TransactionManager $transactionManager
    ) {
        parent::__construct('supp:administrativo:documento:documentovalidadevencida');

        $this->logger = $logger;
        $this->documentoRepository = $documentoRepository;
        $this->transactionManager = $transactionManager;

        $this->setDescription('Command para limpeza de documentos com dataHoraValidade vencidos');
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

        // Busca os documentos com dataHoraValidade no passado
        $documentosVencidos = $this->documentoRepository->findDocumentoValidadeVencida();
        $outputCode = Command::SUCCESS;
        $totalDocumentos = 0;

        try {
            if ($documentosVencidos) {
                $transactionId = $this->transactionManager->begin();

                foreach ($documentosVencidos as $documento) {
                    $this->documentoRepository->remove($documento, $transactionId);
                    ++$totalDocumentos;
                }

                $this->transactionManager->commit($transactionId);
            }
        } catch (Throwable $t) {
            $outputCode = Command::FAILURE;
            $this->logger->critical($t->getMessage().$t->getTraceAsString());
            throw $t;
        }

        if ($input->isInteractive()) {
            $io->success($message ?? 'Total de '.$totalDocumentos.' documentos excluídos');
        }

        return $outputCode;
    }
}
