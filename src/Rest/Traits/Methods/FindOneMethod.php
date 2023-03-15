<?php

declare(strict_types=1);
/**
 * /src/Rest/Traits/Methods/FindOneMethod.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Rest\Traits\Methods;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\PsrCachedReader;
use LogicException;
use ReflectionClass;
use SuppCore\AdministrativoBackend\Rest\RequestHandler;
use SuppCore\AdministrativoBackend\Transaction\Context;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Throwable;

/**
 * Trait FindOneMethod.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
trait FindOneMethod
{
    // Traits
    use AbstractGenericMethods;

    /**
     * Generic 'findOneMethod' method for REST resources.
     *
     * @param Request       $request
     * @param int           $id
     * @param string[]|null $allowedHttpMethods
     *
     * @return Response
     *
     * @throws LogicException
     * @throws Throwable
     * @throws HttpException
     * @throws MethodNotAllowedHttpException
     */
    public function findOneMethod(Request $request, int $id, ?array $allowedHttpMethods = null): Response
    {
        $allowedHttpMethods ??= ['GET'];

        // Make sure that we have everything we need to make this work
        $this->validateRestMethod($request, $allowedHttpMethods);

        $populate = RequestHandler::getPopulate($request, $this->getResource());
        $context = RequestHandler::getContext($request);
        // sorting faz sentido para o populate
        $orderBy = RequestHandler::getOrderBy($request);
        try {
            // Fetch data from database
            $dtoClass = $this->getResource()->getDtoClass();
            $reader = new PsrCachedReader(
                new AnnotationReader(),
                $this->appCache,
                $this->parameterBag->get('kernel.debug')
            );
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
                        $this->getResource()->findOne($id, $populate, $context, $orderBy)
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

                $data = $this->getResource()->findOne($id, $populate, $context, $orderBy);

                $this->transactionManager->commit($transactionId);

                $response = $this
                    ->getResponseHandler()
                    ->createResponse($request, $data);
            }

            return $response;
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception, $id);
        }
    }
}
