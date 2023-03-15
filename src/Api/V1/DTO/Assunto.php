<?php

declare(strict_types=1);
/**
 * /src/Api/V1/DTO/Assunto.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\DTO;

use Nelmio\ApiDocBundle\Annotation\Model;
use SuppCore\AdministrativoBackend\Api\V1\DTO\AssuntoAdministrativo as AssuntoAdministrativoDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Processo as ProcessoDTO;
use SuppCore\AdministrativoBackend\DTO\RestDto;
use SuppCore\AdministrativoBackend\DTO\Traits\Blameable;
use SuppCore\AdministrativoBackend\DTO\Traits\IdUuid;
use SuppCore\AdministrativoBackend\DTO\Traits\OrigemDados;
use SuppCore\AdministrativoBackend\DTO\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\DTO\Traits\Timeblameable;
use SuppCore\AdministrativoBackend\Entity\AssuntoAdministrativo as AssuntoAdministrativoEntity;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\Processo as ProcessoEntity;
use SuppCore\AdministrativoBackend\Form\Annotations as Form;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;
use OpenApi\Annotations as OA;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Assunto.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @DTOMapper\JsonLD(
 *     jsonLDId="/v1/administrativo/assunto/{id}",
 *     jsonLDType="Assunto",
 *     jsonLDContext="/api/doc/#model-Assunto"
 * )
 *
 * @Form\Form()
 */
class Assunto extends RestDto
{
    use IdUuid;
    use Timeblameable;
    use Softdeleteable;
    use Blameable;
    use OrigemDados;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\AssuntoAdministrativo",
     *     required=false
     * )
     *
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @OA\Property(ref=@Model(type=AssuntoAdministrativoDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\AssuntoAdministrativo")
     */
    protected ?EntityInterface $assuntoAdministrativo = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\CheckboxType",
     *     required=false
     * )
     *
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @OA\Property(type="boolean", default=true)
     * @DTOMapper\Property()
     */
    protected bool $principal = true;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Processo",
     *     required=false
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
     * @return EntityInterface|AssuntoAdministrativoDTO|AssuntoAdministrativoEntity|null
     */
    public function getAssuntoAdministrativo(): ?EntityInterface
    {
        return $this->assuntoAdministrativo;
    }

    /**
     * @param EntityInterface|AssuntoAdministrativoDTO|AssuntoAdministrativoEntity|null $assuntoAdministrativo
     */
    public function setAssuntoAdministrativo(?EntityInterface $assuntoAdministrativo): self
    {
        $this->setVisited('assuntoAdministrativo');

        $this->assuntoAdministrativo = $assuntoAdministrativo;

        return $this;
    }

    public function getPrincipal(): ?bool
    {
        return $this->principal;
    }

    public function setPrincipal(?bool $principal): self
    {
        $this->setVisited('principal');

        $this->principal = $principal;

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
