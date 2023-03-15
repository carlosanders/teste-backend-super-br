<?php

declare(strict_types=1);
/**
 * /src/Rest/Traits/Actions/Logged/UpdateAction.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Rest\Traits\Actions\Logged;

use LogicException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use SuppCore\AdministrativoBackend\Annotation\RestApiDoc;
use SuppCore\AdministrativoBackend\Rest\Traits\Methods\UpdateMethod;
use Symfony\Component\Form\Exception\AlreadySubmittedException;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\OptionsResolver\Exception\InvalidOptionsException;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;
use UnexpectedValueException;

/**
 * Trait UpdateAction.
 *
 * Trait to add 'updateAction' for REST controllers for 'ROLE_LOGGED' users.
 *
 * @see \SuppCore\AdministrativoBackend\Rest\Traits\Methods\UpdateMethod for detailed documents.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
trait UpdateAction
{
    // Traits
    use UpdateMethod;

    /**
     * @Route(
     *      "/{id}",
     *      requirements={
     *          "id" = "\d+",
     *      },
     *      methods={"PUT"},
     *  )
     *
     * @Security("is_granted('ROLE_LOGGED')")
     *
     * @RestApiDoc()
     *
     * @param Request              $request
     * @param FormFactoryInterface $formFactory
     * @param int                  $id
     *
     * @return Response
     *
     * @throws LogicException
     * @throws UnexpectedValueException
     * @throws Throwable
     * @throws \Symfony\Component\Form\Exception\LogicException
     * @throws AlreadySubmittedException
     * @throws HttpException
     * @throws NotFoundHttpException
     * @throws MethodNotAllowedHttpException
     * @throws InvalidOptionsException
     */
    public function updateAction(Request $request, FormFactoryInterface $formFactory, int $id): Response
    {
        return $this->updateMethod($request, $formFactory, $id);
    }
}
