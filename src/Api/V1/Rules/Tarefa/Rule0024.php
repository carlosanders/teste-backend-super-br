<?php

declare(strict_types=1);
/**
 * /src/Api/V1/Rules/Tarefa/Rule0024.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Rules\Tarefa;

use SuppCore\AdministrativoBackend\Api\V1\DTO\Tarefa;
use SuppCore\AdministrativoBackend\Api\V1\Resource\AfastamentoResource;
use SuppCore\AdministrativoBackend\Api\V1\Resource\LotacaoResource;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Rules\Exceptions\RuleException;
use SuppCore\AdministrativoBackend\Rules\RuleInterface;
use SuppCore\AdministrativoBackend\Rules\RulesTranslate;
use SuppCore\AdministrativoBackend\Transaction\TransactionManager;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class Rule0024.
 *
 * @descSwagger=Usuários inativados e/ou usuários não lotados no Setor Responsável não podem receber Tarefas
 * @classeSwagger=Rule0024
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Rule0024 implements RuleInterface
{
    private RulesTranslate $rulesTranslate;

    private LotacaoResource $lotacaoResource;

    /**
     * Rule0024 constructor.
     */
    public function __construct(
        RulesTranslate $rulesTranslate,
        TokenStorageInterface $tokenStorage,
        AfastamentoResource $afastamentoResource,
        LotacaoResource $lotacaoResource
    ) {
        $this->rulesTranslate = $rulesTranslate;
        $this->tokenStorage = $tokenStorage;
        $this->afastamentoResource = $afastamentoResource;
        $this->lotacaoResource = $lotacaoResource;
    }

    public function supports(): array
    {
        return [
            Tarefa::class => [
                'beforeCreate',
                'beforeUpdate',
                'beforePatch'
            ],
        ];
    }

    /**
     * @param Tarefa|RestDtoInterface|null                                  $restDto
     * @param \SuppCore\AdministrativoBackend\Entity\Tarefa|EntityInterface $entity
     *
     * @throws RuleException
     */
    public function validate(?RestDtoInterface $restDto, EntityInterface $entity, string $transactionId): bool
    {
        if (!$restDto->getUsuarioResponsavel()->getEnabled()) {
            $this->rulesTranslate->throwException('tarefa', '0024a');
        }

        $isLotado = $this->lotacaoResource->getRepository()->findLotacaoBySetorAndColaborador(
            $restDto->getSetorResponsavel(),
            $restDto->getUsuarioResponsavel()->getColaborador()
        );

        if (!$isLotado) {
            $this->rulesTranslate->throwException('tarefa', '0024b');
        }

        return true;
    }

    public function getOrder(): int
    {
        return 13;
    }
}
