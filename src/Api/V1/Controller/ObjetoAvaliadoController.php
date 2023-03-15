<?php

declare(strict_types=1);
/**
 * /src/Controller/ObjetoAvaliadoController.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Controller;

use JMS\Serializer\Exception\LogicException;
use OpenApi\Annotations as OA;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use SuppCore\AdministrativoBackend\Annotation\RestApiDoc;
use SuppCore\AdministrativoBackend\Api\V1\Resource\ObjetoAvaliadoResource;
use SuppCore\AdministrativoBackend\Rest\Controller;
use SuppCore\AdministrativoBackend\Rest\RequestHandler;
use SuppCore\AdministrativoBackend\Rest\ResponseHandler;
use SuppCore\AdministrativoBackend\Rest\Traits\Actions as AdministrativoActions;
use SuppCore\AdministrativoBackend\Transaction\Context;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

/**
 * @Route(path="/v1/administrativo/objeto_avaliado")
 *
 * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
 *
 * @OA\Tag(name="ObjetoAvaliado")
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @method ObjetoAvaliadoResource getResource()
 */
class ObjetoAvaliadoController extends Controller
{
    // Traits
    use AdministrativoActions\User\FindOneAction;
    use AdministrativoActions\User\FindAction;
    use AdministrativoActions\Colaborador\CreateAction;
    use AdministrativoActions\Colaborador\UpdateAction;
    use AdministrativoActions\Colaborador\PatchAction;
    use AdministrativoActions\Root\DeleteAction;
    use AdministrativoActions\User\CountAction;

    /** @noinspection MagicMethodsValidityInspection */

    /**
     * ObjetoAvaliadoController constructor.
     *
     * @param ObjetoAvaliadoResource $resource
     * @param ResponseHandler        $responseHandler
     */
    public function __construct(
        ObjetoAvaliadoResource $resource,
        ResponseHandler $responseHandler,
        private ObjetoAvaliadoResource $objetoAvaliadoResource
    ) {
        $this->init($resource, $responseHandler);
    }

    /**
     * Endpoint action to consultar objeto avaliado.
     *
     * @Route(
     *      "/consultar",
     *      methods={"POST"},
     *  )
     *
     * @Security("is_granted('ROLE_COLABORADOR')")
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
    public function consultaMethod(
        Request $request,
        FormFactoryInterface $formFactory,
        ?array $allowedHttpMethods = null
    ): Response {
        $allowedHttpMethods ??= ['POST'];

        // Make sure that we have everything we need to make this work
        $this->validateRestMethod($request, $allowedHttpMethods);

        $context = RequestHandler::getContext($request);

        try {
            $transactionId = $this->transactionManager->begin();

            foreach ($context as $name => $value) {
                $this->transactionManager->addContext(
                    new Context($name, $value),
                    $transactionId
                );
            }

            $dto = $this->processFormMapper($request, self::METHOD_CREATE);

            // verifica a existência da entity no repository
            $data = $this
                ->objetoAvaliadoResource
                ->findOneBy([
                    'classe' => $dto->getClasse(),
                    'objetoId' => $dto->getObjetoId(),
                ]);
            // caso não exista, inicia o processo de criação da entity
            if (!$data) {
                $data = $this
                    ->getResource()
                    ->create($dto, $transactionId, true);

                $this->transactionManager->commit($transactionId);
            }

            return $this
                ->getResponseHandler()
                ->createResponse($request, $data, Response::HTTP_CREATED);
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception);
        }
    }
}
