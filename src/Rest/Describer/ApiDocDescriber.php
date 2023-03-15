<?php

declare(strict_types=1);
/**
 * /src/Rest/Describer/ApiDocDescriber.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Rest\Describer;

use function array_filter;
use function array_map;
use function array_values;
use Closure;
use function count;
use Doctrine\Common\Annotations\AnnotationReader;
use function explode;
use function mb_strrpos;
use Nelmio\ApiDocBundle\Describer\DescriberInterface;
use Nelmio\ApiDocBundle\Describer\ModelRegistryAwareInterface;
use Nelmio\ApiDocBundle\Describer\ModelRegistryAwareTrait;
use Nelmio\ApiDocBundle\Model\Model;
use Nelmio\ApiDocBundle\OpenApiPhp\Util;
use OpenApi\Annotations as OA;
use OpenApi\Annotations\OpenApi;
use OpenApi\Generator as OAGenerator;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;
use SuppCore\AdministrativoBackend\Annotation\RestApiDoc;
use SuppCore\AdministrativoBackend\Rest\Doc\RouteModel;
use SuppCore\AdministrativoBackend\Rules\RulesManager;
use SuppCore\AdministrativoBackend\Triggers\TriggersManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\PropertyInfo\Type;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Contracts\Cache\CacheInterface;

/**
 * Class ApiDocDescriber.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class ApiDocDescriber implements DescriberInterface, ModelRegistryAwareInterface
{
    use ModelRegistryAwareTrait;
    private RouteCollection $routeCollection;
    private AnnotationReader $annotationReader;
    private array $rules;
    private array $triggers;
    private OpenApi $api;

    /**
     * @param ContainerInterface $container
     * @param RouterInterface    $router
     * @param Rest               $rest
     * @param RulesManager       $rulesManager
     * @param TriggersManager    $triggersManager
     */
    public function __construct(
        private ContainerInterface $container,
        private RouterInterface $router,
        private Rest $rest,
        private RulesManager $rulesManager,
        private TriggersManager $triggersManager
    ) {
    }

    /**
     * @param OpenApi $api
     *
     * @throws ReflectionException
     */
    public function describe(OpenApi $api): void
    {
        $this->annotationReader = new AnnotationReader();
        $this->routeCollection = $this->router->getRouteCollection();
        $this->rules = $this->rulesManager->getRules();
        $this->triggers = $this->triggersManager->getTriggersWrite();
        $this->api = $api;
        $apiPaths = [];
        foreach ($api->paths as $pathItem) {
            $apiPaths[$pathItem->path] = $pathItem;
        }

        /** @var RouteModel $routeModel * */
        foreach ($this->getRouteModels() as $routeModel) {
            if (!in_array($routeModel->getRoute()->getPath(), array_keys($apiPaths))) {
                continue;
            }

            /** @var OA\PathItem $path */
            $path = $apiPaths[$routeModel->getRoute()->getPath()];

            $operation = Util::getOperation($path, $routeModel->getHttpMethod());

            if ($operation) {
                $this->rest->createDocs($operation, $routeModel);

                $controller = $this->container->get($routeModel->getController());
                if (isset($controller->noResource) || !$controller->getResource()->getDtoClass()) {
                    continue;
                }
                if ('put' === $routeModel->getHttpMethod() ||
                    'post' === $routeModel->getHttpMethod() ||
                    'delete' === $routeModel->getHttpMethod()) {
                    $desc = $this->retornaDocRules(
                        $controller->getResource()->getDtoClass(),
                        $routeModel->getHttpMethod()
                    );
                    $desc .= $this->retornaDocTriggers(
                        $controller->getResource()->getDtoClass(),
                        $routeModel->getHttpMethod()
                    );

                    $operation->description = $desc;
                }
                $code = 200;
                if ('post' === $routeModel->getHttpMethod()) {
                    $code = 201;
                }

                if (OAGenerator::UNDEFINED === $operation->responses) {
                    continue;
                }

                foreach ($operation->responses as $response) {
                    if ($response->response === $code) {
                        $response->ref = $this->modelRegistry->register(
                            new Model(
                                new Type(
                                    Type::BUILTIN_TYPE_OBJECT,
                                    false,
                                    $controller->getResource()->getDtoClass()
                                )
                            )
                        );
                    }
                }
            }
        }
    }

    /**
     * @param string $classe
     * @param string $operation
     *
     * @return string
     *
     * @throws ReflectionException
     */
    private function retornaDocRules(string $classe, string $operation): string
    {
        $fluxo = false;
        $retorno = '<b>RULES:</b>';
        foreach ($this->rules as $rules) {
            foreach ($rules as $rule) {
                if (array_key_exists($classe, $rule->supports())) {
                    foreach ($rule->supports() as $op) {
                        if ('post' === $operation && (in_array('beforeCreate', $op) || in_array('afterCreate', $op))) {
                            $retorno = $retorno.'<p>'.$this->retornaDocSwagger($rule).'</p>';
                            $fluxo = true;
                        }
                        if ('put' === $operation && (in_array('beforeUpdate', $op) || in_array('afterUpdate', $op))) {
                            $retorno = $retorno.'<p>'.$this->retornaDocSwagger($rule).'</p>';
                            $fluxo = true;
                        }
                        if ('patch' === $operation && (in_array('beforePatch', $op) || in_array('afterPatch', $op))) {
                            $retorno = $retorno.'<p>'.$this->retornaDocSwagger($rule).'</p>';
                            $fluxo = true;
                        }
                        if ('delete' === $operation && (in_array('beforeDelete', $op) || in_array('afterDelete', $op))) {
                            $retorno = $retorno.'<p>'.$this->retornaDocSwagger($rule).'</p>';
                            $fluxo = true;
                        }
                    }
                }
            }
        }
        if ($fluxo) {
            return $retorno;
        } else {
            return '';
        }
    }

    /**
     * @param $classe
     *
     * @return string
     *
     * @throws ReflectionException
     */
    private function retornaDocSwagger($classe)
    {
        $descSwagger = false;
        $classeSwagger = false;
        $reflectionClass = new ReflectionClass(current(class_parents($classe)));

        $comment_string = $reflectionClass->getDocComment();
        $pattern = '/((@descSwagger)|(@classeSwagger)).*/';
        $tags = [];
        preg_match_all($pattern, $comment_string, $tags);

        foreach ($tags[0] as $tag) {
            $swagger = explode('=', $tag);
            if ('@descSwagger' === trim($swagger[0])) {
                $descSwagger = trim($swagger[1]);
            }
            if ('@classeSwagger' === trim($swagger[0])) {
                $classeSwagger = trim($swagger[1]);
            }
        }

        if (!$descSwagger) {
            $descSwagger = 'Não retornou a descrição';
        }
        if (!$classeSwagger) {
            $classeSwagger = 'Não retornou a classe';
        }

        return $classeSwagger.': '.$descSwagger;
    }

    /**
     * @param string $classe
     * @param string $operation
     *
     * @return string
     *
     * @throws ReflectionException
     */
    private function retornaDocTriggers(string $classe, string $operation): string
    {
        $fluxo = false;
        $retorno = '<b>TRIGGERS:</b>';
        foreach ($this->triggers as $triggers) {
            foreach ($triggers as $trigger) {
                if (array_key_exists($classe, $trigger->supports())) {
                    foreach ($trigger->supports() as $op) {
                        if ('post' === $operation && (in_array('beforeCreate', $op) ||
                                in_array('afterCreate', $op))) {
                            $retorno = $retorno.'<p>'.$this->retornaDocSwagger($trigger).'</p>';
                            $fluxo = true;
                        }
                        if ('put' === $operation && (in_array('beforeUpdate', $op) ||
                                in_array('afterUpdate', $op))) {
                            $retorno = $retorno.'<p>'.$this->retornaDocSwagger($trigger).'</p>';
                            $fluxo = true;
                        }
                        if ('patch' === $operation && (in_array('beforePatch', $op) ||
                                in_array('afterPatch', $op))) {
                            $retorno = $retorno.'<p>'.$this->retornaDocSwagger($trigger).'</p>';
                            $fluxo = true;
                        }
                        if ('delete' === $operation && (in_array('beforeDelete', $op) ||
                                in_array('afterDelete', $op))) {
                            $retorno = $retorno.'<p>'.$this->retornaDocSwagger($trigger).'</p>';
                            $fluxo = true;
                        }
                    }
                }
            }
        }
        if ($fluxo) {
            return $retorno;
        } else {
            return '';
        }
    }

    /**
     * @return array
     *
     * @throws ReflectionException
     */
    private function getRouteModels(): array
    {
        $annotationFilterRoute = $this->getClosureAnnotationFilterRoute();

        $iterator = function (Route $route) use ($annotationFilterRoute): RouteModel {
            [$controller, $method] = explode(
                Constants::KEY_CONTROLLER_DELIMITER,
                $route->getDefault(Constants::KEY_CONTROLLER)
            );

            $reflection = new ReflectionMethod($controller, $method);
            $methodAnnotations = $this->annotationReader->getMethodAnnotations($reflection);
            $controllerAnnotations = $this->annotationReader->getClassAnnotations($reflection->getDeclaringClass());

            /** @var \Symfony\Component\Routing\Annotation\Route $routeAnnotation */
            $routeAnnotation = array_values(array_filter($controllerAnnotations, $annotationFilterRoute))[0];

            $routeModel = new RouteModel();
            $routeModel->setController($controller);
            $routeModel->setMethod($method);
            $routeModel->setHttpMethod(mb_strtolower($route->getMethods()[0], 'UTF8'));
            $routeModel->setBaseRoute($routeAnnotation->getPath());
            $routeModel->setRoute($route);
            $routeModel->setMethodAnnotations($methodAnnotations);
            $routeModel->setControllerAnnotations($controllerAnnotations);

            return $routeModel;
        };

        $filter = fn (Route $route): bool => $this->routeFilter($route);

        return array_map($iterator, array_filter($this->routeCollection->all(), $filter));
    }

    /**
     * @param Route $route
     *
     * @return bool
     *
     * @throws ReflectionException
     */
    private function routeFilter(Route $route): bool
    {
        $output = false;

        if (!$route->hasDefault(Constants::KEY_CONTROLLER)
            || mb_strrpos($route->getDefault(Constants::KEY_CONTROLLER), Constants::KEY_CONTROLLER_DELIMITER)
        ) {
            $output = true;
        }

        if ($output) {
            [$controller] = explode(Constants::KEY_CONTROLLER_DELIMITER, $route->getDefault(Constants::KEY_CONTROLLER));

            if (!class_exists($controller)) {
                return false;
            }

            $reflection = new ReflectionClass($controller);
            $annotations = $this->annotationReader->getClassAnnotations($reflection);

            $this->isRestApiDocDisabled($route, $annotations, $output);
        }

        return $this->routeFilterMethod($route, $output);
    }

    /**
     * @param Route   $route
     * @param mixed[] $annotations
     * @param bool    $disabled
     */
    private function isRestApiDocDisabled(Route $route, array $annotations, bool &$disabled): void
    {
        foreach ($annotations as $annotation) {
            if ($annotation instanceof RestApiDoc && $annotation->disabled) {
                $disabled = false;

                $this->api->getPaths()->remove($route->getPath());
            }
        }
    }

    /**
     * @param Route $route
     * @param bool  $output
     *
     * @return bool
     *
     * @throws ReflectionException
     */
    private function routeFilterMethod(Route $route, bool $output): bool
    {
        if ($output) {
            [$controller, $method] = explode(
                Constants::KEY_CONTROLLER_DELIMITER,
                $route->getDefault(Constants::KEY_CONTROLLER)
            );

            $reflection = new ReflectionMethod($controller, $method);
            $annotations = $this->annotationReader->getMethodAnnotations($reflection);
            $supported = [];

            array_map($this->isRouteSupported($supported), $annotations);

            $output = 1 === count($supported);
        }

        return $output;
    }

    /**
     * @param mixed[] $supported
     *
     * @return Closure
     */
    private function isRouteSupported(array &$supported): Closure
    {
        return function ($annotation) use (&$supported): void {
            if ($annotation instanceof RestApiDoc) {
                $supported[] = true;
            }
        };
    }

    /**
     * @return Closure
     */
    private function getClosureAnnotationFilterRoute(): Closure
    {
        /*
         * Simple filter lambda function to filter out all but Method class
         *
         * @param $annotation
         *
         * @return bool
         */
        return fn ($annotation): bool => $annotation instanceof \Symfony\Component\Routing\Annotation\Route;
    }
}
