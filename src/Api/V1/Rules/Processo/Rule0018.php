<?php

declare(strict_types=1);
/**
 * /src/Api/V1/Rules/Processo/Rule0018.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Rules\Processo;

use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Processo;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Repository\TarefaRepository;
use SuppCore\AdministrativoBackend\Rules\Exceptions\RuleException;
use SuppCore\AdministrativoBackend\Rules\RuleInterface;
use SuppCore\AdministrativoBackend\Rules\RulesTranslate;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

/**
 * Class Rule0018.
 *
 * @descSwagger=Processos com tarefas abertas não podem ser enviados para o Arquivo
 * @classeSwagger=Rule0018
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Rule0018 implements RuleInterface
{
    private RulesTranslate $rulesTranslate;

    private TarefaRepository $tarefaRepository;

    /**
     * Rule0018 constructor.
     */
    public function __construct(
        RulesTranslate $rulesTranslate,
        TarefaRepository $tarefaRepository,
        private ParameterBagInterface $parameterBag
    ) {
        $this->rulesTranslate = $rulesTranslate;
        $this->tarefaRepository = $tarefaRepository;
    }

    public function supports(): array
    {
        return [
            Processo::class => [
                'beforeUpdate',
                'beforePatch',
            ],
        ];
    }

    /**
     * @param Processo|RestDtoInterface|null $restDto
     *
     * @throws RuleException
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function validate(?RestDtoInterface $restDto, EntityInterface $entity, string $transactionId): bool
    {
        if($entity->getSetorAtual()->getEspecieSetor()->getNome()
            !== $this->parameterBag->get('constantes.entidades.especie_setor.const_2') &&
            ($restDto->getSetorAtual()->getEspecieSetor()->getNome()
            === $this->parameterBag->get('constantes.entidades.especie_setor.const_2')))
        {
            $tarefaAberta = $this->tarefaRepository->findAbertaByProcessoId($entity->getId());
            if($tarefaAberta){
                $this->rulesTranslate->throwException('processo', '0019');
            }
        }

        return true;
    }

    public function getOrder(): int
    {
        return 2;
    }
}
