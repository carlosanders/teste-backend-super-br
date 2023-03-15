<?php

declare(strict_types=1);
/**
 * /src/Api/V1/Resource/DocumentoAvulsoResource.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Resource;

use DateTime;
use Doctrine\Common\Annotations\AnnotationException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\Exception\ORMException;
use ReflectionException;
use SuppCore\AdministrativoBackend\Api\V1\DTO\DocumentoAvulso;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\DocumentoAvulso as Entity;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Repository\DocumentoAvulsoRepository as Repository;
use SuppCore\AdministrativoBackend\Rest\RestResource;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class DocumentoAvulsoResource.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @codingStandardsIgnoreStart
 *
 * @method Repository  getRepository(): Repository
 * @method Entity[]    find(array $criteria = null, array $orderBy = null, int $limit = null, int $offset = null, array $search = null, array $populate = null): array
 * @method Entity|null findOne(int $id, bool $throwExceptionIfNotFound = null): ?EntityInterface
 * @method Entity|null findOneBy(array $criteria, array $orderBy = null, bool $throwExceptionIfNotFound = null): ?EntityInterface
 * @method Entity      create(RestDtoInterface $dto, string $transactionId, bool $skipValidation = null): EntityInterface
 * @method Entity      update(int $id, RestDtoInterface $dto, string $transactionId, bool $skipValidation = null): EntityInterface
 * @method Entity      delete(int $id, string $transactionId): EntityInterface
 * @method Entity      save(EntityInterface $entity, string $transactionId, bool $skipValidation = null): EntityInterface
 *
 * @codingStandardsIgnoreEnd
 */
class DocumentoAvulsoResource extends RestResource
{
    /** @noinspection MagicMethodsValidityInspection */

    /**
     * DocumentoAvulsoResource constructor.
     */
    public function __construct(
        Repository $repository,
        ValidatorInterface $validator
    ) {
        $this->setRepository($repository);
        $this->setValidator($validator);
        $this->setDtoClass(DocumentoAvulso::class);
    }

    /**
     * @param DocumentoAvulso|RestDtoInterface $dto
     *
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws AnnotationException
     * @throws ReflectionException
     */
    public function remeter(
        int $id,
        RestDtoInterface $dto,
        string $transactionId,
        ?bool $skipValidation = null
    ): EntityInterface {
        $skipValidation ??= false;

        // Fetch entity
        $entity = $this->getEntity($id);

        /**
         * Determine used dto class and create new instance of that and load entity to that. And after that patch
         * that dto with given partial OR whole dto class.
         */
        $restDto = $this->getDtoForEntity($id, get_class($dto), $dto);

        // Validate DTO
        $this->validateDto($restDto, $skipValidation);

        // Before callback method call
        $this->beforeRemeter($id, $restDto, $entity, $transactionId);

        // Create or update entity
        $this->persistEntity($entity, $restDto, $transactionId);

        // After callback method call
        $this->afterRemeter($id, $restDto, $entity, $transactionId);

        return $entity;
    }

    public function beforeRemeter(int &$id, RestDtoInterface $dto, EntityInterface $entity, string $transactionId): void
    {
        $this->rulesManager->proccess($dto, $entity, $transactionId, 'assertRemeter');
        $this->triggersManager->proccess($dto, $entity, $transactionId, 'beforeRemeter');
        $this->rulesManager->proccess($dto, $entity, $transactionId, 'beforeRemeter');
    }

    public function afterRemeter(int &$id, RestDtoInterface $dto, EntityInterface $entity, string $transactionId): void
    {
        $this->triggersManager->proccess($dto, $entity, $transactionId, 'afterRemeter');
    }

    /**
     * @param DocumentoAvulso|RestDtoInterface $dto
     *
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws AnnotationException
     * @throws ReflectionException
     */
    public function responder(
        int $id,
        RestDtoInterface $dto,
        string $transactionId,
        ?bool $skipValidation = null
    ): EntityInterface {
        $skipValidation ??= false;

        // Fetch entity
        $entity = $this->getEntity($id);

        /**
         * Determine used dto class and create new instance of that and load entity to that. And after that patch
         * that dto with given partial OR whole dto class.
         */
        $restDto = $this->getDtoForEntity($id, get_class($dto), $dto);

        // Validate DTO
        $this->validateDto($restDto, $skipValidation);

        // Before callback method call
        $this->beforeResponder($id, $restDto, $entity, $transactionId);

        // Create or update entity
        $this->persistEntity($entity, $restDto, $transactionId);

        // After callback method call
        $this->afterResponder($id, $restDto, $entity, $transactionId);

        return $entity;
    }

    /**
     * @param DocumentoAvulso|RestDtoInterface $dto
     */
    public function beforeResponder(
        int &$id,
        RestDtoInterface $dto,
        EntityInterface $entity,
        string $transactionId
    ): void {
        $this->rulesManager->proccess($dto, $entity, $transactionId, 'assertResponder');
        $this->triggersManager->proccess($dto, $entity, $transactionId, 'beforeResponder');
        $this->rulesManager->proccess($dto, $entity, $transactionId, 'beforeResponder');
    }

