<?php

declare(strict_types=1);

namespace SuppCore\AdministrativoBackend\Barramento\Command;

use DateTime;
use Doctrine\Common\Annotations\AnnotationException;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\Exception\ORMException;
use Exception;
use ReflectionException;
use SuppCore\AdministrativoBackend\Api\V1\DTO\OrigemDados;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Processo;
use SuppCore\AdministrativoBackend\Api\V1\Resource\OrigemDadosResource;
use SuppCore\AdministrativoBackend\Api\V1\Resource\ProcessoResource;
use SuppCore\AdministrativoBackend\Transaction\TransactionManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Comando responsável por realizar um processamento específico no Barramento PEN.
 */
class AjustaOrigemDadosCommand extends Command
{
    private TransactionManager $transactionManager;

    private OrigemDadosResource $origemDadosResource;

    private ProcessoResource $processoResource;

    public function __construct(
        TransactionManager $transactionManager,
        ProcessoResource $processoResource,
        OrigemDadosResource $origemDadosResource
    ) {
        parent::__construct();
        $this->transactionManager = $transactionManager;
        $this->origemDadosResource = $origemDadosResource;
        $this->processoResource = $processoResource;
    }

    /**
     * Método de configuração dos parâmetros esperados.
     *
     * @return void
     */
    protected function configure()
    {
        $this->setName('supp:barramento:ajustaorigemdados')
            ->setDescription('Realiza o ajuste de processos já existentes no sapiens.')
            ->addOption(
                'processo',
                null,
                InputOption::VALUE_REQUIRED,
                'id do processo'
            )
            ->addOption(
                'nre',
                null,
                InputOption::VALUE_OPTIONAL,
                'nro do nre'
            );
    }

    /**
     * Rotina realizada após executar o comando.
     *
     * @return int
     *
     * @throws AnnotationException
     * @throws NonUniqueResultException
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws ReflectionException
     * @throws Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $transactionId = $this->transactionManager->begin();
        $processoEntity = $this->processoResource->findOne((int) $input->getOption('processo'));

        /** @var Processo $processoDto */
        $processoDto = $this->processoResource->getDtoForEntity(
            $processoEntity->getId(),
            Processo::class
        );

        $origemDados = new OrigemDados();
        $origemDados->setServico('barramento');
        $origemDados->setFonteDados('BARRAMENTO_PEN');
        $origemDados->setDataHoraUltimaConsulta(new DateTime());
        $origemDados->setStatus(1);
        $origemDados->setIdExterno((string) $input->getOption('nre'));

        $origemDadosEntity = $this->origemDadosResource->create($origemDados, $transactionId);
        $processoDto->setOrigemDados($origemDadosEntity);

        $this->processoResource->update($processoEntity->getId(), $processoDto, $transactionId);
        $this->transactionManager->commit();
        $output->writeln('<info>Comando executado com sucesso.</info>');
        return self::SUCCESS;
    }
}
