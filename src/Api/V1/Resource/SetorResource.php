<?php

declare(strict_types=1);
/**
 * /src/Api/V1/Resource/SetorResource.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Resource;

use Doctrine\Common\Annotations\AnnotationException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\Exception\ORMException;
use Psr\Log\LoggerInterface;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Processo;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Setor as SetorDTO;
use SuppCore\AdministrativoBackend\Api\V1\Triggers\Modelo\Message\IndexacaoMessage;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\Setor as Entity;
use SuppCore\AdministrativoBackend\Repository\ProcessoRepository;
use SuppCore\AdministrativoBackend\Repository\SetorRepository as Repository;
use SuppCore\AdministrativoBackend\Rest\RestResource;
use SuppCore\AdministrativoBackend\Transaction\TransactionManager;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Throwable;

/**
 * Class SetorResource.
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
class SetorResource extends RestResource
{
    /** @noinspection MagicMethodsValidityInspection */

    private TransactionManager $transactionManager;

    /**
     * SetorResource constructor.
     *
     * @param Repository         $repository
     * @param ValidatorInterface $validator
     * @param ProcessoRepository $processoRepository
     * @param ProcessoResource   $processoResource
     */
    public function __construct(
        private Repository $repository,
        private ValidatorInterface $validator,
        private ParameterBagInterface $parameterBag,
        protected ProcessoRepository $processoRepository,
        protected ProcessoResource $processoResource,
        TransactionManager $transactionManager,
        private LoggerInterface $logger,
    ) {
        $this->setRepository($repository);
        $this->setValidator($validator);
        $this->setDtoClass(SetorDTO::class);
        $this->transactionManager = $transactionManager;
    }

    /**
     * Método que transfere os processos de um setor para outro.
     *
     * @throws AnnotationException
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws \ReflectionException
     */
    public function transferirProcessosSetor(
        int $id,
        int $idDestino,
        SetorDTO|RestDtoInterface $setorOrigemDTO,
        SetorDTO|RestDtoInterface $setorDestinoDTO,
        string $transactionId): Entity
    {
        $setorOrigemEntity = $this->findOne($id);
        $setorDestinoEntity = $this->findOne($idDestino);

        $this->beforeTransferirProcessosSetor($id, $setorOrigemDTO, $setorDestinoEntity,  $transactionId);

        if(($setorOrigemEntity->getEspecieSetor()->getNome() ===
                $this->parameterBag->get('constantes.entidades.especie_setor.const_2') ||
                $setorDestinoEntity->getEspecieSetor()->getNome() ===
                $this->parameterBag->get('constantes.entidades.especie_setor.const_2')) &&
            $setorOrigemEntity->getEspecieSetor()->getNome() !== $setorDestinoEntity->getEspecieSetor()->getNome()){
            throw new \RuntimeException('Por questões arquivísticas, o acervo de um Arquivo só pode ser enviado para outro Arquivo');
        }

        $processosSetor = $this->processoRepository->findBy(['setorAtual' => $setorOrigemEntity]);
        $count = 0;
        foreach ($processosSetor as $processoEntity) {
            try {
                $processoEntity->setSetorAtual($setorDestinoEntity);

                $processoDTO = $this->processoResource->getDtoForEntity(
                    $processoEntity->getId(),
                    Processo::class,
                    null,
                    $processoEntity
                );

                $this->processoResource->update(
                    $processoEntity->getId(),
                    $processoDTO,
                    $transactionId
                );
                $count++;
                if($count >100){
                    $this->transactionManager->commit($transactionId);

                    $transactionId = $this->transactionManager->begin();
                    $count = 0;
                }

            } catch (Throwable $e) {
                $this->logger->critical($e->getMessage().' - '.$e->getTraceAsString());
                continue;
            }
        }

        $this->afterTransferirProcessosSetor($id, $setorOrigemDTO, $setorDestinoEntity, $transactionId);

        $this->transactionManager->commit($transactionId);

        return $setorOrigemEntity;
    }

    public function beforeTransferirProcessosSetor(
        int &$id,
        RestDtoInterface $dto,
        EntityInterface $entity,
        string $transactionId
    ): void {
        $this->rulesManager->proccess(
            $dto,
            $entity,
            $transactionId,
            'assertAfterTransferirProcessosSetor'
        );
        $this->triggersManager->proccess(
            $dto,
            $entity,
            $transactionId,
            'beforeTransferirProcessosSetor'
        );
        $this->rulesManager->proccess(
            $dto,
            $entity,
            $transactionId,
            'beforeTransferirProcessosSetor'
        );
    }

    public function afterTransferirProcessosSetor(
        int &$id,
        RestDtoInterface $dto,
        EntityInterface $entity,
        string $transactionId
    ): void {
        $this->triggersManager->proccess(
            $dto,
            $entity,
            $transactionId,
            'afterTransferirProcessosSetor'
        );
    }


    /**
     * Método que transfere os processos de uma Unidade para outra.
     *
     * @throws AnnotationException
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws \ReflectionException
     */
    public function transferirProcessosUnidade(
        int $id,
        int $idDestino,
        SetorDTO|RestDtoInterface $unidadeOrigemDTO,
        SetorDTO|RestDtoInterface $unidadeDestinoDTO,
        string $transactionId): Entity
    {
        $unidadeOrigemEntity = $this->findOne($id);
        $unidadeDestinoEntity = $this->findOne($idDestino);

        $this->beforeTransferirProcessosSetor($id, $unidadeOrigemDTO, $unidadeDestinoEntity, $transactionId);

        $protocoloDestino = $this->getRepository()->findProtocoloInUnidade($unidadeDestinoDTO->getId());
        $arquivoDestino = $this->getRepository()->findArquivoInUnidade($unidadeDestinoDTO->getId());

        $setores = $this->getRepository()->findBy(['unidade' => $unidadeOrigemEntity]);

        $count = 0;

        foreach ($setores as $setoresEntity){
            $processosSetor = $this->processoRepository->findBy(['setorAtual' => $setoresEntity]);
            foreach ($processosSetor as $processoEntity) {
                try {
                    if ($this->parameterBag->get('constantes.entidades.especie_setor.const_2') ===
                        $setoresEntity->getEspecieSetor()?->getNome()) {
                        $processoEntity->setSetorAtual($arquivoDestino);
                    } else {
                        $processoEntity->setSetorAtual($protocoloDestino);
                    }

                    $processoDTO = $this->processoResource->getDtoForEntity(
                        $processoEntity->getId(),
                        Processo::class,
                        null,
                        $processoEntity
                    );

                    $this->processoResource->update(
                        $processoEntity->getId(),
                        $processoDTO,
                        $transactionId
                    );

                    $count++;
                    if($count >100){
                        $this->transactionManager->commit($transactionId);

                        $transactionId = $this->transactionManager->begin();
                        $count = 0;
                    }

                }catch (Throwable $e) {
                    $this->logger->critical($e->getMessage().' - '.$e->getTraceAsString());
                    continue;
                }
            }
        }

        $this->afterTransferirProcessosSetor($id, $unidadeOrigemDTO, $unidadeDestinoEntity, $transactionId);

        $this->transactionManager->commit($transactionId);

        return $unidadeOrigemEntity;
    }

    /**
     * Método que coloca na fila modelos para reindexação
     *
     * @throws AnnotationException
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws \ReflectionException
     */
    public function reindexarModelos(
        int $id,
        string $transactionId): Entity
    {
        $entity = $this->findOne($id);
        $this->transactionManager->addAsyncDispatch(new IndexacaoMessage($entity->getUuid(),
            explode('Entity\\', $entity::class)[1]), $transactionId);

        return $entity;
    }
}
