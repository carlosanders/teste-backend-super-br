<?php

declare(strict_types=1);

namespace SuppCore\AdministrativoBackend\Api\V1\Controller;

use OpenApi\Annotations as OA;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use SuppCore\AdministrativoBackend\Api\V1\Controller\Traits\DownloadTrait;
use SuppCore\AdministrativoBackend\Api\V1\Resource\DossieResource;
use SuppCore\AdministrativoBackend\Rest\Controller;
use SuppCore\AdministrativoBackend\Rest\ResponseHandler;
use SuppCore\AdministrativoBackend\Rest\Traits\Actions;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/v1/administrativo/dossie")
 *
 * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
 *
 * @OA\Tag(name="Dossie")
 *
 * @author  Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @method DossieResource getResource()
 */
class DossieController extends Controller
{
    // Traits
    use Actions\Colaborador\FindOneAction;
    use Actions\Colaborador\FindAction;
    use Actions\Colaborador\CreateAction;
    use Actions\Root\UpdateAction;
    use Actions\Root\PatchAction;
    use Actions\Colaborador\DeleteAction;
    use Actions\Colaborador\CountAction;

    use DownloadTrait;

    /**
     * SetorController constructor.
     *
     * @param DossieResource  $resource
     * @param ResponseHandler $responseHandler
     */
    public function __construct(
        DossieResource $resource,
        ResponseHandler $responseHandler
    ) {
        $this->init($resource, $responseHandler);
    }
}
