<?php

declare(strict_types=1);

namespace SuppCore\AdministrativoBackend\Api\V1\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use SuppCore\AdministrativoBackend\Api\V1\Resource\CoordenadorResource;
use SuppCore\AdministrativoBackend\Rest\Controller;
use SuppCore\AdministrativoBackend\Rest\ResponseHandler;
use SuppCore\AdministrativoBackend\Rest\Traits\Actions;
use OpenApi\Annotations as OA;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/v1/administrativo/coordenador")
 *
 * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
 *
 * @OA\Tag(name="Coordenador")
 *
 * @author  Felipe Pena <felipe.pena@datainfo.inf.br>
 *
 * @method CoordenadorResource getResource()
 */
class CoordenadorController extends Controller
{
    // Traits
    use Actions\Colaborador\FindOneAction;
    use Actions\Colaborador\FindAction;
    use Actions\CoordenadorUnidade\CreateAction;
    use Actions\CoordenadorUnidade\UpdateAction;
    use Actions\CoordenadorUnidade\PatchAction;
    use Actions\CoordenadorUnidade\DeleteAction;
    use Actions\Colaborador\CountAction;

/** @noinspection MagicMethodsValidityInspection */

    /**
     * SetorController constructor.
     */
    public function __construct(
        CoordenadorResource $resource,
        ResponseHandler $responseHandler
    ) {
        $this->init($resource, $responseHandler);
    }
}
