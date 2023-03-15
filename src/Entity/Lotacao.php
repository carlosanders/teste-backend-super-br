<?php

declare(strict_types=1);
/**
 * /src/Entity/Lotacao.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Entity;

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
 * Class Lotacao.
 *
 *  @ORM\Table(
 *     name="ad_lotacao",
 * )
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 *
 * @Gedmo\Loggable
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Lotacao implements EntityInterface
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
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(
     *     targetEntity="Colaborador",
     *     inversedBy="lotacoes"
     * )
     * @ORM\JoinColumn(
     *     name="colaborador_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected Colaborador $colaborador;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(
     *     targetEntity="Setor",
     *     inversedBy="lotacoes"
     * )
     * @ORM\JoinColumn(
     *     name="setor_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected Setor $setor;

    /**
     * @Assert\Range(
     *     min = 0,
     *     max = 100,
     *     notInRangeMessage = "Campo ser entre {{ min }} e {{ max }}"
     * )
     *
     * @Gedmo\Versioned
     * @ORM\Column(
     *     type="integer",
     *     name="peso",
     *     nullable=false
     * )
     */
    protected int $peso = 100;

    /**
     * @Gedmo\Versioned
     * @ORM\Column(
     *     type="boolean",
     *     nullable=false
     * )
     */
    protected bool $principal = false;

    /**
     * @Gedmo\Versioned
     * @ORM\Column(
     *     type="boolean",
     *     nullable=false
     * )
     */
    protected bool $distribuidor = false;

    /**
     * @Gedmo\Versioned
     * @ORM\Column(
     *     type="boolean",
     *     nullable=false
     * )
     */
    protected bool $arquivista = false;

    /**
     * @Gedmo\Versioned
     * @ORM\Column(
     *     type="boolean",
     *     nullable=false
     * )
     */
    protected bool $pcu = false;

    /**
     * @Assert\Regex(
     *     pattern="/^\d(-\d)?(,\d(-\d)?)*$/",
     *     message="Formato inválido, utilize de acordo com o exemplo: 1,2-5,8"
     * )
     *
     * @Gedmo\Versioned
     * @ORM\Column(
     *     type="string",
     *     name="digitos_distribuicao",
     *     nullable=true
     * )
     */
    protected ?string $digitosDistribuicao = null;

    /**
     * @Assert\Regex(
     *     pattern="/^\d{2}(-\d{2})?(,\d{2}(-\d{2})?)*$/",
     *     message="Formato inválido, utilize de acordo com o exemplo: 01,20-50,80"
     * )
     *
     * @Gedmo\Versioned
     * @ORM\Column(
     *     type="string",
     *     name="centenas_distribuicao",
     *     nullable=true
     * )
     */
    protected ?string $centenasDistribuicao = null;

    /**
     * @param $colaborador
     *
     * @return Lotacao
     */
    public function setColaborador(Colaborador $colaborador): self
    {
        $this->colaborador = $colaborador;

        return $this;
    }

    /**
     * @return Colaborador
     */
    public function getColaborador(): Colaborador
    {
        return $this->colaborador;
    }

    /**
     * @param $setor
     *
     * @return Lotacao
     */
    public function setSetor(Setor $setor): self
    {
        $this->setor = $setor;

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
     * @return int
     */
    public function getPeso(): int
    {
        return $this->peso;
    }

    /**
     * @param int $peso
     *
     * @return Lotacao
     */
    public function setPeso(int $peso): self
    {
        $this->peso = $peso;

        return $this;
    }

    /**
     * @return bool
     */
    public function getPrincipal(): bool
    {
        return $this->principal;
    }

    /**
     * @param bool $principal
     *
     * @return Lotacao
     */
    public function setPrincipal(bool $principal): self
    {
        $this->principal = $principal;

        return $this;
    }

    /**
     * @return bool
     */
    public function getDistribuidor(): bool
    {
        return $this->distribuidor;
    }

    /**
     * @param bool $distribuidor
     *
     * @return Lotacao
     */
    public function setDistribuidor(bool $distribuidor): self
    {
        $this->distribuidor = $distribuidor;

        return $this;
    }

    /**
     * @return bool
     */
    public function getArquivista(): bool
    {
        return $this->arquivista;
    }

    /**
     * @param bool $arquivista
     *
     * @return Lotacao
     */
    public function setArquivista(bool $arquivista): self
    {
        $this->arquivista = $arquivista;

        return $this;
    }

    /**
     * @return bool
     */
    public function getPcu(): bool
    {
        return $this->pcu;
    }

    /**
     * @param bool $pcu
     *
     * @return Lotacao
     */
    public function setPcu(bool $pcu): self
    {
        $this->pcu = $pcu;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDigitosDistribuicao(): ?string
    {
        return $this->digitosDistribuicao;
    }

    /**
     * @param string|null $digitosDistribuicao
     *
     * @return Lotacao
     */
    public function setDigitosDistribuicao(?string $digitosDistribuicao): self
    {
        $this->digitosDistribuicao = $digitosDistribuicao;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCentenasDistribuicao(): ?string
    {
        return $this->centenasDistribuicao;
    }

    /**
     * @param string|null $centenasDistribuicao
     *
     * @return Lotacao
     */
    public function setCentenasDistribuicao(?string $centenasDistribuicao): self
    {
        $this->centenasDistribuicao = $centenasDistribuicao;

        return $this;
    }
}
