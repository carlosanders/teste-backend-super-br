<?php

declare(strict_types=1);
/**
 * /src/Controller/AssinaturaController.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Controller;

use Symfony\Component\Mercure\HubInterface;
use function in_array;
use OpenApi\Annotations as OA;
use Redis;
use SuppCore\AdministrativoBackend\Annotation\RestApiDoc;
use SuppCore\AdministrativoBackend\Api\V1\Resource\AssinaturaResource;
use SuppCore\AdministrativoBackend\Rest\Controller;
use SuppCore\AdministrativoBackend\Rest\ResponseHandler;
use SuppCore\AdministrativoBackend\Rest\Traits\Actions;
use SuppCore\AdministrativoBackend\Security\LoginUnicoGovBrService;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Throwable;

/**
 * @Route(path="/v1/administrativo/assinatura")
 *
 * @OA\Tag(name="Assinatura")
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @method AssinaturaResource getResource()
 */
class AssinaturaController extends Controller
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
     * AssinaturaController constructor.
     */
    public function __construct(
        AssinaturaResource $resource,
        ResponseHandler $responseHandler
    ) {
        $this->init($resource, $responseHandler);
    }

    /**
     * Endpoint action to get jnlp.
     *
     * @Route(
     *      "/{secret}/get_jnlp",
     *      methods={"GET"}
     *  )
     *
     * @RestApiDoc()
     */
    public function getJNLPAction(
        string $secret,
        ParameterBagInterface $parameterBag,
        Redis $redisClient
    ): Response {
        if ($redisClient->exists($secret)) {
            $argument = $redisClient->get($secret);
            $codebase = $parameterBag->get('supp_core.administrativo_backend.url_sistema_backend').'/';
            $conteudoJNLP = '<?xml version="1.0" encoding="utf-8"?><jnlp codebase="'.$codebase.'"><information><title>Assinador de Arquivos</title><vendor>Advocacia-Geral da União</vendor><homepage href="https://www.agu.gov.br"/><description>Assinador de arquivos (PKCS#11)</description><description kind="short">Assinador de Arquivos</description><offline-allowed/></information><security><all-permissions/></security><resources><j2se version="1.8+"/><jar eager="true" href="'.$codebase.'assinador-supp-0.0.1.jar" main="true"/></resources><application-desc main-class="agu.security.app.SmartCardSignerApp"><argument>'.$argument.'</argument></application-desc></jnlp>';
        } else {
            throw new AccessDeniedException();
        }

        $response = new Response();

        $response->headers->set('Content-type', 'application/x-java-jnlp-file');
        $response->headers->set('Content-Disposition', 'inline; filename=assinador-supp-0.0.1.jnlp');
        $response->headers->set('Content-length', strlen($conteudoJNLP));
        $response->sendHeaders();
        $response->setContent($conteudoJNLP);

        return $response;
    }

    /**
     * Endpoint para obter o token de Revalidação de senha no GovBr
     * e usá-lo em seguida para a chamada dos endpoint's de assinatura.
     *
     * @Route(
     *      "/govbr_token_revalida",
     *      methods={"POST"},
     *  );
     * @RestApiDoc()
     *
     * @throws Throwable
     */
    public function ssoGovBrRevalidaAction(
        Request $request,
        LoginUnicoGovBrService $loginUnicoGovBrService,
        TokenStorageInterface $tokenStorage,
        ?array $allowedHttpMethods = null
    ): Response {
        $allowedHttpMethods ??= ['POST'];
        $this->validateRestMethod($request, $allowedHttpMethods);

        try {
            $user = $tokenStorage->getToken()->getUser();
            $response = [];

            if ($request->get('state') && $request->get('code')) {
                $tokenRevalida = $loginUnicoGovBrService->retornaDadosRevalida($request->get('code'), $request->get('state'));
                $response = [
                    'jwt' => $tokenRevalida,
                ];
            } else {
                throw new BadCredentialsException('Dados incorretos!');
            }

            return new JsonResponse(
                  $response
            );
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception);
        }
    }

    /**
     * Endpoint action to broadcast assinatura status.
     *
     * @Route(
     *      "/status",
     *      methods={"POST"}
     *  )
     *
     * @RestApiDoc()
     */
    public function publishStatusAction(
        Request $request,
        TokenStorageInterface $tokenStorage,
        HubInterface $hub,
        Redis $redisClient
    ): JsonResponse {
        $documentosId = [];

        $secret = md5($request->get('jwt'));

        if ($secret) {
            if ($redisClient->exists($secret)) {
                $argument = json_decode($redisClient->get($secret), true);

                foreach ($argument['files'] as $file) {
                    if (!in_array($file['documentoId'], $documentosId, true)) {
                        $documentosId[] = $file['documentoId'];
                    }
                }
            }
        } else {
            $documentosId[] = $request->get('documentoId');
        }

        foreach ($documentosId as $documentoId) {
            $update = new Update(
                $tokenStorage->getToken()->getUser()->getUsername(),
                json_encode(
                    [
                        'assinatura' => [
                            'action' => $request->get('action'),
                            'documentoId' => $documentoId,
                        ],
                    ]
                )
            );

            $hub->publish($update);
        }

        return new JsonResponse(['status' => 'ok']);
    }
}
