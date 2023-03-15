<?php

declare(strict_types=1);
/**
 * /src/Controller/AuthController.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Controller;

use DateInterval;
use DateTime;
use Doctrine\Common\Annotations\AnnotationException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\Exception\ORMException;
use Exception;
use InvalidArgumentException;
use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\Encoding\MicrosecondBasedDateConversion;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Token\Builder as JWTBuilder;
use Lcobucci\JWT\Token\Parser as JWTParser;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Events;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\InvalidPayloadException;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationSuccessResponse;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use LogicException;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Annotations as OA;
use Psr\Log\LoggerInterface;
use ReflectionException;

use function sprintf;

use SuppCore\AdministrativoBackend\Api\V1\DTO\Usuario;
use SuppCore\AdministrativoBackend\Api\V1\Resource\UsuarioResource;
use SuppCore\AdministrativoBackend\Rest\Controller;
use SuppCore\AdministrativoBackend\Rest\ResponseHandler;
use SuppCore\AdministrativoBackend\Security\RolesService;
use SuppCore\AdministrativoBackend\Transaction\TransactionManager;
use SuppCore\AdministrativoBackend\Utils\JSON;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Process\Process;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Validator\Exception\ValidatorException;
use Throwable;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class AuthController.
 *
 * @Route(
 *      path="/auth",
 *  )
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class AuthController extends Controller
{
    /**
     * Endpoint action to get user Json Web Token (JWT) for authentication.
     *
     * @Route(
     *      path="/get_token",
     *      methods={"POST"},
     *  );
     *
     * @OA\Post()
     *
     * @OA\RequestBody(
     *      description="Credentials object",
     *      required=true,
     *     @OA\MediaType(
     *         mediaType="application/json",
     *         @OA\Schema(
     *              type="object",
     *              example={"username": "username", "password": "password"}
     *          )
     *     )
     *  )
     * @OA\Response(
     *      response=200,
     *      description="JSON Web Token for user",
     *     @OA\MediaType(
     *         mediaType="application/json",
     *         @OA\Schema(
     *              type="object",
     *              example={"token": "_json_web_token_"},
     *              @OA\Property(property="token", type="string", description="Json Web Token")
     *          )
     *     )
     *  )
     * @OA\Response(
     *      response=400,
     *      description="Bad Request",
     *      @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              type="object",
     *              example={"code": 400, "message": "Bad Request"},
     *              @OA\Property(property="code", type="integer", description="Error code"),
     *              @OA\Property(property="message", type="string", description="Error description"),
     *          )
     *      )
     *  )
     * @OA\Response(
     *      response=401,
     *      description="Unauthorized",
     *      @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              type="object",
     *              example={"code": 401, "message": "Bad credentials"},
     *              @OA\Property(property="code", type="integer", description="Error code"),
     *              @OA\Property(property="message", type="string", description="Error description"),
     *          )
     *      )
     *  )
     * @OA\Tag(name="Authentication")
     *
     * @throws LogicException
     * @throws HttpException
     */
    public function getTokenAction(): void
    {
        $message = sprintf(
            'You need to send JSON body to obtain token eg. %s',
            JSON::encode(['username' => 'username', 'password' => 'password'])
        );

        throw new HttpException(400, $message);
    }

    /**
     * Endpoint action to refresh user Json Web Token (JWT) for authentication.
     *
     * @Route(
     *      path="/refresh_token",
     *      methods={"GET"},
     *  );
     *
     * @Security(name="Bearer")
     *
     * @OA\Response(
     *      response=200,
     *      description="JSON Web Token for user",
     *      @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              type="object",
     *              example={"token": "_json_web_token_"},
     *              @OA\Property(property="token", type="string", description="Json Web Token"),
     *          )
     *      )
     *  )
     *
     * @OA\Response(
     *      response=401,
     *      description="Unauthorized",
     *      @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              type="object",
     *              example={"code": 401, "message": "Bad credentials"},
     *              @OA\Property(property="code", type="integer", description="Error code"),
     *              @OA\Property(property="message", type="string", description="Error description"),
     *          )
     *      )
     *  )
     *
     * @OA\Tag(name="Authentication")
     *
     * @throws Throwable
     */
    public function refreshTokenAction(
        Request $request,
        TokenStorageInterface $tokenStorage,
        JWTTokenManagerInterface $jwtManager,
        EventDispatcherInterface $dispatcher,
        ?array $allowedHttpMethods = null
    ): Response {
        $allowedHttpMethods ??= ['GET'];

        // Make sure that we have everything we need to make this work
        $this->validateRestMethod($request, $allowedHttpMethods);

        try {
            $user = $tokenStorage->getToken()->getUser();
            $jwt = $jwtManager->create($user);
            $response = new JWTAuthenticationSuccessResponse($jwt);
            $event = new AuthenticationSuccessEvent(['token' => $jwt], $user, $response);

            $dispatcher->dispatch($event, Events::AUTHENTICATION_SUCCESS);

            $response->setData($event->getData());

            return $response;
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception);
        }
    }

    /**
     * Endpoint action to get payload from Json Web Token (JWT).
     *
     * @Route(
     *      path="/payload_token",
     *      methods={"GET"},
     *  );
     *
     * @Security(name="Bearer")
     *
     * @OA\Response(
     *      response=200,
     *      description="JSON payload from Web Token",
     *     @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              type="object",
     *              example={"iat": 1580837366, "roles": "","username": "","ip": "","version": "","exp": 1580823797,"checksum": "","id": 0,"nome": "","email": ""},
     *              @OA\Property(property="iat", type="integer", description="token creation"),
     *              @OA\Property(property="username", type="string", description="User name"),
     *              @OA\Property(
     *                   property="roles",
     *                  type="array",
     *                  @OA\Items(
     *                      type="object",
     *                      @OA\Property(property="role", type="string", ),
     *                  ),
     *              ),
     *              @OA\Property(property="version", type="string", description="Version API"),
     *              @OA\Property(property="exp", type="string", description="Version API"),
     *              @OA\Property(property="checksum", type="string", description="Hash of api key"),
     *              @OA\Property(property="id", type="integer", description="User id"),
     *              @OA\Property(property="nome", type="string", description="User name"),
     *              @OA\Property(property="email", type="string", description="User email"),
     *          )
     *      )
     *  )
     *
     * @OA\Response(
     *      response=401,
     *      description="Unauthorized",
     *     @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              type="object",
     *              example={"code": 401, "message": "Bad credentials"},
     *              @OA\Property(property="code", type="integer", description="Error code"),
     *              @OA\Property(property="message", type="string", description="Error description"),
     *          )
     *      )
     *  )
     *
     * @OA\Tag(name="Authentication")
     *
     * @throws Throwable
     */
    public function payloadTokenAction(
        Request $request,
        JWTTokenManagerInterface $jwtManager,
        EventDispatcherInterface $dispatcher,
        ?array $allowedHttpMethods = null
    ): Response {
        $allowedHttpMethods ??= ['GET'];

        // Make sure that we have everything we need to make this work
        $this->validateRestMethod($request, $allowedHttpMethods);
        try {
            $params = $request->headers->all()['authorization'][0];
            $token = explode(' ', $params)[1];
            $jws = (new JWTParser(new JoseEncoder()))->parse($token);
            $jsonResponse = json_encode($jws->claims()->all());
            $response = new Response();
            $response->setContent($jsonResponse);

            return $response;
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception);
        }
    }

    /**
     * Endpoint to get an e-mail to recover password.
     *
     * @Route(
     *      path="/recover_password",
     *      methods={"POST"},
     *  );
     *
     * @OA\RequestBody(
     *      description="Credentials object",
     *      required=true,
     *     @OA\MediaType(
     *         mediaType="application/json",
     *         @OA\Schema(
     *              @OA\Property(property="username", type="string", description="Username CPF/CNPJ"),
     *              @OA\Property(property="email", type="string", description="Username E-Mail"),
     *          )
     *     )
     *  )
     *
     * @OA\Response(
     *      response=200,
     *      description="Success Response"
     *  )
     *
     * @OA\Response(
     *      response=401,
     *      description="Unauthorized",
     *      @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              type="object",
     *              example={"code": 401, "message": "Bad credentials"},
     *              @OA\Property(property="code", type="integer", description="Error code"),
     *              @OA\Property(property="message", type="string", description="Error description"),
     *          )
     *      )
     *  )
     *
     * @OA\Tag(name="Authentication")
     *
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws TransportExceptionInterface
     */
    public function recoverPasswordAction(
        Request $request,
        ParameterBagInterface $parameterBag,
        UsuarioResource $usuarioResource,
        Environment $twig,
        MailerInterface $mailer,
        ?array $allowedHttpMethods = null
    ): Response {
        $allowedHttpMethods ??= ['POST'];
        // Make sure that we have everything we need to make this work
        $this->validateRestMethod($request, $allowedHttpMethods);
        $this->validateLoginType('login_interno_ativo', $parameterBag);

        $response = new Response();

        if (!$request->get('username') || !$request->get('email')) {
            $response->setStatusCode(400);
            $response->setContent('Invalid JSON');

            return $response;
        }
        $usuario = $usuarioResource->findOneBy(
            ['username' => $request->get('username'), 'email' => $request->get('email')]
        );
        if (!$usuario) {
            $response->setStatusCode(404);
            $response->setContent('User Not found');

            return $response;
        }

        $dateTime = new DateTime();
        $token = hash(
            'SHA256',
            $usuario->getUsername().'_'.
            $usuario->getEmail().'_'.
            $dateTime->format('Ymd').'_'.
            $parameterBag->get('token_auth')
        );

        $url = $parameterBag->get('supp_core.administrativo_backend.url_sistema_backend').
            '/auth/recover_password?username='.$usuario->getUsername().
            '&email='.$usuario->getEmail().
            '&reset_token='.$token;

        $message = (new Email())
            ->subject('Recuperação de senha no '.$parameterBag
                ->get('supp_core.administrativo_backend.nome_sistema'))
            ->from($parameterBag->get('supp_core.administrativo_backend.email_suporte'))
            ->to($usuario->getEmail())
            ->html(
                $twig->render(
                    $parameterBag->get('supp_core.administrativo_backend.template_email_recupera_senha'),
                    [
                        'sistema' => $parameterBag->get('supp_core.administrativo_backend.nome_sistema'),
                        'ambiente' => $parameterBag->get(
                            'supp_core.administrativo_backend.kernel_environment_mapping'
                        )[$parameterBag->get('kernel.environment')],
                        'urlreset' => $url,
                    ]
                )
            );

        $mailer->send($message);

        return $response;
    }

    /**
     * Endpoint to validate token and reset password.
     *
     * @Route(
     *      path="/recover_password",
     *      methods={"GET"},
     *  );
     *
     * @OA\Parameter(
     *      name="username",
     *      in="query",
     *      description="Username CNPJ/CPF",
     *      required=true,
     *      @OA\Schema(
     *          type="string"
     *      )
     *  )
     * @OA\Parameter(
     *      name="email",
     *      in="query",
     *      description="Username E-Mail",
     *      required=true,
     *      @OA\Schema(
     *          type="string"
     *      )
     *  )
     * @OA\Parameter(
     *      name="reset_token",
     *      in="query",
     *      description="reset_token",
     *      required=true,
     *      @OA\Schema(
     *          type="string"
     *      )
     *  )
     *
     * @OA\Response(
     *      response=200,
     *      description="Success Response"
     *  )
     *
     * @OA\Tag(name="Authentication")
     *
     * @throws AnnotationException
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws ReflectionException
     * @throws Exception
     */
    public function recoverPasswordResetAction(
        Request $request,
        ParameterBagInterface $parameterBag,
        UsuarioResource $usuarioResource,
        TransactionManager $transactionManager,
        AuthorizationCheckerInterface $authorizationChecker,
        TokenStorageInterface $tokenStorage,
        RolesService $rolesService,
        ?array $allowedHttpMethods = null
    ): Response {
        $allowedHttpMethods = ['GET'];

        $this->validateRestMethod($request, $allowedHttpMethods);
        $this->validateLoginType('login_interno_ativo', $parameterBag);

        $response = new Response();

        if (!$request->get('username') ||
            !$request->get('email') ||
            !$request->get('reset_token')
        ) {
            $response->setStatusCode(400);
            $response->setContent('Invalid Query Params');

            return $response;
        }
        $usuario = $usuarioResource->findOneBy(
            ['username' => $request->get('username'), 'email' => $request->get('email')]
        );
        if (!$usuario) {
            $response->setStatusCode(404);
            $response->setContent('User Not found');

            return $response;
        }

        $dateTime = new DateTime();
        $realToken = hash(
            'SHA256',
            $usuario->getUsername().'_'.
            $usuario->getEmail().'_'.
            $dateTime->format('Ymd').'_'.
            $parameterBag->get('token_auth')
        );

        if ($request->get('reset_token') != $realToken) {
            $response->setStatusCode(401);
            $response->setContent('Invalid Token');

            return $response;
        }

        if (false === $authorizationChecker->isGranted('IS_AUTHENTICATED_FULLY')) {
            $token = new UsernamePasswordToken(
                $usuario,
                $usuario->getPassword(),
                $rolesService->getContextualRoles($usuario)
            );
            $tokenStorage->setToken($token);
        }

        $dto = $usuarioResource->getDtoForEntity($usuario->getId(), Usuario::class);

        $transactionId = $transactionManager->begin();
        $usuarioResource->resetaSenha($usuario->getId(), $dto, $transactionId, true);
        $transactionManager->commit($transactionId);

        $response->setContent('Password resetado e enviado para o e-mail com sucesso!.');

        return $response;
    }

    /**
     * Endpoint action to get user Json Web Token (JWT) for authentication with x509 cert.
     *
     * @Route(
     *      path="/x509_get_token",
     *      methods={"GET"},
     *  );
     *
     * @OA\Response(
     *      response=200,
     *      description="JSON Web Token for user",
     *     @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              type="object",
     *              example={"token": "_json_web_token_"},
     *              @OA\Property(property="token", type="string", description="Json Web Token"),
     *          )
     *      )
     *  )
     *
     * @OA\Response(
     *      response=401,
     *      description="Unauthorized",
     *     @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              type="object",
     *              example={"code": 401, "message": "Bad credentials"},
     *              @OA\Property(property="code", type="integer", description="Error code"),
     *              @OA\Property(property="message", type="string", description="Error description"),
     *          )
     *      )
     *  )
     *
     * @OA\Tag(name="Authentication")
     *
     * @throws Throwable
     */
    public function getTokenX509Action(
        Request $request,
        TokenStorageInterface $tokenStorage,
        JWTTokenManagerInterface $jwtManager,
        EventDispatcherInterface $dispatcher,
        AuthorizationCheckerInterface $authorizationChecker,
        ?array $allowedHttpMethods = null
    ): Response {
        $allowedHttpMethods ??= ['GET'];

        // Make sure that we have everything we need to make this work
        $this->validateRestMethod($request, $allowedHttpMethods);

        try {
            if (!$tokenStorage->getToken() ||
                !$authorizationChecker->isGranted('ROLE_X509')) {
                throw new BadCredentialsException('Erro no login por certificado digital!');
            }

            $user = $tokenStorage->getToken()->getUser();

            $jwt = $jwtManager->create($user);
            $agora = new DateTime();
            $exp = clone $agora;
            $exp->add(new DateInterval(
                'PT'.$this->parameterBag->get('supp_core.administrativo_backend.jwt_exp').'S'
            ));

            return new RedirectResponse($this->parameterBag->get('supp_core.administrativo_backend.url_sistema_frontend').'/auth/login?token='.$jwt.'&exp='.$exp->getTimestamp().'&timestamp='.$agora->getTimestamp());
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception);
        }
    }

    /**
     * Endpoint action to authenticate user from GovBr.
     *
     * @Route(
     *      path="/govbr_get_token",
     *      methods={"POST"},
     *  );
     *
     * @OA\RequestBody(
     *      description="Credentials object",
     *      required=true,
     *     @OA\MediaType(
     *         mediaType="application/json",
     *         @OA\Schema(
     *              type="object",
     *              example={"code": "code"}
     *          )
     *     )
     *  )
     * @OA\Response(
     *      response=200,
     *      description="JSON Web Token for user",
     *     @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              type="object",
     *              example={"token": "_json_web_token_"},
     *              @OA\Property(property="token", type="string", description="Json Web Token"),
     *          )
     *      )
     *  )
     * @OA\Response(
     *      response=400,
     *      description="Bad Request",
     *     @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              type="object",
     *              example={"code": 400, "message": "Bad Request"},
     *              @OA\Property(property="code", type="integer", description="Error code"),
     *              @OA\Property(property="message", type="string", description="Error description"),
     *          )
     *      )
     *  )
     * @OA\Response(
     *      response=401,
     *      description="Unauthorized",
     *      @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              type="object",
     *              example={"code": 401, "message": "Bad credentials"},
     *              @OA\Property(property="code", type="integer", description="Error code"),
     *              @OA\Property(property="message", type="string", description="Error description"),
     *          )
     *      )
     *  )
     * @OA\Tag(name="Authentication")
     *
     * @throws Throwable
     */
    public function ssoGovBrAction(
        Request $request,
        TokenStorageInterface $tokenStorage,
        ParameterBagInterface $parameterBag,
        JWTTokenManagerInterface $jwtManager,
        EventDispatcherInterface $dispatcher,
        ?array $allowedHttpMethods = null
    ): Response {
        $allowedHttpMethods ??= ['POST'];
        $this->validateRestMethod($request, $allowedHttpMethods);

        try {
            $user = $tokenStorage->getToken()->getUser();
            $jwt = $jwtManager->create($user);
            $response = new JWTAuthenticationSuccessResponse($jwt);
            $event = new AuthenticationSuccessEvent(['token' => $jwt], $user, $response);

            $dispatcher->dispatch($event, Events::AUTHENTICATION_SUCCESS);
            $response->setData($event->getData());

            return $response;
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception);
        }
    }

    /**
     * Endpoint action to authenticate user from LDAP.
     *
     * @Route(
     *      path="/ldap_get_token",
     *      methods={"POST"},
     *  );
     *
     * @OA\RequestBody(
     *      description="Credentials object",
     *      required=true,
     *     @OA\MediaType(
     *         mediaType="application/json",
     *         @OA\Schema(
     *              type="object",
     *              example={"username": "username", "password": "password"}
     *          )
     *     )
     *  )
     *
     * @OA\Response(
     *      response=200,
     *      description="JSON Web Token for user",
     *      @OA\MediaType(
     *         mediaType="application/json",
     *         @OA\Schema(
     *              type="object",
     *              example={"token": "_json_web_token_"},
     *              @OA\Property(property="token", type="string", description="Json Web Token"),
     *          )
     *      )
     *  )
     * @OA\Response(
     *      response=400,
     *      description="Bad Request",
     *      @OA\MediaType(
     *         mediaType="application/json",
     *         @OA\Schema(
     *              type="object",
     *              example={"code": 400, "message": "Bad Request"},
     *              @OA\Property(property="code", type="integer", description="Error code"),
     *              @OA\Property(property="message", type="string", description="Error description"),
     *          )
     *      )
     *  )
     * @OA\Response(
     *      response=401,
     *      description="Unauthorized",
     *      @OA\MediaType(
     *         mediaType="application/json",
     *         @OA\Schema(
     *              type="object",
     *              example={"code": 401, "message": "Bad credentials"},
     *              @OA\Property(property="code", type="integer", description="Error code"),
     *              @OA\Property(property="message", type="string", description="Error description"),
     *          )
     *      )
     *  )
     * @OA\Tag(name="Authentication")
     *
     * @throws Throwable
     */
    public function getTokenLdapAction(
        Request $request,
        TokenStorageInterface $tokenStorage,
        JWTTokenManagerInterface $jwtManager,
        EventDispatcherInterface $dispatcher,
        ?array $allowedHttpMethods = null
    ): Response {
        $allowedHttpMethods ??= ['POST'];
        $this->validateRestMethod($request, $allowedHttpMethods);

        try {
            $user = $tokenStorage->getToken()->getUser();
            $jwt = $jwtManager->create($user);
            $response = new JWTAuthenticationSuccessResponse($jwt);
            $event = new AuthenticationSuccessEvent(['token' => $jwt], $user, $response);

            $dispatcher->dispatch($event, Events::AUTHENTICATION_SUCCESS);
            $response->setData($event->getData());

            return $response;
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception);
        }
    }

    /**
     * Endpoint action to get user's signer Json Web Token (JWT) for authentication.
     *
     * @Route(
     *      path="/assinador_get_token",
     *      methods={"POST"},
     *  );
     *
     * @OA\Post()
     *
     * @OA\RequestBody(
     *      description="Credentials object",
     *      required=true,
     *     @OA\MediaType(
     *         mediaType="application/json",
     *         @OA\Schema(
     *              type="object",
     *              example={"username": "username", "signature": "signature"}
     *          )
     *     )
     *  )
     * @OA\Response(
     *      response=200,
     *      description="JSON Web Token for user's signer",
     *     @OA\MediaType(
     *         mediaType="application/json",
     *         @OA\Schema(
     *              type="object",
     *              example={"jwt": "_json_web_token_"},
     *              @OA\Property(property="token", type="string", description="Json Web Token")
     *          )
     *     )
     *  )
     * @OA\Response(
     *      response=400,
     *      description="Bad Request",
     *      @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              type="object",
     *              example={"code": 400, "message": "Bad Request"},
     *              @OA\Property(property="code", type="integer", description="Error code"),
     *              @OA\Property(property="message", type="string", description="Error description"),
     *          )
     *      )
     *  )
     * @OA\Response(
     *      response=401,
     *      description="Unauthorized",
     *      @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              type="object",
     *              example={"code": 401, "message": "Bad credentials"},
     *              @OA\Property(property="code", type="integer", description="Error code"),
     *              @OA\Property(property="message", type="string", description="Error description"),
     *          )
     *      )
     *  )
     * @OA\Tag(name="Authentication")
     *
     * @throws LogicException
     * @throws HttpException|Throwable
     */
    public function getAssinadorTokenAction(
        Request $request,
        ParameterBagInterface $parameterBag,
        UsuarioResource $usuarioResource,
        LoggerInterface $logger
    ): Response {
        try {
            $datetime = new DateTime();
            $username = $request->get('username');
            $assinatura = base64_decode($request->get('signature'));
            $hash = hash('sha256', $username.'_'.$datetime->format('Ymd'));

            $signerProxyParams = [];
            $signerProxy = $this->parameterBag->get('supp_core.administrativo_backend.signer_proxy');

            if ($signerProxy) {
                $signerProxyParams = explode(' ', $signerProxy);
            }
            $filename = '/tmp/'.$hash.'.p7s';
            file_put_contents($filename, $assinatura);
            $params = [
                'java',
                '-jar',
                '/usr/local/bin/supp-signer-1.9.jar',
                '--mode=verify',
                '--hash='.$hash,
            ];
            $process = new Process(
                array_merge($params, $signerProxyParams)
            );
            $process->run();
            unlink($filename);

            // executes after the command finishes
            $valid = $process->isSuccessful();

            $result = $process->getOutput();

            if (!$valid) {
                throw new BadRequestHttpException('Dados não conferem!', null, 401);
            }

            $usernames = [];

            preg_match_all('/CPF:[0-9]{3}\.?[0-9]{3}\.?[0-9]{3}\.?\-?[0-9]{2}:|CNPJ:[0-9]{2}\.?[0-9]{3}\.?[0-9]{3}\/?[0-9]{4}\-?[0-9]{2}:/', $result, $usernames);

            if (!isset($usernames[0][0])) {
                throw new BadRequestHttpException('Dados não conferem!', null, 401);
            }

            $username = preg_replace('/\D/', '', $usernames[0][0]);

            $usuario = $usuarioResource->findOneBy(
                ['username' => $username]
            );

            if (!$usuario || !$usuario->getEnabled()) {
                throw new BadRequestHttpException('Dados não conferem!', null, 401);
            }

            $mercureSecret = $parameterBag->get('mercure_jwt_secret');

            $token = (new JWTBuilder(new JoseEncoder(), new MicrosecondBasedDateConversion()))
                ->withClaim('mercure', [
                    'subscribe' => [
                        $username,
                        '/{versao}/{modulo}/{resource}/{id}',
                        '/assinador/'.$username,
                    ],
                    'publish' => [
                        $username,
                        '/assinador/'.$username,
                    ],
                ])
                ->getToken(new Sha256(), InMemory::plainText($mercureSecret));

            $response = [
              'jwt' => $token->toString(),
            ];

            return new JsonResponse(
                $response
            );
        } catch (Throwable $exception) {
            $logger->critical($exception->getMessage().' - '.$exception->getTraceAsString());
            throw $this->handleRestMethodException($exception);
        }
    }

    private function validateLoginType(string $loginType, ParameterBagInterface $parameterBag)
    {
        if (!$parameterBag->get('supp_core.administrativo_backend.'.$loginType)) {
            throw new Exception("Tipo de Login '$loginType' desativado");
        }
    }

    /**
     * Endpoint to alter password.
     *
     * @Route(
     *      path="/update_password",
     *      methods={"POST"},
     *  );
     * @OA\Post()
     *
     * @OA\RequestBody(
     *      description="content",
     *      required=true,
     *     @OA\MediaType(
     *         mediaType="application/json",
     *         @OA\Schema(
     *              type="object",
     *              example={"old_password": "old_password", "new_password": "new_password", "token": "token"}
     *          )
     *     )
     *  )
     *
     * @OA\Response(
     *      response=200,
     *      description="Success Response"
     *  )
     *
     * @OA\Tag(name="Authentication")
     *
     * @param Request                  $request
     * @param UsuarioResource          $usuarioResource
     * @param TokenStorageInterface    $tokenStorage
     * @param EventDispatcherInterface $eventDispatcher
     * @param ResponseHandler          $responseHandler
     * @param JWTTokenManagerInterface $jwtManager
     *
     * @return Response
     *
     * @throws Throwable
     */
    public function alterarSenhaAction(
        Request $request,
        UsuarioResource $usuarioResource,
        TokenStorageInterface $tokenStorage,
        RolesService $rolesService,
        ResponseHandler $responseHandler,
        JWTTokenManagerInterface $jwtManager
    ): Response {
        try {
            $id = null;

            if (!$request->get('old_password') ||
                !$request->get('new_password') ||
                !$request->get('token')
            ) {
                throw new InvalidArgumentException('Invalid Query Params');
            }

            $request->attributes->set('ignore_expired_password', true);

            // Mechanism for jwt token validation
            $payload = $jwtManager->parse($request->get('token'));
            $idClaim = $jwtManager->getUserIdClaim();

            if (!isset($payload[$idClaim])) {
                throw new InvalidPayloadException($idClaim);
            }

            if ('login' !== $payload['authProviderKey']) {
                throw new ValidatorException('Alteração de senha disponível apenas para autenticação com usuário e senha.');
            }

            $usuario = $usuarioResource->getRepository()->findUserByUsernameOrEmail($payload[$idClaim]);

            if (!$usuario) {
                $tokenStorage->setToken(null);
                throw new NotFoundHttpException('User not found');
            }

            $token = new UsernamePasswordToken(
                $usuario, $payload['authProviderKey'],
                $rolesService->getContextualRoles($usuario)
            );

            $tokenStorage->setToken($token);

            $id = $usuario->getId();
            $transactionId = $this->transactionManager->begin();
            $responseHandler->setResource($usuarioResource);
            /** @var Usuario $dto */
            $dto = $usuarioResource->getDtoForEntity($usuario->getId(), Usuario::class);

            $dto->setPlainPassword($request->get('new_password'));
            $dto->setCurrentPlainPassword($request->get('old_password'));

            $response = $responseHandler
                ->createResponse($request, $usuarioResource->alterarSenha($id, $dto, $transactionId));

            $this->transactionManager->commit($transactionId);

            return $response;
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception, $id);
        }
    }
}
