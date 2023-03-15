<?php

declare(strict_types=1);
/**
 * /src/RegrasEtiqueta/RegrasEtiquetaMessageHandler.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\RegrasEtiqueta\MessageHandler;

use Doctrine\ORM\Mapping\MappingException;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\Exception\ORMException;
use Exception;
use SuppCore\AdministrativoBackend\Api\V1\Resource\VinculacaoEtiquetaResource;
use SuppCore\AdministrativoBackend\Entity\RegraEtiqueta;
use SuppCore\AdministrativoBackend\QueryBuilder\ArrayQueryBuilder;
use SuppCore\AdministrativoBackend\RegrasEtiqueta\Message\RegrasEtiquetaMessage;
use SuppCore\AdministrativoBackend\Repository\ModalidadeOrgaoCentralRepository;
use SuppCore\AdministrativoBackend\Repository\RegraEtiquetaRepository;
use SuppCore\AdministrativoBackend\Repository\SetorRepository;
use SuppCore\AdministrativoBackend\Repository\UsuarioRepository;
use SuppCore\AdministrativoBackend\Rest\RestResource;
use SuppCore\AdministrativoBackend\Security\RolesService;
use SuppCore\AdministrativoBackend\Transaction\TransactionManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Http\Authenticator\Token\PostAuthenticationToken;

/**
 * Class RegrasEtiquetaMessageHandler.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
#[AsMessageHandler]
class RegrasEtiquetaMessageHandler
{
    /**
     * RegraMessageHandler constructor.
     *
     * @param ContainerInterface               $container
     * @param RegraEtiquetaRepository          $regraEtiquetaRepository
     * @param ArrayQueryBuilder                $arrayQueryBuilder
     * @param VinculacaoEtiquetaResource       $vinculacaoEtiquetaResource
     * @param TransactionManager               $transactionManager
     * @param UsuarioRepository                $usuarioRepository
     * @param SetorRepository                  $setorRepository
     * @param ModalidadeOrgaoCentralRepository $modalidadeOrgaoCentralRepository
     */
    public function __construct(
        private ContainerInterface $container,
        private RegraEtiquetaRepository $regraEtiquetaRepository,
        protected ArrayQueryBuilder $arrayQueryBuilder,
        private VinculacaoEtiquetaResource $vinculacaoEtiquetaResource,
        private TransactionManager $transactionManager,
        private UsuarioRepository $usuarioRepository,
        private SetorRepository $setorRepository,
        private ModalidadeOrgaoCentralRepository $modalidadeOrgaoCentralRepository,
        private TokenStorageInterface $tokenStorage,
        private RolesService $rolesService,
    ) {
    }

    /**
     * @param RegrasEtiquetaMessage $message
     *
     * @throws MappingException
     * @throws NonUniqueResultException
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws Exception
     */
    public function __invoke(RegrasEtiquetaMessage $message)
    {
        /** @var RestResource $resource */
        $resource = $this->container->get($message->getResource());
        $vinculacaoEtiquetaResource = $this->container->get($message->getVinculacaoResource());
        $dtoClass = $vinculacaoEtiquetaResource->getDtoClass();

        $entity = $resource->findOneBy(['uuid' => $message->getUuid()]);
        $classNameParts = explode('\\', get_class($entity));
        $setter = 'set'.array_pop($classNameParts);

        $transactionId = $this->transactionManager->begin();

        if ($message->getUsuarioId()) {
            $usuarioEntity = $this->usuarioRepository->find(
                $message->getUsuarioId()
            );

            $token = new PostAuthenticationToken(
                $usuarioEntity,
                'user_provider',
                $this->rolesService->getContextualRoles($usuarioEntity)
            );

            $token->setAttribute('username', $usuarioEntity->getUsername());
            $this->tokenStorage->setToken($token);

            $regrasEtiquetaEntities = $this->regraEtiquetaRepository->findRegrasAplicaveisByUsuarioId(
                $usuarioEntity->getId(),
                $message->getModalidadeEtiquetaId()
            );

            foreach ($regrasEtiquetaEntities as $regraEtiquetaEntity) {
                $filter = json_decode(str_replace("'", '"', $regraEtiquetaEntity->getCriteria()), true);
                $filter['id'] = 'eq:'.$entity->getId();
                $qb = $this->arrayQueryBuilder->buildQueryBuilder([
                    'object' => $message->getEntityName(),
                    'filter' => $filter,
                    'limit' => 1,
                    'offset' => '0',
                ]);
                if (1 === count($qb->getQuery()->getArrayResult())) {
                    // temos que etiquetar
                    $vinculacaoEtiquetaDTO = new $dtoClass();
                    $vinculacaoEtiquetaDTO->setEtiqueta($regraEtiquetaEntity->getEtiqueta());
                    $vinculacaoEtiquetaDTO->$setter($entity);
                    $vinculacaoEtiquetaDTO->setRegraEtiquetaOrigem($regraEtiquetaEntity);
                    $vinculacaoEtiquetaDTO->setSugestao(true);
                    $this->vinculacaoEtiquetaResource->create($vinculacaoEtiquetaDTO, $transactionId);
                    continue;
                }
            }
        }

        if ($message->getSetorId()) {
            $setorEntity = $this->setorRepository->find(
                $message->getSetorId()
            );

            $regrasEtiquetaEntities = $this->regraEtiquetaRepository->findRegrasAplicaveisBySetorId(
                $setorEntity->getId(),
                $message->getModalidadeEtiquetaId()
            );

            /* @var RegraEtiqueta $regrasEtiquetaEntity */
            foreach ($regrasEtiquetaEntities as $regraEtiquetaEntity) {
                $filter = json_decode(str_replace("'", '"', $regraEtiquetaEntity->getCriteria()), true);
                $filter['id'] = 'eq:'.$entity->getId();
                $qb = $this->arrayQueryBuilder->buildQueryBuilder([
                    'object' => $message->getEntityName(),
                    'filter' => $filter,
                    'limit' => 1,
                    'offset' => '0',
                ]);
                if (1 === count($qb->getQuery()->getArrayResult())) {
                    // temos que etiquetar
                    $vinculacaoEtiquetaDTO = new $dtoClass();
                    $vinculacaoEtiquetaDTO->setEtiqueta($regraEtiquetaEntity->getEtiqueta());
                    $vinculacaoEtiquetaDTO->$setter($entity);
                    $vinculacaoEtiquetaDTO->setRegraEtiquetaOrigem($regraEtiquetaEntity);
                    $vinculacaoEtiquetaDTO->setSugestao(true);
                    $this->vinculacaoEtiquetaResource->create($vinculacaoEtiquetaDTO, $transactionId);
                    continue;
                }
            }
        }

        if ($message->getUnidadeId()) {
            $unidadeEntity = $this->setorRepository->find(
                $message->getUnidadeId()
            );

            $regrasEtiquetaEntities = $this->regraEtiquetaRepository->findRegrasAplicaveisByUnidadeId(
                $unidadeEntity->getId(),
                $message->getModalidadeEtiquetaId()
            );

            /* @var RegraEtiqueta $regraEtiquetaEntity */
            foreach ($regrasEtiquetaEntities as $regraEtiquetaEntity) {
                $filter = json_decode(str_replace("'", '"', $regraEtiquetaEntity->getCriteria()), true);
                $filter['id'] = 'eq:'.$entity->getId();
                $qb = $this->arrayQueryBuilder->buildQueryBuilder([
                    'object' => $message->getEntityName(),
                    'filter' => $filter,
                    'limit' => 1,
                    'offset' => '0',
                ]);
                if (1 === count($qb->getQuery()->getArrayResult())) {
                    // temos que etiquetar
                    $vinculacaoEtiquetaDTO = new $dtoClass();
                    $vinculacaoEtiquetaDTO->setEtiqueta($regraEtiquetaEntity->getEtiqueta());
                    $vinculacaoEtiquetaDTO->$setter($entity);
                    $vinculacaoEtiquetaDTO->setRegraEtiquetaOrigem($regraEtiquetaEntity);
                    $vinculacaoEtiquetaDTO->setSugestao(true);
                    $this->vinculacaoEtiquetaResource->create($vinculacaoEtiquetaDTO, $transactionId);
                    continue;
                }
            }
        }

        if ($message->getModalidadeOrgaoCentralId()) {
            $modalidadeOrgaoCentralEntity = $this->modalidadeOrgaoCentralRepository->find(
                $message->getModalidadeOrgaoCentralId()
            );

            $regrasEtiquetaEntities = $this->regraEtiquetaRepository->findRegrasAplicaveisByModalidadeOrgaoCentralId(
                $modalidadeOrgaoCentralEntity->getId(),
                $message->getModalidadeEtiquetaId()
            );

            /* @var RegraEtiqueta $regrasEtiquetaEntity */
            foreach ($regrasEtiquetaEntities as $regraEtiquetaEntity) {
                $filter = json_decode(str_replace("'", '"', $regraEtiquetaEntity->getCriteria()), true);
                $filter['id'] = 'eq:'.$entity->getId();
                $qb = $this->arrayQueryBuilder->buildQueryBuilder([
                    'object' => $message->getEntityName(),
                    'filter' => $filter,
                    'limit' => 1,
                    'offset' => '0',
                ]);
                if (1 === count($qb->getQuery()->getArrayResult())) {
                    // temos que etiquetar
                    $vinculacaoEtiquetaDTO = new $dtoClass();
                    $vinculacaoEtiquetaDTO->setEtiqueta($regraEtiquetaEntity->getEtiqueta());
                    $vinculacaoEtiquetaDTO->setRegraEtiquetaOrigem($regraEtiquetaEntity);
                    $vinculacaoEtiquetaDTO->$setter($entity);
                    $vinculacaoEtiquetaDTO->setSugestao(true);
                    $this->vinculacaoEtiquetaResource->create($vinculacaoEtiquetaDTO, $transactionId);
                    continue;
                }
            }
        }

        $this->transactionManager->commit($transactionId);
    }
}
