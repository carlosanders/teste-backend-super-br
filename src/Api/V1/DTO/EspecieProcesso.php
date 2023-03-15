<?php

declare(strict_types=1);
/**
 * /src/Api/V1/DTO/EspecieProcesso.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\DTO;

use DMS\Filter\Rules as Filter;
use Nelmio\ApiDocBundle\Annotation\Model;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Classificacao as ClassificacaoDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\GeneroProcesso as GeneroProcessoDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\ModalidadeMeio as ModalidadeMeioDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\VinculacaoEspecieProcessoWorkflow as VinculacaoEspecieProcessoWorkflowDTO;
use SuppCore\AdministrativoBackend\DTO\RestDto;
use SuppCore\AdministrativoBackend\DTO\Traits\Ativo;
use SuppCore\AdministrativoBackend\DTO\Traits\Blameable;
use SuppCore\AdministrativoBackend\DTO\Traits\Descricao;
use SuppCore\AdministrativoBackend\DTO\Traits\IdUuid;
use SuppCore\AdministrativoBackend\DTO\Traits\Nome;
use SuppCore\AdministrativoBackend\DTO\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\DTO\Traits\Timeblameable;
use SuppCore\AdministrativoBackend\Entity\Classificacao as ClassificacaoEntity;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\GeneroProcesso as GeneroProcessoEntity;
use SuppCore\AdministrativoBackend\Entity\ModalidadeMeio as ModalidadeMeioEntity;
use SuppCore\AdministrativoBackend\Form\Annotations as Form;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;
use OpenApi\Annotations as OA;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as Serializer;

/**
 * Class EspecieProcesso.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @DTOMapper\JsonLD(
 *     jsonLDId="/v1/administrativo/especie_processo/{id}",
 *     jsonLDType="EspecieProcesso",
 *     jsonLDContext="/api/doc/#model-EspecieProcesso"
 * )
 *
 * @Form\Form()
 * @Form\Cacheable(expire="86400")
 */
class EspecieProcesso extends RestDto
{
    use IdUuid;
    use Nome;
    use Descricao;
    use Ativo;
    use Timeblameable;
    use Blameable;
    use Softdeleteable;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\GeneroProcesso",
     *     required=true
     * )
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @OA\Property(ref=@Model(type=GeneroProcessoDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\GeneroProcesso")
     */
    protected ?EntityInterface $generoProcesso = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Classificacao",
     *     required=false
     * )
     *
     * @OA\Property(ref=@Model(type=ClassificacaoDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Classificacao")
     */
    protected ?EntityInterface $classificacao = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\ModalidadeMeio",
     *     required=false
     * )
     *
     * @OA\Property(ref=@Model(type=ModalidadeMeioDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\ModalidadeMeio")
     */
    protected ?EntityInterface $modalidadeMeio = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=false
     * )
     * @Assert\Length(
     *     max = 255,
     *     maxMessage = "O campo deve ter no máximo 255 caracteres!"
     * )
     *
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Filter\ToUpper(encoding="UTF-8")
     *
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $titulo = null;

    /**
     * @var VinculacaoEspecieProcessoWorkflowDTO[]
     *
     * @Serializer\SkipWhenEmpty()
     *
     * @DTOMapper\Property(
     *     dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\VinculacaoEspecieProcessoWorkflow",
     *     collection=true,
     *     dtoSetter="addVinculacaoEspecieProcessoWorkflow",
     *     dtoGetter="getVinculacoesEspecieProcessoWorkflow"
     * )
     */
    protected array $vinculacoesEspecieProcessoWorkflow = [];


    /**
     * @OA\Property(type="boolean", default=false)
     */
    protected ?bool $workflow = false;


    /**
     * @return EntityInterface|GeneroProcessoEntity|GeneroProcessoDTO|int|null
     */
    public function getGeneroProcesso(): ?EntityInterface
    {
        return $this->generoProcesso;
    }

    /**
     * @param EntityInterface|GeneroProcessoEntity|GeneroProcessoDTO|int|null $generoProcesso
     *
     * @return EspecieProcesso
     */
    public function setGeneroProcesso(?EntityInterface $generoProcesso): self
    {
        $this->setVisited('generoProcesso');

        $this->generoProcesso = $generoProcesso;

        return $this;
    }

    /**
     * @return EntityInterface|ModalidadeMeioDTO|ModalidadeMeioEntity|null
     */
    public function getModalidadeMeio(): ?EntityInterface
    {
        return $this->modalidadeMeio;
    }

    /**
     * @param EntityInterface|ModalidadeMeioDTO|ModalidadeMeioEntity|null $modalidadeMeio
     */
    public function setModalidadeMeio(?EntityInterface $modalidadeMeio): self
    {
        $this->setVisited('modalidadeMeio');

        $this->modalidadeMeio = $modalidadeMeio;

        return $this;
    }

    /**
     * @return EntityInterface|ClassificacaoDTO|ClassificacaoEntity|null
     */
    public function getClassificacao(): ?EntityInterface
    {
        return $this->classificacao;
    }

    /**
     * @param EntityInterface|ClassificacaoDTO|ClassificacaoEntity|null $classificacao
     */
    public function setClassificacao(?EntityInterface $classificacao): self
    {
        $this->setVisited('classificacao');

        $this->classificacao = $classificacao;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    /**
     * @param string|null $titulo
     * @return $this
     */
    public function setTitulo(?string $titulo): self
    {
        $this->setVisited('titulo');

        $this->titulo = $titulo;

        return $this;
    }

    /**
     * @return VinculacaoEspecieProcessoWorkflow[]
     */
    public function getVinculacoesEspecieProcessoWorkflow(): array
    {
        return $this->vinculacoesEspecieProcessoWorkflow;
    }

    /**
     * @param VinculacaoEspecieProcessoWorkflow $vinculacaoEspecieProcessoWorkflow
     * @return $this
     */
    public function addVinculacaoEspecieProcessoWorkflow(
        VinculacaoEspecieProcessoWorkflowDTO $vinculacaoEspecieProcessoWorkflow
    ): self {
        $this->vinculacoesEspecieProcessoWorkflow[] = $vinculacaoEspecieProcessoWorkflow;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function isWorkflow(): ?bool
    {
        return $this->workflow;
    }

    /**
     * @param bool|null $workflow
     * @return $this
     */
    public function setWorkflow(?bool $workflow): self
    {
        $this->workflow = $workflow;

        return $this;
    }

}
