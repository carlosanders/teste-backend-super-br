<?php

declare(strict_types=1);
/**
 * /src/Api/V1/Resource/CronjobResource.php.
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Resource;

use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\Exception\ORMException;
use Exception;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Cronjob as DTO;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\Cronjob as Entity;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Repository\CronjobRepository as Repository;
use SuppCore\AdministrativoBackend\Rest\RestResource;
use Symfony\Component\Process\Process;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class CronjobResource.
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
class CronjobResource extends RestResource
{
    /**
     * @param Repository         $repository
     * @param ValidatorInterface $validator
     */
    public function __construct(
        Repository $repository,
        ValidatorInterface $validator,
    ) {
        $this->setRepository($repository);
        $this->setValidator($validator);
        $this->setDtoClass(DTO::class);
    }

    /**
     * @param int          $id
     * @param DTO          $dto
     * @param string       $transactionId
     * @param Process|null $process
     *
     * @return EntityInterface|null
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function startJob(
        int $id,
        RestDtoInterface $dto,
        string $transactionId,
        Process &$process = null
    ): ?EntityInterface {
        $entity = $this->getEntity($id);
        $this->validateDto($dto, true);
        $this->beforeStartJob($dto, $entity, $transactionId);
        $process = Process::fromShellCommandline('php bin/console supp:cronjob:runner --job=$cronJobId');
        $process->setEnv(['cronJobId' => $entity->getId()]);

        $process->setOptions(['create_new_console' => true]);
        $process->start();
        $entity = $this->update($dto->getId(), $dto, $transactionId);
        $this->afterStartJob($dto, $entity, $transactionId);

        return $entity;
    }

    protected function beforeStartJob(
        RestDtoInterface $dto,
        EntityInterface $entity,
        string $transactionId
    ): void {
        $this->triggersManager->proccess($dto, $entity, $transactionId, 'beforeStartJob');
        $this->rulesManager->proccess($dto, $entity, $transactionId, 'beforeStartJob');
    }

    protected function afterStartJob(
        RestDtoInterface $dto,
        EntityInterface $entity,
        string $transactionId
    ): void {
        $this->triggersManager->proccess($dto, $entity, $transactionId, 'afterStartJob');
    }

    /**
     * @param int                  $id
     * @param RestDtoInterface|DTO $dto
     * @param string               $transactionId
     * @param Process|null         $process
     *
     * @return EntityInterface|null
     *
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws Exception
     */
    public function executeJobCommand(
        int $id,
        RestDtoInterface|DTO $dto,
        string $transactionId,
        Process &$process = null
    ): ?EntityInterface {
        /** @var Entity $entity */
        $entity = $this->getEntity($id);
        $this->validateDto($dto, true);
        $this->beforeExecuteJobCommand($dto, $entity, $transactionId);

        $process = Process::fromShellCommandline($dto->getComando());
        $process->setEnv(
            array_merge(
                [
                    'cronjob_id' => $dto->getId(),
                ],
                $process->getEnv()
            )
        );
        $process->setOptions(['create_new_console' => true]);
        $process->start();
        $dto->setUltimoPid($process->getPid());
        $process->wait();

        if ($process->isSuccessful()) {
            $dto->setStatusUltimaExecucao(Entity::ST_EXECUCAO_SUCESSO);
            if ($entity->getSincrono()) {
                $dto->setPercentualExecucao(100);
            }
        } else {
            $dto->setStatusUltimaExecucao(Entity::ST_EXECUCAO_ERRO);
            $dto->setPercentualExecucao(100);
        }

        $entity = $this->update($id, $dto, $transactionId);
        $this->afterExecuteJobCommand($dto, $entity, $transactionId);

        return $entity;
    }

    protected function beforeExecuteJobCommand(
        RestDtoInterface $dto,
        EntityInterface $entity,
        string $transactionId
    ): void {
        $this->triggersManager->proccess($dto, $entity, $transactionId, 'beforeExecuteJobCommand');
        $this->rulesManager->proccess($dto, $entity, $transactionId, 'beforeExecuteJobCommand');
    }

    protected function afterExecuteJobCommand(
        RestDtoInterface $dto,
        EntityInterface $entity,
        string $transactionId
    ): void {
        $this->triggersManager->proccess($dto, $entity, $transactionId, 'afterExecuteJobCommand');
    }
}
