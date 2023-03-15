<?php

declare(strict_types=1);
/**
 * /src/Controller/NumeroUnicoDocumentoController.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use SuppCore\AdministrativoBackend\Api\V1\Resource\NumeroUnicoDocumentoResource;
use SuppCore\AdministrativoBackend\Rest\Controller;
use SuppCore\AdministrativoBackend\Rest\ResponseHandler;
use SuppCore\AdministrativoBackend\Rest\Traits\Actions;
use OpenApi\Annotations as OA;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/v1/administrativo/numero_unico_documento")
 *
 * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
 *
 * @OA\Tag(name="NumeroUnicoDocumento")
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @method NumeroUnicoDocumentoResource getResource()
 */
class NumeroUnicoDocumentoController extends Controller
{
    // Traits
    use Actions\User\FindOneAction;
    use Actions\User\FindAction;
    use Actions\CoordenadorSetor\CreateAction;
    use Actions\CoordenadorSetor\UpdateAction;
    use Actions\CoordenadorSetor\PatchAction;
    use Actions\CoordenadorSetor\DeleteAction;
    use Actions\Colaborador\CountAction;

/** @noinspection MagicMethodsValidityInspection */

    /**
     * NumeroUnicoDocumentoController constructor.
     */
    public function __construct(
        NumeroUnicoDocumentoResource $resource,
        ResponseHandler $responseHandler
    ) {
        $this->init($resource, $responseHandler);
    }
}
