<?php

declare(strict_types=1);
/**
 * /src/Rest/Controller.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Rest;

use SuppCore\AdministrativoBackend\Form\FormMapper;
use SuppCore\AdministrativoBackend\Rest\Traits\RestMethodHelper;
use SuppCore\AdministrativoBackend\Transaction\TransactionManager;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Stopwatch\Stopwatch;
use Symfony\Contracts\Cache\CacheInterface;

/**
 * Class Controller.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
abstract class Controller implements ControllerInterface
{
    // Traits
    use RestMethodHelper;

    public const METHOD_COUNT = 'countMethod';
    public const METHOD_CREATE = 'createMethod';
    public const METHOD_DELETE = 'deleteMethod';
    public const METHOD_FIND = 'findMethod';
    public const METHOD_FIND_ONE = 'findOneMethod';
    public const METHOD_IDS = 'idsMethod';
    public const METHOD_PATCH = 'patchMethod';
    public const METHOD_UPDATE = 'updateMethod';

    public TransactionManager $transactionManager;
    protected FormMapper $formMapper;
    protected ParameterBagInterface $parameterBag;
    protected Stopwatch $stopwatch;
    protected CacheInterface $appCache;

    /**
     * @required
     *
     * @param TransactionManager    $transactionManager
     * @param FormMapper            $formMapper
     * @param ParameterBagInterface $parameterBag
     */
    public function setDependencies(
        TransactionManager $transactionManager,
        FormMapper $formMapper,
        ParameterBagInterface $parameterBag,
        CacheInterface $appCache,
        Stopwatch $stopwatch
    ) {
        $this->transactionManager = $transactionManager;
        $this->formMapper = $formMapper;
        $this->parameterBag = $parameterBag;
        $this->stopwatch = $stopwatch;
        $this->appCache = $appCache;
    }

    /**
     * Method to initialize REST controller.
     *
     * @param RestResourceInterface    $resource
     * @param ResponseHandlerInterface $responseHandler
     */
    protected function init(RestResourceInterface $resource, ResponseHandlerInterface $responseHandler): void
    {
        $this->resource = $resource;
        $this->responseHandler = $responseHandler;
        $this->responseHandler->setResource($this->resource);
    }
}
