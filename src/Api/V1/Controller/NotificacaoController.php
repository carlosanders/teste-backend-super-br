<?php

declare(strict_types=1);
/**
 * /src/Controller/NotificacaoController.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Controller;

use LogicException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use SuppCore\AdministrativoBackend\Annotation\RestApiDoc;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Notificacao;
use SuppCore\AdministrativoBackend\Api\V1\Resource\NotificacaoResource;
use SuppCore\AdministrativoBackend\Rest\Controller;
use SuppCore\AdministrativoBackend\Rest\RequestHandler;
use SuppCore\AdministrativoBackend\Rest\ResponseHandler;
use SuppCore\AdministrativoBackend\Rest\Traits\Actions;
use SuppCore\AdministrativoBackend\Transaction\Context;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

/**
 * @Route(path="/v1/administrativo/notificacao")
 *
 * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
 *
 * @OA\Tag(name="Notificacao Management")
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @method NotificacaoResource getResource()
 */
class NotificacaoController extends Controller
{
    // Traits
    use Actions\User\FindOneAction;
    use Actions\User\FindAction;
    use Actions\User\DeleteAction;
    use Actions\Admin\CreateAction;
    use Actions\Root\UpdateAction;
    use Actions\Root\PatchAction;
    use Actions\User\CountAction;

/** @noinspection MagicMethodsValidityInspection */

    /**
     * NotificacaoController constructor.
     */
    public function __construct(
        NotificacaoResource $resource,
        ResponseHandler $responseHandler
    ) {
        $this->init($resource, $responseHandler);
    }

    /**
     * Endpoint action to change lida status.
     *
     * @Route(
     *      "/{id}/toggle_lida",
     *      requirements={
     *          "id" = "\d+",
     *      },
     *      methods={"PATCH"},
     *  )
     *
     * @Security("is_granted('ROLE_USER')")
     *
     * @RestApiDoc()
     *
     * @param string[]|null $allowedHttpMethods
     *
     * @throws LogicException
     * @throws Throwable
     * @throws HttpException
     * @throws MethodNotAllowedHttpException
     */
    public function toggleLidaAction(
        Request $request,
        int $id,
        ?array $allowedHttpMethods = null
    ): Response {
        $allowedHttpMethods ??= ['PATCH'];

        // Make sure that we have everything we need to make this work
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

            $notificacaoResource = $this->getResource();
            $notificacaoDTO = $notificacaoResource->getDtoForEntity($id, Notificacao::class);
            $notificacaoEntity = $notificacaoResource->toggleLida($id, $notificacaoDTO, $transactionId, true);

            $this->transactionManager->commit($transactionId);

            return $this->getResponseHandler()->createResponse($request, $notificacaoEntity);
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception, $id);
        }
    }

    /**
     * Endpoint action to change lida status.
     *
     * @Route(
     *      "/marcar_todas",
     *      methods={"PATCH"},
     *  )
     *
     * @Security("is_granted('ROLE_USER')")
     *
     * @RestApiDoc()
     *
     * @param string[]|null $allowedHttpMethods
     *
     * @throws LogicException
     * @throws Throwable
     * @throws HttpException
     * @throws MethodNotAllowedHttpException
     */
    public function marcarTodasAction(
        Request $request,
        ?array $allowedHttpMethods = null
    ): Response {
        $allowedHttpMethods ??= ['PATCH'];

        $this->validateRestMethod($request, $allowedHttpMethods);

        try {
            $transactionId = $this->transactionManager->begin();
            $notificacaoResource = $this->getResource();

            $notificacoes = $notificacaoResource->marcarTodasComoLida($transactionId, true);

            $this->transactionManager->commit($transactionId);

            return $this
                ->getResponseHandler()
                ->createResponse(
                    $request, [
                    'entities' => $notificacoes,
                    'total' => count($notificacoes),
                ]);
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception);
        }
    }


    /**
     * Endpoint action to change lida status.
     *
     * @Route(
     *      "/excluir_todas",
     *      methods={"PATCH"},
     *  )
     *
     * @Security("is_granted('ROLE_USER')")
     *
     * @RestApiDoc()
     *
     * @param Request       $request
     * @param string[]|null $allowedHttpMethods
     *
     * @return Response
     *
     * @throws LogicException
     * @throws Throwable
     * @throws HttpException
     * @throws MethodNotAllowedHttpException
     */
    public function excluirTodasAction(
        Request $request,
        ?array $allowedHttpMethods = null
    ): Response {
        $allowedHttpMethods ??= ['PATCH'];

        $this->validateRestMethod($request, $allowedHttpMethods);

        try {
            $transactionId = $this->transactionManager->begin();
            $notificacaoResource = $this->getResource();
            $notificacaoResource->excluirTodas($transactionId);
            $this->transactionManager->commit($transactionId);

            return $this
                ->getResponseHandler()
                ->createResponse(
                    $request, [
                    'entities' => [],
                    'total' => 0
                ]);
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception);
        }
    }
}
