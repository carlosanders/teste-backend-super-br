<?php

declare(strict_types=1);

namespace SuppCore\AdministrativoBackend\Api\V1\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use SuppCore\AdministrativoBackend\Annotation\RestApiDoc;
use SuppCore\AdministrativoBackend\Api\V1\Resource\WorkflowResource;
use SuppCore\AdministrativoBackend\Rest\Controller;
use SuppCore\AdministrativoBackend\Rest\ResponseHandler;
use SuppCore\AdministrativoBackend\Rest\Traits\Actions;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

/**
 * Class WorkflowController.
 *
 * @Route(path="/v1/administrativo/workflow")
 *
 * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
 *
 * @OA\Tag(name="Workflow")
 *
 * @author  Felipe Pena <felipe.pena@datainfo.inf.br>
 *
 * @method WorkflowResource getResource()
 */
class WorkflowController extends Controller
{
    // Traits
    use Actions\User\FindOneAction;
    use Actions\User\FindAction;
    use Actions\User\CreateAction;
    use Actions\User\UpdateAction;
    use Actions\User\PatchAction;
    use Actions\User\DeleteAction;
    use Actions\Colaborador\CountAction;

/** @noinspection MagicMethodsValidityInspection */

    /**
     * AreaTrabalhoController constructor.
     */
    public function __construct(
        WorkflowResource $resource,
        ResponseHandler $responseHandler
    ) {
        $this->init($resource, $responseHandler);
    }

    /**
     * Endpoint de retorno da imagem do workflow.
     *
     * @Route(
     *      "/{id}/view/transicoes",
     *      requirements={
     *          "id" = "\d+",
     *      },
     *      methods={"GET"},
     *  )
     *
     * @Security("is_granted('ROLE_USER')")
     *
     * @RestApiDoc()
     *
     * @param string[]|null $allowedHttpMethods
     *
     * @throws Throwable
     */
    public function viewTransicoesAction(
        Request $request,
        int $id,
        ?array $allowedHttpMethods = null
    ): Response {
        $allowedHttpMethods ??= ['GET'];
        $this->validateRestMethod($request, $allowedHttpMethods);
        try {
            $componenteDigitalDTO = $this->getResource()->generateWorkflowImage($id);

            return $this
                ->getResponseHandler()
                ->createResponse($request, $componenteDigitalDTO);
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception, null);
        }
    }
}
