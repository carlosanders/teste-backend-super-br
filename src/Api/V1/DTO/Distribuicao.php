<?php

declare(strict_types=1);
/**
 * /src/Api/V1/DTO/Distribuicao.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\DTO;

use DateTime;
use Nelmio\ApiDocBundle\Annotation\Model;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Setor as SetorDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Tarefa as TarefaDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Usuario as UsuarioDTO;
use SuppCore\AdministrativoBackend\DTO\RestDto;
use SuppCore\AdministrativoBackend\DTO\Traits\Blameable;
use SuppCore\AdministrativoBackend\DTO\Traits\IdUuid;
use SuppCore\AdministrativoBackend\DTO\Traits\Timeblameable;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\Setor as SetorEntity;
use SuppCore\AdministrativoBackend\Entity\Tarefa as TarefaEntity;
use SuppCore\AdministrativoBackend\Entity\Usuario as UsuarioEntity;
use SuppCore\AdministrativoBackend\Form\Annotations as Form;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;
use OpenApi\Annotations as OA;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Distribuicao.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @DTOMapper\JsonLD(
 *     jsonLDId="/v1/administrativo/distribuicao/{id}",
 *     jsonLDType="Distribuicao",
 *     jsonLDContext="/api/doc/#model-Distribuicao"
 * )
 *
 * @Form\Form()
 */
class Distribuicao extends RestDto
{
    use IdUuid;
    use Blameable;
    use Timeblameable;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Tarefa",
     *     required=false
     * )
     *
     * @OA\Property(ref=@Model(type=TarefaDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Tarefa")
     */
    protected ?EntityInterface $tarefa = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\DateTimeType",
     *     widget="single_text",
     *     required=true
     * )
     *
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @OA\Property(type="string", format="date-time")
     * @DTOMapper\Property()
     */
    protected ?DateTime $dataHoraDistribuicao = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Usuario",
     *     required=false
     * )
     *
     * @OA\Property(ref=@Model(type=UsuarioDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Usuario")
     */
    protected ?EntityInterface $usuarioAnterior = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Usuario",
     *     required=true
     * )
     *
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @OA\Property(ref=@Model(type=UsuarioDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Usuario")
     */
    protected ?EntityInterface $usuarioPosterior = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Setor",
     *     required=false
     * )
     *
     * @OA\Property(ref=@Model(type=SetorDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Setor")
     */
    protected ?EntityInterface $setorAnterior = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Setor",
     *     required=true
     * )
     *
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @OA\Property(ref=@Model(type=SetorDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Setor")
     */
    protected ?EntityInterface $setorPosterior = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\CheckboxType",
     *     required=false
     * )
     *
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     * @OA\Property(type="boolean", default=true)
     * @DTOMapper\Property()
     */
    protected bool $distribuicaoAutomatica = false;

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
    protected bool $livreBalanceamento = false;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=true
     * )
     *
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $auditoriaDistribuicao = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\IntegerType",
     *     required=false
     * )
     *
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @OA\Property(type="integer", default=0)
     * @DTOMapper\Property()
     */
    protected int $tipoDistribuicao = 0;

    /**
     * @return EntityInterface|TarefaDTO|TarefaEntity|null
     */
    public function getTarefa(): ?EntityInterface
    {
        return $this->tarefa;
    }

    /**
     * @param EntityInterface|TarefaDTO|TarefaEntity|null $tarefa
     */
    public function setTarefa(?EntityInterface $tarefa): self
    {
        $this->setVisited('tarefa');

        $this->tarefa = $tarefa;

        return $this;
    }

    public function getDataHoraDistribuicao(): ?DateTime
    {
        return $this->dataHoraDistribuicao;
    }

    public function setDataHoraDistribuicao(?DateTime $dataHoraDistribuicao): self
    {
        $this->setVisited('dataHoraDistribuicao');

        $this->dataHoraDistribuicao = $dataHoraDistribuicao;

        return $this;
    }

    /**
     * @return UsuarioDTO|UsuarioEntity|EntityInterface|int|null
     */
    public function getUsuarioAnterior(): ?EntityInterface
    {
        return $this->usuarioAnterior;
    }

    /**
     * @param UsuarioDTO|UsuarioEntity|EntityInterface|int|null $usuarioAnterior
     */
    public function setUsuarioAnterior(?EntityInterface $usuarioAnterior): self
    {
        $this->setVisited('usuarioAnterior');

        $this->usuarioAnterior = $usuarioAnterior;

        return $this;
    }

    /**
     * @return UsuarioDTO|UsuarioEntity|EntityInterface|int|null
     */
    public function getUsuarioPosterior(): ?EntityInterface
    {
        return $this->usuarioPosterior;
    }

    /**
     * @param UsuarioDTO|UsuarioEntity|EntityInterface|int|null $usuarioPosterior
     */
    public function setUsuarioPosterior(?EntityInterface $usuarioPosterior): self
    {
        $this->setVisited('usuarioPosterior');

        $this->usuarioPosterior = $usuarioPosterior;

        return $this;
    }

    /**
     * @return EntityInterface|SetorDTO|SetorEntity|null
     */
    public function getSetorAnterior(): ?EntityInterface
    {
        return $this->setorAnterior;
    }

    /**
     * @param EntityInterface|SetorDTO|SetorEntity|null $setorAnterior
     */
    public function setSetorAnterior(?EntityInterface $setorAnterior): self
    {
        $this->setVisited('setorAnterior');

        $this->setorAnterior = $setorAnterior;

        return $this;
    }

    /**
     * @return EntityInterface|SetorDTO|SetorEntity|null
     */
    public function getSetorPosterior(): ?EntityInterface
    {
        return $this->setorPosterior;
    }

    /**
     * @param EntityInterface|SetorDTO|SetorEntity|null $setorPosterior
     */
    public function setSetorPosterior(?EntityInterface $setorPosterior): self
    {
        $this->setVisited('setorPosterior');

        $this->setorPosterior = $setorPosterior;

        return $this;
    }

    public function getDistribuicaoAutomatica(): ?bool
    {
        return $this->distribuicaoAutomatica;
    }

    public function setDistribuicaoAutomatica(?bool $distribuicaoAutomatica): self
    {
        $this->setVisited('distribuicaoAutomatica');

        $this->distribuicaoAutomatica = $distribuicaoAutomatica;

        return $this;
    }

    public function getLivreBalanceamento(): ?bool
    {
        return $this->livreBalanceamento;
    }

    public function setLivreBalanceamento(?bool $livreBalanceamento): self
    {
        $this->setVisited('livreBalanceamento');

        $this->livreBalanceamento = $livreBalanceamento;

        return $this;
    }

    public function getAuditoriaDistribuicao(): ?string
    {
        return $this->auditoriaDistribuicao;
    }

    public function setAuditoriaDistribuicao(?string $auditoriaDistribuicao): self
    {
        $this->setVisited('auditoriaDistribuicao');

        $this->auditoriaDistribuicao = $auditoriaDistribuicao;

        return $this;
    }

    public function getTipoDistribuicao(): ?int
    {
        return $this->tipoDistribuicao;
    }

    public function setTipoDistribuicao(?int $tipoDistribuicao): self
    {
        $this->setVisited('tipoDistribuicao');

        $this->tipoDistribuicao = $tipoDistribuicao;

        return $this;
    }
}
