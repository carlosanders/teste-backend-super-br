<?php

declare(strict_types=1);
/**
 * /src/Api/V1/DTO/RelacionamentoPessoal.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\DTO;

use Nelmio\ApiDocBundle\Annotation\Model;
use SuppCore\AdministrativoBackend\Api\V1\DTO\ModalidadeRelacionamentoPessoal as ModalidadeRelacionamentoPessoalDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Pessoa as PessoaDTO;
use SuppCore\AdministrativoBackend\DTO\RestDto;
use SuppCore\AdministrativoBackend\DTO\Traits\Blameable;
use SuppCore\AdministrativoBackend\DTO\Traits\IdUuid;
use SuppCore\AdministrativoBackend\DTO\Traits\OrigemDados;
use SuppCore\AdministrativoBackend\DTO\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\DTO\Traits\Timeblameable;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\ModalidadeRelacionamentoPessoal as ModalidadeRelacionamentoPessoalEntity;
use SuppCore\AdministrativoBackend\Entity\Pessoa as PessoaEntity;
use SuppCore\AdministrativoBackend\Form\Annotations as Form;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;
use OpenApi\Annotations as OA;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class RelacionamentoPessoal.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @DTOMapper\JsonLD(
 *     jsonLDId="/v1/administrativo/relacionamento_pessoal/{id}",
 *     jsonLDType="RelacionamentoPessoal",
 *     jsonLDContext="/api/doc/#model-RelacionamentoPessoal"
 * )
 *
 * @Form\Form()
 */
class RelacionamentoPessoal extends RestDto
{
    use IdUuid;
    use Timeblameable;
    use Blameable;
    use Softdeleteable;
    use OrigemDados;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Pessoa",
     *     required=true
     * )
     *
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @OA\Property(ref=@Model(type=PessoaDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Pessoa")
     */
    protected ?EntityInterface $pessoa = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Pessoa",
     *     required=true
     * )
     *
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @OA\Property(ref=@Model(type=PessoaDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Pessoa")
     */
    protected ?EntityInterface $pessoaRelacionada = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\ModalidadeRelacionamentoPessoal",
     *     required=false
     * )
     *
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @OA\Property(ref=@Model(type=ModalidadeRelacionamentoPessoalDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\ModalidadeRelacionamentoPessoal")
     */
    protected ?EntityInterface $modalidadeRelacionamentoPessoal = null;

    /**
     * @return EntityInterface|ModalidadeRelacionamentoPessoalDTO|ModalidadeRelacionamentoPessoalEntity|null
     */
    public function getModalidadeRelacionamentoPessoal(): ?EntityInterface
    {
        return $this->modalidadeRelacionamentoPessoal;
    }

    /**
     * @param EntityInterface|ModalidadeRelacionamentoPessoalDTO|ModalidadeRelacionamentoPessoalEntity|null $modalidadeRelacionamentoPessoal
     */
    public function setModalidadeRelacionamentoPessoal(
        ?EntityInterface $modalidadeRelacionamentoPessoal
    ): self {
        $this->setVisited('modalidadeRelacionamentoPessoal');

        $this->modalidadeRelacionamentoPessoal = $modalidadeRelacionamentoPessoal;

        return $this;
    }

    /**
     * @return EntityInterface|PessoaDTO|PessoaEntity|null
     */
    public function getPessoaRelacionada(): ?EntityInterface
    {
        return $this->pessoaRelacionada;
    }

    /**
     * @param EntityInterface|PessoaDTO|PessoaEntity|null $pessoaRelacionada
     */
    public function setPessoaRelacionada(?EntityInterface $pessoaRelacionada): self
    {
        $this->setVisited('pessoaRelacionada');

        $this->pessoaRelacionada = $pessoaRelacionada;

        return $this;
    }

    /**
     * @return EntityInterface|PessoaDTO|PessoaEntity|null
     */
    public function getPessoa(): ?EntityInterface
    {
        return $this->pessoa;
    }

    /**
     * @param EntityInterface|PessoaDTO|PessoaEntity|null $pessoa
     */
    public function setPessoa(?EntityInterface $pessoa): self
    {
        $this->setVisited('pessoa');

        $this->pessoa = $pessoa;

        return $this;
    }
}
