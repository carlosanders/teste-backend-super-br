<?php

declare(strict_types=1);
/**
 * /src//Mapper/MapperManager.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Mapper;

use function array_key_exists;
use Doctrine\Common\Annotations\AnnotationException;
use function get_class;
use ReflectionException;
use SuppCore\AdministrativoBackend\Mapper\Annotations\Property;
use SuppCore\AdministrativoBackend\Mapper\Driver\AnnotationsDriver;
use Symfony\Contracts\Cache\CacheInterface;

/**
 * Class MapperManager.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class MapperManager
{
    /**
     * @var MapperInterface[]
     */
    protected array $mappers = [];

    protected array $mapperConfig = [];

    private AnnotationsDriver $driver;

    /**
     * MapperManager constructor.
     *
     * @param AnnotationsDriver $annotationDriver
     */
    public function __construct(
        AnnotationsDriver $annotationDriver
    ) {
        $this->driver = $annotationDriver;
    }

    /**
     * @return array
     */
    public function getMapperConfig(): array
    {
        return $this->mapperConfig;
    }

    /**
     * @param array $mapperConfig
     */
    public function setMapperConfig(array $mapperConfig): void
    {
        $this->mapperConfig = $mapperConfig;
    }

    /**
     * @param MapperInterface $mapper
     */
    public function addMapper(MapperInterface $mapper): void
    {
        $this->mappers[get_class($mapper)] = $mapper;
    }

    /**
     * @return MapperInterface
     */
    public function getDefaultMapper(): MapperInterface
    {
        return $this->mappers[DefaultMapper::class];
    }

    /**
     * @param string $dtoClassName
     *
     * @return MapperInterface
     *
     * @throws ReflectionException
     */
    public function getMapper(string $dtoClassName): MapperInterface
    {
        $mapperMetadata = $this->getMapperMetadata($dtoClassName);
        if ($mapperMetadata->getMapper() &&
            array_key_exists($mapperMetadata->getMapper()->class, $this->mappers)) {
            return $this->mappers[$mapperMetadata->getMapper()->class];
        }

        return $this->mappers[DefaultMapper::class];
    }

    /**
     * @param string $dtoClassName
     * @param string $propertyName
     *
     * @return Property|null
     *
     * @throws ReflectionException
     */
    public function getPropertyDTO(string $dtoClassName, string $propertyName): ?Property
    {
        $mapperMetadata = $this->getMapperMetadata($dtoClassName);
        foreach ($mapperMetadata->getProperties() as $property) {
            if ($property->name === $propertyName) {
                return $property;
            }
        }

        return null;
    }

    /**
     * @param string $dtoClassName
     *
     * @return MapperMetadata
     *
     * @throws ReflectionException
     */
    public function getMapperMetadata(string $dtoClassName): MapperMetadata
    {
        return $this->driver->getMetadata($dtoClassName);
    }
}
