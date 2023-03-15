<?php

declare(strict_types=1);
/**
 * /src/Api/V1/Triggers/Anotacao/Trigger0001.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Triggers\Anotacao;

use Exception;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Anotacao;
use SuppCore\AdministrativoBackend\Api\V1\DTO\GeneroProcesso;
use SuppCore\AdministrativoBackend\Api\V1\Resource\AnotacaoResource;
use SuppCore\AdministrativoBackend\Api\V1\Resource\GeneroProcessoResource;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Triggers\TriggerInterface;

/**
 * Class Trigger0001.
 *
 * @descSwagger=Se não houver assunto outro principal, o assunto será criado/editado como principal!
 * @classeSwagger=Trigger0001
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Trigger0001 implements TriggerInterface
{

    function __construct(
        private GeneroProcessoResource $generoProcessoResource
    )
    {

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
        $generoProcesso = new GeneroProcesso();
        $generoProcesso->setNome('Genero Anotação');
        $generoProcesso->setDescricao('Genero Anotação');
        $generoProcesso->setAtivo(true);

        $this->generoProcessoResource->create($generoProcesso, $transactionId);

    }

    /**
     * @return array
     */
    public function supports(): array
    {
        return [
            Anotacao::class => [
                'afterCreate'
            ]
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