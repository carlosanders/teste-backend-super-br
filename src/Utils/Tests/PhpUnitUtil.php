<?php

declare(strict_types=1);
/**
 * /src/Utils/Tests/PHPUnitUtil.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Utils\Tests;

use function count;
use DateTime;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\DBAL\Types\Type;
use Exception;
use function explode;
use function get_class;
use LogicException;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;
use ReflectionProperty;
use function sprintf;
use stdClass;
use function substr_count;

/**
 * Class PHPUnitUtil.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class PhpUnitUtil
{
    private const TYPE_ARRAY = 'array';
    private const TYPE_BOOLEAN = 'boolean';
    private const TYPE_CUSTOM_CLASS = 'CustomClass';
    private const TYPE_FLOAT = 'float';
    private const TYPE_INTEGER = 'integer';
    private const TYPE_STRING = 'string';
    private const TYPE_MIXED = 'mixed';

    /**
     * Get a private or protected method for testing/documentation purposes.
     * How to use for MyClass->foo():
     *      $cls = new MyClass();
     *      $foo = PHPUnitUtil::getPrivateMethod($cls, 'foo');
     *      $foo->invoke($cls, $...);.
     *
     * @param mixed  $className  The instantiated instance of your class
     * @param string $methodName The name of your private/protected method
     *
     * @return ReflectionMethod The method you asked for
     *
     * @throws ReflectionException
     */
    public static function getMethod(mixed $className, string $methodName): ReflectionMethod
    {
        return new ReflectionMethod($className, $methodName);
    }

    /**
     * Helper method to get any property value from given class.
     *
     * @param string $propertyName
     * @param string $className
     *
     * @return ReflectionProperty
     *
     * @throws ReflectionException
     */
    public static function getProperty(string $propertyName, string $className): ReflectionProperty
    {
        return new ReflectionProperty($className, $propertyName);
    }

    /**
     * @param string|Type|null $type
     *
     * @return string
     */
    public static function getType(Type|string|null $type): string
    {
        switch ($type) {
            case self::TYPE_INTEGER:
            case 'bigint':
                $output = self::TYPE_INTEGER;
                break;
            case 'time':
            case 'date':
            case 'datetime':
                $output = DateTime::class;
                break;
            case 'text':
            case self::TYPE_STRING:
            case self::TYPE_ARRAY:
                $output = self::TYPE_ARRAY;
                break;
            case self::TYPE_BOOLEAN:
                $output = self::TYPE_BOOLEAN;
                break;
            default:
                $message = sprintf(
                    "Currently type '%s' is not supported within type normalizer",
                    (string) $type
                );

                throw new LogicException($message);
        }

        return $output;
    }

    /**
     * Helper method to override any property value within given class.
     *
     * @param string $property
     * @param mixed  $value
     * @param mixed  $object
     *
     * @throws ReflectionException
     */
    public static function setProperty(string $property, mixed $value, mixed $object): void
    {
        $clazz = new ReflectionClass(get_class($object));

        /** @noinspection CallableParameterUseCaseInTypeContextInspection */
        $property = $clazz->getProperty($property);
        $property->setAccessible(true);
        $property->setValue($object, $value);
    }

    /**
     * @param ReflectionProperty $reflectionProperty
     * @param mixed              $annotationName
     *
     * @return mixed
     */
    public static function getPropertyAnnotation(
        ReflectionProperty $reflectionProperty,
        mixed $annotationName,
    ): mixed {
        $reader = new AnnotationReader();

        return $reader->getPropertyAnnotation($reflectionProperty, $annotationName);
    }

    /**
     * Helper method to get valid value for specified type.
     *
     * @param string     $type
     * @param array|null $meta
     *
     * @return mixed
     *
     * @throws ReflectionException
     * @throws Exception
     */
    public static function getValidValueForType(string $type, ?array $meta = null): mixed
    {
        $meta ??= [];

        $class = stdClass::class;

        if (substr_count($type, '\\') > 1 && !str_contains($type, '|')) {
            $class = count($meta) ? $meta['targetEntity'] : $type;

            $type = self::TYPE_CUSTOM_CLASS;
        }

        if (str_contains($type, '|')) {
            $validType = self::getValidType($type);
            $output = self::getValidValueForType($validType, $meta);
        } elseif (str_contains($type, '[]')) {
            $output = self::getValidValueForType(self::TYPE_ARRAY, $meta);
        } else {
            $validType = self::getValidType($type);

            switch ($validType) {
                case self::TYPE_CUSTOM_CLASS:
                    $output = new $class();
                    break;
                case self::TYPE_INTEGER:
                    $output = 10;
                    break;
                case self::TYPE_FLOAT:
                    $output = 10.5;
                    break;
                case self::TYPE_MIXED:
                    $output = 'mixed type';
                    break;
                case DateTime::class:
                    $output = new DateTime();
                    break;
                case self::TYPE_STRING:
                    $output = 'Some text here';
                    break;
                case self::TYPE_ARRAY:
                    $output = ['some', self::TYPE_ARRAY, 'here'];
                    break;
                case self::TYPE_BOOLEAN:
                    $output = true;
                    break;
                default:
                    $message = sprintf(
                        "Cannot create valid value for type '%s'.",
                        $validType
                    );

                    throw new LogicException($message);
            }
        }

        return $output;
    }

    /**
     * Retorna somente um tipo válido para ser instanciado. Ignora Traits, Interfaces ou Abstracts.
     *
     * @param string $type
     *
     * @return string
     */
    private static function getValidType(string $type): string
    {
        $types = explode('|', $type);
        $nullable = in_array('null', $types);

        foreach ($types as $currentType) {
            // Ignora Trait ou Interface
            if (trait_exists($currentType) || interface_exists($currentType)) {
                continue;
            }

            // Ignora Abstract
            $isAbstract = class_exists($currentType) && (new ReflectionClass($currentType))->isAbstract();
            if ($isAbstract
                || 'null' === $currentType && $nullable
            ) {
                continue;
            }

            if ('int' === $currentType) {
                $currentType = self::TYPE_INTEGER;
            }

            if ('bool' === $currentType) {
                $currentType = self::TYPE_BOOLEAN;
            }

            return $currentType;
        }

        throw new LogicException(sprintf('Não foi possível identificar um tipo válido para "%s"', $type));
    }
}
