<?php

declare(strict_types=1);
/**
 * /src/Api/V1/Rules/Assunto/Rule0004.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Rules\Assunto;

use SuppCore\AdministrativoBackend\Api\V1\DTO\Assunto;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Rules\Exceptions\RuleException;
use SuppCore\AdministrativoBackend\Rules\RuleInterface;
use SuppCore\AdministrativoBackend\Rules\RulesTranslate;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * Class Rule0004.
 *
 * @descSwagger  =Usuário não possui poderes para editar o NUP!
 * @classeSwagger=Rule0004
 *
 * @author       Advocacia-Geral da União <supp@agu.gov.br>
 */
class Rule0004 implements RuleInterface
{
    private RulesTranslate $rulesTranslate;

    private AuthorizationCheckerInterface $authorizationChecker;

    /**
     * Rule0004 constructor.
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
            Assunto::class => [
                'beforeCreate',
                'beforeUpdate',
                'beforePatch',
                'skipWhenCommand',
            ],
        ];
    }

    /**
     * @param Assunto|RestDtoInterface|null $restDto
     * @param \SuppCore\AdministrativoBackend\Entity\Assunto|EntityInterface $entity
     *
     * @throws RuleException
     */
    public function validate(?RestDtoInterface $restDto, EntityInterface $entity, string $transactionId): bool
    {
        if ((false === $this->authorizationChecker->isGranted('EDIT', $restDto->getProcesso())) ||
            ($restDto->getProcesso()->getClassificacao() &&
                $restDto->getProcesso()->getClassificacao()->getId() &&
                (false === $this->authorizationChecker->isGranted('EDIT', $restDto->getProcesso()->getClassificacao())))) {
            $this->rulesTranslate->throwException('assunto', '0004');
        }

        return true;
    }

    public function getOrder(): int
    {
        return 4;
    }
}
