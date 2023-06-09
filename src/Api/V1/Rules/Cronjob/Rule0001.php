<?php

/** @noinspection PhpUndefinedClassInspection */
declare(strict_types=1);
/**
 * /src/Api/V1/Rules/Cronjob/Rule0001.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Rules\Cronjob;

use SuppCore\AdministrativoBackend\Api\V1\DTO\Cronjob as CronjobDTO;
use SuppCore\AdministrativoBackend\Cronjob\CronjobExpressionServiceInterface;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Rules\Exceptions\RuleException;
use SuppCore\AdministrativoBackend\Rules\RuleInterface;
use SuppCore\AdministrativoBackend\Rules\RulesTranslate;

/**
 * Class Rule0001.
 *
 * @descSwagger=Expressão de periodicidade inválida ou não suportada pelo sistema!
 * @classeSwagger=Rule0001
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Rule0001 implements RuleInterface
{
    /**
     * Rule0001 constructor.
     */
    public function __construct(
        private RulesTranslate $rulesTranslate,
        private CronjobExpressionServiceInterface $cronjobExpressionService
    ){
    }

    public function supports(): array
    {
        return [
            CronjobDto::class => [
                'beforeCreate',
                'beforeUpdate',
                'beforePatch',
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
        if (!$this->cronjobExpressionService->isValid($restDto->getPeriodicidade())) {
            $this->rulesTranslate->throwException('cronjob', '0001');
        }

        return true;
    }

    public function getOrder(): int
    {
        return 1;
    }
}
