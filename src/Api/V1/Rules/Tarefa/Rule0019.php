<?php

declare(strict_types=1);
/**
 * /src/Api/V1/Rules/Tarefa/Rule0019.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Rules\Tarefa;

use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\Tarefa;
use SuppCore\AdministrativoBackend\Rules\Exceptions\RuleException;
use SuppCore\AdministrativoBackend\Rules\RuleInterface;
use SuppCore\AdministrativoBackend\Rules\RulesTranslate;
use SuppCore\AdministrativoBackend\Transaction\TransactionManager;

/**
 * Class Rule0019.
 *
 * @descSwagger=Não é possível criar tarefa caso não tenha assunto no processo!
 * @classeSwagger=Rule0019
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Rule0019 implements RuleInterface
{
    /**
     * Rule0019 constructor.
     */
    public function __construct(
        private RulesTranslate $rulesTranslate,
        private TransactionManager $transactionManager
    ) {
    }

    public function supports(): array
    {
        return [
            Tarefa::class => [
                'beforeCreate',
            ],
        ];
    }

    /**
     * @param RestDtoInterface|null $restDto
     * @param EntityInterface $entity
     * @param string $transactionId
     * @return bool
     * @throws RuleException
     */
    public function validate(?RestDtoInterface $restDto, EntityInterface $entity, string $transactionId): bool
    {
        if ($this->transactionManager->getContext('criacaoProcessoBarramento', $transactionId)) {
            return true;
        }

        if (0 === $restDto->getProcesso()->getAssuntos()->count()) {
            $this->rulesTranslate->throwException('tarefa', '0019');
        }

        return true;
    }

    public function getOrder(): int
    {
        return 19;
    }
}
