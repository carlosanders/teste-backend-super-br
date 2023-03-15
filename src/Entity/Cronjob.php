<?php

declare(strict_types=1);
/**
 * /src/Entity/Cronjob.php.
 */

namespace SuppCore\AdministrativoBackend\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Gedmo\Mapping\Annotation as Gedmo;
use SuppCore\AdministrativoBackend\Entity\Traits\Ativo;
use SuppCore\AdministrativoBackend\Entity\Traits\Descricao;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use SuppCore\AdministrativoBackend\Doctrine\ORM\Enableable\Enableable;
use SuppCore\AdministrativoBackend\Entity\Traits\Blameable;
use SuppCore\AdministrativoBackend\Entity\Traits\Id;
use SuppCore\AdministrativoBackend\Entity\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\Entity\Traits\Timestampable;
use SuppCore\AdministrativoBackend\Entity\Traits\Uuid;
use \SuppCore\AdministrativoBackend\Entity\Traits\Nome;
use DMS\Filter\Rules as Filter;

/**
 * Class Cronjob.
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 * @ORM\Table(
 *     name="ad_cronjob",
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(columns={"nome", "apagado_em"}),
 *     }
 * )
 * @UniqueEntity(
 *     fields = {"nome"},
 *     message = "Nome já está em utilização!"
 * )
 * @Enableable()
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 */
class Cronjob implements EntityInterface
{
    public const ST_EXECUCAO_ERRO = 0;
    public const ST_EXECUCAO_EM_EXECUCAO = 1;
    public const ST_EXECUCAO_SUCESSO = 2;

    // Traits
    use Blameable;
    use Timestampable;
    use Softdeleteable;
    use Id;
    use Uuid;
    use Ativo;
    use Nome;
    use Descricao;

    /**
     * Constructor.
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
     * @Filter\ToUpper(encoding="UTF-8")
     * @Assert\Length(
     *     max = 255,
     *     maxMessage = "O campo deve ter no máximo 255 caracteres!"
     * )
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     * @Assert\NotBlank(
     *     message="O campo não pode estar em branco!"
     * )
     * @ORM\Column(
     *     type="string",
     *     nullable=false
     * )
     */
    protected ?string $periodicidade = '';

    /**
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Assert\Length(
     *     max = 255,
     *     maxMessage = "O campo deve ter no máximo 255 caracteres!"
     * )
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     * @Assert\NotBlank(
     *     message="O campo não pode estar em branco!"
     * )
     * @ORM\Column(
     *     type="string",
     *     nullable=false
     * )
     */
    protected ?string $comando = '';

    /**
     * @ORM\ManyToOne(
     *     targetEntity="Usuario"
     * )
     * @ORM\JoinColumn(
     *     name="usuario_ultima_execucao",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?Usuario $usuarioUltimaExecucao = null;

    /**
     * @ORM\Column(
     *     type="integer",
     *     name="status_ultima_execucao",
     *     nullable=true
     * )
     */
    protected ?int $statusUltimaExecucao = null;

    /**
     * @ORM\Column(
     *     type="integer",
     *     name="ultimo_pid",
     *     nullable=true
     * )
     */
    protected ?int $ultimoPid = null;

    /**
     * @Assert\Range(
     *      min = 0,
     *      max = 100,
     *     notInRangeMessage="O campo deve ter um valor entre 0 e 100"
     * )
     * @ORM\Column(
     *     type="float",
     *     name="percentual_execucao",
     *     nullable=true
,     * )
     */
    protected ?float $percentualExecucao = null;

    /**
     * @ORM\Column(
     *     type="datetime",
     *     name="data_hora_ultima_execucao",
     *     nullable=true
     * )
     */
    protected ?DateTimeInterface $dataHoraUltimaExecucao = null;

    /**
     * @ORM\Column(
     *     type="boolean",
     *     name="sincrono",
     *     nullable=true
     * )
     */
    protected ?bool $sincrono = true;

    /**
     * @return string|null
     */
    public function getNome(): ?string
    {
        return $this->nome;
    }

    /**
     * @param string|null $nome
     * @return $this
     */
    public function setNome(?string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    /**
     * @param string|null $descricao
     * @return $this
     */
    public function setDescricao(?string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPeriodicidade(): ?string
    {
        return $this->periodicidade;
    }

    /**
     * @param string|null $periodicidade
     * @return $this
     */
    public function setPeriodicidade(?string $periodicidade): self
    {
        $this->periodicidade = $periodicidade;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getComando(): ?string
    {
        return $this->comando;
    }

    /**
     * @param string|null $comando
     * @return $this
     */
    public function setComando(?string $comando): self
    {
        $this->comando = $comando;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getStatusUltimaExecucao(): ?int
    {
        return $this->statusUltimaExecucao;
    }

    /**
     * @param int|null $statusUltimaExecucao
     * @return $this
     */
    public function setStatusUltimaExecucao(?int $statusUltimaExecucao): self
    {
        $this->statusUltimaExecucao = $statusUltimaExecucao;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getDataHoraUltimaExecucao(): ?DateTimeInterface
    {
        return $this->dataHoraUltimaExecucao;
    }

    /**
     * @param DateTimeInterface|null $dataHoraUltimaExecucao
     * @return $this
     */
    public function setDataHoraUltimaExecucao(?DateTimeInterface $dataHoraUltimaExecucao): self
    {
        $this->dataHoraUltimaExecucao = $dataHoraUltimaExecucao;

        return $this;
    }

    /**
     * @return Usuario|null
     */
    public function getUsuarioUltimaExecucao(): ?Usuario
    {
        return $this->usuarioUltimaExecucao;
    }

    /**
     * @param Usuario|null $usuarioUltimaExecucao
     * @return $this
     */
    public function setUsuarioUltimaExecucao(?Usuario $usuarioUltimaExecucao): self
    {
        $this->usuarioUltimaExecucao = $usuarioUltimaExecucao;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getUltimoPid(): ?int
    {
        return $this->ultimoPid;
    }

    /**
     * @param int|null $ultimoPid
     * @return $this
     */
    public function setUltimoPid(?int $ultimoPid): self
    {
        $this->ultimoPid = $ultimoPid;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getPercentualExecucao(): ?float
    {
        return $this->percentualExecucao;
    }

    /**
     * @param float|null $percentualExecucao
     * @return $this
     */
    public function setPercentualExecucao(?float $percentualExecucao): self
    {
        $this->percentualExecucao = $percentualExecucao;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getSincrono(): ?bool
    {
        return $this->sincrono;
    }

    /**
     * @param bool|null $sincrono
     * @return self
     */
    public function setSincrono(?bool $sincrono): self
    {
        $this->sincrono = $sincrono;

        return $this;
    }

}
