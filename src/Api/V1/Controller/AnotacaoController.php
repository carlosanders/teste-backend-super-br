<?php

declare(strict_types=1);

namespace SuppCore\AdministrativoBackend\Api\V1\Controller;

use SuppCore\AdministrativoBackend\Api\V1\Resource\AnotacaoResource;
use SuppCore\AdministrativoBackend\Rest\Controller;
use SuppCore\AdministrativoBackend\Rest\ResponseHandler;
use SuppCore\AdministrativoBackend\Rest\Traits\Actions;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="v1/administrativo/anotacao")
 */
class AnotacaoController extends Controller {

    use Actions\User\FindOneAction;
    use Actions\User\FindAction;
    use Actions\User\CreateAction;
    use Actions\User\UpdateAction;
    use Actions\User\PatchAction;
    use Actions\User\DeleteAction;

    public function __construct(
        AnotacaoResource $resource,
        ResponseHandler $responseHandler
    ){
        $this->init($resource, $responseHandler);
    }
    
}