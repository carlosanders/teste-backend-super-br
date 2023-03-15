<?php

declare(strict_types=1);
/**
 * /src/Api/V1/DTO/ComponenteDigital.php.
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
use SuppCore\AdministrativoBackend\Api\V1\DTO\ModalidadeAlvoInibidor as ModalidadeAlvoInibidorDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\ModalidadeTipoInibidor as ModalidadeTipoInibidorDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Modelo as ModeloDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Processo as ProcessoDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Tarefa as TarefaDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\TipoDocumento as TipoDocumentoDTO;
use SuppCore\AdministrativoBackend\DTO\RestDto;
use SuppCore\AdministrativoBackend\DTO\Traits\Blameable;
use SuppCore\AdministrativoBackend\DTO\Traits\CryptoService;
use SuppCore\AdministrativoBackend\DTO\Traits\FilesystemService;
use SuppCore\AdministrativoBackend\DTO\Traits\IdUuid;
use SuppCore\AdministrativoBackend\DTO\Traits\OrigemDados;
use SuppCore\AdministrativoBackend\DTO\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\DTO\Traits\Timeblameable;
use SuppCore\AdministrativoBackend\Entity\ComponenteDigital as ComponenteDigitalEntity;
use SuppCore\AdministrativoBackend\Entity\Documento as DocumentoEntity;
use SuppCore\AdministrativoBackend\Entity\DocumentoAvulso as DocumentoAvulsoEntity;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\ModalidadeAlvoInibidor as ModalidadeAlvoInibidorEntity;
use SuppCore\AdministrativoBackend\Entity\ModalidadeTipoInibidor as ModalidadeTipoInibidorEntity;
use SuppCore\AdministrativoBackend\Entity\Modelo as ModeloEntity;
use SuppCore\AdministrativoBackend\Entity\Processo as ProcessoEntity;
use SuppCore\AdministrativoBackend\Entity\Tarefa as TarefaEntity;
use SuppCore\AdministrativoBackend\Entity\TipoDocumento as TipoDocumentoEntity;
use SuppCore\AdministrativoBackend\Form\Annotations as Form;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * Class ComponenteDigital.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @DTOMapper\JsonLD(
 *     jsonLDId="/v1/administrativo/componente_digital/{id}",
 *     jsonLDType="ComponenteDigital",
 *     jsonLDContext="/api/doc/#model-ComponenteDigital"
 * )
 *
 * @Form\Form()
 */
