<?php

declare(strict_types=1);
/**
 * /src/Api/V1/Rules/Processo/Rule0003.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Rules\Processo;

use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Processo;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Repository\ProcessoRepository;
use SuppCore\AdministrativoBackend\Rules\Exceptions\RuleException;
use SuppCore\AdministrativoBackend\Rules\RuleInterface;
use SuppCore\AdministrativoBackend\Rules\RulesTranslate;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

/**
 * Class Rule0003.
 *
 * @descSwagger=Processos eletrônicos com componentes digitais juntados não podem ser convertidos em eletrônicos!
 * @classeSwagger=Rule0003
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Rule0003 implements RuleInterface
{
    private RulesTranslate $rulesTranslate;

    private ProcessoRepository $processoRepository;

    /**
     * Rule0003 constructor.
     */
    public function __construct(
        RulesTranslate $rulesTranslate,
        ProcessoRepository $processoRepository,
        private ParameterBagInterface $parameterBag
    ) {
        $this->rulesTranslate = $rulesTranslate;
        $this->processoRepository = $processoRepository;
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
        if (($this->parameterBag->get('constantes.entidades.modalidade_meio.const_2') === $entity->getModalidadeMeio()->getValor()) &&
            ($this->parameterBag->get('constantes.entidades.modalidade_meio.const_1') === $restDto->getModalidadeMeio()->getValor()) &&
            (true === $this->processoRepository->hasComponenteDigital($entity->getId()))) {
            $this->rulesTranslate->throwException('processo', '0003');
        }

        return true;
    }

    public function getOrder(): int
    {
        return 2;
    }
}
