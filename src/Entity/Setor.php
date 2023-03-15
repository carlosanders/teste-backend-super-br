<?php

declare(strict_types=1);
/**
 * /src/Entity/Setor.php.
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
use SuppCore\AdministrativoBackend\Doctrine\ORM\Enableable\Enableable;
use SuppCore\AdministrativoBackend\Entity\Traits\Blameable;
use SuppCore\AdministrativoBackend\Entity\Traits\Id;
use SuppCore\AdministrativoBackend\Entity\Traits\Timestampable;
use SuppCore\AdministrativoBackend\Entity\Traits\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Setor.
 *
 *  @ORM\Table(
 *     name="ad_setor",
 * )
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @Gedmo\Loggable
 * @Gedmo\Tree(type="nested")
 *
 * @Enableable()
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Setor implements EntityInterface
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
        $this->contasEmails = new ArrayCollection();
        $this->lotacoes = new ArrayCollection();
        $this->children = new ArrayCollection();
        $this->vinculacoesEtiquetas = new ArrayCollection();
    }

    /**
     * @Assert\NotBlank(
     *     message="Campo não pode estar em branco."
     * )
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     * @Assert\Length(
     *     min = 3,
     *     max = 255,
     *     minMessage = "Campo ter no mínimo {{ limit }} letras ou números",
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
     * @Gedmo\Versioned
     *
     * @ORM\ManyToOne(
     *     targetEntity="EspecieSetor"
     * )
     * @ORM\JoinColumn(
     *     name="especie_setor_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?EspecieSetor $especieSetor = null;

    /**
     * @Gedmo\Versioned
     *
     * @ORM\ManyToOne(
     *     targetEntity="GeneroSetor"
     * )
     * @ORM\JoinColumn(
     *     name="genero_setor_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?GeneroSetor $generoSetor = null;

    /**
     * @Gedmo\Versioned
     *
     * @ORM\ManyToOne(
     *     targetEntity="ModalidadeOrgaoCentral"
     * )
     * @ORM\JoinColumn(
     *     name="mod_orgao_central_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?ModalidadeOrgaoCentral $modalidadeOrgaoCentral = null;

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
     *     nullable=true
     * )
     */
    protected ?string $endereco = null;

    /**
     * @Assert\Length(
     *     max = 255,
     *     maxMessage = "Campo deve ter no máximo {{ limit }} letras ou números"
     * )
     * @Assert\Email(
     *     message="Email em formato inválido!"
     * )
     * @ORM\Column(
     *     type="string",
     *     nullable=true
     * )
     */
    protected ?string $email = null;

    /**
     * @Assert\NotBlank(
     *     message="Campo não pode estar em branco."
     * )
     * @Assert\Regex(
     *     pattern="/[A-Z0-9]+/",
     *     message="A sigla do setor deve possuir apenas letras maiúsculas ou números."
     * )
     * @Assert\Length(
     *     min = 2,
     *     max = 25,
     *     minMessage = "A sigla deve ter no mínimo {{ limit }} letras ou números",
     *     maxMessage = "A sigla deve ter no máximo {{ limit }} letras ou números"
     * )
     *
     * @Gedmo\Versioned
     * @ORM\Column(
     *     type="string",
     *     length=25,
     *     nullable=false
     * )
     */
    protected string $sigla;

    /**
     * @Gedmo\Versioned
     *
     * @ORM\ManyToOne(
     *     targetEntity="Setor",
     *     cascade={"persist"}
     * )
     * @ORM\JoinColumn(
     *     name="unidade_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?Setor $unidade = null;

    /**
     * @Gedmo\Versioned
     *
     * @ORM\ManyToOne(
     *     targetEntity="Setor",
     *     cascade={"persist"}
     * )
     * @ORM\JoinColumn(
     *     name="unidade_pai_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?Setor $unidadePai = null;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @Gedmo\Versioned
     *
     * @ORM\ManyToOne(
     *     targetEntity="Municipio"
     * )
     * @ORM\JoinColumn(name="municipio_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected Municipio $municipio;

    /**
     * @Assert\Regex(
     *     pattern="/\d{5}/",
     *     message="Prefixo NUP Inválido"
     * )
     *
     * @Gedmo\Versioned
     * @ORM\Column(
     *     type="string",
     *     name="prefixo_nup",
     *     nullable=true
     * )
     */
    protected ?string $prefixoNUP = null;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @Gedmo\Versioned
     * @ORM\Column(
     *     type="integer",
     *     name="sequencia_inicial_nup",
     *     nullable=false
     * )
     */
    protected ?int $sequenciaInicialNUP = 0;

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
    protected bool $ativo = true;

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
    protected bool $gerenciamento = false;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @Gedmo\Versioned
     * @ORM\Column(
     *     type="boolean",
     *     name="apenas_protocolo",
     *     nullable=false
     * )
     */
    protected bool $apenasProtocolo = false;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @Gedmo\Versioned
     * @ORM\Column(
     *     type="boolean",
     *     name="numeracao_doc_unidade",
     *     nullable=false
     * )
     */
    protected bool $numeracaoDocumentoUnidade = false;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @Gedmo\Versioned
     * @ORM\Column(
     *     type="boolean",
     *     name="apenas_distribuidor",
     *     nullable=false
     * )
     */
    protected bool $apenasDistribuidor = false;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @Gedmo\Versioned
     * @ORM\Column(
     *     type="boolean",
     *     name="distribuicao_centena",
     *     nullable=false
     * )
     */
    protected bool $distribuicaoCentena = false;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @Gedmo\Versioned
     * @ORM\Column(
     *     type="integer",
     *     name="prazo_equalizacao",
     *     nullable=false
     * )
     */
    protected int $prazoEqualizacao = 7;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @Gedmo\Versioned
     * @ORM\Column(
     *     type="integer",
     *     name="divergencia_maxima",
     *     nullable=false
     * )
     */
    protected int $divergenciaMaxima = 25;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @Gedmo\Versioned
     * @ORM\Column(
     *     type="boolean",
     *     name="apenas_distrib_automatica",
     *     nullable=false
     * )
     */
    protected bool $apenasDistribuicaoAutomatica = true;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @Gedmo\Versioned
     * @ORM\Column(
     *     type="boolean",
     *     name="com_prevencao_relativa",
     *     nullable=false
     * )
     */
    protected bool $comPrevencaoRelativa = true;

    /**
     * @Gedmo\TreeLeft
     * @ORM\Column(name="lft", type="integer")
     */
    protected int $lft;

    /**
     * @Gedmo\TreeLevel
     * @ORM\Column(name="lvl", type="integer")
     */
    protected int $lvl;

    /**
     * @Gedmo\TreeRight
     * @ORM\Column(name="rgt", type="integer")
     */
    protected int $rgt;

    /**
     * @Gedmo\TreeRoot
     * @ORM\Column(name="root", type="integer", nullable=true)
     */
    protected ?int $root = null;

    /**
     * @Gedmo\Versioned
     * @Gedmo\TreeParent
     *
     * @ORM\ManyToOne(
     *     targetEntity="Setor",
     *     inversedBy="children"
     * )
     * @ORM\JoinColumn(
     *     name="parent_id",
     *     referencedColumnName="id",
     *     onDelete="SET NULL"
     * )
     */
    protected ?Setor $parent = null;

    /**
     * @var Collection|ArrayCollection|ArrayCollection<Setor>
     *
     * @ORM\OneToMany(
     *     targetEntity="Setor",
     *     mappedBy="parent"
     * )
     * @ORM\OrderBy(
     *     {"lft" = "ASC"}
     * )
     */
    protected $children;

    /**
     * @var Collection|ArrayCollection|ArrayCollection<Lotacao>
     *
     * @ORM\OneToMany(
     *     targetEntity="Lotacao",
     *     mappedBy="setor",
     *     cascade={"all"}
     * )
     */
    protected $lotacoes;

    /**
     * @var Collection|ArrayCollection|ArrayCollection<ContaEmail>
     *
     * @ORM\OneToMany(
     *     targetEntity="ContaEmail",
     *     mappedBy="setor"
     * )
     */
    protected $contasEmails;

    /**
     * @var Collection|ArrayCollection|ArrayCollection<VinculacaoEtiqueta>
     *
     * @ORM\OneToMany(
     *     targetEntity="VinculacaoEtiqueta",
     *     mappedBy="setor",
     * )
     */
    protected $vinculacoesEtiquetas;

    /**
     * @return string
     */

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
     * @return Setor
     */
    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * @return EspecieSetor|null
     */

    /**
     * @return EspecieSetor|null
     */
    public function getEspecieSetor(): ?EspecieSetor
    {
        return $this->especieSetor;
    }

    /**
     * @param EspecieSetor|null $especieSetor
     *
     * @return Setor
     */
    public function setEspecieSetor(?EspecieSetor $especieSetor): self
    {
        $this->especieSetor = $especieSetor;

        return $this;
    }

    /**
     * @return GeneroSetor|null
     */

    /**
     * @return GeneroSetor|null
     */
    public function getGeneroSetor(): ?GeneroSetor
    {
        return $this->generoSetor;
    }

    /**
     * @param GeneroSetor|null $generoSetor
     *
     * @return Setor
     */
    public function setGeneroSetor(?GeneroSetor $generoSetor): self
    {
        $this->generoSetor = $generoSetor;

        return $this;
    }

    /**
     * @return ModalidadeOrgaoCentral|null
     */

    /**
     * @return ModalidadeOrgaoCentral|null
     */
    public function getModalidadeOrgaoCentral(): ?ModalidadeOrgaoCentral
    {
        return $this->modalidadeOrgaoCentral;
    }

    /**
     * @param ModalidadeOrgaoCentral|null $modalidadeOrgaoCentral
     *
     * @return Setor
     */
    public function setModalidadeOrgaoCentral(?ModalidadeOrgaoCentral $modalidadeOrgaoCentral): self
    {
        $this->modalidadeOrgaoCentral = $modalidadeOrgaoCentral;

        return $this;
    }

    /**
     * @return string|null
     */

    /**
     * @return string|null
     */
    public function getEndereco(): ?string
    {
        return $this->endereco;
    }

    /**
     * @param string|null $endereco
     *
     * @return Setor
     */
    public function setEndereco(?string $endereco): self
    {
        $this->endereco = $endereco;

        return $this;
    }

    /**
     * @return string|null
     */

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     *
     * @return Setor
     */
    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */

    /**
     * @return string
     */
    public function getSigla(): string
    {
        return $this->sigla;
    }

    /**
     * @param string $sigla
     *
     * @return Setor
     */
    public function setSigla(string $sigla): self
    {
        $this->sigla = $sigla;

        return $this;
    }

    /**
     * @return Setor|null
     */
    public function getUnidade(): ?self
    {
        return $this->unidade;
    }

    /**
     * @param Setor|null $unidade
     *
     * @return Setor
     */
    public function setUnidade(?Setor $unidade): self
    {
        $this->unidade = $unidade;

        return $this;
    }

    /**
     * @return Setor|null
     */

    /**
     * @return Setor|null
     */
    public function getUnidadePai(): ?Setor
    {
        return $this->unidadePai;
    }

    /**
     * @param Setor|null $unidadePai
     *
     * @return Setor
     */
    public function setUnidadePai(?Setor $unidadePai): self
    {
        $this->unidadePai = $unidadePai;

        return $this;
    }

    /**
     * @return Municipio
     */

    /**
     * @return Municipio
     */
    public function getMunicipio(): Municipio
    {
        return $this->municipio;
    }

    /**
     * @param Municipio $municipio
     *
     * @return Setor
     */
    public function setMunicipio(Municipio $municipio): self
    {
        $this->municipio = $municipio;

        return $this;
    }

    /**
     * @return string
     */

    /**
     * @return string|null
     */
    public function getPrefixoNUP(): ?string
    {
        return $this->prefixoNUP;
    }

    /**
     * @param string|null $prefixoNUP
     *
     * @return Setor
     */
    public function setPrefixoNUP(?string $prefixoNUP): self
    {
        $this->prefixoNUP = $prefixoNUP;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getSequenciaInicialNUP(): ?int
    {
        return $this->sequenciaInicialNUP;
    }

    /**
     * @param int|null $sequenciaInicialNUP
     *
     * @return Setor
     */
    public function setSequenciaInicialNUP(?int $sequenciaInicialNUP): self
    {
        $this->sequenciaInicialNUP = $sequenciaInicialNUP;

        return $this;
    }

    /**
     * @return bool
     */

    /**
     * @return bool
     */
    public function getAtivo(): bool
    {
        return $this->ativo;
    }

    /**
     * @param bool $ativo
     *
     * @return Setor
     */
    public function setAtivo(bool $ativo): self
    {
        $this->ativo = $ativo;

        return $this;
    }

    /**
     * @return bool
     */

    /**
     * @return bool
     */
    public function getGerenciamento(): bool
    {
        return $this->gerenciamento;
    }

    /**
     * @param bool $gerenciamento
     *
     * @return Setor
     */
    public function setGerenciamento(bool $gerenciamento): self
    {
        $this->gerenciamento = $gerenciamento;

        return $this;
    }

    /**
     * @return bool
     */

    /**
     * @return bool
     */
    public function getApenasProtocolo(): bool
    {
        return $this->apenasProtocolo;
    }

    /**
     * @param bool $apenasProtocolo
     *
     * @return Setor
     */
    public function setApenasProtocolo(bool $apenasProtocolo): self
    {
        $this->apenasProtocolo = $apenasProtocolo;

        return $this;
    }

    /**
     * @return bool
     */

    /**
     * @return bool
     */
    public function getNumeracaoDocumentoUnidade(): bool
    {
        return $this->numeracaoDocumentoUnidade;
    }

    /**
     * @param bool $numeracaoDocumentoUnidade
     *
     * @return Setor
     */
    public function setNumeracaoDocumentoUnidade(bool $numeracaoDocumentoUnidade): self
    {
        $this->numeracaoDocumentoUnidade = $numeracaoDocumentoUnidade;

        return $this;
    }

    /**
     * @return bool
     */

    /**
     * @return bool
     */
    public function getApenasDistribuidor(): bool
    {
        return $this->apenasDistribuidor;
    }

    /**
     * @param bool $apenasDistribuidor
     *
     * @return Setor
     */
    public function setApenasDistribuidor(bool $apenasDistribuidor): self
    {
        $this->apenasDistribuidor = $apenasDistribuidor;

        return $this;
    }

    /**
     * @return bool
     */

    /**
     * @return bool
     */
    public function getDistribuicaoCentena(): bool
    {
        return $this->distribuicaoCentena;
    }

    /**
     * @param bool $distribuicaoCentena
     *
     * @return Setor
     */
    public function setDistribuicaoCentena(bool $distribuicaoCentena): self
    {
        $this->distribuicaoCentena = $distribuicaoCentena;

        return $this;
    }

    /**
     * @return int
     */

    /**
     * @return int
     */
    public function getPrazoEqualizacao(): int
    {
        return $this->prazoEqualizacao;
    }

    /**
     * @param int $prazoEqualizacao
     *
     * @return Setor
     */
    public function setPrazoEqualizacao(int $prazoEqualizacao): self
    {
        $this->prazoEqualizacao = $prazoEqualizacao;

        return $this;
    }

    /**
     * @return int
     */

    /**
     * @return int
     */
    public function getDivergenciaMaxima(): int
    {
        return $this->divergenciaMaxima;
    }

    /**
     * @param int $divergenciaMaxima
     *
     * @return Setor
     */
    public function setDivergenciaMaxima(int $divergenciaMaxima): self
    {
        $this->divergenciaMaxima = $divergenciaMaxima;

        return $this;
    }

    /**
     * @return bool
     */

    /**
     * @return bool
     */
    public function getApenasDistribuicaoAutomatica(): bool
    {
        return $this->apenasDistribuicaoAutomatica;
    }

    /**
     * @param bool $apenasDistribuicaoAutomatica
     *
     * @return Setor
     */
    public function setApenasDistribuicaoAutomatica(bool $apenasDistribuicaoAutomatica): self
    {
        $this->apenasDistribuicaoAutomatica = $apenasDistribuicaoAutomatica;

        return $this;
    }

    /**
     * @return bool
     */

    /**
     * @return bool
     */
    public function getComPrevencaoRelativa(): bool
    {
        return $this->comPrevencaoRelativa;
    }

    /**
     * @param bool $comPrevencaoRelativa
     *
     * @return Setor
     */
    public function setComPrevencaoRelativa(bool $comPrevencaoRelativa): self
    {
        $this->comPrevencaoRelativa = $comPrevencaoRelativa;

        return $this;
    }

    /**
     * @param Setor|null $parent
     *
     * @return Setor
     */
    public function setParent(?Setor $parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Setor|null
     */
    public function getParent(): ?Setor
    {
        return $this->parent;
    }

    /**
     * @param VinculacaoEtiqueta $vinculacaoEtiqueta
     *
     * @return Setor
     */
    public function addVinculacaoEtiqueta(VinculacaoEtiqueta $vinculacaoEtiqueta): self
    {
        if (!$this->vinculacoesEtiquetas->contains($vinculacaoEtiqueta)) {
            $this->vinculacoesEtiquetas[] = $vinculacaoEtiqueta;
            $vinculacaoEtiqueta->setSetor($this);
        }

        return $this;
    }

    /**
     * @param VinculacaoEtiqueta $vinculacaoEtiqueta
     *
     * @return Setor
     */
    public function removeVinculacaoEtiqueta(VinculacaoEtiqueta $vinculacaoEtiqueta): self
    {
        if ($this->vinculacoesEtiquetas->contains($vinculacaoEtiqueta)) {
            $this->vinculacoesEtiquetas->removeElement($vinculacaoEtiqueta);
        }

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
     * @param Lotacao $lotacao
     *
     * @return Setor
     */
    public function addLotacao(Lotacao $lotacao): self
    {
        if (!$this->lotacoes->contains($lotacao)) {
            $this->lotacoes[] = $lotacao;
            $lotacao->setSetor($this);
        }

        return $this;
    }

    /**
     * @param Lotacao $lotacao
     *
     * @return Setor
     */
    public function removeLotacao(Lotacao $lotacao): self
    {
        if ($this->lotacoes->contains($lotacao)) {
            $this->lotacoes->removeElement($lotacao);
        }

        return $this;
    }

    /**
     * @return Collection|ArrayCollection|ArrayCollection<Lotacao>
     */
    public function getLotacoes(): Collection
    {
        return $this->lotacoes;
    }

    /**
     * @param ContaEmail $contaEmail
     *
     * @return Setor
     */
    public function addContaEmail(ContaEmail $contaEmail): self
    {
        if (!$this->contasEmails->contains($contaEmail)) {
            $this->contasEmails[] = $contaEmail;
            $contaEmail->setSetor($this);
        }

        return $this;
    }

    /**
     * @param ContaEmail $contaEmail
     *
     * @return Setor
     */
    public function removeContaEmail(ContaEmail $contaEmail): self
    {
        if ($this->contasEmails->contains($contaEmail)) {
            $this->contasEmails->removeElement($contaEmail);
        }

        return $this;
    }

    /**
     * @return Collection|ArrayCollection|ArrayCollection<ContaEmail>
     */
    public function getContasEmails(): Collection
    {
        return $this->contasEmails;
    }



    /**
     * @return Collection|ArrayCollection|ArrayCollection<Setor>
     */
    public function getChildren(): Collection
    {
        return $this->children;
    }
}
