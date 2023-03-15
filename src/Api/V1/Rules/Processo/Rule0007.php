<?php

declare(strict_types=1);
/**
 * /src/Api/V1/Rules/Processo/Rule0007.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Rules\Processo;

use SuppCore\AdministrativoBackend\Api\V1\DTO\Processo;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Repository\VinculacaoPessoaUsuarioRepository;
use SuppCore\AdministrativoBackend\Rules\Exceptions\RuleException;
use SuppCore\AdministrativoBackend\Rules\RuleInterface;
use SuppCore\AdministrativoBackend\Rules\RulesTranslate;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * Class Rule0007.
 *
 * @descSwagger=Em caso de usuário externo, verifica se o mesmo possui unidade vinculada
 * @classeSwagger=Rule0007
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Rule0007 implements RuleInterface
{
    private RulesTranslate $rulesTranslate;

    private TokenStorageInterface $tokenStorage;

    private AuthorizationCheckerInterface $authorizationChecker;

    private VinculacaoPessoaUsuarioRepository $vinculacaoPessoaUsuarioRepository;

    /**
     * Rule0007 constructor.
     */
    public function __construct(
        RulesTranslate $rulesTranslate,
        TokenStorageInterface $tokenStorage,
        AuthorizationCheckerInterface $authorizationChecker,
        VinculacaoPessoaUsuarioRepository $vinculacaoPessoaUsuarioRepository
    ) {
        $this->rulesTranslate = $rulesTranslate;
        $this->tokenStorage = $tokenStorage;
        $this->authorizationChecker = $authorizationChecker;
        $this->vinculacaoPessoaUsuarioRepository = $vinculacaoPessoaUsuarioRepository;
    }

    public function supports(): array
    {
        return [
            Processo::class => [
                'beforeCreate',
                'skipWhenCommand',
            ],
        ];
    }

    /**
     * @param Processo|RestDtoInterface|null                                  $restDto
     * @param \SuppCore\AdministrativoBackend\Entity\Processo|EntityInterface $entity
     *
     * @throws RuleException
     */
    public function validate(?RestDtoInterface $restDto, EntityInterface $entity, string $transactionId): bool
    {
        if ((false === $this->authorizationChecker->isGranted('ROLE_COLABORADOR'))) {
            $vinculacaoUsuario = $this->vinculacaoPessoaUsuarioRepository
                ->findOneBy(['usuarioVinculado' => $this->tokenStorage->getToken()->getUser()]);

            if (null === $vinculacaoUsuario) {
                $this->rulesTranslate->throwException('processo', '0006');
            }
        }

        return true;
    }

    public function getOrder(): int
    {
        return 1;
    }
}
