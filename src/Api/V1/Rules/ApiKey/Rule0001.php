<?php

declare(strict_types=1);
/**
 * /src/Api/V1/Rules/ApiKey/Rule0001.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Rules\ApiKey;

use SuppCore\AdministrativoBackend\Api\V1\DTO\ApiKey;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Rules\Exceptions\RuleException;
use SuppCore\AdministrativoBackend\Rules\RuleInterface;
use SuppCore\AdministrativoBackend\Rules\RulesTranslate;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class Rule0001.
 *
 * @descSwagger=A apiKey não pode se auto deletar
 * @classeSwagger=Rule0001
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Rule0001 implements RuleInterface
{
    private TokenStorageInterface $tokenStorage;

    private RulesTranslate $rulesTranslate;

    /**
     * Rule0001 constructor.
     */
    public function __construct(
        RulesTranslate $rulesTranslate,
        TokenStorageInterface $tokenStorage
    ) {
        $this->rulesTranslate = $rulesTranslate;
        $this->tokenStorage = $tokenStorage;
    }

    public function supports(): array
    {
        return [
            ApiKey::class => [
                'beforeDelete',
            ],
        ];
    }

    /**
     * @param ApiKey|RestDtoInterface|null                                  $restDto
     * @param \SuppCore\AdministrativoBackend\Entity\ApiKey|EntityInterface $entity
     *
     * @throws RuleException
     */
    public function validate(?RestDtoInterface $restDto, EntityInterface $entity, string $transactionId): bool
    {
        if ($this->tokenStorage->getToken()->getApiKey()->getId() !== $entity->getId()) {
            $this->rulesTranslate->throwException('api_key', '0001');
        }

        return true;
    }

    public function getOrder(): int
    {
        return 1;
    }
}
