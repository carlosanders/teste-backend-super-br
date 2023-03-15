<?php

declare(strict_types=1);
/**
 * /src/Controller/TramitacaoController.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use SuppCore\AdministrativoBackend\Annotation\RestApiDoc;
use SuppCore\AdministrativoBackend\Api\V1\DTO\ComponenteDigital;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Tramitacao;
use SuppCore\AdministrativoBackend\Api\V1\Resource\TramitacaoResource;
use SuppCore\AdministrativoBackend\Rest\Controller;
use SuppCore\AdministrativoBackend\Rest\ResponseHandler;
use SuppCore\AdministrativoBackend\Rest\Traits\Actions;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Throwable;
use Twig\Environment;

/**
 * @Route(path="/v1/administrativo/tramitacao")
 *
 * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
 *
 * @OA\Tag(name="Tramitacao")
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @method TramitacaoResource getResource()
 */
class TramitacaoController extends Controller
{
    // Traits
    use Actions\Colaborador\FindOneAction;
    use Actions\Colaborador\FindAction;
    use Actions\Colaborador\CreateAction;
    use Actions\Colaborador\UpdateAction;
    use Actions\Colaborador\PatchAction;
    use Actions\Colaborador\DeleteAction;
    use Actions\Colaborador\CountAction;

/** @noinspection MagicMethodsValidityInspection */

    /**
     * TramitacaoController constructor.
     */
    public function __construct(
        TramitacaoResource $resource,
        ResponseHandler $responseHandler
    ) {
        $this->init($resource, $responseHandler);
    }

    /**
     * Endpoint action to imprimir guia de tramitação.
     *
     * @Route(
     *      "/imprime_guia/{tramitacaoId}",
     *      requirements={
     *          "tramiacaoId" = "\d+",
     *      },
     *      methods={"GET"},
     *  )
     *
     * @RestApiDoc()     *
     * @Security("is_granted('ROLE_USER')")
     *
     * @param string[]|null $allowedHttpMethods
     *
     * @throws Throwable
     */
    public function imprimirGuiaAction(
        Request $request,
        int $tramitacaoId,
        Environment $twig,
        TokenStorageInterface $tokenStorage,
        ?array $allowedHttpMethods = null
    ): Response {
        $allowedHttpMethods ??= ['GET'];

        // Make sure that we have everything we need to make this work
        $this->validateRestMethod($request, $allowedHttpMethods);

        try {
            $usuario = $tokenStorage->getToken()->getUser();
            $componenteDigitalDTO = new ComponenteDigital();

            //$tramitacao = explode('|', $tramitacoes);
            $resultado = [];
            //foreach ($tramitacao as $t) {
            //   if ((0 != $t) && ('' != $t)) {
            array_push($resultado, $this->getResource()->getRepository()->find($tramitacaoId));
            //  }
            //   }

            if ($resultado) {
                $conteudoHTML = $twig->render(
                    'Resources/Tramitacao/layout_guia.html.twig',
                    ['tramitacao' => $resultado, 'usuario' => $usuario]
                );

                $componenteDigitalDTO->setConteudo($conteudoHTML);
            }

            // Fetch data from database
            return $this
                ->getResponseHandler()
                ->createResponse($request, $componenteDigitalDTO);
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception, null);
        }
    }
}
