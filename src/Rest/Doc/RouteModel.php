<?php

declare(strict_types=1);
/**
 * /src/Rest/Doc/RouteModel.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Rest\Doc;

use Symfony\Component\Routing\Route;

/**
 * Class RouteModel.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class RouteModel
{
    private string $controller;

    private string $method;

    private string $httpMethod;

    private string $baseRoute;

    private Route $route;

    /**
     * @var mixed[]
     */
    private array $methodAnnotations;

    /**
     * @var mixed[]
     */
    private array $controllerAnnotations;

    /**
     * @return string
     */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * @param string $controller
     *
     * @return RouteModel
     */
    public function setController(string $controller): self
    {
        $this->controller = $controller;

        return $this;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param string $method
     *
     * @return RouteModel
     */
    public function setMethod(string $method): self
    {
        $this->method = $method;

        return $this;
    }

    /**
     * @return string
     */
    public function getHttpMethod(): string
    {
        return $this->httpMethod;
    }

    /**
     * @param string $httpMethod
     *
     * @return RouteModel
     */
    public function setHttpMethod(string $httpMethod): self
    {
        $this->httpMethod = $httpMethod;

        return $this;
    }

    /**
     * @return string
     */
    public function getBaseRoute(): string
    {
        return $this->baseRoute;
    }

    /**
     * @param string $baseRoute
     *
     * @return RouteModel
     */
    public function setBaseRoute(string $baseRoute): self
    {
        $this->baseRoute = $baseRoute;

        return $this;
    }

    /**
     * @return Route
     */
    public function getRoute(): Route
    {
        return $this->route;
    }

    /**
     * @param Route $route
     *
     * @return RouteModel
     */
    public function setRoute(Route $route): self
    {
        $this->route = $route;

        return $this;
    }

    /**
     * @return mixed[]
     */
    public function getMethodAnnotations(): array
    {
        return $this->methodAnnotations;
    }

    /**
     * @param mixed[] $methodAnnotations
     *
     * @return RouteModel
     */
    public function setMethodAnnotations(array $methodAnnotations): self
    {
        $this->methodAnnotations = $methodAnnotations;

        return $this;
    }

    /**
     * @return mixed[]
     */
    public function getControllerAnnotations(): array
    {
        return $this->controllerAnnotations;
    }

    /**
     * @param mixed[] $controllerAnnotations
     *
     * @return RouteModel
     */
    public function setControllerAnnotations(array $controllerAnnotations): self
    {
        $this->controllerAnnotations = $controllerAnnotations;

        return $this;
    }
}
