<?php

declare(strict_types=1);
/**
 * /src/Counter/BaseCounter.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Counter;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class Counter0001.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class BaseCounter
{
    protected TokenStorageInterface $tokenStorage;

    /**
     * BaseCounter constructor.
     *
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(
        TokenStorageInterface $tokenStorage
    ) {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @return int
     */
    public function getOrder(): int
    {
        return 1;
    }
}
