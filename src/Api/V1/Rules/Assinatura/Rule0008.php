<?php

declare(strict_types=1);
/**
 * /src/Api/V1/Rules/Assinatura/Rule0008.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Rules\Assinatura;

use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\Assinatura;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Rules\Exceptions\RuleException;
use SuppCore\AdministrativoBackend\Rules\RuleInterface;
use SuppCore\AdministrativoBackend\Rules\RulesTranslate;
use SuppCore\AdministrativoBackend\Utils\X509Service;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class Rule0008.
 *
 * @descSwagger=Apenas o usuário que assinou pode excluí-la!
 * @classeSwagger=Rule0008
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Rule0008 implements RuleInterface
{
    /**
     * Rule0008 constructor.
     */
    public function __construct(
        private RulesTranslate $rulesTranslate,
        private TokenStorageInterface $tokenStorage,
        private X509Service $x509Service,
        private ParameterBagInterface $parameterBag
    ) {
    }

    public function supports(): array
    {
        return [
            Assinatura::class => [
                'beforeDelete',
            ],
        ];
    }

    /**
     * @param \SuppCore\AdministrativoBackend\Api\V1\DTO\Assinatura|RestDtoInterface|null $restDto
     * @param Assinatura|EntityInterface                                                  $entity
     *
     * @throws RuleException
     */
    public function validate(?RestDtoInterface $restDto, EntityInterface $entity, string $transactionId): bool
    {
        if ($this->tokenStorage->getToken() &&
            $this->tokenStorage->getToken()->getUser()) {
            $sCertChain = $entity->getCadeiaCertificadoPEM();
            // não tem cadeia ou é teste
            if (!$sCertChain || ('cadeia_teste' === $sCertChain)) {
                return true;
            }

            // PEM invalido
            $aCertChain = explode('-----END CERTIFICATE-----', $sCertChain);
            if (0 == count($aCertChain)) {
                return true;
            }

            $firstCert = $aCertChain[0].'-----END CERTIFICATE-----';

            $parsed = $this->x509Service->getCredentials($firstCert);

            $cnInstitucional = $this->parameterBag->get(
                'supp_core.administrativo_backend.certificado_a1_institucional_CN'
            );

            // assinatura A1 institucional
            if ($cnInstitucional &&
                ($parsed['cn'] === $cnInstitucional) &&
                $entity->getCriadoPor()->getUsername() === $this->tokenStorage->getToken()->getUser()->getUsername()) {
                return true;
            }

            // assinatura A3
            if ($parsed['username'] === $this->tokenStorage->getToken()->getUser()->getUsername()) {
                return true;
            }
        }

        $this->rulesTranslate->throwException('assinatura', '0008');
    }

    public function getOrder(): int
    {
        return 8;
    }
}
