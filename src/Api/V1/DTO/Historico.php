<?php

declare(strict_types=1);
/**
 * /src/Api/V1/DTO/Historico.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\DTO;

use DateTime;
use Nelmio\ApiDocBundle\Annotation\Model;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Processo as ProcessoDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Usuario as UsuarioDTO;
use SuppCore\AdministrativoBackend\DTO\RestDto;
use SuppCore\AdministrativoBackend\DTO\Traits\Descricao;
use SuppCore\AdministrativoBackend\DTO\Traits\IdUuid;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\Processo as ProcessoEntity;
use SuppCore\AdministrativoBackend\Entity\Usuario as UsuarioEntity;
use SuppCore\AdministrativoBackend\Form\Annotations as Form;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;
use Symfony\Component\Validator\Constraints as Assert;
use OpenApi\Annotations as OA;

/**
 * Class Historico.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @DTOMapper\JsonLD(
 *     jsonLDId="/v1/administrativo/historico/{id}",
 *     jsonLDType="Historico",
 *     jsonLDContext="/api/doc/#model-Historico"
 * )
 *
 * @Form\Form()
 */
class Historico extends RestDto
{
    use IdUuid;
    use Descricao;

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
     * @var UsuarioDTO|UsuarioEntity|EntityInterface|int|null
     *
     * @OA\Property(ref=@Model(type=UsuarioDTO::class))
     *
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Usuario")
     */
    protected $criadoPor;

    /**
     * @OA\Property(type="string", format="date-time")
     * @DTOMapper\Property()
     */
    protected ?DateTime $criadoEm = null;

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

    /**
     * @return Usuario|EntityInterface|UsuarioEntity|null
     */
    public function getCriadoPor()
    {
        return $this->criadoPor;
    }

    /**
     * @param UsuarioDTO|EntityInterface|UsuarioEntity|null $criadoPor
     */
    public function setCriadoPor($criadoPor): self
    {
        $this->criadoPor = $criadoPor;

        return $this;
    }

    public function getCriadoEm(): ?DateTime
    {
        return $this->criadoEm;
    }

    public function setCriadoEm(?DateTime $criadoEm): self
    {
        $this->criadoEm = $criadoEm;

        return $this;
    }
}
