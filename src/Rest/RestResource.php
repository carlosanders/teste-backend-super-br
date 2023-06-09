<?php

declare(strict_types=1);
/**
 * /src/Rest/RestResource.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Rest;

use BadMethodCallException;
use Doctrine\Common\Annotations\AnnotationException;
use Doctrine\Common\Proxy\Proxy;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Exception;
use Symfony\Component\VarExporter\LazyObjectInterface;
use function get_class;
use InvalidArgumentException;
use Psr\Log\LoggerInterface as Logger;
use Redis;
use ReflectionException;
use function sprintf;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Mapper\MapperManager;
use SuppCore\AdministrativoBackend\Repository\BaseRepositoryInterface;
use SuppCore\AdministrativoBackend\Rest\Message\PushMessage;
use SuppCore\AdministrativoBackend\Rest\Traits\RestResourceLifeCycles;
use SuppCore\AdministrativoBackend\Rules\RulesManager;
use SuppCore\AdministrativoBackend\Triggers\TriggersManager;
use SuppCore\AdministrativoBackend\Utils\JSON;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Exception\ValidatorException;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use UnexpectedValueException;

/**
 * Class RestResource.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
abstract class RestResource implements RestResourceInterface
{
    // Attach generic life cycle traits
    use RestResourceLifeCycles;
    private BaseRepositoryInterface $repository;
    private ValidatorInterface $validator;
    private ?string $dtoClass = null;
    private MapperManager $dtoMapperManager;
    private string $formTypeClass;
    public RulesManager $rulesManager;
    public TriggersManager $triggersManager;
    private Logger $logger;
    protected Redis $redisClient;

    /**
     * @required
     *
     * @param RulesManager    $rulesManager
     * @param TriggersManager $triggersManager
     * @param MapperManager   $dtoMapperManager
     * @param Logger          $resourceLogger
     * @param Redis           $redisClient
     */
    public function setDependencies(
        RulesManager $rulesManager,
        TriggersManager $triggersManager,
        MapperManager $dtoMapperManager,
        Logger $resourceLogger,
        Redis $redisClient
    ): void {
        $this->rulesManager = $rulesManager;
        $this->triggersManager = $triggersManager;
        $this->dtoMapperManager = $dtoMapperManager;
        $this->logger = $resourceLogger;
        $this->redisClient = $redisClient;
    }

    /**
     * Getter method for entity repository.
     *
     * @return BaseRepositoryInterface
     */
    public function getRepository(): BaseRepositoryInterface
    {
        return $this->repository;
    }

    /**
     * Getter method for redis.
     *
     * @return Redis
     */
    public function getRedisClient(): Redis
    {
        return $this->redisClient;
    }

    /**
     * Setter method for repository.
     *
     * @param BaseRepositoryInterface $repository
     *
     * @return RestResourceInterface
     */
    public function setRepository(BaseRepositoryInterface $repository): RestResourceInterface
    {
        $this->repository = $repository;

        return $this;
    }

    /**
     * Getter for used validator.
     *
     * @return ValidatorInterface
     */
    public function getValidator(): ValidatorInterface
    {
        return $this->validator;
    }

    /**
     * Setter for used validator.
     *
     * @param ValidatorInterface $validator
     *
     * @return RestResourceInterface
     */
    public function setValidator(ValidatorInterface $validator): RestResourceInterface
    {
        $this->validator = $validator;

        return $this;
    }

    public function processoDto(RestDtoInterface $dto): void
    {
        // classes filhas podem sobrescrever esta operacao
    }

    /**
     * Getter method for used DTO class for this REST service.
     *
     * @return string|null
     *
     * @throws UnexpectedValueException
     */
    public function getDtoClass(): ?string
    {
        if ('' === $this->dtoClass) {
            $message = sprintf(
                'DTO class not specified for \'%s\' resource',
                static::class
            );

            throw new UnexpectedValueException($message);
        }

        return $this->dtoClass;
    }

    /**
     * Setter for used DTO class.
     *
     * @param string $dtoClass
     *
     * @return RestResourceInterface
     */
    public function setDtoClass(string $dtoClass): RestResourceInterface
    {
        $this->dtoClass = $dtoClass;

        return $this;
    }

    /**
     * Getter method for used default FormType class for this REST resource.
     *
     * @return string
     *
     * @throws UnexpectedValueException
     */
    public function getFormTypeClass(): string
    {
        if ('' === $this->formTypeClass) {
            $message = sprintf(
                'FormType class not specified for \'%s\' resource',
                static::class
            );

            throw new UnexpectedValueException($message);
        }

        return $this->formTypeClass;
    }

    /**
     * Setter method for used default FormType class for this REST resource.
     *
     * @param string $formTypeClass
     *
     * @return RestResourceInterface
     */
    public function setFormTypeClass(string $formTypeClass): RestResourceInterface
    {
        $this->formTypeClass = $formTypeClass;

        return $this;
    }

    /**
     * Getter method for current entity name.
     *
     * @return string
     */
    public function getEntityName(): string
    {
        return $this->getRepository()->getEntityName();
    }

    /**
     * Gets a reference to the entity identified by the given type and identifier without actually loading it,
     * if the entity is not yet loaded.
     *
     * @param int $id the entity identifier
     *
     * @return Proxy|object|null
     *
     * @throws ORMException
     */
    public function getReference(int $id)
    {
        return $this->getRepository()->getReference($id);
    }

    /**
     * @param array       $populate
     * @param string|null $dtoClass
     *
     * @return array
     *
     * @throws AnnotationException
     * @throws ReflectionException
     */
    public function getAssociations(array $populate = [], ?string $dtoClass = null): array
    {
        $associations = [];
        $mapperMetadata = $this->dtoMapperManager->getMapperMetadata($dtoClass ?? $this->dtoClass);
        $entityMapping = [];
        if ($mapperMetadata->getMapper()) {
            $entityMapping = $mapperMetadata->getMapper()->entityMapping;
        }

        foreach ($mapperMetadata->getProperties() as $property) {
            if (null === $property->dtoClass || !in_array($property->name, $populate, true)) {
                continue;
            }
            $associations[] = array_key_exists(
                $property->name,
                $entityMapping
            ) ? $entityMapping[$property->name] : $property->name;

            // nested?
            $subPopulate = $this->getSubPopulate($populate, $property->name);

            if (!empty($subPopulate)) {
                $subAssociations = $this->getAssociations($subPopulate, $property->dtoClass);
                foreach ($subAssociations as $subAssociation) {
                    $prefix = array_key_exists(
                        $property->name,
                        $entityMapping
                    ) ? $entityMapping[$property->name] : $property->name;
                    $associations[] = $prefix.'.'.$subAssociation;
                }
            }
        }

        return array_values($associations);
    }

    /**
     * @param array       $populate
     * @param string|null $dtoClass
     *
     * @return array
     *
     * @throws AnnotationException
     * @throws ReflectionException
     */
    public function getAllAssociations(): array
    {
        $associations = [];
        $mapperMetadata = $this->dtoMapperManager->getMapperMetadata($this->dtoClass);
        $excludePopulate = [];
        if ($mapperMetadata->getMapper()) {
            $excludePopulate = $mapperMetadata->getMapper()->excludePopulate;
        }

        foreach ($mapperMetadata->getProperties() as $property) {
            if (null !== $property->dtoClass && !in_array($property->name, $excludePopulate)) {
                $associations[] = $property->name;
            }
        }

        return array_values($associations);
    }

    /**
     * @param array  $populate
     * @param string $property
     *
     * @return array
     */
    public function getSubPopulate(array $populate, string $property)
    {
        $subPopulate = [];
        foreach ($populate as $p) {
            if (0 === strpos($p, $property.'.')) {
                $subPopulate[] = str_replace($property.'.', '', $p);
            }
        }

        return $subPopulate;
    }

    /**
     * @param int                   $id
     * @param string                $dtoClassName
     * @param RestDtoInterface|null $dto
     * @param EntityInterface|null  $entity
     *
     * @return RestDtoInterface
     *
     * @throws AnnotationException
     * @throws ReflectionException
     */
    public function getDtoForEntity(
        int $id,
        string $dtoClassName,
        ?RestDtoInterface $dto = null,
        ?EntityInterface $entity = null
    ): RestDtoInterface {
        // Fetch entity
        if (!$entity) {
            $entity = $this->getEntity($id);
        }

        $dtoMapper = $this->dtoMapperManager->getMapper($dtoClassName);

        // Create new instance of DTO and load entity to that.
        $restDto = $dtoMapper->createDTOFromEntity($dtoClassName, $entity);

        if (null !== $dto) {
            $restDto = $dtoMapper->patch($dto, $restDto);
        }

        return $restDto;
    }

    /**
     * Generic find method to return an array of items from database. Return value is an array of specified repository
     * entities.
     *
     * @param mixed[]|null $criteria
     * @param mixed[]|null $orderBy
     * @param int|null     $limit
     * @param int|null     $offset
     * @param mixed[]|null $search
     * @param mixed[]|null $populate
     *
     * @return EntityInterface[]
     *
     * @throws InvalidArgumentException
     */
    public function find(
        ?array $criteria = null,
        ?array $orderBy = null,
        ?int $limit = null,
        ?int $offset = null,
        ?array $search = null,
        ?array $populate = null
    ): array {
        $criteria ??= [];
        $orderBy ??= [];
        $limit ??= 0;
        $offset ??= 0;
        $search ??= [];
        $populate ??= [];
        $result = [];

        $className = $this->getRepository()->getEntityName();

        // Before callback method call
        $this->beforeFind($className, $criteria, $orderBy, $limit, $offset, $populate, $result);

        // Fetch data
        $result = $this->getRepository()->findByAdvanced($criteria, $orderBy, $limit, $offset, $search, $populate);

        // After callback method call
        $this->afterFind($className, $criteria, $orderBy, $limit, $offset, $populate, $result);

        return $result;
    }

    /**
     * Generic findOne method to return single item from database. Return value is single entity from specified
     * repository.
     *
     * @param int        $id
     * @param array|null $populate
     * @param array|null $context
     * @param array|null $orderBy
     *
     * @return EntityInterface|null
     */
    public function findOne(
        int $id,
        ?array $populate = null,
        ?array $context = null,
        ?array $orderBy = null
    ): ?EntityInterface {
        $className = $this->getRepository()->getEntityName();
        $entity = null;

        // Before callback method call
        $this->beforeFindOne($className, $id, $populate, $orderBy, $context, $entity);

        /* @var EntityInterface|null $entity */
        $entity = $this->getRepository()->find($id, $populate, $orderBy);

        if (!$entity) {
            throw new NotFoundHttpException('Não encontrado');
        }

        // After callback method call
        $this->afterFindOne($className, $id, $populate, $orderBy, $context, $entity);

        return $entity;
    }

    /**
     * Generic findOneBy method to return single item from database by given criteria. Return value is single entity
     * from specified repository or null if entity was not found.
     *
     * @param mixed[]      $criteria
     * @param mixed[]|null $orderBy
     * @param bool|null    $throwExceptionIfNotFound
     *
     * @return EntityInterface|null
     *
     * @throws NotFoundHttpException
     */
    public function findOneBy(
        array $criteria,
        ?array $orderBy = null,
        ?bool $throwExceptionIfNotFound = null
    ): ?EntityInterface {
        $orderBy ??= [];
        $throwExceptionIfNotFound ??= false;

        // Before callback method call
        $this->beforeFindOneBy($criteria, $orderBy);

        /** @var EntityInterface|null $entity */
        $entity = $this->getRepository()->findOneBy($criteria, $orderBy);

        // Entity not found
        if ($throwExceptionIfNotFound && null === $entity) {
            throw new NotFoundHttpException('Not found');
        }

        // After callback method call
        $this->afterFindOneBy($criteria, $orderBy, $entity);

        return $entity;
    }

    /**
     * Generic count method to return entity count for specified criteria and search terms.
     *
     * @param mixed[]|null $criteria
     * @param mixed[]|null $search
     *
     * @return int
     *
     * @throws InvalidArgumentException
     * @throws NonUniqueResultException
     */
    public function count(?array $criteria = null, ?array $search = null): int
    {
        $criteria ??= [];
        $search ??= [];

        // Before callback method call
        $this->beforeCount($criteria, $search);

        $count = $this->getRepository()->countAdvanced($criteria, $search);

        // After callback method call
        $this->afterCount($criteria, $search, $count);

        return $count;
    }

    /**
     * Generic method to create new item (entity) to specified database repository. Return value is created entity for
     * specified repository.
     *
     * @param RestDtoInterface $dto
     * @param string           $transactionId
     * @param bool|null        $skipValidation
     *
     * @return EntityInterface
     *
     * @throws Exception
     * @throws ValidatorException
     * @throws OptimisticLockException
     * @throws ORMInvalidArgumentException
     * @throws ORMException
     */
    public function create(RestDtoInterface $dto, string $transactionId, ?bool $skipValidation = null): EntityInterface
    {
        $skipValidation ??= false;

        // Create new entity
        $entity = $this->createEntity();

        $this->processoDto($dto);

        // Before callback method call
        $this->beforeCreate($dto, $entity, $transactionId);

        // Validate DTO
        $this->validateDto($dto, $skipValidation);

        // Create or update entity
        $this->persistEntity($entity, $dto, $transactionId, $skipValidation);

        // After callback method call
        $this->afterCreate($dto, $entity, $transactionId);

        $this->redisClient->del($this->getDtoClass());

        return $entity;
    }

    /**
     * Generic method to update specified entity with new data.
     *
     * @param int              $id
     * @param RestDtoInterface $dto
     * @param string           $transactionId
     * @param bool|null        $skipValidation
     *
     * @return EntityInterface
     *
     * @throws BadMethodCallException
     * @throws Exception
     * @throws ValidatorException
     * @throws NotFoundHttpException
     * @throws OptimisticLockException
     * @throws ORMInvalidArgumentException
     * @throws ORMException
     */
    public function update(
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
        $restDto = $this->getDtoForEntity($id, get_class($dto), $dto, $entity);
        $this->processoDto($restDto);

        // Before callback method call
        $this->beforeUpdate($id, $restDto, $entity, $transactionId);

        // Validate DTO
        $this->validateDto($restDto, $skipValidation);

        // Create or update entity
        $this->persistEntity($entity, $restDto, $transactionId);

        // After callback method call
        $this->afterUpdate($id, $restDto, $entity, $transactionId);

        $this->redisClient->del($this->getDtoClass());

        return $entity;
    }

    /**
     * Generic method to delete specified entity from database.
     *
     * @param int    $id
     * @param string $transactionId
     *
     * @return EntityInterface
     *
     * @throws NotFoundHttpException
     * @throws OptimisticLockException
     * @throws ORMInvalidArgumentException
     * @throws ORMException
     */
    public function delete(int $id, string $transactionId): EntityInterface
    {
        // Fetch entity
        $entity = $this->getEntity($id);

        $restDto = $this->getDtoForEntity($id, $this->getDtoClass(), null, $entity);
        $this->processoDto($restDto);

        $restDto = $this->getDtoForEntity($id, $this->getDtoClass(), null, $entity);
        $this->processoDto($restDto);

        // Before callback method call
        $this->beforeDelete($id, $restDto, $entity, $transactionId);

        // And remove entity from repo
        $this->getRepository()->remove($entity, $transactionId);

        // After callback method call
        $this->afterDelete($id, $restDto, $entity, $transactionId);

        $this->redisClient->del($this->getDtoClass());

        return $entity;
    }

    /**
     * Generic method to undelete specified entity from database.
     *
     * @param int    $id
     * @param string $transactionId
     *
     * @return EntityInterface
     *
     * @throws NotFoundHttpException
     * @throws OptimisticLockException
     * @throws ORMInvalidArgumentException
     * @throws ORMException
     */
    public function undelete(int $id, string $transactionId): EntityInterface
    {
        // Fetch entity
        $entity = $this->getRepository()->findDeleted($id);

        $restDto = $this->getDtoForEntity($id, $this->getDtoClass(), null, $entity);
        $this->processoDto($restDto);

        // Before callback method call
        $this->beforeUndelete($id, $restDto, $entity, $transactionId);

        // And remove entity from repo
        $this->getRepository()->unremove($entity, $transactionId);

        // After callback method call
        $this->afterUndelete($id, $restDto, $entity, $transactionId);

        $this->redisClient->del($this->getDtoClass());

        return $entity;
    }

    /**
     * Generic ids method to return an array of id values from database. Return value is an array of specified
     * repository entity id values.
     *
     * @param mixed[]|null $criteria
     * @param mixed[]|null $search
     *
     * @return string[]|array<mixed, mixed>
     *
     * @throws InvalidArgumentException
     */
    public function getIds(?array $criteria = null, ?array $search = null): array
    {
        $criteria ??= [];
        $search ??= [];

        // Before callback method call
        $this->beforeIds($criteria, $search);

        // Fetch data
        $ids = $this->getRepository()->findIds($criteria, $search);

        // After callback method call
        $this->afterIds($ids, $criteria, $search);

        return $ids;
    }

    /**
     * Generic method to save given entity to specified repository. Return value is created entity.
     *
     * @param EntityInterface $entity
     * @param string          $transactionId
     * @param bool|null       $skipValidation
     *
     * @return EntityInterface
     *
     * @throws Exception
     * @throws ValidatorException
     * @throws OptimisticLockException
     * @throws ORMInvalidArgumentException
     * @throws ORMException
     */
    public function save(EntityInterface $entity, string $transactionId, ?bool $skipValidation = null): EntityInterface
    {
        $skipValidation ??= false;

        // Before callback method call
        $this->beforeSave($entity, $transactionId);

        // Validate current entity
        $this->validateEntity($entity, $skipValidation);

        // Persist on database
        $this->getRepository()->save($entity, $transactionId);

        // After callback method call
        $this->afterSave($entity, $transactionId);

        return $entity;
    }

    /**
     * Helper method to set data to specified entity and store it to database.
     *
     * @param EntityInterface  $entity
     * @param RestDtoInterface $dto
     * @param string           $transactionId
     *
     * @throws Exception
     * @throws ValidatorException
     * @throws ORMException
     * @throws ORMInvalidArgumentException
     * @throws OptimisticLockException
     */
    protected function persistEntity(EntityInterface $entity, RestDtoInterface $dto, string $transactionId, ?bool $skipValidation = null): void
    {
        $skipValidation ??= false;

        // Update entity according to DTO current state
        $dtoMapper = $this->dtoMapperManager->getMapper(get_class($dto));
        $dtoMapper->update($entity, $dto);

        // And save current entity
        $this->save($entity, $transactionId, $skipValidation);
    }

    /**
     * @param EntityInterface $entity
     * @param string          $channel
     * @param string          $transactionId
     * @param array           $populate
     */
    public function push(
        EntityInterface $entity,
        string $channel,
        string $transactionId,
        array $populate = []
    ): void {
        $pushMessage = new PushMessage();
        $pushMessage->setUuid($entity->getUuid());
        $pushMessage->setResource(
            $this instanceof LazyObjectInterface ? get_parent_class($this) : get_class($this)
        );
        $pushMessage->setChannel($channel);
        $pushMessage->setPopulate($populate);

        $this->getRepository()->getTransactionManager()->addAsyncDispatch($pushMessage, $transactionId);
    }

    /**
     * @param int $id
     *
     * @return EntityInterface|null
     *
     * @throws NotFoundHttpException
     */
    protected function getEntity(int $id): ?EntityInterface
    {
        /** @var EntityInterface|null $entity */
        $entity = $this->getRepository()->find($id);

        // Entity not found
        if (!$entity) {
            throw new NotFoundHttpException('Not found');
        }

        return $entity;
    }

    /**
     * Helper method to validate given DTO class.
     *
     * @param RestDtoInterface $dto
     * @param bool             $skipValidation
     *
     * @throws Exception
     * @throws ValidatorException
     */
    protected function validateDto(RestDtoInterface $dto, bool $skipValidation): void
    {
        /** @var ConstraintViolationListInterface|null $errors */
        $errors = !$skipValidation ? $this->getValidator()->validate($dto, null, ['Default', 'Resource']) : null;

        // Oh noes, we have some errors
        if (null !== $errors && $errors->count() > 0) {
            $this->createValidatorException($errors);
        }
    }

    /**
     * Method to validate specified entity.
     *
     * @param EntityInterface $entity
     * @param bool            $skipValidation
     *
     * @throws Exception
     * @throws ValidatorException
     */
    private function validateEntity(EntityInterface $entity, bool $skipValidation): void
    {
        /** @var ConstraintViolationListInterface|null $errors */
        $errors = !$skipValidation ? $this->getValidator()->validate($entity) : null;

        // Oh noes, we have some errors
        if (null !== $errors && $errors->count() > 0) {
            $this->createValidatorException($errors);
        }
    }

    /**
     * @psalm-suppress MoreSpecificReturnType
     *
     * @return EntityInterface
     */
    protected function createEntity(): EntityInterface
    {
        $entityClass = $this->getRepository()->getEntityName();

        return new $entityClass();
    }

    /**
     * @param ConstraintViolationListInterface $errors
     *
     * @throws Exception
     * @throws ValidatorException
     */
    private function createValidatorException(ConstraintViolationListInterface $errors): void
    {
        $output = [];

        /** @var ConstraintViolationInterface $error */
        foreach ($errors as $error) {
            $output[] = [
                'message' => $error->getMessage(),
                'propertyPath' => $error->getPropertyPath(),
                'code' => $error->getCode(),
            ];
        }

        throw new ValidatorException(JSON::encode($output));
    }

    /**
     * @return MapperManager
     */
    public function getDtoMapperManager(): MapperManager
    {
        return $this->dtoMapperManager;
    }
}
