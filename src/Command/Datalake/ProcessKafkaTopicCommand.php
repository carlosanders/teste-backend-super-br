<?php

declare(strict_types=1);
/**
 * /src/Command/Datalake/ProcessKafkaTopicCommand.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Command\Datalake;

use Exception;
use SuppCore\AdministrativoBackend\Helpers\SuppParameterBag;
use SuppCore\AdministrativoBackend\Integracao\Datalake\KafkaTopicManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ProcessKafkaTopicCommand.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class ProcessKafkaTopicCommand extends Command
{
    /**
     * ProcessKafkaTopicCommand constructor.
     *
     * @param KafkaTopicManager $kafkaTopicManager
     * @param SuppParameterBag  $parameterBag
     */
    public function __construct(
        private readonly KafkaTopicManager $kafkaTopicManager,
        private readonly SuppParameterBag $parameterBag,
    ) {
        parent::__construct('supp:administrativo:datalake:kafka');
        $this
            ->setDescription('Processa topicos do kafka')
            ->addOption('onlyOnce', 'o', InputOption::VALUE_NONE, 'Processa uma única vez os tópicos');
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
     * @throws Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): ?int
    {
        if (!$this->parameterBag->get('supp_core.administrativo_backend.datalake.kafka.enable')) {
            throw new Exception('Serviço de tópicos Kafka desabilitado neste ambiente.');
        }

        if (!$this->parameterBag->has('supp_core.administrativo_backend.datalake.kafka.config')) {
            throw new Exception('Serviço de tópicos Kafka habilitado mas não configurado neste ambiente.');
        }

        while (true) {
            $this->kafkaTopicManager->processKafkaTopics();
            if ($input->getOption('onlyOnce')) {
                break;
            }
            sleep(1);
        }
        return 0;
    }
}
