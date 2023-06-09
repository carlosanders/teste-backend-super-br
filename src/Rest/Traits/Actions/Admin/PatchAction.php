<?php

declare(strict_types=1);
/**
 * /src/Rest/Traits/Actions/Admin/PatchAction.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Rest\Traits\Actions\Admin;

use LogicException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use SuppCore\AdministrativoBackend\Annotation\RestApiDoc;
use SuppCore\AdministrativoBackend\Rest\Traits\Methods\PatchMethod;
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
 * Trait PatchAction.
 *
 * Trait to add 'patchAction' for REST controllers for 'ROLE_ADMIN' users.
 *
 * @see \SuppCore\AdministrativoBackend\Rest\Traits\Methods\PatchMethod for detailed documents.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
trait PatchAction
{
    // Traits
    use PatchMethod;

    /**
     * @Route(
     *      "/{id}",
     *      requirements={
     *          "id" = "\d+",
     *      },
     *      methods={"PATCH"},
     *  )
     *
     * @Security("is_granted('ROLE_ADMIN')")
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
     * @throws InvalidOptionsException
     * @throws \Symfony\Component\Form\Exception\LogicException
     * @throws AlreadySubmittedException
     * @throws NotFoundHttpException
     * @throws MethodNotAllowedHttpException
     * @throws HttpException
     */
    public function patchAction(Request $request, FormFactoryInterface $formFactory, int $id): Response
    {
        return $this->patchMethod($request, $formFactory, $id);
    }
}
