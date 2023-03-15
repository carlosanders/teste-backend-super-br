<?php

declare(strict_types=1);
/**
 * /src/Entity/UserInterface.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Entity;

/**
 * Interface UserInterface.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
interface UserInterface
{
    /**
     * @return int|null
     */
    public function getId(): ?int;

    /**
     * @return string|null
     */
    public function getUuid(): ?string;

    /**
     * @return string
     */
    public function getUsername(): string;

    /**
     * @return string
     */
    public function getEmail(): string;
}
