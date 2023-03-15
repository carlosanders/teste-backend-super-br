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
use Symfony\Component\Filesystem\Filesystem;
use Throwable;

/**
 * Class DocumentoLimpezaDataHoraValidadeCommand.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class DocumentoLimparEnvioEmailCommand extends Command
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
        parent::__construct('supp:administrativo:documento:anexoemail');

        $this->logger = $logger;
        $this->documentoRepository = $documentoRepository;
        $this->transactionManager = $transactionManager;

        $this->setDescription('Command para limpeza de documentos anexados nos emails');
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

        $filesystem = new Filesystem();
        try {
            $outputCode = Command::SUCCESS;
            exec("rm -rf " . sys_get_temp_dir().'/mail_*');
        } catch (Throwable $t) {
            $outputCode = Command::FAILURE;
            $this->logger->critical($t->getMessage().$t->getTraceAsString());
            throw $t;
        }

        return $outputCode;
    }
}
