<?php

declare(strict_types=1);
/**
 * /src/Utils/X509Service.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Utils;

use phpseclib3\File\X509;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

/**
 * Class X509Service.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class X509Service
{
    /**
     * X509Service constructor.
     *
     * @param ParameterBagInterface $params
     */
    public function __construct(ParameterBagInterface $params)
    {
    }

    /**
     * @param string $pem
     *
     * @return array
     */
    public function getCredentials(string $pem): array
    {
        $x509 = new X509();
        $c = $x509->loadX509($pem);

        $cn = null;
        $username = null;
        $nome = null;

        if (isset($x509->getDNProp('id-at-commonName')[0])) {
            $cn = $x509->getDNProp('id-at-commonName')[0];
            $nome = explode(':', $cn)[0];
        }

        // cn
        if (!$cn && isset($c['tbsCertificate']['subject']['rdnSequence'])) {
            foreach ($c['tbsCertificate']['subject']['rdnSequence'] as $rdnSequence) {
                foreach ($rdnSequence as $sequence) {
                    if (isset($sequence['type']) &&
                        ('id-at-commonName' === $sequence['type']) &&
                        isset($sequence['value']['utf8String'])) {
                        $cn = $sequence['value']['utf8String'];
                        $nome = explode(':', $cn)[0];
                        break 2;
                    }
                }
            }
        }

        // cpf
        if (isset($c['tbsCertificate']['extensions'])) {
            foreach ($c['tbsCertificate']['extensions'] as $extension) {
                if (isset($extension['extnValue']) && is_array($extension['extnValue'])) {
                    foreach ($extension['extnValue'] as $extensionValue) {
                        if (isset($extensionValue['otherName']['type-id']) &&
                            isset($extensionValue['otherName']['value']['octetString']) &&
                            (('2.16.76.1.3.1' === $extensionValue['otherName']['type-id']) ||
                                ('2.16.76.1.3.4' === $extensionValue['otherName']['type-id']))) {
                            $username =
                                substr($extensionValue['otherName']['value']['octetString'], 8, 11);
                        }
                    }
                }
            }
        }

        // cnpj
        if (isset($c['tbsCertificate']['extensions'])) {
            foreach ($c['tbsCertificate']['extensions'] as $extension) {
                if (isset($extension['extnValue']) && is_array($extension['extnValue'])) {
                    foreach ($extension['extnValue'] as $extensionValue) {
                        if (isset($extensionValue['otherName']['type-id']) &&
                            isset($extensionValue['otherName']['value']['octetString']) &&
                            ('2.16.76.1.3.3' === $extensionValue['otherName']['type-id'])) {
                            $username =
                                substr($extensionValue['otherName']['value']['octetString'], 0, 14);
                        }
                    }
                }
            }
        }

        return [
            'cn' => $cn,
            'username' => $username,
            'nome' => $nome,
        ];
    }
}
