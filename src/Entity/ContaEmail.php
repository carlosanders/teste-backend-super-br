<?php

declare(strict_types=1);
/**
 * /src/Entity/ContaEmail.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Entity;

use DMS\Filter\Rules as Filter;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use SuppCore\AdministrativoBackend\Doctrine\ORM\Enableable\Enableable;
use SuppCore\AdministrativoBackend\Entity\Traits\Nome;
use SuppCore\AdministrativoBackend\Entity\Traits\Ativo;
use SuppCore\AdministrativoBackend\Entity\Traits\Blameable;
use SuppCore\AdministrativoBackend\Entity\Traits\Descricao;
use SuppCore\AdministrativoBackend\Entity\Traits\Id;
use SuppCore\AdministrativoBackend\Entity\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\Entity\Traits\Timestampable;
use SuppCore\AdministrativoBackend\Entity\Traits\Uuid;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class ContaEmail.
 *
 *  @ORM\Table(
 *     name="ad_conta_email",
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(columns={"nome", "setor_id", "apagado_em"}),
 *     }
 * )
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @UniqueEntity(
 *     fields = {"nome", "setor"},
 *     message = "Nome já está em utilização no setor/unidade!"
 * )
 *
 * @Enableable()
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class ContaEmail implements EntityInterface
{
    // Traits
    use Blameable;
    use Timestampable;
    use Softdeleteable;
    use Id;
    use Uuid;
    use Nome;
    use Descricao;
    use Ativo;

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
     * @Filter\ToUpper(encoding="UTF-8")
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @ORM\Column(
     *     type="string",
     *     length=255,
     *     name="metodo_autenticacao",
     *     nullable=true
     * )
     */
    protected ?string $metodoAutenticacao = null;

    /**
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Assert\NotBlank(
     *     message="O campo não pode estar em branco!"
     * )
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     * @Assert\Length(
     *     min = 3,
     *     minMessage = "O campo deve ter no mínimo 3 caracteres!",
     *     max = 255,
     *     maxMessage = "O campo deve ter no máximo 255 caracteres!"
     * )
     * @ORM\Column(
     *     type="string",
     *     length=255,
     *     nullable=false
     * )
     */
    protected string $login = '';

    /**
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Assert\NotBlank(
     *     message="O campo não pode estar em branco!"
     * )
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     * @Assert\Length(
     *     min = 3,
     *     minMessage = "O campo deve ter no mínimo 3 caracteres!",
     *     max = 255,
     *     maxMessage = "O campo deve ter no máximo 255 caracteres!"
     * )
     * @ORM\Column(
     *     type="string",
     *     length=255,
     *     nullable=false
     * )
     */
    protected string $senha = '';

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(
     *     targetEntity="Setor",
     *     inversedBy="contasEmails"
     * )
     * @ORM\JoinColumn(
     *     name="setor_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected ?Setor $setor = null;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(
     *     targetEntity="ServidorEmail"
     * )
     * @ORM\JoinColumn(
     *     name="servidor_email_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected ?ServidorEmail $servidorEmail = null;

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @param string $login
     * @return ContaEmail
     */
    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    /**
     * @return string
     */
    public function getSenha(): string
    {
        return $this->senha;
    }

    /**
     * @param string $senha
     * @return ContaEmail
     */
    public function setSenha(string $senha): self
    {
        $this->senha = $senha;

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
     * @return ContaEmail
     */
    public function setSetor(?Setor $setor): self
    {
        $this->setor = $setor;

        return $this;
    }

    /**
     * @return ServidorEmail|null
     */
    public function getServidorEmail(): ?ServidorEmail
    {
        return $this->servidorEmail;
    }

    /**
     * @param ServidorEmail|null $servidorEmail
     * @return ContaEmail
     */
    public function setServidorEmail(?ServidorEmail $servidorEmail): self
    {
        $this->servidorEmail = $servidorEmail;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMetodoAutenticacao(): ?string
    {
        return $this->metodoAutenticacao;
    }

    /**
     * @param string|null $metodoAutenticacao
     * @return ContaEmail
     */
    public function setMetodoAutenticacao(?string $metodoAutenticacao): self
    {
        $this->metodoAutenticacao = $metodoAutenticacao;

        return $this;
    }
}
