<?php

declare(strict_types=1);
/**
 * /src/Entity/Documento.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Entity;

use DateTime;
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
 * Class Documento.
 *
 *  @ORM\Table(
 *     name="ad_documento",
 * )
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 * @Gedmo\Loggable
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Documento implements EntityInterface
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
        $this->areasTrabalhos = new ArrayCollection();
        $this->componentesDigitais = new ArrayCollection();
        $this->juntadas = new ArrayCollection();
        $this->sigilos = new ArrayCollection();
        $this->vinculacoesDocumentos = new ArrayCollection();
        $this->vinculacaoDocumentoPrincipal = new ArrayCollection();
        $this->vinculacoesEtiquetas = new ArrayCollection();
    }

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     * @Gedmo\Versioned
     * @ORM\Column(
     *     type="integer",
     *     nullable=false
     * )
     */
    protected int $numeroFolhas = 0;

    /**
     * @Gedmo\Versioned
     * @ORM\Column(
     *     type="datetime",
     *     name="data_hora_producao", nullable=true
     *     )
     */
    protected ?DateTime $dataHoraProducao = null;

    /**
     * @Assert\Length(
     *     max = 255,
     *     maxMessage = "Campo deve ter no máximo {{ limit }} letras ou números"
     * )
     *
     * @Gedmo\Versioned
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Filter\ToUpper(encoding="UTF-8")
     * @ORM\Column(
     *     name="outro_numero",
     *     type="string",
     *     nullable=true
     * )
     */
    protected ?string $outroNumero = null;

    /**
     * @Gedmo\Versioned
     * @ORM\Column(
     *     type="boolean",
     *     name="sem_efeito", nullable=false
     *     )
     */
    protected bool $semEfeito = false;

    /**
     * @Assert\Length(
     *     max = 255,
     *     maxMessage = "Campo deve ter no máximo {{ limit }} letras ou números"
     * )
     *
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Filter\ToUpper(encoding="UTF-8")
     *
     * @Gedmo\Versioned
     * @ORM\Column(
     *     type="string",
     *     name="localizador_original",
     *     nullable=true
     * )
     */
    protected ?string $localizadorOriginal = null;

    /**
     * @Assert\Length(
     *     max = 255,
     *     maxMessage = "Campo deve ter no máximo {{ limit }} letras ou números"
     * )
     *
     * @Gedmo\Versioned
     *
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Filter\ToUpper(encoding="UTF-8")
     * @ORM\Column(
     *     type="string",
     *     name="local_producao",
     *     nullable=true
     * )
     */
    protected ?string $localProducao = null;

    /**
     * @Assert\Length(
     *     max = 255,
     *     maxMessage = "Campo deve ter no máximo {{ limit }} letras ou números"
     * )
     *
     * @Gedmo\Versioned
     *
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Filter\ToUpper(encoding="UTF-8")
     * @ORM\Column(
     *     type="string",
     *     name="autor",
     *     nullable=true
     * )
     */
    protected ?string $autor = null;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="Processo"
     * )
     * @ORM\JoinColumn(
     *     name="processo_origem_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?Processo $processoOrigem = null;

    /**
     * @Assert\Length(
     *     max = 255,
     *     maxMessage = "Campo deve ter no máximo {{ limit }} letras ou números"
     * )
     *
     * @Gedmo\Versioned
     *
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Filter\ToUpper(encoding="UTF-8")
     * @ORM\Column(
     *     type="string",
     *     name="redator",
     *     nullable=true
     * )
     */
    protected ?string $redator = null;

    /**
     * @Assert\Length(
     *     max = 255,
     *     maxMessage = "Campo deve ter no máximo {{ limit }} letras ou números"
     * )
     *
     * @Gedmo\Versioned
     *
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Filter\ToUpper(encoding="UTF-8")
     * @ORM\Column(
     *     type="string",
     *     name="destinatario",
     *     nullable=true
     * )
     */
    protected ?string $destinatario = null;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="Pessoa"
     * )
     *
     * @Gedmo\Versioned
     *
     * @ORM\JoinColumn(
     *     name="pessoa_procedencia_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?Pessoa $procedencia = null;

    /**
     * @ORM\OneToOne(
     *     targetEntity="NumeroUnicoDocumento",
     *     inversedBy="documento"
     * )
     * @ORM\JoinColumn(
     *     name="numero_unico_documento_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?NumeroUnicoDocumento $numeroUnicoDocumento = null;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @Gedmo\Versioned
     *
     * @ORM\ManyToOne(
     *     targetEntity="TipoDocumento"
     * )
     * @ORM\JoinColumn(
     *     name="tipo_documento_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected TipoDocumento $tipoDocumento;

    /**
     * @Assert\Length(
     *     max = 255,
     *     maxMessage = "Campo deve ter no máximo {{ limit }} letras ou números"
     * )
     *
     * @Gedmo\Versioned
     *
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Filter\ToUpper(encoding="UTF-8")
     * @ORM\Column(
     *     type="string",
     *     name="descricao_outros",
     *     nullable=true
     * )
     */
    protected ?string $descricaoOutros = null;

    /**
     * @Assert\Length(
     *     max = 255,
     *     maxMessage = "Campo deve ter no máximo {{ limit }} letras ou números"
     * )
     *
     * @Gedmo\Versioned
     *
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Filter\ToUpper(encoding="UTF-8")
     * @ORM\Column(
     *     name="observacao",
     *     type="string",
     *     nullable=true
     * )
     */
    protected ?string $observacao = null;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @Gedmo\Versioned
     * @ORM\Column(
     *     type="boolean",
     *     nullable=false
     * )
     */
    protected bool $copia = false;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="Setor"
     * )
     * @ORM\JoinColumn(
     *     name="setor_origem_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?Setor $setorOrigem = null;

    /**
     * @Gedmo\Versioned
     *
     * @ORM\ManyToOne(
     *     targetEntity="Tarefa",
     *     inversedBy="minutas"
     * )
     * @ORM\JoinColumn(
     *     name="tarefa_origem_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?Tarefa $tarefaOrigem = null;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="Documento"
     * )
     * @ORM\JoinColumn(
     *     name="documento_origem_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?Documento $documentoOrigem = null;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="OrigemDados",
     *     cascade={"persist"}
     * )
     * @ORM\JoinColumn(
     *     name="origem_dados_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?OrigemDados $origemDados = null;

    /**
     * @ORM\OneToOne(
     *     targetEntity="DocumentoAvulso",
     *     mappedBy="documentoRemessa"
     * )
     */
    protected ?DocumentoAvulso $documentoAvulsoRemessa = null;

    /**
     * @ORM\OneToOne(
     *     targetEntity="DocumentoAvulso",
     *     mappedBy="documentoResposta"
     * )
     */
    protected ?DocumentoAvulso $documentoAvulsoResposta = null;

    /**
     * @ORM\OneToOne(
     *     targetEntity="Modelo",
     *     mappedBy="documento"
     * )
     */
    protected ?Modelo $modelo = null;

    /**
     * @ORM\OneToOne(
     *     targetEntity="Template",
     *     mappedBy="documento"
     * )
     */
    protected ?Template $template = null;

    /**
     * @ORM\OneToOne(
     *     targetEntity="Repositorio",
     *     mappedBy="documento"
     * )
     */
    protected ?Repositorio $repositorio = null;

    /**
     * @Gedmo\Versioned
     *
     * @ORM\OneToOne(
     *     targetEntity="Juntada",
     *     inversedBy="documentoJuntadaAtual"
     * )
     * @ORM\JoinColumn(
     *     name="juntada_atual_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?Juntada $juntadaAtual = null;

    /**
     * @var Collection|ArrayCollection|ArrayCollection<Juntada>
     *
     * @ORM\OneToMany(
     *     targetEntity="Juntada",
     *     mappedBy="documento"
     * )
     */
    protected $juntadas;

    /**
     * @var Collection|ArrayCollection|ArrayCollection<Sigilo>
     *
     * @ORM\OneToMany(
     *     targetEntity="Sigilo",
     *     mappedBy="documento",
     *     cascade={"all"}
     * )
     */
    protected $sigilos;

    /**
     * @var Collection|ArrayCollection|ArrayCollection<AreaTrabalho>
     *
     * @ORM\OneToMany(
     *     targetEntity="AreaTrabalho",
     *     mappedBy="documento"
     * )
     */
    protected $areasTrabalhos;

    /**
     * @var Collection|ArrayCollection|ArrayCollection<VinculacaoDocumento>
     *
     * @ORM\OneToMany(
     *     targetEntity="VinculacaoDocumento",
     *     mappedBy="documento",
     *     cascade={"all"}
     * )
     * @ORM\OrderBy(
     *     {"criadoEm" = "ASC", "id" = "ASC"}
     * )
     */
    protected $vinculacoesDocumentos;

    /**
     * @ORM\OneToOne(
     *     targetEntity="Relatorio",
     *     mappedBy="documento"
     * )
     */
    protected ?Relatorio $relatorio = null;

    /**
     * @ORM\OneToMany(
     *     targetEntity="VinculacaoDocumento",
     *     mappedBy="documentoVinculado"
     * )
     */
    protected $vinculacaoDocumentoPrincipal;

    /**
     * @var Collection|ArrayCollection|ArrayCollection<ComponenteDigital>
     *
     * @ORM\OneToMany(
     *     targetEntity="ComponenteDigital",
     *     mappedBy="documento",
     *     cascade={"all"}
     * )
     * @ORM\OrderBy(
     *     {"numeracaoSequencial" = "ASC"}
     * )
     */
    protected $componentesDigitais;

    /**
     * @var Collection|ArrayCollection|ArrayCollection<VinculacaoEtiqueta>
     *
     * @ORM\OneToMany(
     *     targetEntity="VinculacaoEtiqueta",
     *     mappedBy="documento"
     * )
     */
    protected $vinculacoesEtiquetas;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="DocumentoAvulso"
     * )
     * @ORM\JoinColumn(
     *     name="doc_avulso_compl_resposta_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?DocumentoAvulso $documentoAvulsoComplementacaoResposta = null;

    /**
     * @ORM\Column(
     *     type="datetime",
     *     name="data_hora_validade", nullable=true
     *     )
     */
    protected ?DateTime $dataHoraValidade = null;

    /**
     * @Assert\Length(
     *     max = 255,
     *     maxMessage = "O campo deve ter no máximo 255 caracteres!"
     * )
     *
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Filter\ToUpper(encoding="UTF-8")
     * @ORM\Column(
     *     type="string",
     *     name="chave_acesso",
     *     nullable=true
     * )
     */
    protected ?string $chaveAcesso = null;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="ModalidadeCopia"
     * )
     *
     * @Gedmo\Versioned
     *
     * @ORM\JoinColumn(
     *     name="mod_copia_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?ModalidadeCopia $modalidadeCopia = null;

    /**
     * @Assert\Length(
     *     max = 255,
     *     maxMessage = "O campo deve ter no máximo 255 caracteres!"
     * )
     *
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Filter\ToUpper(encoding="UTF-8")
     * @ORM\Column(
     *     type="string",
     *     name="dependencia_software",
     *     nullable=true
     * )
     */
    protected ?string $dependenciaSoftware = null;

    /**
     * @Assert\Length(
     *     max = 255,
     *     maxMessage = "O campo deve ter no máximo 255 caracteres!"
     * )
     *
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Filter\ToUpper(encoding="UTF-8")
     * @ORM\Column(
     *     type="string",
     *     name="dependencia_hardware",
     *     nullable=true
     * )
     */
    protected ?string $dependenciaHardware = null;

    /**
     * @var bool|null
     *
     * Propriedade para que o ACL inicial do documento seja restrito caso necessário
     */
    protected ?bool $acessoRestrito = false;

    /**
     * @return int
     */
    public function getNumeroFolhas(): int
    {
        return $this->numeroFolhas;
    }

    /**
     * @param int $numeroFolhas
     *
     * @return Documento
     */
    public function setNumeroFolhas(int $numeroFolhas): self
    {
        $this->numeroFolhas = $numeroFolhas;

        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getDataHoraProducao(): ?DateTime
    {
        return $this->dataHoraProducao;
    }

    /**
     * @param DateTime|null $dataHoraProducao
     *
     * @return Documento
     */
    public function setDataHoraProducao(?DateTime $dataHoraProducao): self
    {
        $this->dataHoraProducao = $dataHoraProducao;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getOutroNumero(): ?string
    {
        return $this->outroNumero;
    }

    /**
     * @param string|null $outroNumero
     *
     * @return Documento
     */
    public function setOutroNumero(?string $outroNumero): self
    {
        $this->outroNumero = $outroNumero;

        return $this;
    }

    /**
     * @return bool
     */
    public function getSemEfeito(): bool
    {
        return $this->semEfeito;
    }

    /**
     * @param bool $semEfeito
     *
     * @return Documento
     */
    public function setSemEfeito(bool $semEfeito): self
    {
        $this->semEfeito = $semEfeito;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLocalizadorOriginal(): ?string
    {
        return $this->localizadorOriginal;
    }

    /**
     * @param string|null $localizadorOriginal
     *
     * @return Documento
     */
    public function setLocalizadorOriginal(?string $localizadorOriginal): self
    {
        $this->localizadorOriginal = $localizadorOriginal;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLocalProducao(): ?string
    {
        return $this->localProducao;
    }

    /**
     * @param string|null $localProducao
     *
     * @return Documento
     */
    public function setLocalProducao(?string $localProducao): self
    {
        $this->localProducao = $localProducao;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAutor(): ?string
    {
        return $this->autor;
    }

    /**
     * @param string|null $autor
     *
     * @return Documento
     */
    public function setAutor(?string $autor): self
    {
        $this->autor = $autor;

        return $this;
    }

    /**
     * @return Processo|null
     */
    public function getProcessoOrigem(): ?Processo
    {
        return $this->processoOrigem;
    }

    /**
     * @param Processo|null $processoOrigem
     *
     * @return Documento
     */
    public function setProcessoOrigem(?Processo $processoOrigem): self
    {
        $this->processoOrigem = $processoOrigem;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getRedator(): ?string
    {
        return $this->redator;
    }

    /**
     * @param string|null $redator
     *
     * @return Documento
     */
    public function setRedator(?string $redator): self
    {
        $this->redator = $redator;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDestinatario(): ?string
    {
        return $this->destinatario;
    }

    /**
     * @param string|null $destinatario
     *
     * @return Documento
     */
    public function setDestinatario(?string $destinatario): self
    {
        $this->destinatario = $destinatario;

        return $this;
    }

    /**
     * @return Pessoa|null
     */
    public function getProcedencia(): ?Pessoa
    {
        return $this->procedencia;
    }

    /**
     * @param Pessoa|null $procedencia
     *
     * @return Documento
     */
    public function setProcedencia(?Pessoa $procedencia): self
    {
        $this->procedencia = $procedencia;

        return $this;
    }

    /**
     * @return TipoDocumento
     */
    public function getTipoDocumento(): TipoDocumento
    {
        return $this->tipoDocumento;
    }

    /**
     * @param TipoDocumento $tipoDocumento
     *
     * @return Documento
     */
    public function setTipoDocumento(TipoDocumento $tipoDocumento): self
    {
        $this->tipoDocumento = $tipoDocumento;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescricaoOutros(): ?string
    {
        return $this->descricaoOutros;
    }

    /**
     * @param string|null $descricaoOutros
     *
     * @return Documento
     */
    public function setDescricaoOutros(?string $descricaoOutros): self
    {
        $this->descricaoOutros = $descricaoOutros;

        return $this;
    }

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
     * @return Documento
     */
    public function setObservacao(?string $observacao): self
    {
        $this->observacao = $observacao;

        return $this;
    }

    /**
     * @return bool
     */
    public function getCopia(): bool
    {
        return $this->copia;
    }

    /**
     * @param bool $copia
     *
     * @return Documento
     */
    public function setCopia(bool $copia): self
    {
        $this->copia = $copia;

        return $this;
    }

    /**
     * @return Setor|null
     */
    public function getSetorOrigem(): ?Setor
    {
        return $this->setorOrigem;
    }

    /**
     * @param Setor|null $setorOrigem
     *
     * @return Documento
     */
    public function setSetorOrigem(?Setor $setorOrigem): self
    {
        $this->setorOrigem = $setorOrigem;

        return $this;
    }

    /**
     * @return Tarefa|null
     */
    public function getTarefaOrigem(): ?Tarefa
    {
        return $this->tarefaOrigem;
    }

    /**
     * @param Tarefa|null $tarefaOrigem
     *
     * @return Documento
     */
    public function setTarefaOrigem(?Tarefa $tarefaOrigem): self
    {
        $this->tarefaOrigem = $tarefaOrigem;

        return $this;
    }

    /**
     * @return Documento|null
     */
    public function getDocumentoOrigem(): ?Documento
    {
        return $this->documentoOrigem;
    }

    /**
     * @param Documento|null $documentoOrigem
     *
     * @return Documento
     */
    public function setDocumentoOrigem(?Documento $documentoOrigem): self
    {
        $this->documentoOrigem = $documentoOrigem;

        return $this;
    }

    /**
     * @return Juntada|null
     */
    public function getJuntadaAtual(): ?Juntada
    {
        return $this->juntadaAtual;
    }

    /**
     * @param Juntada|null $juntadaAtual
     *
     * @return Documento
     */
    public function setJuntadaAtual(?Juntada $juntadaAtual): self
    {
        $this->juntadaAtual = $juntadaAtual;

        return $this;
    }

    /**
     * @return NumeroUnicoDocumento|null
     */
    public function getNumeroUnicoDocumento(): ?NumeroUnicoDocumento
    {
        return $this->numeroUnicoDocumento;
    }

    /**
     * @param NumeroUnicoDocumento|null $numeroUnicoDocumento
     *
     * @return Documento
     */
    public function setNumeroUnicoDocumento(?NumeroUnicoDocumento $numeroUnicoDocumento): self
    {
        $this->numeroUnicoDocumento = $numeroUnicoDocumento;

        return $this;
    }

    /**
     * @return OrigemDados|null
     */
    public function getOrigemDados(): ?OrigemDados
    {
        return $this->origemDados;
    }

    /**
     * @param OrigemDados|null $origemDados
     *
     * @return Documento
     */
    public function setOrigemDados(?OrigemDados $origemDados): self
    {
        $this->origemDados = $origemDados;

        return $this;
    }

    /**
     * @return DocumentoAvulso|null
     */
    public function getDocumentoAvulsoRemessa(): ?DocumentoAvulso
    {
        return $this->documentoAvulsoRemessa;
    }

    /**
     * @param DocumentoAvulso|null $documentoAvulsoRemessa
     *
     * @return Documento
     */
    public function setDocumentoAvulsoRemessa(?DocumentoAvulso $documentoAvulsoRemessa): self
    {
        $this->documentoAvulsoRemessa = $documentoAvulsoRemessa;

        return $this;
    }

    /**
     * @return Modelo|null
     */
    public function getModelo(): ?Modelo
    {
        return $this->modelo;
    }

    /**
     * @param Modelo|null $modelo
     *
     * @return Documento
     */
    public function setModelo(?Modelo $modelo): self
    {
        $this->modelo = $modelo;

        return $this;
    }

    /**
     * @return Template|null
     */
    public function getTemplate(): ?Template
    {
        return $this->template;
    }

    /**
     * @param Template|null $template
     *
     * @return Documento
     */
    public function setTemplate(?Template $template): self
    {
        $this->template = $template;

        return $this;
    }

    /**
     * @return Repositorio|null
     */
    public function getRepositorio(): ?Repositorio
    {
        return $this->repositorio;
    }

    /**
     * @param Repositorio|null $repositorio
     *
     * @return Documento
     */
    public function setRepositorio(?Repositorio $repositorio): self
    {
        $this->repositorio = $repositorio;

        return $this;
    }

    /**
     * @return DocumentoAvulso|null
     */
    public function getDocumentoAvulsoResposta(): ?DocumentoAvulso
    {
        return $this->documentoAvulsoResposta;
    }

    /**
     * @param DocumentoAvulso|null $documentoAvulsoResposta
     *
     * @return Documento
     */
    public function setDocumentoAvulsoResposta(?DocumentoAvulso $documentoAvulsoResposta): self
    {
        $this->documentoAvulsoResposta = $documentoAvulsoResposta;

        return $this;
    }

    /**
     * @param AreaTrabalho $areaTrabalho
     *
     * @return Documento
     */
    public function addAreaTrabalho(AreaTrabalho $areaTrabalho): self
    {
        if (!$this->areasTrabalhos->contains($areaTrabalho)) {
            $this->areasTrabalhos[] = $areaTrabalho;
            $areaTrabalho->setDocumento($this);
        }

        return $this;
    }

    /**
     * @param AreaTrabalho $areaTrabalho
     *
     * @return Documento
     */
    public function removeAreaTrabalho(AreaTrabalho $areaTrabalho): self
    {
        if ($this->areasTrabalhos->contains($areaTrabalho)) {
            $this->areasTrabalhos->removeElement($areaTrabalho);
        }

        return $this;
    }

    /**
     * @return Collection|ArrayCollection|ArrayCollection<AreaTrabalho>
     */
    public function getAreasTrabalhos(): Collection
    {
        return $this->areasTrabalhos;
    }

    /**
     * @param ComponenteDigital $componenteDigital
     *
     * @return Documento
     */
    public function addComponenteDigital(ComponenteDigital $componenteDigital): self
    {
        if (!$this->componentesDigitais->contains($componenteDigital)) {
            $this->componentesDigitais[] = $componenteDigital;
            $componenteDigital->setDocumento($this);
        }

        return $this;
    }

    /**
     * @param ComponenteDigital $componenteDigital
     *
     * @return Documento
     */
    public function removeComponenteDigital(ComponenteDigital $componenteDigital): self
    {
        if ($this->componentesDigitais->contains($componenteDigital)) {
            $this->componentesDigitais->removeElement($componenteDigital);
        }

        return $this;
    }

    /**
     * @return Collection|ArrayCollection|ArrayCollection<ComponenteDigital>
     */
    public function getComponentesDigitais(): Collection
    {
        return $this->componentesDigitais;
    }

    /**
     * @param Juntada $juntada
     *
     * @return Documento
     */
    public function addJuntada(Juntada $juntada): self
    {
        if (!$this->juntadas->contains($juntada)) {
            $this->juntadas[] = $juntada;
            $juntada->setDocumento($this);
        }

        return $this;
    }

    /**
     * @param Juntada $juntada
     *
     * @return Documento
     */
    public function removeJuntada(Juntada $juntada): self
    {
        if ($this->juntadas->contains($juntada)) {
            $this->juntadas->removeElement($juntada);
        }

        return $this;
    }

    /**
     * @return Collection|ArrayCollection|ArrayCollection<Juntada>
     */
    public function getJuntadas(): Collection
    {
        return $this->juntadas;
    }

    /**
     * @param Sigilo $sigilo
     *
     * @return Documento
     */
    public function addSigilo(Sigilo $sigilo): self
    {
        if (!$this->sigilos->contains($sigilo)) {
            $this->sigilos[] = $sigilo;
            $sigilo->setDocumento($this);
        }

        return $this;
    }

    /**
     * @param Sigilo $sigilo
     *
     * @return Documento
     */
    public function removeSigilo(Sigilo $sigilo): self
    {
        if ($this->sigilos->contains($sigilo)) {
            $this->sigilos->removeElement($sigilo);
        }

        return $this;
    }

    /**
     * @return Collection|ArrayCollection|ArrayCollection<Sigilo>
     */
    public function getSigilos(): Collection
    {
        return $this->sigilos;
    }

    /**
     * @param VinculacaoDocumento $vinculacaoDocumento
     *
     * @return Documento
     */
    public function addVinculacaoDocumento(VinculacaoDocumento $vinculacaoDocumento): self
    {
        if (!$this->vinculacoesDocumentos->contains($vinculacaoDocumento)) {
            $this->vinculacoesDocumentos[] = $vinculacaoDocumento;
            $vinculacaoDocumento->setDocumento($this);
        }

        return $this;
    }

    /**
     * @param VinculacaoDocumento $vinculacaoDocumento
     *
     * @return Documento
     */
    public function removeVinculacaoDocumento(VinculacaoDocumento $vinculacaoDocumento): self
    {
        if ($this->vinculacoesDocumentos->contains($vinculacaoDocumento)) {
            $this->vinculacoesDocumentos->removeElement($vinculacaoDocumento);
        }

        return $this;
    }

    /**
     * @return Collection|ArrayCollection|ArrayCollection<VinculacaoDocumento>
     */
    public function getVinculacoesDocumentos(): Collection
    {
        return $this->vinculacoesDocumentos;
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
     * @return Documento
     */
    public function addVinculacaoEtiqueta(VinculacaoEtiqueta $vinculacaoEtiqueta): self
    {
        if (!$this->vinculacoesEtiquetas->contains($vinculacaoEtiqueta)) {
            $this->vinculacoesEtiquetas->add($vinculacaoEtiqueta);
            $vinculacaoEtiqueta->setDocumento($this);
        }

        return $this;
    }

    /**
     * @param VinculacaoEtiqueta $vinculacaoEtiqueta
     *
     * @return Documento
     */
    public function removeVinculacaoEtiqueta(VinculacaoEtiqueta $vinculacaoEtiqueta): self
    {
        if ($this->vinculacoesEtiquetas->contains($vinculacaoEtiqueta)) {
            $this->vinculacoesEtiquetas->removeElement($vinculacaoEtiqueta);
        }

        return $this;
    }

    /**
     * @return DocumentoAvulso|null
     */
    public function getDocumentoAvulsoComplementacaoResposta(): ?DocumentoAvulso
    {
        return $this->documentoAvulsoComplementacaoResposta;
    }

    /**
     * @param DocumentoAvulso|null $documentoAvulsoComplementacaoResposta
     *
     * @return Documento
     */
    public function setDocumentoAvulsoComplementacaoResposta(?DocumentoAvulso $documentoAvulsoComplementacaoResposta): self
    {
        $this->documentoAvulsoComplementacaoResposta = $documentoAvulsoComplementacaoResposta;

        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getDataHoraValidade(): ?DateTime
    {
        return $this->dataHoraValidade;
    }

    /**
     * @param DateTime|null $dataHoraValidade
     *
     * @return Documento
     */
    public function setDataHoraValidade(?DateTime $dataHoraValidade): self
    {
        $this->dataHoraValidade = $dataHoraValidade;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getChaveAcesso(): ?string
    {
        return $this->chaveAcesso;
    }

    /**
     * @param string|null $chaveAcesso
     *
     * @return Documento
     */
    public function setChaveAcesso(?string $chaveAcesso): Documento
    {
        $this->chaveAcesso = $chaveAcesso;

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
     * @return self
     */
    public function setRelatorio(?Relatorio $relatorio): self
    {
        $this->relatorio = $relatorio;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getAcessoRestrito(): ?bool
    {
        return $this->acessoRestrito;
    }

    /**
     * @param bool|null $acessoRestrito
     *
     * @return self
     */
    public function setAcessoRestrito(?bool $acessoRestrito): self
    {
        $this->acessoRestrito = $acessoRestrito;

        return $this;
    }

    /**
     * @return Collection|ArrayCollection|ArrayCollection<VinculacaoDocumentoPrincipal>
     */
    public function getVinculacaoDocumentoPrincipal(): Collection
    {
        return $this->vinculacaoDocumentoPrincipal;
    }

    /**
     * @param VinculacaoDocumento $vinculacaoDocumentoPrincipal
     *
     * @return Documento
     */
    public function addVinculacaoDocumentoPrincipal(VinculacaoDocumento $vinculacaoDocumentoPrincipal): self
    {
        if (!$this->vinculacaoDocumentoPrincipal->contains($vinculacaoDocumentoPrincipal)) {
            $this->vinculacaoDocumentoPrincipal->add($vinculacaoDocumentoPrincipal);
            $vinculacaoDocumentoPrincipal->setDocumento($this);
        }

        return $this;
    }

    /**
     * @param VinculacaoDocumento $vinculacaoDocumentoPrincipal
     *
     * @return Documento
     */
    public function removeVinculacaoDocumentoPrincipal(VinculacaoDocumento $vinculacaoDocumentoPrincipal): self
    {
        if ($this->vinculacaoDocumentoPrincipal->contains($vinculacaoDocumentoPrincipal)) {
            $this->vinculacaoDocumentoPrincipal->removeElement($vinculacaoDocumentoPrincipal);
        }

        return $this;
    }

    /**
     * @return ModalidadeCopia|null
     */
    public function getModalidadeCopia(): ?ModalidadeCopia
    {
        return $this->modalidadeCopia;
    }

    /**
     * @param ModalidadeCopia|null $modalidadeCopia
     * @return Documento
     */
    public function setModalidadeCopia(?ModalidadeCopia $modalidadeCopia): Documento
    {
        $this->modalidadeCopia = $modalidadeCopia;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDependenciaSoftware(): ?string
    {
        return $this->dependenciaSoftware;
    }

    /**
     * @param string|null $dependenciaSoftware
     * @return Documento
     */
    public function setDependenciaSoftware(?string $dependenciaSoftware): self
    {
        $this->dependenciaSoftware = $dependenciaSoftware;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDependenciaHardware(): ?string
    {
        return $this->dependenciaHardware;
    }

    /**
     * @param string|null $dependenciaHardware
     * @return Documento
     */
    public function setDependenciaHardware(?string $dependenciaHardware): self
    {
        $this->dependenciaHardware = $dependenciaHardware;

        return $this;
    }
}
