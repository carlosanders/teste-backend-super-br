<?php

declare(strict_types=1);
/**
 * /src/Api/V1/Triggers/Assinatura/Trigger0001.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Triggers\Assinatura;

use DateTime;
use Exception;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Assinatura;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\Assinatura as AssinaturaEntity;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Triggers\TriggerInterface;

/**
 * Class Trigger0001.
 *
 * @descSwagger=Caso não seja informada a data e hora a assinatura será adotado o tempo corrente!
 * @classeSwagger=Trigger0001
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Trigger0001 implements TriggerInterface
{
    public function supports(): array
    {
        return [
            Assinatura::class => [
                'beforeCreate',
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
        if (!$restDto->getDataHoraAssinatura()) {
            $restDto->setDataHoraAssinatura(new DateTime());
        }
    }

    public function getOrder(): int
    {
        return 1;
    }
}
