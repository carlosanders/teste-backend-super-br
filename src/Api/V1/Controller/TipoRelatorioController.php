<?php

declare(strict_types=1);
/**
 * /src/Controller/TipoRelatorioController.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Controller;

use LogicException;
use OpenApi\Annotations as OA;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use SuppCore\AdministrativoBackend\Annotation\RestApiDoc;
use SuppCore\AdministrativoBackend\Api\V1\Resource\TipoRelatorioResource;
use SuppCore\AdministrativoBackend\Repository\SetorRepository;
use SuppCore\AdministrativoBackend\Repository\UsuarioRepository;
use SuppCore\AdministrativoBackend\Rest\Controller;
use SuppCore\AdministrativoBackend\Rest\ResponseHandler;
use SuppCore\AdministrativoBackend\Rest\Traits\Actions;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Acl\Domain\Entry;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;
use Symfony\Component\Security\Acl\Domain\RoleSecurityIdentity;
use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
use Symfony\Component\Security\Acl\Model\AclProviderInterface;
use Symfony\Component\Security\Acl\Permission\MaskBuilder;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Throwable;

/**
 * @Route(path="/v1/administrativo/tipo_relatorio")
 *
 * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
 *
 * @OA\Tag(name="TipoRelatorio")
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @method TipoRelatorioResource getResource()
 */
class TipoRelatorioController extends Controller
{
    // Traits
    use Actions\Colaborador\FindOneAction;
    use Actions\Colaborador\FindAction;
    use Actions\Admin\CreateAction;
    use Actions\Admin\UpdateAction;
    use Actions\Admin\PatchAction;
    use Actions\Root\DeleteAction;
    use Actions\Admin\CountAction;

    /**
     * TipoRelatorioController constructor.
     */
    public function __construct(
        TipoRelatorioResource $resource,
        ResponseHandler $responseHandler
    ) {
        $this->init($resource, $responseHandler);
    }

