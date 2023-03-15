<?php

declare(strict_types=1);
/**
 * /src/Rest/Traits/Actions/Anon/DeleteAction.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Rest\Traits\Actions\Anon;

use LogicException;
use SuppCore\AdministrativoBackend\Annotation\RestApiDoc;
use SuppCore\AdministrativoBackend\Rest\Traits\Methods\DeleteMethod;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

/**
 * Trait DeleteAction.
 *
 * Trait to add 'deleteAction' for REST controllers for anonymous users.
 *
 * @see \SuppCore\AdministrativoBackend\Rest\Traits\Methods\DeleteMethod for detailed documents.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
trait DeleteAction
{
    // Traits
    use DeleteMethod;

    /**
     * @Route(
     *      "/{id}",
     *      requirements={
     *          "id" = "\d+",
     *      },
     *      methods={"DELETE"},
     *  )
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
    public function deleteAction(Request $request, int $id): Response
    {
        return $this->deleteMethod($request, $id);
    }
}
