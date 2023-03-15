<?php

declare(strict_types=1);
/**
 * /src/Entity/Pessoa.php.
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
use SuppCore\AdministrativoBackend\Entity\Traits\Timestampable;
use SuppCore\AdministrativoBackend\Entity\Traits\Uuid;
use SuppCore\AdministrativoBackend\Validator\Constraints as AppAssert;
use SuppCore\AdministrativoBackend\Entity\VinculacaoPessoaBarramento as VinculacaoPessoaBarramentoEntity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Pessoa.
 *
 *  @ORM\Table(
 *     name="ad_pessoa"
 * )
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @UniqueEntity(
 *     fields={"numeroDocumentoPrincipal"},
 *     message="CPF/CNPJ já cadastrado!"
 * )
 *
 * @Gedmo\Loggable
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Pessoa implements EntityInterface
{
    // Traits
    use Blameable;
    use Timestampable;
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
        $this->dossies = new ArrayCollection();
        $this->enderecos = new ArrayCollection();
        $this->documentosIdentificadores = new ArrayCollection();
        $this->relacionamentosPessoais = new ArrayCollection();
        $this->outrosNomes = new ArrayCollection();
        $this->interessados = new ArrayCollection();
    }

    /**
     * @ORM\ManyToOne(
     *     targetEntity="Municipio"
     * )
     * @ORM\JoinColumn(
     *     name="municipio_naturalidade_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?Municipio $naturalidade = null;

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
     * @ORM\Column(
     *     type="string",
     *     nullable=true
     * )
     */
    protected ?string $profissao = null;

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
     * @ORM\Column(
     *     type="string",
     *     nullable=true
     * )
     */
    protected ?string $contato = null;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     * @ORM\Column(
     *     type="boolean",
     *     name="pessoa_validada",
     *     nullable=false
     * )
     */
    protected bool $pessoaValidada = false;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     * @ORM\Column(
     *     type="boolean",
     *     name="pessoa_conveniada",
     *     nullable=false
     * )
     */
    protected bool $pessoaConveniada = false;

    /**
     * @ORM\Column(
     *     type="datetime",
     *     name="data_hora_indexacao",
     *     nullable=true
     * )
     */
    protected ?DateTime $dataHoraIndexacao = null;

    /**
     * @ORM\Column(
     *     type="date",
     *     name="data_nascimento",
     *     nullable=true
     * )
     *
     * @Assert\GreaterThan("1900-01-01",  message="A data não pode ser menor que 1900-01-01!")
     */
    protected ?DateTime $dataNascimento = null;

    /**
     * @ORM\Column(
     *     type="date",
     *     name="data_obito",
     *     nullable=true
     * )
     */
    protected ?DateTime $dataObito = null;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="Pais"
     * )
     * @ORM\JoinColumn(
     *     name="pais_nacionalidade_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?Pais $nacionalidade = null;

    /**
     * @Assert\NotBlank(
     *     message="Campo não pode estar em branco."
     * )
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
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
     *     nullable=false
     * )
     */
    protected string $nome;

    /**
     * @Filter\Digits(
     *     allowWhitespace=false
     * )
     *
     * @AppAssert\CpfCnpj()
     *
     * @Assert\Length(
     *     max = 14,
     *     maxMessage = "O campo deve ter no máximo 14 caracteres!"
     * )
     * @ORM\Column(
     *     name="numero_doc_principal",
     *     type="string",
     *     nullable=true,
     *     unique=true
     * )
     */
    protected ?string $numeroDocumentoPrincipal = null;

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
     * @ORM\Column(
     *     type="string",
     *     name="nome_genitor",
     *     nullable=true
     * )
     */
    protected ?string $nomeGenitor = null;

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
     * @ORM\Column(
     *     type="string",
     *     name="nome_genitora",
     *     nullable=true
     * )
     */
    protected ?string $nomeGenitora = null;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="ModalidadeGeneroPessoa"
     * )
     * @ORM\JoinColumn(
     *     name="mod_genero_pessoa_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?ModalidadeGeneroPessoa $modalidadeGeneroPessoa = null;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(
     *     targetEntity="ModalidadeQualificacaoPessoa"
     * )
     * @ORM\JoinColumn(
     *     name="mod_qual_pessoa_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected ModalidadeQualificacaoPessoa $modalidadeQualificacaoPessoa;

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
     * @var Collection|ArrayCollection|ArrayCollection<Endereco>
     *
     * @ORM\OneToMany(
     *     targetEntity="Endereco",
     *     mappedBy="pessoa",
     *     cascade={"all"}
     * )
     * @ORM\OrderBy(
     *     {"principal" = "DESC"}
     * )
     */
    protected $enderecos;

    /**
     * @var Collection|ArrayCollection|ArrayCollection<Dossie>
     *
     * @ORM\OneToMany(
     *     targetEntity="Dossie",
     *     mappedBy="pessoa",
     *     cascade={"all"}
     * )
     * @ORM\OrderBy(
     *     {"criadoEm" = "DESC"}
     * )
     */
    protected $dossies;

    /**
     * @var Collection|ArrayCollection|ArrayCollection<RelacionamentoPessoal>
     *
     * @ORM\OneToMany(
     *     targetEntity="RelacionamentoPessoal",
     *     mappedBy="pessoa",
     *     cascade={"all"}
     * )
     */
    protected $relacionamentosPessoais;

    /**
     * @var Collection|ArrayCollection|ArrayCollection<Nome>
     *
     * @ORM\OneToMany(
     *     targetEntity="Nome",
     *     mappedBy="pessoa",
     *     cascade={"all"}
     * )
     */
    protected $outrosNomes;

    /**
     * @var Collection|ArrayCollection|ArrayCollection<DocumentoIdentificador>
     *
     * @ORM\OneToMany(
     *     targetEntity="DocumentoIdentificador",
     *     mappedBy="pessoa",
     *     cascade={"all"}
     * )
     */
    protected $documentosIdentificadores;

    /**
     * @var Collection|ArrayCollection|ArrayCollection<Interessado>
     *
     * @ORM\OneToMany(
     *     targetEntity="Interessado",
     *     mappedBy="pessoa"
     * )
     */
    protected $interessados;

    /**
     * @var VinculacaoPessoaBarramentoEntity|null
     *
     * @ORM\OneToOne(
     *     targetEntity="VinculacaoPessoaBarramento",
     *     mappedBy="pessoa",
     *     cascade={"persist"}
     * )
     */
    protected ?VinculacaoPessoaBarramentoEntity $vinculacaoPessoaBarramento = null;

    /**
     * @return Municipio|null
     */
    public function getNaturalidade(): ?Municipio
    {
        return $this->naturalidade;
    }

    /**
     * @param Municipio|null $naturalidade
     *
     * @return Pessoa
     */
    public function setNaturalidade(?Municipio $naturalidade): self
    {
        $this->naturalidade = $naturalidade;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getProfissao(): ?string
    {
        return $this->profissao;
    }

    /**
     * @param string|null $profissao
     *
     * @return Pessoa
     */
    public function setProfissao(?string $profissao): self
    {
        $this->profissao = $profissao;

        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getDataHoraIndexacao(): ?DateTime
    {
        return $this->dataHoraIndexacao;
    }

    /**
     * @param DateTime|null $dataHoraIndexacao
     *
     * @return self
     */
    public function setDataHoraIndexacao(?DateTime $dataHoraIndexacao): self
    {
        $this->dataHoraIndexacao = $dataHoraIndexacao;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getContato(): ?string
    {
        return $this->contato;
    }

    /**
     * @param string|null $contato
     *
     * @return Pessoa
     */
    public function setContato(?string $contato): self
    {
        $this->contato = $contato;

        return $this;
    }

    /**
     * @return bool
     */
    public function getPessoaValidada(): bool
    {
        return $this->pessoaValidada;
    }

    /**
     * @param bool $pessoaValidada
     *
     * @return Pessoa
     */
    public function setPessoaValidada(bool $pessoaValidada): self
    {
        $this->pessoaValidada = $pessoaValidada;

        return $this;
    }

    /**
     * @return bool
     */
    public function getPessoaConveniada(): bool
    {
        return $this->pessoaConveniada;
    }

    /**
     * @param bool $pessoaConveniada
     *
     * @return Pessoa
     */
    public function setPessoaConveniada(bool $pessoaConveniada): self
    {
        $this->pessoaConveniada = $pessoaConveniada;

        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getDataNascimento(): ?DateTime
    {
        return $this->dataNascimento;
    }

    /**
     * @param DateTime|null $dataNascimento
     *
     * @return Pessoa
     */
    public function setDataNascimento(?DateTime $dataNascimento): self
    {
        $this->dataNascimento = $dataNascimento;

        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getDataObito(): ?DateTime
    {
        return $this->dataObito;
    }

    /**
     * @param DateTime|null $dataObito
     *
     * @return Pessoa
     */
    public function setDataObito(?DateTime $dataObito): self
    {
        $this->dataObito = $dataObito;

        return $this;
    }

    /**
     * @return Pais|null
     */
    public function getNacionalidade(): ?Pais
    {
        return $this->nacionalidade;
    }

    /**
     * @param Pais|null $nacionalidade
     *
     * @return Pessoa
     */
    public function setNacionalidade(?Pais $nacionalidade): self
    {
        $this->nacionalidade = $nacionalidade;

        return $this;
    }

    /**
     * @return string
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     *
     * @return Pessoa
     */
    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getNumeroDocumentoPrincipal(): ?string
    {
        return $this->numeroDocumentoPrincipal;
    }

    /**
     * @param string|null $numeroDocumentoPrincipal
     *
     * @return Pessoa
     */
    public function setNumeroDocumentoPrincipal(?string $numeroDocumentoPrincipal): self
    {
        $this->numeroDocumentoPrincipal = $numeroDocumentoPrincipal;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getNomeGenitor(): ?string
    {
        return $this->nomeGenitor;
    }

    /**
     * @param string|null $nomeGenitor
     *
     * @return Pessoa
     */
    public function setNomeGenitor(?string $nomeGenitor): self
    {
        $this->nomeGenitor = $nomeGenitor;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getNomeGenitora(): ?string
    {
        return $this->nomeGenitora;
    }

    /**
     * @param string|null $nomeGenitora
     *
     * @return Pessoa
     */
    public function setNomeGenitora(?string $nomeGenitora): self
    {
        $this->nomeGenitora = $nomeGenitora;

        return $this;
    }

    /**
     * @return ModalidadeGeneroPessoa|null
     */
    public function getModalidadeGeneroPessoa(): ?ModalidadeGeneroPessoa
    {
        return $this->modalidadeGeneroPessoa;
    }

    /**
     * @param ModalidadeGeneroPessoa|null $modalidadeGeneroPessoa
     *
     * @return Pessoa
     */
    public function setModalidadeGeneroPessoa(?ModalidadeGeneroPessoa $modalidadeGeneroPessoa): self
    {
        $this->modalidadeGeneroPessoa = $modalidadeGeneroPessoa;

        return $this;
    }

    /**
     * @return ModalidadeQualificacaoPessoa
     */
    public function getModalidadeQualificacaoPessoa(): ModalidadeQualificacaoPessoa
    {
        return $this->modalidadeQualificacaoPessoa;
    }

    /**
     * @param ModalidadeQualificacaoPessoa $modalidadeQualificacaoPessoa
     *
     * @return Pessoa
     */
    public function setModalidadeQualificacaoPessoa(ModalidadeQualificacaoPessoa $modalidadeQualificacaoPessoa): self
    {
        $this->modalidadeQualificacaoPessoa = $modalidadeQualificacaoPessoa;

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
     * @return Pessoa
     */
    public function setOrigemDados(?OrigemDados $origemDados): self
    {
        $this->origemDados = $origemDados;

        return $this;
    }

    /**
     * @param Endereco $endereco
     *
     * @return Pessoa
     */
    public function addEndereco(Endereco $endereco): self
    {
        if (!$this->enderecos->contains($endereco)) {
            $this->enderecos[] = $endereco;
            $endereco->setPessoa($this);
        }

        return $this;
    }

    /**
     * @param Endereco $endereco
     *
     * @return Pessoa
     */
    public function removeEndereco(Endereco $endereco): self
    {
        if ($this->enderecos->contains($endereco)) {
            $this->enderecos->removeElement($endereco);
        }

        return $this;
    }

    /**
     * @return Collection|ArrayCollection|ArrayCollection<Endereco>
     */
    public function getEnderecos(): Collection
    {
        return $this->enderecos;
    }

    /**
     * @param Dossie $dossie
     *
     * @return Pessoa
     */
    public function addDossie(Dossie $dossie): self
    {
        if (!$this->dossies->contains($dossie)) {
            $this->dossies[] = $dossie;
            $dossie->setPessoa($this);
        }

        return $this;
    }

    /**
     * @param Dossie $dossie
     *
     * @return Pessoa
     */
    public function removeDossie(Dossie $dossie): self
    {
        if ($this->dossies->contains($dossie)) {
            $this->dossies->removeElement($dossie);
        }

        return $this;
    }

    /**
     * @return Collection|ArrayCollection|ArrayCollection<Dossie>
     */
    public function getDossies(): Collection
    {
        return $this->dossies;
    }

    /**
     * @param DocumentoIdentificador $documentoIdentificador
     *
     * @return Pessoa
     */
    public function addDocumentoIdentificador(DocumentoIdentificador $documentoIdentificador): self
    {
        if (!$this->documentosIdentificadores->contains($documentoIdentificador)) {
            $this->documentosIdentificadores[] = $documentoIdentificador;
            $documentoIdentificador->setPessoa($this);
        }

        return $this;
    }

    /**
     * @param DocumentoIdentificador $documentoIdentificador
     *
     * @return Pessoa
     */
    public function removeDocumentoIdentificador(DocumentoIdentificador $documentoIdentificador): self
    {
        if ($this->documentosIdentificadores->contains($documentoIdentificador)) {
            $this->documentosIdentificadores->removeElement($documentoIdentificador);
        }

        return $this;
    }

    /**
     * @return Collection|ArrayCollection|ArrayCollection<DocumentoIdentificador>
     */
    public function getDocumentosIdentificadores(): Collection
    {
        return $this->documentosIdentificadores;
    }

    /**
     * @param RelacionamentoPessoal $relacionamentoPessoal
     *
     * @return Pessoa
     */
    public function addRelacionamentoPessoal(RelacionamentoPessoal $relacionamentoPessoal): self
    {
        if (!$this->relacionamentosPessoais->contains($relacionamentoPessoal)) {
            $this->relacionamentosPessoais[] = $relacionamentoPessoal;
            $relacionamentoPessoal->setPessoa($this);
        }

        return $this;
    }

    /**
     * @param RelacionamentoPessoal $relacionamentoPessoal
     *
     * @return Pessoa
     */
    public function removeRelacionamentoPessoal(RelacionamentoPessoal $relacionamentoPessoal): self
    {
        if ($this->relacionamentosPessoais->contains($relacionamentoPessoal)) {
            $this->relacionamentosPessoais->removeElement($relacionamentoPessoal);
        }

        return $this;
    }

    /**
     * @return Collection|ArrayCollection|ArrayCollection<RelacionamentoPessoal>
     */
    public function getRelacionamentosPessoais(): Collection
    {
        return $this->relacionamentosPessoais;
    }

    /**
     * @param Nome $outroNome
     *
     * @return Pessoa
     */
    public function addOutroNome(Nome $outroNome): self
    {
        if (!$this->outrosNomes->contains($outroNome)) {
            $this->outrosNomes[] = $outroNome;
            $outroNome->setPessoa($this);
        }

        return $this;
    }

    /**
     * @param Nome $outroNome
     *
     * @return Pessoa
     */
    public function removeOutroNome(Nome $outroNome): self
    {
        if ($this->outrosNomes->contains($outroNome)) {
            $this->outrosNomes->removeElement($outroNome);
        }

        return $this;
    }

    /**
     * @return Collection|ArrayCollection|ArrayCollection<Nome>
     */
    public function getOutrosNomes(): Collection
    {
        return $this->outrosNomes;
    }

    /**
     * @param Nome $interessado
     *
     * @return Pessoa
     */
    public function addInteressado(Nome $interessado): self
    {
        if (!$this->interessados->contains($interessado)) {
            $this->interessados[] = $interessado;
            $interessado->setPessoa($this);
        }

        return $this;
    }

    /**
     * @param Nome $interessado
     *
     * @return Pessoa
     */
    public function removeInteressado(Nome $interessado): self
    {
        if ($this->interessados->contains($interessado)) {
            $this->interessados->removeElement($interessado);
        }

        return $this;
    }

    /**
     * @return Collection|ArrayCollection|ArrayCollection<Nome>
     */
    public function getInteressados(): Collection
    {
        return $this->interessados;
    }

    /**
     * @return VinculacaoPessoaBarramento|null
     */
    public function getVinculacaoPessoaBarramento(): ?VinculacaoPessoaBarramentoEntity
    {
        return $this->vinculacaoPessoaBarramento;
    }

    /**
     * @param VinculacaoPessoaBarramentoEntity|null $vinculacaoPessoaBarramento
     *
     * @return Pessoa
     */
    public function setVinculacaoPessoaBarramento(?VinculacaoPessoaBarramentoEntity $vinculacaoPessoaBarramento): self
    {
        $this->vinculacaoPessoaBarramento = $vinculacaoPessoaBarramento;

        return $this;
    }
}
