<?php

declare(strict_types=1);
/**
 * /src/Api/V1/DTO/Cronjob.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\DTO;

use DateTimeInterface;
use SuppCore\AdministrativoBackend\DTO\RestDto;
use SuppCore\AdministrativoBackend\DTO\Traits\Ativo;
use SuppCore\AdministrativoBackend\DTO\Traits\Blameable;
use SuppCore\AdministrativoBackend\DTO\Traits\Descricao;
use SuppCore\AdministrativoBackend\DTO\Traits\IdUuid;
use SuppCore\AdministrativoBackend\DTO\Traits\Nome;
use SuppCore\AdministrativoBackend\DTO\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\DTO\Traits\Timeblameable;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Form\Annotations as Form;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;
use SuppCore\AdministrativoBackend\Validator\Constraints as AppAssert;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Usuario as UsuarioDTO;
use Symfony\Component\Validator\Constraints as Assert;
use DMS\Filter\Rules as Filter;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Model;

/**
 * Class Cronjob.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @AppAssert\DtoUniqueEntity(
 *      fieldMapping = {"nome": "nome"},
 *      entityClass="SuppCore\AdministrativoBackend\Entity\Cronjob",
 *      message = "Nome já está em utilização!"
 * )
 *
 * @DTOMapper\JsonLD(
 *     jsonLDId="/v1/administrativo/cron_job/{id}",
 *     jsonLDType="Cronjob",
 *     jsonLDContext="/api/doc/#model-Cronjob"
 * )
 *
 * @Form\Form()
 */
