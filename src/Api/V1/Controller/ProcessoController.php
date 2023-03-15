<?php

declare(strict_types=1);
/**
 * /src/Controller/ProcessoController.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Controller;

use LogicException;
use ONGR\ElasticsearchBundle\Service\IndexService;
use ONGR\ElasticsearchDSL\Sort\FieldSort;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Model;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use SuppCore\AdministrativoBackend\Entity\VinculacaoDocumento;
use SuppCore\AdministrativoBackend\Repository\ComponenteDigitalRepository;
use SuppCore\AdministrativoBackend\Repository\JuntadaRepository;
use SuppCore\AdministrativoBackend\Timeline\TimelineEvent;
use SuppCore\AdministrativoBackend\Timeline\TimelineProcessoService;
use function strpos;
use function substr;
use SuppCore\AdministrativoBackend\Annotation\RestApiDoc;
use SuppCore\AdministrativoBackend\Api\V1\DTO\ComponenteDigital;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Processo;
use SuppCore\AdministrativoBackend\Api\V1\Resource\ProcessoResource;
use SuppCore\AdministrativoBackend\Elastic\ElasticQueryBuilderService;
use SuppCore\AdministrativoBackend\Repository\SetorRepository;
use SuppCore\AdministrativoBackend\Repository\UsuarioRepository;
use SuppCore\AdministrativoBackend\Rest\Controller;
use SuppCore\AdministrativoBackend\Rest\RequestHandler;
use SuppCore\AdministrativoBackend\Rest\ResponseHandler;
use SuppCore\AdministrativoBackend\Rest\Traits\Actions;
use SuppCore\AdministrativoBackend\Transaction\Context;
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
use Twig\Environment;
use OpenApi\Attributes as OAT;

/**
 * @Route(path="/v1/administrativo/processo")
 *
 * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
 *
 * @OA\Tag(name="Processo")
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @method ProcessoResource getResource()
 */
class ProcessoController extends Controller
{
    // Traits
    use Actions\User\FindOneAction;
    use Actions\User\FindAction;
    use Actions\User\CreateAction;
    use Actions\User\UpdateAction;
    use Actions\User\PatchAction;
    use Actions\Root\DeleteAction;
    use Actions\Colaborador\CountAction;


    /**
     * ProcessoController constructor.
     */
    public function __construct(
        ProcessoResource $resource,
        ResponseHandler $responseHandler,
        private IndexService $processoIndex,
        private ElasticQueryBuilderService $elasticQueryBuilderService,
        private TimelineProcessoService $timelineProcessoService
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
     * @Security("is_granted('ROLE_COLABORADOR')")
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
     * Endpoint action to get visibilidade status.
     *
     * @Route(
     *      "/{id}/juntada_index",
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
     * @throws LogicException
     * @throws Throwable
     * @throws HttpException
     * @throws MethodNotAllowedHttpException
     */
    public function getJuntadaIndexAction(
        Request $request,
        int $id,
        JuntadaRepository $juntadaRepository,
        ComponenteDigitalRepository $componenteDigitalRepository,
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

            $index = [];
            $index['status'] = 'sem_juntadas';
            $juntada = $juntadaRepository->findLastNaoVinculadaByProcessoId($processo->getId());
            if ($juntada) {
                $index['status'] = 'sucesso';
                $index['juntadaId'] = $juntada->getId();
                $index['numeracaoSequencial'] = $juntada->getNumeracaoSequencial();
                if (!$juntada->getAtivo()) {
                    $index['status'] = 'desentranhada';
                }
                $componenteDigital = $componenteDigitalRepository->findFirstByJuntadaIdAndProcessoId(
                    $juntada->getId()
                );
                if ($componenteDigital) {
                    $index['componenteDigitalId'] = $componenteDigital->getId();
                } else {
                    $index['status'] = 'sem_componentes_digitais';
                    /* @var VinculacaoDocumento $vinculacoesDocumentos */
                    foreach ($juntada->getDocumento()->getVinculacoesDocumentos() as $vinculacaoDocumento) {
                        /* @var \SuppCore\AdministrativoBackend\Entity\ComponenteDigital $componenteDigital */
                        foreach ($vinculacaoDocumento->getDocumentoVinculado()
                                     ->getComponentesDigitais() as $componenteDigitalVinculado) {
                            $index['componenteDigitalId'] = $componenteDigitalVinculado->getId();
                            $index['status'] = 'sucesso';
                            break 2;
                        }
                    }
                }
            }

            return new JsonResponse($index);
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception, $id);
        }
    }