    /**
     * Endpoint action to get visibilidade status.
     *
     * @Route(
     *      "/{id}/visibilidade",
     *      requirements={
     *          "id" = "\d+",
     *      },
     *      methods={"GET"},
     *  )
     *
     * @RestApiDoc()
     *
     * @Security("is_granted('ROLE_ADMIN')")
     *
     * @param string[]|null $allowedHttpMethods
     *
     * @throws LogicException
     * @throws Throwable
     * @throws HttpException
     * @throws MethodNotAllowedHttpException
     */
    public function getVisibilidadeAction(
        Request $request,
        int $id,
        SetorRepository $setorRepository,
        UsuarioRepository $usuarioRepository,
        AclProviderInterface $aclProvider,
        AuthorizationCheckerInterface $authorizationChecker,
        ?array $allowedHttpMethods = null
    ): Response {
        $allowedHttpMethods ??= ['GET'];

        // Make sure that we have everything we need to make this work
        $this->validateRestMethod($request, $allowedHttpMethods);

        $tipoRelatorio = $this->getResource()->getRepository()->find($id);

        if (!$authorizationChecker->isGranted('VIEW', $tipoRelatorio)) {
            throw new AccessDeniedException();
        }

        try {
            $result = [];

            $acl = $aclProvider->findAcl(ObjectIdentity::fromDomainObject($tipoRelatorio));

            /** @var Entry $ace */
            foreach ($acl->getObjectAces() as $ace) {
                $mask = new MaskBuilder($ace->getMask());
                $pattern = $mask->getPattern();
                $poderes = [];

                if (strpos($pattern, 'M') > 0) {
                    $poderes[] = 'ADMINISTRADOR';
                }

                if (strpos($pattern, 'C') > 0) {
                    $poderes[] = 'CRIAR';
                }

                if (strpos($pattern, 'E') > 0) {
                    $poderes[] = 'EDITAR';
                }

                if (strpos($pattern, 'V') > 0) {
                    $poderes[] = 'VER';
                }

                if (strpos($pattern, 'D') > 0) {
                    $poderes[] = 'APAGAR';
                }

                if (strpos($pattern, 'N') > 0) {
                    $poderes[] = 'ADMINISTRADOR';
                }

                if (0 !== $ace->getMask()) {
                    $roles = explode('_', $ace->getSecurityIdentity()->getRole());
                    $result[] = [
                        'id' => $ace->getId(),
                        'label' => 'ROLE_USER' === $ace->getSecurityIdentity()->getRole(
                        ) ? 'TODOS OS USUÁRIOS' : $ace->getSecurityIdentity()->getRole(),
                        'tipo' => 'PERFIL',
                        'poderes' => $poderes,
                        'valor' => $ace->getSecurityIdentity()->getRole(),
                    ];
                }
            }

            return new JsonResponse($result);
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception, $id);
        }
    }

    /**
     * Endpoint action to criar um direito de acesso sobre um tipoRelatorio.
     *
     * @Route(
     *      "/{id}/visibilidade",
     *      requirements={
     *          "id" = "\d+",
     *      },
     *      methods={"PUT"},
     *  )
     *
     * @Security("is_granted('ROLE_ADMIN')")
     *
     * @RestApiDoc()
     *
     * @param string[]|null $allowedHttpMethods
     *
     * @throws LogicException
     * @throws Throwable
     * @throws HttpException
     * @throws MethodNotAllowedHttpException
     */
    public function createVisibilidadeAction(
        Request $request,
        int $id,
        UsuarioRepository $usuarioRepository,
        AclProviderInterface $aclProvider,
        AuthorizationCheckerInterface $authorizationChecker,
        TokenStorageInterface $tokenStorage,
        ?array $allowedHttpMethods = null
    ): Response {
        $allowedHttpMethods ??= ['PUT'];

        // Make sure that we have everything we need to make this work
        $this->validateRestMethod($request, $allowedHttpMethods);

        $tipoRelatorio = $this->getResource()->getRepository()->find($id);

        if (!$authorizationChecker->isGranted('MASTER', $tipoRelatorio)) {
            throw new AccessDeniedException();
        }

        try {
            $objectIdentity = ObjectIdentity::fromDomainObject($tipoRelatorio);
            $aclObject = $aclProvider->findAcl($objectIdentity);

            foreach ($request->request->all() as $role) {
                $securityIdentity = new RoleSecurityIdentity($role);
                $aclObject->insertObjectAce($securityIdentity, MaskBuilder::MASK_OWNER);
                $aclProvider->updateAcl($aclObject);
            }

            return new JsonResponse(
                [
                    'success' => true,
                ]
            );
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception, $id);
        }
    }

    /**
     * Endpoint action to remover um direito de acesso sobre um tipoRelatorio.
     *
     * @Route(
     *      "/{tipoRelatorioId}/visibilidade/{visibilidadeId}",
     *      requirements={
     *          "tipoRelatorioId" = "\d+",
     *          "visibilidadeId" = "\d+",
     *      },
     *      methods={"DELETE"},
     *  )
     *
     * @Security("is_granted('ROLE_ADMIN')")
     *
     * @RestApiDoc()
     *
     * @param string[]|null $allowedHttpMethods
     *
     * @throws LogicException
     * @throws Throwable
     * @throws HttpException
     * @throws MethodNotAllowedHttpException
     */
    public function destroyVisibilidadeAction(
        Request $request,
        int $tipoRelatorioId,
        int $visibilidadeId,
        AclProviderInterface $aclProvider,
        AuthorizationCheckerInterface $authorizationChecker,
        TokenStorageInterface $tokenStorage,
        ?array $allowedHttpMethods = null
    ): Response {
        $allowedHttpMethods ??= ['DELETE'];

        // Make sure that we have everything we need to make this work
        $this->validateRestMethod($request, $allowedHttpMethods);

        $tipoRelatorio = $this->getResource()->getRepository()->find($tipoRelatorioId);

        if (!$authorizationChecker->isGranted('MASTER', $tipoRelatorio)) {
            throw new AccessDeniedException();
        }

        try {
            $objectIdentity = ObjectIdentity::fromDomainObject($tipoRelatorio);
            $aclObject = $aclProvider->findAcl($objectIdentity);

            $aceId = null;

            /** @var Entry $ace */
            foreach ($aclObject->getObjectAces() as $index => $ace) {
                if (($ace->getId() === $visibilidadeId) &&
                    (0 !== $ace->getMask())) {
                    $aceId = $ace->getId();
                    $aclObject->deleteObjectAce($index);
                    $aclProvider->updateAcl($aclObject);
                }
            }

            // se ficar sem nenhuma, tem que recolocar a default
            if (!count($aclObject->getObjectAces())) {
                $securityIdentity = new RoleSecurityIdentity('ROLE_ADMIN');
                $aclObject->insertObjectAce($securityIdentity, MaskBuilder::MASK_OWNER);
                $aclProvider->updateAcl($aclObject);
            }

            return new JsonResponse(
                [
                    'id' => $aceId,
                ]
            );
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception, $tipoRelatorioId);
        }
    }

    /**
     * Route for get API version.
     *
     * @Route(
     *     path="/get_roles_tipo_relatorio",
     *     methods={"GET"}
     *  )
     *
     * @Security("is_granted('ROLE_ADMIN')")
     *
     * @OA\Tag(name="Default")
     *
     * @OA\Response(
     *      response=200,
     *      description="success",
     *      @OA\Schema(
     *          type="object",
     *          example={"success": true},
     *          @OA\Property(property="success", type="boolean", description="Get static roles"),
     *      ),
     *  )
     */
    public function getStaticRolesTipoRelatorio(
        ParameterBagInterface $parameterBag
    ): JsonResponse {
        $staticRoles = $parameterBag->get('static_roles_tipo_relatorio');

        return new JsonResponse($staticRoles);
    }
}
