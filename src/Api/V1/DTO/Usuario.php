<?php

declare(strict_types=1);
/**
 * /src/Rest/DTO/Usuario.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\DTO;

use DateTime;
use DMS\Filter\Rules as Filter;
use JMS\Serializer\Annotation as Serializer;
use Nelmio\ApiDocBundle\Annotation\Model;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Colaborador as ColaboradorDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\ComponenteDigital as ComponenteDigitalDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Coordenador as CoordenadorDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\VinculacaoPessoaUsuario as VinculacaoPessoaUsuarioDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\VinculacaoUsuario as VinculacaoUsuarioDTO;
use SuppCore\AdministrativoBackend\DTO\RestDto;
use SuppCore\AdministrativoBackend\DTO\Traits\Blameable;
use SuppCore\AdministrativoBackend\DTO\Traits\IdUuid;
use SuppCore\AdministrativoBackend\DTO\Traits\Timeblameable;
use SuppCore\AdministrativoBackend\Entity\Colaborador as ColaboradorEntity;
use SuppCore\AdministrativoBackend\Entity\ComponenteDigital as ComponenteDigitalEntity;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Form\Annotations as Form;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;
use SuppCore\AdministrativoBackend\Mapper\Annotations\Mapper;
use SuppCore\AdministrativoBackend\Validator\Constraints as AppAssert;
use OpenApi\Annotations as OA;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Usuario.
 *
 * @AppAssert\DtoUniqueEntity(
 *      fieldMapping = {"email": "email"},
 *      entityClass="SuppCore\AdministrativoBackend\Entity\Usuario",
 *      message = "Email já está em utilização!"
 * )
 *
 * @AppAssert\DtoUniqueEntity(
 *      fieldMapping = {"username": "username"},
 *      entityClass="SuppCore\AdministrativoBackend\Entity\Usuario",
 *      message = "CPF já está em utilização!"
 * )
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @Mapper(class="SuppCore\AdministrativoBackend\Api\V1\Mapper\Usuario")
 *
 * @DTOMapper\JsonLD(
 *     jsonLDId="/v1/administrativo/usuario/{id}",
 *     jsonLDType="Usuario",
 *     jsonLDContext="/api/doc/#model-Usuario"
 * )
 *
 * @Form\Form()
 */
