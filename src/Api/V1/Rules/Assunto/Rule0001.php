<?php

declare(strict_types=1);
/**
 * /src/Api/V1/Rules/Assunto/Rule0001.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Rules\Assunto;

use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\Assunto;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Rules\Exceptions\RuleException;
use SuppCore\AdministrativoBackend\Rules\RuleInterface;
use SuppCore\AdministrativoBackend\Rules\RulesTranslate;

/**
 * Class Rule0001.
 *
 * @descSwagger=Assuntos criados pela integração não podem ser editados pelos usuários!
 * @classeSwagger=Rule0001
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Rule0001 implements RuleInterface
{
    private RulesTranslate $rulesTranslate;

    /**
     * Rule0001 constructor.
     */
    public function __construct(RulesTranslate $rulesTranslate)
    {
        $this->rulesTranslate = $rulesTranslate;
    }

    public function supports(): array
    {
        return [
            Assunto::class => [
                'beforeDelete',
            ],
        ];
    }

    /**
     * @param \SuppCore\AdministrativoBackend\Api\V1\DTO\Assunto|RestDtoInterface|null $restDto
     * @param Assunto|EntityInterface                                                  $entity
     *
     * @throws RuleException
     */
    public function validate(?RestDtoInterface $restDto, EntityInterface $entity, string $transactionId): bool
    {
        if ($entity->getPrincipal()) {
            $this->rulesTranslate->throwException('assunto', '0001');
        }

        return true;
    }

    public function getOrder(): int
    {
        return 1;
    }
}
