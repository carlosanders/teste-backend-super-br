<?php

declare(strict_types=1);
/**
 * /src/Controller/EtiquetaController.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use SuppCore\AdministrativoBackend\Api\V1\Resource\EtiquetaResource;
use SuppCore\AdministrativoBackend\Rest\Controller;
use SuppCore\AdministrativoBackend\Rest\ResponseHandler;
use SuppCore\AdministrativoBackend\Rest\Traits\Actions;
use OpenApi\Annotations as OA;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/v1/administrativo/etiqueta")
 *
 * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
 *
 * @OA\Tag(name="Etiqueta")
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @method EtiquetaResource getResource()
 */
class EtiquetaController extends Controller
{
    // Traits
    use Actions\User\FindOneAction;
    use Actions\User\FindAction;
    use Actions\User\CreateAction;
    use Actions\User\UpdateAction;
    use Actions\User\PatchAction;
    use Actions\User\DeleteAction;
    use Actions\User\CountAction;

/** @noinspection MagicMethodsValidityInspection */

    /**
     * EtiquetaController constructor.
     */
    public function __construct(
        EtiquetaResource $resource,
        ResponseHandler $responseHandler
    ) {
        $this->init($resource, $responseHandler);
    }
}
