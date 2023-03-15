<?php

declare(strict_types=1);
/**
 * /src//Mapper/MapperMetadata.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Mapper;

use SuppCore\AdministrativoBackend\Mapper\Annotations\JsonLD as JsonLDAnnotation;
use SuppCore\AdministrativoBackend\Mapper\Annotations\Mapper as MapperAnnotation;
use SuppCore\AdministrativoBackend\Mapper\Annotations\Property as PropertyAnnotation;

/**
 * Class MapperMetadata.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class MapperMetadata
{
    /**
     * @var null|MapperAnnotation;
     */
    protected ?MapperAnnotation $mapper = null;

    /**
     * @var null|JsonLDAnnotation;
     */
    protected ?JsonLDAnnotation $jsonLD = null;

    /**
     * @var PropertyAnnotation[]
     */
    protected array $properties = [];

    /**
     * @param MapperAnnotation $mapper
     *
     * @return $this
     */
    public function setMapper(MapperAnnotation $mapper): self
    {
        $this->mapper = $mapper;

        return $this;
    }

    /**
     * @return MapperAnnotation|null
     */
    public function getMapper(): ?MapperAnnotation
    {
        return $this->mapper;
    }

    /**
     * @return JsonLDAnnotation
     */
    public function getJsonLD(): ?JsonLDAnnotation
    {
        return $this->jsonLD;
    }

    /**
     * @param JsonLDAnnotation|null $jsonLD
     */
    public function setJsonLD(?JsonLDAnnotation $jsonLD): void
    {
        $this->jsonLD = $jsonLD;
    }

    /**
     * @param PropertyAnnotation $property
     *
     * @return MapperMetadata
     */
    public function addProperty(PropertyAnnotation $property): self
    {
        $this->properties[] = $property;

        return $this;
    }

    /**
     * @return PropertyAnnotation[]
     */
    public function getProperties(): array
    {
        return $this->properties;
    }
}
