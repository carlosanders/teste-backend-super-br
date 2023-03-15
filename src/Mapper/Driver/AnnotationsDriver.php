<?php

declare(strict_types=1);
/**
 * /src//Mapper/Driver/AnnotationDriver.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Mapper\Driver;

use Doctrine\Common\Annotations\AnnotationReader;
use ReflectionClass;
use ReflectionException;
use SuppCore\AdministrativoBackend\Mapper\Annotations\JsonLD;
use SuppCore\AdministrativoBackend\Mapper\Annotations\Mapper;
use SuppCore\AdministrativoBackend\Mapper\Annotations\Property;
use SuppCore\AdministrativoBackend\Mapper\MapperMetadata;
use Symfony\Contracts\Cache\CacheInterface;

/**
 * Class AnnotationDriver.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class AnnotationsDriver implements MetadataDriverInterface
{
    /**
     * @param CacheInterface $appCache
     */
    public function __construct(
        private CacheInterface $appCache
    ) {
    }

    /**
     * @param string $dtoClassName
     *
     * @return MapperMetadata
     *
     * @throws ReflectionException
     */
    public function getMetadata(string $dtoClassName): MapperMetadata
    {
        return $this->appCache->get('mapper_'.str_replace('\\', '_', $dtoClassName), function () use ($dtoClassName) {

            $metadata = new MapperMetadata();
            $reader = new AnnotationReader();
            $reflectionClass = new ReflectionClass($dtoClassName);

            foreach ($reader->getClassAnnotations($reflectionClass) as $classAnnotation) {
                if ($classAnnotation instanceof Mapper) {
                    $metadata->setMapper($classAnnotation);
                }

                if ($classAnnotation instanceof JsonLD) {
                    $metadata->setJsonLD($classAnnotation);
                }
            }

            while (is_object($reflectionClass)) {
                $properties = $reflectionClass->getProperties();
                foreach ($properties as $property) {
                    /** @var Property $propertyAnnotation */
                    $propertyAnnotation = $reader->getPropertyAnnotation($property, Property::class);
                    if (!$propertyAnnotation) {
                        continue;
                    }
                    if (null === $propertyAnnotation->name) {
                        $propertyAnnotation->name = $property->getName();
                    }
                    $metadata->addProperty($propertyAnnotation);
                }
                $reflectionClass = $reflectionClass->getParentClass();
            }

            return $metadata;
        });
    }
}
