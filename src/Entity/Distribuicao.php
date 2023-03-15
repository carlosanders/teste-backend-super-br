<?php

declare(strict_types=1);
/**
 * /src/Entity/Distribuicao.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use SuppCore\AdministrativoBackend\Entity\Traits\Blameable;
use SuppCore\AdministrativoBackend\Entity\Traits\Id;
use SuppCore\AdministrativoBackend\Entity\Traits\Timestampable;
use SuppCore\AdministrativoBackend\Entity\Traits\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Distribuicao.
 *
 *  @ORM\Table(
 *     name="ad_distribuicao",
 * )
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Distribuicao implements EntityInterface
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
     * @ORM\ManyToOne(
     *     targetEntity="Tarefa",
     *     inversedBy="distribuicoes"
     * )
     * @ORM\JoinColumn(
     *     name="tarefa_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected Tarefa $tarefa;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     * @ORM\Column(
     *     type="datetime",
     *     name="data_hora_distribuicao",
     *     nullable=false
     * )
     */
    protected DateTime $dataHoraDistribuicao;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="Usuario"
     * )
     * @ORM\JoinColumn(
     *     name="usuario_anterior_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?Usuario $usuarioAnterior = null;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(
     *     targetEntity="Usuario"
     * )
     * @ORM\JoinColumn(
     *     name="usuario_posterior_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected Usuario $usuarioPosterior;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="Setor"
     * )
     * @ORM\JoinColumn(
     *     name="setor_anterior_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?Setor $setorAnterior = null;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(
     *     targetEntity="Setor"
     * )
     * @ORM\JoinColumn(
     *     name="setor_posterior_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected Setor $setorPosterior;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     * @ORM\Column(
     *     type="boolean",
     *     name="distribuicao_automatica",
     *     nullable=false
     * )
     */
    protected bool $distribuicaoAutomatica = false;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     * @ORM\Column(
     *     type="boolean",
     *     name="livre_balanceamento",
     *     nullable=false
     * )
     */
    protected bool $livreBalanceamento = false;

    /**
     * @ORM\Column(
     *     type="text",
     *     name="auditoria_distribuicao",
     *     nullable=true
     * )
     */
    protected ?string $auditoriaDistribuicao = null;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     * @ORM\Column(
     *     type="integer",
     *     name="tipo_distribuicao",
     *     nullable=false
     * )
     */
    protected int $tipoDistribuicao = 0;

    /**
     * @return Tarefa
     */
    public function getTarefa(): Tarefa
    {
        return $this->tarefa;
    }

    /**
     * @param Tarefa $tarefa
     *
     * @return Distribuicao
     */
    public function setTarefa(Tarefa $tarefa): self
    {
        $this->tarefa = $tarefa;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDataHoraDistribuicao(): DateTime
    {
        return $this->dataHoraDistribuicao;
    }

    /**
     * @param DateTime $dataHoraDistribuicao
     *
     * @return Distribuicao
     */
    public function setDataHoraDistribuicao(DateTime $dataHoraDistribuicao): self
    {
        $this->dataHoraDistribuicao = $dataHoraDistribuicao;

        return $this;
    }

    /**
     * @return Usuario|null
     */
    public function getUsuarioAnterior(): ?Usuario
    {
        return $this->usuarioAnterior;
    }

    /**
     * @param Usuario|null $usuarioAnterior
     *
     * @return Distribuicao
     */
    public function setUsuarioAnterior(?Usuario $usuarioAnterior): self
    {
        $this->usuarioAnterior = $usuarioAnterior;

        return $this;
    }

    /**
     * @return Usuario
     */
    public function getUsuarioPosterior(): Usuario
    {
        return $this->usuarioPosterior;
    }

    /**
     * @param Usuario $usuarioPosterior
     *
     * @return Distribuicao
     */
    public function setUsuarioPosterior(Usuario $usuarioPosterior): self
    {
        $this->usuarioPosterior = $usuarioPosterior;

        return $this;
    }

    /**
     * @return Setor|null
     */
    public function getSetorAnterior(): ?Setor
    {
        return $this->setorAnterior;
    }

    /**
     * @param Setor|null $setorAnterior
     *
     * @return Distribuicao
     */
    public function setSetorAnterior(?Setor $setorAnterior): self
    {
        $this->setorAnterior = $setorAnterior;

        return $this;
    }

    /**
     * @return Setor
     */
    public function getSetorPosterior(): Setor
    {
        return $this->setorPosterior;
    }

    /**
     * @param Setor $setorPosterior
     *
     * @return Distribuicao
     */
    public function setSetorPosterior(Setor $setorPosterior): self
    {
        $this->setorPosterior = $setorPosterior;

        return $this;
    }

    /**
     * @return bool
     */
    public function getDistribuicaoAutomatica(): bool
    {
        return $this->distribuicaoAutomatica;
    }

    /**
     * @param bool $distribuicaoAutomatica
     *
     * @return Distribuicao
     */
    public function setDistribuicaoAutomatica(bool $distribuicaoAutomatica): self
    {
        $this->distribuicaoAutomatica = $distribuicaoAutomatica;

        return $this;
    }

    /**
     * @return bool
     */
    public function getLivreBalanceamento(): bool
    {
        return $this->livreBalanceamento;
    }

    /**
     * @param bool $livreBalanceamento
     *
     * @return Distribuicao
     */
    public function setLivreBalanceamento(bool $livreBalanceamento): self
    {
        $this->livreBalanceamento = $livreBalanceamento;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAuditoriaDistribuicao(): ?string
    {
        return $this->auditoriaDistribuicao;
    }

    /**
     * @param string|null $auditoriaDistribuicao
     *
     * @return Distribuicao
     */
    public function setAuditoriaDistribuicao(?string $auditoriaDistribuicao): self
    {
        $this->auditoriaDistribuicao = $auditoriaDistribuicao;

        return $this;
    }

    /**
     * @return int
     */
    public function getTipoDistribuicao(): int
    {
        return $this->tipoDistribuicao;
    }

    /**
     * @param int $tipoDistribuicao
     *
     * @return Distribuicao
     */
    public function setTipoDistribuicao(int $tipoDistribuicao): self
    {
        $this->tipoDistribuicao = $tipoDistribuicao;

        return $this;
    }
}
