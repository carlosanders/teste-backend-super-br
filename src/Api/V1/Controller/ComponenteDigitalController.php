<?php

declare(strict_types=1);
/**
 * /src/Controller/ComponenteDigitalController.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Knp\Component\Pager\PaginatorInterface;
use LogicException;
use ONGR\ElasticsearchBundle\Service\IndexService;
use ONGR\ElasticsearchDSL\Highlight\Highlight;
use ONGR\ElasticsearchDSL\Sort\FieldSort;
use OpenApi\Annotations as OA;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use SuppCore\AdministrativoBackend\Annotation\RestApiDoc;
use SuppCore\AdministrativoBackend\Api\V1\DTO\ComponenteDigital as ComponenteDigitalDTO;
use SuppCore\AdministrativoBackend\Api\V1\Resource\ComponenteDigitalResource;
use SuppCore\AdministrativoBackend\Api\V1\Resource\DocumentoResource;
use SuppCore\AdministrativoBackend\Elastic\ElasticQueryBuilderService;
use SuppCore\AdministrativoBackend\Repository\JuntadaRepository;
use SuppCore\AdministrativoBackend\Rest\Controller;
use SuppCore\AdministrativoBackend\Rest\RequestHandler;
use SuppCore\AdministrativoBackend\Rest\ResponseHandler;
use SuppCore\AdministrativoBackend\Rest\Traits\Actions;
use SuppCore\AdministrativoBackend\Transaction\Context;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;
use Twig\Environment;

/**
 * @Route(path="/v1/administrativo/componente_digital")
 *
 * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
 *
 * @OA\Tag(name="ComponenteDigital")
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @method ComponenteDigitalResource getResource()
 */
class ComponenteDigitalController extends Controller
{
    // Traits
    use Actions\User\FindOneAction;
    use Actions\User\FindAction;
    use Actions\User\CreateAction;
    use Actions\Colaborador\UpdateAction;
    use Actions\User\PatchAction;
    use Actions\Colaborador\DeleteAction;
    use Actions\User\CountAction;
    use Actions\Colaborador\UndeleteAction;

    private IndexService $componenteDigitalIndex;
    private ElasticQueryBuilderService $elasticQueryBuilderService;
    private PaginatorInterface $paginator;
    private DocumentoResource $documentoResource;
    private JuntadaRepository $juntadaRepository;

    /**
     * ComponenteDigitalController constructor.
     */
    public function __construct(
        ComponenteDigitalResource $resource,
        ResponseHandler $responseHandler,
        IndexService $componenteDigitalIndex,
        ElasticQueryBuilderService $elasticQueryBuilderService,
        PaginatorInterface $paginator,
        DocumentoResource $documentoResource,
        JuntadaRepository $juntadaRepository,
    ) {
        $this->init($resource, $responseHandler);
        $this->componenteDigitalIndex = $componenteDigitalIndex;
        $this->elasticQueryBuilderService = $elasticQueryBuilderService;
        $this->paginator = $paginator;
        $this->documentoResource = $documentoResource;
        $this->juntadaRepository = $juntadaRepository;
    }

