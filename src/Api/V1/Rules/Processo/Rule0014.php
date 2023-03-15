<?php

declare(strict_types=1);
/**
 * /src/Api/V1/Rules/Processo/Rule0014.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Rules\Processo;

use SuppCore\AdministrativoBackend\Api\V1\DTO\Processo;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Rules\Exceptions\RuleException;
use SuppCore\AdministrativoBackend\Rules\RuleInterface;
use SuppCore\AdministrativoBackend\Rules\RulesTranslate;

/**
 * Class Rule0014.
 *
 * @descSwagger=Não é permitido alterar o campo outroNumero para processos do Barramento
 * @classeSwagger=Rule0014
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Rule0014 implements RuleInterface
{
    private RulesTranslate $rulesTranslate;

    /**
     * Rule0014 constructor.
     */
    public function __construct(
        RulesTranslate $rulesTranslate
    ) {
        $this->rulesTranslate = $rulesTranslate;
    }

    public function supports(): array
    {
        return [
            Processo::class => [
                'beforeUpdate',
                'beforePatch',
                'skipWhenCommand',
            ],
        ];
    }

    /**
     * @throws RuleException
     */
    public function validate(?RestDtoInterface $restDto, EntityInterface $entity, string $transactionId): bool
    {
        /** @var Processo $restDto */
        if ($entity->getOrigemDados() &&
            'BARRAMENTO_PEN' === $entity->getOrigemDados()->getFonteDados() &&
            in_array('outroNumero', $restDto->getVisited()) &&
            $restDto->getOutroNumero() && ($restDto->getOutroNumero() !== $entity->getOutroNumero())) {
            $this->rulesTranslate->throwException('processo', '0016');
        }

        return true;
    }

    public function getOrder(): int
    {
        return 9;
    }
}
