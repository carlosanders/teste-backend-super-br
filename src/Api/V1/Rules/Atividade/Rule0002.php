<?php

declare(strict_types=1);
/**
 * /src/Api/V1/Rules/Atividade/Rule0002.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Rules\Atividade;

use SuppCore\AdministrativoBackend\Api\V1\DTO\Atividade;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\Usuario;
use SuppCore\AdministrativoBackend\Entity\VinculacaoUsuario;
use SuppCore\AdministrativoBackend\Repository\VinculacaoUsuarioRepository;
use SuppCore\AdministrativoBackend\Rules\Exceptions\RuleException;
use SuppCore\AdministrativoBackend\Rules\RuleInterface;
use SuppCore\AdministrativoBackend\Rules\RulesTranslate;
use SuppCore\AdministrativoBackend\Utils\CoordenadorService;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class Rule0002.
 *
 * @descSwagger  =Apenas o usuário responsável pela tarefa pode encerrá-la!
 * @classeSwagger=Rule0002
 *
 * @author       Advocacia-Geral da União <supp@agu.gov.br>
 */
class Rule0002 implements RuleInterface
{
    private RulesTranslate $rulesTranslate;
    private TokenStorageInterface $tokenStorage;
    private VinculacaoUsuarioRepository $vinculacaoUsuarioRepository;
    private CoordenadorService $coordenadorService;

    /**
     * Rule0002 constructor.
     */
    public function __construct(
        RulesTranslate $rulesTranslate,
        TokenStorageInterface $tokenStorage,
        VinculacaoUsuarioRepository $vinculacaoUsuarioRepository,
        CoordenadorService $coordenadorService
    ) {
        $this->rulesTranslate = $rulesTranslate;
        $this->tokenStorage = $tokenStorage;
        $this->vinculacaoUsuarioRepository = $vinculacaoUsuarioRepository;
        $this->coordenadorService = $coordenadorService;
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
        if (!$this->tokenStorage->getToken() ||
            !$this->tokenStorage->getToken()->getUser()) {
            return true;
        }

        /** @var Usuario $usuario */
        $usuario = $this->tokenStorage->getToken()->getUser();

        // usuário responsável
        if ($restDto->getTarefa()->getUsuarioResponsavel()->getId() === $usuario->getId()) {
            return true;
        }

        // caso NÃO é encerramento da tarefa, qualquer usuario pode lançar atividade
        if (!$restDto->getEncerraTarefa() && (0 === count($restDto->getDocumentos()))) {
            return true;
        }

        // coordenador
        $isCoordenador = false;
        $isCoordenador |= $this->coordenadorService
            ->verificaUsuarioCoordenadorSetor([$restDto->getTarefa()->getSetorResponsavel()]);
        $isCoordenador |= $this->coordenadorService
            ->verificaUsuarioCoordenadorUnidade([$restDto->getTarefa()->getSetorResponsavel()->getUnidade()]);
        $isCoordenador |= $this->coordenadorService
            ->verificaUsuarioCoordenadorOrgaoCentral(
                [$restDto->getTarefa()->getSetorResponsavel()->getUnidade()->getModalidadeOrgaoCentral()]
            );

        if ($isCoordenador) {
            return true;
        }

        // caso é encerramento da tarefa, somente responsável, assessor, coordenador
        // assessor
        /** @var VinculacaoUsuario $vinculacaoUsuario */
        $vinculacaoUsuario = $this->vinculacaoUsuarioRepository->findByUsuarioAndUsuarioVinculado(
            $restDto->getTarefa()->getUsuarioResponsavel()->getId(),
            $usuario->getId()
        );
        if ($vinculacaoUsuario) {
            // pode encerrar tarefa?
            if ($restDto->getEncerraTarefa() &&
                !$vinculacaoUsuario->getEncerraTarefa()) {
                $this->rulesTranslate->throwException('atividade', '0002');
            }

            return true;
        }

        $this->rulesTranslate->throwException('atividade', '0002');
    }

    public function getOrder(): int
    {
        return 2;
    }
}
