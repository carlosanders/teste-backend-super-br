<?php

declare(strict_types=1);
/**
 * /src/Entity/VinculacaoTransicaoWorkflow.php.
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
 * Class VinculacaoTransicaoWorkflow.
 *
 *  @ORM\Table(
 *     name="ad_vinc_trans_workflow",
 *     uniqueConstraints={
 *          @ORM\UniqueConstraint(columns={"workflow_id", "transicao_workflow_id", "apagado_em"})
 *     }
 * )
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @UniqueEntity(
 *     fields = {"workflow", "transicaoWorkflow", "apagadoEm"},
 *     message = "A transição já está vinculada a um Workflow!"
 * )
 *
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class VinculacaoTransicaoWorkflow implements EntityInterface
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
     *     targetEntity="TransicaoWorkFlow",
     *     inversedBy="vinculacoesTransicaoWorkflow"
     * )
     * @ORM\JoinColumn(
     *     name="transicao_workflow_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected TransicaoWorkflow $transicaoWorkflow;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(
     *     targetEntity="Workflow",
     *     inversedBy="vinculacoesTransicaoWorkflow"
     * )
     * @ORM\JoinColumn(
     *     name="workflow_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected Workflow $workflow;

    /**
     * @return TransicaoWorkflow
     */
    public function getTransicaoWorkflow(): TransicaoWorkflow
    {
        return $this->transicaoWorkflow;
    }

    /**
     * @param TransicaoWorkflow $transicaoWorkflow
     * @return $this
     */
    public function setTransicaoWorkflow(TransicaoWorkflow $transicaoWorkflow): self
    {
        $this->transicaoWorkflow = $transicaoWorkflow;

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
