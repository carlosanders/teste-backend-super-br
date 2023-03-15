<?php

declare(strict_types=1);
/**
 * /src/Api/V1/DTO/Volume.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\DTO;

use Nelmio\ApiDocBundle\Annotation\Model;
use SuppCore\AdministrativoBackend\Api\V1\DTO\ModalidadeMeio as ModalidadeMeioDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Processo as ProcessoDTO;
use SuppCore\AdministrativoBackend\DTO\RestDto;
use SuppCore\AdministrativoBackend\DTO\Traits\Blameable;
use SuppCore\AdministrativoBackend\DTO\Traits\IdUuid;
use SuppCore\AdministrativoBackend\DTO\Traits\OrigemDados;
use SuppCore\AdministrativoBackend\DTO\Traits\Timeblameable;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\ModalidadeMeio as ModalidadeMeioEntity;
use SuppCore\AdministrativoBackend\Entity\Processo as ProcessoEntity;
use SuppCore\AdministrativoBackend\Form\Annotations as Form;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;
use OpenApi\Annotations as OA;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Volume.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @DTOMapper\JsonLD(
 *     jsonLDId="/v1/administrativo/volume/{id}",
 *     jsonLDType="Volume",
 *     jsonLDContext="/api/doc/#model-Volume"
 * )
 *
 * @Form\Form()
 */
class Volume extends RestDto
{
    use IdUuid;
    use Timeblameable;
    use Blameable;
    use OrigemDados;

    /**
     * @OA\Property(type="integer")
     * @DTOMapper\Property()
     */
    protected ?int $numeracaoSequencial = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\ModalidadeMeio",
     *     required=true
     * )
     *
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @OA\Property(ref=@Model(type=ModalidadeMeioDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\ModalidadeMeio")
     */
    protected ?EntityInterface $modalidadeMeio = null;

    /**
     * @OA\Property(type="boolean", default=false)
     * @DTOMapper\Property()
     */
    protected ?bool $encerrado = false;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Processo",
     *     required=true,
     *     methods={
     *          @Form\Method(
     *              "createMethod"
     *          ),
     *          @Form\Method(
     *              "updateMethod",
     *              roles={
     *                  "ROLE_ROOT"
     *              }
     *          ),
     *          @Form\Method(
     *              "patchMethod",
     *              roles={
     *                  "ROLE_ROOT"
     *              }
     *          )
     *     }
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

    public function getNumeracaoSequencial(): ?int
    {
        return $this->numeracaoSequencial;
    }

    public function setNumeracaoSequencial(?int $numeracaoSequencial): self
    {
        $this->setVisited('numeracaoSequencial');

        $this->numeracaoSequencial = $numeracaoSequencial;

        return $this;
    }

    /**
     * @return EntityInterface|ModalidadeMeioDTO|ModalidadeMeioEntity|null
     */
    public function getModalidadeMeio(): ?EntityInterface
    {
        return $this->modalidadeMeio;
    }

    /**
     * @param EntityInterface|ModalidadeMeioDTO|ModalidadeMeioEntity|null $modalidadeMeio
     */
    public function setModalidadeMeio(?EntityInterface $modalidadeMeio): self
    {
        $this->setVisited('modalidadeMeio');

        $this->modalidadeMeio = $modalidadeMeio;

        return $this;
    }

    public function getEncerrado(): ?bool
    {
        return $this->encerrado;
    }

    public function setEncerrado(?bool $encerrado): self
    {
        $this->setVisited('encerrado');

        $this->encerrado = $encerrado;

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
     * @param EntityInterface|ProcessoDTO|ProcessoEntity|null $processo
     */
    public function setProcesso(?EntityInterface $processo): self
    {
        $this->setVisited('processo');

        $this->processo = $processo;

        return $this;
    }
}
