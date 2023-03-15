<?php

declare(strict_types=1);
/**
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Doctrine\ORM\Immutable;

use Doctrine\Common\Annotations\Annotation;

/**
 * Class Immutable.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 * @Annotation
 * @Annotation\Target({"CLASS"})
 */
class Immutable extends Annotation
{
    public const EXPRESSION_EQUALS = 'equals';
    public const EXPRESSION_NOT_EQUALS = 'not_equals';
    public const EXPRESSION_IN = 'in';
    public const EXPRESSION_NOT_IN = 'not_in';
    public const EXPRESSION_IS_NULL = 'is_null';
    public const EXPRESSION_IS_NOT_NULL = 'is_not_null';

    public ?string $fieldName = null;
    public mixed $expressionValues = null;
    public bool $lockAll = false;
    public string $expression = self::EXPRESSION_EQUALS;
}
