<?php

declare(strict_types=1);

namespace SuppCore\AdministrativoBackend\Barramento\Command;

use Exception;
use SuppCore\AdministrativoBackend\Transaction\TransactionManager;
use SuppCore\AdministrativoBackend\Barramento\Service\BarramentoProcessamento;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Formatter\OutputFormatter;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Throwable;

/**
 * Comando responsável por realizar o processamento das pendências existentes no Barramento PEN.
 */
class BarramentoProcessamentoCommand extends Command
{
    private BarramentoProcessamento $barramentoProcessamento;

    private TransactionManager $transactionManager;

    public function __construct(
        BarramentoProcessamento $barramentoProcessamento,
        TransactionManager $transactionManager
    ) {
        $this->barramentoProcessamento = $barramentoProcessamento;
        parent::__construct();

        $this->setName('supp:barramento:processamento')
            ->setDescription('Realiza o processamento das pendências obtidas no barramento.');
        $this->transactionManager = $transactionManager;
    }

    /**
     * Método de configuração dos parâmetros esperados.
     *
     * @return void
     */
    protected function configure()
    {
        $this->setName('supp:barramento:processamento')
            ->setDescription('Realiza o processamento das pendências obtidas no barramento.');
    }

    /**
     * Rotina realizada após executar o comando.
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Não é necessário, porém é pararâmetro obrigatório
        unset($input);

        try {
            $output->writeln('<info>Iniciando processamento das pendências do barramento...</info>');
            $transactionId = $this->transactionManager->begin();
            $this->barramentoProcessamento->processaPendencias($transactionId);
            $this->transactionManager->commit($transactionId);
            $output->writeln('<info>Comando executado com sucesso.</info>');
        } catch (Exception | Throwable $e) {
            $output->writeln('<error>Falha na execução do comando.</error>');
            $output->writeln('<error>Erro: '.OutputFormatter::escape($e->getMessage()).'</error>');
        } finally {
            $output->writeln('<comment>Fim do processamento.</comment>');
            if (isset($e)) {
                return self::FAILURE;
            } else {
                return self::SUCCESS;
            }
        }
    }
}
