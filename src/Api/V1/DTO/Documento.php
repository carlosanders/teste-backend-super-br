<?php

declare(strict_types=1);
/**
 * /src/Api/V1/DTO/Documento.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\DTO;

use DateTime;
use DMS\Filter\Rules as Filter;
use JMS\Serializer\Annotation as Serializer;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Annotations as OA;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Documento as DocumentoDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\DocumentoAvulso as DocumentoAvulsoDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Juntada as JuntadaDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\ModalidadeCopia as ModalidadeCopiaDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Modelo as ModeloDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\NumeroUnicoDocumento as NumeroUnicoDocumentoDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Pessoa as PessoaDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Processo as ProcessoDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Repositorio as RepositorioDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Setor as SetorDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Tarefa as TarefaDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\TipoDocumento as TipoDocumentoDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\VinculacaoDocumento as VinculacaoDocumentoDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\VinculacaoEtiqueta as VinculacaoEtiquetaDTO;
use SuppCore\AdministrativoBackend\DTO\RestDto;
use SuppCore\AdministrativoBackend\DTO\Traits\Blameable;
use SuppCore\AdministrativoBackend\DTO\Traits\IdUuid;
use SuppCore\AdministrativoBackend\DTO\Traits\OrigemDados;
use SuppCore\AdministrativoBackend\DTO\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\DTO\Traits\Timeblameable;
use SuppCore\AdministrativoBackend\Entity\Documento as DocumentoEntity;
use SuppCore\AdministrativoBackend\Entity\DocumentoAvulso as DocumentoAvulsoEntity;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\Juntada as JuntadaEntity;
use SuppCore\AdministrativoBackend\Entity\Modelo as ModeloEntity;
use SuppCore\AdministrativoBackend\Entity\NumeroUnicoDocumento as NumeroUnicoDocumentoEntity;
use SuppCore\AdministrativoBackend\Entity\Pessoa as PessoaEntity;
use SuppCore\AdministrativoBackend\Entity\Processo as ProcessoEntity;
use SuppCore\AdministrativoBackend\Entity\Repositorio as RepositorioEntity;
use SuppCore\AdministrativoBackend\Entity\Setor as SetorEntity;
use SuppCore\AdministrativoBackend\Entity\Tarefa as TarefaEntity;
use SuppCore\AdministrativoBackend\Entity\TipoDocumento as TipoDocumentoEntity;
use SuppCore\AdministrativoBackend\Entity\VinculacaoDocumento as VinculacaoDocumentoEntity;
use SuppCore\AdministrativoBackend\Form\Annotations as Form;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Documento.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @DTOMapper\JsonLD(
 *     jsonLDId="/v1/administrativo/documento/{id}",
 *     jsonLDType="Documento",
 *     jsonLDContext="/api/doc/#model-Documento"
 * )
 *
 * @Form\Form()
 */
