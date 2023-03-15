<?php

declare(strict_types=1);
/**
 * /src/Entity/Healthz.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Entity;

use DateTime;
use DateTimeZone;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use SuppCore\AdministrativoBackend\Entity\Traits\Id;
use SuppCore\AdministrativoBackend\Entity\Traits\Uuid;

/**
 * Class Healthz.
 *
 *  @ORM\Table(
 *     name="ad_healthz",
 * )
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Healthz implements EntityInterface
{
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
        $this->setTimestamp(new DateTime('NOW', new DateTimeZone('UTC')));
    }

    /**
     * @ORM\Column(
     *     name="timestamp",
     *     type="datetime",
     *     nullable=false
     * )
     */
    protected DateTime $timestamp;

    /**
     * @return DateTime
     */
    public function getTimestamp(): DateTime
    {
        return $this->timestamp;
    }

    /**
     * @param DateTime $timestamp
     *
     * @return Healthz
     */
    public function setTimestamp(DateTime $timestamp): self
    {
        $this->timestamp = $timestamp;

        return $this;
    }
}
