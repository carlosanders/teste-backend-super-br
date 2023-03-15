<?php

declare(strict_types=1);
/**
 * /src/Api/V1/Triggers/Processo/Trigger0005.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Triggers\Processo;

use Exception;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Processo;
use SuppCore\AdministrativoBackend\Api\V1\Resource\PessoaResource;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\Processo as ProcessoEntity;
use SuppCore\AdministrativoBackend\Triggers\TriggerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * Class Trigger0005.
 *
 * @descSwagger=Caso o processo seja novo a procedência será a instituição!
 * @classeSwagger=Trigger0005
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Trigger0005 implements TriggerInterface
{
    private PessoaResource $pessoaResource;

    private ParameterBagInterface $parameterBag;

    private AuthorizationCheckerInterface $authorizationChecker;

    private TokenStorageInterface $tokenStorage;

    /**
     * Trigger0005 constructor.
     */
    public function __construct(
        PessoaResource $pessoaResource,
        ParameterBagInterface $parameterBag,
        AuthorizationCheckerInterface $authorizationChecker,
        TokenStorageInterface $tokenStorage
    ) {
        $this->pessoaResource = $pessoaResource;
        $this->parameterBag = $parameterBag;
        $this->authorizationChecker = $authorizationChecker;
        $this->tokenStorage = $tokenStorage;
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
     * @throws Exception
     */
    public function execute(?RestDtoInterface $restDto, EntityInterface $entity, string $transactionId): void
    {
        if (!$restDto->getProcedencia() &&
            (ProcessoEntity::UA_DOSSIE === $restDto->getUnidadeArquivistica() ||
            (ProcessoEntity::TP_NOVO === $restDto->getTipoProtocolo())) &&
            $this->tokenStorage->getToken() &&
            $this->tokenStorage->getToken()->getUser() &&
            (null !== $this->tokenStorage->getToken()->getUser()->getColaborador())) {
            $cnpjInstituicao = $this->parameterBag->get('supp_core.administrativo_backend.cnpj_instituicao');
            $instituicao = $this->pessoaResource->getRepository()->findOneBy([
                'numeroDocumentoPrincipal' => $cnpjInstituicao,
            ]);
            $restDto->setProcedencia($instituicao);
        }
    }

    public function getOrder(): int
    {
        return 1;
    }
}
