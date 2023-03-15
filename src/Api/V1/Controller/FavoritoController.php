<?php

declare(strict_types=1);
/**
 * /src/Controller/FavoritoController.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Controller;

use LogicException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use SuppCore\AdministrativoBackend\Annotation\RestApiDoc;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Usuario;
use SuppCore\AdministrativoBackend\Api\V1\Resource\FavoritoResource;
use SuppCore\AdministrativoBackend\Rest\Controller;
use SuppCore\AdministrativoBackend\Rest\RequestHandler;
use SuppCore\AdministrativoBackend\Rest\ResponseHandler;
use SuppCore\AdministrativoBackend\Rest\Traits\Actions;
use SuppCore\AdministrativoBackend\Security\ApiKeyUser;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Throwable;

/**
 * @Route(path="/v1/administrativo/favorito")
 *
 * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
 *
 * @OA\Tag(name="Favorito")
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @method FavoritoResource getResource()
 */
class FavoritoController extends Controller
{
    // Traits
    use Actions\User\FindOneAction;
    use Actions\User\FindAction;
    use Actions\Root\CreateAction;
    use Actions\Root\UpdateAction;
    use Actions\Root\PatchAction;
    use Actions\Root\DeleteAction;
    use Actions\Colaborador\CountAction;

/** @noinspection MagicMethodsValidityInspection */

    /**
     * FavoritoController constructor.
     */
    public function __construct(
        FavoritoResource $resource,
        ResponseHandler $responseHandler
    ) {
        $this->init($resource, $responseHandler);
    }

    /**
     * @Route(
     *      path="",
     *      methods={"GET"},
     *  )
     *
     * @Security("is_granted('ROLE_USER')")
     *
     * @RestApiDoc()
     *
     * @throws LogicException
     * @throws Throwable
     * @throws HttpException
     * @throws MethodNotAllowedHttpException
     */
    public function findAction(
        Request $request,
        TokenStorageInterface $tokenStorage
    ): Response {
        $allowedHttpMethods = ['GET'];

        // Make sure that we have everything we need to make this work
        $this->validateRestMethod($request, $allowedHttpMethods);

        // Determine used parameters
        $orderBy = RequestHandler::getOrderBy($request);
        $limit = RequestHandler::getLimit($request);
        $offset = RequestHandler::getOffset($request);
        $search = RequestHandler::getSearchTerms($request);
        $populate = RequestHandler::getPopulate($request, $this->getResource());

        try {
            $criteria = RequestHandler::getCriteria($request);

            /** @var TokenInterface $tokenInterface */
            $tokenInterface = $tokenStorage->getToken();

            /** @var Usuario|ApiKeyUser $user */
            $usuario = $tokenInterface->getUser();

            $criteria['usuario.id'] = 'eq:'.$usuario->getId();

            return $this
                ->getResponseHandler()
                ->createResponse($request, $this->getResource()->find($criteria, $orderBy, $limit, $offset, $search, $populate));
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception);
        }
    }

    /**
     * Generic 'findMethod' method for REST resources.
     *
     * @param string[]|null $allowedHttpMethods
     *
     * @throws LogicException
     * @throws Throwable
     * @throws HttpException
     * @throws MethodNotAllowedHttpException
     */
    public function findMethod(Request $request, ?array $allowedHttpMethods = null): Response
    {
    }
}
