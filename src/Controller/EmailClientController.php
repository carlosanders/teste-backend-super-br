<?php

declare(strict_types=1);
/**
 * /src/Controller/EmailClientController.php.
 */

namespace SuppCore\AdministrativoBackend\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Nelmio\ApiDocBundle\Annotation\Model;
use SuppCore\AdministrativoBackend\Api\V1\Resource\ContaEmailResource;
use SuppCore\AdministrativoBackend\EmailClient\Attachment;
use SuppCore\AdministrativoBackend\EmailClient\EmailClientServiceInterface;
use SuppCore\AdministrativoBackend\EmailClient\Folder;
use SuppCore\AdministrativoBackend\EmailClient\Message;
use SuppCore\AdministrativoBackend\Entity\ContaEmail;
use SuppCore\AdministrativoBackend\Rest\Controller;
use SuppCore\AdministrativoBackend\Rest\RequestHandler;
use SuppCore\AdministrativoBackend\Rest\ResponseHandler;
use SuppCore\AdministrativoBackend\Rest\Traits\RestMethodHelper;
use Symfony\Component\HttpFoundation\Request;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

/**
 * Class EmailClientController.
 *
 * @Route(
 *     path="/email_client",
 *  )
 * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
 *
 */
class EmailClientController  extends Controller
{
    use RestMethodHelper;

    /**
     * @param EmailClientServiceInterface $emailClientService
     * @param ResponseHandler $responseHandler
     * @param ContaEmailResource $resource
     */
    public function __construct(private EmailClientServiceInterface $emailClientService,
                                ResponseHandler $responseHandler,
                                ContaEmailResource $resource)
    {
        $this->init($resource, $responseHandler);
    }

    /**
     * @Route(
     *      "/{id}/folders",
     *      requirements={
     *          "id" = "\d+",
     *      },
     *      methods={"GET"},
     *  )
     *
     * @Security("is_granted('ROLE_COLABORADOR')")
     *
     * @OA\Tag(name="EmailClient")
     *
     * @OA\Response(
     *      response=200,
     *      description="Endpoint action to fetch Folder entities ",
     *     @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              type="array",
     *              @OA\Items(
     *                  @OA\Property(
     *                      property="entities",
     *                      type="array",
     *                      description="array of entities",
     *                      @OA\Items(@OA\Property(property="folder", ref=@Model(type=Folder::class)))
     *                  ),
     *                  @OA\Property(
     *                      property="total",
     *                      type="int",
     *                      description="total os entities",
     *                      example="10"
     *                  ),
     *              )
     *          )
     *      )
     *  )
     *
     * @OA\Response(
     *      response=400,
     *      description="Bad Request",
     *     @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              type="object",
     *              example={"code": 400, "message": "Bad Request"},
     *              @OA\Property(property="code", type="integer", description="Error code"),
     *              @OA\Property(property="message", type="string", description="Error description"),
     *          )
     *      )
     *  )
     * @OA\Response(
     *      response=401,
     *      description="Unauthorized",
     *      @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              type="object",
     *              example={"code": 401, "message": "Bad credentials"},
     *              @OA\Property(property="code", type="integer", description="Error code"),
     *              @OA\Property(property="message", type="string", description="Error description"),
     *          )
     *      )
     *  )
     * @OA\Response(
     *      response=404,
     *      description="Not Found",
     *      @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              type="object",
     *              example={"code": 404, "message": "Not Found"},
     *              @OA\Property(property="code", type="integer", description="Error code"),
     *              @OA\Property(property="message", type="string", description="Error description"),
     *          )
     *      )
     *  )
     *
     * @param Request $request
     * @param int $id
     * @param array|null $allowedHttpMethods
     * @return Response
     * @throws Throwable
     */
    public function getFoldersAction(
        Request $request,
        int $id,
        ?array $allowedHttpMethods = null
    ): Response {
        $allowedHttpMethods ??= ['GET'];

        // Make sure that we have everything we need to make this work
        $this->validateRestMethod($request, $allowedHttpMethods);
        try {
            return $this
                ->getResponseHandler()
                ->createResponse(
                    $request,
                    $this->emailClientService->getFolders($this->resource->findOne($id))
                );
        }catch (Throwable $e) {
            throw $this->handleRestMethodException($e, $id);
        }
    }

