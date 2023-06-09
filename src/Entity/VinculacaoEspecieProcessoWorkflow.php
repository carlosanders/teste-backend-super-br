<?php

declare(strict_types=1);
/**
 * /src/Entity/VinculacaoEspecieProcessoWorkflow.php.
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
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use SuppCore\AdministrativoBackend\Entity\Traits\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class VinculacaoEspecieProcessoWorkflow.
 *
 *  @ORM\Table(
 *     name="ad_vinc_esp_proc_workflow",
 *     uniqueConstraints={
 *          @ORM\UniqueConstraint(columns={"workflow_id", "especie_processo_id", "apagado_em"})
 *     }
 * )
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @UniqueEntity(
 *     fields = {"workflow", "especieProcesso", "apagadoEm"},
 *     message = "Espécie de Processo já vinculado ao Workflow!"
 * )
 *
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class VinculacaoEspecieProcessoWorkflow implements EntityInterface
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
     *     targetEntity="EspecieProcesso",
     *     inversedBy="vinculacoesEspecieProcessoWorkflow"
     * )
     * @ORM\JoinColumn(
     *     name="especie_processo_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected EspecieProcesso $especieProcesso;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(
     *     targetEntity="Workflow",
     *     inversedBy="vinculacoesEspecieProcessoWorkflow"
     * )
     * @ORM\JoinColumn(
     *     name="workflow_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected Workflow $workflow;

    /**
     * @return EspecieProcesso
     */
    public function getEspecieProcesso(): EspecieProcesso
    {
        return $this->especieProcesso;
    }

    /**
     * @param EspecieProcesso $especieProcesso
     * @return $this
     */
    public function setEspecieProcesso(EspecieProcesso $especieProcesso): self
    {
        $this->especieProcesso = $especieProcesso;

        return $this;
    }

    /**
     * @return Workflow
     */
    public function getWorkflow(): Workflow
    {
        return $this->workflow;
    }

    /**
     * @param Workflow $workflow
     * @return $this
     */
    public function setWorkflow(Workflow $workflow): self
    {
        $this->workflow = $workflow;

        return $this;
    }

}
