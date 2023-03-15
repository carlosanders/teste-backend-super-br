<?php

declare(strict_types=1);
/**
 * /src/Api/V1/Resource/TarefaResource.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Resource;

use DateTime;
use Doctrine\Common\Annotations\AnnotationException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\Exception\ORMException;
use function get_class;
use Redis;
use ReflectionException;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Tarefa;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Usuario as UsuarioDTO;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\Lotacao;
use SuppCore\AdministrativoBackend\Entity\Setor;
use SuppCore\AdministrativoBackend\Entity\Tarefa as Entity;
use SuppCore\AdministrativoBackend\Entity\Usuario;
use SuppCore\AdministrativoBackend\Entity\VinculacaoProcesso;
use SuppCore\AdministrativoBackend\Repository\AfastamentoRepository;
use SuppCore\AdministrativoBackend\Repository\LotacaoRepository;
use SuppCore\AdministrativoBackend\Repository\SetorRepository;
use SuppCore\AdministrativoBackend\Repository\TarefaRepository as Repository;
use SuppCore\AdministrativoBackend\Repository\TransicaoWorkflowRepository;
use SuppCore\AdministrativoBackend\Repository\UsuarioRepository;
use SuppCore\AdministrativoBackend\Repository\VinculacaoProcessoRepository;
use SuppCore\AdministrativoBackend\Rest\RestResource;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class TarefaResource.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @codingStandardsIgnoreStart
 *
 * @method Repository  getRepository(): Repository
 * @method Entity[]    find(array $criteria = null, array $orderBy = null, int $limit = null, int $offset = null, array $search = null, array $populate = null): array
 * @method Entity|null findOne(int $id, bool $throwExceptionIfNotFound = null): ?EntityInterface
 * @method Entity|null findOneBy(array $criteria, array $orderBy = null, bool $throwExceptionIfNotFound = null): ?EntityInterface
 * @method Entity      create(RestDtoInterface $dto, string $transactionId, bool $skipValidation = null): EntityInterface
 * @method Entity      update(int $id, RestDtoInterface $dto, string $transactionId, bool $skipValidation = null): EntityInterface
 * @method Entity      delete(int $id, string $transactionId): EntityInterface
 * @method Entity      save(EntityInterface $entity, string $transactionId, bool $skipValidation = null): EntityInterface
 *
 * @codingStandardsIgnoreEnd
 */
class TarefaResource extends RestResource
{
    /** @noinspection MagicMethodsValidityInspection */

    /** Todos usuários aptos a receber a tarefa (com peso na lotação acima de 0) */
    public const REGRA_DISTRIBUICAO_INDIFERENTE = 0;
    /** Usuários distribuidores aptos a receber a tarefa (com peso na lotação acima de 0) */
    public const REGRA_DISTRIBUICAO_APENAS_DISTRIBUIDORES = 1;
    /** Usuários comuns (não distribuidores) aptos a receber a tarefa (com peso na lotação acima de 0) */
    public const REGRA_DISTRIBUICAO_EXCLUI_DISTRIBUIDORES = 2;
    /** Apenas coordenadores do setor recebem a tarefa */
    public const REGRA_DISTRIBUICAO_APENAS_COORDENADORES = 3;

    protected const TIPO_DISTRIBUICAO_PREVENCAO_ABSOLUTA_TAREFA_NUP = 1;
    protected const TIPO_DISTRIBUICAO_PREVENCAO_ABSOLUTA_TAREFA_NUP_VINCULADO = 2;
    protected const TIPO_DISTRIBUICAO_PREVENCAO_ABASOLUTA_DIGITO_CENTENA = 3;
    protected const TIPO_DISTRIBUICAO_PREVENCAO_RELATIVA_TAREFA_NUP = 4;
    protected const TIPO_DISTRIBUICAO_MENOR_MEDIA = 5;

