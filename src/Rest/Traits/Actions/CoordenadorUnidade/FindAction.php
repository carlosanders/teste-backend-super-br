<?php

declare(strict_types=1);

namespace SuppCore\AdministrativoBackend\Rest\Traits\Actions\CoordenadorUnidade;

use LogicException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use SuppCore\AdministrativoBackend\Annotation\RestApiDoc;
use SuppCore\AdministrativoBackend\Rest\Traits\Methods\FindMethod;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

/**
 * Trait FindAction.
 *
 * Trait to add 'findAction' for REST controllers for 'ROLE_COORDENADOR_UNIDADE' users.
 *
 * @see \SuppCore\AdministrativoBackend\Rest\Traits\Methods\FindMethod for detailed documents.
 *
 * @author Felipe Pena <felipe.pena@datainfo.inf.br>
 */
trait FindAction
{
    // Traits
    use FindMethod;

    /**
     * @Route(
     *     path="",
     *     methods={"GET"},
     *  )
     *
     * @Security("is_granted('ROLE_COORDENADOR_UNIDADE')")
     *
     * @RestApiDoc()
     *
     * @param Request $request
     *
     * @return Response
     *
     * @throws LogicException
     * @throws Throwable
     * @throws HttpException
     * @throws MethodNotAllowedHttpException
     */
    public function findAction(Request $request): Response
    {
        return $this->findMethod($request);
    }
}
