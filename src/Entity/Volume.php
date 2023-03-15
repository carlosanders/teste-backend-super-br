<?php

declare(strict_types=1);
/**
 * /src/Entity/Volume.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Gedmo\Mapping\Annotation as Gedmo;
use SuppCore\AdministrativoBackend\Entity\Traits\Blameable;
use SuppCore\AdministrativoBackend\Entity\Traits\Id;
use SuppCore\AdministrativoBackend\Entity\Traits\Timestampable;
use SuppCore\AdministrativoBackend\Entity\Traits\Uuid;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Volume.
 *
 *  @ORM\Table(
 *     name="ad_volume",
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(columns={"numeracao_sequencial", "processo_id"}),
 *     }
 * )
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @Gedmo\Loggable
 *
 * @UniqueEntity(
 *     fields = {"numeracaoSequencial", "processo"},
 *     message = "Numeração Sequencial já está em utilização para essa processo!"
 * )
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Volume implements EntityInterface
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
     *     name="numeracao_sequencial",
     *     nullable=false
     * )
     */
    protected int $numeracaoSequencial;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @Gedmo\Versioned
     *
     * @ORM\ManyToOne(
     *     targetEntity="ModalidadeMeio"
     * )
     * @ORM\JoinColumn(
     *     name="mod_meio_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected ModalidadeMeio $modalidadeMeio;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @Gedmo\Versioned
     * @ORM\Column(
     *     type="boolean",
     *     nullable=false
     * )
     */
    protected bool $encerrado = false;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(
     *     targetEntity="Processo",
     *     inversedBy="volumes"
     * )
     * @ORM\JoinColumn(
     *     name="processo_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected Processo $processo;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="OrigemDados",
     *     cascade={"persist"}
     * )
     * @ORM\JoinColumn(
     *     name="origem_dados_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?OrigemDados $origemDados = null;

    /**
     * @var Collection|ArrayCollection|Collection<Juntada>|ArrayCollection<Juntada>
     *
     * @ORM\OneToMany(
     *     targetEntity="Juntada",
     *     mappedBy="volume",
     *     cascade={"all"}
     * )
     * @ORM\OrderBy({"numeracaoSequencial" = "ASC"})
     */
    protected $juntadas;

    /**
     * @return int
     */
    public function getNumeracaoSequencial(): int
    {
        return $this->numeracaoSequencial;
    }

    /**
     * @param int $numeracaoSequencial
     *
     * @return Volume
     */
    public function setNumeracaoSequencial(int $numeracaoSequencial): self
    {
        $this->numeracaoSequencial = $numeracaoSequencial;

        return $this;
    }

    /**
     * @return ModalidadeMeio
     */
    public function getModalidadeMeio(): ?ModalidadeMeio
    {
        return $this->modalidadeMeio;
    }

    /**
     * @param ModalidadeMeio $modalidadeMeio
     *
     * @return Volume
     */
    public function setModalidadeMeio(?ModalidadeMeio $modalidadeMeio): self
    {
        $this->modalidadeMeio = $modalidadeMeio;

        return $this;
    }

    /**
     * @return bool
     */
    public function getEncerrado(): bool
    {
        return $this->encerrado;
    }

    /**
     * @param bool $encerrado
     *
     * @return Volume
     */
    public function setEncerrado(bool $encerrado): self
    {
        $this->encerrado = $encerrado;

        return $this;
    }

    /**
     * @return Processo
     */
    public function getProcesso(): Processo
    {
        return $this->processo;
    }

    /**
     * @param Processo $processo
     *
     * @return Volume
     */
    public function setProcesso(Processo $processo): self
    {
        $this->processo = $processo;

        return $this;
    }

    /**
     * @return OrigemDados|null
     */
    public function getOrigemDados(): ?OrigemDados
    {
        return $this->origemDados;
    }

    /**
     * @param OrigemDados|null $origemDados
     *
     * @return Volume
     */
    public function setOrigemDados(?OrigemDados $origemDados): self
    {
        $this->origemDados = $origemDados;

        return $this;
    }

    /**
     * @param Juntada $juntada
     *
     * @return Volume
     */
    public function addJuntada(Juntada $juntada): self
    {
        if (!$this->juntadas->contains($juntada)) {
            $this->juntadas[] = $juntada;
            $juntada->setVolume($this);
        }

        return $this;
    }

    /**
     * @param Juntada $juntada
     *
     * @return Volume
     */
    public function removeJuntada(Juntada $juntada): self
    {
        if ($this->juntadas->contains($juntada)) {
            $this->juntadas->removeElement($juntada);
        }

        return $this;
    }

    /**
     * @return Collection|ArrayCollection|ArrayCollection<Juntada>
     */
    public function getJuntadas(): Collection
    {
        return $this->juntadas;
    }
}
