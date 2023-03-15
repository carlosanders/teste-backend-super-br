<?php

declare(strict_types=1);
/**
 * /src/Api/V1/DTO/VinculacaoProcesso.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\DTO;

use DMS\Filter\Rules as Filter;
use Nelmio\ApiDocBundle\Annotation\Model;
use SuppCore\AdministrativoBackend\Api\V1\DTO\ModalidadeVinculacaoProcesso as ModalidadeVinculacaoProcessoDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Processo as ProcessoDTO;
use SuppCore\AdministrativoBackend\DTO\RestDto;
use SuppCore\AdministrativoBackend\DTO\Traits\Blameable;
use SuppCore\AdministrativoBackend\DTO\Traits\IdUuid;
use SuppCore\AdministrativoBackend\DTO\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\DTO\Traits\Timeblameable;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\ModalidadeVinculacaoProcesso as ModalidadeVinculacaoProcessoEntity;
use SuppCore\AdministrativoBackend\Entity\Processo as ProcessoEntity;
use SuppCore\AdministrativoBackend\Form\Annotations as Form;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;
use SuppCore\AdministrativoBackend\Validator\Constraints as AppAssert;
use OpenApi\Annotations as OA;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class VinculacaoProcesso.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @DTOMapper\JsonLD(
 *     jsonLDId="/v1/administrativo/vinculacao_processo/{id}",
 *     jsonLDType="VinculacaoProcesso",
 *     jsonLDContext="/api/doc/#model-VinculacaoProcesso"
 * )
 *
 * @AppAssert\DtoUniqueEntity(
 *     fieldMapping = {"processoVinculado": "processoVinculado"},
 *     entityClass="SuppCore\AdministrativoBackend\Entity\VinculacaoProcesso",
 *     message = "Processo já se encontra vinculado a outro!"
 * )
 *
 * @Form\Form()
 */
class VinculacaoProcesso extends RestDto
{
    use IdUuid;
    use Timeblameable;
    use Blameable;
    use Softdeleteable;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Processo",
     *     required=true
     * )
     *
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @OA\Property(ref=@Model(type=ProcessoDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Processo")
     */
    protected ?EntityInterface $processo = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Processo",
     *     required=true
     * )
     *
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @OA\Property(ref=@Model(type=ProcessoDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Processo")
     */
    protected ?EntityInterface $processoVinculado = null;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\ModalidadeVinculacaoProcesso",
     *     required=true
     * )
     *
     * @OA\Property(ref=@Model(type=ModalidadeVinculacaoProcessoDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\ModalidadeVinculacaoProcesso")
     */
    protected ?EntityInterface $modalidadeVinculacaoProcesso = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=false
     * )
     *
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Campo deve ter no máximo {{ limit }} letras ou números"
     * )
     *
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Filter\ToUpper(encoding="UTF-8")
     *
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $observacao = null;

    /**
     * @param EntityInterface|ProcessoDTO|ProcessoEntity|null $processo
     */
    public function setProcesso(?EntityInterface $processo): self
    {
        $this->setVisited('processo');

        $this->processo = $processo;

        return $this;
    }

    /**
     * @return EntityInterface|ProcessoDTO|ProcessoEntity|null
     */
    public function getProcesso(): ?EntityInterface
    {
        return $this->processo;
    }

    /**
     * @param EntityInterface|ProcessoDTO|ProcessoEntity|null $processoVinculado
     */
    public function setProcessoVinculado(?EntityInterface $processoVinculado): self
    {
        $this->setVisited('processoVinculado');

        $this->processoVinculado = $processoVinculado;

        return $this;
    }

    /**
     * @return EntityInterface|ProcessoDTO|ProcessoEntity|null
     */
    public function getProcessoVinculado(): ?EntityInterface
    {
        return $this->processoVinculado;
    }

    /**
     * @return EntityInterface|ModalidadeVinculacaoProcessoDTO|ModalidadeVinculacaoProcessoEntity|null|null
     */
    public function getModalidadeVinculacaoProcesso(): ?EntityInterface
    {
        return $this->modalidadeVinculacaoProcesso;
    }

    /**
     * @param EntityInterface|ModalidadeVinculacaoProcessoDTO|ModalidadeVinculacaoProcessoEntity|null $modalidadeVinculacaoProcesso
     */
    public function setModalidadeVinculacaoProcesso(
        ?EntityInterface $modalidadeVinculacaoProcesso
    ): self {
        $this->setVisited('modalidadeVinculacaoProcesso');

        $this->modalidadeVinculacaoProcesso = $modalidadeVinculacaoProcesso;

        return $this;
    }

    public function getObservacao(): ?string
    {
        return $this->observacao;
    }

    public function setObservacao(?string $observacao): self
    {
        $this->setVisited('observacao');

        $this->observacao = $observacao;

        return $this;
    }
}
