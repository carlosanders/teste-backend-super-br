<?php

declare(strict_types=1);
/**
 * /src/Rest/Describer/Rest.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Rest\Describer;

use OpenApi\Annotations as OA;
use SuppCore\AdministrativoBackend\Rest\Doc\RouteModel;

/**
 * Class Rest.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Rest
{
    public const COUNT_ACTION = 'countAction';
    public const CREATE_ACTION = 'createAction';
    public const DELETE_ACTION = 'deleteAction';
    public const FIND_ACTION = 'findAction';
    public const FIND_ONE_ACTION = 'findOneAction';
    public const SEARCH_ACTION = 'searchAction';
    public const IDS_ACTION = 'idsAction';
    public const PATCH_ACTION = 'patchAction';
    public const UPDATE_ACTION = 'updateAction';

    private Tags $tags;

    private Security $security;

    private Summary $summary;

    private Response $response;

    private Parameters $parameters;

    /**
     * ApiDocDescriberRest constructor.
     *
     * @param Tags       $tags
     * @param Security   $security
     * @param Summary    $summary
     * @param Response   $response
     * @param Parameters $parameters
     */
    public function __construct(
        Tags $tags,
        Security $security,
        Summary $summary,
        Response $response,
        Parameters $parameters
    ) {
        $this->tags = $tags;
        $this->security = $security;
        $this->summary = $summary;
        $this->response = $response;
        $this->parameters = $parameters;
    }

    /**
     * @param OA\Operation  $operation
     * @param RouteModel $routeModel
     */
    public function createDocs(OA\Operation $operation, RouteModel $routeModel): void
    {
        $this->tags->process($operation, $routeModel);
        $this->security->process($operation, $routeModel);
        $this->summary->process($operation, $routeModel);
        $this->response->process($operation, $routeModel);
        $this->parameters->process($operation, $routeModel);
    }
}