    /**
     * Endpoint action to criar um direito de acesso sobre um processo.
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

        $processo = $this->getResource()->getRepository()->find($id);

        if (!$authorizationChecker->isGranted('MASTER', $processo)) {
            throw new AccessDeniedException();
        }

        $objectIdentity = ObjectIdentity::fromDomainObject($processo);
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
                // remove eventual existente
                if (($ace->getSecurityIdentity() instanceof RoleSecurityIdentity) &&
                    ($securityIdentity instanceof RoleSecurityIdentity) &&
                    ($ace->getSecurityIdentity()->getRole() === $securityIdentity->getRole()) &&
                    0 !== $ace->getMask()) {
                    $aclObject->deleteObjectAce($index);
                    $aclProvider->updateAcl($aclObject);
                }
                // remove eventual existente
                if (($ace->getSecurityIdentity() instanceof UserSecurityIdentity) &&
                    ($securityIdentity instanceof UserSecurityIdentity) &&
                    ($ace->getSecurityIdentity()->getUsername() === $securityIdentity->getUsername()) &&
                    0 !== $ace->getMask()) {
                    $aclObject->deleteObjectAce($index);
                    $aclProvider->updateAcl($aclObject);
                }
                // remove de todos os usuários
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
            if (!$authorizationChecker->isGranted('MASTER', $processo)) {
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
     * Endpoint action to remover um direito de acesso sobre um processo.
     *
     * @Route(
     *      "/{processoId}/visibilidade/{visibilidadeId}",
     *      requirements={
     *          "processoId" = "\d+",
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
     * @throws LogicException
     * @throws Throwable
     * @throws HttpException
     * @throws MethodNotAllowedHttpException
     */
    public function destroyVisibilidadeAction(
        Request $request,
        int $processoId,
        int $visibilidadeId,
        AclProviderInterface $aclProvider,
        AuthorizationCheckerInterface $authorizationChecker,
        TokenStorageInterface $tokenStorage,
        ?array $allowedHttpMethods = null
    ): Response {
        $allowedHttpMethods ??= ['DELETE'];

        // Make sure that we have everything we need to make this work
        $this->validateRestMethod($request, $allowedHttpMethods);

        $processo = $this->getResource()->getRepository()->find($processoId);

        if (!$authorizationChecker->isGranted('MASTER', $processo)) {
            throw new AccessDeniedException();
        }

        try {
            $objectIdentity = ObjectIdentity::fromDomainObject($processo);
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
            if (!$authorizationChecker->isGranted('MASTER', $processo)) {
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
            throw $this->handleRestMethodException($exception, $processoId);
        }
    }

    /**
     * Endpoint action to arquivar um processo.
     *
     * @Route(
     *      "/{id}/arquivar",
     *      requirements={
     *          "id" = "\d+",
     *      },
     *      methods={"PATCH"},
     *  )
     *
     * @Security("is_granted('ROLE_COLABORADOR')")
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
    public function arquivarAction(
        Request $request,
        int $id,
        ?array $allowedHttpMethods = null
    ): Response {
        $allowedHttpMethods ??= ['PATCH'];

        // Make sure that we have everything we need to make this work
        $this->validateRestMethod($request, $allowedHttpMethods);

        try {
            $transactionId = $this->transactionManager->begin();

            $context = RequestHandler::getContext($request);

            foreach ($context as $name => $value) {
                $this->transactionManager->addContext(
                    new Context($name, $value),
                    $transactionId
                );
            }

            $processoResource = $this->getResource();
            $processoDTO = $processoResource->getDtoForEntity($id, Processo::class);
            $processoEntity = $processoResource->arquivar($id, $processoDTO, $transactionId, true);

            $this->transactionManager->commit($transactionId);

            return $this->getResponseHandler()->createResponse($request, $processoEntity);
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception, $id);
        }
    }

    /**
     * Endpoint action to autuar um processo.
     *
     * @Route(
     *      "/{id}/autuar",
     *      requirements={
     *          "id" = "\d+",
     *      },
     *      methods={"PATCH"},
     *  )
     *
     * @Security("is_granted('ROLE_COLABORADOR')")
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
    public function autuarAction(
        Request $request,
        int $id,
        ?array $allowedHttpMethods = null
    ): Response {
        $allowedHttpMethods ??= ['PATCH'];

        // Make sure that we have everything we need to make this work
        $this->validateRestMethod($request, $allowedHttpMethods);

        try {
            $transactionId = $this->transactionManager->begin();

            $context = RequestHandler::getContext($request);

            foreach ($context as $name => $value) {
                $this->transactionManager->addContext(
                    new Context($name, $value),
                    $transactionId
                );
            }

            $processoResource = $this->getResource();
            $processoDTO = $processoResource->getDtoForEntity($id, Processo::class);
            $processoEntity = $processoResource->autuar($id, $processoDTO, $transactionId, true);

            $this->transactionManager->commit($transactionId);

            return $this->getResponseHandler()->createResponse($request, $processoEntity);
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception, $id);
        }
    }

    /**
     * Endpoint action to download.
     *
     * @Route(
     *      "/{id}/download/{tipo}/{sequencial}", defaults={"sequencial"="all", "tipo"="PDF"},
     *      requirements={
     *          "id" = "\d+",
     *      },
     *      methods={"GET"},
     *  )
     *
     * @RestApiDoc()
     *
     * @Security("is_granted('ROLE_USER')")
     *
     * @param string[]|null $allowedHttpMethods
     *
     * @throws Throwable
     */
    public function downloadAction(
        Request $request,
        int $id,
        ?string $tipo,
        ?string $sequencial,
        ?array $allowedHttpMethods = null
    ): Response {
        $allowedHttpMethods ??= ['GET'];

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

            $this->transactionManager->addContext(
                new Context('tipoDownload', strtoupper($tipo)),
                $transactionId
            );

            $this->transactionManager->addContext(
                new Context('sequencial', $sequencial),
                $transactionId
            );

            $processo = $this->getResource()->download($id, $transactionId);
            $this->transactionManager->commit($transactionId);

            return $this->getResponseHandler()
                ->createResponse($request, $processo);
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception, $id);
        }
    }

    /**
     * Endpoint action to imprimir etiqueta.
     *
     * @Route(
     *      "/imprime_etiqueta/{processoId}",
     *      requirements={
     *          "processoId" = "\d+",
     *      },
     *      methods={"GET"},
     *  )
     *
     * @RestApiDoc()
     * @Security("is_granted('ROLE_COLABORADOR')")
     *
     * @param string[]|null $allowedHttpMethods
     *
     * @throws Throwable
     */
    public function imprimirEtiquetaAction(
        Request $request,
        int $processoId,
        Environment $twig,
        ?array $allowedHttpMethods = null
    ): Response {
        $allowedHttpMethods ??= ['GET'];

        // Make sure that we have everything we need to make this work
        $this->validateRestMethod($request, $allowedHttpMethods);

        try {
            $componenteDigitalDTO = new ComponenteDigital();
            $processo = $this->getResource()->getRepository()->find($processoId);

            if ($processo) {
                $conteudoHTML = $twig->render(
                    'Resources/Processo/layout_etiqueta.html.twig',
                    ['processo' => $processo]
                );

                $componenteDigitalDTO->setConteudo($conteudoHTML);
            }

            // Fetch data from database
            return $this
                ->getResponseHandler()
                ->createResponse($request, $componenteDigitalDTO);
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception, $processoId);
        }
    }

    /**
     * Endpoint action to imprimir relatorio de documentos.
     *
     * @Route(
     *      "/imprime_relatorio/{processoId}",
     *      requirements={
     *          "processoId" = "\d+",
     *      },
     *      methods={"GET"},
     *  )
     *
     * @RestApiDoc()
     * @Security("is_granted('ROLE_COLABORADOR')")
     *
     * @param string[]|null $allowedHttpMethods
     *
     * @throws Throwable
     */
    public function imprimirRelatorioAction(
        Request $request,
        int $processoId,
        Environment $twig,
        ?array $allowedHttpMethods = null
    ): Response {
        $allowedHttpMethods ??= ['GET'];

        // Make sure that we have everything we need to make this work
        $this->validateRestMethod($request, $allowedHttpMethods);
        $contexto = RequestHandler::getContext($request);

        try {
            $componenteDigitalDTO = new ComponenteDigital();
            $processo = $this->getResource()->getRepository()->find($processoId);

            if ($processo) {
                $conteudoHTML = $twig->render(
                    'Resources/Processo/relatorio.html.twig',
                    ['processo' => $processo,
                     'contexto' => $contexto, ]
                );

                $componenteDigitalDTO->setConteudo($conteudoHTML);
            }

            // Fetch data from database
            return $this
                ->getResponseHandler()
                ->createResponse($request, $componenteDigitalDTO);
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception, $processoId);
        }
    }

    /**
     * Endpoint action para localizar uma processo no elasticsearch.
     *
     * @Route(
     *      path="/search",
     *      methods={"GET"},
     *  )
     *
     * @Security("is_granted('ROLE_USER')")
     *
     * @RestApiDoc()
     *
     * @throws Throwable
     */
    public function searchAction(Request $request, ?array $allowedHttpMethods = null): Response
    {
        $allowedHttpMethods ??= ['GET'];

        // Make sure that we have everything we need to make this work
        $this->validateRestMethod($request, $allowedHttpMethods);

        // Determine used parameters
        $orderBy = RequestHandler::getOrderBy($request);
        $limit = RequestHandler::getLimit($request);
        $offset = RequestHandler::getOffset($request);
        $populate = RequestHandler::getPopulate($request, $this->getResource());

        try {
            $criteria = RequestHandler::getCriteria($request);

            $this->elasticQueryBuilderService->init(
                'processo'
            );

            $boolQuery = $this->elasticQueryBuilderService->proccessCriteria($criteria);

            $search = $this->processoIndex->createSearch()->addQuery($boolQuery);

            if ($orderBy) {
                foreach ($orderBy as $key => $value) {
                    if ($key && $value) {
                        $search->addSort(
                            new FieldSort(
                                $this->elasticQueryBuilderService->processaProperty($key),
                                null,
                                ['order' => $value]
                            )
                        );
                    }
                }
            }

            $search->setSize($limit);
            $search->setFrom($offset);
            $search->setTrackTotalHits(true);
            $search->setSource(false);

            $results = $this->processoIndex->findRaw($search);

            $result = [];
            $result['entities'] = [];

            foreach ($results as $document) {
                $entity = $this->getResource()->getRepository()->find((int) $document['_id'], $populate);
                if ($entity) {
                    $result['entities'][] = $entity;
                }
            }

            $result['total'] = $results->count();

            return $this
                ->getResponseHandler()
                ->createResponse(
                    $request,
                    $result
                );
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception);
        }
    }

    /**
     * Endpoint action to get timeline json.
     * @param string[]|null $allowedHttpMethods
     *
     * @throws LogicException
     * @throws Throwable
     * @throws HttpException
     * @throws MethodNotAllowedHttpException
     */
    #[
        Route("/{id}/timeline", requirements: ["id" => "\d+"], methods: ["GET"]),
        Security("is_granted('ROLE_COLABORADOR')"),
        OAT\Tag("Processo"),
        OAT\Response(
            response: 200,
            description: "Endpoint action to fetch Processo timeline",
            content: new OAT\MediaType(
                mediaType: "application/json",
                schema: new OAT\Schema(
                    type: "array",
                    items: new OAT\Items(
                        properties: [
                            "entities" => new OAT\Property(
                                "entities",
                                description: "array of entities",
                                type: "array",
                                items: new OAT\Items(
                                    properties: [
                                        "timelineEvent" => new OAT\Property(
                                            "timelineEvent",
                                            ref: new Model(type: TimelineEvent::class)
                                        )
                                    ]
                                )
                            ),
                            "total" => new OAT\Property(
                                "total",
                                description: "total os entities",
                                type: "int",
                                example: "10"
                            )
                        ],
                    )
                )
            )
        ),
        OAT\Response(
            response: 400,
            description: "Bad Request",
            content: new OAT\MediaType(
                mediaType: "application/json",
                schema: new OAT\Schema(
                    properties: [
                        "code" => new OAT\Property(
                            "code",
                            description: "Error code",
                            type: "integer",
                        ),
                        "message" => new OAT\Property(
                            "message",
                            description: "Error description",
                            type: "string",
                        ),
                    ],
                    type: "object",
                    example: ["code" => 400, "message" => "Bad Request"],
                )
            )
        ),
        OAT\Response(
            response: 401,
            description: "Unauthorized",
            content: new OAT\MediaType(
                mediaType: "application/json",
                schema: new OAT\Schema(
                    properties: [
                        "code" => new OAT\Property(
                            "code",
                            description: "Error code",
                            type: "integer",
                        ),
                        "message" => new OAT\Property(
                            "message",
                            description: "Error description",
                            type: "string",
                        ),
                    ],
                    type: "object",
                    example: ["code" => 401, "message" => "Bad credentials"],
                )
            )
        ),
        OAT\Response(
            response: 404,
            description: "Not Found",
            content: new OAT\MediaType(
                mediaType: "application/json",
                schema: new OAT\Schema(
                    properties: [
                        "code" => new OAT\Property(
                            "code",
                            description: "Error code",
                            type: "integer",
                        ),
                        "message" => new OAT\Property(
                            "message",
                            description: "Error description",
                            type: "string",
                        ),
                    ],
                    type: "object",
                    example: ["code" => 404, "message" => "Not Found"],
                )
            )
        ),
    ]
    public function getTimelineAction(
        Request $request,
        int $id,
        ?int $emptyUserEvents,
        ?array $allowedHttpMethods = null
    ): Response {
        $allowedHttpMethods ??= ['GET'];
        // Make sure that we have everything we need to make this work
        $this->validateRestMethod($request, $allowedHttpMethods);
        $processo = $this->getResource()->getRepository()->find($id);

        try {
            $timeline = $this->timelineProcessoService
                ->getTimelineProcesso($processo, RequestHandler::getCriteria($request));

            return $this
                ->getResponseHandler()
                ->createResponse(
                    $request,
                    [
                        'entities' => $timeline,
                        'total' => count($timeline)
                    ]
                );
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception, $id);
        }
    }

    /**
     * Endpoint action to remover um direito de acesso sobre os documentos de um processo.
     *
     * @Route(
     *      "/{processoId}/deletevisibilidadedocs",
     *      requirements={
     *          "processoId" = "\d+"
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
     * @throws LogicException
     * @throws Throwable
     * @throws HttpException
     * @throws MethodNotAllowedHttpException
     */
    public function destroyVisibilidadeDocumentosAction(
        Request $request,
        int $processoId,
        JuntadaRepository $juntadaRepository,
        AclProviderInterface $aclProvider,
        AuthorizationCheckerInterface $authorizationChecker,
        TokenStorageInterface $tokenStorage,
        ?array $allowedHttpMethods = null
    ): Response {
        $allowedHttpMethods ??= ['DELETE'];

        // Make sure that we have everything we need to make this work
        $this->validateRestMethod($request, $allowedHttpMethods);

        $juntadas = $juntadaRepository->findJuntadaByProcesso($processoId);

        $docsId = [];
        $docsErrors = [];

        foreach ($juntadas as $juntada) {
            $documento = $juntada->getDocumento();

            if (!$documento) {
                continue;
            }

            if ($documento && !$authorizationChecker->isGranted('MASTER', $documento)) {
                $error = $documento->getId();
                array_push($docsErrors, $error);
                continue;
            }

            try {
                $objectIdentity = ObjectIdentity::fromDomainObject($documento);
                $aclObject = $aclProvider->findAcl($objectIdentity);

                if($aclObject->getObjectAces()[0]->getMask() === 128){
                    continue;
                }

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

                array_push($docsId, $documento->getId());
            } catch (Throwable $exception) {
                throw $this->handleRestMethodException($exception, $documento->getId());
            }
        }


        return new JsonResponse(
            [
                'id' => $docsId,
                'errors' => $docsErrors
            ]
        );
    }
}