    /**
     * TarefaResource constructor.
     */
    public function __construct(protected Repository $repository,
                                protected ValidatorInterface $validator,
                                protected TokenStorageInterface $tokenStorage,
                                protected Redis $redisClient,
                                protected AfastamentoRepository $afastamentoRepository,
                                protected UsuarioRepository $usuarioRepository,
                                protected LotacaoRepository $lotacaoRepository,
                                protected VinculacaoProcessoRepository $vinculacaoProcessoRepository,
                                protected AfastamentoResource $afastamentoResource,
                                protected SetorRepository $setorRepository,
                                protected TransicaoWorkflowRepository $transicaoWorkflowRepository)
    {
        $this->setRepository($repository);
        $this->setValidator($validator);
        $this->setDtoClass(Tarefa::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws AnnotationException
     * @throws ReflectionException
     */
    public function toggleLida(
        int $id,
        RestDtoInterface $dto,
        string $transactionId,
        ?bool $skipValidation = null
    ): EntityInterface {
        $skipValidation ??= false;

        // Fetch entity
        $entity = $this->getEntity($id);

        if ($entity->getDataHoraLeitura()) {
            $dto->setDataHoraLeitura(null);
        } else {
            $dto->setDataHoraLeitura(new DateTime());
        }

        /**
         * Determine used dto class and create new instance of that and load entity to that. And after that patch
         * that dto with given partial OR whole dto class.
         */
        $restDto = $this->getDtoForEntity($id, get_class($dto), $dto);

        // Validate DTO
        $this->validateDto($restDto, $skipValidation);

        // Before callback method call
        $this->beforeToggleLida($id, $restDto, $entity, $transactionId);

        // Create or update entity
        $this->persistEntity($entity, $restDto, $transactionId);

        // After callback method call
        $this->afterToggleLida($id, $restDto, $entity, $transactionId);

        return $entity;
    }

    public function beforeToggleLida(
        int &$id,
        RestDtoInterface $dto,
        EntityInterface $entity,
        string $transactionId
    ): void {
        $this->rulesManager->proccess($dto, $entity, $transactionId, 'assertToggleLida');
        $this->triggersManager->proccess($dto, $entity, $transactionId, 'beforeToggleLida');
        $this->rulesManager->proccess($dto, $entity, $transactionId, 'beforeToggleLida');
    }

    public function afterToggleLida(
        int &$id,
        RestDtoInterface $dto,
        EntityInterface $entity,
        string $transactionId
    ): void {
        $this->triggersManager->proccess($dto, $entity, $transactionId, 'afterToggleLida');
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws AnnotationException
     * @throws ReflectionException
     */
    public function ciencia(
        int $id,
        RestDtoInterface $dto,
        string $transactionId,
        ?bool $skipValidation = null
    ): EntityInterface {
        $skipValidation ??= false;

        // Fetch entity
        $entity = $this->getEntity($id);

        /**
         * Determine used dto class and create new instance of that and load entity to that. And after that patch
         * that dto with given partial OR whole dto class.
         */
        $restDto = $this->getDtoForEntity($id, get_class($dto), $dto);

        // Validate DTO
        $this->validateDto($restDto, $skipValidation);

        // Before callback method call
        $this->beforeCiencia($id, $restDto, $entity, $transactionId);

        // Create or update entity
        $this->persistEntity($entity, $restDto, $transactionId);

        // After callback method call
        $this->afterCiencia($id, $restDto, $entity, $transactionId);

        return $entity;
    }

    public function beforeCiencia(int &$id, RestDtoInterface $dto, EntityInterface $entity, string $transactionId): void
    {
        $this->rulesManager->proccess($dto, $entity, $transactionId, 'assertCiencia');
        $this->triggersManager->proccess($dto, $entity, $transactionId, 'beforeCiencia');
        $this->rulesManager->proccess($dto, $entity, $transactionId, 'beforeCiencia');
    }

    public function afterCiencia(int &$id, RestDtoInterface $dto, EntityInterface $entity, string $transactionId): void
    {
        $this->triggersManager->proccess($dto, $entity, $transactionId, 'afterCiencia');
    }

    /**
     * Distribui automaticamente as tarefas do usuário para o coordenador do setor ou para o protocolo do setor.
     *
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws AnnotationException
     * @throws ReflectionException
     */
    public function distribuirTarefasUsuario(
        int $usuarioId,
        string $transactionId,
        ?bool $skipValidation = null
    ): RestDtoInterface {
        $skipValidation ??= false;

        $usuariosSetor = [];
        $usuarioTarefasEntity = $this->usuarioRepository->getReference($usuarioId);
        $usuarioTarefasDTO = $this->getDtoForEntity(
            $usuarioId,
            UsuarioDTO::class,
            null,
            $usuarioTarefasEntity
        );

        // Before callback method call
        $this->beforeDistribuirTarefasUsuario($usuarioId, $usuarioTarefasDTO, $usuarioTarefasEntity, $transactionId);

        $tarefas = $this->getRepository()->findTarefasAbertasUsuario($usuarioTarefasEntity);

        foreach ($tarefas as $tarefaEntity) {
            $tarefaId = $tarefaEntity->getId();

            $tarefaDTO = $this->getDtoForEntity($tarefaId, Tarefa::class, null, $tarefaEntity);
            $this->validateDto($tarefaDTO, $skipValidation);

            $setor = $tarefaDTO->getSetorResponsavel();

            if (!isset($usuariosSetor[$setor->getId()])) {
                $usuariosSetor[$setor->getId()] = array_filter(
                    $this->retornaUsuariosRegraDistribuicao(
                        $tarefaDTO,
                        self::REGRA_DISTRIBUICAO_APENAS_COORDENADORES
                    ),
                    fn ($usuarioSetor) => $usuarioSetor->getId() !== $usuarioId
                );
            }

            if (empty($usuariosSetor[$setor->getId()])
                || empty(
                    $this->afastamentoResource->limpaListaUsuariosAfastados(
                        $usuariosSetor[$setor->getId()],
                        $tarefaDTO->getDataHoraFinalPrazo()
                    )
                )
            ) {
                $setor = $this->setorRepository->findProtocoloInUnidade(
                    $tarefaDTO->getSetorResponsavel()->getUnidade()
                );
                $tarefaDTO->setSetorResponsavel($setor);

                $usuariosSetor[$setor->getId()] = $this->retornaUsuariosRegraDistribuicao(
                    $tarefaDTO,
                    $this->retornaRegraDistribuicao($tarefaDTO)
                );
            }

            $this->trataDistribuicao($tarefaDTO, $usuariosSetor[$setor->getId()]);

            $this->persistEntity($tarefaEntity, $tarefaDTO, $transactionId);
        }

        // After callback method call
        $this->afterDistribuirTarefasUsuario($usuarioId, $usuarioTarefasDTO, $usuarioTarefasEntity, $transactionId);

        return $usuarioTarefasDTO;
    }

    public function beforeDistribuirTarefasUsuario(
        int &$id,
        RestDtoInterface $dto,
        EntityInterface $entity,
        string $transactionId
    ): void {
        $this->rulesManager->proccess($dto, $entity, $transactionId, 'assertDistribuirTarefaUsuario');
        $this->rulesManager->proccess($dto, $entity, $transactionId, 'assertUpdate');
        $this->triggersManager->proccess($dto, $entity, $transactionId, 'beforeDistribuirTarefasUsuario');
        $this->rulesManager->proccess($dto, $entity, $transactionId, 'beforeDistribuirTarefasUsuario');
        $this->rulesManager->proccess($dto, $entity, $transactionId, 'beforeUpdate');
    }

    public function afterDistribuirTarefasUsuario(
        int &$id,
        RestDtoInterface $dto,
        EntityInterface $entity,
        string $transactionId
    ): void {
        $this->triggersManager->proccess($dto, $entity, $transactionId, 'afterDistribuirTarefasUsuario');
    }

    /**
     * Método que retorna os usuários disponíveis para distribuicao.
     *
     * @param RestDtoInterface|Tarefa $tarefaDTO
     */
    public function retornaUsuariosRegraDistribuicao(RestDtoInterface|Tarefa $tarefaDTO, int $regraDistribuicao): array
    {
        return match ($regraDistribuicao) {
            self::REGRA_DISTRIBUICAO_INDIFERENTE => $this->usuarioRepository->findUsuariosDisponiveisSetor(
                    $tarefaDTO->getSetorResponsavel()->getId()
                ),

            self::REGRA_DISTRIBUICAO_APENAS_DISTRIBUIDORES => $this->usuarioRepository->findUsuariosDistribuidoresDisponiveisSetor(
                    $tarefaDTO->getSetorResponsavel()->getId()
                ),

            self::REGRA_DISTRIBUICAO_EXCLUI_DISTRIBUIDORES => $this->usuarioRepository->findUsuariosNaoDistribuidoresDisponiveisSetor(
                    $tarefaDTO->getSetorResponsavel()->getId()
                ),

            self::REGRA_DISTRIBUICAO_APENAS_COORDENADORES => $this->usuarioRepository->findUsuariosCoordenadoresDisponiveisSetor(
                    $tarefaDTO->getSetorResponsavel()->getId()
                ),

        default => throw new \InvalidArgumentException('Regra de distribuição inexistente.')
        };
    }

    /**
     * Método que retorna o código da regra de distribuição.
     *
     * @param RestDtoInterface|Tarefa $tarefaDto
     *
     * @throws \Exception
     */
    public function retornaRegraDistribuicao(
        RestDtoInterface|Tarefa $tarefaDto,
        EntityInterface|Entity $tarefaEntity = null
    ): int {
        $regraDistribuicao = self::REGRA_DISTRIBUICAO_INDIFERENTE;

        if (!$this->tokenStorage->getToken() ||
            (false === $this->tokenStorage->getToken()->getUser() instanceof Usuario)) {
            return $regraDistribuicao;
        }

        /** @var Usuario $usuario */
        $usuario = $this->tokenStorage->getToken()->getUser();

        if (!$usuario->getColaborador()) {
            foreach ($tarefaDto->getSetorResponsavel()->getLotacoes() as $lotacao) {
                if ($lotacao->getDistribuidor() &&
                    !$this->afastamentoRepository->findAfastamento(
                        $lotacao->getColaborador()->getId(),
                        $tarefaDto->getDataHoraFinalPrazo()
                    )
                ) {
                    $regraDistribuicao = self::REGRA_DISTRIBUICAO_APENAS_DISTRIBUIDORES;

                    return $regraDistribuicao;
                }
            }
        }

        if ($tarefaDto->getSetorResponsavel()->getApenasDistribuidor()) {
            $temDistribuidor = false;

            foreach ($tarefaDto->getSetorResponsavel()->getLotacoes() as $lotacao) {
                if ($lotacao->getDistribuidor() &&
                    !$this->afastamentoRepository->findAfastamento(
                        $lotacao->getColaborador()->getId(),
                        $tarefaDto->getDataHoraFinalPrazo()
                    )
                ) {
                    $temDistribuidor = true;
                }
            }

            $estaLotado = false;

            /** @var Lotacao $lotacao */
            foreach ($usuario->getColaborador()->getLotacoes() as $lotacao) {
                if ($lotacao->getSetor()->getId() === $tarefaDto->getSetorResponsavel()->getId()) {
                    $estaLotado = true;
                }
            }

            if ($temDistribuidor && !$estaLotado) {
                $regraDistribuicao = self::REGRA_DISTRIBUICAO_APENAS_DISTRIBUIDORES;
            }

            if ($temDistribuidor && $estaLotado &&
                $tarefaEntity->getSetorResponsavel() &&
                ($tarefaEntity->getSetorResponsavel()->getId() === $tarefaDto->getSetorResponsavel()->getId())) {
                $regraDistribuicao = self::REGRA_DISTRIBUICAO_EXCLUI_DISTRIBUIDORES;
            }
        }

        return $regraDistribuicao;
    }

    /**
     * Método que trata a distribuição de tarefas conforme regras estabelecidas.
     *
     * @param Tarefa|RestDtoInterface|null $tarefa
     * @param Usuario[]                    $usuarios
     *
     * @throws \Exception
     */
    public function trataDistribuicao(Tarefa|RestDtoInterface|null $tarefa, array $usuarios): void
    {
        $stats = [];
        $setor = $tarefa->getSetorResponsavel();
        $prazoEqualizacao = $setor->getPrazoEqualizacao() ?? 7;
        $divergenciaMaxima = $setor->getDivergenciaMaxima() ?? 10;
        $apenasDistribuicaoAutomatica = $setor->getApenasDistribuicaoAutomatica() ?? true;
        $comPrevencaoRelativa = $setor->getComPrevencaoRelativa() ?? true;
        $diasPrazoEqualizacao = [];

        $data = new DateTime();
        for ($i = 0; $i < $prazoEqualizacao; ++$i) {
            $diasPrazoEqualizacao[] = $data->format('Ymd');
            $data->modify('-1 days');
        }

        $stats['setor'][$setor->getId()]['nome'] = $setor->getNome();
        $stats['setor'][$setor->getId()]['prazoEqualizacao'] = $prazoEqualizacao;
        $stats['setor'][$setor->getId()]['divergenciaMaxima'] = $divergenciaMaxima;
        $stats['setor'][$setor->getId()]['apenasDistribuicaoAutomatica'] = $apenasDistribuicaoAutomatica;
        $stats['setor'][$setor->getId()]['totalDiasTrabalhadosPeriodoEqualizacao'] = 0;
        $stats['setor'][$setor->getId()]['totalDistribuicoesPeriodoEqualizacao'] = 0;
        $stats['setor'][$setor->getId()]['mediaDistribuicoesPorDiaTrabalhadoPeriodoEqualizacao'] = 0;

        $usuariosDistribuicao = $this->afastamentoResource->limpaListaUsuariosAfastados(
            $usuarios,
            $tarefa->getDataHoraFinalPrazo()
        );

        $usuariosId = [];

        foreach ($usuarios as $usuario) {
            if (!in_array($usuario, $usuariosDistribuicao)) {
                $stats['usuariosAfastados'][$usuario->getId()]['nome'] = $usuario->getNome();
            } else {
                $stats['usuariosDisponiveis'][$usuario->getId()]['nome'] = $usuario->getNome();
                $usuariosId[$usuario->getId()] = $usuario;
            }
        }

        $usuariosDistribuicao = array_values($usuariosDistribuicao);

        if (!count($usuariosDistribuicao)) {
            throw new \RuntimeException('Não há usuário apto a receber tarefa neste setor!');
        }

        /**
         * Regra 1.
         *
         * Prevenção absoluta por tarefa aberta no NUP ou em NUP vinculado!
         *
         * Atenção, temos que verificar o banco, mas também o presente ciclo de execução!
         */
        $processosVinculados = [];

        /** @var VinculacaoProcesso $vinculacoesProcesso */
        foreach ($tarefa->getProcesso()->getVinculacoesProcessos() as $vinculacoesProcesso) {
            $processosVinculados[] = $vinculacoesProcesso->getProcessoVinculado();
        }

        /** @var VinculacaoProcesso $vinculacaoProcesso */
        $vinculacaoProcesso = $this->vinculacaoProcessoRepository->findByProcessoVinculado(
            $tarefa->getProcesso()->getId()
        );

        if ($vinculacaoProcesso) {
            $processosVinculados[] = $vinculacaoProcesso->getProcesso();
        }

        // preferência absoluta por tarefa aberta no NUP
        // precisamos retirar o usuário atual se estiver redistribuindo

        $usuariosIdPassiveisPrevencaoAbsoluta = array_keys($usuariosId);

        $usuarioPreferenciaAbsoluta = $this->getRepository()->findPreferenciaAbsoluta(
            $usuariosIdPassiveisPrevencaoAbsoluta,
            $tarefa->getProcesso()->getId(),
            $setor->getId()
        );

        if ($usuarioPreferenciaAbsoluta) {
            $tarefa->setUsuarioResponsavel($usuarioPreferenciaAbsoluta);
            $stats['PREVENCAO_ABSOLUTA_TAREFA_NUP'][$usuarioPreferenciaAbsoluta->getId(
            )]['nome'] = $usuarioPreferenciaAbsoluta->getNome();
            $tarefa->setTipoDistribuicao(self::TIPO_DISTRIBUICAO_PREVENCAO_ABSOLUTA_TAREFA_NUP);
            $tarefa->setDistribuicaoAutomatica(true);
            $tarefa->setAuditoriaDistribuicao(json_encode($stats));

            return;
        }

        // preferência absoluta por tarefa aberta nos NUPs vinculados
        if (!$usuarioPreferenciaAbsoluta) {
            foreach ($processosVinculados as $processoVinculado) {
                $usuarioPreferenciaAbsoluta = $this->getRepository()->findPreferenciaAbsoluta(
                    array_keys($usuariosId),
                    $processoVinculado->getId(),
                    $setor->getId()
                );
                if ($usuarioPreferenciaAbsoluta) {
                    $tarefa->setUsuarioResponsavel($usuarioPreferenciaAbsoluta);
                    $stats['PREVENCAO_ABSOLUTA_TAREFA_NUP_VINCULADO'][$usuarioPreferenciaAbsoluta->getId(
                    )]['nome'] = $usuarioPreferenciaAbsoluta->getNome();
                    $stats['PREVENCAO_ABSOLUTA_TAREFA_NUP_VINCULADO'][$usuarioPreferenciaAbsoluta->getId(
                    )]['NUPVinculado'] = $processoVinculado->getNUP();
                    $tarefa->setTipoDistribuicao(
                        self::TIPO_DISTRIBUICAO_PREVENCAO_ABSOLUTA_TAREFA_NUP_VINCULADO
                    );
                    break;
                }
            }
        }

        /**
         * Regra 2.
         *
         * Prevenção absoluta por dígito ou centena atribuida na lotação
         */
        $usuariosComDigito = [];

        // processa digitos
        foreach ($usuariosDistribuicao as $usuario) {
            $lotacao = $this->lotacaoRepository->findLotacaoBySetorAndColaborador(
                $setor->getId(),
                $usuario->getColaborador()->getId()
            );
            if ($setor->getDistribuicaoCentena()) {
                $digitosUsuario = $this->processaDigitosDistribuicao($lotacao->getCentenasDistribuicao());
                $stats['centenaNUP'] = (int) substr($tarefa->getProcesso()->getNUP(), 9, 2);
                if (in_array((int) substr($tarefa->getProcesso()->getNUP(), 9, 2), $digitosUsuario, true)) {
                    $usuariosComDigito[] = $usuario;
                    $stats['usuariosComCentenaNUP'][$usuario->getId()]['nome'] = $usuario->getNome();
                }
            } else {
                $digitosUsuario = $this->processaDigitosDistribuicao($lotacao->getDigitosDistribuicao());
                $stats['digitoNUP'] = (int) substr($tarefa->getProcesso()->getNUP(), 10, 1);
                if (in_array((int) substr($tarefa->getProcesso()->getNUP(), 10, 1), $digitosUsuario, true)) {
                    $usuariosComDigito[] = $usuario;
                    $stats['usuariosComDigitoNUP'][$usuario->getId()]['nome'] = $usuario->getNome();
                }
            }
        }

        // tem apenas um usuario no dígito, é dele
        // final do processamento
        if (1 === count($usuariosComDigito)) {
            $tarefa->setUsuarioResponsavel($usuariosComDigito[0]);

            $stats['PREVENCAO_ABASOLUTA_DIGITO_CENTENA'][$usuariosComDigito[0]->getId(
            )]['nome'] = $usuariosComDigito[0]->getNome();

            $tarefa->setDistribuicaoAutomatica(true);
            $tarefa->setAuditoriaDistribuicao(json_encode($stats));
            $tarefa->setTipoDistribuicao(self::TIPO_DISTRIBUICAO_PREVENCAO_ABASOLUTA_DIGITO_CENTENA);

            return;
        }

        // tem mais de um, distribui balanceando entre eles
        if (count($usuariosComDigito) > 1) {
            $usuariosDistribuicao = $usuariosComDigito;
        }

        /**
         * Regra 3.
         *
         * Não temos prevenção absoluta ou temos prevenção absoluta entre mais de um usuário
         *
         * Hora de realizar o balanceamento de carga
         */

        // um array com as quantidades de distribuições que os usuários receberam no período de equalizacao
        $distribuicoesUsuariosPeriodoEqualizacao = [];

        // um array com as quantidades de dias trabalhados pelos usuários
        $diasTrabalhadosUsuario = [];

        // um array com as médias de distribuições por dia trabalhado
        $mediaUsuarios = [];

        // quantos dígitos livres cada usuário já recebeu hoje?
        // a divergência máxima opera para limitar distorções diárias
        $distribuicoesUsuariosHoje = [];

        // total de dias trabalhados de todos
        $totalDiasTrabalhados = 0;

        // total de distribuições recebidas por todos
        $totalDistribuicoesPeriodoEqualizacao = 0;

        $temCache = false;
        if ($this->redisClient->exists('dist_s_'.$setor->getId())) {
            $fromCache = DateTime::createFromFormat(
                'Ymd',
                $this->redisClient->get('dist_s_'.$setor->getId())
            );
            $hoje = new DateTime();
            $diff = (int) $hoje->diff($fromCache)->format('%a');
            if ($diff > $prazoEqualizacao) {
                $temCache = true;
            }
        }

        foreach ($usuariosDistribuicao as $usuario) {
            $usuarioId = $usuario->getId();
            $distribuicoesUsuariosPeriodoEqualizacao[$usuario->getId()] = 0;
            $distribuicoesUsuariosHoje[$usuario->getId()] = 0;
            if ($temCache) {
                $suffix = '';
                if ($apenasDistribuicaoAutomatica) {
                    $suffix = '_au';
                }
                foreach ($diasPrazoEqualizacao as $diaPrazoEqualizacao) {
                    $distribuicoesUsuariosPeriodoEqualizacao[$usuario->getId()] +=
                        $this->redisClient->hget(
                            'dist_'.$diaPrazoEqualizacao,
                            's_'.$setor->getId().'u_'.$usuarioId.$suffix
                        );
                }
                $distribuicoesUsuariosPeriodoEqualizacao[$usuario->getId()] +=
                    $this->redisClient->hget(
                        'dist_'.reset($diasPrazoEqualizacao),
                        's_'.$setor->getId().'u_'.$usuarioId.'_lb'
                    );
            } else {
                $distribuicoesUsuariosPeriodoEqualizacao[$usuario->getId(
                )] = $this->getRepository()->findQuantidadeDistribuicoes(
                    $usuarioId,
                    $setor->getId(),
                    $apenasDistribuicaoAutomatica,
                    $prazoEqualizacao
                );
                $distribuicoesUsuariosHoje[$usuario->getId(
                )] = $this->getRepository()->findQuantidadeDistribuicoesLivresHoje(
                    $usuarioId,
                    $setor->getId()
                );
            }
            $stats['usuariosDisponiveis'][$usuario->getId(
            )]['quantidadeDistribuicoesPeriodoEqualizacao'] = $distribuicoesUsuariosPeriodoEqualizacao[$usuarioId];
            $stats['usuariosDisponiveis'][$usuario->getId(
            )]['quantidadeDistribuicoesLivresHoje'] = $distribuicoesUsuariosHoje[$usuarioId];

            $diasTrabalhadosUsuario[
            $usuario->getId()
            ] = ($prazoEqualizacao - $this->afastamentoRepository->findDiasAfastamento(
                $usuario->getColaborador()->getId(),
                $prazoEqualizacao
            ));

            $stats['usuariosDisponiveis'][
            $usuario->getId()
            ]['diasTrabalhadosPeriodoEqualizacao'] = $diasTrabalhadosUsuario[$usuarioId];

            $totalDiasTrabalhados += $diasTrabalhadosUsuario[$usuario->getId()];
            $stats['setor'][$setor->getId()]['totalDiasTrabalhadosPeriodoEqualizacao'] = $totalDiasTrabalhados;

            $totalDistribuicoesPeriodoEqualizacao += $distribuicoesUsuariosPeriodoEqualizacao[$usuario->getId()];
            $stats['setor'][$setor->getId(
            )]['totalDistribuicoesPeriodoEqualizacao'] = $totalDistribuicoesPeriodoEqualizacao;
        }

        // acha a média
        if ($totalDiasTrabalhados) {
            $mediaDistribuicoesPorDiaTrabalhado = $totalDistribuicoesPeriodoEqualizacao / $totalDiasTrabalhados;
        } else {
            $mediaDistribuicoesPorDiaTrabalhado = 0;
        }
        $stats['setor'][$setor->getId(
        )]['mediaDistribuicoesPorDiaTrabalhadoPeriodoEqualizacao'] = $mediaDistribuicoesPorDiaTrabalhado;

        $pesos = [];

        // ajustes e ponderações de afastamento e correção do peso da lotacao
        foreach ($usuariosDistribuicao as $usuario) {
            $usuarioId = $usuario->getId();
            // primeiro a média do usuário
            // se o usuário não tem nenhum dia trabalhado no período de equalização,
            // damos a ele a média do setor
            if ($diasTrabalhadosUsuario[$usuario->getId()]) {
                $mediaUsuarios[$usuarioId] = $distribuicoesUsuariosPeriodoEqualizacao[
                    $usuario->getId()
                    ] / $diasTrabalhadosUsuario[$usuarioId];
            } else {
                $mediaUsuarios[$usuario->getId()] = $mediaDistribuicoesPorDiaTrabalhado;
            }
            $stats['usuariosDisponiveis'][$usuario->getId(
            )]['mediaDistribuicoesPorDiaTrabalhadoPeriodoEqualizacao'] = $mediaUsuarios[$usuarioId];

            $peso = $this->lotacaoRepository->findLotacaoBySetorAndColaborador(
                $setor->getId(),
                $usuario->getColaborador()->getId()
            )->getPeso();
            $stats['usuariosDisponiveis'][$usuario->getId()]['peso'] = $peso;
            $pesos[$usuario->getId()] = $peso;

            // ajuste do peso sobre a média
            $distribuicoesUsuariosPeriodoEqualizacao[$usuario->getId()] *= 100 / $peso;
            $mediaUsuarios[$usuario->getId()] *= 100 / $peso;
            $stats['usuariosDisponiveis'][$usuario->getId(
            )]['mediaDistribuicoesPorDiaTrabalhadoPeriodoEqualizacaoComPeso'] = $mediaUsuarios[$usuarioId];
        }

        $usuariosIdDisponiveisAposMaximaDivergencia = [];

        // enquanto houver usuários sem distribuição de livre balanceamento no dia
        // apenas eles participam
        foreach ($distribuicoesUsuariosHoje as $usuarioId => $distribuicaoUsuarioHoje) {
            if (!$distribuicaoUsuarioHoje) {
                $usuariosIdDisponiveisAposMaximaDivergencia[$usuarioId] = $mediaUsuarios[$usuarioId];
                $stats['usuariosDisponiveisLivreBalanceamento'][$usuarioId] = $stats['usuariosDisponiveis'][$usuarioId];
            }
        }

        // precisamos eliminar os usuarios que não passam
        // no teste da máxima divergencia diária

        // não temos mais usuário com zero distribuições livres no dia,
        // hora de ativar a divergência máxima
        if (!count($usuariosIdDisponiveisAposMaximaDivergencia)) {
            // a primeira coisa a se fazer é aplicar o peso
            $distribuicoesUsuariosHojeComPeso = [];

            foreach ($distribuicoesUsuariosHoje as $usuarioId => $distribuicaoUsuarioHoje) {
                $distribuicoesUsuariosHojeComPeso[$usuarioId] = $distribuicaoUsuarioHoje * 100 / $pesos[$usuarioId];
            }

            // vamos ordenar da menor para a maior distribuicao diaria até aqui
            asort($distribuicoesUsuariosHojeComPeso);
            reset($distribuicoesUsuariosHojeComPeso);

            $menorDistribuicaoHojeComPeso = $distribuicoesUsuariosHojeComPeso[key($distribuicoesUsuariosHojeComPeso)];

            $stats['menorQuantidadeDistribuicacaoLivreBalanceamentoHoje'] = $menorDistribuicaoHojeComPeso;

            foreach ($distribuicoesUsuariosHojeComPeso as $usuarioId => $distribuicaoUsuarioHojeComPeso) {
                $divergencia = (($distribuicaoUsuarioHojeComPeso * 100) / $menorDistribuicaoHojeComPeso) - 100;
                if ($divergencia <= $divergenciaMaxima) {
                    $usuariosIdDisponiveisAposMaximaDivergencia[$usuarioId] = $mediaUsuarios[$usuarioId];
                    $stats[
                    'usuariosDisponiveisLivreBalanceamento'
                    ][$usuarioId] = $stats['usuariosDisponiveis'][$usuarioId];
                    $stats['usuariosDisponiveisLivreBalanceamento'][$usuarioId]['divergencia'] = $divergencia;
                }
            }
        }

        $usuariosIdPassiveisPrevencaoRelativa = array_keys($usuariosIdDisponiveisAposMaximaDivergencia);

        if ($comPrevencaoRelativa &&
            ($usuarioComPreferencia = $this->getRepository()->findPreferencia(
                $usuariosIdPassiveisPrevencaoRelativa,
                $tarefa->getProcesso()->getId()
            ))) {
            $tarefa->setUsuarioResponsavel($usuarioComPreferencia);
            $tarefa->setLivreBalanceamento(true);
            $stats['PREVENCAO_RELATIVA_TAREFA_NUP'][$usuarioComPreferencia->getId(
            )]['nome'] = $usuarioComPreferencia->getNome();
            $tarefa->setTipoDistribuicao(self::TIPO_DISTRIBUICAO_PREVENCAO_RELATIVA_TAREFA_NUP);
        } else {
            $usuariosIdDisponiveisAposMaximaDivergenciaMenoresMediasDistribuicao = array_keys(
                $usuariosIdDisponiveisAposMaximaDivergencia,
                min($usuariosIdDisponiveisAposMaximaDivergencia)
            );
            $usuarioIdDisponivelAposMaximaDivergenciaMenorMediaDistribuicao =
                $usuariosIdDisponiveisAposMaximaDivergenciaMenoresMediasDistribuicao[
                random_int(0, count($usuariosIdDisponiveisAposMaximaDivergenciaMenoresMediasDistribuicao) - 1)
                ];
            $tarefa->setUsuarioResponsavel(
                $usuariosId[$usuarioIdDisponivelAposMaximaDivergenciaMenorMediaDistribuicao]
            );
            $tarefa->setLivreBalanceamento(true);
            $stats['livreDistribuicaoMenorMedia'][
            $usuarioIdDisponivelAposMaximaDivergenciaMenorMediaDistribuicao
            ]['nome'] = $usuariosId[$usuarioIdDisponivelAposMaximaDivergenciaMenorMediaDistribuicao]->getNome();
            $tarefa->setTipoDistribuicao(self::TIPO_DISTRIBUICAO_MENOR_MEDIA);
        }

        $tarefa->setDistribuicaoAutomatica(true);
        $tarefa->setAuditoriaDistribuicao(json_encode($stats));
    }

    /**
     * @param $expressao
     * @return array
     */
    private function processaDigitosDistribuicao($expressao): array
    {
        $digitos = [];
        if (!$expressao) {
            return $digitos;
        }
        $intervalos = explode(',', $expressao);
        foreach ($intervalos as $intervalo) {
            $inicioFim = explode('-', $intervalo);
            if (count($inicioFim) > 1) {
                $max = max($inicioFim);
                for ($j = min($inicioFim); $j <= $max; ++$j) {
                    $digitos[] = (int) $j;
                }
            } else {
                $digitos[] = (int) $inicioFim[0];
            }
        }

        return $digitos;
    }

    /**
     * @param Usuario $usuarioResponsavel
     * @return array
     */
    public function obterDadosGraficoTarefas(Usuario $usuarioResponsavel): array
    {
        $quantidadeSemanas = 4;
        $quantidades = [];
        for ($i = $quantidadeSemanas; $i > 0; --$i) {
            $sub1 = $i * -1;
            $sub2 = ($i - 1) * -1;
            $dataInicial = date('Y-m-d', strtotime("sunday {$sub1} week"));
            $dataFinal = date('Y-m-d', strtotime("saturday {$sub2} week"));

            $quantidade = $this->repository->findCountByUserIdAndDate(
                $usuarioResponsavel->getId(),
                $dataInicial,
                $dataFinal
            );

            $periodo = date('d/m', strtotime($dataFinal));

            $quantidades[] = [
                'dataInicial' => $dataInicial,
                'dataFinal' => $dataFinal,
                'periodo' => $periodo,
                'quantidade' => $quantidade,
            ];
        }

        return $quantidades;
    }
}
