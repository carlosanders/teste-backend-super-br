<?php

declare(strict_types=1);
/**
 * /src/Api/V1/DTO/VinculacaoModelo.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\DTO;

use Nelmio\ApiDocBundle\Annotation\Model;
use SuppCore\AdministrativoBackend\Api\V1\DTO\EspecieSetor as EspecieSetorDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\ModalidadeOrgaoCentral as ModalidadeOrgaoCentralDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Modelo as ModeloDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Setor as SetorDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Usuario as UsuarioDTO;
use SuppCore\AdministrativoBackend\DTO\RestDto;
use SuppCore\AdministrativoBackend\DTO\Traits\Blameable;
use SuppCore\AdministrativoBackend\DTO\Traits\IdUuid;
use SuppCore\AdministrativoBackend\DTO\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\DTO\Traits\Timeblameable;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\EspecieSetor as EspecieSetorEntity;
use SuppCore\AdministrativoBackend\Entity\ModalidadeOrgaoCentral as ModalidadeOrgaoCentralEntity;
use SuppCore\AdministrativoBackend\Entity\Modelo as ModeloEntity;
use SuppCore\AdministrativoBackend\Entity\Setor as SetorEntity;
use SuppCore\AdministrativoBackend\Entity\Usuario as UsuarioEntity;
use SuppCore\AdministrativoBackend\Form\Annotations as Form;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;
use OpenApi\Annotations as OA;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * Class VinculacaoModelo.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @DTOMapper\JsonLD(
 *     jsonLDId="/v1/administrativo/vinculacao_modelo/{id}",
 *     jsonLDType="VinculacaoModelo",
 *     jsonLDContext="/api/doc/#model-VinculacaoModelo"
 * )
 *
 * @Form\Form()
 */
class VinculacaoModelo extends RestDto
{
    use IdUuid;
    use Timeblameable;
    use Blameable;
    use Softdeleteable;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Modelo",
     *     required=true
     * )
     *
     * @OA\Property(ref=@Model(type=ModeloDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Modelo")
     */
    protected ?EntityInterface $modelo = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\EspecieSetor",
     *     required=false
     * )
     *
     * @OA\Property(ref=@Model(type=EspecieSetorDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\EspecieSetor")
     */
    protected ?EntityInterface $especieSetor = null;

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
    protected ?EntityInterface $setor = null;

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
    protected ?EntityInterface $usuario = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\ModalidadeOrgaoCentral",
     *     required=false
     * )
     *
     * @OA\Property(ref=@Model(type=ModalidadeOrgaoCentralDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\ModalidadeOrgaoCentral")
     */
    protected ?EntityInterface $modalidadeOrgaoCentral = null;

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
    protected ?EntityInterface $unidade = null;

    /**
     * @return EntityInterface|ModeloDTO|ModeloEntity|null
     */
    public function getModelo(): ?EntityInterface
    {
        return $this->modelo;
    }

    /**
     * @param EntityInterface|ModeloDTO|ModeloEntity|null $modelo
     */
    public function setModelo(?EntityInterface $modelo): self
    {
        $this->setVisited('modelo');

        $this->modelo = $modelo;

        return $this;
    }

    /**
     * @return EntityInterface|EspecieSetorDTO|EspecieSetorEntity|null
     */
    public function getEspecieSetor(): ?EntityInterface
    {
        return $this->especieSetor;
    }

    /**
     * @param EntityInterface|EspecieSetorDTO|EspecieSetorEntity|null $especieSetor
     */
    public function setEspecieSetor(?EntityInterface $especieSetor): self
    {
        $this->setVisited('especieSetor');

        $this->especieSetor = $especieSetor;

        return $this;
    }

    /**
     * @return EntityInterface|SetorDTO|SetorEntity|null
     */
    public function getSetor(): ?EntityInterface
    {
        return $this->setor;
    }

    /**
     * @param EntityInterface|SetorDTO|SetorEntity|null $setor
     */
    public function setSetor(?EntityInterface $setor): self
    {
        $this->setVisited('setor');

        $this->setor = $setor;

        return $this;
    }

    /**
     * @return UsuarioDTO|UsuarioEntity|EntityInterface|int|null
     */
    public function getUsuario(): ?EntityInterface
    {
        return $this->usuario;
    }

    /**
     * @param UsuarioDTO|UsuarioEntity|EntityInterface|int|null $usuario
     */
    public function setUsuario(?EntityInterface $usuario): self
    {
        $this->setVisited('usuario');

        $this->usuario = $usuario;

        return $this;
    }

    /**
     * @return ModalidadeOrgaoCentralDTO|ModalidadeOrgaoCentralEntity|EntityInterface|int|null
     */
    public function getModalidadeOrgaoCentral(): ?EntityInterface
    {
        return $this->modalidadeOrgaoCentral;
    }

    /**
     * @param ModalidadeOrgaoCentralDTO|ModalidadeOrgaoCentralEntity|EntityInterface|int|null $modalidadeOrgaoCentral
     */
    public function setModalidadeOrgaoCentral(?EntityInterface $modalidadeOrgaoCentral): VinculacaoModelo
    {
        $this->setVisited('modalidadeOrgaoCentral');
        $this->modalidadeOrgaoCentral = $modalidadeOrgaoCentral;

        return $this;
    }

    /**
     * @return SetorDTO|SetorEntity|EntityInterface|int|null
     */
    public function getUnidade(): ?EntityInterface
    {
        return $this->unidade;
    }

    /**
     * @param SetorDTO|SetorEntity|EntityInterface|int|null $unidade
     */
    public function setUnidade(?EntityInterface $unidade): VinculacaoModelo
    {
        $this->setVisited('unidade');
        $this->unidade = $unidade;

        return $this;
    }

    /**
     * @Assert\Callback
     */
    public function isValid(ExecutionContextInterface $context): void
    {
        $campos = [
            $this->getUsuario(),
            $this->getSetor(),
            $this->getModalidadeOrgaoCentral(),
            $this->getUnidade(),
        ];

        // Limpa os campos vazios
        $camposPreenchidos = array_filter($campos);

        if (count($camposPreenchidos) > 1) {
            $context
                ->buildViolation('A vinculacaoModelo deve ser realizada com apenas um ou nenhum vínculo')
                ->atPath('id')
                ->addViolation();
        }

        if ($this->getEspecieSetor() && !$this->getModalidadeOrgaoCentral() && !$this->getUnidade()) {
            $context
                ->buildViolation('Espécie de setor deve ser apenas para vinculos de Unidade ou Orgao Central')
                ->atPath('id')
                ->addViolation();
        }
    }
}
