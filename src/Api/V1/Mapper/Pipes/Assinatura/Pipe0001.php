<?php

declare(strict_types=1);
/**
 * /src/Api/V1/Pipes/Assinatura/Pipe0001.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Mapper\Pipes\Assinatura;

use Exception;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Assinatura as AssinaturaDTO;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\Assinatura as AssinaturaEntity;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Mapper\Pipes\PipeInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

/**
 * Class Pipe0001.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Pipe0001 implements PipeInterface
{
    private ParameterBagInterface $parameterBag;

    /**
     * Pipe0001 constructor.
     */
    public function __construct(ParameterBagInterface $parameterBag)
    {
        $this->parameterBag = $parameterBag;
    }

    public function supports(): array
    {
        return [
            AssinaturaDTO::class => [
                'onCreateDTOFromEntity',
            ],
        ];
    }

    /**
     * @param AssinaturaDTO|RestDtoInterface|null $restDto
     * @param AssinaturaEntity|EntityInterface    $entity
     *
     * @throws Exception
     */
    public function execute(?RestDtoInterface &$restDto, EntityInterface $entity): void
    {
        if (!$restDto->getCadeiaCertificadoPEM()) {
            return;
        }

        $sCertChain = $restDto->getCadeiaCertificadoPEM();
        if ('cadeia_teste' === $sCertChain) {
            if ($entity->getCriadoPor()) {
                $restDto->setAssinadoPor($entity->getCriadoPor()->getNome().' EM MODO TESTE');
            }

            return;
        }

        $aCertChain = explode('-----END CERTIFICATE-----', $sCertChain);
        if (0 == count($aCertChain)) {
            return;
        }
        $firstCert = $aCertChain[0].'-----END CERTIFICATE-----';
        $parsed = openssl_x509_parse($firstCert, true);
        if (false === $parsed) {
            return;
        }
        if (false === isset($parsed['subject']['CN'])) {
            return;
        }
        $nomeProcessado = explode(':', $parsed['subject']['CN']);
        $nome = $nomeProcessado[0] ?? $parsed['subject']['CN'];
        $cnInstitucional = $this->parameterBag->get(
            'supp_core.administrativo_backend.certificado_a1_institucional_CN'
        );
        if ($cnInstitucional && $nome === $cnInstitucional) {
            $nome = $entity->getCriadoPor()->getNome().
                ', COM USUÁRIO E SENHA ('.$cnInstitucional.')';
        } else {
            $nome .= ' COM CERTIFICADO DIGITAL';
        }

        $restDto->setAssinadoPor($nome);
    }

    public function getOrder(): int
    {
        return 1;
    }
}
