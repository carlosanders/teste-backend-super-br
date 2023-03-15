<?php

declare(strict_types=1);
/**
 * /src/Api/V1/DTO/Repositorio.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\DTO;

use DateTime;
use JMS\Serializer\Annotation as Serializer;
use Nelmio\ApiDocBundle\Annotation\Model;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Documento as DocumentoDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\ModalidadeOrgaoCentral as ModalidadeOrgaoCentralDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\ModalidadeRepositorio as ModalidadeRepositorioDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Setor as SetorDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Usuario as UsuarioDTO;
use SuppCore\AdministrativoBackend\DTO\RestDto;
use SuppCore\AdministrativoBackend\DTO\Traits\Blameable;
use SuppCore\AdministrativoBackend\DTO\Traits\Descricao;
use SuppCore\AdministrativoBackend\DTO\Traits\IdUuid;
use SuppCore\AdministrativoBackend\DTO\Traits\Nome;
use SuppCore\AdministrativoBackend\DTO\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\DTO\Traits\Timeblameable;
use SuppCore\AdministrativoBackend\Entity\Documento as DocumentoEntity;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\ModalidadeRepositorio as ModalidadeRepositorioEntity;
use SuppCore\AdministrativoBackend\Entity\Setor as SetorEntity;
use SuppCore\AdministrativoBackend\Entity\Usuario as UsuarioEntity;
use SuppCore\AdministrativoBackend\Form\Annotations as Form;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;
use OpenApi\Annotations as OA;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Repositorio.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @DTOMapper\JsonLD(
 *     jsonLDId="/v1/administrativo/repositorio/{id}",
 *     jsonLDType="Repositorio",
 *     jsonLDContext="/api/doc/#model-Repositorio"
 * )
 *
 * @Form\Form()
 */
