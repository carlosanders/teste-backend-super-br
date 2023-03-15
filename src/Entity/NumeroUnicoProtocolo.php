<?php

declare(strict_types=1);
/**
 * /src/Entity/NumeroUnicoProtocolo.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Entity;

use Doctrine\ORM\Mapping as ORM;
use Exception;
use SuppCore\AdministrativoBackend\Entity\Traits\Blameable;
use SuppCore\AdministrativoBackend\Entity\Traits\Id;
use SuppCore\AdministrativoBackend\Entity\Traits\Timestampable;
use SuppCore\AdministrativoBackend\Entity\Traits\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class NumeroUnicoProtocolo.
 *
 *  @ORM\Table(
 *     name="ad_numero_unico_protocolo",
 * )
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class NumeroUnicoProtocolo implements EntityInterface
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
    }

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     * @ORM\Column(
     *     type="integer",
     *     name="sequencia",
     *     nullable=false
     * )
     */
    protected int $sequencia;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     * @ORM\Column(
     *     type="integer",
     *     name="ano",
     *     nullable=false
     * )
     */
    protected int $ano;

    /**
     * @Assert\NotBlank(
     *     message="Campo não pode estar em branco."
     * )
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     * @Assert\Regex(
     *     pattern="/\d{5}/",
     *     message="Prefixo NUP Inválido"
     * )
     * @ORM\Column(
     *     type="string",
     *     name="prefixo_nup",
     *     nullable=false
     * )
     */
    protected string $prefixoNUP;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(
     *     targetEntity="Setor"
     * )
     * @ORM\JoinColumn(
     *     name="setor_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected Setor $setor;

    /**
     * @return int
     */
    public function getSequencia(): int
    {
        return $this->sequencia;
    }

    /**
     * @param int $sequencia
     *
     * @return NumeroUnicoProtocolo
     */
    public function setSequencia(int $sequencia): self
    {
        $this->sequencia = $sequencia;

        return $this;
    }

    /**
     * @return int
     */
    public function getAno(): int
    {
        return $this->ano;
    }

    /**
     * @param int $ano
     *
     * @return NumeroUnicoProtocolo
     */
    public function setAno(int $ano): self
    {
        $this->ano = $ano;

        return $this;
    }

    /**
     * @return string
     */
    public function getPrefixoNUP(): string
    {
        return $this->prefixoNUP;
    }

    /**
     * @param string $prefixoNUP
     *
     * @return NumeroUnicoProtocolo
     */
    public function setPrefixoNUP(string $prefixoNUP): self
    {
        $this->prefixoNUP = $prefixoNUP;

        return $this;
    }

    /**
     * @return Setor
     */
    public function getSetor(): Setor
    {
        return $this->setor;
    }

    /**
     * @param Setor $setor
     *
     * @return NumeroUnicoProtocolo
     */
    public function setSetor(Setor $setor): self
    {
        $this->setor = $setor;

        return $this;
    }
}
