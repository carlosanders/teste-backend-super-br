<?php

declare(strict_types=1);

namespace SuppCore\AdministrativoBackend\Api\V1\Rules\Template;

use SuppCore\AdministrativoBackend\Api\V1\DTO\Template;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Rules\Exceptions\RuleException;
use SuppCore\AdministrativoBackend\Rules\RuleInterface;
use SuppCore\AdministrativoBackend\Rules\RulesTranslate;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * Class Rule0002
 * Rule para validar se o usuário tem permissão para alterar ou excluir o template.
 *
 * @author Willian Santos <willian.santos@datainfo.inf.br>
 */
class Rule0002 implements RuleInterface
{
    private RulesTranslate $rulesTranslate;

    private AuthorizationCheckerInterface $authorizationChecker;

    /**
     * Rule0002 constructor.
     */
    public function __construct(
        RulesTranslate $rulesTranslate,
        AuthorizationCheckerInterface $authorizationChecker
    ) {
        $this->rulesTranslate = $rulesTranslate;
        $this->authorizationChecker = $authorizationChecker;
    }

    public function supports(): array
    {
        return [
            Template::class => [
                'beforeUpdate',
                'beforePatch',
                'beforeDelete',
            ],
        ];
    }

    /**
     * @throws RuleException
     */
    public function validate(?RestDtoInterface $restDto, EntityInterface $entity, string $transactionId): bool
    {
        if ((false === $this->authorizationChecker->isGranted('ROLE_ADMIN'))) {
            $this->rulesTranslate->throwException('template', '0002');
        }

        return true;
    }

    public function getOrder(): int
    {
        return 1;
    }
}
