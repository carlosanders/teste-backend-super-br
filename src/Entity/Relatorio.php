<?php

declare(strict_types=1);
/**
 * /src/Entity/Relatorio.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Entity;

use DMS\Filter\Rules as Filter;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Gedmo\Mapping\Annotation as Gedmo;
use SuppCore\AdministrativoBackend\Entity\Traits\Blameable;
use SuppCore\AdministrativoBackend\Entity\Traits\Id;
use SuppCore\AdministrativoBackend\Entity\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\Entity\Traits\Timestampable;
use SuppCore\AdministrativoBackend\Entity\Traits\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Relatorio.
 *
 *  @ORM\Table(
 *     name="ad_relatorio",
 * )
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Relatorio implements EntityInterface
{
    // Traits
    use Blameable;
    use Timestampable;
    use Softdeleteable;
    use Id;
    use Uuid;

    public const STATUS_CARREGANDO = 0;
    public const STATUS_SUCESSO = 1;
    public const STATUS_ERRO = 2;

    /**
     * @ORM\Column(
     *     type="integer",
     *     nullable=true
     * )
     */
    protected ?int $status = 0;

    /**
     * Constructor.
     *
     * @throws Exception
     */
    public function __construct()
    {
        $this->setUuid();
        $this->vinculacoesEtiquetas = new ArrayCollection();
    }

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(
     *     targetEntity="TipoRelatorio"
     * )
     * @ORM\JoinColumn(
     *     name="tipo_relatorio_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected ?TipoRelatorio $tipoRelatorio = null;

    /**
     * @ORM\OneToOne(
     *     targetEntity="Documento",
     *     inversedBy="relatorio"
     * )
     * @ORM\JoinColumn(
     *     name="documento_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?Documento $documento = null;

    /**
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     *
     * @ORM\Column(
     *     type="string",
     *     nullable=true
     * )
     */
    protected ?string $observacao = null;

    /**
     * @var Collection|ArrayCollection|ArrayCollection<VinculacaoEtiqueta>
     *
     * @ORM\OneToMany(
     *     targetEntity="VinculacaoEtiqueta",
     *     mappedBy="relatorio"
     * )
     */
    protected $vinculacoesEtiquetas;

    /**
     * @return string|null
     */
    public function getObservacao(): ?string
    {
        return $this->observacao;
    }

    /**
     * @param string|null $observacao
     *
     * @return Relatorio
     */
    public function setObservacao(?string $observacao): self
    {
        $this->observacao = $observacao;

        return $this;
    }

    /**
     * @return TipoRelatorio
     */
    public function getTipoRelatorio(): ?TipoRelatorio
    {
        return $this->tipoRelatorio;
    }

    /**
     * @param TipoRelatorio $tipoRelatorio
     *
     * @return Relatorio
     */
    public function setTipoRelatorio(TipoRelatorio $tipoRelatorio): self
    {
        $this->tipoRelatorio = $tipoRelatorio;

        return $this;
    }

    /**
     * @return Documento|null
     */
    public function getDocumento(): ?Documento
    {
        return $this->documento;
    }

    /**
     * @param Documento|null $documento
     *
     * @return Relatorio
     */
    public function setDocumento(?Documento $documento): self
    {
        $this->documento = $documento;

        return $this;
    }

    /**
     * @return Collection|ArrayCollection|ArrayCollection<VinculacaoEtiqueta>
     */
    public function getVinculacoesEtiquetas(): Collection
    {
        return $this->vinculacoesEtiquetas;
    }

    /**
     * @param VinculacaoEtiqueta $vinculacaoEtiqueta
     *
     * @return Relatorio
     */
    public function addVinculacaoEtiqueta(VinculacaoEtiqueta $vinculacaoEtiqueta): self
    {
        if (!$this->vinculacoesEtiquetas->contains($vinculacaoEtiqueta)) {
            $this->vinculacoesEtiquetas->add($vinculacaoEtiqueta);
            $vinculacaoEtiqueta->setRelatorio($this);
        }

        return $this;
    }

    /**
     * @param VinculacaoEtiqueta $vinculacaoEtiqueta
     *
     * @return Relatorio
     */
    public function removeVinculacaoEtiqueta(VinculacaoEtiqueta $vinculacaoEtiqueta): self
    {
        if ($this->vinculacoesEtiquetas->contains($vinculacaoEtiqueta)) {
            $this->vinculacoesEtiquetas->removeElement($vinculacaoEtiqueta);
        }

        return $this;
    }

    /**
     * @return null|int
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @param null|int $status
     *
     * @return Relatorio
     */
    public function setStatus(?int $status): self
    {
        $this->status = $status;

        return $this;
    }
}
