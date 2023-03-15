<?php

declare(strict_types=1);
/**
 * /src/Entity/RegraEtiqueta.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
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
 * Class RegraEtiqueta.
 *
 *  @ORM\Table(
 *     name="ad_regra_etiqueta",
 * )
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class RegraEtiqueta implements EntityInterface
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
     *     targetEntity="Etiqueta",
     *     inversedBy="regrasEtiqueta"
     * )
     * @ORM\JoinColumn(
     *     name="etiqueta_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected Etiqueta $etiqueta;

    /**
     * @ORM\Column(
     *     type="text",
     *     nullable=true
     * )
     */
    protected ?string $criteria = null;

    /**
     * @return Etiqueta
     */
    public function getEtiqueta(): Etiqueta
    {
        return $this->etiqueta;
    }

    /**
     * @param Etiqueta $etiqueta
     *
     * @return RegraEtiqueta
     */
    public function setEtiqueta(Etiqueta $etiqueta): self
    {
        $this->etiqueta = $etiqueta;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCriteria(): ?string
    {
        return $this->criteria;
    }

    /**
     * @param string|null $criteria
     *
     * @return RegraEtiqueta
     */
    public function setCriteria(?string $criteria): self
    {
        $this->criteria = $criteria;

        return $this;
    }
}
