<?php

declare(strict_types=1);
/**
 * /src/Entity/Documento.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Gedmo\Mapping\Annotation as Gedmo;
use SuppCore\AdministrativoBackend\Entity\Traits\Blameable;
use SuppCore\AdministrativoBackend\Entity\Traits\Id;
use SuppCore\AdministrativoBackend\Entity\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\Entity\Traits\Timestampable;
use SuppCore\AdministrativoBackend\Entity\Traits\Uuid;

/**
 * Class Dossie.
 *
 *  @ORM\Table(
 *     name="ad_dossie",
 * )
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 * @Gedmo\Loggable
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Dossie implements EntityInterface
{
    use Timestampable;
    use Blameable;
    use Softdeleteable;
    use Uuid;
    use Id;

    public const EM_SINCRONIZACAO = 0;
    public const SUCESSO = 1;
    public const ERRO = 2;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="SuppCore\AdministrativoBackend\Entity\TipoDossie"
     * )
     * @ORM\JoinColumn(
     *     name="tipo_dossie_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected TipoDossie $tipoDossie;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="SuppCore\AdministrativoBackend\Entity\Pessoa",
     *     inversedBy="dossies"
     * )
     * @ORM\JoinColumn(
     *     name="pessoa_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected Pessoa $pessoa;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="SuppCore\AdministrativoBackend\Entity\OrigemDados"
     * )
     * @ORM\JoinColumn(
     *     name="origem_dados_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected OrigemDados $origemDados;

    /**
     * @ORM\Column(
     *     type="string",
     *     name="numero_documento_principal",
     *     nullable=false
     * )
     */
    protected string $numeroDocumentoPrincipal;

    /**
     * @ORM\Column(
     *     type="json",
     *     name="conteudo",
     *     nullable=true
     * )
     */
    protected mixed $conteudo = null;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="SuppCore\AdministrativoBackend\Entity\Documento"
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
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(
     *     name="data_consulta",
     *     type="datetime",
     *     nullable=true
     * )
     */
    protected ?DateTime $dataConsulta = null;

    /**
     * @ORM\Column(
     *     type="string",
     *     name="protocolo_requerimento",
     *     nullable=true
     * )
     */
    protected ?string $protocoloRequerimento = null;

    /**
     * @ORM\Column(
     *     type="string",
     *     name="status_requerimento",
     *     nullable=true
     * )
     */
    protected ?string $statusRequerimento = null;

    /**
     * @ORM\Column(
     *     type="string",
     *     name="fonte_dados",
     *     nullable=true
     * )
     */
    protected ?string $fonteDados = null;

    /**
     * @ORM\Column(
     *     type="integer",
     *     name="versao",
     *     nullable=true
     * )
     */
    protected ?int $versao = null;

    /**
     * Dossie constructor.
     *
     * @throws Exception
     */
    public function __construct()
    {
        $this->setUuid();
    }

    /**
     * @return TipoDossie
     */
    public function getTipoDossie(): TipoDossie
    {
        return $this->tipoDossie;
    }

    /**
     * @param TipoDossie $tipoDossie
     * @return self
     */
    public function setTipoDossie(TipoDossie $tipoDossie): self
    {
        $this->tipoDossie = $tipoDossie;

        return $this;
    }

    /**
     * @return Pessoa
     */
    public function getPessoa(): Pessoa
    {
        return $this->pessoa;
    }

    /**
     * @param Pessoa $pessoa
     * @return self
     */
    public function setPessoa(Pessoa $pessoa): self
    {
        $this->pessoa = $pessoa;

        return $this;
    }

    /**
     * @return OrigemDados
     */
    public function getOrigemDados(): OrigemDados
    {
        return $this->origemDados;
    }

    /**
     * @param OrigemDados $origemDados
     * @return self
     */
    public function setOrigemDados(OrigemDados $origemDados): self
    {
        $this->origemDados = $origemDados;

        return $this;
    }

    /**
     * @return string
     */
    public function getNumeroDocumentoPrincipal(): string
    {
        return $this->numeroDocumentoPrincipal;
    }

    /**
     * @param string $numeroDocumentoPrincipal
     * @return self
     */
    public function setNumeroDocumentoPrincipal(string $numeroDocumentoPrincipal): self
    {
        $this->numeroDocumentoPrincipal = $numeroDocumentoPrincipal;

        return $this;
    }

    /**
     * @return mixed|null
     */
    public function getConteudo(): mixed
    {
        return $this->conteudo;
    }

    /**
     * @param mixed|null $conteudo
     * @return self
     */
    public function setConteudo(mixed $conteudo): self
    {
        $this->conteudo = $conteudo;

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
     * @return self
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
     * @return self
     */
    public function setProcesso(?Processo $processo): self
    {
        $this->processo = $processo;

        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getDataConsulta(): ?DateTime
    {
        return $this->dataConsulta;
    }

    /**
     * @param DateTime|null $dataConsulta
     * @return self
     */
    public function setDataConsulta(?DateTime $dataConsulta): self
    {
        $this->dataConsulta = $dataConsulta;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getProtocoloRequerimento(): ?string
    {
        return $this->protocoloRequerimento;
    }

    /**
     * @param string|null $protocoloRequerimento
     * @return self
     */
    public function setProtocoloRequerimento(?string $protocoloRequerimento): self
    {
        $this->protocoloRequerimento = $protocoloRequerimento;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getStatusRequerimento(): ?string
    {
        return $this->statusRequerimento;
    }

    /**
     * @param string|null $statusRequerimento
     * @return self
     */
    public function setStatusRequerimento(?string $statusRequerimento): self
    {
        $this->statusRequerimento = $statusRequerimento;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFonteDados(): ?string
    {
        return $this->fonteDados;
    }

    /**
     * @param string|null $fonteDados
     * @return self
     */
    public function setFonteDados(?string $fonteDados): self
    {
        $this->fonteDados = $fonteDados;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getVersao(): ?int
    {
        return $this->versao;
    }

    /**
     * @param int|null $versao
     * @return self
     */
    public function setVersao(?int $versao): self
    {
        $this->versao = $versao;

        return $this;
    }
}
