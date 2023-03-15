<?php

declare(strict_types=1);

namespace SuppCore\AdministrativoBackend\Utils;

use SuppCore\AdministrativoBackend\Entity\Setor;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * Class Coordenador.
 *
 * @author Lucas Campelo <lucas.campelo@agu.gov.br>
 */
class CoordenadorService
{
    private TokenStorageInterface $tokenStorage;

    private AuthorizationCheckerInterface $authorizationChecker;

    /**
     * Coordenador constructor.
     *
     * @param TokenStorageInterface         $tokenStorage
     * @param AuthorizationCheckerInterface $authorizationChecker
     */
    public function __construct(
        TokenStorageInterface $tokenStorage,
        AuthorizationCheckerInterface $authorizationChecker
    ) {
        $this->tokenStorage = $tokenStorage;
        $this->authorizationChecker = $authorizationChecker;
    }

    /**
     * Verifica se o usuário autenticado é `Coordenador` de um dos setores recebidos.
     *
     * @param Setor[] $setores
     *
     * @return bool
     */
    public function verificaUsuarioCoordenadorSetor(array $setores): bool
    {
        $isCoordenador = false;

        foreach ($setores as $setor) {
            $roleCoordenador = sprintf('ROLE_COORDENADOR_SETOR_%s', $setor->getId());
            $isCoordenador |= $this->authorizationChecker->isGranted($roleCoordenador);
        }

        return (bool) $isCoordenador;
    }

    /**
     * Verifica se o usuário autenticado é `CoordenadorUnidade` de um dos setores recebidos.
     *
     * @param Setor[] $unidades
     *
     * @return bool
     */
    public function verificaUsuarioCoordenadorUnidade(array $unidades): bool
    {
        $isCoordenador = false;

        foreach ($unidades as $unidade) {
            $roleCoordenador = sprintf('ROLE_COORDENADOR_UNIDADE_%s', $unidade->getId());
            $isCoordenador |= $this->authorizationChecker->isGranted($roleCoordenador);
        }

        return (bool) $isCoordenador;
    }

    /**
     * Verifica se o usuário autenticado é `CoordenadorOrgaoCentral` de uma das unidades recebidas.
     *
     * @param Setor[] $orgaosCentrais
     *
     * @return bool
     */
    public function verificaUsuarioCoordenadorOrgaoCentral(array $orgaosCentrais): bool
    {
        $isCoordenador = false;

        foreach ($orgaosCentrais as $orgaoCentral) {
            $roleCoordenador = sprintf(
                'ROLE_COORDENADOR_ORGAO_CENTRAL_%s',
                $orgaoCentral->getId()
            );
            $isCoordenador |= $this->authorizationChecker->isGranted($roleCoordenador);
        }

        return (bool) $isCoordenador;
    }
}
