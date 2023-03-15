<?php

declare(strict_types=1);
/**
 * /src/Api/V1/Triggers/Processo/Trigger0014.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Triggers\Processo;

use DateInterval;
use DateTime;
use Exception;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Processo;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Tarefa;
use SuppCore\AdministrativoBackend\Api\V1\Resource\EspecieTarefaResource;
use SuppCore\AdministrativoBackend\Api\V1\Resource\TarefaResource;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Triggers\TriggerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * Class Trigger0014.
 *
 * @descSwagger=Cria tarefa de processo do usuário conveniado
 * @classeSwagger=Trigger0014
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Trigger0014 implements TriggerInterface
{
    private AuthorizationCheckerInterface $authorizationChecker;

    private TarefaResource $tarefaResource;

    private EspecieTarefaResource $especieTarefaResource;

    /**
     * Trigger0014 constructor.
     */
    public function __construct(
        AuthorizationCheckerInterface $authorizationChecker,
        TarefaResource $tarefaResource,
        EspecieTarefaResource $especieTarefaResource,
        private ParameterBagInterface $parameterBag
    ) {
        $this->authorizationChecker = $authorizationChecker;
        $this->tarefaResource = $tarefaResource;
        $this->especieTarefaResource = $especieTarefaResource;
    }

    public function supports(): array
    {
        return [
            Processo::class => [
                'afterCreate',
            ],
        ];
    }

    /**
     * @throws Exception
     */
    public function execute(?RestDtoInterface $restDto, EntityInterface $entity, string $transactionId): void
    {
        if ($restDto->getProtocoloEletronico() &&
            (false === $this->authorizationChecker->isGranted('ROLE_COLABORADOR'))) {
            $inicioPrazo = new DateTime();
            $finalPrazo = new DateTime();
            $finalPrazo->add(new DateInterval('P5D'));
            $especieTarefa = $this->especieTarefaResource->findOneBy(
                [
                    'nome' => $this->parameterBag->get('constantes.entidades.especie_tarefa.const_5'),
                ]
            );

            $tarefaDTO = new Tarefa();
            $tarefaDTO->setProcesso($entity);
            $tarefaDTO->setSetorResponsavel($restDto->getSetorInicial()); //PROTOCOLO DA UNIDADE ENVIADA
            $tarefaDTO->setEspecieTarefa($especieTarefa);
            $tarefaDTO->setDataHoraInicioPrazo($inicioPrazo);
            $tarefaDTO->setDataHoraFinalPrazo($finalPrazo);

            $this->tarefaResource->create($tarefaDTO, $transactionId);
        }
    }

    public function getOrder(): int
    {
        return 1;
    }
}
