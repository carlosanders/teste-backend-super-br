<?php

declare(strict_types=1);
/**
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Command\Tarefa;

use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\Exception\ORMException;
use Psr\Log\LoggerInterface;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Tarefa;
use SuppCore\AdministrativoBackend\Api\V1\Resource\AfastamentoResource;
use SuppCore\AdministrativoBackend\Api\V1\Resource\TarefaResource;
use SuppCore\AdministrativoBackend\Command\Traits\SymfonyStyleTrait;
use SuppCore\AdministrativoBackend\Repository\AfastamentoRepository;
use SuppCore\AdministrativoBackend\Repository\EspecieTarefaRepository;
use SuppCore\AdministrativoBackend\Repository\ProcessoRepository;
use SuppCore\AdministrativoBackend\Repository\SetorRepository;
use SuppCore\AdministrativoBackend\Repository\TarefaRepository;
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
class TarefaLimboCommand extends Command
{
    use SymfonyStyleTrait;

    /**
     * TarefaLimboCommand constructor.
     *
     * @param LoggerInterface         $logger
     * @param TarefaRepository        $tarefaRepository
     * @param ProcessoRepository      $processoRepository
     * @param TarefaResource          $tarefaResource
     * @param EspecieTarefaRepository $especieTarefaRepository
     * @param AfastamentoRepository   $afastamentoRepository
     * @param TransactionManager      $transactionManager
     * @param AfastamentoResource     $afastamentoResource
     * @param SetorRepository         $setorRepository
     */
    public function __construct(
        private LoggerInterface $logger,
        private TarefaRepository $tarefaRepository,
        private ProcessoRepository $processoRepository,
        private TarefaResource $tarefaResource,
        private EspecieTarefaRepository $especieTarefaRepository,
        private AfastamentoRepository $afastamentoRepository,
        private TransactionManager $transactionManager,
        private AfastamentoResource $afastamentoResource,
        private SetorRepository $setorRepository
    ) {
        parent::__construct('supp:administrativo:tarefa:limbo');
        $this->setDescription('Abre tarefas nos NUPs que estao no limbo');
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
        $processos = $this->processoRepository->findProcessosAbertosLimbo();

        $outputCode = Command::SUCCESS;
        $totalTarefasAbertas = 0;
        try {
            if ($processos) {
                $transactionId = $this->transactionManager->begin();
                foreach ($processos as $processo) {
                    $dataAtual = new \DateTime();
                    $finalPrazo = $dataAtual->add(new \DateInterval('P5D'));
                    $tarefaDTO = new Tarefa();
                    $tarefaDTO->setEspecieTarefa(
                        $this->especieTarefaRepository->findByNomeAndGenero(
                            'DAR ANDAMENTO AO PROCESSO',
                            'ADMINISTRATIVO'
                        )
                    );

                    if ($this->tarefaRepository->findTarefasFechadasLimboByProcesso($processo->getId())) {
                        $tarefa = $this->tarefaRepository->findTarefasFechadasLimboByProcesso($processo->getId());
                        $tarefaDtoOld = $this->tarefaResource->getDtoForEntity(
                            $tarefa[0]->getId(),
                            Tarefa::class,
                            null,
                            $tarefa[0]
                        );

                        $tarefaDTO->setUsuarioResponsavel($tarefaDtoOld->getUsuarioResponsavel());

                        $temAfastamento = $this->afastamentoRepository->findAfastamento(
                            $tarefaDtoOld->getUsuarioResponsavel(),
                            $finalPrazo
                        );

                        if ($temAfastamento) {
                            $usuariosCoord = $this->tarefaResource->retornaUsuariosRegraDistribuicao(
                                $tarefaDtoOld,
                                TarefaResource::REGRA_DISTRIBUICAO_APENAS_COORDENADORES
                            );
                            $usuariosCoord = $this->afastamentoResource->limpaListaUsuariosAfastados(
                                $usuariosCoord,
                                $tarefaDTO->getDataHoraFinalPrazo()
                            );

                            if (empty($usuariosCoord)) {
                                $tarefaDTO->setUsuarioResponsavel(null);
                                $tarefaDTO->setSetorResponsavel(
                                    $this->setorRepository->findProtocoloInUnidade(
                                        $tarefaDtoOld->getSetorResponsavel()->getUnidade()
                                    )
                                );
                            }
                        }
                        $tarefaDTO->setSetorResponsavel($tarefaDtoOld->getSetorResponsavel());
                        $tarefaDTO->setDataHoraInicioPrazo($dataAtual);
                        $tarefaDTO->setDataHoraFinalPrazo($finalPrazo);
                        $tarefaDTO->setProcesso($tarefaDtoOld->getProcesso());
                        $this->tarefaResource->create($tarefaDTO, $transactionId);
                        ++$totalTarefasAbertas;
                    } else {
                        $tarefaDTO->setUsuarioResponsavel(null);
                        $tarefaDTO->setSetorResponsavel(
                            $this->setorRepository->findProtocoloInUnidade(
                                $processo->getSetorAtual()->getUnidade()
                            )
                        );
                        $tarefaDTO->setDataHoraInicioPrazo($dataAtual);
                        $tarefaDTO->setDataHoraFinalPrazo($finalPrazo);
                        $tarefaDTO->setProcesso($processo);
                        $this->tarefaResource->create($tarefaDTO, $transactionId);
                        ++$totalTarefasAbertas;
                    }
                }
                $this->transactionManager->commit($transactionId);
            }
        } catch (Throwable $t) {
            $outputCode = Command::FAILURE;
            $this->logger->critical($t->getMessage().$t->getTraceAsString());
            throw $t;
        }

        if ($input->isInteractive()) {
            $io->success($message ?? 'Total de '.$totalTarefasAbertas.' tarefa(s) aberta(s).');
        }

        return $outputCode;
    }
}
