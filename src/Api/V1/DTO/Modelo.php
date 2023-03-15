<?php

declare(strict_types=1);
/**
 * /src/Api/V1/DTO/Modelo.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\DTO;

use DateTime;
use JMS\Serializer\Annotation as Serializer;
use Nelmio\ApiDocBundle\Annotation\Model;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Documento as DocumentoDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\ModalidadeModelo as ModalidadeModeloDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\ModalidadeOrgaoCentral as ModalidadeOrgaoCentralDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Setor as SetorDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Template as TemplateDTO;
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
use SuppCore\AdministrativoBackend\Entity\ModalidadeModelo as ModalidadeModeloEntity;
use SuppCore\AdministrativoBackend\Entity\Template as TemplateEntity;
use SuppCore\AdministrativoBackend\Entity\VinculacaoModelo;
use SuppCore\AdministrativoBackend\Form\Annotations as Form;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;
use OpenApi\Annotations as OA;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Modelo.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @DTOMapper\JsonLD(
 *     jsonLDId="/v1/administrativo/modelo/{id}",
 *     jsonLDType="Modelo",
 *     jsonLDContext="/api/doc/#model-Modelo"
 * )
 *
 * @Form\Form()
 */
class Modelo extends RestDto
{
    use IdUuid;
    use Nome;
    use Descricao;
    use Timeblameable;
    use Blameable;
    use Softdeleteable;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\ModalidadeModelo",
     *     required=false
     * )
     *
     * @OA\Property(ref=@Model(type=ModalidadeModeloDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\ModalidadeModelo")
     */
    protected ?EntityInterface $modalidadeModelo = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Template",
     *     required=true
     * )
     *
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @OA\Property(ref=@Model(type=TemplateDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Template")
     */
    protected ?EntityInterface $template = null;

    /**
     * @OA\Property(ref=@Model(type=DocumentoDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Documento")
     */
    protected ?EntityInterface $documento = null;

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
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Setor",
     *     required=false
     *)
     * @OA\Property(ref=@Model(type=SetorDTO::class))
     */
    protected ?EntityInterface $setor = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Usuario",
     *     required=false
     *)
     * @OA\Property(ref=@Model(type=UsuarioDTO::class))
     */
    protected ?EntityInterface $usuario = null;

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
     * @var VinculacaoModelo[]
     *
     * @Serializer\SkipWhenEmpty()
     *
     * @DTOMapper\Property(
     *     dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\VinculacaoModelo",
     *     collection=true,
     *     dtoSetter="addVinculacaoModelo",
     *     dtoGetter="getVinculacoesModelos"
     * )
     */
    protected array $vinculacoesModelos = [];

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


    protected ?array $contextoEspecifico = null;

    /**
     * @return array|null
     */
    public function getContextoEspecifico(): ?array
    {
        return $this->contextoEspecifico;
    }

    /**
     * @param array|null $contextoEspecifico
     * @return self
     */
    public function setContextoEspecifico(?array $contextoEspecifico): self
    {
        $this->contextoEspecifico = $contextoEspecifico;

        return $this;
    }


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

    public function setModalidadeOrgaoCentral(?EntityInterface $modalidadeOrgaoCentral): Modelo
    {
        $this->setVisited('modalidadeOrgaoCentral');
        $this->modalidadeOrgaoCentral = $modalidadeOrgaoCentral;

        return $this;
    }

    public function getSetor(): ?EntityInterface
    {
        return $this->setor;
    }

    public function setSetor(?EntityInterface $setor): Modelo
    {
        $this->setVisited('setor');
        $this->setor = $setor;

        return $this;
    }

    public function getUnidade(): ?EntityInterface
    {
        return $this->unidade;
    }

    public function setUnidade(?EntityInterface $unidade): Modelo
    {
        $this->setVisited('unidade');
        $this->unidade = $unidade;

        return $this;
    }

    public function getUsuario(): ?EntityInterface
    {
        return $this->usuario;
    }

    public function setUsuario(?EntityInterface $usuario): Modelo
    {
        $this->setVisited('usuario');
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * @return VinculacaoModelo[]
     */
    public function getVinculacoesModelos(): array
    {
        return $this->vinculacoesModelos;
    }

    /**
     * @param $vinculacoesModelo
     */
    public function addVinculacaoModelo($vinculacoesModelo): self
    {
        $this->vinculacoesModelos[] = $vinculacoesModelo;

        return $this;
    }

    /**
     * @param EntityInterface|ModalidadeModeloDTO|ModalidadeModeloEntity|null $modalidadeModelo
     */
    public function setModalidadeModelo(?EntityInterface $modalidadeModelo): self
    {
        $this->setVisited('modalidadeModelo');

        $this->modalidadeModelo = $modalidadeModelo;

        return $this;
    }

    /**
     * @return EntityInterface|ModalidadeModeloDTO|ModalidadeModeloEntity|null
     */
    public function getModalidadeModelo(): ?EntityInterface
    {
        return $this->modalidadeModelo;
    }

    /**
     * @return EntityInterface|TemplateDTO|TemplateEntity|null
     */
    public function getTemplate(): ?EntityInterface
    {
        return $this->template;
    }

    /**
     * @param EntityInterface|TemplateDTO|TemplateEntity|null $template
     */
    public function setTemplate(?EntityInterface $template): self
    {
        $this->setVisited('template');

        $this->template = $template;

        return $this;
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