    /**
     * @Route(
     *      "/{id}/default_folders",
     *      requirements={
     *          "id" = "\d+",
     *      },
     *      methods={"GET"},
     *  )
     *
     * @Security("is_granted('ROLE_COLABORADOR')")
     *
     * @OA\Tag(name="EmailClient")
     *
     * @OA\Response(
     *      response=200,
     *      description="Endpoint action to fetch Default Folder entities ",
     *     @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              type="array",
     *              @OA\Items(
     *                  @OA\Property(
     *                      property="entities",
     *                      type="array",
     *                      description="array of entities",
     *                      @OA\Items(@OA\Property(property="folder", ref=@Model(type=Folder::class)))
     *                  ),
     *                  @OA\Property(
     *                      property="total",
     *                      type="int",
     *                      description="total os entities",
     *                      example="10"
     *                  ),
     *              )
     *          )
     *      )
     *  )
     *
     * @OA\Response(
     *      response=400,
     *      description="Bad Request",
     *     @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              type="object",
     *              example={"code": 400, "message": "Bad Request"},
     *              @OA\Property(property="code", type="integer", description="Error code"),
     *              @OA\Property(property="message", type="string", description="Error description"),
     *          )
     *      )
     *  )
     * @OA\Response(
     *      response=401,
     *      description="Unauthorized",
     *      @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              type="object",
     *              example={"code": 401, "message": "Bad credentials"},
     *              @OA\Property(property="code", type="integer", description="Error code"),
     *              @OA\Property(property="message", type="string", description="Error description"),
     *          )
     *      )
     *  )
     * @OA\Response(
     *      response=404,
     *      description="Not Found",
     *      @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              type="object",
     *              example={"code": 404, "message": "Not Found"},
     *              @OA\Property(property="code", type="integer", description="Error code"),
     *              @OA\Property(property="message", type="string", description="Error description"),
     *          )
     *      )
     *  )
     * @param Request $request
     * @param int $id
     * @param array|null $allowedHttpMethods
     * @return Response
     * @throws Throwable
     */
    public function getDefaultFoldersAction(
        Request $request,
        int $id,
        ?array $allowedHttpMethods = null
    ): Response {
        $allowedHttpMethods ??= ['GET'];

        // Make sure that we have everything we need to make this work
        $this->validateRestMethod($request, $allowedHttpMethods);
        try {
            return $this
                ->getResponseHandler()
                ->createResponse(
                    $request,
                    $this->emailClientService->getDefaultFolders($this->resource->findOne($id))
                );
        }catch (Throwable $e) {
            throw $this->handleRestMethodException($e, $id);
        }
    }

    /**
     * @Route(
     *      "/{id}/inbox_folder",
     *      requirements={
     *          "id" = "\d+",
     *      },
     *      methods={"GET"},
     *  )
     *
     * @Security("is_granted('ROLE_COLABORADOR')")
     *
     * @OA\Tag(name="EmailClient")
     *
     * @OA\Response(
     *      response=200,
     *      description="Endpoint action to returns Inbox Folder entity",
     *     @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(property="folder", ref=@Model(type=Folder::class))
     *          )
     *      )
     *  )
     *
     * @OA\Response(
     *      response=400,
     *      description="Bad Request",
     *     @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              type="object",
     *              example={"code": 400, "message": "Bad Request"},
     *              @OA\Property(property="code", type="integer", description="Error code"),
     *              @OA\Property(property="message", type="string", description="Error description"),
     *          )
     *      )
     *  )
     * @OA\Response(
     *      response=401,
     *      description="Unauthorized",
     *      @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              type="object",
     *              example={"code": 401, "message": "Bad credentials"},
     *              @OA\Property(property="code", type="integer", description="Error code"),
     *              @OA\Property(property="message", type="string", description="Error description"),
     *          )
     *      )
     *  )
     * @OA\Response(
     *      response=404,
     *      description="Not Found",
     *      @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              type="object",
     *              example={"code": 404, "message": "Not Found"},
     *              @OA\Property(property="code", type="integer", description="Error code"),
     *              @OA\Property(property="message", type="string", description="Error description"),
     *          )
     *      )
     *  )
     * @param Request $request
     * @param int $id
     * @param array|null $allowedHttpMethods
     * @return Response
     * @throws Throwable
     */
    public function getInboxFolderAction(
        Request $request,
        int $id,
        ?array $allowedHttpMethods = null
    ): Response {
        $allowedHttpMethods ??= ['GET'];

        // Make sure that we have everything we need to make this work
        $this->validateRestMethod($request, $allowedHttpMethods);
        try {
            return $this
                ->getResponseHandler()
                ->createResponse(
                    $request,
                    $this->emailClientService->getInboxFolder($this->resource->findOne($id))
                );
        }catch (Throwable $e) {
            throw $this->handleRestMethodException($e, $id);
        }
    }

