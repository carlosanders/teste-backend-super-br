<?php

declare(strict_types=1);
/**
 * /src/Api/V1/Pipes/Etiqueta/Pipe0001.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Mapper\Pipes\Etiqueta;

use Exception;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Etiqueta as EtiquetaDTO;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\Etiqueta as EtiquetaEntity;
use SuppCore\AdministrativoBackend\Mapper\Pipes\PipeInterface;
use SuppCore\AdministrativoBackend\Repository\VinculacaoEtiquetaRepository;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * Class Pipe0001.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Pipe0001 implements PipeInterface
{
    protected AuthorizationCheckerInterface $authorizationChecker;

    protected TokenStorageInterface $tokenStorage;

    protected VinculacaoEtiquetaRepository $vinculacaoEtiquetaRepository;

    /**
     * Pipe0001 constructor.
     *
     * @param TokenStorageInterface        $tokenStorage                  ;
     * @param VinculacaoEtiquetaRepository $vinculacaoEtiquetaRepository,
     */
    public function __construct(
        AuthorizationCheckerInterface $authorizationChecker,
        TokenStorageInterface $tokenStorage,
        VinculacaoEtiquetaRepository $vinculacaoEtiquetaRepository
    ) {
        $this->authorizationChecker = $authorizationChecker;
        $this->tokenStorage = $tokenStorage;
        $this->vinculacaoEtiquetaRepository = $vinculacaoEtiquetaRepository;
    }

    public function supports(): array
    {
        return [
            EtiquetaDTO::class => [
                'onCreateDTOFromEntity'
            ],
        ];
    }

    /**
     * @param EtiquetaDTO|RestDtoInterface|null $restDto
     * @param EtiquetaEntity|EntityInterface    $entity
     *
     * @throws Exception
     */
    public function execute(?RestDtoInterface &$restDto, EntityInterface $entity): void
    {
        if (!$this->tokenStorage->getToken() ||
            !$this->tokenStorage->getToken()->getUser()) {
            return;
        }

        if ((false === $this->authorizationChecker->isGranted('ROLE_COLABORADOR'))) {
            // VERIFICA SE A ETIQUETA PERTENCE AO USUÁRIO
            $vinculacaoUsuarioEtiqueta = $this->vinculacaoEtiquetaRepository
                ->findOneBy(['etiqueta' => $entity->getId()]);

            if ($vinculacaoUsuarioEtiqueta) {
                if (true === $vinculacaoUsuarioEtiqueta->getPrivada()) {
                    if ($this->tokenStorage->getToken()->getUser()->getId()
                        !== $vinculacaoUsuarioEtiqueta->getUsuario()->getId()) {
                        $restDto = new EtiquetaDTO();
                        $restDto->setId($entity->getId());
                        unset($restDto);
                    }
                }
            }
        }
    }

    public function getOrder(): int
    {
        return 1;
    }
}
