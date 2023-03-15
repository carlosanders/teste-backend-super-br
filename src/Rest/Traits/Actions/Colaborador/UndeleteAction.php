<?php

declare(strict_types=1);
/**
 * /src/Rest/Traits/Actions/User/UndeleteAction.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Rest\Traits\Actions\Colaborador;

use LogicException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use SuppCore\AdministrativoBackend\Annotation\RestApiDoc;
use SuppCore\AdministrativoBackend\Rest\Traits\Methods\UndeleteMethod;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

/**
 * Trait UndeleteAction.
 *
 * Trait to add 'undeleteAction' for REST controllers for 'ROLE_COLABORADOR' users.
 *
 * @see \SuppCore\AdministrativoBackend\Rest\Traits\Methods\UndeleteMethod for detailed documents.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
trait UndeleteAction
{
    // Traits
    use UndeleteMethod;

    /**
     * @Route(
     *      "/{id}/undelete",
     *      requirements={
     *          "id" = "\d+",
     *      },
     *      methods={"PATCH"},
     *  )
     *
     * @Security("is_granted('ROLE_COLABORADOR') or is_granted('ROLE_ADMIN')")
     *
     * @RestApiDoc()
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     *
     * @throws LogicException
     * @throws Throwable
     * @throws HttpException
     * @throws MethodNotAllowedHttpException
     */
    public function undeleteAction(Request $request, int $id): Response
    {
        return $this->undeleteMethod($request, $id);
    }
}
