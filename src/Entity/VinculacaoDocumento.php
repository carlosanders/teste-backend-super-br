<?php

declare(strict_types=1);
/**
 * /src/Entity/VinculacaoDocumento.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Entity;

use Doctrine\ORM\Mapping as ORM;
use Exception;
use Gedmo\Mapping\Annotation as Gedmo;
use SuppCore\AdministrativoBackend\Entity\Traits\Blameable;
use SuppCore\AdministrativoBackend\Entity\Traits\Id;
use SuppCore\AdministrativoBackend\Entity\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\Entity\Traits\Timestampable;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use SuppCore\AdministrativoBackend\Entity\Traits\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class VinculacaoDocumento.
 *
 *  @ORM\Table(
 *     name="ad_vinc_documento",
 *     uniqueConstraints={
 *          @ORM\UniqueConstraint(columns={"documento_vinculado_id", "apagado_em"})
 *     }
 * )
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @UniqueEntity(
 *     fields = {"documentoVinculado", "apagadoEm"},
 *     message = "Documento já se encontra vinculado a outro!"
 * )
 *
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class VinculacaoDocumento implements EntityInterface
{
    // Traits
    use Blameable;
    use Timestampable;
    use Softdeleteable;
    use Id;
    use Uuid;

    /**
     * Constructor.
     *
     * @throws Exception
     */
    public function __construct()
    {
        $this->setUuid();
    }

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(
     *     targetEntity="Documento",
     *     inversedBy="vinculacoesDocumentos"
     * )
     * @ORM\JoinColumn(
     *     name="documento_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected Documento $documento;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(
     *     targetEntity="Documento",
     *     inversedBy="vinculacaoDocumentoPrincipal"
     * )
     * @ORM\JoinColumn(
     *     name="documento_vinculado_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected Documento $documentoVinculado;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(
     *     targetEntity="ModalidadeVinculacaoDocumento"
     * )
     * @ORM\JoinColumn(
     *     name="mod_vinc_documento_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected ModalidadeVinculacaoDocumento $modalidadeVinculacaoDocumento;

    /**
     * @return Documento
     */
    public function getDocumento(): Documento
    {
        return $this->documento;
    }

    /**
     * @param Documento $documento
     *
     * @return VinculacaoDocumento
     */
    public function setDocumento(Documento $documento): self
    {
        $this->documento = $documento;

        return $this;
    }

    /**
     * @return Documento
     */
    public function getDocumentoVinculado(): Documento
    {
        return $this->documentoVinculado;
    }

    /**
     * @param Documento $documentoVinculado
     *
     * @return VinculacaoDocumento
     */
    public function setDocumentoVinculado(Documento $documentoVinculado): self
    {
        $this->documentoVinculado = $documentoVinculado;

        return $this;
    }

    /**
     * @return ModalidadeVinculacaoDocumento
     */
    public function getModalidadeVinculacaoDocumento(): ModalidadeVinculacaoDocumento
    {
        return $this->modalidadeVinculacaoDocumento;
    }

    /**
     * @param ModalidadeVinculacaoDocumento $modalidadeVinculacaoDocumento
     *
     * @return VinculacaoDocumento
     */
    public function setModalidadeVinculacaoDocumento(
        ModalidadeVinculacaoDocumento $modalidadeVinculacaoDocumento
    ): self {
        $this->modalidadeVinculacaoDocumento = $modalidadeVinculacaoDocumento;

        return $this;
    }
}
