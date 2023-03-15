<?php

declare(strict_types=1);
/**
 * /src/Api/V1/DTO/Acao.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\DTO;

use Nelmio\ApiDocBundle\Annotation\Model;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Etiqueta as EtiquetaDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\ModalidadeAcaoEtiqueta as ModalidadeAcaoEtiquetaDTO;
use SuppCore\AdministrativoBackend\DTO\RestDto;
use SuppCore\AdministrativoBackend\DTO\Traits\Blameable;
use SuppCore\AdministrativoBackend\DTO\Traits\IdUuid;
use SuppCore\AdministrativoBackend\DTO\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\DTO\Traits\Timeblameable;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\Etiqueta as EtiquetaEntity;
use SuppCore\AdministrativoBackend\Entity\ModalidadeAcaoEtiqueta as ModalidadeAcaoEtiquetaEntity;
use SuppCore\AdministrativoBackend\Form\Annotations as Form;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;
use OpenApi\Annotations as OA;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Acao.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @DTOMapper\JsonLD(
 *     jsonLDId="/v1/administrativo/acao/{id}",
 *     jsonLDType="Acao",
 *     jsonLDContext="/api/doc/#model-Acao"
 * )
 *
 * @Form\Form()
 */
class Acao extends RestDto
{
    use IdUuid;
    use Timeblameable;
    use Blameable;
    use Softdeleteable;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=false
     * )
     *
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $contexto = null;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Etiqueta",
     *     required=true
     * )
     *
     * @OA\Property(ref=@Model(type=EtiquetaDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Etiqueta")
     */
    protected ?EntityInterface $etiqueta = null;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\ModalidadeAcaoEtiqueta",
     *     required=true
     * )
     *
     * @OA\Property(ref=@Model(type=ModalidadeAcaoEtiquetaDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\ModalidadeAcaoEtiqueta")
     */
    protected ?EntityInterface $modalidadeAcaoEtiqueta = null;

    /**
     * @return EntityInterface|EtiquetaDTO|EtiquetaEntity|null
     */
    public function getEtiqueta(): ?EntityInterface
    {
        return $this->etiqueta;
    }

    /**
     * @param EntityInterface|EtiquetaDTO|EtiquetaEntity|null $etiqueta
     */
    public function setEtiqueta(?EntityInterface $etiqueta): self
    {
        $this->setVisited('etiqueta');

        $this->etiqueta = $etiqueta;

        return $this;
    }

    public function getContexto(): ?string
    {
        return $this->contexto;
    }

    public function setContexto(?string $contexto): self
    {
        $this->setVisited('contexto');

        $this->contexto = $contexto;

        return $this;
    }

    /**
     * @return EntityInterface|ModalidadeAcaoEtiquetaDTO|ModalidadeAcaoEtiquetaEntity|null
     */
    public function getModalidadeAcaoEtiqueta(): ?EntityInterface
    {
        return $this->modalidadeAcaoEtiqueta;
    }

    /**
     * @param EntityInterface|ModalidadeAcaoEtiquetaDTO|ModalidadeAcaoEtiquetaEntity|null $modalidadeAcaoEtiqueta
     */
    public function setModalidadeAcaoEtiqueta(?EntityInterface $modalidadeAcaoEtiqueta): self
    {
        $this->setVisited('modalidadeAcaoEtiqueta');

        $this->modalidadeAcaoEtiqueta = $modalidadeAcaoEtiqueta;

        return $this;
    }
}
