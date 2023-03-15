<?php

declare(strict_types=1);
/**
 * /src/Helpers/LoggerAwareTrait.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Helpers;

use Psr\Log\LoggerInterface;

/**
 * Trait LoggerAwareTrait.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
trait LoggerAwareTrait
{
    protected LoggerInterface $logger;

    /**
     * @see https://symfony.com/doc/current/service_container/autowiring.html#autowiring-other-methods-e-g-setters
     *
     * @required
     *
     * @param LoggerInterface $logger
     *
     * @return self
     */
    public function setLogger(LoggerInterface $logger): self
    {
        $this->logger = $logger;

        return $this;
    }
}
