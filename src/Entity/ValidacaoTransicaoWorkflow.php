<?php

declare(strict_types=1);
/**
 * /src/Entity/ValidacaoTransicaoWorkflow.php.
 */

namespace SuppCore\AdministrativoBackend\Entity;

use Doctrine\ORM\Mapping as ORM;
use Exception;
use Gedmo\Mapping\Annotation as Gedmo;
use SuppCore\AdministrativoBackend\Entity\Traits\Blameable;
use SuppCore\AdministrativoBackend\Entity\Traits\Descricao;
use SuppCore\AdministrativoBackend\Entity\Traits\Id;
use SuppCore\AdministrativoBackend\Entity\Traits\Nome;
use SuppCore\AdministrativoBackend\Entity\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\Entity\Traits\Timestampable;
use SuppCore\AdministrativoBackend\Entity\Traits\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class ValidacaoTransicaoWorkflow.
 *
 *  @ORM\Table(
 *     name="ad_val_trans_workflow",
 * )
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 */
class ValidacaoTransicaoWorkflow implements EntityInterface
{
    // Traits
    use Blameable;
    use Timestampable;
    use Softdeleteable;
    use Nome;
    use Descricao;
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
     *     targetEntity="TransicaoWorkflow",
     *     inversedBy="validacoes"
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
     *     targetEntity="TipoValidacaoWorkflow",
     *     inversedBy="validacoes"
     * )
     * @ORM\JoinColumn(
     *     name="tipo_valid_workflow_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected TipoValidacaoWorkflow $tipoValidacaoWorkflow;

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
     *
     * @return ValidacaoTransicaoWorkflow
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
     * @return ValidacaoTransicaoWorkflow
     */
    public function setContexto(?string $contexto): self
    {
        $this->contexto = $contexto;

        return $this;
    }

    /**
     * @return TipoValidacaoWorkflow
     */
    public function getTipoValidacaoWorkflow(): TipoValidacaoWorkflow
    {
        return $this->tipoValidacaoWorkflow;
    }

    /**
     * @param TipoValidacaoWorkflow $tipoValidacaoWorkflow
     * @return self
     */
    public function setTipoValidacaoWorkflow(TipoValidacaoWorkflow $tipoValidacaoWorkflow): self
    {
        $this->tipoValidacaoWorkflow = $tipoValidacaoWorkflow;

        return $this;
    }

}
