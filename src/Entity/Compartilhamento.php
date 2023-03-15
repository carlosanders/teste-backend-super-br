<?php

declare(strict_types=1);
/**
 * /src/Entity/Compartilhamento.php.
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
 * Class Compartilhamento.
 *
 *  @ORM\Table(
 *     name="ad_compartilhamento",
 * )
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Compartilhamento implements EntityInterface
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
     * @ORM\ManyToOne(
     *     targetEntity="Tarefa",
     *     inversedBy="compartilhamentos"
     * )
     * @ORM\JoinColumn(
     *     name="tarefa_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?Tarefa $tarefa = null;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="Processo",
     *     inversedBy="compartilhamentos"
     * )
     * @ORM\JoinColumn(
     *     name="processo_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?Processo $processo = null;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(
     *     targetEntity="Usuario"
     * )
     * @ORM\JoinColumn(
     *     name="usuario_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected Usuario $usuario;

    /**
     * @ORM\Column(
     *     type="boolean",
     *     nullable=false
     * )
     */
    protected bool $assessor = false;

    /**
     * @return Tarefa|null
     */
    public function getTarefa(): ?Tarefa
    {
        return $this->tarefa;
    }

    /**
     * @param Tarefa|null $tarefa
     *
     * @return Compartilhamento
     */
    public function setTarefa(?Tarefa $tarefa): self
    {
        $this->tarefa = $tarefa;

        return $this;
    }

    /**
     * @return Processo|null
     */
    public function getProcesso(): ?Processo
    {
        return $this->processo;
    }

    /**
     * @param Processo|null $processo
     *
     * @return Compartilhamento
     */
    public function setProcesso(?Processo $processo): self
    {
        $this->processo = $processo;

        return $this;
    }

    /**
     * @return Usuario
     */
    public function getUsuario(): Usuario
    {
        return $this->usuario;
    }

    /**
     * @param Usuario $usuario
     *
     * @return Compartilhamento
     */
    public function setUsuario(Usuario $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * @return bool
     */
    public function getAssessor(): bool
    {
        return $this->assessor;
    }

    /**
     * @param bool $assessor
     *
     * @return Compartilhamento
     */
    public function setAssessor(bool $assessor): self
    {
        $this->assessor = $assessor;

        return $this;
    }
}
