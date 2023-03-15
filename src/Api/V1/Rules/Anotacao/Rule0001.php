<?php

declare(strict_types=1);

namespace SuppCore\AdministrativoBackend\Api\V1\Rules\Anotacao;

use SuppCore\AdministrativoBackend\Api\V1\DTO\Anotacao as AnotacaoDTO;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\Anotacao;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\VinculacaoAnotacao;
use SuppCore\AdministrativoBackend\Rules\Exceptions\RuleException;
use SuppCore\AdministrativoBackend\Rules\RuleInterface;
use SuppCore\AdministrativoBackend\Rules\RulesTranslate;
use SuppCore\AdministrativoBackend\Utils\CoordenadorService;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * Class Rule0001.
 *
 * @descSwagger=Verifica se o usuário tem permissão para alterar o Aviso.
 */
class Rule0001 implements RuleInterface
{


    function __construct(
        private RulesTranslate $rulesTranslate
    )
    {

    }

    /**
     * @return array
     */
    public function supports(): array
    {
        return [
            AnotacaoDTO::class => [
                //DTO
                'beforeCreate'
            ],
        ];
    }

    /**
     *
     * @param RestDtoInterface|null $restDto
     * @param EntityInterface $entity
     * @param string $transactionId
     * @return bool
     */
    public function validate(?RestDtoInterface $restDto, EntityInterface $entity, string $transactionId): bool
    {

        /** @var AnotacaoDTO $restDto */
        if (str_contains($restDto->getDescricao(), 'ANO')) {
            //dd('erro');
            $this->rulesTranslate->throwException('anotacao', '0001');

        }

        return true;
    }

    /**
     * @return int
     */
    public function getOrder(): int
    {
        return 1;
    }
}