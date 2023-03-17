<?php

declare(strict_types=1);
/**
 * /src/Api/V1/Triggers/Anotacao/Trigger0002.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Triggers\Anotacao;

use Exception;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Anotacao;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Triggers\TriggerInterface;
use SuppCore\AdministrativoBackend\Transaction\TransactionManager;
use SuppCore\AdministrativoBackend\Api\V1\Triggers\Anotacao\Message\IndexacaoMessage;

/**
 * Class Trigger0001.
 *
 * @descSwagger=Entrando na Trigger 0001
 * @classeSwagger=Trigger0001
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Trigger0001 implements TriggerInterface
{

    private TransactionManager $transactionManager;

    /**
     * Trigger0010 constructor.
     */
    public function __construct(
        TransactionManager $transactionManager
    )
    {
        $this->transactionManager = $transactionManager;
    }

    /**
     * @throws Exception
     */
    public function execute(
        ?RestDtoInterface $restDto,
        EntityInterface $entity,
        string $transactionId
    ): void
    {

        $this->transactionManager->addAsyncDispatch(new IndexacaoMessage($entity->getUuid()), $transactionId);

    }

    /**
     * @return array
     */
    public function supports(): array
    {
        return [
            Anotacao::class => [
                'afterCreate',
                'afterUpdate',
                'afterPatch',
            ],
        ];
    }

    /**
     * @return int
     */
    public function getOrder(): int
    {
        return 1;
    }
}