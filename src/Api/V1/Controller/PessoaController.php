<?php

declare(strict_types=1);
/**
 * /src/Controller/PessoaController.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Controller;

use ONGR\ElasticsearchBundle\Service\IndexService;
use ONGR\ElasticsearchDSL\Sort\FieldSort;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use SuppCore\AdministrativoBackend\Annotation\RestApiDoc;
use SuppCore\AdministrativoBackend\Api\V1\Resource\PessoaResource;
use SuppCore\AdministrativoBackend\Document\Pessoa;
use SuppCore\AdministrativoBackend\Elastic\ElasticQueryBuilderService;
use SuppCore\AdministrativoBackend\Rest\Controller;
use SuppCore\AdministrativoBackend\Rest\RequestHandler;
use SuppCore\AdministrativoBackend\Rest\ResponseHandler;
use SuppCore\AdministrativoBackend\Rest\Traits\Actions;
use OpenApi\Annotations as OA;
use SuppCore\AdministrativoBackend\Transaction\Context;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

/**
 * @Route(path="/v1/administrativo/pessoa")
 *
 * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
 *
 * @OA\Tag(name="Pessoa")
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @method PessoaResource getResource()
 */
class PessoaController extends Controller
{
    // Traits
    use Actions\User\FindOneAction;
    use Actions\User\FindAction;
    use Actions\Colaborador\CreateAction;
    use Actions\Colaborador\UpdateAction;
    use Actions\Colaborador\PatchAction;
    use Actions\Root\DeleteAction;
    use Actions\Colaborador\CountAction;

    private IndexService $pessoaIndex;
    private ElasticQueryBuilderService $elasticQueryBuilderService;

    /**
     * PessoaController constructor.
     */
    public function __construct(
        PessoaResource $resource,
        ResponseHandler $responseHandler,
        IndexService $pessoaIndex,
        ElasticQueryBuilderService $elasticQueryBuilderService
    ) {
        $this->init($resource, $responseHandler);
        $this->pessoaIndex = $pessoaIndex;
        $this->elasticQueryBuilderService = $elasticQueryBuilderService;
    }

    /**
     * Endpoint action para localizar uma pessoa no elasticsearch.
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
            $transactionId = $this->transactionManager->begin();
            $context = RequestHandler::getContext($request);
            foreach ($context as $name => $value) {
                $this->transactionManager->addContext(
                    new Context($name, $value),
                    $transactionId
                );
            }
            $criteria = RequestHandler::getCriteria($request);

            $this->elasticQueryBuilderService->init(
                'pessoa'
            );

            $boolQuery = $this->elasticQueryBuilderService->proccessCriteria($criteria);

            $search = $this->pessoaIndex->createSearch()->addQuery($boolQuery);
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
            $search->addSort(new FieldSort('pessoa_validada', null, ['order' => 'desc']));
            $search->addSort(new FieldSort('pessoa_conveniada', null, ['order' => 'desc']));
            $search->setSize($limit);
            $search->setFrom($offset);
            $search->setTrackTotalHits(true);
            $search->setSource(false);

            $results = $this->pessoaIndex->findRaw($search);

            $result = [];
            $result['entities'] = [];

            foreach ($results as $document) {
                $entity = $this->getResource()->getRepository()->find((int) $document['_id'], $populate);
                if ($entity) {
                    $result['entities'][] = $entity;
                }
            }

            $result['total'] = $results->count();

            // After callback method call
            $className = $this->getResource()->getRepository()->getEntityName();
            $this->getResource()->afterFind($className, $criteria, $orderBy, $limit, $offset, $populate, $result);
            $this->transactionManager->commit($transactionId);

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
