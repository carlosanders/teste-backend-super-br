<?php

declare(strict_types=1);

namespace SuppCore\AdministrativoBackend\Rest\Traits\Actions\CoordenadorOrgaoCentral;

use LogicException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use SuppCore\AdministrativoBackend\Annotation\RestApiDoc;
use SuppCore\AdministrativoBackend\Rest\Traits\Methods\CreateMethod;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\OptionsResolver\Exception\InvalidOptionsException;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;
use UnexpectedValueException;

/**
 * Trait CreateAction.
 *
 * Trait to add 'createAction' for REST controllers for 'ROLE_COORDENADOR_ORGAO_CENTRAL' users.
 *
 * @see \SuppCore\AdministrativoBackend\Rest\Traits\Methods\CreateMethod for detailed documents.
 *
 * @author Felipe Pena <felipe.pena@datainfo.inf.br>
 */
trait CreateAction
{
    // Traits
    use CreateMethod;

    /**
     * @Route(
     *     path="",
     *     methods={"POST"},
     *  )
     *
     * @Security("is_granted('ROLE_COORDENADOR_ORGAO_CENTRAL')")
     *
     * @RestApiDoc()
     *
     * @param Request              $request
     * @param FormFactoryInterface $formFactory
     *
     * @return Response
     *
     * @throws LogicException
     * @throws UnexpectedValueException
     * @throws Throwable
     * @throws HttpException
     * @throws MethodNotAllowedHttpException
     * @throws InvalidOptionsException
     */
    public function createAction(Request $request, FormFactoryInterface $formFactory): Response
    {
        return $this->createMethod($request, $formFactory);
    }
}
