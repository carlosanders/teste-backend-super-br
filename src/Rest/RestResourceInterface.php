<?php

declare(strict_types=1);
/**
 * /src/Rest/RestResourceInterfaces.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Rest;

use BadMethodCallException;
use Doctrine\Common\Proxy\Proxy;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;
use InvalidArgumentException;
use LogicException;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Repository\BaseRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Validator\Exception\ValidatorException;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use UnexpectedValueException;

/**
 * Interface ResourceInterface.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
interface RestResourceInterface
{
    /**
     * Getter method for entity repository.
     *
     * @return BaseRepositoryInterface
     */
    public function getRepository(): BaseRepositoryInterface;

    /**
     * Setter method for repository.
     *
     * @param BaseRepositoryInterface $repository
     *
     * @return RestResourceInterface
     */
    public function setRepository(BaseRepositoryInterface $repository): self;

    public function push(
        EntityInterface $entity,
        string $username,
        string $transactionId,
        array $populate = []
    ): void;

    /**
     * Getter for used validator.
     *
     * @return ValidatorInterface
     */
    public function getValidator(): ValidatorInterface;

    /**
     * Setter for used validator.
     *
     * @param ValidatorInterface $validator
     *
     * @return RestResourceInterface
     */
    public function setValidator(ValidatorInterface $validator): self;

    /**
     * Getter method for used DTO class for this REST service.
     *
     * @return string|null
     *
     * @throws UnexpectedValueException
     */
    public function getDtoClass(): ?string;

    /**
     * Setter for used DTO class.
     *
     * @param string $dtoClass
     *
     * @return RestResourceInterface
     */
    public function setDtoClass(string $dtoClass): self;

    /**
     * Getter method for used default FormType class for this REST resource.
     *
     * @return string
     */
    public function getFormTypeClass(): string;

    /**
     * Setter method for used default FormType class for this REST resource.
     *
     * @param string $formTypeClass
     *
     * @return RestResourceInterface
     */
    public function setFormTypeClass(string $formTypeClass): self;

    /**
     * Getter method for current entity name.
     *
     * @return string
     */
    public function getEntityName(): string;

    /** @noinspection GenericObjectTypeUsageInspection */

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
    public function getReference(int $id);

    /**
     * Getter method for all associations that current entity contains.
     *
     * @param array $populate
     *
     * @return string[]|array<int, string>
     */
    public function getAssociations(array $populate = []): array;

    /**
     * Getter method DTO class with loaded entity data.
     *
     * @param int    $id
     * @param string $dtoClass
     *
     * @return RestDtoInterface
     *
     * @throws NotFoundHttpException
     */
    public function getDtoForEntity(int $id, string $dtoClass): RestDtoInterface;

    /**
     * Generic find method to return an array of items from database. Return value is an array of specified repository
     * entities.
     *
     * @param mixed[]|null $criteria
     * @param mixed[]|null $orderBy
     * @param int|null     $limit
     * @param int|null     $offset
     * @param array|null   $context
     * @param mixed[]|null $populate
     *
     * @return EntityInterface[]
     */
    public function find(
        ?array $criteria = null,
        ?array $orderBy = null,
        ?int $limit = null,
        ?int $offset = null,
        ?array $context = null,
        ?array $populate = null
    ): array;

    /**
     * @param int $id
     * @param array|null $populate
     * @param array|null $context
     * @return EntityInterface|null
     */
    public function findOne(int $id, ?array $populate = null, ?array $context = null): ?EntityInterface;

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
    ): ?EntityInterface;

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
    public function count(?array $criteria = null, ?array $search = null): int;

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
     * @throws ValidatorException
     * @throws OptimisticLockException
     * @throws ORMInvalidArgumentException
     * @throws ORMException
     */
    public function create(RestDtoInterface $dto, string $transactionId, ?bool $skipValidation = null): EntityInterface;

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
     * @throws LogicException
     * @throws BadMethodCallException
     * @throws NotFoundHttpException
     * @throws ValidatorException
     * @throws OptimisticLockException
     * @throws ORMInvalidArgumentException
     * @throws ORMException
     */
    public function update(
        int $id,
        RestDtoInterface $dto,
        string $transactionId,
        ?bool $skipValidation = null
    ): EntityInterface;

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
    public function delete(int $id, string $transactionId): EntityInterface;

    /**
     * Generic ids method to return an array of id values from database. Return value is an array of specified
     * repository entity id values.
     *
     * @param mixed[]|null $criteria
     * @param mixed[]|null $search
     *
     * @return string[]
     *
     * @throws InvalidArgumentException
     */
    public function getIds(?array $criteria = null, ?array $search = null): array;

    /**
     * Generic method to save given entity to specified repository. Return value is created entity.
     *
     * @param EntityInterface $entity
     * @param string          $transactionId
     * @param bool|null       $skipValidation
     *
     * @return EntityInterface
     *
     * @throws OptimisticLockException
     * @throws ORMInvalidArgumentException
     * @throws ORMException
     * @throws ValidatorException
     */
    public function save(EntityInterface $entity, string $transactionId, ?bool $skipValidation = null): EntityInterface;
}
