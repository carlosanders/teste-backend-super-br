<?php

declare(strict_types=1);
/**
 * /src/Api/V1/Triggers/Juntada/Trigger0006.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Triggers\Juntada;

use Exception;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Juntada;
use SuppCore\AdministrativoBackend\Api\V1\Resource\JuntadaResource;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\VinculacaoDocumento;
use SuppCore\AdministrativoBackend\Triggers\TriggerInterface;

/**
 * Class Trigger0006.
 *
 * @descSwagger=Promove a juntada dos documentos vinculados!
 * @classeSwagger=Trigger0006
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Trigger0006 implements TriggerInterface
{
    private JuntadaResource $juntadaResource;

    /**
     * Trigger0006 constructor.
     */
    public function __construct(
        JuntadaResource $juntadaResource
    ) {
        $this->juntadaResource = $juntadaResource;
    }

    public function supports(): array
    {
        return [
            Juntada::class => [
                'beforeCreate',
            ],
        ];
    }

    /**
     * @param Juntada|RestDtoInterface|null $restDto
     *
     * @throws Exception
     */
    public function execute(?RestDtoInterface $restDto, EntityInterface $entity, string $transactionId): void
    {
        /** @var VinculacaoDocumento $vinculacaoDocumento */
        foreach ($restDto->getDocumento()->getVinculacoesDocumentos() as $vinculacaoDocumento) {
            $juntadaDTO = new Juntada();
            $juntadaDTO->setDocumento($vinculacaoDocumento->getDocumentoVinculado());
            $juntadaDTO->setVolume($restDto->getVolume());

            $juntadaDTO->setVinculada(true);

            $juntadaDTO->setDescricao($restDto->getDescricao());

            $juntadaDTO->setAtividade($restDto->getAtividade());
            $juntadaDTO->setTarefa($restDto->getTarefa());
            $juntadaDTO->setDocumentoAvulso($restDto->getDocumentoAvulso());
            $juntadaDTO->setJuntadaDesentranhada($restDto->getJuntadaDesentranhada());

            $this->juntadaResource->create($juntadaDTO, $transactionId);
        }
    }

    public function getOrder(): int
    {
        return 2;
    }
}