    /**
     * @param DocumentoAvulso|RestDtoInterface $dto
     */
    public function afterResponder(
        int &$id,
        RestDtoInterface $dto,
        EntityInterface $entity,
        string $transactionId
    ): void {
        $this->triggersManager->proccess($dto, $entity, $transactionId, 'afterResponder');
    }

    /**
     * @param DocumentoAvulso|RestDtoInterface $dto
     *
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws AnnotationException
     * @throws ReflectionException
     */
    public function complementar(
        int $id,
        RestDtoInterface $dto,
        string $transactionId,
        ?bool $skipValidation = null
    ): EntityInterface {
        $skipValidation ??= false;

        // Fetch entity
        $entity = $this->getEntity($id);

        /**
         * Determine used dto class and create new instance of that and load entity to that. And after that patch
         * that dto with given partial OR whole dto class.
         */
        $restDto = $this->getDtoForEntity($id, get_class($dto), $dto);

        // Validate DTO
        $this->validateDto($restDto, $skipValidation);

        // Before callback method call
        $this->beforeComplementar($id, $restDto, $entity, $transactionId);

        // Create or update entity
        $this->persistEntity($entity, $restDto, $transactionId);

        // After callback method call
        $this->afterComplementar($id, $restDto, $entity, $transactionId);

        return $entity;
    }

    /**
     * @param DocumentoAvulso|RestDtoInterface $dto
     *
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws AnnotationException
     * @throws ReflectionException
     */
    public function toggleEncerramento(
        int $id,
        RestDtoInterface $dto,
        string $transactionId,
        ?bool $skipValidation = null
    ): EntityInterface {
        $skipValidation ??= false;

        // Fetch entity
        $entity = $this->getEntity($id);

        if ($entity->getDataHoraEncerramento()) {
            $dto->setDataHoraEncerramento(null);
        } else {
            $dto->setDataHoraEncerramento(new DateTime());
        }

        /**
         * Determine used dto class and create new instance of that and load entity to that. And after that patch
         * that dto with given partial OR whole dto class.
         */
        $restDto = $this->getDtoForEntity($id, get_class($dto), $dto);

        // Validate DTO
        $this->validateDto($restDto, $skipValidation);

        // Before callback method call
        $this->beforeToggleEncerramento($id, $restDto, $entity, $transactionId);

        // Create or update entity
        $this->persistEntity($entity, $restDto, $transactionId);

        // After callback method call
        $this->afterToggleEncerramento($id, $restDto, $entity, $transactionId);

        return $entity;
    }

    /**
     * @param DocumentoAvulso|RestDtoInterface $dto
     */
    public function beforeToggleEncerramento(
        int &$id,
        RestDtoInterface $dto,
        EntityInterface $entity,
        string $transactionId
    ): void {
        $this->rulesManager->proccess($dto, $entity, $transactionId, 'assertToggleEncerramento');
        $this->triggersManager->proccess($dto, $entity, $transactionId, 'beforeToggleEncerramento');
        $this->rulesManager->proccess($dto, $entity, $transactionId, 'beforeToggleEncerramento');
    }

    public function afterToggleEncerramento(
        int &$id,
        RestDtoInterface $dto,
        EntityInterface $entity,
        string $transactionId
    ): void {
        $this->triggersManager->proccess($dto, $entity, $transactionId, 'afterToggleEncerramento');
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws AnnotationException
     * @throws ReflectionException
     */
    public function toggleLida(
        int $id,
        RestDtoInterface $dto,
        string $transactionId,
        ?bool $skipValidation = null
    ): EntityInterface {
        $skipValidation ??= false;

        // Fetch entity
        $entity = $this->getEntity($id);

        if ($entity->getDataHoraLeitura()) {
            $dto->setDataHoraLeitura(null);
        } else {
            $dto->setDataHoraLeitura(new DateTime());
        }

        /**
         * Determine used dto class and create new instance of that and load entity to that. And after that patch
         * that dto with given partial OR whole dto class.
         */
        $restDto = $this->getDtoForEntity($id, get_class($dto), $dto);

        // Validate DTO
        $this->validateDto($restDto, $skipValidation);

        // Before callback method call
        $this->beforeToggleLida($id, $restDto, $entity, $transactionId);

        // Create or update entity
        $this->persistEntity($entity, $restDto, $transactionId);

        // After callback method call
        $this->afterToggleLida($id, $restDto, $entity, $transactionId);

        return $entity;
    }

    public function beforeToggleLida(
        int &$id,
        RestDtoInterface $dto,
        EntityInterface $entity,
        string $transactionId
    ): void {
        $this->triggersManager->proccess($dto, $entity, $transactionId, 'beforeToggleLida');
        $this->rulesManager->proccess($dto, $entity, $transactionId, 'beforeToggleLida');
    }

    public function afterToggleLida(
        int &$id,
        RestDtoInterface $dto,
        EntityInterface $entity,
        string $transactionId
    ): void {
        $this->rulesManager->proccess($dto, $entity, $transactionId, 'afterToggleLida');
        $this->triggersManager->proccess($dto, $entity, $transactionId, 'afterToggleLida');
    }
}