class Cronjob extends RestDto
{
    use IdUuid;
    use Nome;
    use Descricao;
    use Ativo;
    use Blameable;
    use Softdeleteable;
    use Timeblameable;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=true
     * )
     *
     * @Assert\Length(
     *      min = 9,
     *      minMessage = "O campo deve ter no mínimo 9 caracteres!",
     *      max = 255,
     *      maxMessage = "Campo deve ter no máximo {{ limit }} letras ou números"
     * )
     * @Assert\NotBlank(
     *     message="O campo não pode estar em branco!"
     * )
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @Filter\Trim()
     * @Filter\StripNewlines()
     *
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $periodicidade = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=true
     * )
     *
     * @Assert\Length(
     *      min = 3,
     *      minMessage = "O campo deve ter no mínimo 3 caracteres!",
     *      max = 255,
     *      maxMessage = "Campo deve ter no máximo {{ limit }} letras ou números"
     * )
     * @Assert\NotBlank(
     *     message="O campo não pode estar em branco!"
     * )
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @Filter\Trim()
     * @Filter\StripNewlines()
     *
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $comando = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\CheckboxType",
     *     required=true
     * )
     *
     * @OA\Property(type="boolean", default=true)
     * @DTOMapper\Property()
     */
    protected bool $sincrono = true;

    /**
     * @OA\Property(ref=@Model(type=UsuarioDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Usuario")
     */
    protected ?EntityInterface $usuarioUltimaExecucao = null;

    /**
     * @OA\Property(type="string", format="date-time")
     * @DTOMapper\Property()
     */
    protected ?DateTimeInterface $dataHoraUltimaExecucao = null;

    /**
     * @OA\Property(type="integer")
     * @DTOMapper\Property()
     */
    protected ?int $statusUltimaExecucao = null;

    /**
     * @OA\Property(type="integer")
     * @DTOMapper\Property()
     */
    protected ?int $ultimoPid = null;

    /**
     * @Assert\Range(
     *      min = 0,
     *      max = 100,
     *     notInRangeMessage="O campo deve ter um valor entre 0 e 100"
     * )
     * @OA\Property(type="float")
     * @DTOMapper\Property()
     */
    protected ?float $percentualExecucao = null;

    /**
     * @DTOMapper\Property()
     * @OA\Property(type="string", format="date-time")
     */
    protected ?DateTimeInterface $dataHoraProximaExecucao = null;

    /**
     * @OA\Property(type="string")
     */
    protected ?string $textoStatusUltimaExecucao = null;

    /**
     * @return string|null
     */
    public function getPeriodicidade(): ?string
    {
        return $this->periodicidade;
    }

    /**
     * @param string|null $periodicidade
     * @return $this
     */
    public function setPeriodicidade(?string $periodicidade): self
    {
        $this->setVisited('periodicidade');
        $this->periodicidade = $periodicidade;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getComando(): ?string
    {
        return $this->comando;
    }

    /**
     * @param string|null $comando
     * @return $this
     */
    public function setComando(?string $comando): self
    {
        $this->setVisited('comando');
        $this->comando = $comando;

        return $this;
    }

    /**
     * @return EntityInterface|null
     */
    public function getUsuarioUltimaExecucao(): ?EntityInterface
    {
        return $this->usuarioUltimaExecucao;
    }

    /**
     * @param EntityInterface|null $usuarioUltimaExecucao
     * @return $this
     */
    public function setUsuarioUltimaExecucao(?EntityInterface $usuarioUltimaExecucao): self
    {
        $this->setVisited('usuarioUltimaExecucao');
        $this->usuarioUltimaExecucao = $usuarioUltimaExecucao;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getDataHoraUltimaExecucao(): ?DateTimeInterface
    {
        return $this->dataHoraUltimaExecucao;
    }

    /**
     * @param DateTimeInterface|null $dataHoraUltimaExecucao
     * @return $this
     */
    public function setDataHoraUltimaExecucao(?DateTimeInterface $dataHoraUltimaExecucao): self
    {
        $this->setVisited('dataHoraUltimaExecucao');
        $this->dataHoraUltimaExecucao = $dataHoraUltimaExecucao;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getStatusUltimaExecucao(): ?int
    {
        return $this->statusUltimaExecucao;
    }

    /**
     * @param int|null $statusUltimaExecucao
     * @return $this
     */
    public function setStatusUltimaExecucao(?int $statusUltimaExecucao): self
    {
        $this->setVisited('statusUltimaExecucao');
        $this->statusUltimaExecucao = $statusUltimaExecucao;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getUltimoPid(): ?int
    {
        return $this->ultimoPid;
    }

    /**
     * @param int|null $ultimoPid
     * @return $this
     */
    public function setUltimoPid(?int $ultimoPid): self
    {
        $this->setVisited('ultimoPid');
        $this->ultimoPid = $ultimoPid;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getDataHoraProximaExecucao(): ?DateTimeInterface
    {
        return $this->dataHoraProximaExecucao;
    }

    /**
     * @param DateTimeInterface|null $dataHoraProximaExecucao
     * @return $this
     */
    public function setDataHoraProximaExecucao(?DateTimeInterface $dataHoraProximaExecucao): self
    {
        $this->dataHoraProximaExecucao = $dataHoraProximaExecucao;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTextoStatusUltimaExecucao(): ?string
    {
        return $this->textoStatusUltimaExecucao;
    }

    /**
     * @param string|null $textoStatusUltimaExecucao
     * @return $this
     */
    public function setTextoStatusUltimaExecucao(?string $textoStatusUltimaExecucao): self
    {
        $this->textoStatusUltimaExecucao = $textoStatusUltimaExecucao;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getPercentualExecucao(): ?float
    {
        return $this->percentualExecucao;
    }

    /**
     * @param float|null $percentualExecucao
     * @return $this
     */
    public function setPercentualExecucao(?float $percentualExecucao): self
    {
        $this->setVisited('percentualExecucao');
        $this->percentualExecucao = $percentualExecucao;

        return $this;
    }

    /**
     * @return bool
     */
    public function getSincrono(): bool
    {
        return $this->sincrono;
    }

    /**
     * @param bool $sincrono
     * @return self
     */
    public function setSincrono(bool $sincrono): self
    {
        $this->setVisited('sincrono');
        $this->sincrono = $sincrono;

        return $this;
    }


}
