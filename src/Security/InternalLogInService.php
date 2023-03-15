<?php

declare(strict_types=1);

namespace SuppCore\AdministrativoBackend\Security;

use SuppCore\AdministrativoBackend\Entity\Usuario;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

/**
 * Class InternalLogInService.
 */
class InternalLogInService
{
    private RolesService $roleService;
    private TokenStorageInterface $tokenStorage;

    /**
     * InternalLogInService constructor.
     *
     * @param RolesService          $roleService
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(
        RolesService $roleService,
        TokenStorageInterface $tokenStorage,
    ) {
        $this->roleService = $roleService;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @param Usuario $usuario
     */
    public function logUserIn(Usuario $usuario)
    {
        $roles = $this->roleService->getContextualRoles($usuario);

        $token = new UsernamePasswordToken(
            $usuario,
            'main',
            $roles
        );

        $this->tokenStorage->setToken($token);
    }
}