class Repositorio extends RestDto
{
    use IdUuid;
    use Nome;
    use Descricao;
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
     *     class="SuppCore\AdministrativoBackend\Entity\ModalidadeRepositorio",
     *     required=true
     * )
     *
     * @OA\Property(ref=@Model(type=ModalidadeRepositorioDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\ModalidadeRepositorio")
     */
    protected ?EntityInterface $modalidadeRepositorio = null;

    /**
     * @OA\Property(ref=@Model(type=DocumentoDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Documento")
     */
    protected ?EntityInterface $documento = null;

    /**
     * @var VinculacaoRepositorio[]
     *
     * @Serializer\SkipWhenEmpty()
     *
     * @DTOMapper\Property(
     *     dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\VinculacaoRepositorio",
     *     collection=true,
     *     dtoSetter="addVinculacaoRepositorio",
     *     dtoGetter="getVinculacoesRepositorios"
     * )
     */
    protected array $vinculacoesRepositorios = [];

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Usuario"
     * )
     *
     * @OA\Property(ref=@Model(type=UsuarioDTO::class))
     */
    protected ?EntityInterface $usuario = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Setor"
     * )
     *
     * @OA\Property(ref=@Model(type=SetorDTO::class))
     */
    protected ?EntityInterface $setor = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\ModalidadeOrgaoCentral",
     *     required=false
     *)
     * @OA\Property(ref=@Model(type=ModalidadeOrgaoCentralDTO::class))
     */
    protected ?EntityInterface $modalidadeOrgaoCentral = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Setor",
     *     required=false
     *)
     * @OA\Property(ref=@Model(type=SetorDTO::class))
     */
    protected ?EntityInterface $unidade = null;

    /**
     * @Serializer\Exclude()
     * @DTOMapper\Property()
     */
    protected ?DateTime $dataHoraIndexacao = null;

    /**
     * Highlights.
     *
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $highlights = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\CheckboxType",
     *     required=false
     * )
     *
     * @OA\Property(type="boolean", default=true)
     * @DTOMapper\Property()
     */
    protected ?bool $ativo = true;

    /**
     * Set ativo.
     */
    public function setAtivo(?bool $ativo): self
    {
        $this->setVisited('ativo');

        $this->ativo = $ativo;

        return $this;
    }

    /**
     * Get ativo|null.
     */
    public function getAtivo(): ?bool
    {
        return $this->ativo;
    }

    public function getModalidadeOrgaoCentral(): ?EntityInterface
    {
        return $this->modalidadeOrgaoCentral;
    }

    public function setModalidadeOrgaoCentral(?EntityInterface $modalidadeOrgaoCentral): Repositorio
    {
        $this->setVisited('modalidadeOrgaoCentral');
        $this->modalidadeOrgaoCentral = $modalidadeOrgaoCentral;

        return $this;
    }

    /**
     * @param EntityInterface|ModalidadeRepositorioDTO|ModalidadeRepositorioEntity|null $modalidadeRepositorio
     */
    public function setModalidadeRepositorio(?EntityInterface $modalidadeRepositorio): self
    {
        $this->setVisited('modalidadeRepositorio');

        $this->modalidadeRepositorio = $modalidadeRepositorio;

        return $this;
    }

    /**
     * @return EntityInterface|ModalidadeRepositorioDTO|ModalidadeRepositorioEntity|null
     */
    public function getModalidadeRepositorio(): ?EntityInterface
    {
        return $this->modalidadeRepositorio;
    }

    /**
     * @return EntityInterface|DocumentoDTO|DocumentoEntity|null
     */
    public function getDocumento(): ?EntityInterface
    {
        return $this->documento;
    }

    /**
     * @param EntityInterface|DocumentoDTO|DocumentoEntity|null $documento
     */
    public function setDocumento(?EntityInterface $documento): self
    {
        $this->setVisited('documento');

        $this->documento = $documento;

        return $this;
    }

    /**
     * @return $this
     */
    public function addVinculacaoRepositorio(VinculacaoRepositorio $vinculacaoRepositorio)
    {
        $this->vinculacoesRepositorios[] = $vinculacaoRepositorio;

        return $this;
    }

    /**
     * @return array|VinculacaoRepositorio[]
     */
    public function getVinculacoesRepositorios()
    {
        return $this->vinculacoesRepositorios;
    }

    /**
     * @param EntityInterface|UsuarioDTO|UsuarioEntity|null $usuario
     */
    public function setUsuario(?EntityInterface $usuario): self
    {
        $this->setVisited('usuario');

        $this->usuario = $usuario;

        return $this;
    }

    /**
     * @return EntityInterface|UsuarioDTO|UsuarioEntity|null $usuario
     */
    public function getUsuario(): ?EntityInterface
    {
        return $this->usuario;
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
     * @return EntityInterface|SetorDTO|SetorEntity|null $setor
     */
    public function getSetor(): ?EntityInterface
    {
        return $this->setor;
    }

    /**
     * @return EntityInterface|SetorDTO|SetorEntity|null
     */
    public function getUnidade(): ?EntityInterface
    {
        return $this->unidade;
    }

    /**
     * @param EntityInterface|SetorDTO|SetorEntity|null $unidade
     */
    public function setUnidade(?EntityInterface $unidade): Repositorio
    {
        $this->setVisited('unidade');
        $this->unidade = $unidade;

        return $this;
    }

    public function getDataHoraIndexacao(): ?DateTime
    {
        return $this->dataHoraIndexacao;
    }

    public function setDataHoraIndexacao(?DateTime $dataHoraIndexacao): self
    {
        $this->setVisited('dataHoraIndexacao');

        $this->dataHoraIndexacao = $dataHoraIndexacao;

        return $this;
    }

    /**
     * Set highlights.
     */
    public function setHighlights(?string $highlights): self
    {
        $this->setVisited('highlights');

        $this->highlights = $highlights;

        return $this;
    }

    /**
     * Get highlights.
     */
    public function getHighlights(): ?string
    {
        return $this->highlights;
    }
}
