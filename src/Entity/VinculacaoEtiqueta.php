<?php

declare(strict_types=1);
/**
 * /src/Entity/VinculacaoEtiqueta.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use SuppCore\AdministrativoBackend\Entity\Traits as Traits;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class VinculacaoEtiqueta.
 *
 *  @ORM\Table(
 *     name="ad_vinc_etiqueta",
 * )
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class VinculacaoEtiqueta implements EntityInterface
{
    // Traits
    use Traits\VinculacaoEtiqueta;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(
     *     targetEntity="Etiqueta",
     *     inversedBy="vinculacoesEtiquetas"
     * )
     * @ORM\JoinColumn(
     *     name="etiqueta_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected ?Etiqueta $etiqueta = null;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="Tarefa",
     *     inversedBy="vinculacoesEtiquetas"
     * )
     * @ORM\JoinColumn(
     *     name="tarefa_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?Tarefa $tarefa = null;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="Documento",
     *     inversedBy="vinculacoesEtiquetas"
     * )
     * @ORM\JoinColumn(
     *     name="documento_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?Documento $documento = null;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="Processo",
     *     inversedBy="vinculacoesEtiquetas"
     * )
     * @ORM\JoinColumn(
     *     name="processo_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?Processo $processo = null;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="Relatorio",
     *     inversedBy="vinculacoesEtiquetas"
     * )
     * @ORM\JoinColumn(
     *     name="relatorio_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?Relatorio $relatorio = null;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="DocumentoAvulso",
     *     inversedBy="vinculacoesEtiquetas"
     * )
     * @ORM\JoinColumn(
     *     name="documento_avulso_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?DocumentoAvulso $documentoAvulso = null;


    /**
     * @return Tarefa|null
     */
    public function getTarefa(): ?Tarefa
    {
        return $this->tarefa;
    }

    /**
     * @param Tarefa|null $tarefa
     *
     * @return VinculacaoEtiqueta
     */
    public function setTarefa(?Tarefa $tarefa): self
    {
        $this->tarefa = $tarefa;

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
     * @return VinculacaoEtiqueta
     */
    public function setDocumento(?Documento $documento): self
    {
        $this->documento = $documento;

        return $this;
    }

    /**
     * @return Processo|null
     */
    public function getProcesso(): ?Processo
    {
        return $this->processo;
    }

    /**
     * @param Processo|null $processo
     *
     * @return VinculacaoEtiqueta
     */
    public function setProcesso(?Processo $processo): self
    {
        $this->processo = $processo;

        return $this;
    }

    /**
     * @return Relatorio|null
     */
    public function getRelatorio(): ?Relatorio
    {
        return $this->relatorio;
    }

    /**
     * @param Relatorio|null $relatorio
     *
     * @return VinculacaoEtiqueta
     */
    public function setRelatorio(?Relatorio $relatorio): self
    {
        $this->relatorio = $relatorio;

        return $this;
    }

    /**
     * @return DocumentoAvulso|null
     */
    public function getDocumentoAvulso(): ?DocumentoAvulso
    {
        return $this->documentoAvulso;
    }

    /**
     * @param DocumentoAvulso|null $documentoAvulso
     *
     * @return self
     */
    public function setDocumentoAvulso(?DocumentoAvulso $documentoAvulso): self
    {
        $this->documentoAvulso = $documentoAvulso;

        return $this;
    }
}
