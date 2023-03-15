<?php

declare(strict_types=1);
/**
 * /src/Entity/TipoAcaoWorkflow.php.
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
 * Class TipoAcaoWorkflow.
 *
 *  @ORM\Table(
 *     name="ad_tipo_acao_workflow",
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
class TipoAcaoWorkflow implements EntityInterface
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
     * @var Collection|ArrayCollection|ArrayCollection<AcaoTransicaoWorkflow>
     *
     * @ORM\OneToMany(
     *     targetEntity="AcaoTransicaoWorkflow",
     *     mappedBy="tipoAcaoWorkflow"
     * )
     */
    protected $acoes;

    /**
     * TipoAcaoWorkflow constructor.
     *
     * @throws Exception
     */
    public function __construct()
    {
        $this->setUuid();
        $this->acoes = new ArrayCollection();
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
     * @return Collection|ArrayCollection|ArrayCollection<AcaoTransicaoWorkflow>
     */
    public function getAcoes(): Collection
    {
        return $this->acoes;
    }

    /**
     * @param AcaoTransicaoWorkflow $acao
     *
     * @return self
     */
    public function addAcao(AcaoTransicaoWorkflow $acao): self
    {
        if (!$this->acoes->contains($acao)) {
            $this->acoes->add($acao);
            $acao->setEtiqueta($this);
        }

        return $this;
    }

    /**
     * @param AcaoTransicaoWorkflow $acao
     *
     * @return self
     */
    public function removeAcao(AcaoTransicaoWorkflow $acao): self
    {
        if ($this->acoes->contains($acao)) {
            $this->acoes->removeElement($acao);
        }

        return $this;
    }
}
