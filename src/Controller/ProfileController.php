<?php

declare(strict_types=1);
/**
 * /src/Controller/ProfileController.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\Encoding\MicrosecondBasedDateConversion;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Token\Builder as JWTBuilder;
use OpenApi\Annotations as OA;
use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use SuppCore\AdministrativoBackend\Annotation\RestApiDoc;
use SuppCore\AdministrativoBackend\Api\V1\Resource\UsuarioResource;
use SuppCore\AdministrativoBackend\Entity\Coordenador;
use SuppCore\AdministrativoBackend\Entity\Lotacao;
use SuppCore\AdministrativoBackend\Entity\Usuario;
use SuppCore\AdministrativoBackend\Rest\Controller;
use SuppCore\AdministrativoBackend\Rest\ResponseHandler;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Throwable;

/**
 * Class ProfileController.
 *
 * @Route(
 *      path="/profile",
 *  )
 *
 * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class ProfileController extends Controller
{
/** @noinspection MagicMethodsValidityInspection */

    /**
     * ProfileController constructor.
     *
     * @param UsuarioResource $resource
     * @param ResponseHandler $responseHandler
     */
    public function __construct(
        UsuarioResource $resource,
        ResponseHandler $responseHandler
    ) {
        $this->init($resource, $responseHandler);
    }

    /**
     * Endpoint action para pegar os dados de sessão.
     *
     * @Route(
     *      path="",
     *      methods={"GET"},
     *  )
     *
     * @Security("is_granted('ROLE_USER')")
     *
     * @RestApiDoc()
     *
     * @OA\Response(
     *      response=200,
     *      description="Usuario profile data"
     *  )
     *
     * @OA\Tag(name="Profile")
     *
     * @param Request               $request
     * @param TokenStorageInterface $tokenStorage
     * @param ParameterBagInterface $parameterBag
     *
     * @return Response
     *
     * @throws Throwable
     */
    public function profileAction(
        Request $request,
        TokenStorageInterface $tokenStorage,
        ParameterBagInterface $parameterBag,
        ManagerRegistry $managerRegistry,
        LoggerInterface $logger
    ): Response {
        $allowedHttpMethods = ['GET'];

        // Make sure that we have everything we need to make this work
        $this->validateRestMethod($request, $allowedHttpMethods);

        try {
            $populate = [
                'vinculacoesRoles',
                'imgPerfil',
                'colaborador',
                'colaborador.lotacoes',
                'colaborador.lotacoes.setor',
                'colaborador.lotacoes.setor.unidade',
                'colaborador.lotacoes.setor.unidade.modalidadeOrgaoCentral',
                'colaborador.modalidadeColaborador',
                'colaborador.cargo',
                'vinculacoesUsuariosPrincipais',
                'vinculacoesUsuariosPrincipais.usuario',
                'vinculacoesPessoasUsuarios',
                'vinculacoesPessoasUsuarios.pessoa',
                'coordenadores',
                'coordenadores.unidade',
                'coordenadores.orgaoCentral',
                'coordenadores.setor',
                'coordenadores.setor.unidade',
            ];

            $request->request->set(
                'populate',
                '["imgPerfil", "vinculacoesRoles", "colaborador", "colaborador.lotacoes", 
                "colaborador.lotacoes.setor","colaborador.lotacoes.setor.especieSetor",
                "colaborador.lotacoes.setor.unidade", 
                "colaborador.lotacoes.setor.unidade.modalidadeOrgaoCentral",
                "colaborador.modalidadeColaborador", "colaborador.cargo", "vinculacoesUsuariosPrincipais",
                "vinculacoesUsuariosPrincipais.usuario", "vinculacoesPessoasUsuarios", 
                "vinculacoesPessoasUsuarios.pessoa", "coordenadores", "coordenadores.orgaoCentral",
                "coordenadores.setor", "coordenadores.unidade", "coordenadores.setor.unidade"]'
            );

            $mercureSecret = $parameterBag->get('mercure_jwt_secret');

            $token = (new JWTBuilder(new JoseEncoder(), new MicrosecondBasedDateConversion()))
                ->withClaim('mercure', [
                    'subscribe' => [
                        $tokenStorage->getToken()->getUser()->getUserIdentifier(),
                        '/{versao}/{modulo}/{resource}/{id}',
                        '/assinador/'.$tokenStorage->getToken()->getUser()->getUserIdentifier(),
                    ],
                    'publish' => [
                        $tokenStorage->getToken()->getUser()->getUserIdentifier(),
                        '/assinador/'.$tokenStorage->getToken()->getUser()->getUserIdentifier(),
                    ],
                ])
                ->getToken(new Sha256(), InMemory::plainText($mercureSecret));

            $entityManager = $managerRegistry->getManager();

            if (!array_key_exists('pcu', $entityManager->getFilters()->getEnabledFilters())) {
                $entityManager->getFilters()->disable('pcu');
            }

            /** @var Usuario $usuario */
            $usuario = $this->getResource()->findOne($tokenStorage->getToken()->getUser()->getId(), $populate);

            if ($usuario->getColaborador()) {
                /** @var Lotacao $lotacao */
                foreach ($usuario->getColaborador()->getLotacoes() as $lotacao) {
                    if (!$lotacao->getSetor() || !$lotacao->getSetor()->getAtivo()) {
                        $usuario->getColaborador()->removeLotacao($lotacao);
                    }
                }
            }

            /** @var Coordenador $coordenador */
            foreach ($usuario->getCoordenadores() as $coordenador) {
                if ($coordenador->getSetor() && (!$coordenador->getSetor() || !$coordenador->getSetor()->getAtivo())) {
                    $usuario->removeCoordenador($coordenador);
                }
                if ($coordenador->getUnidade() &&
                    (!$coordenador->getUnidade() || !$coordenador->getUnidade()->getAtivo())) {
                    $usuario->removeCoordenador($coordenador);
                }
                if ($coordenador->getOrgaoCentral()
                    && (!$coordenador->getOrgaoCentral() || !$coordenador->getOrgaoCentral()->getAtivo())) {
                    $usuario->removeCoordenador($coordenador);
                }
            }

            $response = $this
                ->getResponseHandler()
                ->createResponse(
                    $request,
                    $usuario
                );

            $content = json_decode($response->getContent());
            $content->jwt = $token->toString();

            $response->setContent(
                json_encode($content)
            );

            return $response;
        } catch (Throwable $exception) {
            $logger->critical($exception->getMessage() . ' - ' . $exception->getTraceAsString());
            throw $this->handleRestMethodException($exception);
        }
    }
}
