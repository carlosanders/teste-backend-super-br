<?php

declare(strict_types=1);
/**
 * /src/Security/ApiKeyAuthenticator.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Security;

use function array_filter;
use function count;
use function current;
use Exception;
use InvalidArgumentException;
use function preg_match;
use function sprintf;
use SuppCore\AdministrativoBackend\Entity\ApiKey;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\PreAuthenticatedToken;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\ChainUserProvider;
use Symfony\Component\Security\Core\User\UserProviderInterface;

/**
 * Class ApiKeyAuthenticator.
 *
 * @see https://symfony.com/doc/current/security/api_key_authentication.html
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class ApiKeyAuthenticator
{
    /**
     * Method to create PreAuthenticatedToken if following header is present in current request:
     *  Authorization: ApiKey _some_token_.
     *
     * @param Request $request
     * @param string  $providerKey
     *
     * @return PreAuthenticatedToken|null
     */
    public function createToken(Request $request, $providerKey): ?PreAuthenticatedToken
    {
        // Look up 'Authorization' header from current request
        /** @var string $apiKey */
        $apiKey = $request->headers->get('Authorization', '');

        // Authorization header found and it contains 'ApiKey TOKEN' data, so we can make PreAuthenticatedToken
        if ($apiKey && preg_match('#^ApiKey (\w+)$#', $apiKey, $matches)) {
            /** @var array $matches */
            $output = new PreAuthenticatedToken('anon', $matches[1], $providerKey);
        }

        return $output ?? null;
    }

    /**
     * Check that current token is supported within this authenticator.
     *
     * @param TokenInterface $token
     * @param string         $providerKey
     *
     * @return bool
     */
    public function supportsToken(TokenInterface $token, $providerKey): bool
    {
        return $token instanceof PreAuthenticatedToken && $token->getFirewallName() === $providerKey;
    }

    /**
     * Method to authenticate current token and load user information according to that token. Note that in this point
     * we have multiple user providers so we need to filter those.
     *
     * After that we can try to fetch actual ApiKey entity for current token credentials, which is created within
     * 'createToken' method.
     *
     * Then if ApiKey entity for that credentials is found we can load actual user and create new PreAuthenticatedToken
     * with proper data and return it.
     *
     * @param TokenInterface                          $tokenInterface
     * @param UserProviderInterface|ChainUserProvider $userProvider
     * @param string                                  $providerKey
     *
     * @return PreAuthenticatedToken
     *
     * @throws Exception
     * @throws InvalidArgumentException
     * @throws AuthenticationException
     * @throws CustomUserMessageAuthenticationException
     * @throws UserNotFoundException
     */
    public function authenticateToken(
        TokenInterface $tokenInterface,
        UserProviderInterface $userProvider,
        $providerKey
    ): PreAuthenticatedToken {
        if (!($userProvider instanceof ChainUserProvider)) {
            $message = sprintf(
                'User provider must be instance of \'%s\' class',
                ChainUserProvider::class
            );

            throw new InvalidArgumentException($message);
        }

        $apiKeyProvider = $this->getProvider($userProvider);
        $token = $tokenInterface->getCredentials();
        $apiKey = $apiKeyProvider->getApiKeyForToken($token);

        return $this->getPreAuthenticatedToken($apiKeyProvider, $providerKey, $token, $apiKey);
    }

    /**
     * Getter method for API Key provider.
     *
     * @param ChainUserProvider $userProvider
     *
     * @return ApiKeyUserProvider
     *
     * @throws Exception
     * @throws AuthenticationException
     */
    private function getProvider(ChainUserProvider $userProvider): ApiKeyUserProvider
    {
        /**
         * Lambda function to filter user providers.
         *
         * @param UserProviderInterface $userProvider
         *
         * @return bool
         */
        $filter = fn (UserProviderInterface $userProvider): bool => $userProvider instanceof ApiKeyUserProvider;

        // Oh noes, we don't have ApiKeyUserProvider
        if (1 !== count($providers = array_filter($userProvider->getProviders(), $filter))) {
            throw new AuthenticationException('The user provider must be an instance of ApiKeyUserProvider');
        }

        return current($providers);
    }

    /**
     * @param ApiKeyUserProvider $apiKeyProvider
     * @param string             $providerKey
     * @param string             $token
     * @param ApiKey|null        $apiKey
     *
     * @return PreAuthenticatedToken
     *
     * @throws Exception
     * @throws UserNotFoundException
     * @throws CustomUserMessageAuthenticationException
     */
    private function getPreAuthenticatedToken(
        ApiKeyUserProvider $apiKeyProvider,
        string $providerKey,
        string $token,
        ?ApiKey $apiKey = null
    ): PreAuthenticatedToken {
        /*
         * Token not found, so cannot continue
         *
         * CAUTION: this message will be returned to the client (so don't put any un-trusted messages / error strings
         *          here)
         */
        if (null === $apiKey) {
            throw new CustomUserMessageAuthenticationException('Invalid API key');
        }

        $user = $apiKeyProvider->loadUserByIdentifier($apiKey->getToken());

        return new PreAuthenticatedToken($user, $token, $providerKey, $user->getRoles());
    }
}
