<?php

declare(strict_types=1);
/**
 * /src/Rest/Traits/Actions/Anon/CreateAction.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Rest\Traits\Actions\Anon;

use LogicException;
use SuppCore\AdministrativoBackend\Annotation\RestApiDoc;
use SuppCore\AdministrativoBackend\Rest\Traits\Methods\CreateMethod;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\OptionsResolver\Exception\InvalidOptionsException;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;
use Exception;
use UnexpectedValueException;

/**
 * Trait CreateAction.
 *
 * Trait to add 'createAction' for REST controllers for anonymous users.
 *
 * @see \SuppCore\AdministrativoBackend\Rest\Traits\Methods\CreateMethod for detailed documents.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
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
    public function createAction(Request $request, FormFactoryInterface $formFactory, ParameterBagInterface $parameterBag): Response
    {
        if($request->getPathInfo() == '/v1/administrativo/usuario' && 
            !$parameterBag->get('supp_core.administrativo_backend.login_interno_ativo')){
                
            throw new Exception('Cadastro direto na base interna de usuários desativado');
        }
        return $this->createMethod($request, $formFactory);
    }
}