    /**
     * Endpoint action to download.
     *
     * @Route(
     *      "/{id}/download",
     *      requirements={
     *          "id" = "\d+",
     *      },
     *      methods={"GET"},
     *  )
     *
     * @RestApiDoc()
     * @Security("is_granted('ROLE_USER')")
     *
     * @param string[]|null          $allowedHttpMethods
     * @param EntityManagerInterface $em
     *
     * @throws Throwable
     */
    public function downloadAction(
        Request $request,
        int $id,
        Environment $twig,
        ?array $allowedHttpMethods = null
    ): Response {
        $allowedHttpMethods ??= ['GET'];

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

            $asPdf = false;
            $asXls = false;

            if (isset($context['asPdf']) && (true === $context['asPdf'])) {
                $asPdf = true;
            }

            if (isset($context['asXls']) && (true === $context['asXls'])) {
                $asXls = true;
            }

            $versao = null;

            if (isset($context['versao'])) {
                $versao = $context['versao'];
            }

            $componenteDigitalEntity = $this->getResource()->download(
                $id,
                $transactionId,
                true,
                $asPdf,
                $versao,
                true,
                $asXls
            );

            if ($asPdf || $asXls) {
                $componenteDigitalEntity->setAllowUnsafe(true);
            }

            $compararVersao = null;

            if (isset($context['compararVersao'])) {
                $compararVersao = $context['compararVersao'];
                $conteudo1 = $componenteDigitalEntity->getConteudo();

                $componenteDigitalCompararEntity = $this->getResource()->download(
                    $id,
                    $transactionId,
                    true,
                    $asPdf,
                    $compararVersao,
                    true,
                    $asXls
                );

                $conteudo2 = $componenteDigitalCompararEntity->getConteudo();

                $usuarioAlteracao = [];
                $usuarioAlteracao['nome'] = $componenteDigitalEntity->getAtualizadoPor()->getNome();
                $usuarioAlteracao['criadoEm'] = $componenteDigitalEntity->getApagadoEm();

                preg_match("/<body[^>]*>(.*?)<\/body>/is", $conteudo1, $matches1);
                preg_match("/<body[^>]*>(.*?)<\/body>/is", $conteudo2, $matches2);

                $conteudoHTML = $twig->render(
                    'Resources/Ckeditor/comparar/compararVersoes.html.twig',
                    [
                        'versao1' => strip_tags($matches1[1]),
                        'versao2' => strip_tags($matches2[1]),
                        'tipoDocumento' => $componenteDigitalEntity->getDocumento()->getTipoDocumento()->getNome(),
                        'usuarioAlteracao' => $usuarioAlteracao,
                    ]
                );

                $componenteDigitalEntity->setConteudo($conteudoHTML);
                $componenteDigitalEntity->setAllowUnsafe(true);
            }
            $this->transactionManager->commit();

            // Fetch data from database
            return $this
                ->getResponseHandler()
                ->createResponse($request, $componenteDigitalEntity);
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception, $id);
        }
    }

    /**
     * Endpoint action to download.
     *
     * @Route(
     *      "/{processoId}/download_latest",
     *      requirements={
     *          "processoId" = "\d+",
     *      },
     *      methods={"GET"},
     *  )
     *
     * @RestApiDoc()
     * @Security("is_granted('ROLE_USER')")
     *
     * @param string[]|null          $allowedHttpMethods
     * @param EntityManagerInterface $em
     *
     * @throws Throwable
     */
    public function downloadLastestAction(
        Request $request,
        int $processoId,
        Environment $twig,
        ?array $allowedHttpMethods = null
    ): Response {
        $allowedHttpMethods ??= ['GET'];
        $id = null;

        // Make sure that we have everything we need to make this work
        $this->validateRestMethod($request, $allowedHttpMethods);

        try {
            $transactionId = $this->transactionManager->begin();

            $juntada = $this->juntadaRepository->findLastNaoVinculadaByProcessoId($processoId);

            if (!$juntada) {
                throw new Exception('sem_juntadas', 422);
            }

            if (!$juntada->getAtivo()) {
                throw new Exception('desentranhada', 422);
            }

            $componenteDigital = $this->getResource()->getRepository()->findFirstByJuntadaIdAndProcessoId(
                $juntada->getId()
            );
            if ($componenteDigital) {
                $id = $componenteDigital->getId();
            } else {
                throw new Exception('sem_componentes_digitais', 422);
            }

            try {
                $componenteDigitalEntity = $this->getResource()->download(
                    $id,
                    $transactionId,
                    true,
                    false,
                    null,
                    true,
                    false
                );
            } catch (Throwable) {
                throw new Exception('acesso_negado', 422);
            }

            $this->transactionManager->commit();

            // Fetch data from database
            return $this
                ->getResponseHandler()
                ->createResponse($request, $componenteDigitalEntity);
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception, $id);
        }
    }

    /**
     * Endpoint action para localizar um componente digital no elasticsearch.
     *
     * @Route(
     *      path="/search",
     *      methods={"GET"},
     *  )
     *
     * @Security("is_granted('ROLE_USER')")
     *
     * @RestApiDoc()
     *
     * @throws Throwable
     */
    public function searchAction(Request $request, ?array $allowedHttpMethods = null): Response
    {
        $allowedHttpMethods ??= ['GET'];

        // Make sure that we have everything we need to make this work
        $this->validateRestMethod($request, $allowedHttpMethods);

        // Determine used parameters
        $orderBy = RequestHandler::getOrderBy($request);
        $limit = RequestHandler::getLimit($request);
        $offset = RequestHandler::getOffset($request);
        $populate = RequestHandler::getPopulate($request, $this->getResource());

        try {
            $criteria = RequestHandler::getCriteria($request);

            $this->elasticQueryBuilderService->init(
                'componente_digital'
            );

            $boolQuery = $this->elasticQueryBuilderService->proccessCriteria($criteria);

            $search = $this->componenteDigitalIndex->createSearch()->addQuery($boolQuery);

            if ($orderBy) {
                foreach ($orderBy as $key => $value) {
                    if ($key && $value) {
                        $search->addSort(
                            new FieldSort(
                                $this->elasticQueryBuilderService->processaProperty($key),
                                null,
                                ['order' => $value]
                            )
                        );
                    }
                }
            }

            if (!count($search->getSorts())) {
                $search->addSort(new FieldSort('criado_em', null, ['order' => 'desc']));
            }
            $search->setSize($limit);
            $search->setFrom($offset);
            $search->setTrackTotalHits(true);
            $search->setSource(false);

            $highlight = new Highlight();
            $highlight->addField(
                'attachment.content',
                [
                    'fragment_size' => 1_000,
                    'number_of_fragments' => 1,
                ],
            );
            $highlight->setTags(['<span style="color: red;">'], ['</span>']);

            $search->addHighlight($highlight);

            $results = $this->componenteDigitalIndex->findRaw($search);
            $result = [];
            $result['entities'] = [];

            foreach ($results as $document) {
                $entity = $this->getResource()->getRepository()->find((int) $document['_id'], $populate);
                if ($entity) {
                    if (isset($document['highlight'])) {
                        $entity->setHighlights(
                            $document['highlight']['attachment.content'][0]
                        );
                    }
                    $result['entities'][] = $entity;
                }
            }

            $result['total'] = $results->count();

            return $this
                ->getResponseHandler()
                ->createResponse(
                    $request,
                    $result
                );
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception);
        }
    }

    /**
     * Endpoint action to revert hash componente digital.
     *
     * @Route(
     *      "/{id}/reverter",
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
    public function reverterAction(
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

            $data = $this
                ->getResource()
                ->reverter(
                    $id,
                    $this->processFormMapper($request, self::METHOD_PATCH, $id),
                    $transactionId,
                    true
                );

            $this->transactionManager->commit($transactionId);

            return $this->getResponseHandler()->createResponse($request, $data);
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception, $id);
        }
    }

    /**
     * Endpoint action to approve pedido.
     *
     * @Route(
     *      "/aprovar",
     *      methods={"POST"},
     *  )
     *
     * @Security("is_granted('ROLE_COLABORADOR')")
     *
     * @RestApiDoc()
     *
     * @param string[]|null $allowedHttpMethods
     *
     * @throws Throwable
     */
    public function aprovarAction(
        Request $request,
        ?array $allowedHttpMethods = null
    ): Response {
        $allowedHttpMethods ??= ['POST'];

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

            $componenteDigitalDTO = new ComponenteDigitalDTO();
            $documentoEntity = $this->documentoResource->findOne($request->get('documentoOrigem'));
            $componenteDigitalDTO->setDocumentoOrigem($documentoEntity);

            $data = $this
                ->getResource()
                ->aprovar($componenteDigitalDTO, $transactionId, true);

            $this->transactionManager->commit($transactionId);

            return $this
                ->getResponseHandler()
                ->createResponse($request, $data, Response::HTTP_CREATED);
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception);
        }
    }

    /**
     * Endpoint action to convertToPdf.
     *
     * @Route(
     *      "/{id}/convertToPdf",
     *      requirements={
     *          "id" = "\d+",
     *      },
     *      methods={"PATCH"},
     *  )
     *
     * @RestApiDoc()
     *
     * @Security("is_granted('ROLE_USER')")
     *
     * @param string[]|null $allowedHttpMethods
     *
     * @throws LogicException
     * @throws Throwable
     * @throws HttpException
     * @throws MethodNotAllowedHttpException
     */
    public function convertToPdfAction(
        Request $request,
        int $id,
        ?array $allowedHttpMethods = null
    ): Response {
        $allowedHttpMethods ??= ['PATCH'];

        // Make sure that we have everything we need to make this work
        $this->validateRestMethod($request, $allowedHttpMethods);

        try {
            //To use and save on the database
            $transactionId = $this->transactionManager->begin();

            $context = RequestHandler::getContext($request);

            foreach ($context as $name => $value) {
                $this->transactionManager->addContext(
                    new Context($name, $value),
                    $transactionId
                );
            }

            $data = $this
                ->getResource()
                ->convertPDF($id, $transactionId, true);

            //Commit changes in the database
            $this->transactionManager->commit($transactionId);

            return $this
                ->getResponseHandler()
                ->createResponse($request, $data, Response::HTTP_OK);
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception, $id);
        }
    }

    /**
     * Endpoint action to convertToHtml.
     *
     * @Route(
     *      "/{id}/convertToHtml",
     *      requirements={
     *          "id" = "\d+",
     *      },
     *      methods={"PATCH"},
     *  )
     *
     * @RestApiDoc()
     *
     * @Security("is_granted('ROLE_USER')")
     *
     * @param string[]|null $allowedHttpMethods
     *
     * @throws LogicException
     * @throws Throwable
     * @throws HttpException
     * @throws MethodNotAllowedHttpException
     */
    public function convertToHtmlAction(
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

            $data = $this
                ->getResource()
                ->convertPdfInternoToHTML($id, $transactionId, true);
            $this->transactionManager->commit($transactionId);

            return $this
                ->getResponseHandler()
                ->createResponse($request, $data, Response::HTTP_OK);
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception, $id);
        }
    }

    /**
     * Endpoint action to download.
     *
     * @Route("/{id}/download_p7s",
     *      requirements={
     *          "id" = "\d+"
     *      },
     *      methods={"GET"}
     *  )
     *
     * @RestApiDoc()
     *
     * @Security("is_granted('ROLE_USER')")
     *
     * @param string[]|null $allowedHttpMethods
     *
     * @return Response
     *
     * @throws Throwable
     */
    public function downloadP7sAction(Request $request, int $id, ?array $allowedHttpMethods = null)
    {
        $allowedHttpMethods ??= ['GET'];
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

            $componenteDigitalDTO = $this->getResource()->downloadP7s($id, $transactionId);

            $this->transactionManager->commit();

            return $this->getResponseHandler()
                ->createResponse($request, $componenteDigitalDTO);
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception, $id);
        }
    }

    /**
     * Endpoint action to download a rendered content.
     *
     * @Route("/render_html_content",
     *      methods={"POST"}
     *  )
     *
     * @RestApiDoc()
     *
     * @Security("is_granted('ROLE_USER')")
     *
     * @param string[]|null $allowedHttpMethods
     *
     * @return Response
     *
     * @throws Throwable
     */
    public function renderHtmlContent(Request $request, ?array $allowedHttpMethods = null): Response
    {
        $allowedHttpMethods ??= ['POST'];
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
            $componenteDigitalEntity = $this->getResource()
                ->renderHtmlContent($request->get('conteudo'), $request->get('fileName'), $transactionId);

            $this->transactionManager->commit();

            return $this->getResponseHandler()
                ->createResponse($request, $componenteDigitalEntity);
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception);
        }
    }

    /**
     * Endpoint action to compares a html content with content of the digital component.
     *
     * @Route("/{id}/compara_component_digital_com_html",
     *      requirements={
     *          "id" = "\d+"
     *      },
     *      methods={"POST"}
     *  )
     * @RestApiDoc()
     * @Security("is_granted('ROLE_USER')")
     * @param Request $request
     * @param int $id
     * @param Environment $twig
     * @param array|null $allowedHttpMethods
     * @return Response
     * @throws Throwable
     */
    public function comparaComponenteDigitalComHtml(
        Request $request,
        int $id,
        Environment $twig,
        ?array $allowedHttpMethods = null
    ): Response
    {
        $allowedHttpMethods ??= ['POST'];
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

            $asPdf = false;
            $asXls = false;

            if (isset($context['asPdf']) && (true === $context['asPdf'])) {
                $asPdf = true;
            }

            if (isset($context['asXls']) && (true === $context['asXls'])) {
                $asXls = true;
            }

            $versao = null;

            if (isset($context['versao'])) {
                $versao = $context['versao'];
            }

            $componenteDigitalEntity = $this->getResource()->download(
                $id,
                $transactionId,
                true,
                $asPdf,
                $versao,
                true,
                $asXls
            );
            $componenteDigitalEntity2 = $this->getResource()
                ->renderHtmlContent($request->get('conteudo'), $componenteDigitalEntity->getFileName(), $transactionId);
            $conteudo1 = $componenteDigitalEntity2->getConteudo();
            $conteudo2 = $componenteDigitalEntity->getConteudo();

            $usuarioAlteracao = [];
            $usuarioAlteracao['nome'] = $request->get('usuario');
            $usuarioAlteracao['criadoEm'] = new \DateTime($request->get('data'));

            preg_match("/<body[^>]*>(.*?)<\/body>/is", $conteudo1, $matches1);
            preg_match("/<body[^>]*>(.*?)<\/body>/is", $conteudo2, $matches2);

            $conteudoHTML = $twig->render(
                'Resources/Ckeditor/comparar/compararVersoes.html.twig',
                [
                    'versao1' => strip_tags($matches1[1]),
                    'versao2' => strip_tags($matches2[1]),
                    'tipoDocumento' => $componenteDigitalEntity->getDocumento()->getTipoDocumento()->getNome(),
                    'usuarioAlteracao' => $usuarioAlteracao,
                ]
            );

            $componenteDigitalEntity->setConteudo($conteudoHTML);
            $componenteDigitalEntity->setAllowUnsafe(true);

            $this->transactionManager->commit();

            return $this->getResponseHandler()
                ->createResponse($request, $componenteDigitalEntity);
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception);
        }
    }
}
