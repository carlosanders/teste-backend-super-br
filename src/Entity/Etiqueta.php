<?php

declare(strict_types=1);
/**
 * /src/Entity/Etiqueta.php.
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
use SuppCore\AdministrativoBackend\Doctrine\ORM\Enableable\Enableable;
use SuppCore\AdministrativoBackend\Doctrine\ORM\Immutable\Immutable;
use SuppCore\AdministrativoBackend\Entity\Traits\Ativo;
use SuppCore\AdministrativoBackend\Entity\Traits\Blameable;
use SuppCore\AdministrativoBackend\Entity\Traits\Descricao;
use SuppCore\AdministrativoBackend\Entity\Traits\Id;
use SuppCore\AdministrativoBackend\Entity\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\Entity\Traits\Timestampable;
use SuppCore\AdministrativoBackend\Entity\Traits\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Etiqueta.
 *
 *  @ORM\Table(
 *     name="ad_etiqueta",
 * )
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 *
 * @Enableable()
 * @Immutable(fieldName="sistema", expression=Immutable::EXPRESSION_EQUALS, expressionValues="env:constantes.entidades.etiqueta.immutable")
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Etiqueta implements EntityInterface
{
    // Traits
    use Blameable;
    use Timestampable;
    use Softdeleteable;
    use Descricao;
    use Ativo;
    use Id;
    use Uuid;

    public const TIPO_EXECUCAO_ACAO_SUGESTAO_SELECAO_TODOS = null;
    public const TIPO_EXECUCAO_ACAO_SUGESTAO_SELECAO_UNICA = 1;
    public const TIPO_EXECUCAO_ACAO_SUGESTAO_SELECAO_MULTIPLA = 2;

    public const TIPO_EXECUCAO_ACAO_SUGESTAO_ALLOWED = [
        self::TIPO_EXECUCAO_ACAO_SUGESTAO_SELECAO_TODOS,
        self::TIPO_EXECUCAO_ACAO_SUGESTAO_SELECAO_UNICA,
        self::TIPO_EXECUCAO_ACAO_SUGESTAO_SELECAO_MULTIPLA
    ];

    /**
     * Constructor.
     *
     * @throws Exception
     */
    public function __construct()
    {
        $this->setUuid();
        $this->vinculacoesEtiquetas = new ArrayCollection();
        $this->acoes = new ArrayCollection();
    }

    /**
     * @Assert\NotBlank(
     *     message="Campo não pode estar em branco."
     * )
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     * @Assert\Length(
     *     max = 7,
     *     maxMessage = "O campo deve ter no máximo 7 caracteres!"
     * )
     *
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Filter\ToUpper(encoding="UTF-8")
     * @ORM\Column(
     *     name="cor_hexadecimal",
     *     type="string",
     *     nullable=false
     * )
     */
    protected string $corHexadecimal;

    /**
     * Modalidade da etiqueta.
     *
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(
     *     targetEntity="ModalidadeEtiqueta"
     * )
     * @ORM\JoinColumn(
     *     name="mod_etiqueta_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected ModalidadeEtiqueta $modalidadeEtiqueta;

    /**
     * @ORM\Column(
     *     type="boolean",
     *     nullable=false
     * )
     */
    protected bool $sistema = false;

    /**
     * @ORM\Column(
     *     type="boolean",
     *     nullable=false
     * )
     */
    protected bool $sugerida = false;

    /**
     * @ORM\Column(
     *     type="datetime",
     *     name="data_feriado",
     *     nullable=true
     * )
     */
    protected ?DateTime $dataHoraAceiteSugestao = null;

    /**
     * @var Collection|ArrayCollection|ArrayCollection<VinculacaoEtiqueta>
     *
     * @ORM\OneToMany(
     *     targetEntity="VinculacaoEtiqueta",
     *     mappedBy="etiqueta"
     * )
     */
    protected $vinculacoesEtiquetas;

    /**
     * @var Collection|ArrayCollection|ArrayCollection<Acao>
     *
     * @ORM\OneToMany(
     *     targetEntity="Acao",
     *     mappedBy="etiqueta"
     * )
     */
    protected $acoes;

    /**
     * @var Collection|ArrayCollection|ArrayCollection<RegraEtiqueta>
     *
     * @ORM\OneToMany(
     *     targetEntity="RegraEtiqueta",
     *     mappedBy="etiqueta"
     * )
     */
    protected $regrasEtiqueta;

    /**
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Filter\ToUpper(encoding="UTF-8")
     *
     * @Assert\NotBlank(
     *     message="O campo não pode estar em branco!"
     * )
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     * @Assert\Length(
     *     min = 3,
     *     minMessage = "O campo nome deve ter no mínimo 3 caracteres!",
     *     max = 20,
     *     maxMessage = "O campo nome deve ter no máximo 20 caracteres!"
     * )
     * @ORM\Column(
     *     type="string",
     *     nullable=false
     * )
     */
    protected string $nome = '';

    /**
     * @ORM\Column(
     *     type="boolean",
     *     nullable=true
     * )
     */
    protected ?bool $privada = false;

    /**
     * @ORM\Column(
     *     type="integer",
     *     name="tipo_exec_acao_sugestao",
     *     nullable=true
     * )
     * @Assert\Choice(choices=Etiqueta::TIPO_EXECUCAO_ACAO_SUGESTAO_ALLOWED)
     */
    protected ?int $tipoExecucaoAcaoSugestao = null;

    /**
     * Set nome.
     *
     * @param string $nome
     *
     * @return self
     */
    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome.
     *
     * @return string
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * @return string
     */
    public function getCorHexadecimal(): string
    {
        return $this->corHexadecimal;
    }

    /**
     * @param string $corHexadecimal
     *
     * @return Etiqueta
     */
    public function setCorHexadecimal(string $corHexadecimal): self
    {
        $this->corHexadecimal = $corHexadecimal;

        return $this;
    }

    /**
     * @param ModalidadeEtiqueta $modalidadeEtiqueta
     *
     * @return Etiqueta
     */
    public function setModalidadeEtiqueta(ModalidadeEtiqueta $modalidadeEtiqueta): self
    {
        $this->modalidadeEtiqueta = $modalidadeEtiqueta;

        return $this;
    }

    /**
     * @return ModalidadeEtiqueta
     */
    public function getModalidadeEtiqueta(): ModalidadeEtiqueta
    {
        return $this->modalidadeEtiqueta;
    }

    /**
     * @return bool
     */
    public function getSistema(): bool
    {
        return $this->sistema;
    }

    /**
     * @param bool $sistema
     */
    public function setSistema(bool $sistema): void
    {
        $this->sistema = $sistema;
    }

    /**
     * @return bool
     */
    public function getSugerida(): bool
    {
        return $this->sugerida;
    }

    /**
     * @param bool $sugerida
     */
    public function setSugerida(bool $sugerida): void
    {
        $this->sugerida = $sugerida;
    }

    /**
     * @return DateTime
     */
    public function getDataHoraAceiteSugestao(): DateTime
    {
        return $this->dataHoraAceiteSugestao;
    }

    /**
     * @param DateTime|null $dataHoraAceiteSugestao
     */
    public function setDataHoraAceiteSugestao(?DateTime $dataHoraAceiteSugestao): void
    {
        $this->dataHoraAceiteSugestao = $dataHoraAceiteSugestao;
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
     * @return Etiqueta
     */
    public function addVinculacaoEtiqueta(VinculacaoEtiqueta $vinculacaoEtiqueta): self
    {
        if (!$this->vinculacoesEtiquetas->contains($vinculacaoEtiqueta)) {
            $this->vinculacoesEtiquetas->add($vinculacaoEtiqueta);
            $vinculacaoEtiqueta->setEtiqueta($this);
        }

        return $this;
    }

    /**
     * @param VinculacaoEtiqueta $vinculacaoEtiqueta
     *
     * @return Etiqueta
     */
    public function removeVinculacaoEtiqueta(VinculacaoEtiqueta $vinculacaoEtiqueta): self
    {
        if ($this->vinculacoesEtiquetas->contains($vinculacaoEtiqueta)) {
            $this->vinculacoesEtiquetas->removeElement($vinculacaoEtiqueta);
        }

        return $this;
    }

    /**
     * @return Collection|ArrayCollection|ArrayCollection<Acao>
     */
    public function getAcoes(): Collection
    {
        return $this->acoes;
    }

    /**
     * @param Acao $acao
     *
     * @return Etiqueta
     */
    public function addAcao(Acao $acao): self
    {
        if (!$this->acoes->contains($acao)) {
            $this->acoes->add($acao);
            $acao->setEtiqueta($this);
        }

        return $this;
    }

    /**
     * @param Acao $acao
     *
     * @return Etiqueta
     */
    public function removeAcao(Acao $acao): self
    {
        if ($this->acoes->contains($acao)) {
            $this->acoes->removeElement($acao);
        }

        return $this;
    }

    /**
     * @return Collection|ArrayCollection|ArrayCollection<RegraEtiqueta>
     */
    public function getRegrasEtiqueta(): Collection
    {
        return $this->regrasEtiqueta;
    }

    /**
     * @param RegraEtiqueta $regraEtiqueta
     *
     * @return Etiqueta
     */
    public function addRegraEtiqueta(RegraEtiqueta $regraEtiqueta): self
    {
        if (!$this->regrasEtiqueta->contains($regraEtiqueta)) {
            $this->regrasEtiqueta->add($regraEtiqueta);
            $regraEtiqueta->setEtiqueta($this);
        }

        return $this;
    }

    /**
     * @param RegraEtiqueta $regraEtiqueta
     *
     * @return Etiqueta
     */
    public function removeRegraEtiqueta(RegraEtiqueta $regraEtiqueta): self
    {
        if ($this->regrasEtiqueta->contains($regraEtiqueta)) {
            $this->regrasEtiqueta->removeElement($regraEtiqueta);
        }

        return $this;
    }

    /**
     * @return bool
     */
    public function getPrivada(): ?bool
    {
        return $this->privada;
    }

    /**
     * @param bool $privada
     *
     * @return Etiqueta
     */
    public function setPrivada(bool $privada): self
    {
        $this->privada = $privada;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getTipoExecucaoAcaoSugestao(): ?int
    {
        return $this->tipoExecucaoAcaoSugestao;
    }

    /**
     * @param int|null $tipoExecucaoAcaoSugestao
     * @return $this
     */
    public function setTipoExecucaoAcaoSugestao(?int $tipoExecucaoAcaoSugestao): self
    {
        $this->tipoExecucaoAcaoSugestao = $tipoExecucaoAcaoSugestao;

        return $this;
    }
}