class Usuario extends RestDto
{
    use IdUuid;
    use Timeblameable;
    use Blameable;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=true,
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
     * @Filter\Digits()
     *
     * @Assert\Length(
     *     min = 11,
     *     minMessage = "O campo deve ter no mínimo 11 caracteres!",
     *     max = 11,
     *     maxMessage = "O campo deve ter no máximo 11 caracteres!"
     * )
     * @AppAssert\CpfCnpj()
     *
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $username = '';

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=true,
     *     methods={
     *          @Form\Method(
     *              "createMethod"
     *          ),
     *          @Form\Method(
     *              "updateMethod",
     *              roles={
     *                  "ROLE_ADMIN",
     *                  "ROLE_COORDENADOR_UNIDADE"
     *              }
     *          ),
     *          @Form\Method(
     *              "patchMethod",
     *              roles={
     *                  "ROLE_ADMIN",
     *                  "ROLE_COORDENADOR_UNIDADE"
     *              }
     *          )
     *     }
     * )
     *
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Filter\ToUpper(encoding="UTF-8")
     *
     * @Assert\Length(
     *     min = 3,
     *     minMessage = "O campo deve ter no mínimo 3 caracteres!",
     *     max = 255,
     *     maxMessage = "O campo deve ter no máximo 255 caracteres!"
     * )
     *
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $nome = '';

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=false,
     *     methods={
     *          @Form\Method(
     *              "updateMethod"
     *          ),
     *          @Form\Method(
     *              "patchMethod"
     *          )
     *     }
     * )
     *
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $assinaturaHTML = '';

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\EmailType",
     *     required=true,
     *     methods={
     *          @Form\Method(
     *              "createMethod"
     *          ),
     *          @Form\Method(
     *              "updateMethod",
     *              roles={
     *                  "ROLE_ADMIN",
     *                  "ROLE_COORDENADOR_UNIDADE"
     *              }
     *          ),
     *          @Form\Method(
     *              "patchMethod",
     *              roles={
     *                  "ROLE_ADMIN",
     *                  "ROLE_COORDENADOR_UNIDADE"
     *              }
     *          )
     *     }
     * )
     *
     * @Assert\NotBlank(
     *     message="O campo não pode estar em branco!"
     * )
     * @Assert\NotNull(
     *     message="Campo não pode ser nulo!"
     * )
     * @Assert\Email(message="Email inválido!")
     *
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $email = '';

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=false,
     *     methods={
     *          @Form\Method(
     *              "createMethod"
     *          ),
     *          @Form\Method(
     *              "patchMethod"
     *          )
     *     }
     * )
     *
     * @Serializer\Exclude
     *
     * @AppAssert\Password()
     *
     * @DTOMapper\Property()
     *
     * @OA\Property(type="string")
     */
    protected ?string $plainPassword = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=false,
     *     methods={
     *          @Form\Method(
     *              "updateMethod"
     *          ),
     *          @Form\Method(
     *              "patchMethod"
     *          )
     *     }
     * )
     *
     * @Serializer\Exclude
     *
     * @OA\Property(type="string")
     */
    protected ?string $currentPlainPassword = null;

    /**
     * @Assert\NotNull(
     *     message="Campo não pode ser nulo!"
     * )
     *
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\CheckboxType",
     *     required=false,
     *     methods={
     *          @Form\Method(
     *              "createMethod",
     *              roles={
     *                  "ROLE_ADMIN",
     *                  "ROLE_COORDENADOR_UNIDADE"
     *              }
     *          ),
     *          @Form\Method(
     *              "updateMethod",
     *              roles={
     *                  "ROLE_ADMIN",
     *                  "ROLE_COORDENADOR_UNIDADE"
     *              }
     *          ),
     *          @Form\Method(
     *              "patchMethod",
     *              roles={
     *                  "ROLE_ADMIN",
     *                  "ROLE_COORDENADOR_UNIDADE"
     *              }
     *          )
     *     }
     * )
     *
     * @OA\Property(type="boolean", default=true)
     * @DTOMapper\Property()
     */
    protected ?bool $enabled = true;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\NumberType",
     *     required=false,
     *     methods={
     *          @Form\Method(
     *              "createMethod",
     *              roles={
     *                  "ROLE_ADMIN",
     *                  "ROLE_COORDENADOR_UNIDADE"
     *              }
     *          ),
     *          @Form\Method(
     *              "updateMethod",
     *              roles={
     *                  "ROLE_ADMIN",
     *                  "ROLE_COORDENADOR_UNIDADE"
     *              }
     *          ),
     *          @Form\Method(
     *              "patchMethod",
     *              roles={
     *                  "ROLE_ADMIN",
     *                  "ROLE_COORDENADOR_UNIDADE"
     *              }
     *          )
     *     }
     * )
     *
     * @Assert\NotNull(
     *     message="Campo não pode ser nulo!"
     * )
     * @Assert\Range(
     *      min = 0,
     *      max = 4,
     *      notInRangeMessage = "Campo deve ser entre {{ min }} e {{ max }}"
     * )
     *
     * @OA\Property(type="integer", default=0)
     * @DTOMapper\Property()
     */
    protected ?int $nivelAcesso = 0;

    /**
     * @var string[]
     */
    protected array $roles = [];

    /**
     * @Serializer\SkipWhenEmpty()
     *
     * @var VinculacaoUsuarioDTO[]
     *
     * @DTOMapper\Property(
     *     dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\VinculacaoUsuario",
     *     collection=true,
     *     dtoSetter="addVinculacaoUsuarioPrincipal",
     *     dtoGetter="getVinculacoesUsuariosPrincipais"
     * )
     */
    protected array $vinculacoesUsuariosPrincipais = [];

    /**
     * @Serializer\SkipWhenEmpty()
     *
     * @var VinculacaoPessoaUsuarioDTO[]
     *
     * @DTOMapper\Property(
     *     dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\VinculacaoPessoaUsuario",
     *     collection=true,
     *     dtoSetter="addVinculacaoPessoaUsuario",
     *     dtoGetter="getVinculacoesPessoasUsuarios"
     * )
     */
    protected array $vinculacoesPessoasUsuarios = [];

    /**
     * @var EntityInterface|ColaboradorDTO|ColaboradorEntity|null
     *
     * @OA\Property(ref=@Model(type=ColaboradorDTO::class))
     *
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Colaborador")
     */
    protected $colaborador;

    /**
     * @var Coordenador[]
     *
     * @OA\Property(ref=@Model(type=CoordenadorDTO::class))
     *
     * @DTOMapper\Property(
     *     dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Coordenador",
     *     collection=true,
     *     dtoSetter="addCoordenador",
     *     dtoGetter="getCoordenadores"
     * )
     */
    protected ?array $coordenadores = [];

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\CheckboxType",
     *     required=false,
     *     methods={
     *          @Form\Method(
     *              "createMethod",
     *              roles={
     *                  "ROLE_ADMIN"
     *              }
     *          ),
     *          @Form\Method(
     *              "updateMethod",
     *              roles={
     *                  "ROLE_ADMIN"
     *              }
     *          ),
     *          @Form\Method(
     *              "patchMethod",
     *              roles={
     *                  "ROLE_ADMIN"
     *              }
     *          )
     *     }
     * )
     *
     * @OA\Property(type="boolean", default=false)
     * @DTOMapper\Property()
     */
    protected ?bool $validado = false;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\CheckboxType",
     *     required=false,
     *     methods={
     *          @Form\Method(
     *              "updateMethod",
     *              roles={
     *                  "ROLE_ADMIN"
     *              }
     *          ),
     *          @Form\Method(
     *              "patchMethod",
     *              roles={
     *                  "ROLE_ADMIN"
     *              }
     *          )
     *     }
     * )
     *
     * @OA\Property(type="boolean", default=false)
     */
    protected ?bool $reset = false;

    /**
     * @OA\Property(type="boolean")
     */
    protected ?bool $isDisponivel = null;

    /**
     * @var EntityInterface|ComponenteDigitalEntity|null
     *
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\ComponenteDigital",
     *     required=false
     * )
     *
     * @OA\Property(ref=@Model(type=ComponenteDigitalDTO::class))
     *
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\ComponenteDigital")
     */
    protected ?EntityInterface $imgPerfil = null;

    /**
     * @var EntityInterface|ComponenteDigitalEntity|null
     *
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\ComponenteDigital",
     *     required=false
     * )
     *
     * @OA\Property(ref=@Model(type=ComponenteDigitalDTO::class))
     *
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\ComponenteDigital")
     */
    protected ?EntityInterface $imgChancela = null;

    /**
     * @OA\Property(type="string", format="date-time")
     * @DTOMapper\Property()
     */
    protected ?DateTime $passwordAtualizadoEm = null;

    /**
     * Usuario constructor.
     */
    public function __construct()
    {
        $this->vinculacoesUsuariosPrincipais = [];
        $this->roles = [];
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @return $this
     */
    public function setUsername(?string $username): self
    {
        $this->setVisited('username');

        $this->username = $username;

        return $this;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    /**
     * @return $this
     */
    public function setNome(?string $nome): self
    {
        $this->setVisited('nome');

        $this->nome = $nome;

        return $this;
    }

    public function getAssinaturaHTML(): ?string
    {
        return $this->assinaturaHTML;
    }

    /**
     * @return $this
     */
    public function setAssinaturaHTML(?string $assinaturaHTML): self
    {
        $this->setVisited('assinaturaHTML');

        $this->assinaturaHTML = $assinaturaHTML;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return $this
     */
    public function setEmail(?string $email): self
    {
        $this->setVisited('email');

        $this->email = $email;

        return $this;
    }

    public function getNivelAcesso(): ?int
    {
        return $this->nivelAcesso;
    }

    /**
     * @return $this
     */
    public function setNivelAcesso(?int $nivelAcesso): self
    {
        $this->setVisited('nivelAcesso');

        $this->nivelAcesso = $nivelAcesso;

        return $this;
    }

    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    /**
     * @return $this
     */
    public function setEnabled(?bool $enabled): self
    {
        $this->setVisited('enabled');

        $this->enabled = $enabled;

        return $this;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    /**
     * @return $this
     */
    public function setPlainPassword(?string $plainPassword = null): self
    {
        if (null !== $plainPassword) {
            $this->setVisited('plainPassword');

            $this->plainPassword = $plainPassword;
        }

        return $this;
    }

    public function getCurrentPlainPassword(): ?string
    {
        return $this->currentPlainPassword;
    }

    /**
     * @return $this
     */
    public function setCurrentPlainPassword(?string $currentPlainPassword = null): self
    {
        if (null !== $currentPlainPassword) {
            $this->setVisited('currentPlainPassword');

            $this->currentPlainPassword = $currentPlainPassword;
        }

        return $this;
    }

    /**
     * @param VinculacaoUsuario $vinculacaoUsuarioPrincipal
     *
     * @return Usuario
     */
    public function addVinculacaoUsuarioPrincipal(VinculacaoUsuarioDTO $vinculacaoUsuarioPrincipal): self
    {
        $this->vinculacoesUsuariosPrincipais[] = $vinculacaoUsuarioPrincipal;

        return $this;
    }

    public function getVinculacoesUsuariosPrincipais(): array
    {
        return $this->vinculacoesUsuariosPrincipais;
    }

    /**
     * @param VinculacaoPessoaUsuario $vinculacaoPessoaUsuario
     *
     * @return Usuario
     */
    public function addVinculacaoPessoaUsuario(VinculacaoPessoaUsuarioDTO $vinculacaoPessoaUsuario): self
    {
        $this->vinculacoesPessoasUsuarios[] = $vinculacaoPessoaUsuario;

        return $this;
    }

    public function getVinculacoesPessoasUsuarios(): array
    {
        return $this->vinculacoesPessoasUsuarios;
    }

    /**
     * @return EntityInterface|ColaboradorDTO|ColaboradorEntity|null
     */
    public function getColaborador(): ?EntityInterface
    {
        return $this->colaborador;
    }

    /**
     * @param EntityInterface|ColaboradorDTO|ColaboradorEntity|null $colaborador
     *
     * @return Usuario
     */
    public function setColaborador(?EntityInterface $colaborador): self
    {
        $this->setVisited('colaborador');
        $this->colaborador = $colaborador;

        return $this;
    }

    /**
     * @return Usuario
     */
    public function addRole(string $role): self
    {
        $this->roles[] = $role;

        return $this;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * @return Usuario
     */
    public function addCoordenador(CoordenadorDTO $coordenador): self
    {
        $this->coordenadores[] = $coordenador;

        return $this;
    }

    public function getCoordenadores(): array
    {
        return $this->coordenadores;
    }

    public function getValidado(): ?bool
    {
        return $this->validado;
    }

    /**
     * @return $this
     */
    public function setValidado(?bool $validado): self
    {
        $this->setVisited('validado');

        $this->validado = $validado;

        return $this;
    }

    public function getReset(): ?bool
    {
        return $this->reset;
    }

    /**
     * @return $this
     */
    public function setReset(?bool $reset): self
    {
        $this->reset = $reset;

        return $this;
    }

    public function getIsDisponivel(): ?bool
    {
        return $this->isDisponivel;
    }

    public function setIsDisponivel(?bool $isDisponivel): self
    {
        $this->setVisited('isDisponivel');

        $this->isDisponivel = $isDisponivel;

        return $this;
    }

    /**
     * @return ComponenteDigitalEntity|EntityInterface|null
     */
    public function getImgPerfil(): ?EntityInterface
    {
        return $this->imgPerfil;
    }

    /**
     * @param ComponenteDigitalEntity|EntityInterface|null $imgPerfil
     *
     * @return $this
     */
    public function setImgPerfil(ComponenteDigitalEntity | EntityInterface | null $imgPerfil): self
    {
        $this->setVisited('imgPerfil');

        $this->imgPerfil = $imgPerfil;

        return $this;
    }

    /**
     * @return ComponenteDigitalEntity|EntityInterface|null
     */
    public function getImgChancela(): ?EntityInterface
    {
        return $this->imgChancela;
    }

    /**
     * @param ComponenteDigitalEntity|EntityInterface|null $imgChancela
     *
     * @return $this
     */
    public function setImgChancela(ComponenteDigitalEntity | EntityInterface | null $imgChancela): self
    {
        $this->setVisited('imgChancela');

        $this->imgChancela = $imgChancela;

        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getPasswordAtualizadoEm(): ?DateTime
    {
        return $this->passwordAtualizadoEm;
    }

    /**
     * @param DateTime|null $passwordAtualizadoEm
     * @return Usuario
     */
    public function setPasswordAtualizadoEm(?DateTime $passwordAtualizadoEm): Usuario
    {
        $this->setVisited('passwordAtualizadoEm');
        $this->passwordAtualizadoEm = $passwordAtualizadoEm;

        return $this;
    }
}