class ComponenteDigital extends RestDto
{
    use IdUuid;
    use Blameable;
    use Softdeleteable;
    use Timeblameable;
    use OrigemDados;
    use CryptoService;
    use FilesystemService;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=true
     * )
     *
     * @Assert\NotBlank(
     *      message="Campo não pode estar em branco."
     * )
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     * @Assert\Length(
     *      min = 3,
     *      max = 255,
     *      minMessage = "Campo ter no mínimo {{ limit }} letras ou números",
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
    protected ?string $fileName = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=false
     * )
     *
     * @Filter\Trim()
     *
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $hash = null;

    /**
     * @Serializer\Exclude()
     * @DTOMapper\Property()
     */
    protected ?DateTime $dataHoraIndexacao = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=false
     * )
     *
     * @Serializer\Exclude()
     * @DTOMapper\Property()
     */
    protected ?string $hashAntigo = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\NumberType",
     *     required=false
     * )
     *
     * @OA\Property(type="integer")
     * @DTOMapper\Property()
     */
    protected ?int $numeracaoSequencial = null;

    /**
     * @OA\Property(type="integer")
     * @DTOMapper\Property()
     */
    protected ?int $interacoes = 0;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=false
     * )
     *
     * @Serializer\Accessor(getter="getEncodedConteudo",setter="setConteudo")
     *
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $conteudo = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\NumberType",
     *     required=false
     * )
     *
     * @OA\Property(type="integer")
     * @DTOMapper\Property()
     */
    protected ?int $tamanho = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\NumberType",
     *     required=false
     * )
     *
     * @OA\Property(type="integer")
     * @DTOMapper\Property()
     */
    protected ?int $nivelComposicao = null;

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
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $softwareCriacao = null;

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
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $chaveInibidor = null;

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
    protected ?DateTime $dataHoraSoftwareCriacao = null;

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
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $versaoSoftwareCriacao = null;

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
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $mimetype = null;

    /**
     * @OA\Property(type="string", format="date-time")
     * @DTOMapper\Property()
     */
    protected ?DateTime $dataHoraLockEdicao = null;

    /**
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Campo deve ter no máximo {{ limit }} letras ou números"
     * )
     *
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $usernameLockEdicao = null;

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
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $extensao = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Processo",
     *     required=false
     * )
     *
     * @OA\Property(ref=@Model(type=ProcessoDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Processo")
     */
    protected ?EntityInterface $processoOrigem = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Documento",
     *     required=false
     * )
     * @OA\Property(ref=@Model(type=DocumentoDTO::class))
     */
    protected ?EntityInterface $documentoOrigem = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Tarefa",
     *     required=false
     * )
     *
     * @OA\Property(ref=@Model(type=TarefaDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Tarefa")
     */
    protected ?EntityInterface $tarefaOrigem = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\ComponenteDigital",
     *     required=false
     * )
     *
     * @OA\Property(ref=@Model(type=ComponenteDigital::class))
     */
    protected ?EntityInterface $componenteDigitalOrigem = null;

    /**
     * @Serializer\Exclude()
     *
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\TipoDocumento",
     *     required=false
     * )
     *
     * @OA\Property(ref=@Model(type=TipoDocumentoDTO::class))
     */
    protected ?EntityInterface $tipoDocumento = null;

    /**
     * @Serializer\Exclude()
     *
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Tarefa",
     *     multiple=true,
     *     required=false
     * )
     */
    public $tarefaOrigemBloco = [];

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\DocumentoAvulso",
     *     required=false
     * )
     *
     * @OA\Property(ref=@Model(type=DocumentoAvulsoDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\DocumentoAvulso")
     */
    protected ?EntityInterface $documentoAvulsoOrigem = null;

    /**
     * @Serializer\Exclude()
     *
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\DocumentoAvulso",
     *     multiple=true,
     *     required=false
     * )
     */
    public $documentoAvulsoOrigemBloco = [];

    /**
     * @OA\Property(type="boolean")
     * @DTOMapper\Property()
     */
    protected ?bool $editavel = null;

    /**
     * @OA\Property(type="boolean")
     * @DTOMapper\Property()
     */
    protected ?bool $convertidoPdf = null;

    /**
     * @OA\Property(type="boolean")
     */
    protected ?bool $assinado = null;

    /**
     * @OA\Property(type="boolean")
     */
    protected ?bool $unsafe = null;

    /**
     * @OA\Property(type="boolean")
     */
    protected ?bool $hasBookmark = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\ModalidadeAlvoInibidor",
     *     required=false
     * )
     *
     * @OA\Property(ref=@Model(type=ModalidadeAlvoInibidorDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\ModalidadeAlvoInibidor")
     */
    protected ?EntityInterface $modalidadeAlvoInibidor = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\ModalidadeTipoInibidor",
     *     required=false
     * )
     *
     * @OA\Property(ref=@Model(type=ModalidadeTipoInibidorDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\ModalidadeTipoInibidor")
     */
    protected ?EntityInterface $modalidadeTipoInibidor = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Modelo",
     *     required=false
     * )
     *
     * @OA\Property(ref=@Model(type=ModeloDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Modelo")
     */
    protected ?EntityInterface $modelo = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Documento",
     *     required=false
     * )
     *
     * @OA\Property(ref=@Model(type=DocumentoDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Documento")
     */
    protected ?EntityInterface $documento = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\NumberType",
     *     required=false
     * )
     *
     * @OA\Property(type="integer")
     * @DTOMapper\Property()
     */
    protected ?int $statusVerificacaoVirus = null;

    /**
     * Highlights.
     *
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $highlights = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\CheckboxType",
     *     required=false
     * )
     *
     * @OA\Property(type="boolean", default=true)
     * @Serializer\Exclude
     */
    protected ?bool $geraModeloEmPdf = null;

    /**
     * Atividade constructor.
     */
    public function __construct()
    {
        $this->tarefaOrigemBloco = [];
        $this->documentoAvulsoOrigemBloco = [];
    }

    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function setFileName(?string $fileName): self
    {
        $this->setVisited('fileName');

        $this->fileName = $fileName;

        return $this;
    }

    public function getHash(): ?string
    {
        return $this->hash;
    }

    public function setHash(?string $hash): self
    {
        $this->setVisited('hash');

        $this->hash = $hash;

        return $this;
    }

    public function getHashAntigo(): ?string
    {
        return $this->hashAntigo;
    }

    public function setHashAntigo(?string $hashAntigo): self
    {
        $this->setVisited('hashAntigo');

        $this->hashAntigo = $hashAntigo;

        return $this;
    }

    public function getNumeracaoSequencial(): ?int
    {
        return $this->numeracaoSequencial;
    }

    public function setNumeracaoSequencial(?int $numeracaoSequencial): self
    {
        $this->setVisited('numeracaoSequencial');

        $this->numeracaoSequencial = $numeracaoSequencial;

        return $this;
    }

    public function getInteracoes(): ?int
    {
        return $this->interacoes;
    }

    public function setInteracoes(?int $interacoes): self
    {
        $this->setVisited('interacoes');

        $this->interacoes = $interacoes;

        return $this;
    }

    public function getEncodedConteudo(): ?string
    {
        if ($this->conteudo) {
            $charset = 'utf-8';
            if (!$this->editavel &&
                (('text/html' === $this->mimetype) ||
                    ('text/plain' === $this->mimetype)) &&
                ($detectCharset = mb_detect_encoding($this->conteudo, 'UTF-8, ISO-8859-1'))
            ) {
                $charset = $detectCharset;
            }

            return 'data:'.$this->mimetype.';name='.$this->fileName.';charset='.$charset.';base64,'.base64_encode(
                $this->conteudo
            );
        }

        return $this->conteudo;
    }

    public function getConteudo(): ?string
    {
        return $this->conteudo;
    }

    public function setConteudo(?string $conteudo): self
    {
        $this->setVisited('conteudo');

        $this->conteudo = $conteudo;

        return $this;
    }

    public function getTamanho(): ?int
    {
        return $this->tamanho;
    }

    public function setTamanho(?int $tamanho): self
    {
        $this->setVisited('tamanho');

        $this->tamanho = $tamanho;

        return $this;
    }

    public function getNivelComposicao(): ?int
    {
        return $this->nivelComposicao;
    }

    public function setNivelComposicao(?int $nivelComposicao): self
    {
        $this->setVisited('nivelComposicao');

        $this->nivelComposicao = $nivelComposicao;

        return $this;
    }

    public function getSoftwareCriacao(): ?string
    {
        return $this->softwareCriacao;
    }

    public function setSoftwareCriacao(?string $softwareCriacao): self
    {
        $this->setVisited('softwareCriacao');

        $this->softwareCriacao = $softwareCriacao;

        return $this;
    }

    public function getChaveInibidor(): ?string
    {
        return $this->chaveInibidor;
    }

    public function setChaveInibidor(?string $chaveInibidor): self
    {
        $this->setVisited('chaveInibidor');

        $this->chaveInibidor = $chaveInibidor;

        return $this;
    }

    public function getDataHoraSoftwareCriacao(): ?DateTime
    {
        return $this->dataHoraSoftwareCriacao;
    }

    public function setDataHoraSoftwareCriacao(?DateTime $dataHoraSoftwareCriacao): self
    {
        $this->setVisited('dataHoraSoftwareCriacao');

        $this->dataHoraSoftwareCriacao = $dataHoraSoftwareCriacao;

        return $this;
    }

    public function getVersaoSoftwareCriacao(): ?string
    {
        return $this->versaoSoftwareCriacao;
    }

    public function setVersaoSoftwareCriacao(?string $versaoSoftwareCriacao): self
    {
        $this->setVisited('versaoSoftwareCriacao');

        $this->versaoSoftwareCriacao = $versaoSoftwareCriacao;

        return $this;
    }

    public function getMimetype(): ?string
    {
        return $this->mimetype;
    }

    public function setMimetype(?string $mimetype): self
    {
        $this->setVisited('mimetype');

        $this->mimetype = $mimetype;

        return $this;
    }

    public function getDataHoraLockEdicao(): ?DateTime
    {
        return $this->dataHoraLockEdicao;
    }

    public function setDataHoraLockEdicao(?DateTime $dataHoraLockEdicao): self
    {
        $this->setVisited('dataHoraLockEdicao');

        $this->dataHoraLockEdicao = $dataHoraLockEdicao;

        return $this;
    }

    public function getUsernameLockEdicao(): ?string
    {
        return $this->usernameLockEdicao;
    }

    public function setUsernameLockEdicao(?string $usernameLockEdicao): self
    {
        $this->setVisited('usernameLockEdicao');

        $this->usernameLockEdicao = $usernameLockEdicao;

        return $this;
    }

    public function getExtensao(): ?string
    {
        return $this->extensao;
    }

    public function setExtensao(?string $extensao): self
    {
        $this->setVisited('extensao');

        $this->extensao = $extensao;

        return $this;
    }

    public function getEditavel(): ?bool
    {
        return $this->editavel;
    }

    public function setEditavel(?bool $editavel): self
    {
        $this->setVisited('editavel');

        $this->editavel = $editavel;

        return $this;
    }

    public function getConvertidoPdf(): ?bool
    {
        return $this->convertidoPdf;
    }

    public function setConvertidoPdf(?bool $convertidoPdf): self
    {
        $this->setVisited('convertidoPdf');

        $this->convertidoPdf = $convertidoPdf;

        return $this;
    }

    public function getAssinado(): ?bool
    {
        return $this->assinado;
    }

    public function setAssinado(?bool $assinado): self
    {
        $this->setVisited('assinado');

        $this->assinado = $assinado;

        return $this;
    }

    public function getUnsafe(): ?bool
    {
        return $this->unsafe;
    }

    public function setUnsafe(?bool $unsafe): self
    {
        $this->setVisited('unsafe');

        $this->unsafe = $unsafe;

        return $this;
    }

    public function getHasBookmark(): ?bool
    {
        return $this->hasBookmark;
    }

    public function setHasBookmark(?bool $hasBookmark): self
    {
        $this->setVisited('hasBookmark');

        $this->hasBookmark = $hasBookmark;

        return $this;
    }

    /**
     * @return EntityInterface|ModalidadeAlvoInibidorDTO|ModalidadeAlvoInibidorEntity|null
     */
    public function getModalidadeAlvoInibidor(): ?EntityInterface
    {
        return $this->modalidadeAlvoInibidor;
    }

    /**
     * @param EntityInterface|ModalidadeAlvoInibidorDTO|ModalidadeAlvoInibidorEntity|null $modalidadeAlvoInibidor
     */
    public function setModalidadeAlvoInibidor(?EntityInterface $modalidadeAlvoInibidor): self
    {
        $this->setVisited('modalidadeAlvoInibidor');

        $this->modalidadeAlvoInibidor = $modalidadeAlvoInibidor;

        return $this;
    }

    /**
     * @return EntityInterface|ModalidadeTipoInibidorDTO|ModalidadeTipoInibidorEntity|null
     */
    public function getModalidadeTipoInibidor(): ?EntityInterface
    {
        return $this->modalidadeTipoInibidor;
    }

    /**
     * @param EntityInterface|ModalidadeTipoInibidorDTO|ModalidadeTipoInibidorEntity|null $modalidadeTipoInibidor
     */
    public function setModalidadeTipoInibidor(?EntityInterface $modalidadeTipoInibidor): self
    {
        $this->setVisited('modalidadeTipoInibidor');

        $this->modalidadeTipoInibidor = $modalidadeTipoInibidor;

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
     * @return EntityInterface|DocumentoDTO|DocumentoEntity|null
     */
    public function getDocumento(): ?EntityInterface
    {
        return $this->documento;
    }

    /**
     * @param EntityInterface|DocumentoDTO|DocumentoEntity|null $documento
     */
    public function setDocumento(?EntityInterface $documento): self
    {
        $this->setVisited('documento');

        $this->documento = $documento;

        return $this;
    }

    public function getDataHoraIndexacao(): ?DateTime
    {
        return $this->dataHoraIndexacao;
    }

    public function setDataHoraIndexacao(?DateTime $dataHoraIndexacao): self
    {
        $this->setVisited('dataHoraIndexacao');

        $this->dataHoraIndexacao = $dataHoraIndexacao;

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

    /**
     * @return EntityInterface|DocumentoDTO|DocumentoEntity|null
     */
    public function getDocumentoOrigem(): ?EntityInterface
    {
        return $this->documentoOrigem;
    }

    /**
     * @param EntityInterface|DocumentoDTO|DocumentoEntity|null $documentoOrigem
     */
    public function setDocumentoOrigem(?EntityInterface $documentoOrigem): self
    {
        $this->setVisited('documentoOrigem');

        $this->documentoOrigem = $documentoOrigem;

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

    /**
     * @param EntityInterface|TarefaDTO|TarefaEntity|null $tarefaOrigemBloco
     */
    public function addTarefaOrigemBloco(?EntityInterface $tarefaOrigemBloco): self
    {
        $this->tarefaOrigemBloco[] = $tarefaOrigemBloco;

        return $this;
    }

    /**
     * @return self
     */
    public function resetTarefaOrigemBloco()
    {
        $this->tarefaOrigemBloco = [];

        return $this;
    }

    /**
     * @return array
     */
    public function getTarefaOrigemBloco()
    {
        return $this->tarefaOrigemBloco;
    }

    /**
     * @return EntityInterface|DocumentoAvulsoDTO|DocumentoAvulsoEntity|null
     */
    public function getDocumentoAvulsoOrigem(): ?EntityInterface
    {
        return $this->documentoAvulsoOrigem;
    }

    /**
     * @param EntityInterface|DocumentoAvulsoDTO|DocumentoAvulsoEntity|null $documentoAvulsoOrigem
     */
    public function setDocumentoAvulsoOrigem(?EntityInterface $documentoAvulsoOrigem): self
    {
        $this->setVisited('documentoAvulsoOrigem');

        $this->documentoAvulsoOrigem = $documentoAvulsoOrigem;

        return $this;
    }

    /**
     * @param EntityInterface|DocumentoAvulsoDTO|DocumentoAvulsoEntity|null $documentoAvulsoOrigemBloco
     */
    public function addDocumentoAvulsoOrigemBloco(?EntityInterface $documentoAvulsoOrigemBloco): self
    {
        $this->documentoAvulsoOrigemBloco[] = $documentoAvulsoOrigemBloco;

        return $this;
    }

    /**
     * @return self
     */
    public function resetDocumentoAvulsoOrigemBloco()
    {
        $this->documentoAvulsoOrigemBloco = [];

        return $this;
    }

    /**
     * @return array
     */
    public function getDocumentoAvulsoOrigemBloco()
    {
        return $this->documentoAvulsoOrigemBloco;
    }

    /**
     * Set highlights.
     */
    public function setHighlights(?string $highlights): self
    {
        $this->setVisited('highlights');

        $this->highlights = $highlights;

        return $this;
    }

    /**
     * Get highlights.
     */
    public function getHighlights(): ?string
    {
        return $this->highlights;
    }

    /**
     * @return EntityInterface|ComponenteDigital|ComponenteDigitalEntity|null
     */
    public function getComponenteDigitalOrigem(): ?EntityInterface
    {
        return $this->componenteDigitalOrigem;
    }

    /**
     * @param EntityInterface|ComponenteDigital|ComponenteDigitalEntity|null $componenteDigitalOrigem
     */
    public function setComponenteDigitalOrigem(?EntityInterface $componenteDigitalOrigem): self
    {
        $this->setVisited('componenteDigitalOrigem');

        $this->componenteDigitalOrigem = $componenteDigitalOrigem;

        return $this;
    }

    /**
     * @Assert\Callback
     */
    public function isValid(ExecutionContextInterface $context): void
    {
        if (!$this->getId() && !$this->getConteudo() && !$this->getModelo() &&
            !$this->getComponenteDigitalOrigem() && !$this->getHash()) {
            $context->buildViolation(
                'O componente digital deve ter conteúdo (upload), hash (reaproveitamento), componente digital de origem (clone com reprocessamento), ou modelo!'
            )
                ->atPath('id')
                ->addViolation();
        }
    }

    /**
     * @return bool|null
     */
    public function getGeraModeloEmPdf(): ?bool
    {
        return $this->geraModeloEmPdf;
    }

    /**
     * @param bool|null $geraModeloEmPdf
     *
     * @return self
     */
    public function setGeraModeloEmPdf(?bool $geraModeloEmPdf): self
    {
        $this->geraModeloEmPdf = $geraModeloEmPdf;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getStatusVerificacaoVirus(): ?int
    {
        return $this->statusVerificacaoVirus;
    }

    /**
     * @param int|null $statusVerificacaoVirus
     *
     * @return self
     */
    public function setStatusVerificacaoVirus(?int $statusVerificacaoVirus): self
    {
        $this->setVisited('statusVerificacaoVirus');
        $this->statusVerificacaoVirus = $statusVerificacaoVirus;

        return $this;
    }
}
