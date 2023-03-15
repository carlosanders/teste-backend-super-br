<?php

declare(strict_types=1);
/**
 * /src/Entity/Usuario.php.
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
use Symfony\Bridge\Doctrine\Validator\Constraints as AssertCollection;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherAwareInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Security\Core\User\LegacyPasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface as CoreUserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Usuario.
 *
 * @AssertCollection\UniqueEntity("email")
 * @AssertCollection\UniqueEntity("username")
 *
 *  @ORM\Table(
 *     name="ad_usuario",
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(name="uq_username", columns={"username"}),
 *         @ORM\UniqueConstraint(name="uq_email", columns={"email"}),
 *     },
 * )
 *
 * @ORM\Entity(
 *     repositoryClass="SuppCore\AdministrativoBackend\Security\UserProvider"
 * )
 *
 * @Gedmo\Loggable
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Usuario implements CoreUserInterface, EquatableInterface, EntityInterface, UserInterface, PasswordHasherAwareInterface, LegacyPasswordAuthenticatedUserInterface
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
        $this->vinculacoesRoles = new ArrayCollection();
        $this->vinculacoesUsuarios = new ArrayCollection();
        $this->vinculacoesUsuariosPrincipais = new ArrayCollection();
        $this->vinculacoesEtiquetas = new ArrayCollection();
        $this->vinculacoesPessoasUsuarios = new ArrayCollection();
        $this->coordenadores = new ArrayCollection();
    }

    /**
     * @Filter\Digits()
     *
     * @AppAssert\CpfCnpj()
     * @Assert\Length(
     *     min = 11,
     *     minMessage = "O campo deve ter no mínimo 11 caracteres!",
     *     max = 11,
     *     maxMessage = "O campo deve ter no máximo 11 caracteres!"
     * )
     * @ORM\Column(
     *     name="username",
     *     type="string",
     *     length=255,
     *     nullable=false
     * )
     */
    protected string $username = '';

    /**
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
     * @ORM\Column(
     *     name="nome",
     *     type="string",
     *     length=255,
     *     nullable=false
     * )
     */
    protected string $nome = '';

    /**
     * @Assert\NotBlank(
     *     message="O campo não pode estar em branco!"
     * )
     * @Assert\NotNull(
     *     message="Campo não pode ser nulo!"
     * )
     * @Assert\Email(message="Email inválido!")
     * @ORM\Column(
     *     name="email",
     *     type="string",
     *     length=255,
     *     nullable=false
     * )
     */
    protected string $email = '';

    /**
     * @Gedmo\Versioned
     * @ORM\Column(
     *     name="password",
     *     type="string",
     *     length=255,
     *     nullable=false
     * )
     */
    protected string $password = '';

    /**
     * @Gedmo\Versioned
     * @ORM\Column(
     *     name="password_atualizado_em",
     *     type="datetime",
     *     nullable=true
     * )
     */
    protected ?DateTime $passwordAtualizadoEm = null;

    /**
     * @Gedmo\Versioned
     * @ORM\Column(
     *     name="salt",
     *     type="string",
     *     length=255,
     *     nullable=true
     * )
     */
    protected string $salt = '';

    /**
     * @Gedmo\Versioned
     * @ORM\Column(
     *     name="encoder",
     *     type="string",
     *     length=255,
     *     nullable=true
     * )
     */
    protected string $encoder = '';

    /**
     * Plain password. Used for model validation. Must not be persisted.
     */
    protected string $plainPassword = '';

    /**
     * Se o usuário está ativo ou não.
     *
     * @Assert\NotNull(
     *     message="Campo não pode ser nulo!"
     * )
     * @ORM\Column(
     *     name="enabled",
     *     type="boolean",
     *     nullable=false
     * )
     */
    protected bool $enabled = true;

    /**
     * Nível de acesso do usuário.
     *
     * @Assert\Range(
     *     min = 0,
     *     max = 4,
     *     notInRangeMessage = "Campo deve ser entre {{ min }} e {{ max }}"
     * )
     * @ORM\Column(
     *     name="nivel_acesso",
     *     type="integer",
     *     nullable=false
     * )
     */
    protected int $nivelAcesso = 0;

    /**
     * @Assert\Length(
     *     min = 3,
     *     minMessage = "O campo deve ter no mínimo 3 caracteres!",
     *     max = 255,
     *     maxMessage = "O campo deve ter no máximo 255 caracteres!"
     * )
     * @ORM\Column(
     *     name="assinatura_html",
     *     type="string",
     *     length=255,
     *     nullable=false
     * )
     */
    protected ?string $assinaturaHTML = '';

    /**
     * @ORM\OneToOne(
     *     targetEntity="Colaborador",
     *     mappedBy="usuario"
     * )
     */
    protected ?Colaborador $colaborador = null;

    /**
     * @var Collection<VinculacaoRole>|ArrayCollection<VinculacaoRole>
     *
     * @ORM\OneToMany(
     *     targetEntity="VinculacaoRole",
     *     mappedBy="usuario",
     * )
     */
    protected $vinculacoesRoles;

    /**
     * @var Collection|ArrayCollection<VinculacaoEtiqueta>
     *
     * @ORM\OneToMany(
     *     targetEntity="VinculacaoEtiqueta",
     *     mappedBy="usuario",
     * )
     */
    protected $vinculacoesEtiquetas;

    /**
     * @var Collection|ArrayCollection<VinculacaoPessoaUsuario>
     *
     * @ORM\OneToMany(
     *     targetEntity="VinculacaoPessoaUsuario",
     *     mappedBy="usuarioVinculado",
     * )
     */
    protected $vinculacoesPessoasUsuarios;

    /**
     * @var Collection|ArrayCollection<VinculacaoUsuario>
     *
     * @ORM\OneToMany(
     *     targetEntity="VinculacaoUsuario",
     *     mappedBy="usuario",
     * )
     */
    protected $vinculacoesUsuarios;

    /**
     * @var Collection|ArrayCollection<VinculacaoUsuario>
     *
     * @ORM\OneToMany(
     *     targetEntity="VinculacaoUsuario",
     *     mappedBy="usuarioVinculado",
     * )
     */
    protected $vinculacoesUsuariosPrincipais;

    /**
     * @var Collection|ArrayCollection<Coordenador>
     *
     * @ORM\OneToMany(
     *     targetEntity="Coordenador",
     *     mappedBy="usuario",
     * )
     */
    protected $coordenadores;

    /**
     * Se o usuário externo está validado ou não.
     *
     * @Gedmo\Versioned
     *
     * @ORM\Column(
     *     name="validado",
     *     type="boolean",
     *     nullable=false
     * )
     */
    protected bool $validado = false;

    /**
     * @ORM\OneToOne(targetEntity="ComponenteDigital")
     * @ORM\JoinColumn(
     *     name="img_perfil_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?ComponenteDigital $imgPerfil = null;

    /**
     * @ORM\OneToOne(targetEntity="ComponenteDigital")
     * @ORM\JoinColumn(
     *     name="img_chancela_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?ComponenteDigital $imgChancela = null;

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    public function getUserIdentifier(): string
    {
        return $this->getUsername();
    }

    /**
     * @param string $username
     *
     * @return Usuario
     */
    public function setUsername(string $username): self
    {
        if ($username) {
            $this->username = $username;
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getSalt(): string
    {
        return $this->salt;
    }

    /**
     * @param string $salt
     *
     * @return Usuario
     */
    public function setSalt(string $salt): self
    {
        if ($salt) {
            $this->salt = $salt;
        }

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
     * @param bool $enabled
     *
     * @return Usuario
     */
    public function setEnabled(bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * @return bool
     */
    public function getEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @param string $nome
     *
     * @return Usuario
     */
    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * @param int $nivelAcesso
     *
     * @return Usuario
     */
    public function setNivelAcesso(int $nivelAcesso): self
    {
        $this->nivelAcesso = $nivelAcesso;

        return $this;
    }

    /**
     * Get nivelAcesso.
     */
    public function getNivelAcesso(): int
    {
        return $this->nivelAcesso;
    }

    /**
     * @return string|null
     */
    public function getAssinaturaHTML(): string
    {
        return $this->assinaturaHTML;
    }

    /**
     * @param string|null $assinaturaHTML
     *
     * @return Usuario
     */
    public function setAssinaturaHTML(?string $assinaturaHTML): self
    {
        $this->assinaturaHTML = $assinaturaHTML;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return Usuario
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Set colaborador.
     *
     * @param Colaborador|null $colaborador
     *
     * @return Usuario
     */
    public function setColaborador(?Colaborador $colaborador): self
    {
        $this->colaborador = $colaborador;

        return $this;
    }

    /**
     * Get colaborador.
     */
    public function getColaborador(): ?Colaborador
    {
        return $this->colaborador;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param callable $encoder
     * @param string   $plainPassword
     *
     * @return Usuario
     */
    public function setPassword(callable $encoder, string $plainPassword): self
    {
        if (!empty($plainPassword)) {
            $this->password = $encoder($plainPassword);
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    /**
     * @param string $plainPassword
     *
     * @return Usuario
     */
    public function setPlainPassword(?string $plainPassword): self
    {
        if (!empty($plainPassword)) {
            $this->plainPassword = $plainPassword;

            // Change some mapped values so preUpdate will get called.
            $this->password = ''; // just blank it out
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getEncoder(): string
    {
        return $this->encoder;
    }

    /**
     * @param string $encoder
     *
     * @return Usuario
     */
    public function setEncoder(string $encoder): self
    {
        if ($encoder) {
            $this->encoder = $encoder;
        }

        return $this;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials(): void
    {
        $this->plainPassword = '';
    }

    /**
     * Getter for roles.
     *
     * @return string[]
     */
    public function getRoles(): array
    {
        $roles = ['ROLE_USER'];
        foreach ($this->vinculacoesRoles as $vinculacaoRole) {
            $roles[] = $vinculacaoRole->getRole();
        }

        return array_map('\strval', array_unique($roles));
    }

    /**
     * The equality comparison should neither be done by referential equality
     * nor by comparing identities (i.e. getId() === getId()).
     *
     * However, you do not need to compare every attribute, but only those that
     * are relevant for assessing whether re-authentication is required.
     *
     * Also implementation should consider that $usuario instance may implement
     * the extended user interface `AdvancedUserInterface`.
     *
     * @param CoreUserInterface|Usuario $usuario
     *
     * @return bool
     */
    public function isEqualTo(CoreUserInterface $usuario): bool
    {
        return $usuario instanceof self && $usuario->getId() === $this->getId();
    }

    /**
     * Getter for usuario groups collection.
     *
     * @return Collection|ArrayCollection|mixed|Collection<VinculacaoRole>|ArrayCollection<VinculacaoRole>
     */
    public function getVinculacoesRoles()
    {
        return $this->vinculacoesRoles;
    }

    /**
     * @param VinculacaoUsuario $vinculacaoUsuario
     *
     * @return Usuario
     */
    public function addVinculacaoUsuario(VinculacaoUsuario $vinculacaoUsuario): self
    {
        if (!$this->vinculacoesUsuarios->contains($vinculacaoUsuario)) {
            $this->vinculacoesUsuarios[] = $vinculacaoUsuario;
            $vinculacaoUsuario->setUsuario($this);
        }

        return $this;
    }

    /**
     * @param VinculacaoUsuario $vinculacaoUsuario
     *
     * @return Usuario
     */
    public function removeVinculacaoUsuario(VinculacaoUsuario $vinculacaoUsuario): self
    {
        if ($this->vinculacoesUsuarios->contains($vinculacaoUsuario)) {
            $this->vinculacoesUsuarios->removeElement($vinculacaoUsuario);
        }

        return $this;
    }

    /**
     * @return Collection|ArrayCollection<VinculacaoUsuario>
     */
    public function getVinculacoesUsuarios(): Collection
    {
        return $this->vinculacoesUsuarios;
    }

    /**
     * @param VinculacaoUsuario $vinculacaoUsuarioPrincipal
     *
     * @return Usuario
     */
    public function addVinculacaoUsuarioPrincipal(VinculacaoUsuario $vinculacaoUsuarioPrincipal): self
    {
        if (!$this->vinculacoesUsuariosPrincipais->contains($vinculacaoUsuarioPrincipal)) {
            $this->vinculacoesUsuariosPrincipais[] = $vinculacaoUsuarioPrincipal;
            $vinculacaoUsuarioPrincipal->setUsuarioVinculado($this);
        }

        return $this;
    }

    /**
     * @param VinculacaoUsuario $vinculacaoUsuarioPrincipal
     *
     * @return Usuario
     */
    public function removeVinculacaoUsuarioPrincipal(VinculacaoUsuario $vinculacaoUsuarioPrincipal): self
    {
        if ($this->vinculacoesUsuariosPrincipais->contains($vinculacaoUsuarioPrincipal)) {
            $this->vinculacoesUsuariosPrincipais->removeElement($vinculacaoUsuarioPrincipal);
        }

        return $this;
    }

    /**
     * @return Collection|ArrayCollection<VinculacaoUsuario>|null
     */
    public function getVinculacoesUsuariosPrincipais(): ?Collection
    {
        return $this->vinculacoesUsuariosPrincipais;
    }

    /**
     * @param VinculacaoEtiqueta $vinculacaoEtiqueta
     *
     * @return Usuario
     */
    public function addVinculacaoEtiqueta(VinculacaoEtiqueta $vinculacaoEtiqueta): self
    {
        if (!$this->vinculacoesEtiquetas->contains($vinculacaoEtiqueta)) {
            $this->vinculacoesEtiquetas[] = $vinculacaoEtiqueta;
            $vinculacaoEtiqueta->setUsuario($this);
        }

        return $this;
    }

    /**
     * @param VinculacaoEtiqueta $vinculacaoEtiqueta
     *
     * @return Usuario
     */
    public function removeVinculacaoEtiqueta(VinculacaoEtiqueta $vinculacaoEtiqueta): self
    {
        if ($this->vinculacoesEtiquetas->contains($vinculacaoEtiqueta)) {
            $this->vinculacoesEtiquetas->removeElement($vinculacaoEtiqueta);
        }

        return $this;
    }

    /**
     * @return Collection|ArrayCollection<VinculacaoEtiqueta>
     */
    public function getVinculacoesEtiquetas(): Collection
    {
        return $this->vinculacoesEtiquetas;
    }

    /**
     * @param VinculacaoPessoaUsuario $vinculacaoPessoaUsuario
     *
     * @return Usuario
     */
    public function addVinculacaoPessoaUsuario(VinculacaoPessoaUsuario $vinculacaoPessoaUsuario): self
    {
        if (!$this->vinculacoesPessoasUsuarios->contains($vinculacaoPessoaUsuario)) {
            $this->vinculacoesPessoasUsuarios[] = $vinculacaoPessoaUsuario;
            $vinculacaoPessoaUsuario->setUsuarioVinculado($this);
        }

        return $this;
    }

    /**
     * @param VinculacaoPessoaUsuario $vinculacaoPessoaUsuario
     *
     * @return Usuario
     */
    public function removeVinculacaoPessoaUsuario(VinculacaoPessoaUsuario $vinculacaoPessoaUsuario): self
    {
        if ($this->vinculacoesPessoasUsuarios->contains($vinculacaoPessoaUsuario)) {
            $this->vinculacoesPessoasUsuarios->removeElement($vinculacaoPessoaUsuario);
        }

        return $this;
    }

    /**
     * @return Collection|ArrayCollection<VinculacaoPessoaUsuario>
     */
    public function getVinculacoesPessoasUsuarios(): ?Collection
    {
        return $this->vinculacoesPessoasUsuarios;
    }

    /**
     * Method to attach new usuario group to usuario.
     *
     * @param VinculacaoRole $vinculacaoRole
     *
     * @return Usuario
     */
    public function addVinculacaoRole(VinculacaoRole $vinculacaoRole): Usuario
    {
        if (!$this->vinculacoesRoles->contains($vinculacaoRole)) {
            $this->vinculacoesRoles->add($vinculacaoRole);
            $vinculacaoRole->setUsuario($this);
        }

        return $this;
    }

    /**
     * Method to remove specified usuario group from usuario.
     *
     * @param VinculacaoRole $vinculacaoRole
     *
     * @return Usuario
     */
    public function removeVinculacaoRole(VinculacaoRole $vinculacaoRole): Usuario
    {
        if ($this->vinculacoesRoles->contains($vinculacaoRole)) {
            $this->vinculacoesRoles->removeElement($vinculacaoRole);
        }

        return $this;
    }

    /**
     * @param Coordenador $coordenador
     *
     * @return Usuario
     */
    public function addCoordenador(Coordenador $coordenador): self
    {
        if (!$this->coordenadores->contains($coordenador)) {
            $this->coordenadores[] = $coordenador;
            $coordenador->setUsuario($this);
        }

        return $this;
    }

    /**
     * @param Coordenador $coordenador
     *
     * @return Usuario
     */
    public function removeCoordenador(Coordenador $coordenador): self
    {
        if ($this->coordenadores->contains($coordenador)) {
            $this->coordenadores->removeElement($coordenador);
        }

        return $this;
    }

    /**
     * @return Collection|ArrayCollection<Coordenador>|null
     */
    public function getCoordenadores()
    {
        return $this->coordenadores;
    }

    /**
     * Method to remove all many-to-many usuario group relations from current usuario.
     */
    public function clearVinculacoesRoles(): Usuario
    {
        $this->vinculacoesRoles->clear();

        return $this;
    }

    /**
     * @param bool $validado
     *
     * @return Usuario
     */
    public function setValidado(bool $validado): self
    {
        $this->validado = $validado;

        return $this;
    }

    /**
     * @return bool
     */
    public function getValidado(): bool
    {
        return $this->validado;
    }

    /**
     * @return ComponenteDigital|null
     */
    public function getImgPerfil(): ?ComponenteDigital
    {
        return $this->imgPerfil;
    }

    /**
     * @param ComponenteDigital|null $imgPerfil
     *
     * @return $this
     */
    public function setImgPerfil(?ComponenteDigital $imgPerfil): self
    {
        $this->imgPerfil = $imgPerfil;

        return $this;
    }

    /**
     * @return ComponenteDigital|null
     */
    public function getImgChancela(): ?ComponenteDigital
    {
        return $this->imgChancela;
    }

    /**
     * @param ComponenteDigital|null $imgChancela
     *
     * @return $this
     */
    public function setImgChancela(?ComponenteDigital $imgChancela): self
    {
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
     *
     * @return Usuario
     */
    public function setPasswordAtualizadoEm(?DateTime $passwordAtualizadoEm): Usuario
    {
        $this->passwordAtualizadoEm = $passwordAtualizadoEm;

        return $this;
    }

    /**
     * Returns data suitable for PHP serialization.
     *
     * @return array
     */
    public function __serialize(): array
    {
        return [
                'id' => $this->id,
                'username' => $this->username,
                'password' => $this->password,
                'salt' => $this->salt,
            ];
    }

    /**
     * Adds unserialized data to the object.
     *
     * @param array
     */
    public function __unserialize(array $data): void
    {
        $this->id = $data['id'];
        $this->username = $data['username'];
        $this->password = $data['password'];
        $this->salt = $data['salt'];
    }

    /**
     * @return string|null
     */
    public function getPasswordHasherName(): ?string
    {
        if ('sodium' === $this->getEncoder()) {
            return 'sodium';
        } else {
            return 'sha512';
        }
    }
}
