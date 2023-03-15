<?php

declare(strict_types=1);
/**
 * /src/Controller/StatusBarramentoController.php.
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Controller;

use OpenApi\Annotations as OA;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use SuppCore\AdministrativoBackend\Annotation\RestApiDoc;
use SuppCore\AdministrativoBackend\Api\V1\Resource\StatusBarramentoResource;
use SuppCore\AdministrativoBackend\Rest\Controller;
use SuppCore\AdministrativoBackend\Rest\RequestHandler;
use SuppCore\AdministrativoBackend\Rest\ResponseHandler;
use SuppCore\AdministrativoBackend\Rest\Traits\Actions;
use SuppCore\AdministrativoBackend\Transaction\Context;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

/**
 * @Route(path="/v1/administrativo/status_barramento")
 *
 * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
 *
 * @OA\Tag(name="StatusBarramento")
 *
 * @method StatusBarramentoResource getResource()
 */
class StatusBarramentoController extends Controller
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
     * StatusBarramentoController constructor.
     */
    public function __construct(
        StatusBarramentoResource $resource,
        ResponseHandler $responseHandler
    ) {
        $this->init($resource, $responseHandler);
    }

    /**
     * Endpoint action to download.
     *
     * @Route(
     *      "/{id}/sincroniza_barramento",
     *      requirements={
     *          "id" = "\d+",
     *      },
     *      methods={"GET"},
     *  )
     *
     * @RestApiDoc()
     *
     * @Security("is_granted('ROLE_COLABORADOR')")
     *
     * @param string[]|null $allowedHttpMethods
     *
     * @throws Throwable
     */
    public function sincronizaBarramentoAction(
        Request $request,
        int $id,
        ?array $allowedHttpMethods = null
    ): Response {
        $allowedHttpMethods ??= ['GET'];

        $this->validateRestMethod($request, $allowedHttpMethods);
        try {
            $transactionId = $this->transactionManager->begin();

            $context = RequestHandler::getContext($request);

            foreach ($context as $name => $value) {
                $this->transactionManager->addContext(
                    new Context($name, $value),
                    $transactionId
                );
            }

            $processo = $this->getResource()->sincronizaBarramento($id, $transactionId);
            $this->transactionManager->commit($transactionId);

            return new JsonResponse(
                [
                    'id' => $processo->getId(),
                    'nup' => $processo->getNUP(),
                ]
            );
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception, $id);
        }
    }
}
