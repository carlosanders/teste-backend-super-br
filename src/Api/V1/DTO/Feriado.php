<?php

declare(strict_types=1);
/**
 * /src/Api/V1/DTO/Feriado.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\DTO;

use DateTime;
use Nelmio\ApiDocBundle\Annotation\Model;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Estado as EstadoDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Municipio as MunicipioDTO;
use SuppCore\AdministrativoBackend\DTO\RestDto;
use SuppCore\AdministrativoBackend\DTO\Traits\Ativo;
use SuppCore\AdministrativoBackend\DTO\Traits\Blameable;
use SuppCore\AdministrativoBackend\DTO\Traits\IdUuid;
use SuppCore\AdministrativoBackend\DTO\Traits\Nome;
use SuppCore\AdministrativoBackend\DTO\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\DTO\Traits\Timeblameable;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\Estado as EstadoEntity;
use SuppCore\AdministrativoBackend\Entity\Municipio as MunicipioEntity;
use SuppCore\AdministrativoBackend\Form\Annotations as Form;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;
use SuppCore\AdministrativoBackend\Validator\Constraints as AppAssert;
use OpenApi\Annotations as OA;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Feriado.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @AppAssert\DtoUniqueEntity(
 *      fieldMapping = {"nome": "nome"},
 *      entityClass="SuppCore\AdministrativoBackend\Entity\Feriado",
 *      message = "Campo já está em utilização!"
 * )
 *
 * @DTOMapper\JsonLD(
 *     jsonLDId="/v1/administrativo/feriado/{id}",
 *     jsonLDType="Feriado",
 *     jsonLDContext="/api/doc/#model-Feriado"
 * )
 *
 * @Form\Form()
 */
class Feriado extends RestDto
{
    use IdUuid;
    use Nome;
    use Ativo;
    use Timeblameable;
    use Blameable;
    use Softdeleteable;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\DateTimeType",
     *     widget="single_text",
     *     required=false
     * )
     *
     * @Assert\NotNull(
     *     message="A data do feriado não pode ser nula!"
     * )
     *
     * @OA\Property(type="string", format="date-time")
     * @DTOMapper\Property()
     */
    protected ?DateTime $dataFeriado = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Municipio",
     *     required=false
     * )
     *
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @OA\Property(ref=@Model(type=MunicipioDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Municipio")
     */
    protected ?EntityInterface $municipio = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Estado",
     *     required=false
     * )
     *
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @OA\Property(ref=@Model(type=EstadoDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Estado")
     */
    protected ?EntityInterface $estado = null;

    /**
     * @return EntityInterface|EstadoDTO|EstadoEntity|null
     */
    public function getEstado(): ?EntityInterface
    {
        return $this->estado;
    }

    /**
     * @param EntityInterface|EstadoDTO|EstadoEntity|null $estado
     */
    public function setEstado(?EntityInterface $estado): self
    {
        $this->setVisited('estado');

        $this->estado = $estado;

        return $this;
    }

    /**
     * @return EntityInterface|MunicipioDTO|MunicipioEntity|null
     */
    public function getMunicipio(): ?EntityInterface
    {
        return $this->municipio;
    }

    /**
     * @param EntityInterface|MunicipioDTO|MunicipioEntity|null $municipio
     */
    public function setMunicipio(?EntityInterface $municipio): self
    {
        $this->setVisited('municipio');

        $this->municipio = $municipio;

        return $this;
    }

    public function getDataFeriado(): ?DateTime
    {
        return $this->dataFeriado;
    }

    public function setDataFeriado(?DateTime $dataFeriado): self
    {
        $this->setVisited('dataFeriado');

        $this->dataFeriado = $dataFeriado;

        return $this;
    }
}
