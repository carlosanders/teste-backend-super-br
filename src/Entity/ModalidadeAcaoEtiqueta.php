<?php

declare(strict_types=1);
/**
 * /src/Entity/ModalidadeAcaoEtiqueta.php.
 */

namespace SuppCore\AdministrativoBackend\Entity;

use DMS\Filter\Rules as Filter;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Gedmo\Mapping\Annotation as Gedmo;
use SuppCore\AdministrativoBackend\Doctrine\ORM\Enableable\Enableable;
use SuppCore\AdministrativoBackend\Entity\Traits\Ativo;
use SuppCore\AdministrativoBackend\Entity\Traits\Blameable;
use SuppCore\AdministrativoBackend\Entity\Traits\Descricao;
use SuppCore\AdministrativoBackend\Entity\Traits\Id;
use SuppCore\AdministrativoBackend\Entity\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\Entity\Traits\Timestampable;
use SuppCore\AdministrativoBackend\Entity\Traits\Uuid;
use SuppCore\AdministrativoBackend\Entity\Traits\Valor;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Class ModalidadeAcaoEtiqueta.
 *
 *  @ORM\Table(
 *     name="ad_mod_acao_etiqueta",
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(columns={"valor", "apagado_em"}),
 *     }
 * )
 *
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 *
 * @UniqueEntity(
 *     fields = {"valor"},
 *     message = "Valor já está em utilização para essa modalidade!"
 * )
 *
 * @Enableable()
 *
 */
class ModalidadeAcaoEtiqueta implements EntityInterface
{
    // Traits
    use Blameable;
    use Timestampable;
    use Softdeleteable;
    use Id;
    use Uuid;
    use Valor;
    use Descricao;
    use Ativo;

    /**
     * Modalidade da etiqueta.
     *
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(
     *     targetEntity="ModalidadeEtiqueta"
     * )
     * @ORM\JoinColumn(
     *     name="mod_etiqueta_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected ModalidadeEtiqueta $modalidadeEtiqueta;

    /**
     * .
     *
     * @Filter\Trim()
     * @Filter\StripNewlines()
     *
     * @Assert\NotBlank(
     *     message="O campo não pode estar em branco!"
     * )
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     * @ORM\Column(
     *     name="trigger_name",
     *     type="string",
     *     nullable=false
     * )
     */
    protected string $trigger;

    /**
     * @var Collection|ArrayCollection|ArrayCollection<Acao>
     *
     * @ORM\OneToMany(
     *     targetEntity="Acao",
     *     mappedBy="modalidadeAcaoEtiqueta"
     * )
     */
    protected $acoes;

    /**
     * ModalidadeAfastamento constructor.
     *
     * @throws Exception
     */
    public function __construct()
    {
        $this->setUuid();
        $this->acoes = new ArrayCollection();
    }


    /**
     * @param ModalidadeEtiqueta $modalidadeEtiqueta
     *
     * @return self
     */
    public function setModalidadeEtiqueta(ModalidadeEtiqueta $modalidadeEtiqueta): self
    {
        $this->modalidadeEtiqueta = $modalidadeEtiqueta;

        return $this;
    }

    /**
     * @return ModalidadeEtiqueta
     */
    public function getModalidadeEtiqueta(): ModalidadeEtiqueta
    {
        return $this->modalidadeEtiqueta;
    }

    /**
     * Set trigger.
     *
     * @param string $trigger
     *
     * @return self
     */
    public function setTrigger(string $trigger): self
    {
        $this->trigger = $trigger;

        return $this;
    }

    /**
     * Get trigger.
     *
     * @return string
     */
    public function getTrigger(): string
    {
        return $this->trigger;
    }

    /**
     * @return Collection|ArrayCollection|ArrayCollection<Acao>
     */
    public function getAcoes(): Collection
    {
        return $this->acoes;
    }

    /**
     * @param Acao $acao
     *
     * @return self
     */
    public function addAcao(Acao $acao): self
    {
        if (!$this->acoes->contains($acao)) {
            $this->acoes->add($acao);
            $acao->setEtiqueta($this);
        }

        return $this;
    }

    /**
     * @param Acao $acao
     *
     * @return self
     */
    public function removeAcao(Acao $acao): self
    {
        if ($this->acoes->contains($acao)) {
            $this->acoes->removeElement($acao);
        }

        return $this;
    }
}
