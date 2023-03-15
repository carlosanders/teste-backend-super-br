<?php

declare(strict_types=1);
/**
 * /src/Rest/Describer/Security.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Rest\Describer;

use OpenApi\Annotations as OA;
use function array_filter;
use function array_values;
use function count;
use InvalidArgumentException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as SecurityAnnotation;
use SuppCore\AdministrativoBackend\Rest\Doc\RouteModel;

/**
 * Class Security.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Security
{
    private Responses $responses;

    /**
     * ApiDocDescriberRestSecurity constructor.
     *
     * @param Responses $responses
     */
    public function __construct(Responses $responses)
    {
        $this->responses = $responses;
    }

    /**
     * Method to process rest action '@Security' annotation. If this annotation is present we need to following things:
     *  1) Add 'Authorization' header parameter
     *  2) Add 401 response
     *  2) Add 403 response.
     *
     * @param OA\Operation  $operation
     * @param RouteModel $routeModel
     *
     * @throws InvalidArgumentException
     */
    public function process(OA\Operation $operation, RouteModel $routeModel): void
    {
        $filter = fn ($annotation): bool => $annotation instanceof SecurityAnnotation;

        if (1 === count(array_values(array_filter($routeModel->getMethodAnnotations(), $filter)))) {

            // Add Authorization
            $operation->security = [
                [
                    'Bearer' => []
                ]
            ];

            // Attach 401 and 403 responses
            $this->responses->add401($operation);
            $this->responses->add403($operation);
        }
    }
}
