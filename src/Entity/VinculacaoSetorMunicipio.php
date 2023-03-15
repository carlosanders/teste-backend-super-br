<?php

declare(strict_types=1);
/**
 * /src/Entity/VinculacaoSetorMunicipio.php.
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

/**
 * Class VinculacaoSetorMunicipio.
 *
 *  @ORM\Table(
 *     name="ad_vinc_setor_municipio"
 * )
 *
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 *
 * @Gedmo\Loggable
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class VinculacaoSetorMunicipio implements EntityInterface
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
     *     targetEntity="Setor"
     * )
     * @ORM\JoinColumn(
     *     name="setores_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected ?Setor $setor = null;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="Municipio"
     * )
     * @ORM\JoinColumn(
     *     name="municipios_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected ?Municipio $municipio = null;

    /**
     * @return Setor
     */
    public function getSetor(): Setor
    {
        return $this->setor;
    }

    /**
     * @param Setor $setor
     *
     * @return VinculacaoSetorMunicipio
     */
    public function setSetor(Setor $setor): self
    {
        $this->setor = $setor;

        return $this;
    }

    /**
     * @return Municipio
     */
    public function getMunicipio(): Municipio
    {
        return $this->municipio;
    }

    /**
     * @param Municipio $municipio
     *
     * @return VinculacaoSetorMunicipio
     */
    public function setMunicipio(Municipio $municipio): self
    {
        $this->municipio = $municipio;

        return $this;
    }
}
