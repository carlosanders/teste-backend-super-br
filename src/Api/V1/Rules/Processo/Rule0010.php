<?php

declare(strict_types=1);
/**
 * /src/Api/V1/Rules/Processo/Rule0010.php.
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
 * Class Rule0010.
 *
 * @descSwagger=A data de desarquivamento automátivo só pode ser agendada no setor ARQUIVO!
 * @classeSwagger=Rule0010
 *
 * @author Eduardo Romão <eduardo.romao@agu.gov.br>
 */
class Rule0010 implements RuleInterface
{
    private RulesTranslate $rulesTranslate;

    /**
     * Rule0010 constructor.
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
        if (
            $restDto->getDataHoraDesarquivamento()
            && 'ARQUIVO' != $entity->getSetorAtual()->getEspecieSetor()->getNome()
        ) {
            $this->rulesTranslate->throwException('processo', '0010');
        }

        return true;
    }

    public function getOrder(): int
    {
        return 10;
    }
}