class Documento extends RestDto
{
    use IdUuid;
    use Timeblameable;
    use Blameable;
    use Softdeleteable;
    use OrigemDados;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\NumberType",
     *     required=false
     * )
     *
     * @OA\Property(type="integer", default=0)
     * @DTOMapper\Property()
     */
    protected int $numeroFolhas = 0;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\DateTimeType",
     *     widget="single_text",
     *     required=false
     * )
     *
     * @OA\Property(type="string", format="date-time")
     * @DTOMapper\Property()
     */
    protected ?DateTime $dataHoraProducao = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=false
     * )
     *
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Campo deve ter no máximo {{ limit }} letras ou números"
     * )
     *
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Filter\ToUpper(encoding="UTF-8")
     *
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $outroNumero = null;

    /**
     * @OA\Property(type="string")
     */
    protected ?string $numeroUnicoDocumentoFormatado = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\CheckboxType",
     *     required=false
     * )
     *
     * @OA\Property(type="boolean", default=false)
     * @DTOMapper\Property()
     */
    protected bool $semEfeito = false;

    /**
     * @OA\Property(type="boolean")
     */
    protected ?bool $assinado = null;

    /**
     * @OA\Property(type="boolean")
     */
    protected ?bool $temAnexos = null;

    /**
     * @OA\Property(type="boolean")
     */
    protected ?bool $estaVinculada = null;

    /**
     * @OA\Property(type="boolean")
     */
    protected ?bool $temEtiquetas = null;

    /**
     * @OA\Property(type="boolean")
     */
    protected ?bool $temComponentesDigitais = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=false
     * )
     *
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Campo deve ter no máximo {{ limit }} letras ou números"
     * )
     *
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Filter\ToUpper(encoding="UTF-8")
     *
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $localizadorOriginal = null;

    /**
     * @OA\Property(ref=@Model(type=DocumentoAvulsoDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\DocumentoAvulso")
     */
    protected ?EntityInterface $documentoAvulsoRemessa = null;

    /**
     * @OA\Property(ref=@Model(type=ModeloDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Modelo")
     */
    protected ?EntityInterface $modelo = null;

    /**
     * @OA\Property(ref=@Model(type=RepositorioDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Repositorio")
     */
    protected ?EntityInterface $repositorio = null;

    /**
     * @OA\Property(ref=@Model(type=JuntadaDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Juntada")
     */
    protected ?EntityInterface $juntadaAtual = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=false
     * )
     *
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Campo deve ter no máximo {{ limit }} letras ou números"
     * )
     *
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Filter\ToUpper(encoding="UTF-8")
     *
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $localProducao = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=false
     * )
     *
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Campo deve ter no máximo {{ limit }} letras ou números"
     * )
     *
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Filter\ToUpper(encoding="UTF-8")
     *
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $autor = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=false
     * )
     *
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Campo deve ter no máximo {{ limit }} letras ou números"
     * )
     *
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Filter\ToUpper(encoding="UTF-8")
     *
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $destinatario = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Processo",
     *     required=false,
     *     methods={
     *          @Form\Method(
     *              "createMethod"
     *          )
     *     }
     * )
     *
     * @OA\Property(ref=@Model(type=ProcessoDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Processo")
     */
    protected ?EntityInterface $processoOrigem = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=false
     * )
     *
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Campo deve ter no máximo {{ limit }} letras ou números"
     * )
     *
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Filter\ToUpper(encoding="UTF-8")
     *
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $redator = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Pessoa",
     *     required=false
     * )
     *
     * @OA\Property(ref=@Model(type=PessoaDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Pessoa")
     */
    protected ?EntityInterface $procedencia = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\NumeroUnicoDocumento",
     *     required=false,
     *     methods={
     *          @Form\Method(
     *              "createMethod"
     *          )
     *     }
     * )
     *
     * @OA\Property(ref=@Model(type=NumeroUnicoDocumentoDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\NumeroUnicoDocumento")
     */
    protected ?EntityInterface $numeroUnicoDocumento = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\TipoDocumento",
     *     required=true
     * )
     *
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @OA\Property(ref=@Model(type=TipoDocumentoDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\TipoDocumento")
     */
    protected ?EntityInterface $tipoDocumento = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=false
     * )
     *
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Campo deve ter no máximo {{ limit }} letras ou números"
     * )
     *
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Filter\ToUpper(encoding="UTF-8")
     *
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $descricaoOutros = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=false
     * )
     *
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Campo deve ter no máximo {{ limit }} letras ou números"
     * )
     *
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Filter\ToUpper(encoding="UTF-8")
     *
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $observacao = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\CheckboxType",
     *     required=false
     * )
     *
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @OA\Property(type="boolean", default=false)
     * @DTOMapper\Property()
     */
    protected ?bool $copia = false;

    /**
     * @OA\Property(type="boolean", default=false)
     */
    protected ?bool $minuta = false;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Setor",
     *     required=false
     * )
     *
     * @OA\Property(ref=@Model(type=SetorDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Setor")
     */
    protected ?EntityInterface $setorOrigem = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Tarefa",
     *     required=false,
     *     methods={
     *          @Form\Method(
     *              "createMethod"
     *          ),
     *          @Form\Method(
     *              "updateMethod",
     *              roles={
     *                  "ROLE_ROOT"
     *              }
     *          ),
     *          @Form\Method(
     *              "patchMethod",
     *              roles={
     *                  "ROLE_ROOT"
     *              }
     *          )
     *     }
     * )
     *
     * @OA\Property(ref=@Model(type=TarefaDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Tarefa")
     */
    protected ?EntityInterface $tarefaOrigem = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Documento",
     *     required=false,
     *     methods={
     *          @Form\Method(
     *              "createMethod"
     *          ),
     *          @Form\Method(
     *              "updateMethod",
     *              roles={
     *                  "ROLE_ROOT"
     *              }
     *          ),
     *          @Form\Method(
     *              "patchMethod",
     *              roles={
     *                  "ROLE_ROOT"
     *              }
     *          )
     *     }
     * )
     *
     * @OA\Property(ref=@Model(type=DocumentoDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Documento")
     */
    protected ?EntityInterface $documentoOrigem = null;

    /**
     * @var ComponenteDigital[]
     *
     * @Serializer\SkipWhenEmpty()
     *
     * @DTOMapper\Property(
     *     dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\ComponenteDigital",
     *     collection=true,
     *     dtoSetter="addComponenteDigital",
     *     dtoGetter="getComponentesDigitais"
     * )
     */
    protected $componentesDigitais = [];

    /**
     * @var VinculacaoDocumento[]
     *
     * @Serializer\SkipWhenEmpty()
     *
     * @DTOMapper\Property(
     *     dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\VinculacaoDocumento",
     *     collection=true,
     *     dtoSetter="addVinculacaoDocumento",
     *     dtoGetter="getVinculacoesDocumentos"
     * )
     */
    protected $vinculacoesDocumentos = [];

    /**
     * @var VinculacaoEtiquetaDTO[]
     *
     * @Serializer\SkipWhenEmpty()
     *
     * @DTOMapper\Property(
     *     dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\VinculacaoEtiqueta",
     *     collection=true,
     *     dtoSetter="addVinculacaoEtiqueta",
     *     dtoGetter="getVinculacoesEtiquetas"
     * )
     */
    protected $vinculacoesEtiquetas = [];

    /**
     * @OA\Property(ref=@Model(type=VinculacaoDocumentoDTO::class))
     */
    protected ?EntityInterface $vinculacaoDocumentoPrincipal = null;

    /**
     * @OA\Property(ref=@Model(type=DocumentoAvulsoDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\DocumentoAvulso")
     */
    protected ?EntityInterface $documentoAvulsoComplementacaoResposta = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\DateTimeType",
     *     widget="single_text",
     *     required=false
     * )
     *
     * @OA\Property(type="string", format="date-time")
     * @DTOMapper\Property()
     */
    protected ?DateTime $dataHoraValidade = null;

    /**
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Filter\ToUpper(encoding="UTF-8")
     *
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $chaveAcesso = null;

    /**
     * Usada na criação do documento, para que tenho acesso restrito no nascimento.
     *
     * @OA\Property(type="boolean")
     * @DTOMapper\Property()
     */
    protected ?bool $acessoRestrito = null;

    /**
     * @OA\Property(type="boolean")
     */
    protected ?bool $acessoNegado = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\ModalidadeCopia",
     *     required=false
     * )
     *
     * @OA\Property(ref=@Model(type=ModalidadeCopiaDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\ModalidadeCopia")
     */
    protected ?EntityInterface $modalidadeCopia = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=false
     * )
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Campo deve ter no máximo {{ limit }} letras ou números"
     * )
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Filter\ToUpper(encoding="UTF-8")
     *
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $dependenciaSoftware = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=false
     * )
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Campo deve ter no máximo {{ limit }} letras ou números"
     * )
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Filter\ToUpper(encoding="UTF-8")
     *
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $dependenciaHardware = null;

    /**
     * Documento constructor.
     */
    public function __construct()
    {
        $this->componentesDigitais = [];
        $this->areasTrabalhos = [];
        $this->vinculacoesDocumentos = [];
        $this->vinculacoesEtiquetas = [];
    }

    public function getNumeroFolhas(): ?int
    {
        return $this->numeroFolhas;
    }

    public function setNumeroFolhas(?int $numeroFolhas): self
    {
        $this->setVisited('numeroFolhas');

        $this->numeroFolhas = $numeroFolhas;

        return $this;
    }

    public function getDataHoraProducao(): ?DateTime
    {
        return $this->dataHoraProducao;
    }

    public function setDataHoraProducao(?DateTime $dataHoraProducao): self
    {
        $this->setVisited('dataHoraProducao');

        $this->dataHoraProducao = $dataHoraProducao;

        return $this;
    }

    public function getOutroNumero(): ?string
    {
        return $this->outroNumero;
    }

    public function setOutroNumero(?string $outroNumero): self
    {
        $this->setVisited('outroNumero');

        $this->outroNumero = $outroNumero;

        return $this;
    }

    public function getSemEfeito(): ?bool
    {
        return $this->semEfeito;
    }

    public function setSemEfeito(?bool $semEfeito): self
    {
        $this->setVisited('semEfeito');

        $this->semEfeito = $semEfeito;

        return $this;
    }

    public function getMinuta(): ?bool
    {
        return $this->minuta;
    }

    public function setMinuta(?bool $minuta): self
    {
        $this->setVisited('minuta');

        $this->minuta = $minuta;

        return $this;
    }

    public function getLocalizadorOriginal(): ?string
    {
        return $this->localizadorOriginal;
    }

    public function setLocalizadorOriginal(?string $localizadorOriginal): self
    {
        $this->setVisited('localizadorOriginal');

        $this->localizadorOriginal = $localizadorOriginal;

        return $this;
    }

    public function getLocalProducao(): ?string
    {
        return $this->localProducao;
    }

    public function setLocalProducao(?string $localProducao): self
    {
        $this->setVisited('localProducao');

        $this->localProducao = $localProducao;

        return $this;
    }

    public function getAutor(): ?string
    {
        return $this->autor;
    }

    public function setAutor(?string $autor): self
    {
        $this->setVisited('autor');

        $this->autor = $autor;

        return $this;
    }

    /**
     * @return EntityInterface|ProcessoDTO|ProcessoEntity|null
     */
    public function getProcessoOrigem(): ?EntityInterface
    {
        return $this->processoOrigem;
    }

    /**
     * @param EntityInterface|ProcessoDTO|ProcessoEntity|null $processoOrigem
     */
    public function setProcessoOrigem(?EntityInterface $processoOrigem): self
    {
        $this->setVisited('processoOrigem');

        $this->processoOrigem = $processoOrigem;

        return $this;
    }

    public function getRedator(): ?string
    {
        return $this->redator;
    }

    public function setRedator(?string $redator): self
    {
        $this->setVisited('redator');

        $this->redator = $redator;

        return $this;
    }

    public function getDestinatario(): ?string
    {
        return $this->destinatario;
    }

    public function setDestinatario(?string $destinatario): self
    {
        $this->setVisited('destinatario');

        $this->destinatario = $destinatario;

        return $this;
    }

    /**
     * @return EntityInterface|PessoaDTO|PessoaEntity|null
     */
    public function getProcedencia(): ?EntityInterface
    {
        return $this->procedencia;
    }

    /**
     * @param EntityInterface|PessoaDTO|PessoaEntity|null $procedencia
     */
    public function setProcedencia(?EntityInterface $procedencia): self
    {
        $this->setVisited('procedencia');

        $this->procedencia = $procedencia;

        return $this;
    }

    /**
     * @return EntityInterface|NumeroUnicoDocumentoDTO|NumeroUnicoDocumentoEntity|null
     */
    public function getNumeroUnicoDocumento(): ?EntityInterface
    {
        return $this->numeroUnicoDocumento;
    }

    /**
     * @param EntityInterface|NumeroUnicoDocumentoDTO|NumeroUnicoDocumentoEntity|null $numeroUnicoDocumento
     */
    public function setNumeroUnicoDocumento(?EntityInterface $numeroUnicoDocumento): self
    {
        $this->setVisited('numeroUnicoDocumento');

        $this->numeroUnicoDocumento = $numeroUnicoDocumento;

        return $this;
    }

    /**
     * @return EntityInterface|TipoDocumentoDTO|TipoDocumentoEntity|null
     */
    public function getTipoDocumento(): ?EntityInterface
    {
        return $this->tipoDocumento;
    }

    /**
     * @param EntityInterface|TipoDocumentoDTO|TipoDocumentoEntity|null $tipoDocumento
     */
    public function setTipoDocumento(?EntityInterface $tipoDocumento): self
    {
        $this->setVisited('tipoDocumento');

        $this->tipoDocumento = $tipoDocumento;

        return $this;
    }

    public function getAssinado(): ?bool
    {
        return $this->assinado;
    }

    public function setAssinado(?bool $assinado): self
    {
        $this->assinado = $assinado;

        return $this;
    }

    public function getTemAnexos(): ?bool
    {
        return $this->temAnexos;
    }

    public function setTemAnexos(?bool $temAnexos): self
    {
        $this->temAnexos = $temAnexos;

        return $this;
    }

    public function getEstaVinculada(): ?bool
    {
        return $this->estaVinculada;
    }

    public function setEstaVinculada(?bool $estaVinculada): self
    {
        $this->estaVinculada = $estaVinculada;

        return $this;
    }

    public function getTemComponentesDigitais(): ?bool
    {
        return $this->temComponentesDigitais;
    }

    public function setTemComponentesDigitais(?bool $temComponentesDigitais): self
    {
        $this->temComponentesDigitais = $temComponentesDigitais;

        return $this;
    }

    public function getTemEtiquetas(): ?bool
    {
        return $this->temEtiquetas;
    }

    public function setTemEtiquetas(?bool $temEtiquetas): self
    {
        $this->temEtiquetas = $temEtiquetas;

        return $this;
    }

    public function getDescricaoOutros(): ?string
    {
        return $this->descricaoOutros;
    }

    public function setDescricaoOutros(?string $descricaoOutros): self
    {
        $this->setVisited('descricaoOutros');

        $this->descricaoOutros = $descricaoOutros;

        return $this;
    }

    public function getObservacao(): ?string
    {
        return $this->observacao;
    }

    public function setObservacao(?string $observacao): self
    {
        $this->setVisited('observacao');

        $this->observacao = $observacao;

        return $this;
    }

    public function getCopia(): ?bool
    {
        return $this->copia;
    }

    public function setCopia(?bool $copia): self
    {
        $this->setVisited('copia');

        $this->copia = $copia;

        return $this;
    }

    /**
     * @return EntityInterface|JuntadaDTO|JuntadaEntity|null
     */
    public function getJuntadaAtual(): ?EntityInterface
    {
        return $this->juntadaAtual;
    }

    /**
     * @param EntityInterface|JuntadaDTO|JuntadaEntity|null $juntadaAtual
     */
    public function setJuntadaAtual(?EntityInterface $juntadaAtual): self
    {
        $this->setVisited('juntadaAtual');

        $this->juntadaAtual = $juntadaAtual;

        return $this;
    }

    /**
     * @return EntityInterface|SetorDTO|SetorEntity|null
     */
    public function getSetorOrigem(): ?EntityInterface
    {
        return $this->setorOrigem;
    }

    /**
     * @param EntityInterface|SetorDTO|SetorEntity|null $setorOrigem
     */
    public function setSetorOrigem(?EntityInterface $setorOrigem): self
    {
        $this->setVisited('setorOrigem');

        $this->setorOrigem = $setorOrigem;

        return $this;
    }

    /**
     * @return EntityInterface|TarefaDTO|TarefaEntity|null
     */
    public function getTarefaOrigem(): ?EntityInterface
    {
        return $this->tarefaOrigem;
    }

    /**
     * @param EntityInterface|TarefaDTO|TarefaEntity|null $tarefaOrigem
     */
    public function setTarefaOrigem(?EntityInterface $tarefaOrigem): self
    {
        $this->setVisited('tarefaOrigem');

        $this->tarefaOrigem = $tarefaOrigem;

        return $this;
    }

    /**
     * @return EntityInterface|Documento|DocumentoEntity|null
     */
    public function getDocumentoOrigem(): ?EntityInterface
    {
        return $this->documentoOrigem;
    }

    /**
     * @param EntityInterface|Documento|DocumentoEntity|null $documentoOrigem
     */
    public function setDocumentoOrigem(?EntityInterface $documentoOrigem): self
    {
        $this->setVisited('documentoOrigem');

        $this->documentoOrigem = $documentoOrigem;

        return $this;
    }

    public function addComponenteDigital(ComponenteDigital $componenteDigital): self
    {
        $this->componentesDigitais[] = $componenteDigital;

        return $this;
    }

    public function getComponentesDigitais(): array
    {
        return $this->componentesDigitais;
    }

    public function addVinculacaoDocumento(VinculacaoDocumento $vinculacaoDocumento): self
    {
        $this->vinculacoesDocumentos[] = $vinculacaoDocumento;

        return $this;
    }

    public function getVinculacoesDocumentos(): array
    {
        return $this->vinculacoesDocumentos;
    }

    /**
     * @return EntityInterface|DocumentoAvulsoDTO|DocumentoAvulsoEntity|null
     */
    public function getDocumentoAvulsoRemessa(): ?EntityInterface
    {
        return $this->documentoAvulsoRemessa;
    }

    /**
     * @param EntityInterface|DocumentoAvulsoDTO|DocumentoAvulsoEntity|null $documentoAvulsoRemessa
     */
    public function setDocumentoAvulsoRemessa(?EntityInterface $documentoAvulsoRemessa): self
    {
        $this->setVisited('documentoAvulsoRemessa');

        $this->documentoAvulsoRemessa = $documentoAvulsoRemessa;

        return $this;
    }

    /**
     * @return EntityInterface|ModeloDTO|ModeloEntity|null
     */
    public function getModelo(): ?EntityInterface
    {
        return $this->modelo;
    }

    /**
     * @param EntityInterface|ModeloDTO|ModeloEntity|null $modelo
     */
    public function setModelo(?EntityInterface $modelo): self
    {
        $this->setVisited('modelo');

        $this->modelo = $modelo;

        return $this;
    }

    /**
     * @return EntityInterface|RepositorioDTO|RepositorioEntity|null
     */
    public function getRepositorio(): ?EntityInterface
    {
        return $this->repositorio;
    }

    /**
     * @param EntityInterface|RepositorioDTO|RepositorioEntity|null $repositorio
     */
    public function setRepositorio(?EntityInterface $repositorio): self
    {
        $this->setVisited('repositorio');

        $this->repositorio = $repositorio;

        return $this;
    }

    /**
     * @return EntityInterface|VinculacaoDocumentoDTO|VinculacaoDocumentoEntity|null
     */
    public function getVinculacaoDocumentoPrincipal(): ?EntityInterface
    {
        return $this->vinculacaoDocumentoPrincipal;
    }

    /**
     * @param EntityInterface|VinculacaoDocumentoDTO|VinculacaoDocumentoEntity|null $vinculacaoDocumentoPrincipal
     */
    public function setVinculacaoDocumentoPrincipal(?EntityInterface $vinculacaoDocumentoPrincipal): self
    {
        $this->setVisited('vinculacaoDocumentoPrincipal');

        $this->vinculacaoDocumentoPrincipal = $vinculacaoDocumentoPrincipal;

        return $this;
    }

    /**
     * @return EntityInterface|DocumentoAvulsoDTO|DocumentoAvulsoEntity|null
     */
    public function getDocumentoAvulsoComplementacaoResposta(): ?EntityInterface
    {
        return $this->documentoAvulsoComplementacaoResposta;
    }

    /**
     * @param EntityInterface|DocumentoAvulsoDTO|DocumentoAvulsoEntity|null $documentoAvulsoComplementacaoResposta
     */
    public function setDocumentoAvulsoComplementacaoResposta(?EntityInterface $documentoAvulsoComplementacaoResposta): self
    {
        $this->setVisited('documentoAvulsoComplementacaoResposta');

        $this->documentoAvulsoComplementacaoResposta = $documentoAvulsoComplementacaoResposta;

        return $this;
    }

    /**
     * @param VinculacaoEtiqueta $vinculacaoEtiqueta
     */
    public function addVinculacaoEtiqueta(VinculacaoEtiquetaDTO $vinculacaoEtiqueta): self
    {
        $this->vinculacoesEtiquetas[] = $vinculacaoEtiqueta;

        return $this;
    }

    public function getVinculacoesEtiquetas(): array
    {
        return $this->vinculacoesEtiquetas;
    }

    public function getNumeroUnicoDocumentoFormatado(): ?string
    {
        return $this->numeroUnicoDocumentoFormatado;
    }

    public function setNumeroUnicoDocumentoFormatado(?string $numeroUnicoDocumentoFormatado): self
    {
        $this->numeroUnicoDocumentoFormatado = $numeroUnicoDocumentoFormatado;

        return $this;
    }

    public function getDataHoraValidade(): ?DateTime
    {
        return $this->dataHoraValidade;
    }

    public function setDataHoraValidade(?DateTime $dataHoraValidade): self
    {
        $this->setVisited('dataHoraValidade');

        $this->dataHoraValidade = $dataHoraValidade;

        return $this;
    }

    public function getChaveAcesso(): ?string
    {
        return $this->chaveAcesso;
    }

    public function setChaveAcesso(?string $chaveAcesso): Documento
    {
        $this->chaveAcesso = $chaveAcesso;

        $this->setVisited('chaveAcesso');

        return $this;
    }

    public function getAcessoRestrito(): ?bool
    {
        return $this->acessoRestrito;
    }

    public function setAcessoRestrito(?bool $acessoRestrito): self
    {
        $this->setVisited('acessoRestrito');

        $this->acessoRestrito = $acessoRestrito;

        return $this;
    }

    public function getAcessoNegado(): ?bool
    {
        return $this->acessoNegado;
    }

    public function setAcessoNegado(?bool $acessoNegado): self
    {
        $this->setVisited('acessoNegado');

        $this->acessoNegado = $acessoNegado;

        return $this;
    }

    /**
     * @return EntityInterface|null
     */
    public function getModalidadeCopia(): ?EntityInterface
    {
        return $this->modalidadeCopia;
    }

    /**
     * @param EntityInterface|null $modalidadeCopia
     *
     * @return Documento
     */
    public function setModalidadeCopia(?EntityInterface $modalidadeCopia): self
    {
        $this->setVisited('modalidadeCopia');
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
     *
     * @return Documento
     */
    public function setDependenciaSoftware(?string $dependenciaSoftware): self
    {
        $this->setVisited('dependenciaSoftware');
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
     *
     * @return Documento
     */
    public function setDependenciaHardware(?string $dependenciaHardware): self
    {
        $this->setVisited('dependenciaHardware');
        $this->dependenciaHardware = $dependenciaHardware;

        return $this;
    }
}
