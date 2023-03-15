<?php

declare(strict_types=1);
/**
 * /src/Controller/JuntadaController.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Controller;

use DateInterval;
use DateTime;
use Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use SuppCore\AdministrativoBackend\Annotation\RestApiDoc;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Documento;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Juntada;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Tarefa;
use SuppCore\AdministrativoBackend\Api\V1\Resource\ComponenteDigitalResource;
use SuppCore\AdministrativoBackend\Api\V1\Resource\DocumentoResource;
use SuppCore\AdministrativoBackend\Api\V1\Resource\EspecieTarefaResource;
use SuppCore\AdministrativoBackend\Api\V1\Resource\JuntadaResource;
use SuppCore\AdministrativoBackend\Api\V1\Resource\ProcessoResource;
use SuppCore\AdministrativoBackend\Api\V1\Resource\TarefaResource;
use SuppCore\AdministrativoBackend\Api\V1\Resource\TipoDocumentoResource;
use SuppCore\AdministrativoBackend\Api\V1\Resource\VinculacaoPessoaUsuarioResource;
use SuppCore\AdministrativoBackend\Entity\VinculacaoPessoaUsuario;
use SuppCore\AdministrativoBackend\Repository\SetorRepository;
use SuppCore\AdministrativoBackend\Rest\Controller;
use SuppCore\AdministrativoBackend\Rest\RequestHandler;
use SuppCore\AdministrativoBackend\Rest\ResponseHandler;
use SuppCore\AdministrativoBackend\Rest\Traits\Actions;
use SuppCore\AdministrativoBackend\Transaction\Context;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * @Route(path="/v1/administrativo/juntada")
 *
 * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
 *
 * @OA\Tag(name="Juntada")
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @method JuntadaResource getResource()
 */
class JuntadaController extends Controller
{
    // Traits
    use Actions\User\FindOneAction;
    use Actions\User\FindAction;
    use Actions\Colaborador\CreateAction;
    use Actions\Colaborador\UpdateAction;
    use Actions\Colaborador\PatchAction;
    use Actions\Root\DeleteAction;
    use Actions\Colaborador\CountAction;

/** @noinspection MagicMethodsValidityInspection */

    /**
     * JuntadaController constructor.
     */
    public function __construct(
        JuntadaResource $resource,
        ResponseHandler $responseHandler,
        AuthorizationCheckerInterface $authorizationChecker,
        TokenStorageInterface $tokenStorage,
        DocumentoResource $documentoResource,
        TipoDocumentoResource $tipoDocumentoResource,
        JuntadaResource $juntadaResource,
        ProcessoResource $processoResource,
        TarefaResource $tarefaResource,
        EspecieTarefaResource $especieTarefaResource,
        ComponenteDigitalResource $componenteDigitalResource,
        VinculacaoPessoaUsuarioResource $vinculacaoPessoaUsuarioResource,
        protected SetorRepository $setorRepository,
    ) {
        $this->init($resource, $responseHandler);
        $this->authorizationChecker = $authorizationChecker;
        $this->tokenStorage = $tokenStorage;
        $this->documentoResource = $documentoResource;
        $this->tipoDocumentoResource = $tipoDocumentoResource;
        $this->juntadaResource = $juntadaResource;
        $this->processoResource = $processoResource;
        $this->tarefaResource = $tarefaResource;
        $this->especieTarefaResource = $especieTarefaResource;
        $this->vinculacaoPessoaUsuarioResource = $vinculacaoPessoaUsuarioResource;
        $this->componenteDigitalResource = $componenteDigitalResource;
    }

    /**
     * @Route(
     *      "/{id}/sendEmail",
     *      requirements={
     *          "id" = "\d+",
     *      },
     *      methods={"GET"},
     *  )
     *
     * @Security("is_granted('ROLE_COLABORADOR')")
     *
     * @RestApiDoc()
     *
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws Exception
     */
    public function sendEmailAction(Request $request, int $id): Response
    {
        $transactionId = $this->transactionManager->begin();

        $context = RequestHandler::getContext($request);

        foreach ($context as $name => $value) {
            $this->transactionManager->addContext(
                new Context($name, $value),
                $transactionId
            );
        }

        $entity = $this->getResource()->sendEmailMethod($request, $id, $transactionId);

        $this->transactionManager->commit($transactionId);

        return $this->getResponseHandler()->createResponse($request, $entity);
    }

    /**
     * @Route(
     *      "/{id}/protocoloNupExistente",
     *      requirements={
     *          "id" = "\d+",
     *      },
     *      methods={"POST"},
     *  )
     *
     * @Security("is_granted('ROLE_USER')")
     *
     * @RestApiDoc()
     *
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws Exception
     */
    public function protocoloNupExistenteAction(Request $request, int $id): Response
    {

        $allowedHttpMethods ??= ['POST'];
        $transactionId = $this->transactionManager->begin();

        $context = RequestHandler::getContext($request);

        foreach ($context as $name => $value) {
            $this->transactionManager->addContext(
                new Context($name, $value),
                $transactionId
            );
        }

        $entity = $this->getResource()->protocoloNupExistenteMethod($request, $id, $transactionId);

        $this->transactionManager->commit($transactionId);

        return $this->getResponseHandler()->createResponse($request, $entity);
    }
}
