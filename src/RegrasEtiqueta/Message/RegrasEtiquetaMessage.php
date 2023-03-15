<?php

declare(strict_types=1);
/**
 * /src/RegrasEtiqueta/RegrasEtiquetaMessage.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\RegrasEtiqueta\Message;

/**
 * Class RegrasEtiquetaMessage.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class RegrasEtiquetaMessage
{
    private string $uuid;
    private string $resource;
    private string $vinculacaoResource;
    private int $modalidadeEtiquetaId;
    private string $entityName;

    private ?int $usuarioId = null;
    private ?int $setorId = null;
    private ?int $unidadeId = null;
    private ?int $modalidadeOrgaoCentralId = null;

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     */
    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }

    /**
     * @return string
     */
    public function getResource(): string
    {
        return $this->resource;
    }

    /**
     * @param string $resource
     */
    public function setResource(string $resource): void
    {
        $this->resource = $resource;
    }

    /**
     * @return int|null
     */
    public function getUsuarioId(): ?int
    {
        return $this->usuarioId;
    }

    /**
     * @param int|null $usuarioId
     */
    public function setUsuarioId(?int $usuarioId): void
    {
        $this->usuarioId = $usuarioId;
    }

    /**
     * @return int|null
     */
    public function getSetorId(): ?int
    {
        return $this->setorId;
    }

    /**
     * @param int|null $setorId
     */
    public function setSetorId(?int $setorId): void
    {
        $this->setorId = $setorId;
    }

    /**
     * @return int|null
     */
    public function getUnidadeId(): ?int
    {
        return $this->unidadeId;
    }

    /**
     * @param int|null $unidadeId
     */
    public function setUnidadeId(?int $unidadeId): void
    {
        $this->unidadeId = $unidadeId;
    }

    /**
     * @return int|null
     */
    public function getModalidadeOrgaoCentralId(): ?int
    {
        return $this->modalidadeOrgaoCentralId;
    }

    /**
     * @param int|null $modalidadeOrgaoCentralId
     */
    public function setModalidadeOrgaoCentralId(?int $modalidadeOrgaoCentralId): void
    {
        $this->modalidadeOrgaoCentralId = $modalidadeOrgaoCentralId;
    }

    /**
     * @return int|null
     */
    public function getModalidadeEtiquetaId(): ?int
    {
        return $this->modalidadeEtiquetaId;
    }

    /**
     * @param int $modalidadeEtiquetaId
     */
    public function setModalidadeEtiquetaId(int $modalidadeEtiquetaId): void
    {
        $this->modalidadeEtiquetaId = $modalidadeEtiquetaId;
    }

    /**
     * @return string
     */
    public function getEntityName(): string
    {
        return $this->entityName;
    }

    /**
     * @param string $entityName
     */
    public function setEntityName(string $entityName): void
    {
        $this->entityName = $entityName;
    }

    /**
     * @return string
     */
    public function getVinculacaoResource(): string
    {
        return $this->vinculacaoResource;
    }

    /**
     * @param string $vinculacaoResource
     */
    public function setVinculacaoResource(string $vinculacaoResource): void
    {
        $this->vinculacaoResource = $vinculacaoResource;
    }
}
