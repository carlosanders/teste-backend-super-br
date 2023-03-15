<?php

declare(strict_types=1);
/**
 * /src/Rest/Describer/Tags.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Rest\Describer;

use function array_filter;
use function array_values;
use function count;
use SuppCore\AdministrativoBackend\Rest\Doc\RouteModel;
use OpenApi\Annotations as OA;

/**
 * Class Tags.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Tags
{
    /**
     * Method to process operation 'tags'.
     *
     * @param OA\Operation  $operation
     * @param RouteModel $routeModel
     */
    public function process(OA\Operation $operation, RouteModel $routeModel): void
    {
        // Initialize main data array
        $data = [
            'tags' => [],
        ];

        $this->processTags($routeModel, $data);

        // Merge data to operation
        $operation->tags = $data['tags'];
    }

    /**
     * @param RouteModel $routeModel
     * @param mixed[]    $data
     */
    private function processTags(RouteModel $routeModel, array &$data): void
    {
        $filter = fn ($annotation): bool => $annotation instanceof OA\Tag;

        $annotations = array_values(array_filter($routeModel->getControllerAnnotations(), $filter));

        // If controller has 'OA\Tag' annotation we will use that as a tag
        if (1 === count($annotations)) {
            /** @var OA\Tag $annotation */
            $annotation = $annotations[0];

            $tagName = $annotation->name;

            $data['tags'][] = $tagName;
        }
    }
}
