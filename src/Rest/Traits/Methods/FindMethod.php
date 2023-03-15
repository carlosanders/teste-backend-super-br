<?php

declare(strict_types=1);
/**
 * /src/Rest/Traits/Methods/FindMethod.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Rest\Traits\Methods;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\PsrCachedReader;
use LogicException;
use ReflectionClass;
use SuppCore\AdministrativoBackend\Doctrine\ORM\Enableable\Enableable;
use SuppCore\AdministrativoBackend\Rest\RequestHandler;
use SuppCore\AdministrativoBackend\Transaction\Context;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Throwable;

/**
 * Trait FindMethod.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
trait FindMethod
{
    // Traits
    use AbstractGenericMethods;

    /**
     * Generic 'findMethod' method for REST resources.
     *
     * @param string[]|null $allowedHttpMethods
     *
     * @throws LogicException
     * @throws Throwable
     * @throws HttpException
     * @throws MethodNotAllowedHttpException
     */
    public function findMethod(Request $request, ?array $allowedHttpMethods = null): Response
    {
        $allowedHttpMethods ??= ['GET'];

        // Make sure that we have everything we need to make this work
        $this->validateRestMethod($request, $allowedHttpMethods);

        // Determine used parameters
        $orderBy = RequestHandler::getOrderBy($request);
        $limit = RequestHandler::getLimit($request);
        $offset = RequestHandler::getOffset($request);
        $search = RequestHandler::getSearchTerms($request);
        $populate = RequestHandler::getPopulate($request, $this->getResource());
        $context = RequestHandler::getContext($request);

        try {
            // Fetch data from database
            $criteria = RequestHandler::getCriteria($request);
            $this->processCriteria($criteria);

            $entityClass = $this->getResource()->getRepository()->getEntityName();
            $reader = new PsrCachedReader(
                new AnnotationReader(),
                $this->appCache,
                $this->parameterBag->get('kernel.debug')
            );
            $reflectionClass = new ReflectionClass($entityClass);

            if ((false === isset($context['isAdmin'])) || (true !== $context['isAdmin'])) {
                foreach ($reader->getClassAnnotations($reflectionClass) as $classAnnotation) {
                    if ($classAnnotation instanceof Enableable) {
                        $criteria['ativo'] = 'eq:true';
                    }
                    if ('SuppCore\AdministrativoBackend\Entity\Usuario' === $entityClass) {
                        $criteria['enabled'] = 'eq:true';
                    }
                }
            }

            $dtoClass = $this->getResource()->getDtoClass();
            $reflectionClassDTO = new ReflectionClass($dtoClass);

            $cacheableAnnotation = $reader->getClassAnnotation(
                $reflectionClassDTO,
                'SuppCore\AdministrativoBackend\Form\Annotations\Cacheable'
            );

            if ($cacheableAnnotation) {
                $redisClient = $this->getResource()->getRedisClient();
                if ($redisClient->hGet($dtoClass, $request->getRequestUri())) {
                    $response = unserialize($redisClient->hGet($dtoClass, $request->getRequestUri()));
                } else {
                    $response = $this->getResponseHandler()->createResponse(
                        $request,
                        $this->getResource()->find($criteria, $orderBy, $limit, $offset, $search, $populate)
                    );
                    $redisClient->hSet(
                        $dtoClass,
                        $request->getRequestUri(),
                        serialize($response)
                    );
                }
            } else {
                $transactionId = $this->transactionManager->begin();

                foreach ($context as $name => $value) {
                    $this->transactionManager->addContext(
                        new Context($name, $value),
                        $transactionId
                    );
                }

                $data = $this->getResource()->find($criteria, $orderBy, $limit, $offset, $search, $populate);

                $this->transactionManager->commit($transactionId);

                $response = $this
                    ->getResponseHandler()
                    ->createResponse(
                        $request,
                        $data
                    );
            }

            return $response;
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception);
        }
    }
}
