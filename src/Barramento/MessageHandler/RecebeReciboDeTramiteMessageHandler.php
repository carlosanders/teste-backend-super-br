<?php

declare(strict_types=1);

/**
 * /src/MessageHandler/RecebeReciboDeTramiteMessageHandler.php.
 */

namespace SuppCore\AdministrativoBackend\Barramento\MessageHandler;

/*
 * Class RecebeReciboDeTramiteMessageHandler
 *
 * @package SuppCore\AdministrativoBackend\Command\Barramento\MessageHandler
 */

use Exception;
use SuppCore\AdministrativoBackend\Barramento\Message\RecebeReciboDeTramiteMessage;
use SuppCore\AdministrativoBackend\Barramento\Service\BarramentoClient;
use SuppCore\AdministrativoBackend\Barramento\Service\BarramentoLogger;
use SuppCore\AdministrativoBackend\Barramento\Service\BarramentoSolicitacao;
use SuppCore\AdministrativoBackend\Transaction\TransactionManager;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Throwable;

/**
 * Classe responsável por realizar o processamento do job Recebe Recibo De Tramite.
 */
#[AsMessageHandler]
class RecebeReciboDeTramiteMessageHandler
{
    private BarramentoLogger $logger;

    private BarramentoSolicitacao $barramentoSolicitacao;

    private BarramentoClient $barramentoClient;

    private TransactionManager $transactionManager;

    /**
     * EnviaComponentesDigitaisMessageHandler constructor.
     */
    public function __construct(
        BarramentoLogger $logger,
        BarramentoSolicitacao $barramentoSolicitacao,
        BarramentoClient $barramentoClient,
        TransactionManager $transactionManager
    ) {
        $this->logger = $logger;
        $this->barramentoSolicitacao = $barramentoSolicitacao;
        $this->barramentoClient = $barramentoClient;
        $this->transactionManager = $transactionManager;
    }

    /**
     * @throws Exception
     * @throws Throwable
     */
    public function __invoke(RecebeReciboDeTramiteMessage $recebeReciboDeTramiteMessage)
    {
        $idt = $recebeReciboDeTramiteMessage->getIdt();
        $transactionId = $this->transactionManager->begin();

        try {
            $this->barramentoClient->receberReciboDeTramite($idt);
            $this->transactionManager->commit($transactionId);
        } catch (Throwable $e) {
            // Rollback Transaction
            $this->logger->critical("Falha no RecebeReciboDeTramiteMessageHandler: {$e->getMessage()}");
            $this->barramentoSolicitacao->cancelaTramite($idt);
            $transactionId = $this->transactionManager->getCurrentTransactionId();
            if ($transactionId) {
                $this->transactionManager->resetTransaction($transactionId);
            }
            $this->transactionManager->clearManager();
            throw $e;
        }
    }
}
