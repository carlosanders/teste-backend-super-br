<?php

declare(strict_types=1);
/**
 * /src/Api/V1/DTO/ObjetoAvaliado.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\DTO;

use DateTime;
use OpenApi\Annotations as OA;
use SuppCore\AdministrativoBackend\DTO\RestDto;
use SuppCore\AdministrativoBackend\DTO\Traits\Blameable;
use SuppCore\AdministrativoBackend\DTO\Traits\IdUuid;
use SuppCore\AdministrativoBackend\DTO\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\DTO\Traits\Timeblameable;
use SuppCore\AdministrativoBackend\Form\Annotations as Form;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;

/**
 * Class ObjetoAvaliado.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @DTOMapper\JsonLD(
 *     jsonLDId="/v1/administrativo/objeto_avaliado/{id}",
 *     jsonLDType="ObjetoAvaliado",
 *     jsonLDContext="/api/doc/#model-ObjetoAvaliado"
 * )
 *
 * @Form\Form()
 */
class ObjetoAvaliado extends RestDto
{
    use IdUuid;
    use Timeblameable;
    use Blameable;
    use Softdeleteable;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=true
     * )
     *
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $classe = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\NumberType",
     *     required=true
     * )
     *
     * @OA\Property(type="integer")
     * @DTOMapper\Property()
     */
    protected ?int $objetoId = null;

    /**
     * @OA\Property(type="integer")
     * @DTOMapper\Property()
     */
    protected null|float $avaliacaoResultante = null;

    /**
     * @DTOMapper\Property()
     */
    protected null|DateTime $dataUltimaAvaliacao = null;

    /**
     * @OA\Property(type="integer")
     * @DTOMapper\Property()
     */
    protected null|int $quantidadeAvaliacoes = null;

    /**
     * @return string|null
     */
    public function getClasse(): ?string
    {
        return $this->classe;
    }

    /**
     * @param string|null $classe
     * @return ObjetoAvaliado
     */
    public function setClasse(?string $classe): ObjetoAvaliado
    {
        $this->setVisited('classe');
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
     * @return ObjetoAvaliado
     */
    public function setObjetoId(?int $objetoId): ObjetoAvaliado
    {
        $this->setVisited('objetoId');
        $this->objetoId = $objetoId;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getAvaliacaoResultante(): ?float
    {
        return $this->avaliacaoResultante;
    }

    /**
     * @param int|null $avaliacaoResultante
     * @return ObjetoAvaliado
     */
    public function setAvaliacaoResultante(?float $avaliacaoResultante): ObjetoAvaliado
    {
        $this->setVisited('avaliacaoResultante');
        $this->avaliacaoResultante = $avaliacaoResultante;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getDataUltimaAvaliacao(): ?DateTime
    {
        return $this->dataUltimaAvaliacao;
    }

    /**
     * @param DateTime|null $dataUltimaAvaliacao
     * @return ObjetoAvaliado
     */
    public function setDataUltimaAvaliacao(?DateTime $dataUltimaAvaliacao): ObjetoAvaliado
    {
        $this->setVisited('dataUltimaAvaliacao');
        $this->dataUltimaAvaliacao = $dataUltimaAvaliacao;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getQuantidadeAvaliacoes(): ?int
    {
        return $this->quantidadeAvaliacoes;
    }

    /**
     * @return ObjetoAvaliado
     */
    public function setQuantidadeAvaliacoes(?int $quantidadeAvaliacoes): ObjetoAvaliado
    {
        $this->setVisited('quantidadeAvaliacoes');
        $this->quantidadeAvaliacoes = $quantidadeAvaliacoes;
        return $this;
    }

}
