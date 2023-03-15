<?php

declare(strict_types=1);

namespace SuppCore\AdministrativoBackend\Api\V1\Rules\ConfigModulo;

use Exception;
use JetBrains\PhpStorm\ArrayShape;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Rules\Exceptions\RuleException;
use SuppCore\AdministrativoBackend\Rules\RuleInterface;
use SuppCore\AdministrativoBackend\Api\V1\DTO\ConfigModulo as ConfigModuloDTO;
use SuppCore\AdministrativoBackend\Entity\ConfigModulo as ConfigModuloEntity;
use SuppCore\AdministrativoBackend\Rules\RulesTranslate;
use SuppCore\AdministrativoBackend\Utils\ModelGenerator;
use Throwable;

/**
 * Class Rule0004.
 *
 * @descSwagger  =Valida o objeto de acordo com o modelo gerado com swaggest/json-cli.
 * @classeSwagger=Rule0004
 */
class Rule0004 implements RuleInterface
{
    /**
     * Rule0004 constructor.
     * @param RulesTranslate $rulesTranslate
     * @param ModelGenerator $modelGenerator
     */
    public function __construct(
        private RulesTranslate $rulesTranslate,
        private ModelGenerator $modelGenerator,
    ) {
    }

    #[ArrayShape([ConfigModuloDTO::class => "string[]"])]
    public function supports(): array
    {
        return [
            ConfigModuloDTO::class => [
                'assertCreate',
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
     */
    public function validate(
        ConfigModuloDTO|RestDtoInterface|null $restDto,
        ConfigModuloEntity|EntityInterface $entity,
        string $transactionId
    ): bool {
        $dataSchemaDTO = "";
        $dataSchemaEntity = "";
        if ($restDto->getParadigma()) {
            $dataSchemaDTO = $restDto->getParadigma()->getDataSchema();
            $dataSchemaEntity = $entity->getParadigma()?->getDataSchema();
        } else {
            $dataSchemaDTO = $restDto->getDataSchema();
            $dataSchemaEntity = $entity->getDataSchema();
        }

        /** @var ConfigModuloEntity $restDto */
        if (('json' === $restDto->getDataType()) &&
            $dataSchemaDTO &&
            $restDto->getDataValue() &&
            ($dataSchemaDTO !== $dataSchemaEntity)) {
            try {
                $this->modelGenerator->validateSchema($restDto->getDataValue(), $dataSchemaEntity);
            } catch (Throwable|Exception) {
                $this->rulesTranslate->throwException('configModulo', 'R0004');
            }
        }

        return true;
    }

    public function getOrder(): int
    {
        return 4;
    }
}
