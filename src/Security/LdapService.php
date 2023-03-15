<?php

declare(strict_types=1);
/**
 * /src/Security/LdapService.php.
 */

namespace SuppCore\AdministrativoBackend\Security;

use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\Ldap\Adapter\ExtLdap\Adapter;
use Symfony\Component\Ldap\Ldap;
use Symfony\Component\Ldap\LdapInterface;
use Symfony\Component\Ldap\Security\LdapUser;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Throwable;

/**
 * Class LdapService.
 */
class LdapService
{
    public const TYPE_AUTH_AD = 'AD';
    public const TYPE_AUTH_LDAP = 'LDAP';
    private ?array $arrLdapConf;

    /**
     * LdapService constructor.
     *
     * @param array|null $arrLdapConf
     */
    public function __construct(?array $arrLdapConf)
    {
        $this->arrLdapConf = $arrLdapConf;
    }

    /**
     * Retorna um array com os dados do usuário.
     *
     * @param string $username
     * @param string $password
     *
     * @return array
     */
    public function getUserData(string $username, string $password): array
    {
        $userData = [];
        foreach ($this->arrLdapConf as $ldapConf) {
            $confBag = new ParameterBag($ldapConf);

            if (!$this->validateLdapConf($confBag)) {
                throw new BadCredentialsException('Configuração de conexão com LDAP inválida!');
            }

            $ldapComponent = new Ldap(self::getLdapAdapter($confBag));
            $cleanUsername = explode('@', $ldapComponent->escape($username, '', LdapInterface::ESCAPE_FILTER))[0];

            $usernameFull = $username;

            if ($ldapConf['domain'] && !str_contains($username, '@')) {
                $usernameFull .= $ldapConf['domain'];
            }

            try {
                switch ($confBag->get('type_auth')) {
                    case self::TYPE_AUTH_AD:
                        $ldapComponent->bind($usernameFull, $password);
                        break;
                    default:
                        $ldapComponent->bind($confBag->get('search_dn'), $confBag->get('search_password'));
                }
            } catch (Throwable) {
                throw new BadCredentialsException('Dados incorretos!');
            }

            $result = $ldapComponent->query(
                $confBag->get('base_dn'),
                str_replace(
                    '{username}',
                    $cleanUsername,
                    str_replace(
                        '{uid_key}',
                        $confBag->get('ui_key'),
                        $confBag->get('filter')
                    )
                )
            )->execute()->toArray();

            if (!empty($result)) {
                $userPassword = null;
                $ldapEntry = $result[0];
                $nome = null;
                $cpf = null;
                $email = null;

                if ($ldapEntry->hasAttribute($confBag->get('name_attribute'))) {
                    $nome = $ldapEntry->getAttribute($confBag->get('name_attribute'))[0];
                }

                if ($ldapEntry->hasAttribute($confBag->get('cpf_attribute'))) {
                    $cpf = $ldapEntry->getAttribute($confBag->get('cpf_attribute'))[0];
                }

                if ($ldapEntry->hasAttribute($confBag->get('email_attribute'))) {
                    $email = $ldapEntry->getAttribute($confBag->get('email_attribute'))[0];
                }

                if ($confBag->get('type_auth') == self::TYPE_AUTH_AD) {
                    $userPassword = $password;
                } else {
                    $userPassword = $ldapEntry->getAttribute($confBag->get('password_attribute'))[0];
                }

                $userData = [
                    'username' => $username,
                    'password' => $password,
                    'nome' => $nome,
                    'cpf' => $cpf,
                    'email' => $email,
                    'ldapUser' => (new LdapUser($ldapEntry, $username, $userPassword)),
                ];

                break;
            }
        }

        return $userData;
    }

    /**
     * Retorna o Ldap Adapter configurado conforme os parametros repassados.
     *
     * @param ParameterBag $confBag
     *
     * @return Adapter
     */
    private static function getLdapAdapter(ParameterBag $confBag): Adapter
    {
        $ldapAdapter = new Adapter(
            [
                'host' => $confBag->get('host'),
                'port' => (int) $confBag->get('port'),
                'encryption' => $confBag->get('encryption', 'none'),
                'options' => [
                    'protocol_version' => (int) $confBag->get('protocol_version'),
                    'referrals' => (bool) $confBag->get('referrals'),
                ],
            ]
        );

        return $ldapAdapter;
    }

    /**
     * Método que valida as configurações repassadas.
     *
     * @param ParameterBag $confBag
     *
     * @return bool
     */
    private function validateLdapConf(ParameterBag $confBag): bool
    {
        if (
            !$confBag->has('host')
            || !$confBag->has('port')
            || !$confBag->has('base_dn')
            || !$confBag->has('protocol_version')
            || !$confBag->has('referrals')
            || !$confBag->has('email_attribute')
            || !$confBag->has('cpf_attribute')
            || !$confBag->has('name_attribute')
            || !$confBag->has('filter')
            || (
                !$confBag->has('type_auth')
                || !in_array($confBag->get('type_auth'), [self::TYPE_AUTH_AD, self::TYPE_AUTH_LDAP])
            )
        ) {
            return false;
        }

        return true;
    }

    /**
     * @return String
     */
    public function getLdapTypeAuth(): String
    {
        return $this->arrLdapConf[0]['type_auth'];
    }
}
