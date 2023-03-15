<?php

declare(strict_types=1);
/**
 * /src/Api/V1/DTO/Aviso.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\DTO;

use DMS\Filter\Rules as Filter;
use JMS\Serializer\Annotation as Serializer;
use Nelmio\ApiDocBundle\Annotation\Model;
use SuppCore\AdministrativoBackend\Api\V1\DTO\ModalidadeOrgaoCentral as ModalidadeOrgaoCentralDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Setor as SetorDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Usuario as UsuarioDTO;
use SuppCore\AdministrativoBackend\DTO\RestDto;
use SuppCore\AdministrativoBackend\DTO\Traits\Ativo;
use SuppCore\AdministrativoBackend\DTO\Traits\Blameable;
use SuppCore\AdministrativoBackend\DTO\Traits\Descricao;
use SuppCore\AdministrativoBackend\DTO\Traits\IdUuid;
use SuppCore\AdministrativoBackend\DTO\Traits\Nome;
use SuppCore\AdministrativoBackend\DTO\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\DTO\Traits\Timeblameable;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\VinculacaoAviso;
use SuppCore\AdministrativoBackend\Form\Annotations as Form;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;
use OpenApi\Annotations as OA;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Aviso.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @DTOMapper\JsonLD(
 *     jsonLDId="/v1/administrativo/aviso/{id}",
 *     jsonLDType="Aviso",
 *     jsonLDContext="/api/doc/#model-Aviso"
 * )
 *
 * @Form\Form()
 */
class Aviso extends RestDto
{
    use IdUuid;
    use Nome;
    use Timeblameable;
    use Blameable;
    use Softdeleteable;
    use Ativo;

    /**
     * @Serializer\Exclude()
     *
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Setor",
     *     required=false
     *)
     * @OA\Property(ref=@Model(type=SetorDTO::class))
     */
    protected ?EntityInterface $setor = null;

    /**
     * @Serializer\Exclude()
     *
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Usuario",
     *     required=false
     *)
     * @OA\Property(ref=@Model(type=UsuarioDTO::class))
     */
    protected ?EntityInterface $usuario = null;

    /**
     * @Serializer\Exclude()
     *
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\ModalidadeOrgaoCentral",
     *     required=false
     *)
     * @OA\Property(ref=@Model(type=ModalidadeOrgaoCentralDTO::class))
     */
    protected ?EntityInterface $modalidadeOrgaoCentral = null;

    /**
     * @Serializer\Exclude()
     *
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Setor",
     *     required=false
     *)
     * @OA\Property(ref=@Model(type=SetorDTO::class))
     */
    protected ?EntityInterface $unidade = null;

    /**
     * @var VinculacaoAviso[]
     *
     * @Serializer\SkipWhenEmpty()
     *
     * @DTOMapper\Property(
     *     dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\VinculacaoAviso",
     *     collection=true,
     *     dtoSetter="addVinculacaoAviso",
     *     dtoGetter="getVinculacoesAvisos"
     * )
     */
    protected array $vinculacoesAvisos = [];

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\CheckboxType",
     *     required=false
     * )
     *
     * @OA\Property(type="boolean", default=false)
     * @DTOMapper\Property()
     */
    protected ?bool $sistema = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=true
     * )
     *
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     *
     * @Assert\NotBlank(
     *     message="O campo não pode estar em branco!"
     * )
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     * @Assert\Length(
     *     min = 3,
     *     minMessage = "O campo deve ter no mínimo 3 caracteres!",
     *     max = 255,
     *     maxMessage = "O campo deve ter no máximo 255 caracteres!"
     * )
     *
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $descricao = null;

    public function getModalidadeOrgaoCentral(): ?EntityInterface
    {
        return $this->modalidadeOrgaoCentral;
    }

    public function setModalidadeOrgaoCentral(?EntityInterface $modalidadeOrgaoCentral): Aviso
    {
        $this->setVisited('modalidadeOrgaoCentral');
        $this->modalidadeOrgaoCentral = $modalidadeOrgaoCentral;

        return $this;
    }

    public function getSetor(): ?EntityInterface
    {
        return $this->setor;
    }

    public function setSetor(?EntityInterface $setor): Aviso
    {
        $this->setVisited('setor');
        $this->setor = $setor;

        return $this;
    }

    public function getUnidade(): ?EntityInterface
    {
        return $this->unidade;
    }

    public function setUnidade(?EntityInterface $unidade): Aviso
    {
        $this->setVisited('unidade');
        $this->unidade = $unidade;

        return $this;
    }

    public function getUsuario(): ?EntityInterface
    {
        return $this->usuario;
    }

    public function setUsuario(?EntityInterface $usuario): Aviso
    {
        $this->setVisited('usuario');
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Set descricao.
     */
    public function setDescricao(?string $descricao): self
    {
        $this->setVisited('descricao');

        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get descricao.
     */
    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    /**
     * @return VinculacaoAviso[]
     */
    public function getVinculacoesAvisos(): array
    {
        return $this->vinculacoesAvisos;
    }

    /**
     * @param $vinculacoesAviso
     */
    public function addVinculacaoAviso($vinculacoesAviso): self
    {
        $this->vinculacoesAvisos[] = $vinculacoesAviso;

        return $this;
    }

    public function getSistema(): ?bool
    {
        return $this->sistema;
    }

    public function setSistema(?bool $sistema): self
    {
        $this->setVisited('sistema');

        $this->sistema = $sistema;

        return $this;
    }
}
