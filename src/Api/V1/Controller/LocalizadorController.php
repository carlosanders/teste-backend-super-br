<?php

declare(strict_types=1);
/**
 * /src/Controller/LocalizadorController.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use SuppCore\AdministrativoBackend\Api\V1\Resource\LocalizadorResource;
use SuppCore\AdministrativoBackend\Rest\Controller;
use SuppCore\AdministrativoBackend\Rest\ResponseHandler;
use SuppCore\AdministrativoBackend\Rest\Traits\Actions;
use OpenApi\Annotations as OA;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/v1/administrativo/localizador")
 *
 * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
 *
 * @OA\Tag(name="Localizador")
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @method LocalizadorResource getResource()
 */
class LocalizadorController extends Controller
{
    // Traits
    use Actions\User\FindOneAction;
    use Actions\User\FindAction;
    use Actions\CoordenadorUnidade\CreateAction;
    use Actions\CoordenadorUnidade\UpdateAction;
    use Actions\CoordenadorUnidade\PatchAction;
    use Actions\CoordenadorUnidade\DeleteAction;
    use Actions\Colaborador\CountAction;

/** @noinspection MagicMethodsValidityInspection */

    /**
     * LocalizadorController constructor.
     */
    public function __construct(
        LocalizadorResource $resource,
        ResponseHandler $responseHandler
    ) {
        $this->init($resource, $responseHandler);
    }
}
