<?php

declare(strict_types=1);
/**
 * /src/Api/V1/DTO/Template.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\DTO;

use Nelmio\ApiDocBundle\Annotation\Model;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Documento as DocumentoDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\ModalidadeTemplate as ModalidadeTemplateDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\TipoDocumento as TipoDocumentoDTO;
use SuppCore\AdministrativoBackend\DTO\RestDto;
use SuppCore\AdministrativoBackend\DTO\Traits\Ativo;
use SuppCore\AdministrativoBackend\DTO\Traits\Blameable;
use SuppCore\AdministrativoBackend\DTO\Traits\Descricao;
use SuppCore\AdministrativoBackend\DTO\Traits\IdUuid;
use SuppCore\AdministrativoBackend\DTO\Traits\Nome;
use SuppCore\AdministrativoBackend\DTO\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\DTO\Traits\Timeblameable;
use SuppCore\AdministrativoBackend\Entity\Documento as DocumentoEntity;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\ModalidadeTemplate as ModalidadeTemplateEntity;
use SuppCore\AdministrativoBackend\Entity\TipoDocumento as TipoDocumentoEntity;
use SuppCore\AdministrativoBackend\Form\Annotations as Form;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;
use OpenApi\Annotations as OA;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Template.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @DTOMapper\JsonLD(
 *     jsonLDId="/v1/administrativo/template/{id}",
 *     jsonLDType="Template",
 *     jsonLDContext="/api/doc/#model-Template"
 * )
 *
 * @Form\Form()
 */
class Template extends RestDto
{
    use IdUuid;
    use Nome;
    use Descricao;
    use Ativo;
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
     *     class="SuppCore\AdministrativoBackend\Entity\ModalidadeTemplate",
     *     required=true
     * )
     *
     * @OA\Property(ref=@Model(type=ModalidadeTemplateDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\ModalidadeTemplate")
     */
    protected ?EntityInterface $modalidadeTemplate = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Documento",
     *     required=false
     * )
     *
     * @OA\Property(ref=@Model(type=DocumentoDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Documento")
     */
    protected ?EntityInterface $documento = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\TipoDocumento",
     *     required=true
     * )
     *
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @OA\Property(ref=@Model(type=TipoDocumentoDTO::class))
     */
    protected ?EntityInterface $tipoDocumento = null;

    /**
     * @param EntityInterface|ModalidadeTemplateDTO|ModalidadeTemplateEntity|null $modalidadeTemplate
     */
    public function setModalidadeTemplate(?EntityInterface $modalidadeTemplate): self
    {
        $this->setVisited('modalidadeTemplate');

        $this->modalidadeTemplate = $modalidadeTemplate;

        return $this;
    }

    /**
     * @return EntityInterface|ModalidadeTemplateDTO|ModalidadeTemplateEntity|null
     */
    public function getModalidadeTemplate(): ?EntityInterface
    {
        return $this->modalidadeTemplate;
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
    public function setDocumento($documento): self
    {
        $this->setVisited('documento');

        $this->documento = $documento;

        return $this;
    }

    /**
     * @return EntityInterface|TipoDocumentoDTO|TipoDocumentoEntity|null
     */
    public function getTipoDocumento(): ?EntityInterface
    {
        return $this->tipoDocumento;
    }

    /**
     * @param EntityInterface|TipoDocumentoDTO|TipoDocumentoEntity|null $tipoDocumento
     */
    public function setTipoDocumento(?EntityInterface $tipoDocumento): self
    {
        $this->setVisited('tipoDocumento');

        $this->tipoDocumento = $tipoDocumento;

        return $this;
    }
}
