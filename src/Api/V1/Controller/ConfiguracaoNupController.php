<?php

declare(strict_types=1);
/**
 * /src/Controller/ConfiguracaoNupController.php.
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use SuppCore\AdministrativoBackend\Annotation\RestApiDoc;
use SuppCore\AdministrativoBackend\Api\V1\DTO\ConfiguracaoNup;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Processo;
use SuppCore\AdministrativoBackend\Api\V1\Resource\ConfiguracaoNupResource;
use SuppCore\AdministrativoBackend\Rest\Controller;
use SuppCore\AdministrativoBackend\Rest\ResponseHandler;
use SuppCore\AdministrativoBackend\Rest\Traits\Actions;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

/**
 * @Route(path="/v1/administrativo/configuracao_nup")
 *
 * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
 *
 * @OA\Tag(name="ConfiguracaoNup")

 *
 * @method ConfiguracaoNupResource getResource()
 */
class ConfiguracaoNupController extends Controller
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
     * CampoController constructor.
     */
    public function __construct(
        ConfiguracaoNupResource $resource,
        ResponseHandler $responseHandler
    ) {
        $this->init($resource, $responseHandler);
    }

    /**
     * Endpoint para validar o NUP.
     *
     * @Route(
     *      "/{configuracaoNup}/validar_nup/{nup}/{unidadeArquivistica}",
     *      requirements={
     *          "id" = "\d+",
     *      },
     *      methods={"GET"},
     *  )
     *
     * @RestApiDoc()
     *
     * @Security("is_granted('ROLE_USER')")
     *
     * @param string[]|null $allowedHttpMethods
     *
     * @throws \ReflectionException
     * @throws \Throwable
     */
    public function validarNupAction(
        Request $request,
        ?int $configuracaoNup,
        string $nup,
        ?int $unidadeArquivistica,
        ?array $allowedHttpMethods = null
    ): Response {
        $allowedHttpMethods ??= ['GET'];
        // Make sure that we have everything we need to make this work
        $this->validateRestMethod($request, $allowedHttpMethods);
        try {
            $configuracaoNupEntity = $this->getResource()->getRepository()->find($configuracaoNup);
            $processoDTO = new Processo();
            $processoDTO->setConfiguracaoNup($configuracaoNupEntity);
            $processoDTO->setNUP($nup);
            $processoDTO->setUnidadeArquivistica($unidadeArquivistica);
            $processoDTO = $this->getResource()->validarNup($processoDTO);

            return $this
                ->getResponseHandler()
                ->createResponse($request, $processoDTO);
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception, $configuracaoNup);
        }
    }
}
