<?php

declare(strict_types=1);
/**
 * /src/Controller/RepositorioController.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Controller;

use Knp\Component\Pager\PaginatorInterface;
use ONGR\ElasticsearchBundle\Service\IndexService;
use ONGR\ElasticsearchDSL\Highlight\Highlight;
use ONGR\ElasticsearchDSL\Query\Compound\BoolQuery;
use ONGR\ElasticsearchDSL\Query\TermLevel\ExistsQuery;
use ONGR\ElasticsearchDSL\Sort\FieldSort;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use SuppCore\AdministrativoBackend\Annotation\RestApiDoc;
use SuppCore\AdministrativoBackend\Api\V1\Resource\RepositorioResource;
use SuppCore\AdministrativoBackend\Elastic\ElasticQueryBuilderService;
use SuppCore\AdministrativoBackend\Elastic\ScriptScoreQuery;
use SuppCore\AdministrativoBackend\Entity\Repositorio;
use SuppCore\AdministrativoBackend\Rest\Controller;
use SuppCore\AdministrativoBackend\Rest\RequestHandler;
use SuppCore\AdministrativoBackend\Rest\ResponseHandler;
use SuppCore\AdministrativoBackend\Rest\Traits\Actions;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

/**
 * @Route(path="/v1/administrativo/repositorio")
 *
 * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
 *
 * @OA\Tag(name="Repositorio")
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @method RepositorioResource getResource()
 */
class RepositorioController extends Controller
{
    // Traits
    use Actions\Colaborador\FindOneAction;
    use Actions\Colaborador\FindAction;
    use Actions\Colaborador\CreateAction;
    use Actions\Colaborador\UpdateAction;
    use Actions\Colaborador\PatchAction;
    use Actions\Colaborador\DeleteAction;
    use Actions\Colaborador\CountAction;

    private IndexService $repositorioIndex;

    private ElasticQueryBuilderService $elasticQueryBuilderService;

    private PaginatorInterface $paginator;

    /**
     * RepositorioController constructor.
     */
    public function __construct(
        RepositorioResource $resource,
        ResponseHandler $responseHandler,
        IndexService $repositorioIndex,
        ElasticQueryBuilderService $elasticQueryBuilderService,
        PaginatorInterface $paginator
    ) {
        $this->init($resource, $responseHandler);
        $this->repositorioIndex = $repositorioIndex;
        $this->elasticQueryBuilderService = $elasticQueryBuilderService;
        $this->paginator = $paginator;
    }

    /**
     * Endpoint action para localizar uma repositorio no elasticsearch.
     *
     * @Route(
     *      path="/search",
     *      methods={"GET"},
     *  )
     *
     * @Security("is_granted('ROLE_COLABORADOR')")
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
        $context = RequestHandler::getContext($request);

        try {
            $criteria = RequestHandler::getCriteria($request);

            if ((false === isset($context['isAdmin'])) || (true !== $context['isAdmin'])) {
                $criteria['ativo'] = 'eq:true';
            }

            $this->elasticQueryBuilderService->init(
                'repositorio'
            );

            $boolQuery = $this->elasticQueryBuilderService->proccessCriteria($criteria);

            if ($this->elasticQueryBuilderService->getDenseVector()) {
                $boolQuery->add(new ExistsQuery('dense_vector'), BoolQuery::MUST);
                $scriptScoreQuery = new ScriptScoreQuery(
                    $boolQuery,
                    [
                        'source' => "cosineSimilarity(params.dense_vector, doc['dense_vector']) + 1.0",
                        'params' => [
                            'dense_vector' => $this->elasticQueryBuilderService->getDenseVector(),
                        ],
                    ]
                );
                $search = $this->repositorioIndex->createSearch()->addQuery($scriptScoreQuery);
            } else {
                $search = $this->repositorioIndex->createSearch()->addQuery($boolQuery);
            }

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
                    'max_analyzer_offset' => 100000
                ],
            );
            $highlight->setTags(['<span style="color: red;">'], ['</span>']);

            $search->addHighlight($highlight);

            $results = $this->repositorioIndex->findRaw($search);
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
}
