<?php

declare(strict_types=1);
/**
 * /src/Api/V1/DTO/Avaliacao.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\DTO;

use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Annotations as OA;
use SuppCore\AdministrativoBackend\Api\V1\DTO\ObjetoAvaliado as ObjetoAvaliadoDTO;
use SuppCore\AdministrativoBackend\DTO\RestDto;
use SuppCore\AdministrativoBackend\DTO\Traits\Blameable;
use SuppCore\AdministrativoBackend\DTO\Traits\IdUuid;
use SuppCore\AdministrativoBackend\DTO\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\DTO\Traits\Timeblameable;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\ObjetoAvaliado as ObjetoAvaliadoEntity;
use SuppCore\AdministrativoBackend\Form\Annotations as Form;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Avaliacao.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @DTOMapper\JsonLD(
 *     jsonLDId="/v1/administrativo/avaliacao/{id}",
 *     jsonLDType="Avaliacao",
 *     jsonLDContext="/api/doc/#model-Avaliacao"
 * )
 *
 * @Form\Form()
 */
class Avaliacao extends RestDto
{
    use IdUuid;
    use Timeblameable;
    use Blameable;
    use Softdeleteable;

    /**
     * @var ObjetoAvaliadoEntity|null
     *
     * @OA\Property(ref=@Model(type=ObjetoAvaliadoDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\ObjetoAvaliado")
     */
    protected ?EntityInterface $objetoAvaliado = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=true
     * )
     *
     * @OA\Property(type="string")
     */
    protected ?string $classe = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\NumberType",
     *     required=true
     * )
     *
     * @OA\Property(type="integer")
     */
    protected ?int $objetoId = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\NumberType",
     *     required=true
     * )
     *
     * @Assert\Range(
     *      min = 0,
     *      max = 100,
     *      notInRangeMessage = "Campo deve ser entre {{ min }} e {{ max }}"
     * )
     *
     * @OA\Property(type="integer")
     * @DTOMapper\Property()
     */
    protected ?int $avaliacao = null;

    /**
     * @return ObjetoAvaliadoEntity|EntityInterface|null
     */
    public function getObjetoAvaliado(): EntityInterface|null
    {
        return $this->objetoAvaliado;
    }

    /**
     * @param EntityInterface|null $objetoAvaliado
     *
     * @return Avaliacao
     */
    public function setObjetoAvaliado(EntityInterface|null $objetoAvaliado): Avaliacao
    {
        $this->setVisited('objetoAvaliado');
        $this->objetoAvaliado = $objetoAvaliado;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getAvaliacao(): ?int
    {
        return $this->avaliacao;
    }

    /**
     * @param int|null $avaliacao
     *
     * @return Avaliacao
     */
    public function setAvaliacao(?int $avaliacao): Avaliacao
    {
        $this->setVisited('avaliacao');
        $this->avaliacao = $avaliacao;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getClasse(): ?string
    {
        return $this->classe;
    }

    /**
     * @param string|null $classe
     *
     * @return Avaliacao
     */
    public function setClasse(?string $classe): Avaliacao
    {
        $this->classe = $classe;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getObjetoId(): ?int
    {
        return $this->objetoId;
    }

    /**
     * @param int|null $objetoId
     *
     * @return Avaliacao
     */
    public function setObjetoId(?int $objetoId): Avaliacao
    {
        $this->objetoId = $objetoId;

        return $this;
    }
}
