<?php

declare(strict_types=1);
/**
 * /src/Rest/Traits/Methods/CountMethod.php.
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
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Throwable;

/**
 * Trait CountMethod.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
trait CountMethod
{
    // Traits
    use AbstractGenericMethods;

    /**
     * Generic 'countMethod' method for REST resources.
     *
     * @param Request       $request
     * @param string[]|null $allowedHttpMethods
     *
     * @return Response
     *
     * @throws LogicException
     * @throws Throwable
     * @throws HttpException
     * @throws MethodNotAllowedHttpException
     */
    public function countMethod(Request $request, ?array $allowedHttpMethods = null): Response
    {
        $allowedHttpMethods ??= ['GET'];

        // Make sure that we have everything we need to make this work
        $this->validateRestMethod($request, $allowedHttpMethods);

        // Determine used parameters
        $search = RequestHandler::getSearchTerms($request);

        try {
            $criteria = RequestHandler::getCriteria($request);
            $context = RequestHandler::getContext($request);

            if ((false === isset($context['isAdmin']) || (true !== $context['isAdmin']))) {
                $entityClass = $this->getResource()->getRepository()->getEntityName();
                $reader = new PsrCachedReader(
                    new AnnotationReader(),
                    $this->appCache,
                    $this->parameterBag->get('kernel.debug')
                );
                $reflectionClass = new ReflectionClass($entityClass);
                foreach ($reader->getClassAnnotations($reflectionClass) as $classAnnotation) {
                    if ($classAnnotation instanceof Enableable) {
                        $criteria['ativo'] = 'eq:true';
                    }
                }
            }

            $this->processCriteria($criteria);

            return $this
                ->getResponseHandler()
                ->createCountResponse($request, (string) $this->getResource()->count($criteria, $search));
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception);
        }
    }
}
