<?php

declare(strict_types=1);
/**
 * /src/Controller/VinculacaoTransicaoWorkflowController.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use SuppCore\AdministrativoBackend\Api\V1\Resource\VinculacaoTransicaoWorkflowResource as Resource;
use SuppCore\AdministrativoBackend\Rest\Controller;
use SuppCore\AdministrativoBackend\Rest\ResponseHandler;
use SuppCore\AdministrativoBackend\Rest\Traits\Actions;
use OpenApi\Annotations as OA;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/v1/administrativo/vinculacao_transicao_workflow")
 *
 * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
 *
 * @OA\Tag(name="VinculacaoTransicaoWorkflow")
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @method Resource getResource()
 */
class VinculacaoTransicaoWorkflowController extends Controller
{
    // Traits
    use Actions\User\FindOneAction;
    use Actions\User\FindAction;
    use Actions\Admin\CreateAction;
    use Actions\Admin\UpdateAction;
    use Actions\Admin\PatchAction;
    use Actions\Admin\DeleteAction;
    use Actions\User\CountAction;

    /** @noinspection MagicMethodsValidityInspection */

    /**
     * VinculacaoTransicaoWorkflowController constructor.
     */
    public function __construct(Resource $resource,
                                ResponseHandler $responseHandler)
    {
        $this->init($resource, $responseHandler);
    }
}
