<?php

declare(strict_types=1);
/**
 * /src/Api/V1/Rules/Atividade/Rule0001.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Rules\Atividade;

use SuppCore\AdministrativoBackend\Api\V1\DTO\Atividade;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Lotacao;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Repository\LotacaoRepository;
use SuppCore\AdministrativoBackend\Rules\Exceptions\RuleException;
use SuppCore\AdministrativoBackend\Rules\RuleInterface;
use SuppCore\AdministrativoBackend\Rules\RulesTranslate;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class Rule0001.
 *
 * @descSwagger=Essa atividade teve seu uso inibido no consultivo!
 * @classeSwagger=Rule0001
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Rule0001 implements RuleInterface
{
    private RulesTranslate $rulesTranslate;

    private TokenStorageInterface $tokenStorage;

    private LotacaoRepository $lotacaoRepository;

    /**
     * Rule0001 constructor.
     */
    public function __construct(
        RulesTranslate $rulesTranslate,
        TokenStorageInterface $tokenStorage,
        LotacaoRepository $lotacaoRepository,
        private ParameterBagInterface $parameterBag
    ) {
        $this->rulesTranslate = $rulesTranslate;
        $this->tokenStorage = $tokenStorage;
        $this->lotacaoRepository = $lotacaoRepository;
    }

    public function supports(): array
    {
        return [
            Atividade::class => [
                'beforeCreate',
            ],
        ];
    }

    /**
     * @param Atividade|RestDtoInterface|null                                  $restDto
     * @param \SuppCore\AdministrativoBackend\Entity\Atividade|EntityInterface $entity
     *
     * @throws RuleException
     */
    public function validate(?RestDtoInterface $restDto, EntityInterface $entity, string $transactionId): bool
    {
        if ($this->parameterBag->get('constantes.entidades.especie_atividade.const_3') === $restDto->getEspecieAtividade()->getNome() ||
            $this->parameterBag->get('constantes.entidades.especie_atividade.const_4') === $restDto->getEspecieAtividade()->getNome()) {
            /** @var Lotacao $lotacaoPrincipal */
            $lotacaoPrincipal = $this->lotacaoRepository->findLotacaoPrincipal($this->tokenStorage->getToken()->getUser()->getId());

            if ($lotacaoPrincipal &&
                ($this->parameterBag->get('constantes.entidades.setor.const_1') != $lotacaoPrincipal->getSetor()->getUnidade()->getNome()) &&
                (($this->parameterBag->get('constantes.entidades.modalidade_orgao_central.const_1') == $lotacaoPrincipal->getSetor()->getUnidade()->getModalidadeOrgaoCentral()->getValor()) ||
                    ($this->parameterBag->get('constantes.entidades.modalidade_orgao_central.const_2') == $lotacaoPrincipal->getSetor()->getUnidade()->getModalidadeOrgaoCentral()->getValor()))) {
                $this->rulesTranslate->throwException('atividade', '0001');
            }
        }

        return true;
    }

    public function getOrder(): int
    {
        return 1;
    }
}
