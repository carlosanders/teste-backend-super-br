<?php

declare(strict_types=1);
/**
 * /src/Api/V1/DTO/Pessoa.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\DTO;

use DateTime;
use DMS\Filter\Rules as Filter;
use JMS\Serializer\Annotation as Serializer;
use Nelmio\ApiDocBundle\Annotation\Model;
use SuppCore\AdministrativoBackend\Api\V1\DTO\ModalidadeGeneroPessoa as ModalidadeGeneroPessoaDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\ModalidadeQualificacaoPessoa as ModalidadeQualificacaoPessoaDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Municipio as MunicipioDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Pais as PaisDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Dossie as DossieDto;
use SuppCore\AdministrativoBackend\DTO\RestDto;
use SuppCore\AdministrativoBackend\DTO\Traits\Blameable;
use SuppCore\AdministrativoBackend\DTO\Traits\IdUuid;
use SuppCore\AdministrativoBackend\DTO\Traits\OrigemDados;
use SuppCore\AdministrativoBackend\DTO\Traits\Timeblameable;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\ModalidadeGeneroPessoa as ModalidadeGeneroPessoaEntity;
use SuppCore\AdministrativoBackend\Entity\ModalidadeQualificacaoPessoa as ModalidadeQualificacaoPessoaEntity;
use SuppCore\AdministrativoBackend\Entity\Municipio as MunicipioEntity;
use SuppCore\AdministrativoBackend\Entity\Pais as PaisEntity;
use SuppCore\AdministrativoBackend\Form\Annotations as Form;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;
use SuppCore\AdministrativoBackend\Validator\Constraints as AppAssert;
use OpenApi\Annotations as OA;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Pessoa.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @AppAssert\DtoUniqueEntity(
 *      fieldMapping = {"numeroDocumentoPrincipal": "numeroDocumentoPrincipal"},
 *      entityClass="SuppCore\AdministrativoBackend\Entity\Pessoa",
 *      message = "CPF/CNPJ já está em utilização!"
 * )
 *
 * @DTOMapper\JsonLD(
 *     jsonLDId="/v1/administrativo/pessoa/{id}",
 *     jsonLDType="Pessoa",
 *     jsonLDContext="/api/doc/#model-Pessoa"
 * )
 *
 * @Assert\Callback({"SuppCore\AdministrativoBackend\Validator\Constraints\PessoaDataValidator", "validate"})
 * @Form\Form()
 */
