<?php

declare(strict_types=1);
/**
 * /src/DTO/RestDto.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DTO;

use JMS\Serializer\Annotation as Serializer;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;

/**
 * Class RestDto.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
abstract class RestDto implements RestDtoInterface, EntityInterface
{
    /**
     * @Serializer\SerializedName("@type")
     */
    protected ?string $jsonLdType = null;

    /**
     * @Serializer\SerializedName("@id")
     */
    protected ?string $jsonLdId = null;

    /**
     * @Serializer\SerializedName("@context")
     */
    protected ?string $jsonLdContext = null;

    /**
     * @Serializer\SerializedName("immutable")
     */
    protected ?bool $immutable = null;

    /**
     * @param string|null $jsonLdType
     */
    public function setJsonLdType(?string $jsonLdType): void
    {
        $this->jsonLdType = $jsonLdType;
    }

    /**
     * @param string|null $jsonLdId
     */
    public function setJsonLdId(?string $jsonLdId): void
    {
        $this->jsonLdId = $jsonLdId;
    }

    /**
     * @param string|null $jsonLdContext
     */
    public function setJsonLdContext(?string $jsonLdContext): void
    {
        $this->jsonLdContext = $jsonLdContext;
    }

    /**
     * @return string|null
     */
    public function getJsonLDType(): ?string
    {
        return $this->jsonLdType;
    }

    /**
     * @return string|null
     */
    public function getJsonLDId(): ?string
    {
        return $this->jsonLdId;
    }

    /**
     * @return string|null
     */
    public function getJsonLDContext(): ?string
    {
        return $this->jsonLdContext;
    }

    /**
     * An array of 'visited' setter properties of current dto.
     *
     * @Serializer\Exclude()
     *
     * @var string[]
     */
    protected array $visited = [];

    /**
     * Getter method for visited setters. This is needed for dto patching.
     *
     * @return string[]
     */
    public function getVisited(): array
    {
        return $this->visited;
    }

    /**
     * Setter for visited data. This is needed for dto patching.
     *
     * @param string $property
     *
     * @return RestDtoInterface
     */
    public function setVisited(string $property): RestDtoInterface
    {
        if (!in_array($property, $this->visited)) {
            $this->visited[] = $property;
        }

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getImmutable(): ?bool
    {
        return $this->immutable;
    }

    /**
     * @param bool|null $immutable
     * @return RestDto
     */
    public function setImmutable(?bool $immutable): RestDto
    {
        $this->immutable = $immutable;

        return $this;
    }

}
