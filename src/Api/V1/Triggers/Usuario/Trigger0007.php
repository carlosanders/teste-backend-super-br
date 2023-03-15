<?php

declare(strict_types=1);
/**
 * /src/Api/V1/Triggers/Usuario/Trigger0007.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Triggers\Usuario;

use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\Exception\ORMException;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Pessoa;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Pessoa as PessoaDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Usuario;
use SuppCore\AdministrativoBackend\Api\V1\DTO\VinculacaoPessoaUsuario;
use SuppCore\AdministrativoBackend\Api\V1\Resource\PessoaResource;
use SuppCore\AdministrativoBackend\Api\V1\Resource\VinculacaoPessoaUsuarioResource;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Repository\ModalidadeGeneroPessoaRepository;
use SuppCore\AdministrativoBackend\Repository\ModalidadeQualificacaoPessoaRepository;
use SuppCore\AdministrativoBackend\Triggers\TriggerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

/**
 * Class Trigger0007.
 *
 * @descSwagger=Criar uma pessoa para o usuário cadastrado se não existir e realiza a vinculação!
 * @classeSwagger=Trigger0007
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Trigger0007 implements TriggerInterface
{
    private PessoaResource $pessoaResource;
    private ModalidadeGeneroPessoaRepository $modalidadeGeneroPessoaRepository;
    private ModalidadeQualificacaoPessoaRepository $modalidadeQualificacaoPessoaRepository;
    private VinculacaoPessoaUsuarioResource $vinculacaoPessoaUsuarioResource;

    /**
     * Trigger0007 constructor.
     */
    public function __construct(
        PessoaResource $pessoaResource,
        ModalidadeGeneroPessoaRepository $modalidadeGeneroPessoaRepository,
        ModalidadeQualificacaoPessoaRepository $modalidadeQualificacaoPessoaRepository,
        VinculacaoPessoaUsuarioResource $vinculacaoPessoaUsuarioResource,
        private ParameterBagInterface $parameterBag
    ) {
        $this->pessoaResource = $pessoaResource;
        $this->modalidadeGeneroPessoaRepository = $modalidadeGeneroPessoaRepository;
        $this->modalidadeQualificacaoPessoaRepository = $modalidadeQualificacaoPessoaRepository;
        $this->vinculacaoPessoaUsuarioResource = $vinculacaoPessoaUsuarioResource;
    }

    public function supports(): array
    {
        return [
            Usuario::class => [
                'afterCreate',
            ],
        ];
    }

    /**
     * @param Usuario|RestDtoInterface|null $restDto
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function execute(?RestDtoInterface $restDto, EntityInterface $entity, string $transactionId): void
    {
        // já existe uma pessoa na base?
        $pessoaEntity = $this->pessoaResource->getRepository()->findOneBy(
            ['numeroDocumentoPrincipal' => $restDto->getUsername()]
        );

        if (!$pessoaEntity) {
            $pessoaDTO = new Pessoa();
            $pessoaDTO->setNome($restDto->getNome());
            $pessoaDTO->setNumeroDocumentoPrincipal($restDto->getUsername());
            $pessoaDTO->setModalidadeGeneroPessoa(
                $this->modalidadeGeneroPessoaRepository->findOneBy(
                    ['valor' => $this->parameterBag->get('constantes.entidades.modalidade_genero_pessoa.const_1')]
                )
            );
            $pessoaDTO->setModalidadeQualificacaoPessoa(
                $this->modalidadeQualificacaoPessoaRepository->findOneBy(
                    ['valor' => $this->parameterBag->get('constantes.entidades.modalidade_genero_pessoa.const_2')]
                )
            );

            $pessoaEntity = $this->pessoaResource->create(
                $pessoaDTO,
                $transactionId
            );
        } else {
            $pessoaDTO = new PessoaDTO();
            $this->pessoaResource->update(
                $pessoaEntity->getId(),
                $pessoaDTO,
                $transactionId
            );
        }

        // vinculação
        $vinculacaoPessoaUsuarioDTO = new VinculacaoPessoaUsuario();
        $vinculacaoPessoaUsuarioDTO->setUsuarioVinculado($entity);
        $vinculacaoPessoaUsuarioDTO->setPessoa($pessoaEntity);

        $this->vinculacaoPessoaUsuarioResource->create(
            $vinculacaoPessoaUsuarioDTO,
            $transactionId
        );
    }

    public function getOrder(): int
    {
        return 1;
    }
}
