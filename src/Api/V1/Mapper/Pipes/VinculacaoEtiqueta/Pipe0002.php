<?php

declare(strict_types=1);
/**
 * /src/Api/V1/Pipes/VinculacaoEtiqueta/Pipe0002.php.
 *
 * @author Diego Ziquinatti - PGE-RS <diego@pge.rs.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Mapper\Pipes\VinculacaoEtiqueta;

use Exception;
use SuppCore\AdministrativoBackend\Api\V1\DTO\VinculacaoEtiqueta as VinculacaoEtiquetaDTO;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\VinculacaoEtiqueta as VinculacaoEtiquetaEntity;
use SuppCore\AdministrativoBackend\Mapper\Pipes\PipeInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * Class Pipe0002.
 *
 * @author Diego Ziquinatti - PGE-RS <diego@pge.rs.gov.br>
 */
class Pipe0002 implements PipeInterface
{
    private TokenStorageInterface $tokenStorage;

    protected AuthorizationCheckerInterface $authorizationChecker;

    /**
     * Pipe0002 constructor.
     */
    public function __construct(
        TokenStorageInterface $tokenStorage,
        AuthorizationCheckerInterface $authorizationChecker
    ) {
        $this->tokenStorage = $tokenStorage;
        $this->authorizationChecker = $authorizationChecker;
    }

    public function supports(): array
    {
        return [
            VinculacaoEtiquetaDTO::class => [
                'onCreateDTOFromEntity',
            ],
        ];
    }

    /**
     * @param VinculacaoEtiquetaDTO|RestDtoInterface|null $restDto
     * @param VinculacaoEtiquetaEntity|EntityInterface    $entity
     *
     * @throws Exception
     */
    public function execute(?RestDtoInterface &$restDto, EntityInterface $entity): void
    {
        //CASO A ETIQUETA SEJA PRIVADA, NÃO PERMITE A VISUALIZAÇÃO DA ETIQUETA
        if ($entity->getPrivada() &&
            $this->tokenStorage->getToken()?->getUser()?->getId() !== $entity->getCriadoPor()?->getId()) {
            unset($restDto);
        }
    }

    public function getOrder(): int
    {
        return 0001;
    }
}