    /**
     * @Route(
     *      "/{id}/messages",
     *      requirements={
     *          "id" = "\d+"
     *      },
     *      methods={"GET"},
     *  )
     *
     * @Security("is_granted('ROLE_COLABORADOR')")
     *
     * @OA\Tag(name="EmailClient")
     *
     * @OA\Response(
     *      response=200,
     *      description="Endpoint action to fetch Messages entities",
     *     @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              type="array",
     *              @OA\Items(
     *                  @OA\Property(
     *                      property="entities",
     *                      type="array",
     *                      description="array of entities",
     *                      @OA\Items(@OA\Property(property="message", ref=@Model(type=Message::class)))
     *                  ),
     *                  @OA\Property(
     *                      property="total",
     *                      type="int",
     *                      description="total os entities",
     *                      example="10"
     *                  ),
     *              )
     *          )
     *      )
     *  )
     *
     * @OA\Response(
     *      response=400,
     *      description="Bad Request",
     *     @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              type="object",
     *              example={"code": 400, "message": "Bad Request"},
     *              @OA\Property(property="code", type="integer", description="Error code"),
     *              @OA\Property(property="message", type="string", description="Error description"),
     *          )
     *      )
     *  )
     * @OA\Response(
     *      response=401,
     *      description="Unauthorized",
     *      @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              type="object",
     *              example={"code": 401, "message": "Bad credentials"},
     *              @OA\Property(property="code", type="integer", description="Error code"),
     *              @OA\Property(property="message", type="string", description="Error description"),
     *          )
     *      )
     *  )
     * @OA\Response(
     *      response=404,
     *      description="Not Found",
     *      @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              type="object",
     *              example={"code": 404, "message": "Not Found"},
     *              @OA\Property(property="code", type="integer", description="Error code"),
     *              @OA\Property(property="message", type="string", description="Error description"),
     *          )
     *      )
     *  )
     *
     * @param Request $request
     * @param int $id
     * @param array|null $allowedHttpMethods
     * @return Response
     * @throws Throwable
     */
    public function searchMessagesAction(
        Request $request,
        int $id,
        ?array $allowedHttpMethods = null
    ): Response {
        $allowedHttpMethods ??= ['GET'];

        // Make sure that we have everything we need to make this work
        $this->validateRestMethod($request, $allowedHttpMethods);
        try {
            return $this
                ->getResponseHandler()
                ->createResponse(
                    $request,
                    $this->emailClientService->searchMessages(
                        $this->resource->findOne($id),
                        RequestHandler::getCriteria($request),
                        RequestHandler::getLimit($request),
                        RequestHandler::getOffset($request)
                    )
                );
        }catch (Throwable $e) {
            throw $this->handleRestMethodException($e, $id);
        }
    }

