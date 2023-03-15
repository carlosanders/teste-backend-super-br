<?php

declare(strict_types=1);
/**
 * /src/Rest/Describer/Summary.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Rest\Describer;

use Doctrine\Common\Annotations\AnnotationException;

use OpenApi\Annotations as OA;
use ReflectionClass;
use ReflectionException;
use SuppCore\AdministrativoBackend\Rest\Controller;
use SuppCore\AdministrativoBackend\Rest\Doc\RouteModel;
use SuppCore\AdministrativoBackend\Rules\RulesManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use function in_array;
use function sprintf;
use phpDocumentor\Reflection\DocBlockFactory;

/**
 * Class Summary.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Summary
{
    private ContainerInterface $container;

    private RulesManager $rulesManager;

    /**
     * Summary constructor.
     *
     * @param ContainerInterface $container
     * @param RulesManager       $rulesManager
     */
    public function __construct(ContainerInterface $container, RulesManager $rulesManager)
    {
        $this->container = $container;
        $this->rulesManager = $rulesManager;
    }

    /**
     * Method to process operation 'summary' information.
     *
     * @param OA\Operation $operation
     * @param RouteModel   $routeModel
     */
    public function process(OA\Operation $operation, RouteModel $routeModel): void
    {
        [$action, $summary] = $this->getDefaults($routeModel);

        if (in_array(
            $action,
            [Rest::COUNT_ACTION, Rest::FIND_ACTION, Rest::FIND_ONE_ACTION, Rest::IDS_ACTION],
            true
        )) {
            $this->processSummaryForRead($action, $summary);
        } elseif (in_array(
            $action,
            [Rest::CREATE_ACTION, Rest::DELETE_ACTION, Rest::PATCH_ACTION, Rest::UPDATE_ACTION],
            true
        )) {
            $this->processSummaryForWrite($action, $summary);
        }

        $this->processSummary($operation, $routeModel, $summary);
    }

    /**
     * @param OA\Operation $operation
     * @param RouteModel   $routeModel
     * @param string       $summary
     * @trows ReflectionException, AnnotationException
     */
    private function processSummary(OA\Operation $operation, RouteModel $routeModel, string $summary): void
    {
        if (!empty($summary) && $this->container->has($routeModel->getController())) {
            /** @var Controller $controller */
            $controller = $this->container->get($routeModel->getController());

            // pegando as Rules do controller em questao
            try {
                $rules = $this->getRulesEntity($controller);
            } catch (AnnotationException $e) {
            } catch (ReflectionException $e) {
            }

            if (!empty($rules)) {
                foreach ($rules as $key => $regra) {
                    if (!empty($regra['action'])) {
                        $methodsHttp = $this->verificaHttpMethod($regra['action']);

                        if (in_array($routeModel->getHttpMethod(), $methodsHttp)) {
                            $summary .= ' Regra: '.$regra['name'].' ';
                            $summary .= ' Descrição: '.$regra['description'].'. ';
                        }
                    }
                }
            }

            $operation->summary = sprintf(
                $summary,
                $controller->getResource()->getEntityName(),
                $routeModel->getBaseRoute()
            );
        }
    }

    /**
     * @param RouteModel $routeModel
     *
     * @return string[]
     */
    private function getDefaults(RouteModel $routeModel): array
    {
        $action = $routeModel->getMethod();
        $description = '';

        return [$action, $description];
    }

    /**
     * @param string $action
     * @param string $summary
     */
    private function processSummaryForRead(string $action, string &$summary): void
    {
        if (Rest::COUNT_ACTION === $action) {
            $summary = 'Endpoint action to get count of entities (%s) on this resource. Base route: "%s"';
        } elseif (Rest::FIND_ACTION === $action) {
            $summary = 'Endpoint action to fetch entities (%s) from this resource. Base route: "%s"';
        } elseif (Rest::FIND_ONE_ACTION === $action) {
            $summary = 'Endpoint action to fetch specified entity (%s) from this resource. Base route: "%s"';
        } elseif (Rest::IDS_ACTION === $action) {
            $summary = 'Endpoint action to fetch entities (%s) id values from this resource. Base route: "%s"';
        }
    }

    /**
     * @param string $action
     * @param string $summary
     */
    private function processSummaryForWrite(string $action, string &$summary): void
    {
        if (Rest::CREATE_ACTION === $action) {
            $summary = 'Endpoint action to create new entity (%s) to this resource. Base route: "%s"';
        } elseif (Rest::DELETE_ACTION === $action) {
            $summary = 'Endpoint action to delete specified entity (%s) from this resource. Base route: "%s"';
        } elseif (Rest::PATCH_ACTION === $action) {
            $summary = 'Endpoint action to create patch specified entity (%s) on this resource. Base route: "%s"';
        } elseif (Rest::UPDATE_ACTION === $action) {
            $summary = 'Endpoint action to create update specified entity (%s) on this resource. Base route: "%s"';
        }
    }

    /**
     * @param Controller $controller
     *
     * @return array|null
     *
     * @throws ReflectionException
     */
    public function getRulesEntity(Controller $controller): ?array
    {
        $rulesManager = $this->rulesManager->getRules();
        $entityRule = explode('\\', $controller->getResource()->getEntityName());
        $dataRule = null;

        foreach ($rulesManager[1] as $key => $rule) {
            // proxy init
            $class = current(class_parents($rule));
            if (!$class) {
                continue;
            }
            $entityClass = explode('\\', $class);
            if ($entityClass[3] == $entityRule[2]) {
                $reflectionClass = new ReflectionClass($class);

                $factory = DocBlockFactory::createInstance();
                $docblock = $factory->create($reflectionClass->getDocComment());

                if ($docblock->getSummary()) {
                    $dataRule[$entityClass[4]]['name'] = $docblock->getSummary();
                }

                if ($docblock->getDescription()) {
                    $dataRule[$entityClass[4]]['description'] = $docblock->getDescription()->render();
                }

                // pegando as triggers de execução da rule
                $actions = $rule->supports();
                $keyarray = array_keys($actions);

                foreach ($actions[$keyarray[0]] as $action) {
                    $dataRule[$entityClass[4]]['action'][] = $action;
                }
            }
        }

        return $dataRule;
    }

    /**
     * @param $triggers
     *
     * @return array|null
     */
    public function verificaHttpMethod($triggers): ?array
    {
        foreach ($triggers as $trigger) {
            if (strpos(strtolower($trigger), 'update')) {
                $actions[] = 'put';
                $actions[] = 'patch';
            }

            if (strpos(strtolower($trigger), 'insert')) {
                $actions[] = 'post';
            }

            if (strpos(strtolower($trigger), 'delete')) {
                $actions[] = 'delete';
            }

            if (strpos(strtolower($trigger), 'get')) {
                $actions[] = 'get';
            }

            if (empty($actions)) {
                $actions[] = 'patch';
            }
        }

        return $actions;
    }
}
