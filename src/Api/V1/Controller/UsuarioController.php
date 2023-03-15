<?php

declare(strict_types=1);
/**
 * /src/Controller/UserController.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Controller;

use LogicException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use SuppCore\AdministrativoBackend\Annotation\RestApiDoc;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Usuario;
use SuppCore\AdministrativoBackend\Api\V1\Resource\UsuarioResource;
use SuppCore\AdministrativoBackend\Rest\Controller;
use SuppCore\AdministrativoBackend\Rest\RequestHandler;
use SuppCore\AdministrativoBackend\Rest\ResponseHandler;
use SuppCore\AdministrativoBackend\Rest\Traits\Actions;
use SuppCore\AdministrativoBackend\Transaction\Context;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;
use Twig\Environment;
use DateTime;

/**
 * @Route(path="/v1/administrativo/usuario")
 *
 * @OA\Tag(name="Usuario Management")
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @method UsuarioResource getResource()
 */
class UsuarioController extends Controller
{
    // Traits
    use Actions\User\FindOneAction;
    use Actions\User\FindAction;
    use Actions\Anon\CreateAction;
    use Actions\User\UpdateAction;
    use Actions\User\PatchAction;
    use Actions\Root\DeleteAction;
    use Actions\Colaborador\CountAction;

/** @noinspection MagicMethodsValidityInspection */

    /**
     * UsuarioController constructor.
     */
    public function __construct(
        UsuarioResource $resource,
        ResponseHandler $responseHandler,
        Environment $twig,
        MailerInterface $mailer,
    ) {
        $this->twig = $twig;
        $this->mailer = $mailer;
        $this->init($resource, $responseHandler);
    }

    /**
     * Endpoint action to alterar a senha.
     *
     * @Route(
     *      "/{id}/reseta_senha",
     *      requirements={
     *          "id" = "\d+",
     *      },
     *      methods={"PATCH"},
     *  )
     *
     * @Security("is_granted('ROLE_USER')")
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
    public function resetaSenhaAction(
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

            $usuarioResource = $this->getResource();
            $usuarioDTO = $usuarioResource->getDtoForEntity($id, Usuario::class);
            $usuarioEntity = $usuarioResource->resetaSenha($id, $usuarioDTO, $transactionId, true);

            $this->transactionManager->commit($transactionId);

            return $this->getResponseHandler()->createResponse($request, $usuarioEntity);
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception, $id);
        }
    }

    /**
     * Endpoint action para validar usuário.
     *
     * @Route(
     *      "/{cpf}/{token}/valida_usuario",
     *      methods={"PATCH"}
     *  )
     **
     * @RestApiDoc()
     *
     * @param string[]|null $allowedHttpMethods
     *
     * @throws Throwable
     */
    public function validaUsuarioAction(
        string $cpf,
        string $token,
        Request $request,
        ?array $allowedHttpMethods = null
    ): Response {
        $allowedHttpMethods ??= ['PATCH'];

        // Make sure that we have everything we need to make this work
        $this->validateRestMethod($request, $allowedHttpMethods);

        try {
            $usuarioResource = $this->getResource();

            $result = null;
            if (true === $usuarioResource->validarToken($cpf, $token)) {
                $transactionId = $this->transactionManager->begin();

                $context = RequestHandler::getContext($request);

                foreach ($context as $name => $value) {
                    $this->transactionManager->addContext(
                        new Context($name, $value),
                        $transactionId
                    );
                }

                $usuario = $usuarioResource->findOneBy(
                    [
                        'username' => $cpf,
                    ]
                );

                $usuarioDTO = new Usuario();
                $usuarioDTO->setEnabled(true);

                $result = $usuarioResource->validarUsuario($usuario->getId(), $usuarioDTO, $transactionId, true);
                $this->transactionManager->commit($transactionId);
            } else {
                $usuario = $usuarioResource->findOneBy(
                    [
                        'username' => $cpf,
                    ]
                );

                $dateTime = new DateTime();

                $token = hash('SHA256', $usuario->getUsername().''.$dateTime->format('Ymd'));

                $url = $this->parameterBag->get('supp_core.administrativo_backend.url_sistema_frontend')
                    .'/auth/activate/'.$usuario->getUsername().'/'.$token;
                $message = (new Email())
                    ->subject('Bem-vindo ao '.$this->parameterBag->get('supp_core.administrativo_backend.nome_sistema'))
                    ->from($this->parameterBag->get('supp_core.administrativo_backend.email_suporte'))
                    ->to($usuario->getEmail())
                    ->html(
                        $this->twig->render(
                            $this->parameterBag->get('supp_core.administrativo_backend.template_email_auto_cadastro'),
                            [
                                'sistema' => $this->parameterBag->get('supp_core.administrativo_backend.nome_sistema'),
                                'ambiente' => $this->parameterBag->get(
                                    'supp_core.administrativo_backend.kernel_environment_mapping'
                                )[$this->parameterBag->get('kernel.environment')],
                                'url' => $url,
                            ]
                        )
                    );

                $this->mailer->send($message);
                throw new HttpException(400, 'Token inválido. Novo token enviado para o email cadastrado');
            }

            return $this
                ->getResponseHandler()
                ->createResponse($request, $result);
        } catch (Throwable $exception) {
            throw $this->handleRestMethodException($exception);
        }
    }
}
