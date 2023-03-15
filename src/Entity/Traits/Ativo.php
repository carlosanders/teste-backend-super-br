<?php

declare(strict_types=1);
/**
 * /src/Entity/Traits/Ativo.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trait Ativo.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
trait Ativo
{
    /**
     * @ORM\Column(
     *     name="ativo",
     *     type="boolean",
     *     nullable=false
     * )
     */
    protected bool $ativo = true;

    /**
     * Set ativo.
     *
     * @param bool $ativo
     *
     * @return self
     */
    public function setAtivo(bool $ativo): self
    {
        $this->ativo = $ativo;

        return $this;
    }

    /**
     * Get ativo.
     *
     * @return bool
     */
    public function getAtivo(): bool
    {
        return $this->ativo;
    }
}
