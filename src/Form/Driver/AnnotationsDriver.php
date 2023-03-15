<?php

declare(strict_types=1);
/**
 * /src/Form/Driver/AnnotationDriver.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Form\Driver;

use Doctrine\Common\Annotations\AnnotationReader;
use function is_object;
use LogicException;
use Psr\Cache\InvalidArgumentException;
use ReflectionClass;
use SuppCore\AdministrativoBackend\Form\Annotations\Field;
use SuppCore\AdministrativoBackend\Form\Annotations\Form;
use SuppCore\AdministrativoBackend\Form\FormMetadata;
use Symfony\Contracts\Cache\CacheInterface;

/**
 * Class AnnotationDriver.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class AnnotationsDriver implements MetadataDriverInterface
{
    public function __construct(
        private CacheInterface $appCache
    ) {
    }

    /**
     * @param string $dtoClassName
     *
     * @return FormMetadata
     *
     * @throws InvalidArgumentException
     */
    public function getMetadata(string $dtoClassName): FormMetadata
    {
        return $this->appCache->get('form_'.str_replace('\\', '_', $dtoClassName), function () use ($dtoClassName) {
            $metadata = new FormMetadata();
            $reader = new AnnotationReader();
            $reflectionClass = new ReflectionClass($dtoClassName);
            /* @var Form[] $form */
            foreach ($reader->getClassAnnotations($reflectionClass) as $classAnnotation) {
                if ($classAnnotation instanceof Form) {
                    $metadata->setForm($classAnnotation);
                    break;
                }
            }
            if (null === $metadata->getForm()) {
                throw new LogicException('DTO não possui a anotação @Form');
            }
            while (is_object($reflectionClass)) {
                $properties = $reflectionClass->getProperties();
                foreach ($properties as $property) {
                    /** @var Field $field */
                    $field = $reader->getPropertyAnnotation($property, Field::class);
                    if (null !== $field) {
                        if (null === $field->name) {
                            $field->name = $property->getName();
                        }
                        $metadata->addField($field);
                    }
                }
                $reflectionClass = $reflectionClass->getParentClass();
            }

            return $metadata;
        });
    }
}
