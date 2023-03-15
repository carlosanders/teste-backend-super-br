<?php

declare(strict_types=1);
/**
 * /src/Api/V1/DTO/Contato.php.
 */

namespace SuppCore\AdministrativoBackend\Api\V1\DTO;

use Nelmio\ApiDocBundle\Annotation\Model;
use SuppCore\AdministrativoBackend\Api\V1\DTO\GrupoContato as GrupoContatoDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Setor as SetorDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\TipoContato as TipoContatoDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Usuario as UsuarioDTO;
use SuppCore\AdministrativoBackend\DTO\RestDto;
use SuppCore\AdministrativoBackend\DTO\Traits\Blameable;
use SuppCore\AdministrativoBackend\DTO\Traits\IdUuid;
use SuppCore\AdministrativoBackend\DTO\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\DTO\Traits\Timeblameable;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Form\Annotations as Form;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;
use OpenApi\Annotations as OA;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Contato.
 *
 * @DTOMapper\JsonLD(
 *     jsonLDId="/v1/administrativo/contato/{id}",
 *     jsonLDType="Contato",
 *     jsonLDContext="/api/doc/#model-Contato"
 * )
 *
 * @Form\Form()
 */
class Contato extends RestDto
{
    use IdUuid;
    use Timeblameable;
    use Blameable;
    use Softdeleteable;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\TipoContato",
     *     required=true
     * )
     *
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @OA\Property(ref=@Model(type=TipoContatoDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\TipoContato")
     */
    protected EntityInterface | null $tipoContato = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\GrupoContato",
     *     required=true
     * )
     *
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @OA\Property(ref=@Model(type=GrupoContatoDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\GrupoContato")
     */
    protected EntityInterface | null $grupoContato = null;

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
    protected EntityInterface | null $unidade = null;

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
    protected EntityInterface | null $setor = null;

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
    protected EntityInterface | null $usuario = null;

    /**
     * @return EntityInterface|null
     */
    public function getTipoContato(): EntityInterface | null
    {
        return $this->tipoContato;
    }

    /**
     * @param EntityInterface|null $tipoContato
     *
     * @return $this
     */
    public function setTipoContato(EntityInterface | null $tipoContato): self
    {
        $this->tipoContato = $tipoContato;

        $this->setVisited('tipoContato');

        return $this;
    }

    /**
     * @return EntityInterface|null
     */
    public function getGrupoContato(): EntityInterface | null
    {
        return $this->grupoContato;
    }

    /**
     * @param EntityInterface|null $grupoContato
     *
     * @return $this
     */
    public function setGrupoContato(EntityInterface | null $grupoContato): self
    {
        $this->grupoContato = $grupoContato;

        $this->setVisited('grupoContato');

        return $this;
    }

    /**
     * @return EntityInterface|null
     */
    public function getUnidade(): EntityInterface | null
    {
        return $this->unidade;
    }

    /**
     * @param EntityInterface|null $unidade
     *
     * @return $this
     */
    public function setUnidade(EntityInterface | null $unidade): self
    {
        $this->unidade = $unidade;

        $this->setVisited('unidade');

        return $this;
    }

    /**
     * @return Setor|EntityInterface|null
     */
    public function getSetor(): EntityInterface | null
    {
        return $this->setor;
    }

    /**
     * @param EntityInterface|null $setor
     *
     * @return $this
     */
    public function setSetor(EntityInterface | null $setor): self
    {
        $this->setor = $setor;

        $this->setVisited('setor');

        return $this;
    }

    /**
     * @return EntityInterface|null
     */
    public function getUsuario(): EntityInterface | null
    {
        return $this->usuario;
    }

    /**
     * @param EntityInterface|null $usuario
     *
     * @return $this
     */
    public function setUsuario(EntityInterface | null $usuario): self
    {
        $this->usuario = $usuario;

        $this->setVisited('usuario');

        return $this;
    }
}
