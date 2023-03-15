<?php

declare(strict_types=1);

namespace SuppCore\AdministrativoBackend\Api\V1\Rules\Assinatura;

use SuppCore\AdministrativoBackend\Api\V1\DTO\Assinatura;
use SuppCore\AdministrativoBackend\Api\V1\Resource\ModeloResource;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Rules\Exceptions\RuleException;
use SuppCore\AdministrativoBackend\Rules\RuleInterface;
use SuppCore\AdministrativoBackend\Rules\RulesTranslate;

/**
 * Class Rule0010.
 *
 * @descSwagger=Ao assinar um documento, caso o mesmo seja um modelo, proibir sua assinatura.
 * @classeSwagger=Rule0010
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Rule0010 implements RuleInterface
{
    private RulesTranslate $rulesTranslate;
    private ModeloResource $modeloResource;

    /**
     * Rule0010 constructor.
     */
    public function __construct(RulesTranslate $rulesTranslate, ModeloResource $modeloResource)
    {
        $this->rulesTranslate = $rulesTranslate;
        $this->modeloResource = $modeloResource;
    }

    public function supports(): array
    {
        return [
            Assinatura::class => [
                'beforeCreate',
            ],
        ];
    }

    /**
     * @throws RuleException
     */
    public function validate(?RestDtoInterface $restDto, EntityInterface $entity, string $transactionId): bool
    {
        $documentoId = $restDto->getComponenteDigital()->getDocumento()->getId() ?? null;
        if (null !== $this->modeloResource->findOneBy(['documento' => $documentoId])) {
            $this->rulesTranslate->throwException('assinatura', '0010');
        }

        return true;
    }

    public function getOrder(): int
    {
        return 10;
    }
}
