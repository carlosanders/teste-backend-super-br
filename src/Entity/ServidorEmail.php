<?php

declare(strict_types=1);
/**
 * /src/Entity/ServidorEmail.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Entity;

use DMS\Filter\Rules as Filter;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use SuppCore\AdministrativoBackend\Doctrine\ORM\Enableable\Enableable;
use SuppCore\AdministrativoBackend\Entity\Traits\Ativo;
use SuppCore\AdministrativoBackend\Entity\Traits\Blameable;
use SuppCore\AdministrativoBackend\Entity\Traits\Descricao;
use SuppCore\AdministrativoBackend\Entity\Traits\Id;
use SuppCore\AdministrativoBackend\Entity\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\Entity\Traits\Timestampable;
use SuppCore\AdministrativoBackend\Entity\Traits\Uuid;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use SuppCore\AdministrativoBackend\Entity\Traits\Nome;

/**
 * Class ServidorEmail.
 *
 *  @ORM\Table(
 *     name="ad_servidor_email",
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(columns={"nome", "apagado_em"}),
 *     }
 * )
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @UniqueEntity(
 *     fields = {"nome"},
 *     message = "Nome já está em utilização!"
 * )
 *
 * @Enableable()
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class ServidorEmail implements EntityInterface
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
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     *
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
     *     nullable=false
     * )
     */
    protected string $host = '';


    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     * @ORM\Column(
     *     type="integer",
     *     name="porta",
     *     nullable=false
     * )
     */
    protected int $porta = 0;

    /**
     * @Filter\ToUpper(encoding="UTF-8")
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     *
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
     *     nullable=false
     * )
     */
    protected string $protocolo = '';

    /**
     * @Filter\ToUpper(encoding="UTF-8")
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     *
     * @Assert\Length(
     *     min = 3,
     *     minMessage = "O campo deve ter no mínimo 3 caracteres!",
     *     max = 255,
     *     maxMessage = "O campo deve ter no máximo 255 caracteres!"
     * )
     * @ORM\Column(
     *     type="string",
     *     name="metodo_encriptacao",
     *     nullable=true
     * )
     */
    protected ?string $metodoEncriptacao = null;

    /**
     * @ORM\Column(
     *     type="boolean",
     *     name="valida_certificado",
     *     nullable=false
     * )
     */
    protected bool $validaCertificado = true;

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @param string $host
     * @return ServidorEmail
     */
    public function setHost(string $host): self
    {
        $this->host = $host;

        return $this;
    }

    /**
     * @return int
     */
    public function getPorta(): int
    {
        return $this->porta;
    }

    /**
     * @param int $porta
     * @return ServidorEmail
     */
    public function setPorta(int $porta): self
    {
        $this->porta = $porta;

        return $this;
    }

    /**
     * @return string
     */
    public function getProtocolo(): string
    {
        return $this->protocolo;
    }

    /**
     * @param string $protocolo
     * @return ServidorEmail
     */
    public function setProtocolo(string $protocolo): self
    {
        $this->protocolo = $protocolo;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMetodoEncriptacao(): ?string
    {
        return $this->metodoEncriptacao;
    }

    /**
     * @param string|null $metodoEncriptacao
     * @return ServidorEmail
     */
    public function setMetodoEncriptacao(?string $metodoEncriptacao): self
    {
        $this->metodoEncriptacao = $metodoEncriptacao;

        return $this;
    }

    /**
     * @return bool
     */
    public function getValidaCertificado(): bool
    {
        return $this->validaCertificado;
    }

    /**
     * @param bool $validaCertificado
     * @return ServidorEmail
     */
    public function setValidaCertificado(bool $validaCertificado): self
    {
        $this->validaCertificado = $validaCertificado;

        return $this;
    }


}
