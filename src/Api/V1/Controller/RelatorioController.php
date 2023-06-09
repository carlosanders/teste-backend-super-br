<?php

declare(strict_types=1);
/**
 * /src/Controller/RelatorioController.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Controller;

use LogicException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use SuppCore\AdministrativoBackend\Annotation\RestApiDoc;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Relatorio;
use SuppCore\AdministrativoBackend\Api\V1\Resource\RelatorioResource;
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
 * @Route(path="/v1/administrativo/relatorio")
 *
 * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
 *
 * @OA\Tag(name="Relatorio")
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @method RelatorioResource getResource()
 */
class RelatorioController extends Controller
{
    // Traits
    use Actions\Colaborador\FindOneAction;
    use Actions\Colaborador\FindAction;
    use Actions\Colaborador\CreateAction;
    use Actions\Root\UpdateAction;
    use Actions\Root\PatchAction;
    use Actions\Colaborador\DeleteAction;
    use Actions\Colaborador\CountAction;

/** @noinspection MagicMethodsValidityInspection */

    /**
     * RelatorioController constructor.
     */
    public function __construct(
        RelatorioResource $resource,
        ResponseHandler $responseHandler
    ) {
        $this->init($resource, $responseHandler);
    }

    /**
     * Endpoint action to download.
     *
     * @Route(      "/{id}/download_as_pdf",          requirements={"id":"\d+"}, methods={"GET"} )
     *
     * @RestApiDoc()
     *
     * @Security("is_granted('ROLE_COLABORADOR')")
     *
     * @param string[]|null $allowedHttpMethods
     *
     * @throws LogicException
     * @throws Throwable
     * @throws HttpException
     * @throws MethodNotAllowedHttpException
     */
    public function downloadAsPdfAction(
        Request $request,
        int $id,
        ?array $allowedHttpMethods = null
    ): Response {
        $allowedHttpMethods ??= ['GET'];

        // Make sure that we have everything we need to make this work
        $this->validateRestMethod($request, $allowedHttpMethods);

        try {
            // Fetch data from database
            return $this
                ->getResponseHandler()
                ->createResponse($request, $this->getResource()->download($id, true, true));
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception, $id);
        }
    }

    /**
     * Endpoint para gerar o relatorio das tarefas abertas para o usuario (todas ou somente as selecionadas).
     *
     * @Route("/gerar_relatorio_minhas_tarefas", methods={"POST"} )
     *
     * @RestApiDoc()
     *
     * @Security("is_granted('ROLE_COLABORADOR')")
     * 
     * @OA\RequestBody(
     *      description="Para relatório de todas as tarefas informar um array vazio []. Para tarefas selecionadas informar a relação de id's da tarefas [id1, id2, ...]. ",
     *      required=true,
     *      @OA\MediaType(
     *         mediaType="application/json",
     *         @OA\Schema(
     *              type="object",
     *              example={"idTarefasSelecionadas": "[]"}
     *          )
     *     )
     *  )
     * @param string[]|null $allowedHttpMethods
     *
     * @throws LogicException
     * @throws Throwable
     * @throws HttpException
     * @throws MethodNotAllowedHttpException
     */
    public function gerarRelatorioMinhasTarefasAction(
       Request $request,
        ?array $allowedHttpMethods = null
    ): Response {
        $allowedHttpMethods ??= ['POST'];
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
            $tarefas = json_decode(file_get_contents('php://input'));

            $relatorio = $this->getResource()->gerarRelatorioMinhasTarefas($transactionId, $tarefas);
            $this->transactionManager->commit($transactionId);

            return $this
                ->getResponseHandler()
                ->createResponse($request, $relatorio);
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception);
        }
    }
}
