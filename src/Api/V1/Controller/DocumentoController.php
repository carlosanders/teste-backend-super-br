<?php

declare(strict_types=1);
/**
 * /src/Controller/DocumentoController.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Controller;

use DateTime;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\TransactionRequiredException;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use LogicException;
use OpenApi\Annotations as OA;
use Ramsey\Uuid\Uuid as Ruuid;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use SuppCore\AdministrativoBackend\Annotation\RestApiDoc;
use SuppCore\AdministrativoBackend\Api\V1\Resource\DocumentoResource;
use SuppCore\AdministrativoBackend\Repository\SetorRepository;
use SuppCore\AdministrativoBackend\Repository\UsuarioRepository;
use SuppCore\AdministrativoBackend\Rest\Controller;
use SuppCore\AdministrativoBackend\Rest\RequestHandler;
use SuppCore\AdministrativoBackend\Rest\ResponseHandler;
use SuppCore\AdministrativoBackend\Rest\Traits\Actions;
use SuppCore\AdministrativoBackend\Transaction\Context;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;
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
 * @Route(path="/v1/administrativo/documento")
 *
 * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
 *
 * @OA\Tag(name="Documento")
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @method DocumentoResource getResource()
 */
class DocumentoController extends Controller
{
    // Traits
    use Actions\User\FindOneAction;
    use Actions\User\FindAction;
    use Actions\Colaborador\CreateAction;
    use Actions\Colaborador\UpdateAction;
    use Actions\Colaborador\PatchAction;
    use Actions\Colaborador\DeleteAction;
    use Actions\Colaborador\CountAction;
    use Actions\Colaborador\UndeleteAction;

/** @noinspection MagicMethodsValidityInspection */

    /**
     * DocumentoController constructor.
     */
    public function __construct(
        DocumentoResource $resource,
        ResponseHandler $responseHandler
    ) {
        $this->init($resource, $responseHandler);
    }

    /**
     * Endpoint action to preparar assinatura.
     *
     * @Route(
     *      "/prepara_assinatura",
     *      methods={"GET"},
     *  )
     *
     * @RestApiDoc()
     *
     * @throws ORMException
     */
    public function getPreparaAssinaturaAction(
        Request $request,
        HubInterface $hub,
        TokenStorageInterface $tokenStorage,
        ParameterBagInterface $parameterBag,
        JWTTokenManagerInterface $JWTManager
    ): JsonResponse {
        $documentosIds = RequestHandler::getArrayParam($request, 'documentosId');
        $processUUID = $request->get('processUUID', false);

        $files = [];

        foreach ($documentosIds as $documentoId) {
            $documento = $this->getResource()->getRepository()->find($documentoId);

            foreach ($documento->getComponentesDigitais() as $componentesDigital) {
                $files[] = [
                    'componenteDigitalId' => $componentesDigital->getId(),
                    'hash' => $componentesDigital->getHash(),
                    'documentoId' => $documentoId,
                ];
            }
        }

        $usuario = $tokenStorage->getToken()->getUser();

        $token = $JWTManager->create($usuario);

        $agora = new DateTime();

        $transaction = [
            'uuid' => Ruuid::uuid4()->toString(),
            'action' => 'SIGN_HASH_FILES',
            'payload' => [
                //'mode': 'TEST', descomente se quiser usar o assinador em modo test, ou seja, sem token
                'processUUID' => $processUUID,
                'jwt' => $token,
                'api' => $parameterBag->get('supp_core.administrativo_backend.url_sistema_backend').
                    '/v1/administrativo/assinatura',
                'files' => $files,
                'algorithmHash' => 'SHA256withRSA',
            ],
            'dateTimeCreate' => $agora->format('d/m/Y H:i:s'),
            'expire' => 90,
        ];

        $update = new Update(
            '/assinador/'.$tokenStorage->getToken()->getUser()->getUserIdentifier(),
            json_encode($transaction)
        );

        $hub->publish($update);

        return new JsonResponse(['secret' => md5($token)]);
    }

