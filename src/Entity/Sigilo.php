<?php

declare(strict_types=1);
/**
 * /src/Entity/Sigilo.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Entity;

use DateTime;
use DMS\Filter\Rules as Filter;
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
 * Class Sigilo.
 *
 *  @ORM\Table(
 *     name="ad_sigilo",
 * )
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 * @Gedmo\Loggable
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Sigilo implements EntityInterface
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
     * @Gedmo\Versioned
     * @ORM\Column(
     *     type="boolean",
     *     nullable=false
     * )
     */
    protected bool $desclassificado = false;

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
    protected ?string $observacao = null;

    /**
     * 1. A 1ª parte do CIDIC deve prever número deposições que atendam ao
     * Número Único de Protocolo–NUP, que é um código exclusivamente numérico;
     * 2. A 2ª parte do CIDIC,separada da 1ª parte por um “.”, iniciará sempre
     * por um caracter alfabético (“U”, “S” ou “R”) e deverá prever até o
     * máximo de 39 posições, com caracteres alfanuméricos e separadores;
     * 3. Os separadores utilizados serão: “.” e “/” para as datas;
     * 4. Para as informações classificadas no grau reservado e secreto,
     * a 2ª parte do CIDIC terá sempre 28 posições com caracteres alfanuméricos
     * e separadores;
     * 5. Para as informações classificadas no grau ultrassecreto, a 2ª parte do
     * CIDIC terá 28 posições com caracteres alfanuméricos e separadores,
     * enquanto não ocorrer prorrogação do prazo do sigilo;
     * 6. Quando ocorrer a prorrogação do prazo de sigilo da informação
     * classificada no grau ultrasecreto, a nova data deverá constar no final da
     * 2ª parte do CIDIC, totalizando as 39 posições com caracteres
     * alfanuméricos e separadores;.
     *
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
     *     name="codigo_indexacao",
     *     nullable=true
     * )
     */
    protected ?string $codigoIndexacao = null;

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
     *     name="fundamento_legal",
     *     nullable=false
     * )
     */
    protected string $fundamentoLegal;

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
     *     name="razoes_classif_sigilo",
     *     nullable=true
     * )
     */
    protected ?string $razoesClassificacaoSigilo = null;

    /**
     * @Assert\NotNull(
     *     message="A data/hora de validade do sigilo não pode ser nula!"
     * )
     * @ORM\Column(
     *     type="datetime",
     *     name="data_hora_validade_sigilo",
     *     nullable=false
     * )
     */
    protected DateTime $dataHoraValidadeSigilo;

    /**
     * @Assert\NotNull(
     *     message="A data/hora de início do sigilo não pode ser nula!"
     * )
     * @ORM\Column(
     *     type="datetime",
     *     name="data_hora_inicio_sigilo",
     *     nullable=false
     * )
     */
    protected DateTime $dataHoraInicioSigilo;

    /**
     * @Assert\NotNull(
     *     message="Campo não pode ser nulo!"
     * )
     * @Assert\Range(
     *     min = 0,
     *     max = 4,
     *     notInRangeMessage = "Campo ser entre {{ min }} e {{ max }}"
     * )
     * @ORM\Column(
     *     type="integer",
     *     name="nivel_acesso",
     *     nullable=false
     * )
     */
    protected int $nivelAcesso;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="ModalidadeCategoriaSigilo"
     * )
     * @ORM\JoinColumn(
     *     name="mod_categoria_sigilo_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?ModalidadeCategoriaSigilo $modalidadeCategoriaSigilo = null;

    /**
     * @Assert\NotNull(
     *     message="Campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(
     *     targetEntity="TipoSigilo"
     * )
     * @ORM\JoinColumn(
     *     name="tipo_sigilo_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected TipoSigilo $tipoSigilo;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="Processo",
     *     inversedBy="sigilos"
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
     *     targetEntity="Documento",
     *     inversedBy="sigilos"
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
     * @return bool
     */
    public function getDesclassificado(): bool
    {
        return $this->desclassificado;
    }

    /**
     * @param bool $desclassificado
     *
     * @return Sigilo
     */
    public function setDesclassificado(bool $desclassificado): self
    {
        $this->desclassificado = $desclassificado;

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
     * @return Sigilo
     */
    public function setObservacao(?string $observacao): self
    {
        $this->observacao = $observacao;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCodigoIndexacao(): ?string
    {
        return $this->codigoIndexacao;
    }

    /**
     * @param string|null $codigoIndexacao
     *
     * @return Sigilo
     */
    public function setCodigoIndexacao(?string $codigoIndexacao): self
    {
        $this->codigoIndexacao = $codigoIndexacao;

        return $this;
    }

    /**
     * @return string
     */
    public function getFundamentoLegal(): string
    {
        return $this->fundamentoLegal;
    }

    /**
     * @param string $fundamentoLegal
     *
     * @return Sigilo
     */
    public function setFundamentoLegal(string $fundamentoLegal): self
    {
        $this->fundamentoLegal = $fundamentoLegal;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getRazoesClassificacaoSigilo(): ?string
    {
        return $this->razoesClassificacaoSigilo;
    }

    /**
     * @param string|null $razoesClassificacaoSigilo
     *
     * @return Sigilo
     */
    public function setRazoesClassificacaoSigilo(?string $razoesClassificacaoSigilo): self
    {
        $this->razoesClassificacaoSigilo = $razoesClassificacaoSigilo;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDataHoraValidadeSigilo(): DateTime
    {
        return $this->dataHoraValidadeSigilo;
    }

    /**
     * @param DateTime $dataHoraValidadeSigilo
     *
     * @return Sigilo
     */
    public function setDataHoraValidadeSigilo(DateTime $dataHoraValidadeSigilo): self
    {
        $this->dataHoraValidadeSigilo = $dataHoraValidadeSigilo;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDataHoraInicioSigilo(): DateTime
    {
        return $this->dataHoraInicioSigilo;
    }

    /**
     * @param DateTime $dataHoraInicioSigilo
     *
     * @return Sigilo
     */
    public function setDataHoraInicioSigilo(DateTime $dataHoraInicioSigilo): self
    {
        $this->dataHoraInicioSigilo = $dataHoraInicioSigilo;

        return $this;
    }

    /**
     * @return int
     */
    public function getNivelAcesso(): int
    {
        return $this->nivelAcesso;
    }

    /**
     * @param int $nivelAcesso
     *
     * @return Sigilo
     */
    public function setNivelAcesso(int $nivelAcesso): self
    {
        $this->nivelAcesso = $nivelAcesso;

        return $this;
    }

    /**
     * @return ModalidadeCategoriaSigilo|null
     */
    public function getModalidadeCategoriaSigilo(): ?ModalidadeCategoriaSigilo
    {
        return $this->modalidadeCategoriaSigilo;
    }

    /**
     * @param ModalidadeCategoriaSigilo|null $modalidadeCategoriaSigilo
     *
     * @return Sigilo
     */
    public function setModalidadeCategoriaSigilo(?ModalidadeCategoriaSigilo $modalidadeCategoriaSigilo): self
    {
        $this->modalidadeCategoriaSigilo = $modalidadeCategoriaSigilo;

        return $this;
    }

    /**
     * @return TipoSigilo
     */
    public function getTipoSigilo(): TipoSigilo
    {
        return $this->tipoSigilo;
    }

    /**
     * @param TipoSigilo $tipoSigilo
     *
     * @return Sigilo
     */
    public function setTipoSigilo(TipoSigilo $tipoSigilo): self
    {
        $this->tipoSigilo = $tipoSigilo;

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
     * @return Sigilo
     */
    public function setProcesso(?Processo $processo): self
    {
        $this->processo = $processo;

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
     * @return Sigilo
     */
    public function setDocumento(?Documento $documento): self
    {
        $this->documento = $documento;

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
     * @return Sigilo
     */
    public function setOrigemDados(?OrigemDados $origemDados): self
    {
        $this->origemDados = $origemDados;

        return $this;
    }
}
