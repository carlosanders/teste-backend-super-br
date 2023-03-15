<?php

declare(strict_types=1);
/**
 * /src/Api/V1/Rules/Assinatura/Rule0009.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Rules\Assinatura;

use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\Assinatura;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Rules\Exceptions\RuleException;
use SuppCore\AdministrativoBackend\Rules\RuleInterface;
use SuppCore\AdministrativoBackend\Rules\RulesTranslate;

/**
 * Class Rule0009.
 *
 * @descSwagger=Após a juntada do documento a assinatura não pode mais ser excluída!
 * @classeSwagger=Rule0009
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Rule0009 implements RuleInterface
{
    private RulesTranslate $rulesTranslate;

    /**
     * Rule0009 constructor.
     */
    public function __construct(RulesTranslate $rulesTranslate)
    {
        $this->rulesTranslate = $rulesTranslate;
    }

    public function supports(): array
    {
        return [
            Assinatura::class => [
                'beforeDelete',
            ],
        ];
    }

    /**
     * @param \SuppCore\AdministrativoBackend\Api\V1\DTO\Assinatura|RestDtoInterface|null $restDto
     * @param Assinatura|EntityInterface                                                  $entity
     *
     * @throws RuleException
     */
    public function validate(?RestDtoInterface $restDto, EntityInterface $entity, string $transactionId): bool
    {
        if ($entity->getComponenteDigital()->getDocumento()->getJuntadaAtual()) {
            $this->rulesTranslate->throwException('assinatura', '0009');
        }

        return true;
    }

    public function getOrder(): int
    {
        return 9;
    }
}