    /**
     * @Route(
     *      "/{id}/message/{folder}/{message}",
     *      requirements={
     *          "id" = "\d+"
     *      },
     *      methods={"GET"},
     *  )
     *
     * @Security("is_granted('ROLE_COLABORADOR')")
     *
     * @OA\Tag(name="EmailClient")
     *
     * @OA\Response(
     *      response=200,
     *      description="Endpoint action to returns Message entity",
     *     @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(property="message", ref=@Model(type=Message::class))
     *          )
     *      )
     *  )
     *
     * @OA\Response(
     *      response=400,
     *      description="Bad Request",
     *     @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              type="object",
     *              example={"code": 400, "message": "Bad Request"},
     *              @OA\Property(property="code", type="integer", description="Error code"),
     *              @OA\Property(property="message", type="string", description="Error description"),
     *          )
     *      )
     *  )
     * @OA\Response(
     *      response=401,
     *      description="Unauthorized",
     *      @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              type="object",
     *              example={"code": 401, "message": "Bad credentials"},
     *              @OA\Property(property="code", type="integer", description="Error code"),
     *              @OA\Property(property="message", type="string", description="Error description"),
     *          )
     *      )
     *  )
     * @OA\Response(
     *      response=404,
     *      description="Not Found",
     *      @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              type="object",
     *              example={"code": 404, "message": "Not Found"},
     *              @OA\Property(property="code", type="integer", description="Error code"),
     *              @OA\Property(property="message", type="string", description="Error description"),
     *          )
     *      )
     *  )
     * @param Request $request
     * @param int $id
     * @param int|string $folder
     * @param int|string $message
     * @param array|null $allowedHttpMethods
     * @return Response
     * @throws Throwable
     */
    public function getMessageAction(
        Request $request,
        int $id,
        int|string $folder,
        int|string $message,
        ?array $allowedHttpMethods = null
    ): Response
    {
        $allowedHttpMethods ??= ['GET'];

        // Make sure that we have everything we need to make this work
        $this->validateRestMethod($request, $allowedHttpMethods);
        try {
            return $this
                ->getResponseHandler()
                ->createResponse(
                    $request,
                    $this->emailClientService->getMessage(
                        $this->resource->findOne($id),
                        $folder,
                        $message
                    )
                );
        }catch (Throwable $e) {
            throw $this->handleRestMethodException($e, $id);
        }
    }

    /**
     * @Route(
     *      "/{id}/message/{folder}/{message}/{attachment}",
     *      requirements={
     *          "id" = "\d+"
     *      },
     *      methods={"GET"},
     *  )
     * @Security("is_granted('ROLE_COLABORADOR')")
     *
     * @OA\Tag(name="EmailClient")
     *
     * @OA\Response(
     *      response=200,
     *      description="Endpoint action to returns Attachment entity of message",
     *     @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(property="attachment", ref=@Model(type=Attachment::class))
     *          )
     *      )
     *  )
     *
     * @OA\Response(
     *      response=400,
     *      description="Bad Request",
     *     @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              type="object",
     *              example={"code": 400, "message": "Bad Request"},
     *              @OA\Property(property="code", type="integer", description="Error code"),
     *              @OA\Property(property="message", type="string", description="Error description"),
     *          )
     *      )
     *  )
     * @OA\Response(
     *      response=401,
     *      description="Unauthorized",
     *      @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              type="object",
     *              example={"code": 401, "message": "Bad credentials"},
     *              @OA\Property(property="code", type="integer", description="Error code"),
     *              @OA\Property(property="message", type="string", description="Error description"),
     *          )
     *      )
     *  )
     * @OA\Response(
     *      response=404,
     *      description="Not Found",
     *      @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              type="object",
     *              example={"code": 404, "message": "Not Found"},
     *              @OA\Property(property="code", type="integer", description="Error code"),
     *              @OA\Property(property="message", type="string", description="Error description"),
     *          )
     *      )
     *  )
     * @param Request $request
     * @param int $id
     * @param int|string $folder
     * @param int|string $message
     * @param int|string $attachment
     * @param array|null $allowedHttpMethods
     * @return Response
     * @throws Throwable
     */
    public function getAttachmentAction(
        Request $request,
        int $id,
        int|string $folder,
        int|string $message,
        int|string $attachment,
        ?array $allowedHttpMethods = null
    ): Response
    {
        $allowedHttpMethods ??= ['GET'];

        // Make sure that we have everything we need to make this work
        $this->validateRestMethod($request, $allowedHttpMethods);
        try {
            return $this
                ->getResponseHandler()
                ->createResponse(
                    $request,
                    $this->emailClientService->getAttachment(
                        $this->resource->findOne($id),
                        $folder,
                        $message,
                        $attachment
                    )
                );
        }catch (Throwable $e) {
            throw $this->handleRestMethodException($e, $id);
        }
    }
}