    /**
     * @Route(
     *      "/{id}/delete_assinatura",
     *      requirements={
     *          "id" = "\d+",
     *      },
     *      methods={"DELETE"},
     *  )
     *
     * @Security("is_granted('ROLE_COLABORADOR')")
     *
     * @RestApiDoc()
     *
     * @throws LogicException
     * @throws Throwable
     * @throws HttpException
     * @throws MethodNotAllowedHttpException
     */
    public function deleteAssinaturaAction(Request $request, int $id): Response
    {
        $allowedHttpMethods ??= ['DELETE'];

        // Make sure that we have everything we need to make this work
        $this->validateRestMethod($request, $allowedHttpMethods);

        try {
            // Fetch data from database
            $transactionId = $this->transactionManager->begin();

            $context = RequestHandler::getContext($request);

            foreach ($context as $name => $value) {
                $this->transactionManager->addContext(
                    new Context($name, $value),
                    $transactionId
                );
            }

            $data = $this->getResource()->deleteAssinatura($id, $transactionId);

            $this->transactionManager->commit($transactionId);

            return $this
                ->getResponseHandler()
                ->createResponse($request, $data);
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception, $id);
        }
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
     * @Security("is_granted('ROLE_COLABORADOR')")
     *
     * @param string[]|null $allowedHttpMethods
     *
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws TransactionRequiredException
     * @throws Throwable
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

        $processo = $this->getResource()->getRepository()->find($id);

        if (!$authorizationChecker->isGranted('VIEW', $processo)) {
            throw new AccessDeniedException();
        }

