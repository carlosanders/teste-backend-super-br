<?php

declare(strict_types=1);
/**
 * /src/Api/V1/Triggers/Assinatura/Trigger0002.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Triggers\Assinatura;

use Exception;
use RuntimeException;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Assinatura;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\EARQ\EARQEventoPreservacaoLoggerInterface;
use SuppCore\AdministrativoBackend\Entity\Assinatura as AssinaturaEntity;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Security\LdapService;
use SuppCore\AdministrativoBackend\Security\LoginUnicoGovBrService;
use SuppCore\AdministrativoBackend\Triggers\TriggerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Process\Process;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Throwable;

/**
 * Class Trigger0002.
 *
 * @descSwagger=Caso seja assinatura A1 ocorrerá a assinatura com certificado institucional!
 * @classeSwagger=Trigger0002
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Trigger0002 implements TriggerInterface
{
    /**
     * Trigger0002 constructor.
     */
    public function __construct(
        private ParameterBagInterface $parameterBag,
        private RequestStack $requestStack,
        private UserPasswordHasherInterface $passwordHasher,
        private TokenStorageInterface $tokenStorage,
        private LdapService $ldapService,
        private LoginUnicoGovBrService $loginUnicoGovBrService,
        private EARQEventoPreservacaoLoggerInterface $eventoPreservacaoLogger
    ) {
    }

    public function supports(): array
    {
        return [
            Assinatura::class => [
                'beforeCreate',
                'skipWhenCommand',
            ],
        ];
    }

    /**
     * @param Assinatura|RestDtoInterface|null $restDto
     * @param AssinaturaEntity|EntityInterface $entity
     *
     * @throws Exception
     */
    public function execute(?RestDtoInterface $restDto, EntityInterface $entity, string $transactionId): void
    {
        $context = null;
        if (null !== $this->requestStack->getCurrentRequest()?->get('context')) {
            $context = json_decode($this->requestStack->getCurrentRequest()->get('context'));
        }

        if (isset($context->plainPassword)) {
            $plainPassword = $context->plainPassword;
        } else {
            $plainPassword = $restDto->getPlainPassword();
        }

        if (isset($plainPassword) &&
            $this->tokenStorage->getToken() &&
            $this->tokenStorage->getToken()->getUser()) {
            if (str_starts_with($plainPassword, 'interno://')) {
                $plainPassword = str_replace('interno://', '', $plainPassword);

                if (!$this->passwordHasher->isPasswordValid(
                    $this->tokenStorage->getToken()->getUser(),
                    $plainPassword
                )) {
                    throw new RuntimeException('Senha não confere!');
                }
            } elseif (str_starts_with($plainPassword, 'ldap://')) {
                try {
                    $plainPassword = str_replace('ldap://', '', $plainPassword);
                    $credentials = [];
                    $credentials['username'] = $this->tokenStorage->getToken()->getUser()->getEmail();
                    $credentials['password'] = $plainPassword;
                    $userData = $this->ldapService->getUserData($credentials['username'], $credentials['password']);
                } catch (Throwable) {
                    throw new RuntimeException('Senha não confere!');
                }

                if (!$userData) {
                    throw new RuntimeException('Senha não confere!');
                }

                // Verificando credênciais LDAP
                if (!$this->checkLdapCredentials($credentials, $userData['ldapUser'])) {
                    throw new RuntimeException('Senha não confere!');
                }
            } elseif (str_starts_with($plainPassword, 'govBr://')) {
                $tokenRevalidaGovBr = str_replace('govBr://', '', $plainPassword);
                $cpfUsuario = $this->tokenStorage->getToken()->getUser()->getUserIdentifier();

                if (!$this->loginUnicoGovBrService->decodeTokenRevalida($tokenRevalidaGovBr, $cpfUsuario)) {
                    throw new RuntimeException('Token de revalidação govBr inválido!');
                }
            }

            if ('A1' === $restDto->getAssinatura()) {
                $password = $this->parameterBag->get(
                    'supp_core.administrativo_backend.certificado_a1_institucional_password'
                );

                $certPathPfx = $this->parameterBag->get(
                    'supp_core.administrativo_backend.certificado_a1_institucional_pfx'
                );

                $hash = $restDto->getComponenteDigital()->getHash();

                $signerProxyParams = [];
                $signerProxy = $this->parameterBag->get('supp_core.administrativo_backend.signer_proxy');

                if ($signerProxy) {
                    $signerProxyParams = explode(' ', $signerProxy);
                }

                if ('dev' === $this->parameterBag->get('kernel.environment')) {
                    $params = [
                        'java',
                        '-jar',
                        '/app/docker/java/supp-signer-1.9.jar',
                        '--mode=test',
                        '--hash='.$hash,
                    ];
                } else {
                    $params = [
                        'java',
                        '-jar',
                        '/usr/local/bin/supp-signer-1.9.jar',
                        '--mode=sign',
                        '--certificate='.$certPathPfx,
                        '--password='.$password,
                        '--hash='.$hash,
                    ];
                }
                $process = new Process(
                    array_merge($params, $signerProxyParams)
                );

                $process->run();

                // executes after the command finishes
                if ($process->isSuccessful()) {
                    $filenameSign = '/tmp/'.$hash.'.p7s';
                    $signature = file_get_contents($filenameSign);
                    unlink($filenameSign);
                    $filenamePem = '/tmp/'.$hash.'.pem';
                    $cadeiaPEM = file_get_contents($filenamePem);
                    unlink($filenamePem);
                    $filenameDer = '/tmp/'.$hash.'.der';
                    $cadeiaDER = file_get_contents($filenameDer);
                    unlink($filenameDer);

                    $this->eventoPreservacaoLogger->logEPRES3AssinaturaValida($restDto->getComponenteDigital());
                } else {
                    $this->eventoPreservacaoLogger->logEPRES3AssinaturaInvalida($restDto->getComponenteDigital());
                    throw new RuntimeException('Erro na assinatura digital!');
                }
                $restDto->setAssinatura(base64_encode($signature));
                $restDto->setCadeiaCertificadoPEM($cadeiaPEM);
                $restDto->setCadeiaCertificadoPkiPath($cadeiaDER);
                $restDto->setAlgoritmoHash('SHA256WITHRSA');
            }
        }
    }

    /**
     * Verifica as credênciais do usuário.
     *
     * @param mixed         $credentials
     * @param UserInterface $user
     *
     * @return bool
     */
    public function checkLdapCredentials(mixed $credentials, UserInterface $user): bool
    {
        if ($this->ldapService::TYPE_AUTH_AD) {
            return true;
        }

        return $credentials['password'] === $user->getPassword();
    }

    public function getOrder(): int
    {
        return 1;
    }
}
