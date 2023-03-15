<?php

declare(strict_types=1);
/**
 * /src/Api/V1/Rules/Tarefa/Rule0008.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Rules\Tarefa;

use SuppCore\AdministrativoBackend\Api\V1\DTO\Tarefa;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\Tarefa as TarefaEntity;
use SuppCore\AdministrativoBackend\Entity\Usuario;
use SuppCore\AdministrativoBackend\Repository\VinculacaoUsuarioRepository;
use SuppCore\AdministrativoBackend\Rules\Exceptions\RuleException;
use SuppCore\AdministrativoBackend\Rules\RuleInterface;
use SuppCore\AdministrativoBackend\Rules\RulesTranslate;
use SuppCore\AdministrativoBackend\Transaction\TransactionManager;
use SuppCore\AdministrativoBackend\Utils\CoordenadorService;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class Rule0008.
 *
 * @descSwagger=O usuário não tem poderes para modificar a tarefa!
 * @classeSwagger=Rule0008
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Rule0008 implements RuleInterface
{
    private RulesTranslate $rulesTranslate;
    private TokenStorageInterface $tokenStorage;
    private CoordenadorService $coordenadorService;
    private VinculacaoUsuarioRepository $vinculacaoUsuarioRepository;

    /**
     * Rule0008 constructor.
     */
    public function __construct(
        RulesTranslate $rulesTranslate,
        TokenStorageInterface $tokenStorage,
        VinculacaoUsuarioRepository $vinculacaoUsuarioRepository,
        CoordenadorService $coordenadorService,
        private TransactionManager $transactionManager
    ) {
        $this->rulesTranslate = $rulesTranslate;
        $this->tokenStorage = $tokenStorage;
        $this->coordenadorService = $coordenadorService;
        $this->vinculacaoUsuarioRepository = $vinculacaoUsuarioRepository;
    }

    public function supports(): array
    {
        return [
            Tarefa::class => [
                'assertUpdate',
                'assertPatch',
                'assertUndelete',
            ],
        ];
    }

    /**
     * @param Tarefa|RestDtoInterface|null $restDto
     * @param TarefaEntity|EntityInterface $entity
     *
     * @throws RuleException
     */
    public function validate(?RestDtoInterface $restDto, EntityInterface $entity, string $transactionId): bool
    {
        if ($this->tokenStorage->getToken() &&
            $this->tokenStorage->getToken()->getUser()) {
            /** @var Usuario $usuario */
            $usuario = $this->tokenStorage->getToken()->getUser();
            // Se for resposta de Documento Avulso, pode
            if ($this->transactionManager->getContext('respostaDocumentoAvulso', $transactionId)) {
                return true;
            }
            // é usuário externo? Não pode.
            if (!$usuario->getColaborador()) {
                $this->rulesTranslate->throwException('tarefa', '0008');
            }

            // é o usuário responsável? Pode.
            if ($entity->getUsuarioResponsavel()->getId() === $usuario->getId()) {
                return true;
            }

            // é o usuário que criou a tarefa? Pode.
            if ($entity->getCriadoPor() &&
                ($entity->getCriadoPor()->getId() === $usuario->getId())) {
                return true;
            }

            // é um assessor do usuário responsável? Pode.
            if ($this->vinculacaoUsuarioRepository->findByUsuarioAndUsuarioVinculado(
                $entity->getUsuarioResponsavel()->getId(),
                $usuario->getId()
            )) {
                return true;
            }

            // é um coordenador responsável? Pode.
            $isCoordenador = false;
            $isCoordenador |= $this->coordenadorService
                ->verificaUsuarioCoordenadorSetor([$entity->getSetorResponsavel()]);
            $isCoordenador |= $this->coordenadorService
                ->verificaUsuarioCoordenadorUnidade([$entity->getSetorResponsavel()->getUnidade()]);
            $isCoordenador |= $this->coordenadorService
                ->verificaUsuarioCoordenadorOrgaoCentral(
                    [$entity->getSetorResponsavel()->getUnidade()->getModalidadeOrgaoCentral()]
                );
            if ($isCoordenador) {
                return true;
            }

            $this->rulesTranslate->throwException('tarefa', '0008');
        }

        return true;
    }

    public function getOrder(): int
    {
        return 1;
    }
}
