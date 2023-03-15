<?php

declare(strict_types=1);
/**
 * /src/Api/V1/Rules/ChatParticipante/Rule0004.php.
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Rules\ChatParticipante;

use SuppCore\AdministrativoBackend\Api\V1\DTO\ChatParticipante as ChatParticipanteDTO;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\ChatParticipante as ChatParticipanteEntity;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Rules\Exceptions\RuleException;
use SuppCore\AdministrativoBackend\Rules\RuleInterface;
use SuppCore\AdministrativoBackend\Rules\RulesTranslate;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class Rule0004.
 *
 * @descSwagger=Somente um administrador do grupo pode adicionar ou remover participantes!
 * @classeSwagger=Rule0004
 */
class Rule0004 implements RuleInterface
{
    /**
     * Rule0004 constructor.
     * @param RulesTranslate $rulesTranslate
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(private RulesTranslate $rulesTranslate,
                                private TokenStorageInterface $tokenStorage)
    {
    }

    public function supports(): array
    {
        return [
            ChatParticipanteEntity::class => [
                'beforeCreate',
                'beforeDelete',
            ],
            ChatParticipanteDTO::class => [
                'beforeCreate',
                'beforeDelete',
            ],
        ];
    }

    /**
     * @param RestDtoInterface|null $restDto
     * @param EntityInterface $entity
     * @param string $transactionId
     * @return bool
     * @throws RuleException
     */
    public function validate(?RestDtoInterface $restDto, EntityInterface $entity, string $transactionId): bool
    {
        $obj = $restDto ?: $entity;

        if ($obj->getChat()->getId() && $obj->getChat()->getGrupo() && $this->tokenStorage->getToken()) {

            $usuarioLogado = $this->tokenStorage->getToken()->getUser();

            if ($entity->getUsuario()?->getId() === $usuarioLogado->getId()) {
                return true;
            }

            $chatParticipante = null;

            foreach ($obj->getChat()->getParticipantes() as $participante) {
                if ($participante->getUsuario()->getId() === $usuarioLogado->getId()) {
                    $chatParticipante = $participante;
                    break;
                }
            }

            if (!$chatParticipante || $chatParticipante?->getAdministrador() !== true) {
                $this->rulesTranslate->throwException('chatParticipante', '0004');
            }
        }

        return true;
    }

    public function getOrder(): int
    {
        return 1;
    }
}
