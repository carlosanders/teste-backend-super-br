<?php /** @noinspection PhpUnused */

declare(strict_types=1);
/**
 * /src/Entity/VinculacaoEtiqueta.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Entity\Traits;

use DateTime;
use DMS\Filter\Rules as Filter;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use SuppCore\AdministrativoBackend\Entity\Etiqueta;
use SuppCore\AdministrativoBackend\Entity\ModalidadeOrgaoCentral;
use SuppCore\AdministrativoBackend\Entity\RegraEtiqueta;
use SuppCore\AdministrativoBackend\Entity\Setor;
use SuppCore\AdministrativoBackend\Entity\Usuario;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Trait VinculacaoEtiqueta.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
trait VinculacaoEtiqueta 
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
     * @Assert\Length(
     *     max = 4000,
     *     maxMessage = "O campo deve ter no máximo {{ limit }} caracteres!"
     * )
     *
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Filter\ToUpper(encoding="UTF-8")
     * @ORM\Column(
     *     type="text",
     *     nullable=true
     * )
     */
    protected ?string $conteudo = null;

    /**
     * @ORM\Column(
     *     name="data_expiracao",
     *     type="datetime",
     *     nullable=true
     * )
     */
    protected ?DateTime $dataHoraExpiracao = null;

    /**
     * @ORM\Column(
     *     type="boolean",
     *     nullable=true
     * )
     */
    protected bool $privada = false;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="SuppCore\AdministrativoBackend\Entity\Usuario",
     *     inversedBy="vinculacoesEtiquetas"
     * )
     * @ORM\JoinColumn(
     *     name="usuario_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?Usuario $usuario = null;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="SuppCore\AdministrativoBackend\Entity\Setor",
     *     inversedBy="vinculacoesEtiquetas"
     * )
     * @ORM\JoinColumn(
     *     name="setor_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?Setor $setor = null;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="SuppCore\AdministrativoBackend\Entity\Setor"
     * )
     * @ORM\JoinColumn(
     *     name="unidade_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?Setor $unidade = null;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="SuppCore\AdministrativoBackend\Entity\ModalidadeOrgaoCentral",
     *     inversedBy="vinculacoesEtiquetas"
     * )
     * @ORM\JoinColumn(
     *     name="mod_orgao_central_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?ModalidadeOrgaoCentral $modalidadeOrgaoCentral = null;

    /**
     * @ORM\Column(
     *     type="text",
     *     name="object_class",
     *     nullable=true
     * )
     */
    protected ?string $objectClass = null;

    /**
     * @ORM\Column(
     *     type="text",
     *     name="object_uuid",
     *     nullable=true
     * )
     */
    protected ?string $objectUuid = null;

    /**
     * @ORM\Column(
     *     type="text",
     *     name="extension_object_class",
     *     nullable=true
     * )
     */
    protected ?string $extensionObjectClass = null;

    /**
     * @ORM\Column(
     *     type="text",
     *     name="extension_object_uuid",
     *     nullable=true
     * )
     */
    protected ?string $extensionObjectUuid = null;


    /**
     * @ORM\Column(
     *     type="text",
     *     nullable=true
     * )
     */
    protected ?string $label = null;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="SuppCore\AdministrativoBackend\Entity\RegraEtiqueta"
     * )
     * @ORM\JoinColumn(
     *     name="regra_etiqueta_origem_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?RegraEtiqueta $regraEtiquetaOrigem = null;

    /**
     * @ORM\Column(
     *     type="boolean",
     *     nullable=true
     * )
     */
    protected ?bool $sugestao = null;

    /**
     * @ORM\Column(
     *     type="datetime",
     *     name="data_hora_aprov_sugestao",
     *     nullable=true
     * )
     */
    protected ?DateTime $dataHoraAprovacaoSugestao = null;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="SuppCore\AdministrativoBackend\Entity\Usuario"
     * )
     * @ORM\JoinColumn(
     *     name="usuario_aprov_sugestao_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?Usuario $usuarioAprovacaoSugestao = null;

    /**
     * @ORM\Column(
     *     name="acoes_execucao_sugestao",
     *     type="text",
     *     nullable=true
     * )
     */
    protected ?string $acoesExecucaoSugestao = null;


    /**
     * @return Etiqueta|null
     */
    public function getEtiqueta(): ?Etiqueta
    {
        return $this->etiqueta;
    }

    /**
     * @param Etiqueta|null $etiqueta
     *
     * @return self
     */
    public function setEtiqueta(?Etiqueta $etiqueta): self
    {
        $this->etiqueta = $etiqueta;

        return $this;
    }


    /**
     * @return Usuario|null
     */
    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    /**
     * @param Usuario|null $usuario
     *
     * @return self
     */
    public function setUsuario(?Usuario $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }
    

    /**
     * @return Setor|null
     */
    public function getSetor(): ?Setor
    {
        return $this->setor;
    }

    /**
     * @param Setor|null $setor
     *
     * @return self
     */
    public function setSetor(?Setor $setor): self
    {
        $this->setor = $setor;

        return $this;
    }

    /**
     * @return Setor|null
     */
    public function getUnidade(): ?Setor
    {
        return $this->unidade;
    }

    /**
     * @param Setor|null $unidade
     *
     * @return self
     */
    public function setUnidade(?Setor $unidade): self
    {
        $this->unidade = $unidade;

        return $this;
    }
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
     * @return self
     */
    public function setModalidadeOrgaoCentral(?ModalidadeOrgaoCentral $modalidadeOrgaoCentral): self
    {
        $this->modalidadeOrgaoCentral = $modalidadeOrgaoCentral;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getConteudo(): ?string
    {
        return $this->conteudo;
    }

    /**
     * @param string|null $conteudo
     *
     * @return self
     */
    public function setConteudo(?string $conteudo): self
    {
        $this->conteudo = $conteudo;

        return $this;
    }

    /**
     * @return bool
     */
    public function getPrivada(): bool
    {
        return $this->privada;
    }

    /**
     * @param bool $privada
     *
     * @return self
     */
    public function setPrivada(bool $privada): self
    {
        $this->privada = $privada;

        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getDataHoraExpiracao(): ?DateTime
    {
        return $this->dataHoraExpiracao;
    }

    /**
     * @param DateTime|null $dataHoraExpiracao
     *
     * @return self
     */
    public function setDataHoraExpiracao(?DateTime $dataHoraExpiracao): self
    {
        $this->dataHoraExpiracao = $dataHoraExpiracao;

        return $this;
    }
    
    /**
     * @return string|null
     */
    public function getObjectClass(): ?string
    {
        return $this->objectClass;
    }

    /**
     * @param string|null $objectClass
     *
     * @return self
     */
    public function setObjectClass(?string $objectClass): self
    {
        $this->objectClass = $objectClass;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getObjectUuid(): ?string
    {
        return $this->objectUuid;
    }

    /**
     * @param string|null $objectUuid
     *
     * @return self
     */
    public function setObjectUuid(?string $objectUuid): self
    {
        $this->objectUuid = $objectUuid;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * @param string|null $label
     *
     * @return self
     */
    public function setLabel(?string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return RegraEtiqueta|null
     */
    public function getRegraEtiquetaOrigem(): ?RegraEtiqueta
    {
        return $this->regraEtiquetaOrigem;
    }

    /**
     * @param RegraEtiqueta|null $regraEtiquetaOrigem
     *
     * @return self
     */
    public function setRegraEtiquetaOrigem(?RegraEtiqueta $regraEtiquetaOrigem): self
    {
        $this->regraEtiquetaOrigem = $regraEtiquetaOrigem;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getSugestao(): ?bool
    {
        return $this->sugestao;
    }

    /**
     * @param bool|null $sugestao
     *
     * @return self
     */
    public function setSugestao(?bool $sugestao): self
    {
        $this->sugestao = $sugestao;

        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getDataHoraAprovacaoSugestao(): ?DateTime
    {
        return $this->dataHoraAprovacaoSugestao;
    }

    /**
     * @param DateTime|null $dataHoraAprovacaoSugestao
     *
     * @return self
     */
    public function setDataHoraAprovacaoSugestao(?DateTime $dataHoraAprovacaoSugestao): self
    {
        $this->dataHoraAprovacaoSugestao = $dataHoraAprovacaoSugestao;

        return $this;
    }

    /**
     * @return Usuario|null
     */
    public function getUsuarioAprovacaoSugestao(): ?Usuario
    {
        return $this->usuarioAprovacaoSugestao;
    }

    /**
     * @param Usuario|null $usuarioAprovacaoSugestao
     *
     * @return self
     */
    public function setUsuarioAprovacaoSugestao(?Usuario $usuarioAprovacaoSugestao): self
    {
        $this->usuarioAprovacaoSugestao = $usuarioAprovacaoSugestao;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAcoesExecucaoSugestao(): ?string
    {
        return $this->acoesExecucaoSugestao;
    }

    /**
     * @param string|null $acoesExecucaoSugestao
     * @return $this
     */
    public function setAcoesExecucaoSugestao(?string $acoesExecucaoSugestao): self
    {
        $this->acoesExecucaoSugestao = $acoesExecucaoSugestao;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getExtensionObjectClass(): ?string
    {
        return $this->extensionObjectClass;
    }

    /**
     * @param string|null $extensionObjectClass
     * @return $this
     */
    public function setExtensionObjectClass(?string $extensionObjectClass): self
    {
        $this->extensionObjectClass = $extensionObjectClass;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getExtensionObjectUuid(): ?string
    {
        return $this->extensionObjectUuid;
    }

    /**
     * @param string|null $extensionObjectUuid
     * @return $this
     */
    public function setExtensionObjectUuid(?string $extensionObjectUuid): self
    {
        $this->extensionObjectUuid = $extensionObjectUuid;

        return $this;
    }
}
