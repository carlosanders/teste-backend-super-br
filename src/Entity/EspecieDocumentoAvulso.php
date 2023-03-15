<?php

declare(strict_types=1);
/**
 * /src/Entity/EspecieDocumentoAvulso.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Entity;

use Doctrine\ORM\Mapping as ORM;
use Exception;
use Gedmo\Mapping\Annotation as Gedmo;
use SuppCore\AdministrativoBackend\Doctrine\ORM\Enableable\Enableable;
use SuppCore\AdministrativoBackend\Entity\Traits\Ativo;
use SuppCore\AdministrativoBackend\Entity\Traits\Blameable;
use SuppCore\AdministrativoBackend\Entity\Traits\Descricao;
use SuppCore\AdministrativoBackend\Entity\Traits\Id;
use SuppCore\AdministrativoBackend\Entity\Traits\Nome;
use SuppCore\AdministrativoBackend\Entity\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\Entity\Traits\Timestampable;
use SuppCore\AdministrativoBackend\Entity\Traits\Uuid;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class EspecieDocumentoAvulso.
 *
 *  @ORM\Table(
 *     name="ad_especie_doc_avulso",
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(columns={"nome", "genero_doc_avulso_id", "apagado_em"}),
 *     }
 * )
 *
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 *
 * @UniqueEntity(
 *     fields = {"nome", "generoDocumentoAvulso"},
 *     message = "Nome já está em utilização para esse gênero!"
 * )
 *
 * @Enableable()
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class EspecieDocumentoAvulso implements EntityInterface
{
    // Traits
    use Blameable;
    use Timestampable;
    use Softdeleteable;
    use Id;
    use Uuid;
    use Nome;
    use Descricao;
    use Ativo;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(targetEntity="GeneroDocumentoAvulso")
     * @ORM\JoinColumn(
     *     name="genero_doc_avulso_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?GeneroDocumentoAvulso $generoDocumentoAvulso = null;

    /**
     * @ORM\ManyToOne(targetEntity="EspecieProcesso")
     * @ORM\JoinColumn(
     *     name="especie_processo_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?EspecieProcesso $especieProcesso = null;

    /**
     * @ORM\ManyToOne(targetEntity="Workflow")
     * @ORM\JoinColumn(
     *     name="workflow_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?Workflow $workflow = null;

    /**
     * @ORM\ManyToOne(targetEntity="EspecieTarefa")
     * @ORM\JoinColumn(
     *     name="especie_tarefa_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?EspecieTarefa $especieTarefa = null;

    /**
     * EspecieDocumentoAvulso constructor.
     *
     * @throws Exception
     */
    public function __construct()
    {
        $this->setUuid();
    }

    /**
     * @return GeneroDocumentoAvulso
     */
    public function getGeneroDocumentoAvulso(): GeneroDocumentoAvulso
    {
        return $this->generoDocumentoAvulso;
    }

    /**
     * @param GeneroDocumentoAvulso $generoDocumentoAvulso
     *
     * @return self
     */
    public function setGeneroDocumentoAvulso(GeneroDocumentoAvulso $generoDocumentoAvulso): self
    {
        $this->generoDocumentoAvulso = $generoDocumentoAvulso;

        return $this;
    }

    /**
     * @return EspecieProcesso|null
     */
    public function getEspecieProcesso(): ?EspecieProcesso
    {
        return $this->especieProcesso;
    }

    /**
     * @param EspecieProcesso|null $especieProcesso
     * @return self
     */
    public function setEspecieProcesso(?EspecieProcesso $especieProcesso): self
    {
        $this->especieProcesso = $especieProcesso;

        return $this;
    }

    /**
     * @return EspecieTarefa|null
     */
    public function getEspecieTarefa(): ?EspecieTarefa
    {
        return $this->especieTarefa;
    }

    /**
     * @param EspecieTarefa|null $especieTarefa
     * @return self
     */
    public function setEspecieTarefa(?EspecieTarefa $especieTarefa): self
    {
        $this->especieTarefa = $especieTarefa;

        return $this;
    }

    /**
     * @return Workflow|null
     */
    public function getWorkflow(): ?Workflow
    {
        return $this->workflow;
    }

    /**
     * @param Workflow|null $workflow
     * @return self
     */
    public function setWorkflow(?Workflow $workflow): self
    {
        $this->workflow = $workflow;

        return $this;
    }

}
