<?php

declare(strict_types=1);
/**
 * /src/DTO/Traits/Timeblameable.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DTO\Traits;

use DateTime;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;
use OpenApi\Annotations as OA;

/**
 * Trait Blameable.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
trait Timeblameable
{
    /**
     * @OA\Property(type="string", format="date-time")
     * @DTOMapper\Property()
     */
    protected ?DateTime $criadoEm = null;

    /**
     * @OA\Property()
     * @DTOMapper\Property()
     */
    protected ?DateTime $atualizadoEm = null;

    /**
     * @return DateTime|null
     */
    public function getCriadoEm(): ?DateTime
    {
        return $this->criadoEm;
    }

    /**
     * @param DateTime|null $criadoEm
     *
     * @return self
     */
    public function setCriadoEm(?DateTime $criadoEm): self
    {
        $this->criadoEm = $criadoEm;

        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getAtualizadoEm(): ?DateTime
    {
        return $this->atualizadoEm;
    }

    /**
     * @param DateTime|null $atualizadoEm
     *
     * @return self
     */
    public function setAtualizadoEm(?DateTime $atualizadoEm): self
    {
        $this->atualizadoEm = $atualizadoEm;

        return $this;
    }
}
