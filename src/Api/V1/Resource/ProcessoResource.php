<?php

declare(strict_types=1);
/**
 * /src/Api/V1/Resource/ProcessoResource.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Resource;

use Doctrine\Common\Annotations\AnnotationException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\TransactionRequiredException;
use Exception;
use Knp\Snappy\Pdf;
use ReflectionException;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Processo;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\Processo as Entity;
use SuppCore\AdministrativoBackend\Entity\Processo as ProcessoEntity;
use SuppCore\AdministrativoBackend\Repository\ProcessoRepository as Repository;
use SuppCore\AdministrativoBackend\Rest\RestResource;
use SuppCore\AdministrativoBackend\Utils\ZipStream;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class ProcessoResource.
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
class ProcessoResource extends RestResource
{
    private ComponenteDigitalResource $componenteDigitalResource;

    private Pdf $pdfManager;

    private AuthorizationCheckerInterface $authorizationChecker;

    private Environment $twig;

    private ParameterBagInterface $parameterBag;

    private ZipStream $zipStream;

    /**
     * ProcessoResource constructor.
     */
    public function __construct(
        Environment $twig,
        Repository $repository,
        ValidatorInterface $validator,
        AuthorizationCheckerInterface $authorizationChecker,
        ComponenteDigitalResource $componenteDigitalResource,
        Pdf $pdfManager,
        ParameterBagInterface $parameterBag,
        ZipStream $zipStream
    ) {
        $this->setRepository($repository);
        $this->setValidator($validator);
        $this->setDtoClass(Processo::class);
        $this->twig = $twig;
        $this->authorizationChecker = $authorizationChecker;
        $this->componenteDigitalResource = $componenteDigitalResource;
        $this->pdfManager = $pdfManager;
        $this->parameterBag = $parameterBag;
        $this->zipStream = $zipStream;
    }

    /**
     * @param Processo|RestDtoInterface $dto
     *
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws AnnotationException
     * @throws ReflectionException
     * @throws Exception
     */
    public function arquivar(
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
        $this->beforeArquivar($id, $restDto, $entity, $transactionId);

        // Create or update entity
        $this->persistEntity($entity, $restDto, $transactionId);

        // After callback method call
        $this->afterArquivar($id, $restDto, $entity, $transactionId);

        return $entity;
    }

    public function beforeArquivar(
        int &$id,
        RestDtoInterface $dto,
        EntityInterface $entity,
        string $transactionId
    ): void {
        $this->triggersManager->proccess($dto, $entity, $transactionId, 'beforeArquivar');
        $this->rulesManager->proccess($dto, $entity, $transactionId, 'beforeArquivar');
    }

    public function afterArquivar(int &$id, RestDtoInterface $dto, EntityInterface $entity, string $transactionId): void
    {
        $this->triggersManager->proccess(null, $entity, $transactionId, 'afterArquivar');
    }

    /**
     * @param Processo|RestDtoInterface $dto
     *
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws AnnotationException
     * @throws ReflectionException
     * @throws Exception
     */
    public function autuar(
        int $id,
        RestDtoInterface $dto,
        string $transactionId,
        ?bool $skipValidation = null
    ): EntityInterface {
        $skipValidation ??= false;

        // Fetch entity
        $entity = $this->getEntity($id);

        $restDto = $this->getDtoForEntity($id, get_class($dto), $dto);

        $restDto->setUnidadeArquivistica(ProcessoEntity::UA_PROCESSO);

        if (ProcessoEntity::UA_DOSSIE === $entity->getUnidadeArquivistica()) {
            $restDto->setTipoProtocolo(ProcessoEntity::TP_NOVO);
        }

        if (ProcessoEntity::UA_DOCUMENTO_AVULSO === $entity->getUnidadeArquivistica()) {
            $restDto->setTipoProtocolo(ProcessoEntity::TP_INFORMADO);
        }

        // Validate DTO
        $this->validateDto($restDto, $skipValidation);

        // Before callback method call
        $this->beforeAutuar($id, $restDto, $entity, $transactionId);

        // Create or update entity
        $this->persistEntity($entity, $restDto, $transactionId);

        // After callback method call
        $this->afterAutuar($id, $restDto, $entity, $transactionId);

        return $entity;
    }

    public function beforeAutuar(
        int &$id,
        RestDtoInterface $dto,
        EntityInterface $entity,
        string $transactionId
    ): void {
        $this->rulesManager->proccess($dto, $entity, $transactionId, 'assertAutuar');
        $this->triggersManager->proccess($dto, $entity, $transactionId, 'beforeAutuar');
        $this->rulesManager->proccess($dto, $entity, $transactionId, 'beforeAutuar');
    }

    public function afterAutuar(int &$id, RestDtoInterface $dto, EntityInterface $entity, string $transactionId): void
    {
        $this->triggersManager->proccess(null, $entity, $transactionId, 'afterAutuar');
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws TransactionRequiredException
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function download(int $id, string $transactionId): ?EntityInterface
    {
        $entity = $this->findOne($id);
        $dto = $this->getDtoForEntity(
            $id,
            $this->getDtoClass(),
            null,
            $entity
        );

        $this->validateDto($dto, false);
        $this->beforeDownload($dto, $entity, $transactionId);
        $this->afterDownload($dto, $entity, $transactionId);

        return $entity;
    }

    /**
     * Before lifecycle method for download method.
     */
    public function beforeDownload(RestDtoInterface $dto,
                                    EntityInterface $entity,
                                    string $transactionId): void
    {
        $this->rulesManager->proccess($dto, $entity, $transactionId, 'assertDownload');
        $this->triggersManager->proccess($dto, $entity, $transactionId, 'beforeDownload');
    }

    /**
     * After lifecycle method for download method.
     */
    public function afterDownload(RestDtoInterface $dto,
                                    EntityInterface $entity,
                                    string $transactionId): void
    {
        $this->triggersManager->proccess($dto, $entity, $transactionId, 'afterDownload');
    }

    /**
     * Processa os digitos conforme expressão passada no download do processo.
     * @param string|null $expressao
     * @return array
     */
    public function processaDigitosExpressaoDownload(?string $expressao): array
    {
        $digitos = [];
        if (!strlen($expressao)) {
            return $digitos;
        }
        $intervalos = explode(',', $expressao);
        foreach ($intervalos as $intervalo) {
            $inicioFim = explode('-', $intervalo);
            if (count($inicioFim) > 1) {
                for ($j = min($inicioFim); $j <= max($inicioFim); ++$j) {
                    $digitos[] = (int) $j;
                }
            } else {
                $digitos[] = (int) $inicioFim[0];
            }
        }

        return $digitos;
    }
}
