<?php

declare(strict_types=1);
/**
 * /src/Entity/StatusBarramento.php.
 *
 */

namespace SuppCore\AdministrativoBackend\Entity;

use Doctrine\ORM\Mapping as ORM;
use Exception;
use Gedmo\Mapping\Annotation as Gedmo;
use Ramsey\Uuid\Uuid;
use SuppCore\AdministrativoBackend\Entity\DocumentoAvulso;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\Processo;
use SuppCore\AdministrativoBackend\Entity\Traits\Blameable;
use SuppCore\AdministrativoBackend\Entity\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\Entity\Traits\Timestampable;
use SuppCore\AdministrativoBackend\Entity\Tramitacao;

/**
 * Class StatusBarramento.
 *
 * @ORM\Table(
 *     name="br_status_barramento"
 * )
 * @ORM\Entity()
 *
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 *
 */
class StatusBarramento implements EntityInterface
{
    // Traits
    use Blameable;
    use Timestampable;
    use Softdeleteable;

    /**
     * @ORM\Column(
     *     name="id",
     *     type="integer",
     *     nullable=false
     * )
     * @ORM\Id()
     * @ORM\GeneratedValue("AUTO")
     */
    protected ?int $id = null;

    /**
     * @ORM\Column(
     *     name="uuid",
     *     type="guid",
     *     nullable=false
     * )
     */
    protected string $uuid;

    /**
     * @ORM\Column(
     *     name="idt_componente_digital",
     *     type="integer",
     *     nullable=true
     * )
     */
    protected ?int $idtComponenteDigital = null;

    /**
     * @ORM\Column(
     *     name="idt",
     *     type="integer",
     *     nullable=false
     * )
     */
    protected int $idt;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="SuppCore\AdministrativoBackend\Entity\Processo"
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
     *     targetEntity="SuppCore\AdministrativoBackend\Entity\DocumentoAvulso"
     * )
     * @ORM\JoinColumn(
     *     name="documento_avulso_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?DocumentoAvulso $documentoAvulso = null;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="SuppCore\AdministrativoBackend\Entity\Tramitacao"
     * )
     * @ORM\JoinColumn(
     *     name="tramitacao_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?Tramitacao $tramitacao = null;

    /**
     * @var int
     *
     * @ORM\Column(
     *     type="integer",
     *     length=1,
     *     nullable=false
     * )
     */
    protected ?int $codSituacaoTramitacao = null;

    /**
     * @var int
     *
     * @ORM\Column(
     *     name="codigo_erro",
     *     type="integer",
     *     nullable=true
     * )
     */
    protected ?int $codigoErro = null;

    /**
     * @var string
     *
     * @ORM\Column(
     *     name="mensagem_erro",
     *     type="string",
     *     nullable=true
     * )
     */
    protected ?string $mensagemErro = null;

    /**
     * StatusBarramento constructor.
     *
     * @throws Exception
     */
    public function __construct()
    {
        $this->uuid = Uuid::uuid4()->toString();
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $idt
     *
     * @return self
     */
    public function setIdt(int $idt): self
    {
        $this->idt = $idt;

        return $this;
    }

    /**
     * @return int
     */
    public function getIdt(): ?int
    {
        return $this->idt;
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @return Tramitacao|null
     */
    public function getTramitacao(): ?Tramitacao
    {
        return $this->tramitacao;
    }

    /**
     * @param Tramitacao|null $tramitacao
     * @return StatusBarramento
     */
    public function setTramitacao(?Tramitacao $tramitacao): StatusBarramento
    {
        $this->tramitacao = $tramitacao;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getIdtComponenteDigital(): ?int
    {
        return $this->idtComponenteDigital;
    }

    /**
     * @param int|null $idtComponenteDigital
     * @return StatusBarramento
     */
    public function setIdtComponenteDigital(?int $idtComponenteDigital): StatusBarramento
    {
        $this->idtComponenteDigital = $idtComponenteDigital;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCodSituacaoTramitacao(): ?int
    {
        return $this->codSituacaoTramitacao;
    }

    /**
     * @param int $codSituacaoTramitacao
     * @return StatusBarramento
     */
    public function setCodSituacaoTramitacao(int $codSituacaoTramitacao): StatusBarramento
    {
        $this->codSituacaoTramitacao = $codSituacaoTramitacao;

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
     * @return StatusBarramento
     */
    public function setDocumentoAvulso(?DocumentoAvulso $documentoAvulso): StatusBarramento
    {
        $this->documentoAvulso = $documentoAvulso;

        return $this;
    }


    /**
     * @return Processo
     */
    public function getProcesso(): ?Processo
    {
        return $this->processo;
    }

    /**
     * @param Processo $processo
     *
     * @return StatusBarramento
     */
    public function setProcesso(?Processo $processo): StatusBarramento
    {
        $this->processo = $processo;

        return $this;
    }

    /**
     * @return int
     */
    public function getCodigoErro(): ?int
    {
        return $this->codigoErro;
    }

    /**
     * @param int $codigoErro
     */
    public function setCodigoErro(?int $codigoErro): void
    {
        $this->codigoErro = $codigoErro;
    }

    /**
     * @return string
     */
    public function getMensagemErro(): ?string
    {
        return $this->mensagemErro;
    }

    /**
     * @param string $mensagemErro
     */
    public function setMensagemErro(?string $mensagemErro): void
    {
        $this->mensagemErro = $mensagemErro;
    }



}
