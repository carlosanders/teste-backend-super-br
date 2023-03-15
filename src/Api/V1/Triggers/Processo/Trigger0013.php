<?php

declare(strict_types=1);
/**
 * /src/Api/V1/Triggers/Processo/Trigger0013.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Triggers\Processo;

use SuppCore\AdministrativoBackend\Api\V1\DTO\Processo;
use SuppCore\AdministrativoBackend\Api\V1\Resource\ClassificacaoResource;
use SuppCore\AdministrativoBackend\Api\V1\Resource\EspecieProcessoResource;
use SuppCore\AdministrativoBackend\Api\V1\Resource\ModalidadeMeioResource;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\Processo as ProcessoEntity;
use SuppCore\AdministrativoBackend\Triggers\TriggerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * Class Trigger0013.
 *
 * @descSwagger=Cria metadados do processo automaticamente caso o usuário logado seja um usuário externo
 * @classeSwagger=Trigger0013
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Trigger0013 implements TriggerInterface
{
    /**
     * Trigger0013 constructor.
     */
    public function __construct(
        private AuthorizationCheckerInterface $authorizationChecker,
        private ClassificacaoResource $classificacaoResource,
        private EspecieProcessoResource $especieProcessoResource,
        private ModalidadeMeioResource $modalidadeMeioResource,
        private ParameterBagInterface $parameterBag
    ) {
    }

    public function supports(): array
    {
        return [
            Processo::class => [
                'beforeCreate',
            ],
        ];
    }

    /**
     * @param Processo|RestDtoInterface|null $restDto
     * @param ProcessoEntity|EntityInterface $entity
     * @param string                         $transactionId
     *
     * @return void
     */
    public function execute(?RestDtoInterface $restDto, EntityInterface $entity, string $transactionId): void
    {
        if ($restDto->getProtocoloEletronico() &&
            ($this->authorizationChecker->isGranted('ROLE_USUARIO_EXTERNO'))) {
            // SETA METADADOS DO PROCESSO
            $restDto->setClassificacao(
                $this->classificacaoResource->getRepository()
                    ->findOneBy(['codigo' => $this->parameterBag->get('constantes.entidades.classificacao.const_1')])
            );
            // COMUNICAÇÕES: NORMAS, REGULAMENTAÇÕES, DIRETRIZES, PROCEDIMENTOS, ESTUDOS E/OU DECISÕES DE CARÁTER GERAL
            $restDto->setEspecieProcesso($this->especieProcessoResource
                ->findOneBy(['nome' => $this->parameterBag->get('constantes.entidades.especie_processo.const_1')]));
            $restDto->setModalidadeMeio($this->modalidadeMeioResource
                ->findOneBy(['valor' => $this->parameterBag->get('constantes.entidades.modalidade_meio.const_1')]));
            $restDto->getRequerimento() ? $restDto->setVisibilidadeExterna(false)
                : $restDto->setVisibilidadeExterna(true);
        }
    }

    public function getOrder(): int
    {
        return 1;
    }
}