        try {
            // Fetch data from database

            $result = [];

            $acl = $aclProvider->findAcl(ObjectIdentity::fromDomainObject($processo));

            /** @var Entry $ace */
            foreach ($acl->getObjectAces() as $ace) {
                $mask = new MaskBuilder($ace->getMask());
                $pattern = $mask->getPattern();
                $poderes = [];

                if (strpos($pattern, 'M') > 0) {
                    $poderes[] = 'MASTER';
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
                    $poderes[] = 'MASTER';
                }

                if (0 !== $ace->getMask()) {
                    if ($ace->getSecurityIdentity() instanceof UserSecurityIdentity) {
                        $user = $usuarioRepository->findOneBy(
                            [
                                'username' => $ace->getSecurityIdentity()->getUsername(),
                            ]
                        );
                        if ($user->getColaborador()) {
                            $tipo = 'usuario';
                        } else {
                            $tipo = 'usuario_externo';
                        }
                        $result[] = [
                            'id' => $ace->getId(),
                            'label' => $user->getNome().' ('.substr(
                                $ace->getSecurityIdentity()->getUsername(),
                                0,
                                5
                            ).'******'.')',
                            'tipo' => $tipo,
                            'poderes' => $poderes,
                            'valor' => $ace->getSecurityIdentity()->getUsername(),
                        ];
                    } else {
                        $roles = explode('_', $ace->getSecurityIdentity()->getRole());
                        switch ($roles[1]) {
                            case 'SETOR':
                                $setor = $setorRepository->find((int) $roles[2]);
                                $result[] = [
                                    'id' => $ace->getId(),
                                    'label' => $setor->getNome().' ('.$setor->getUnidade()->getSigla().')',
                                    'tipo' => 'SETOR',
                                    'poderes' => $poderes,
                                    'valor' => $ace->getSecurityIdentity()->getRole(),
                                ];
                                break;
                            case 'UNIDADE':
                                $setor = $setorRepository->find((int) $roles[2]);
                                $result[] = [
                                    'id' => $ace->getId(),
                                    'label' => $setor->getNome().' ('.$setor->getSigla().')',
                                    'tipo' => 'UNIDADE',
                                    'poderes' => $poderes,
                                    'valor' => $ace->getSecurityIdentity()->getRole(),
                                ];
                                break;
                            default:
                                $result[] = [
                                    'id' => $ace->getId(),
                                    'label' => 'ROLE_USER' === $ace->getSecurityIdentity()->getRole(
                                    ) ? 'TODOS OS USUÁRIOS' : $ace->getSecurityIdentity()->getRole(),
                                    'tipo' => 'PERFIL',
                                    'poderes' => $poderes,
                                    'valor' => $ace->getSecurityIdentity()->getRole(),
                                ];
                                break;
                        }
                    }
                }
            }

            return new JsonResponse($result);
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception, $id);
        }
    }

    /**
     * Endpoint action to criar ou remover uma visibilidade sobre um documento.
     *
     * @Route(
     *      "/{id}/visibilidade",
     *      requirements={
     *          "id" = "\d+",
     *      },
     *      methods={"PUT"},
     *  )
     *
     * @Security("is_granted('ROLE_COLABORADOR')")
     *
     * @RestApiDoc()
     *
     * @param string[]|null $allowedHttpMethods
     *
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws TransactionRequiredException
     * @throws Throwable
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

        $documento = $this->getResource()->getRepository()->find($id);

        if (!$authorizationChecker->isGranted('MASTER', $documento)) {
            throw new AccessDeniedException();
        }

        $objectIdentity = ObjectIdentity::fromDomainObject($documento);
        $aclObject = $aclProvider->findAcl($objectIdentity);

        try {
            $maskBuilder = new MaskBuilder();

            $poderes = $request->get('poderes');

            foreach ($poderes as $poder) {
                switch ($poder) {
                    case 'master':
                        $maskBuilder->add(MaskBuilder::MASK_MASTER);
                        break;
                    case 'criar':
                        $maskBuilder->add(MaskBuilder::MASK_CREATE);
                        break;
                    case 'editar':
                        $maskBuilder->add(MaskBuilder::MASK_EDIT);
                        break;
                    case 'ver':
                        $maskBuilder->add(MaskBuilder::MASK_VIEW);
                        break;
                    case 'apagar':
                        $maskBuilder->add(MaskBuilder::MASK_DELETE);
                        break;
                }
            }

            $tipo = $request->get('tipo', false);
            $valor = $request->get('valor', false);

            if ('usuario' == $tipo) {
                $usuario = $usuarioRepository->find($valor);
                $securityIdentity = UserSecurityIdentity::fromAccount($usuario);
            } elseif ('setor' === $tipo) {
                $securityIdentity = new RoleSecurityIdentity('ACL_SETOR_'.$valor);
            } elseif ('unidade' === $tipo) {
                $securityIdentity = new RoleSecurityIdentity('ACL_UNIDADE_'.$valor);
            } else {
                $securityIdentity = new RoleSecurityIdentity($valor);
            }

            /** @var Entry $ace */
            foreach ($aclObject->getObjectAces() as $index => $ace) {
                //remove eventual existente
                if (($ace->getSecurityIdentity() instanceof RoleSecurityIdentity) &&
                    ($securityIdentity instanceof RoleSecurityIdentity) &&
                    ($ace->getSecurityIdentity()->getRole() === $securityIdentity->getRole()) &&
                    0 !== $ace->getMask()) {
                    $aclObject->deleteObjectAce($index);
                    $aclProvider->updateAcl($aclObject);
                }
                //remove eventual existente
                if (($ace->getSecurityIdentity() instanceof UserSecurityIdentity) &&
                    ($securityIdentity instanceof UserSecurityIdentity) &&
                    ($ace->getSecurityIdentity()->getUsername() === $securityIdentity->getUsername()) &&
                    0 !== $ace->getMask()) {
                    $aclObject->deleteObjectAce($index);
                    $aclProvider->updateAcl($aclObject);
                }
                //remove de todos os usuários
                if (($ace->getSecurityIdentity() instanceof RoleSecurityIdentity) &&
                    ('ROLE_USER' === $ace->getSecurityIdentity()->getRole()) &&
                    (in_array($ace->getMask(), [MaskBuilder::MASK_MASTER, MaskBuilder::MASK_OWNER]))) {
                    $aclObject->deleteObjectAce($index);
                    $aclProvider->updateAcl($aclObject);
                }
            }

            $aclObject->insertObjectAce($securityIdentity, $maskBuilder->get());
            $aclProvider->updateAcl($aclObject);

            // o usuário que restringe sempre deve ser master
            if (!$authorizationChecker->isGranted('MASTER', $documento)) {
                $usuario = $tokenStorage->getToken()->getUser();
                $aclObject->insertObjectAce(
                    UserSecurityIdentity::fromAccount($usuario),
                    MaskBuilder::MASK_MASTER
                );
                $aclProvider->updateAcl($aclObject);
            }

            return new JsonResponse(
                [
                    'tipo' => $tipo,
                    'poderes' => $poderes,
                    'valor' => $valor,
                ]
            );
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception, $id);
        }
    }

    /**
     * Endpoint action to criar ou remover uma visibilidade sobre um processo.
     *
     * @Route(
     *      "/{documentoId}/visibilidade/{visibilidadeId}",
     *      requirements={
     *          "documentoId" = "\d+",
     *          "visibilidadeId" = "\d+",
     *      },
     *      methods={"DELETE"},
     *  )
     *
     * @Security("is_granted('ROLE_COLABORADOR')")
     *
     * @RestApiDoc()
     *
     * @param string[]|null $allowedHttpMethods
     *
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws TransactionRequiredException
     * @throws Throwable
     */
    public function destroyVisibilidadeAction(
        Request $request,
        int $documentoId,
        int $visibilidadeId,
        AclProviderInterface $aclProvider,
        AuthorizationCheckerInterface $authorizationChecker,
        TokenStorageInterface $tokenStorage,
        ?array $allowedHttpMethods = null
    ): Response {
        $allowedHttpMethods ??= ['DELETE'];

        // Make sure that we have everything we need to make this work
        $this->validateRestMethod($request, $allowedHttpMethods);

        $documento = $this->getResource()->getRepository()->find($documentoId);

        if (!$authorizationChecker->isGranted('MASTER', $documento)) {
            throw new AccessDeniedException();
        }

        try {
            $objectIdentity = ObjectIdentity::fromDomainObject($documento);
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
                $securityIdentity = new RoleSecurityIdentity('ROLE_USER');
                $aclObject->insertObjectAce($securityIdentity, MaskBuilder::MASK_OWNER);
                $aclProvider->updateAcl($aclObject);
            }

            // o usuário que restringe sempre deve ser master
            if (!$authorizationChecker->isGranted('MASTER', $documento)) {
                $usuario = $tokenStorage->getToken()->getUser();
                $aclObject->insertObjectAce(
                    UserSecurityIdentity::fromAccount($usuario),
                    MaskBuilder::MASK_MASTER
                );
                $aclProvider->updateAcl($aclObject);
            }

            return new JsonResponse(
                [
                    'id' => $aceId,
                ]
            );
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception, $documentoId);
        }
    }

    /**
     * Endpoint action to convert document to pdf.
     *
     * @Route(
     *      "/convertToPdf/{id}",
     *      requirements={
     *          "id" = "\d+",
     *      },
     *      methods={"PATCH"},
     *  )
     *
     * @RestApiDoc()
     * @Security("is_granted('ROLE_USER')")
     *
     * @throws Throwable
     */
    public function convertToPdfAction(
        Request $request,
        int $id,
        ?array $allowedHttpMethods = null
    ): Response {
        $allowedHttpMethods ??= ['PATCH'];

        // Make sure that we have everything we need to make this work
        $this->validateRestMethod($request, $allowedHttpMethods);

        try {
            //To use and save on the database
            $transactionId = $this->transactionManager->begin();

            $context = RequestHandler::getContext($request);

            foreach ($context as $name => $value) {
                $this->transactionManager->addContext(
                    new Context($name, $value),
                    $transactionId
                );
            }

            $data = $this
                ->getResource()
                ->convertToPDF($id, $transactionId, true);

            $this->transactionManager->commit($transactionId);

            return $this
                ->getResponseHandler()
                ->createResponse($request, $data, Response::HTTP_OK);
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception, $id);
        }
    }

    /**
     * Endpoint action para remover as visibilidades de um documento.
     *
     * @Route(
     *      "/deletevisibilidade/{documentoId}",
     *      requirements={
     *          "documentoId" = "\d+"
     *      },
     *      methods={"DELETE"},
     *  )
     *
     * @Security("is_granted('ROLE_COLABORADOR')")
     *
     * @RestApiDoc()
     *
     * @param string[]|null $allowedHttpMethods
     *
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws TransactionRequiredException
     * @throws Throwable
     */
    public function destroyDocumentoVisibilidadeAction(
        Request $request,
        int $documentoId,
        AclProviderInterface $aclProvider,
        AuthorizationCheckerInterface $authorizationChecker,
        TokenStorageInterface $tokenStorage,
        ?array $allowedHttpMethods = null
    ): Response {
        $allowedHttpMethods ??= ['DELETE'];

        // Make sure that we have everything we need to make this work
        $this->validateRestMethod($request, $allowedHttpMethods);

        $documento = $this->getResource()->getRepository()->find($documentoId);

        if (!$documento) {
            throw new \Exception('Documento não encontrado');
        }

        if ($documento && !$authorizationChecker->isGranted('MASTER', $documento)) {
            throw new \Exception('Usuário não possui permissão para exclusão da restrição');
        }

        try {
            $objectIdentity = ObjectIdentity::fromDomainObject($documento);
            $aclObject = $aclProvider->findAcl($objectIdentity);

            $aceId = null;

            /** @var Entry $ace */
            foreach ($aclObject->getObjectAces() as $index => $ace) {
                if ((0 !== $ace->getMask())) {
                    $aceId = $ace->getId();
                    $aclObject->deleteObjectAce(0);
                    $aclProvider->updateAcl($aclObject);
                }
            }

            // se ficar sem nenhuma, tem que recolocar a default
            if (!count($aclObject->getObjectAces())) {
                $securityIdentity = new RoleSecurityIdentity('ROLE_USER');
                $aclObject->insertObjectAce($securityIdentity, MaskBuilder::MASK_OWNER);
                $aclProvider->updateAcl($aclObject);
            }

            // o usuário que restringe sempre deve ser master
            if (!$authorizationChecker->isGranted('MASTER', $documento)) {
                $usuario = $tokenStorage->getToken()->getUser();
                $aclObject->insertObjectAce(
                    UserSecurityIdentity::fromAccount($usuario),
                    MaskBuilder::MASK_MASTER
                );
                $aclProvider->updateAcl($aclObject);
            }

            return new JsonResponse(
                [
                    'id' => $aceId,
                ]
            );
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception, $documentoId);
        }
    }

    /**
     * @Route(
     *      "/{documentoOrigemId}/converte_minuta_anexo/{documentoDestinoId}",
     *      requirements={
     *          "documentoOrigemId" = "\d+",
     *          "documentoDestinoId" = "\d+",
     *      },
     *      methods={"PATCH"},
     *  )
     *
     * @Security("is_granted('ROLE_COLABORADOR')")
     *
     * @RestApiDoc()
     *
     * @throws LogicException
     * @throws Throwable
     * @throws HttpException
     * @throws MethodNotAllowedHttpException
     */
    public function converteMinutaEmAnexoAction(
        Request $request,
        int $documentoOrigemId,
        int $documentoDestinoId
    ): Response
    {
        $allowedHttpMethods ??= ['PATCH'];

        // Make sure that we have everything we need to make this work
        $this->validateRestMethod($request, $allowedHttpMethods);

        try {
            // Fetch data from database
            $transactionId = $this->transactionManager->begin();

            $context = RequestHandler::getContext($request);

            foreach ($context as $name => $value) {
                $this->transactionManager->addContext(
                    new Context($name, $value),
                    $transactionId
                );
            }

            $data = $this->getResource()
                ->converteMinutaEmAnexo($documentoOrigemId, $documentoDestinoId, $transactionId);

            $this->transactionManager->commit($transactionId);

            return $this
                ->getResponseHandler()
                ->createResponse($request, $data);
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception, $documentoOrigemId);
        }
    }

    /**
     * @Route(
     *      "/{id}/converte_anexo_minuta/{tarefaId}",
     *      requirements={
     *          "id" = "\d+",
     *          "tarefaId" = "\d+",
     *      },
     *      methods={"PATCH"},
     *  )
     *
     * @Security("is_granted('ROLE_COLABORADOR')")
     *
     * @RestApiDoc()
     *
     * @throws LogicException
     * @throws Throwable
     * @throws HttpException
     * @throws MethodNotAllowedHttpException
     */
    public function converteAnexoEmMinutaAction(
        Request $request,
        int $id,
        int $tarefaId
    ): Response
    {
        $allowedHttpMethods ??= ['PATCH'];

        // Make sure that we have everything we need to make this work
        $this->validateRestMethod($request, $allowedHttpMethods);

        try {
            // Fetch data from database
            $transactionId = $this->transactionManager->begin();

            $context = RequestHandler::getContext($request);

            foreach ($context as $name => $value) {
                $this->transactionManager->addContext(
                    new Context($name, $value),
                    $transactionId
                );
            }

            $data = $this->getResource()
                ->converteAnexoEmMinuta($id, $tarefaId, $transactionId);

            $this->transactionManager->commit($transactionId);

            return $this
                ->getResponseHandler()
                ->createResponse($request, $data);
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception, $id);
        }
    }
}
