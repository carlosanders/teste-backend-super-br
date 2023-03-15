<?php

declare(strict_types=1);
/**
 * /src/Controller/DocumentoAvulsoController.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Controller;

use LogicException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use SuppCore\AdministrativoBackend\Annotation\RestApiDoc;
use SuppCore\AdministrativoBackend\Api\V1\DTO\DocumentoAvulso;
use SuppCore\AdministrativoBackend\Api\V1\Resource\DocumentoAvulsoResource;
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
 * @Route(path="/v1/administrativo/documento_avulso")
 *
 * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
 *
 * @OA\Tag(name="DocumentoAvulso")
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @method DocumentoAvulsoResource getResource()
 */
class DocumentoAvulsoController extends Controller
{
    // Traits
    use Actions\User\FindOneAction;
    use Actions\User\FindAction;
    use Actions\Colaborador\CreateAction;
    use Actions\Colaborador\UpdateAction;
    use Actions\Colaborador\PatchAction;
    use Actions\Colaborador\DeleteAction;
    use Actions\User\CountAction;

/** @noinspection MagicMethodsValidityInspection */

    /**
     * DocumentoAvulsoController constructor.
     */
    public function __construct(
        DocumentoAvulsoResource $resource,
        ResponseHandler $responseHandler
    ) {
        $this->init($resource, $responseHandler);
    }

    /**
     * Endpoint action to remeter um documento avulso.
     *
     * @Route(
     *      "/{id}/remeter",
     *      requirements={
     *          "id" = "\d+",
     *      },
     *      methods={"PATCH"},
     *  )
     *
     * @Security("is_granted('ROLE_COLABORADOR')")
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
    public function remeterAction(
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

            $documentoAvulsoResource = $this->getResource();
            $documentoAvulsoDTO = $documentoAvulsoResource->getDtoForEntity($id, DocumentoAvulso::class);
            $documentoAvulsoEntity = $documentoAvulsoResource->remeter($id, $documentoAvulsoDTO, $transactionId, true);

            $this->transactionManager->commit($transactionId);

            return $this->getResponseHandler()->createResponse($request, $documentoAvulsoEntity);
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception, $id);
        }
    }

    /**
     * Endpoint action to change encerramento status.
     *
     * @Route(
     *      "/{id}/toggle_encerramento",
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
    public function toggleEncerramentoAction(
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

            $documentoAvulsoResource = $this->getResource();
            $documentoAvulsoDTO = $documentoAvulsoResource->getDtoForEntity($id, DocumentoAvulso::class);
            $documentoAvulsoEntity = $documentoAvulsoResource->toggleEncerramento(
                $id,
                $documentoAvulsoDTO,
                $transactionId,
                true
            );

            $this->transactionManager->commit($transactionId);

            return $this->getResponseHandler()->createResponse($request, $documentoAvulsoEntity);
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception, $id);
        }
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

            $documentoAvulsoResource = $this->getResource();
            $documentoAvulsoDTO = $documentoAvulsoResource->getDtoForEntity($id, DocumentoAvulso::class);
            $documentoAvulsoEntity = $documentoAvulsoResource
                ->toggleLida($id, $documentoAvulsoDTO, $transactionId, true);

            $this->transactionManager->commit($transactionId);

            return $this->getResponseHandler()->createResponse($request, $documentoAvulsoEntity);
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception, $id);
        }
    }
}
