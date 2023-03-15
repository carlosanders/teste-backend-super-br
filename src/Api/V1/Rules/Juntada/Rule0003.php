<?php

declare(strict_types=1);
/**
 * /src/Api/V1/Rules/Juntada/Rule0003.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Rules\Juntada;

use SuppCore\AdministrativoBackend\Api\V1\DTO\Juntada;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Rules\Exceptions\RuleException;
use SuppCore\AdministrativoBackend\Rules\RuleInterface;
use SuppCore\AdministrativoBackend\Rules\RulesTranslate;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

/**
 * Class Rule0003.
 *
 * @descSwagger=O NUP está arquivado e não pode receber juntadas!
 * @classeSwagger=Rule0003
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Rule0003 implements RuleInterface
{
    private RulesTranslate $rulesTranslate;

    /**
     * Rule0003 constructor.
     */
    public function __construct(RulesTranslate $rulesTranslate,
                                private ParameterBagInterface $parameterBag)
    {
        $this->rulesTranslate = $rulesTranslate;
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
     * @param Juntada|RestDtoInterface|null                                  $restDto
     * @param \SuppCore\AdministrativoBackend\Entity\Juntada|EntityInterface $entity
     *
     * @throws RuleException
     */
    public function validate(?RestDtoInterface $restDto, EntityInterface $entity, string $transactionId): bool
    {
        if ($restDto->getVolume()->getProcesso() &&
            $restDto->getVolume()->getProcesso()->getId() &&
            (
                ($this->parameterBag->get('constantes.entidades.especie_setor.const_2') === $restDto->getVolume()->getProcesso()->getSetorAtual()->getEspecieSetor()->getNome()) ||
                ($this->parameterBag->get('constantes.entidades.modalidade_fase.const_2') === $restDto->getVolume()->getProcesso()->getModalidadeFase()->getValor()) ||
                ($this->parameterBag->get('constantes.entidades.modalidade_fase.const_3') === $restDto->getVolume()->getProcesso()->getModalidadeFase()->getValor()) ||
                ($this->parameterBag->get('constantes.entidades.modalidade_fase.const_4') === $restDto->getVolume()->getProcesso()->getModalidadeFase()->getValor())
            )
        ) {
            $this->rulesTranslate->throwException('juntada', '0003');
        }

        return true;
    }

    public function getOrder(): int
    {
        return 3;
    }
}