class Pessoa extends RestDto
{
    use IdUuid;
    use Timeblameable;
    use Blameable;
    use OrigemDados;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Municipio",
     *     required=false
     * )
     *
     * @OA\Property(ref=@Model(type=MunicipioDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Municipio")
     */
    protected ?EntityInterface $naturalidade = null;

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
    protected ?string $profissao = null;

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
    protected ?string $contato = null;

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
    protected bool $pessoaValidada = false;

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
    protected bool $pessoaConveniada = false;

    /**
     * @Serializer\Exclude()
     * @DTOMapper\Property()
     */
    protected ?DateTime $dataHoraIndexacao = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\DateType",
     *     widget="single_text",
     *     format="yyyy-MM-dd",
     *     required=false
     * )
     * 
     * @Assert\GreaterThan("1900-01-01",  message="A data não pode ser menor que 1900-01-01!")
     *
     * @OA\Property(type="string", format="date-time")
     * @DTOMapper\Property()
     */
    protected ?DateTime $dataNascimento = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\DateType",
     *     widget="single_text",
     *     format="yyyy-MM-dd",
     *     required=false
     * )
     *
     * @OA\Property(type="string", format="date-time")
     * @DTOMapper\Property()
     */
    protected ?DateTime $dataObito = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Pais",
     *     required=false
     * )
     *
     * @OA\Property(ref=@Model(type=PaisDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Pais")
     */
    protected ?EntityInterface $nacionalidade = null;

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
     * )     *
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
    protected ?string $nome = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=false
     * )
     *
     * @Filter\Digits()
     *
     * @AppAssert\CpfCnpj()
     *
     * @Assert\Length(
     *     max = 255,
     *     maxMessage = "O campo deve ter no máximo 255 caracteres!"
     * )
     *
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $numeroDocumentoPrincipal = null;

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
    protected ?string $nomeGenitor = null;

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
    protected ?string $nomeGenitora = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\ModalidadeGeneroPessoa",
     *     required=false
     * )
     *
     * @OA\Property(ref=@Model(type=ModalidadeGeneroPessoaDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\ModalidadeGeneroPessoa")
     */
    protected ?EntityInterface $modalidadeGeneroPessoa = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\ModalidadeQualificacaoPessoa",
     *     required=false
     * )
     *
     * @OA\Property(ref=@Model(type=ModalidadeQualificacaoPessoaDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\ModalidadeQualificacaoPessoa")
     */
    protected ?EntityInterface $modalidadeQualificacaoPessoa = null;


    /**
     * @var DossieDTO[]
     *
     * @Serializer\SkipWhenEmpty()
     *
     * @DTOMapper\Property(
     *     dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Dossie",
     *     collection=true,
     *     dtoSetter="addDossie",
     *     dtoGetter="getDossies"
     * )
     */
    protected $dossies = [];

    /**
     * Pessoa constructor.
     */
    public function __construct()
    {
        $this->dossies = [];
    }

    public function getNumeroDocumentoPrincipal(): ?string
    {
        return $this->numeroDocumentoPrincipal;
    }

    public function setNumeroDocumentoPrincipal(?string $numeroDocumentoPrincipal): self
    {
        $this->setVisited('numeroDocumentoPrincipal');

        $this->numeroDocumentoPrincipal = $numeroDocumentoPrincipal;

        return $this;
    }

    /**
     * @return EntityInterface|MunicipioDTO|MunicipioEntity|null
     */
    public function getNaturalidade(): ?EntityInterface
    {
        return $this->naturalidade;
    }

    /**
     * @param EntityInterface|MunicipioDTO|MunicipioEntity|null $naturalidade
     */
    public function setNaturalidade(?EntityInterface $naturalidade): self
    {
        $this->setVisited('naturalidade');

        $this->naturalidade = $naturalidade;

        return $this;
    }

    public function getProfissao(): ?string
    {
        return $this->profissao;
    }

    public function setProfissao(?string $profissao): self
    {
        $this->setVisited('profissao');

        $this->profissao = $profissao;

        return $this;
    }

    public function getContato(): ?string
    {
        return $this->contato;
    }

    public function setContato(?string $contato): self
    {
        $this->setVisited('contato');

        $this->contato = $contato;

        return $this;
    }

    public function getPessoaValidada(): ?bool
    {
        return $this->pessoaValidada;
    }

    public function setPessoaValidada(?bool $pessoaValidada): self
    {
        $this->setVisited('pessoaValidada');

        $this->pessoaValidada = $pessoaValidada;

        return $this;
    }

    public function getPessoaConveniada(): ?bool
    {
        return $this->pessoaConveniada;
    }

    public function setPessoaConveniada(?bool $pessoaConveniada): self
    {
        $this->setVisited('pessoaConveniada');

        $this->pessoaConveniada = $pessoaConveniada;

        return $this;
    }

    public function getDataNascimento(): ?DateTime
    {
        return $this->dataNascimento;
    }

    public function setDataNascimento(?DateTime $dataNascimento): self
    {
        $this->setVisited('dataNascimento');

        $this->dataNascimento = $dataNascimento;

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

    public function getDataObito(): ?DateTime
    {
        return $this->dataObito;
    }

    public function setDataObito(?DateTime $dataObito): self
    {
        $this->setVisited('dataObito');

        $this->dataObito = $dataObito;

        return $this;
    }

    /**
     * @return EntityInterface|PaisDTO|PaisEntity|null
     */
    public function getNacionalidade(): ?EntityInterface
    {
        return $this->nacionalidade;
    }

    /**
     * @param EntityInterface|PaisDTO|PaisEntity|null $nacionalidade
     */
    public function setNacionalidade(?EntityInterface $nacionalidade): self
    {
        $this->setVisited('nacionalidade');

        $this->nacionalidade = $nacionalidade;

        return $this;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(?string $nome): self
    {
        $this->setVisited('nome');

        $this->nome = $nome;

        return $this;
    }

    public function getNomeGenitor(): ?string
    {
        return $this->nomeGenitor;
    }

    public function setNomeGenitor(?string $nomeGenitor): self
    {
        $this->setVisited('nomeGenitor');

        $this->nomeGenitor = $nomeGenitor;

        return $this;
    }

    public function getNomeGenitora(): ?string
    {
        return $this->nomeGenitora;
    }

    public function setNomeGenitora(?string $nomeGenitora): self
    {
        $this->setVisited('nomeGenitora');

        $this->nomeGenitora = $nomeGenitora;

        return $this;
    }

    /**
     * @return EntityInterface|ModalidadeGeneroPessoaDTO|ModalidadeGeneroPessoaEntity|null
     */
    public function getModalidadeGeneroPessoa(): ?EntityInterface
    {
        return $this->modalidadeGeneroPessoa;
    }

    /**
     * @param EntityInterface|ModalidadeGeneroPessoaDTO|ModalidadeGeneroPessoaEntity|null $modalidadeGeneroPessoa
     */
    public function setModalidadeGeneroPessoa(?EntityInterface $modalidadeGeneroPessoa): self
    {
        $this->setVisited('modalidadeGeneroPessoa');

        $this->modalidadeGeneroPessoa = $modalidadeGeneroPessoa;

        return $this;
    }

    /**
     * @return EntityInterface|ModalidadeQualificacaoPessoaDTO|ModalidadeQualificacaoPessoaEntity|null
     */
    public function getModalidadeQualificacaoPessoa(): ?EntityInterface
    {
        return $this->modalidadeQualificacaoPessoa;
    }

    /**
     * @param EntityInterface|ModalidadeQualificacaoPessoaDTO|ModalidadeQualificacaoPessoaEntity|null $modalidadeQualificacaoPessoa
     */
    public function setModalidadeQualificacaoPessoa(?EntityInterface $modalidadeQualificacaoPessoa): self
    {
        $this->setVisited('modalidadeQualificacaoPessoa');

        $this->modalidadeQualificacaoPessoa = $modalidadeQualificacaoPessoa;

        return $this;
    }

    /**
     * @param Dossie $dossie
     * @return $this
     */
    public function addDossie(DossieDTO $dossie): self
    {
        $this->dossies[] = $dossie;

        return $this;
    }

    /**
     * @return array
     */
    public function getDossies(): array
    {
        return $this->dossies;
    }
}
