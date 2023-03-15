<?php

/** @noinspection PhpMissingParentCallCommonInspection */
declare(strict_types=1);

namespace SuppCore\AdministrativoBackend\Validator\Constraints;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class DtoUniqueEntity extends Constraint
{
    public const NOT_UNIQUE_ERROR = 'e777db8d-3af0-41f6-8a73-55255375cdca';

    /**
     * @var array
     */
    protected const ERROR_NAMES = [
        self::NOT_UNIQUE_ERROR => 'NOT_UNIQUE_ERROR',
    ];

    public ?EntityManager $em = null;

    public ?string $entityClass = null;

    /**
     * @var
     */
    public $errorPath;

    public array $fieldMapping = [];

    public bool $ignoreNull = true;

    public string $message = 'Este campo já está em utilização.';

    public string $repositoryMethod = 'findBy';

    /**
     * @return string
     */
    public function getDefaultOption(): string
    {
        return 'entityClass';
    }

    /**
     * @return array
     */
    public function getRequiredOptions(): array
    {
        return ['fieldMapping', 'entityClass'];
    }

    /**
     * @return array|string
     */
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }

    /**
     * @return string
     */
    public function validatedBy(): string
    {
        return DtoUniqueEntityValidator::class;
    }
}
