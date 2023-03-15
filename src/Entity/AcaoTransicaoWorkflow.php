<?php

declare(strict_types=1);
/**
 * /src/Entity/AcaoTransicaoWorkflow.php.
 */

namespace SuppCore\AdministrativoBackend\Entity;

use DMS\Filter\Rules as Filter;
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
 * Class AcaoTransicaoWorkflow.
 *
 *  @ORM\Table(
 *     name="ad_acao_trans_workflow",
 * )
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 */
class AcaoTransicaoWorkflow implements EntityInterface
{
    // Traits
    use Blameable;
    use Timestampable;
    use Softdeleteable;
    use Id;
    use Uuid;

    /**
     * constructor.
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
     *     targetEntity="TransicaoWorkflow",
     *     inversedBy="acoes"
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
     *     targetEntity="TipoAcaoWorkflow",
     *     inversedBy="acoes"
     * )
     * @ORM\JoinColumn(
     *     name="tipo_acao_workflow_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected TipoAcaoWorkflow $tipoAcaoWorkflow;

    /**
     * @ORM\Column(
     *     type="text",
     *     nullable=true
     * )
     */
    protected ?string $contexto = null;

    /**
     * @return TransicaoWorkflow
     */
    public function getTransicaoWorkflow(): TransicaoWorkflow
    {
        return $this->transicaoWorkflow;
    }

    /**
     * @param TransicaoWorkflow $transicaoWorkflow
     */
    public function setTransicaoWorkflow(TransicaoWorkflow $transicaoWorkflow): self
    {
        $this->transicaoWorkflow = $transicaoWorkflow;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getContexto(): ?string
    {
        return $this->contexto;
    }

    /**
     * @param string|null $contexto
     *
     * @return Acao
     */
    public function setContexto(?string $contexto): self
    {
        $this->contexto = $contexto;

        return $this;
    }

    /**
     * @return TipoAcaoWorkflow
     */
    public function getTipoAcaoWorkflow(): TipoAcaoWorkflow
    {
        return $this->tipoAcaoWorkflow;
    }

    /**
     * @param TipoAcaoWorkflow $tipoAcaoWorkflow
     * @return self
     */
    public function setTipoAcaoWorkflow(TipoAcaoWorkflow $tipoAcaoWorkflow): self
    {
        $this->tipoAcaoWorkflow = $tipoAcaoWorkflow;

        return $this;
    }

}
