<?php

declare(strict_types=1);

namespace SuppCore\AdministrativoBackend\Utils;

use PHPModelGenerator\Exception\FileSystemException;
use PHPModelGenerator\Exception\RenderException;
use PHPModelGenerator\Exception\SchemaException;
use PHPModelGenerator\Format\FormatValidatorFromRegEx;
use PHPModelGenerator\Model\GeneratorConfiguration;
use PHPModelGenerator\ModelGenerator as PHPModelGenerator;
use SuppCore\CalculoBackend\Helper\Utils\JustFileProvider;
use SuppCore\CalculoBackend\Helper\Utils\Str;
use Swaggest\JsonSchema\Exception;
use Swaggest\JsonSchema\InvalidValue;
use Swaggest\JsonSchema\Schema;

/**
 * Class ModelGenerator.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class ModelGenerator
{
    public function getSchemaUri(): string
    {
         return "http://localhost:4200/v1/administrativo/schema";
    }

    protected function getSchemaDir(): string
    {
        return dirname(__DIR__).'/JsonSchema';
    }

    protected function getModelNamespace(): string
    {
        return 'SuppCore\\AdministrativoBackend\\JsonSchema\\Models';
    }

    final protected function getModelDir(string $schemaName): string
    {
        return rtrim($this->getSchemaDir(), '/').'/Models/'.Str::classNameCase($schemaName);
    }

    final protected function getModelPrefix(string $schemaName): string
    {
        return rtrim($this->getModelNamespace(), '\\').'\\'.Str::classNameCase($schemaName).'\\';
    }

    final public function getJsonSchemaUrlVersion(): string
    {
        return 'http://json-schema.org/draft-07/schema#';
    }

    final public function getJsonSchemaContent(): string
    {
        return file_get_contents(rtrim(self::getSchemaDir(), '/').'/DRAFT07.schema.json');
    }

    /**
     * @throws Exception
     * @throws InvalidValue
     */
    public function validateSchema(string $jsonFileContent, ?string $schemaContent = null): void
    {
        // validamos se o json informado é válido conforme o schema
        $schemaContent = $schemaContent ? $this->toLocalDataSchema($schemaContent) : $this->getJsonSchemaContent();
        $schemaDraft = Schema::import(json_decode($schemaContent));
        $schemaContentObject = json_decode($this->toLocalDataSchema($jsonFileContent));
        $schemaDraft->in($schemaContentObject);
    }

    public function saveSchema(string $schemaName, string $schemaContent): void
    {
        file_put_contents(
            rtrim($this->getSchemaDir(), '/')."/$schemaName.schema.json",
            $this->toCustomDataSchema($schemaContent)
        );
    }

    /**
     * @param string $schemaName
     * @param string $schemaContent
     * @param bool   $outputEnable
     *
     * @throws Exception
     * @throws FileSystemException
     * @throws InvalidValue
     * @throws RenderException
     * @throws SchemaException
     * @noinspection DuplicatedCode
     */
    public function generate(
        string $schemaName,
        string $schemaContent,
        bool $outputEnable = false
    ): void {
        $this->validateSchema($schemaContent);
        $this->saveSchema($schemaName, $schemaContent);

        $configuration = (new GeneratorConfiguration())
            ->setNamespacePrefix($this->getModelPrefix($schemaName))
            ->setImmutable(false)
            ->setDefaultArraysToEmptyArray(true)
            ->setOutputEnabled($outputEnable)
            ->addFormat(
                'date-time',
                new FormatValidatorFromRegEx(
                    "/^([0-9]+)-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01])[Tt]([01][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9]|60)(\.[0-9]+)?(([Zz])|([\+|\-]([01][0-9]|2[0-3]):[0-5][0-9]))$/"
                )
            );

        (new PHPModelGenerator($configuration))
            ->generateModelDirectory($this->getModelDir($schemaName))
            ->generateModels(
                new JustFileProvider(
                    rtrim($this->getSchemaDir(), '/')."/$schemaName.schema.json"
                ),
                $this->getModelDir($schemaName)
            );
    }

    /** @noinspection PhpUnused */
    public function fromUriToDataSchema(string $uriDataSchema): string
    {
        return str_replace($this->getSchemaUri(), '{{uri}}', $uriDataSchema);
    }

    /** @noinspection PhpUnused */
    public function fromLocalToDataSchema(string $localDataSchema): string
    {
        return str_replace($this->getSchemaDir(), '{{uri}}', $localDataSchema);
    }

    /** @noinspection PhpUnused */
    public function fromCustomToDataSchema(string $customDataSchema): string
    {
        return preg_replace(
            "/\"(\w+)\.schema\.json(.+)\"/",
            '"{{uri}}$1$2"',
            $customDataSchema
        );
    }

    /** @noinspection PhpUnused */
    public function toUriDataSchema(string $dataSchema): string
    {
        /* @noinspection RegExpRedundantEscape */
        return preg_replace(
            "/\{\{uri\}\}(\w*)(.*)/",
            "{$this->getSchemaUri()}$1$2",
            $dataSchema
        );
    }

    public function toLocalDataSchema(string $dataSchema): string
    {
        /* @noinspection RegExpRedundantEscape */
        return preg_replace(
            "/\{\{uri\}\}(\w*)(.*)/",
            "{$this->getSchemaDir()}/$1.schema.json$2",
            $dataSchema
        );
    }

    public function toCustomDataSchema(string $dataSchema): string
    {
        /* @noinspection RegExpRedundantEscape */
        return preg_replace(
            "/\{\{uri\}\}(\w*)(.*)/",
            '$1.schema.json$2',
            $dataSchema
        );
    }
}
