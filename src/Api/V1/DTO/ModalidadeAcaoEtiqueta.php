<?php

declare(strict_types=1);
/**
 * /src/Api/V1/DTO/ModalidadeAcaoEtiqueta.php.
 */

namespace SuppCore\AdministrativoBackend\Api\V1\DTO;

use DMS\Filter\Rules as Filter;
use Nelmio\ApiDocBundle\Annotation\Model;
use SuppCore\AdministrativoBackend\DTO\ModalidadeEtiqueta as ModalidadeEtiquetaDTO;
use SuppCore\AdministrativoBackend\DTO\RestDto;
use SuppCore\AdministrativoBackend\DTO\Traits\Ativo;
use SuppCore\AdministrativoBackend\DTO\Traits\Blameable;
use SuppCore\AdministrativoBackend\DTO\Traits\Descricao;
use SuppCore\AdministrativoBackend\DTO\Traits\IdUuid;
use SuppCore\AdministrativoBackend\DTO\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\DTO\Traits\Timeblameable;
use SuppCore\AdministrativoBackend\DTO\Traits\Valor;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\ModalidadeEtiqueta as ModalidadeEtiquetaEntity;
use SuppCore\AdministrativoBackend\Form\Annotations as Form;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;
use OpenApi\Annotations as OA;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class ModalidadeAcaoEtiqueta.
 *
 * @DTOMapper\JsonLD(
 *     jsonLDId="/v1/administrativo/modalidade_acao_etiqueta/{id}",
 *     jsonLDType="ModalidadeAcaoEtiqueta",
 *     jsonLDContext="/api/doc/#model-ModalidadeAcaoEtiqueta"
 * )
 *
 * @Form\Form()
 * @Form\Cacheable(expire="86400")
 */
class ModalidadeAcaoEtiqueta extends RestDto
{
    use IdUuid;
    use Valor;
    use Descricao;
    use Ativo;
    use Timeblameable;
    use Blameable;
    use Softdeleteable;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\ModalidadeEtiqueta",
     *     required=false
     * )
     *
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @OA\Property(ref=@Model(type=ModalidadeEtiquetaDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\ModalidadeEtiqueta")
     */
    protected ?EntityInterface $modalidadeEtiqueta = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=true
     * )
     *
     * @Filter\Trim()
     * @Filter\StripNewlines()
     *
     * @Assert\NotBlank(
     *     message="O campo não pode estar em branco!"
     * )
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $trigger = null;

    /**
     * @return EntityInterface|ModalidadeEtiquetaDTO|ModalidadeEtiquetaEntity|null
     */
    public function getModalidadeEtiqueta(): ?EntityInterface
    {
        return $this->modalidadeEtiqueta;
    }

    /**
     * @param EntityInterface|ModalidadeEtiquetaDTO|ModalidadeEtiquetaEntity|null $modalidadeEtiqueta
     */
    public function setModalidadeEtiqueta(?EntityInterface $modalidadeEtiqueta): self
    {
        $this->setVisited('modalidadeEtiqueta');

        $this->modalidadeEtiqueta = $modalidadeEtiqueta;

        return $this;
    }

    public function getTrigger(): ?string
    {
        return $this->trigger;
    }

    public function setTrigger(?string $trigger): self
    {
        $this->setVisited('trigger');

        $this->trigger = $trigger;

        return $this;
    }
}
