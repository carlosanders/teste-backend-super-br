<?php

declare(strict_types=1);
/**
 * /src/Entity/Traits/Timestampable.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Entity\Traits;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;

/**
 * Trait Timestampable.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
trait Timestampable
{
    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(
     *     name="criado_em",
     *     type="datetime",
     *     nullable=true
     * )
     */
    protected ?DateTime $criadoEm = null;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(
     *     name="atualizado_em",
     *     type="datetime",
     *     nullable=true
     * )
     */
    protected ?DateTime $atualizadoEm = null;

    /**
     * Sets criadoEm.
     *
     * @param DateTime $criadoEm
     *
     * @return EntityInterface|$this
     */
    public function setCriadoEm(DateTime $criadoEm)
    {
        $this->criadoEm = $criadoEm;

        return $this;
    }

    /**
     * Returns criadoEm.
     *
     * @return DateTime|null
     */
    public function getCriadoEm(): ?DateTime
    {
        return $this->criadoEm;
    }

    /**
     * Sets atualizadoEm.
     *
     * @param DateTime $atualizadoEm
     *
     * @return EntityInterface|$this
     */
    public function setAtualizadoEm(DateTime $atualizadoEm)
    {
        $this->atualizadoEm = $atualizadoEm;

        return $this;
    }

    /**
     * Returns atualizadoEm.
     *
     * @return DateTime|null
     */
    public function getAtualizadoEm(): ?DateTime
    {
        return $this->atualizadoEm;
    }
}
