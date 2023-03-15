<?php

declare(strict_types=1);
/**
 * /src/Controller/CronjobController.php.
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use SuppCore\AdministrativoBackend\Api\V1\Resource\CronjobResource as ApiResource;
use SuppCore\AdministrativoBackend\Rest\Controller;
use SuppCore\AdministrativoBackend\Rest\RequestHandler;
use SuppCore\AdministrativoBackend\Rest\ResponseHandler;
use SuppCore\AdministrativoBackend\Rest\Traits\Actions;
use OpenApi\Annotations as OA;
use SuppCore\AdministrativoBackend\Transaction\Context;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use SuppCore\AdministrativoBackend\Annotation\RestApiDoc;
use Throwable;

/**
 * @Route(path="/v1/administrativo/cronjob")
 *
 * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
 *
 * @OA\Tag(name="Cronjob")
 *
 * @method ApiResource getResource()
 */
class CronjobController extends Controller
{
    // Traits
    use Actions\User\FindOneAction;
    use Actions\User\FindAction;
    use Actions\User\CreateAction;
    use Actions\User\UpdateAction;
    use Actions\User\PatchAction;
    use Actions\User\DeleteAction;
    use Actions\User\CountAction;

    /**
     * CronjobController constructor.
     */
    public function __construct(
        ApiResource $resource,
        ResponseHandler $responseHandler
    ) {
        $this->init($resource, $responseHandler);
    }

    /**
     * Endpoint shortcut action to create or get chat.
     * @RestApiDoc()
     * @throws Throwable
     */
    #[
        Route(
            '/{id}/start_job',
            requirements: ['id' => '\d+'],
            methods: ['PATCH']
        ),
        Security('is_granted(\'ROLE_ADMIN\')'),
    ]
    public function startJob(int $id, Request $request): Response {
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

            $cronJobDTO = $this->resource->getDtoForEntity(
                $id,
                $this->resource->getDtoClass()
            );

            $cronJob = $this
                ->getResource()
                ->startJob($id, $cronJobDTO, $transactionId);

            $this->transactionManager->commit($transactionId);

            return $this->getResponseHandler()->createResponse($request, $cronJob);
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception, $id);
        }
    }
}
