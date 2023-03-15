<?php

declare(strict_types=1);
/**
 * /src/Api/V1/Triggers/Tarefa/Trigger0002.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Triggers\Tarefa;

use Redis;
use DateTime;
use Exception;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Distribuicao;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Tarefa;
use SuppCore\AdministrativoBackend\Api\V1\Resource\DistribuicaoResource;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\Tarefa as TarefaEntity;
use SuppCore\AdministrativoBackend\Triggers\TriggerInterface;

/**
 * Class Trigger0002.
 *
 * @descSwagger  =Gera o objeto distribuição para a tarefa!
 * @classeSwagger=Trigger0002
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Trigger0002 implements TriggerInterface
{
    private DistribuicaoResource $distribuicaoResource;
    private Redis $redisClient;

    /**
     * Trigger0002 constructor.
     */
    public function __construct(
        DistribuicaoResource $distribuicaoResource,
        Redis $redisClient
    ) {
        $this->distribuicaoResource = $distribuicaoResource;
        $this->redisClient = $redisClient;
    }

    public function supports(): array
    {
        return [
            Tarefa::class => [
                'afterCreate',
            ],
        ];
    }

    /**
     * @param Tarefa|RestDtoInterface|null $restDto
     * @param TarefaEntity|EntityInterface $entity
     *
     * @throws Exception
     */
    public function execute(?RestDtoInterface $restDto, EntityInterface $entity, string $transactionId): void
    {
        $distribuicao = new Distribuicao();
        $distribuicao->setTarefa($entity);
        $distribuicao->setUsuarioPosterior($entity->getUsuarioResponsavel());
        $distribuicao->setSetorPosterior($entity->getSetorResponsavel());
        $distribuicao->setDistribuicaoAutomatica($entity->getDistribuicaoAutomatica());
        $distribuicao->setLivreBalanceamento($entity->getLivreBalanceamento());
        $distribuicao->setAuditoriaDistribuicao($entity->getAuditoriaDistribuicao());
        $distribuicao->setTipoDistribuicao($entity->getTipoDistribuicao());
        $distribuicao->setDataHoraDistribuicao(new DateTime());

        $this->distribuicaoResource->create($distribuicao, $transactionId);

        // cache
        $today = new DateTime();
        $expire = false;
        if (!$this->redisClient->exists('dist_'.$today->format('Ymd'))) {
            $expire = true;
        }

        // setor
        if (!$this->redisClient->exists('dist_s_'.$entity->getSetorResponsavel()->getId())) {
            $this->redisClient->set('dist_s_'.$entity->getSetorResponsavel()->getId(), $today->format('Ymd'));
        }

        // usuario
        $this->redisClient->hincrby(
            'dist_'.$today->format('Ymd'),
            's_'.$entity->getSetorResponsavel()->getId().'u_'.$entity->getUsuarioResponsavel()->getId(),
            1
        );

        // apenas distribuicao automatica
        if ($entity->getDistribuicaoAutomatica()) {
            $this->redisClient->hincrby(
                'dist_'.$today->format('Ymd'),
                's_'.$entity->getSetorResponsavel()->getId().'u_'.$entity->getUsuarioResponsavel()->getId().'_au',
                1
            );
        }

        // apenas livre distribuicao
        if ($entity->getLivreBalanceamento()) {
            $this->redisClient->hincrby(
                'dist_'.$today->format('Ymd'),
                's_'.$entity->getSetorResponsavel()->getId().'u_'.$entity->getUsuarioResponsavel()->getId().'_lb',
                1
            );
        }

        if ($expire) {
            $this->redisClient->expire('dist_'.$today->format('Ymd'), 60 * 24 * 60 * 60);
        }
    }

    public function getOrder(): int
    {
        return 3;
    }
}
