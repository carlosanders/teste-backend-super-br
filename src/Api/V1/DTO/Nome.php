<?php

declare(strict_types=1);
/**
 * /src/Api/V1/DTO/Nome.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\DTO;

use Nelmio\ApiDocBundle\Annotation\Model;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Pessoa as PessoaDTO;
use SuppCore\AdministrativoBackend\DTO\RestDto;
use SuppCore\AdministrativoBackend\DTO\Traits\Blameable;
use SuppCore\AdministrativoBackend\DTO\Traits\IdUuid;
use SuppCore\AdministrativoBackend\DTO\Traits\OrigemDados;
use SuppCore\AdministrativoBackend\DTO\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\DTO\Traits\Timeblameable;
use SuppCore\AdministrativoBackend\DTO\Traits\Valor;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\Pessoa as PessoaEntity;
use SuppCore\AdministrativoBackend\Form\Annotations as Form;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;
use SuppCore\AdministrativoBackend\Validator\Constraints as AppAssert;
use OpenApi\Annotations as OA;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Nome.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @AppAssert\DtoUniqueEntity(
 *     fieldMapping = {"valor": "valor","pessoa": "pessoa"},
 *     entityClass="SuppCore\AdministrativoBackend\Entity\Nome",
 *     message = "Nome já está em utilização para essa pessoa!"
 * )
 *
 * @DTOMapper\JsonLD(
 *     jsonLDId="/v1/administrativo/nome/{id}",
 *     jsonLDType="Nome",
 *     jsonLDContext="/api/doc/#model-Nome"
 * )
 *
 * @Form\Form()
 */
class Nome extends RestDto
{
    use IdUuid;
    use Valor;
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
