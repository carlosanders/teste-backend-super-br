<?php

declare(strict_types=1);
/**
 * /src/Api/V1/Rules/ConfigModulo/Rule0003.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Rules\ConfigModulo;

use JetBrains\PhpStorm\ArrayShape;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Rules\Exceptions\RuleException;
use SuppCore\AdministrativoBackend\Rules\RuleInterface;
use SuppCore\AdministrativoBackend\Api\V1\DTO\ConfigModulo as ConfigModuloDTO;
use SuppCore\AdministrativoBackend\Entity\ConfigModulo as ConfigModuloEntity;
use SuppCore\AdministrativoBackend\Transaction\TransactionManager;
use SuppCore\AdministrativoBackend\Utils\StringService;
use SuppCore\AdministrativoBackend\Rules\RulesTranslate;

/**
 * Class Rule0003.
 *
 * @descSwagger  =Valida se os DataTypes informados correspondem aos valores informados
 * @classeSwagger=Trigger0001
 */
class Rule0003 implements RuleInterface
{
    /**
     * Rule0003 constructor.
     */
    public function __construct(
        private RulesTranslate $rulesTranslate,
        private TransactionManager $transactionManager
    ) {
    }

    #[ArrayShape([ConfigModuloDTO::class => "string[]"])]
    public function supports(): array
    {
        return [
            ConfigModuloDTO::class => [
                'assertUpdate',
                'assertPatch',
            ],
        ];
    }

    /**
     * @param ConfigModuloDTO|RestDtoInterface|null $restDto
     * @param ConfigModuloEntity|EntityInterface    $entity
     * @param string                                $transactionId
     *
     * @return bool
     *
     * @throws RuleException
     * @noinspection PhpVoidFunctionResultUsedInspection
     */
    public function validate(
        ConfigModuloDTO|RestDtoInterface|null $restDto,
        ConfigModuloEntity|EntityInterface $entity,
        string $transactionId
    ): bool {
        $dataType = $restDto->getDataType();
        $valor = $restDto->getDataValue();
        $editAdmin = $this->transactionManager->getContext('edit-admin', $transactionId)?->getValue();
        if ($editAdmin && $valor === null) {
            return true;
        }

        return match ($dataType) {
            'string' => true,
            'float' => StringService::isFloat($valor) ?: $this->rulesTranslate->throwException(
                'configModulo',
                'R0003',
                ['FLOAT', $dataType]
            ),
            'bool' => StringService::isBool($valor) ?: $this->rulesTranslate->throwException(
                'configModulo',
                'R0003',
                ['BOOL', $dataType]
            ),
            'int' => StringService::isInt($valor) ?: $this->rulesTranslate->throwException(
                'configModulo',
                'R0003',
                ['INT', $dataType]
            ),
            'datetime' => StringService::isDateTime($valor) ?: $this->rulesTranslate->throwException(
                'configModulo',
                'R0003',
                ['DATETIME', $dataType]
            ),
            'json' => json_decode($valor) !== null ?: $this->rulesTranslate->throwException(
                'configModulo',
                'R0003',
                ['JSON', $dataType]
            ),
            default => $this->rulesTranslate->throwException('configModulo', 'R0003a', [$dataType])
        };
    }

    public function getOrder(): int
    {
        return 3;
    }
}
