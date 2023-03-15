<?php

declare(strict_types=1);
/**
 * /src/Api/V1/Rules/Assinatura/Rule0003.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Rules\Assinatura;

use SuppCore\AdministrativoBackend\Api\V1\DTO\Assinatura;
use SuppCore\AdministrativoBackend\Api\V1\Resource\ComponenteDigitalResource;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Rules\Exceptions\RuleException;
use SuppCore\AdministrativoBackend\Rules\RuleInterface;
use SuppCore\AdministrativoBackend\Rules\RulesTranslate;
use SuppCore\AdministrativoBackend\Transaction\TransactionManager;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Process\Process;

/**
 * Class Rule0006.
 *
 * @descSwagger=Assinatura digital não confere! Favor realizar novamente a assinatura no componente digital!
 * @classeSwagger=Rule0006
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Rule0006 implements RuleInterface
{
   /**
     * Rule0006 constructor.
     */
    public function __construct(
        private ParameterBagInterface $parameterBag,
        private RulesTranslate $rulesTranslate,
        private ComponenteDigitalResource $componenteDigitalResource,
        private TransactionManager $transactionManager
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
     * @param RestDtoInterface|null $restDto
     * @param EntityInterface $entity
     * @param string $transactionId
     * @return bool
     * @throws RuleException
     */
    public function validate(?RestDtoInterface $restDto, EntityInterface $entity, string $transactionId): bool
    {
        if ($this->transactionManager->getContext('clonarAssinatura', $transactionId)) {
            return true;
        }

        if ('cadeia_teste' !== $restDto->getCadeiaCertificadoPEM()) {
            $assinatura = base64_decode($restDto->getAssinatura());

            if ($this->isPkcs7($assinatura)) {
                $hash = $restDto->getComponenteDigital()->getHash();
                $filename = '/tmp/'.$hash.'.p7s';
                file_put_contents($filename, $assinatura);

                $signerProxyParams = [];
                $signerProxy = $this->parameterBag->get('supp_core.administrativo_backend.signer_proxy');

                if ($signerProxy) {
                    $signerProxyParams = explode(' ', $signerProxy);
                }
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
            } else {
                /** @var Assinatura $assinaturaDTO */
                $assinaturaDTO = $restDto;
                $aCertChain = explode('-----END CERTIFICATE-----', $assinaturaDTO->getCadeiaCertificadoPEM());
                $fisrtCert = $aCertChain[0].'-----END CERTIFICATE-----';
                $pubkeyid = openssl_pkey_get_public($fisrtCert);

                switch ($assinaturaDTO->getAlgoritmoHash()) {
                    case 'SHA256WITHRSA':
                        $algoritmo = OPENSSL_ALGO_SHA256;
                        break;
                    case 'MD5WITHRSA':
                        $algoritmo = OPENSSL_ALGO_MD5;
                        break;
                    default:
                        $this->rulesTranslate->throwException('assinatura', '0006');
                        break;
                }

                // se o componente digital e a assinatura estao sendo criados ao mesmo tempo:
                // recupera o conteudo no proprio coomponente digital
                $conteudo = (null == $restDto->getComponenteDigital()->getId()) ?
                    $restDto->getComponenteDigital()->getConteudo() :
                    $this
                        ->componenteDigitalResource
                        ->download($restDto->getComponenteDigital()->getId(), $transactionId)
                        ->getConteudo();

                /** @noinspection PhpUndefinedVariableInspection */
                $valid = openssl_verify(
                    $conteudo,
                    $assinatura,
                    $pubkeyid,
                    $algoritmo
                );
            }

            if (!$valid) {
                $this->rulesTranslate->throwException('assinatura', '0006');
            }
        }

        return true;
    }

    public function isPkcs7(string $assinatura): bool
    {
        $byteSignature = '30 80 06 09 2A 86 48 86 F7 0D 01 07 02';
        $hex_ary = [];
        $ok = false;
        foreach (str_split(substr($assinatura, 0, 15)) as $i => $chr) {
            $hex_ary[] = sprintf('%02X', ord($chr));
        }
        $s = '';
        foreach ($hex_ary as $i => $item) {
            $s .= $item;
            if ($s === $byteSignature) {
                $ok = true;
                break;
            }
            $s .= ' ';
        }

        return $ok;
    }

    public function getOrder(): int
    {
        return 6;
    }
}
