<?php

declare(strict_types=1);
/**
 * /src/Api/V1/DTO/Relatorio.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\DTO;

use DMS\Filter\Rules as Filter;
use JMS\Serializer\Annotation as Serializer;
use Nelmio\ApiDocBundle\Annotation\Model;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Documento as DocumentoDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\TipoRelatorio as TipoRelatorioDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\VinculacaoEtiqueta as VinculacaoEtiquetaDTO;
use SuppCore\AdministrativoBackend\DTO\RestDto;
use SuppCore\AdministrativoBackend\DTO\Traits\Blameable;
use SuppCore\AdministrativoBackend\DTO\Traits\IdUuid;
use SuppCore\AdministrativoBackend\DTO\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\DTO\Traits\Timeblameable;
use SuppCore\AdministrativoBackend\Entity\Documento as DocumentoEntity;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\TipoRelatorio as TipoRelatorioEntity;
use SuppCore\AdministrativoBackend\Form\Annotations as Form;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;
use OpenApi\Annotations as OA;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Relatorio.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @DTOMapper\JsonLD(
 *     jsonLDId="/v1/administrativo/relatorio/{id}",
 *     jsonLDType="Relatorio",
 *     jsonLDContext="/api/doc/#model-Relatorio"
 * )
 *
 * @Form\Form()
 */
class Relatorio extends RestDto
{
    use IdUuid;
    use Timeblameable;
    use Blameable;
    use Softdeleteable;
    public const PARAMS = [
        'dataHoraInicio',
        'dataHoraFim',
        'usuario',
        'setor',
        'unidade',
    ];

    public const FORMATOS = [
        'html',
        'pdf',
        'xlsx',
    ];

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=false
     * )
     *
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     *
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $observacao = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\TipoRelatorio",
     *     required=false
     * )
     *
     * @OA\Property(ref=@Model(type=TipoRelatorioDTO::class))
     *
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\TipoRelatorio")
     */
    protected ?EntityInterface $tipoRelatorio = null;

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
     * @Serializer\Exclude()
     *
     * @Assert\Choice({"html", "pdf", "xlsx"})
     *
     * @OA\Property(type="string")
     *
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=false
     * )
     */
    protected ?string $formato = 'html';

    /**
     * @Serializer\Exclude()
     *
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=false
     * )
     *
     * @OA\Property(type="string")
     */
    protected ?string $parametros = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\NumberType",
     *     required=false
     * )
     *
     * @OA\Property(type="integer")
     * @DTOMapper\Property()
     */
    protected ?int $status = 0;

    /**
     * @var VinculacaoEtiquetaDTO[]
     *
     * @Serializer\SkipWhenEmpty()
     *
     * @DTOMapper\Property(
     *     dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\VinculacaoEtiqueta",
     *     collection=true,
     *     dtoSetter="addVinculacaoEtiqueta",
     *     dtoGetter="getVinculacoesEtiquetas"
     * )
     */
    protected $vinculacoesEtiquetas = [];

    /**
     * Relatorio constructor.
     */
    public function __construct()
    {
        $this->vinculacoesEtiquetas = [];
    }

    public function getObservacao(): ?string
    {
        return $this->observacao;
    }

    /**
     * @return Relatorio
     */
    public function setObservacao(?string $observacao): self
    {
        $this->setVisited('observacao');

        $this->observacao = $observacao;

        return $this;
    }

    /**
     * @return int|EntityInterface|TipoRelatorio|TipoRelatorioEntity|null
     */
    public function getTipoRelatorio(): ?EntityInterface
    {
        return $this->tipoRelatorio;
    }

    /**
     * @param int|EntityInterface|TipoRelatorio|TipoRelatorioEntity|null $tipoRelatorio
     *
     * @return Relatorio
     */
    public function setTipoRelatorio(?EntityInterface $tipoRelatorio): self
    {
        $this->setVisited('tipoRelatorio');

        $this->tipoRelatorio = $tipoRelatorio;

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
     *
     * @return Relatorio
     */
    public function setDocumento(?EntityInterface $documento): self
    {
        $this->setVisited('documento');

        $this->documento = $documento;

        return $this;
    }

    public function getFormato(): ?string
    {
        return $this->formato;
    }

    /**
     * @return Relatorio
     */
    public function setFormato(?string $formato): self
    {
        $this->setVisited('formato');

        $this->formato = $formato;

        return $this;
    }

    public function getParametros(): ?string
    {
        return $this->parametros;
    }

    /**
     * @return array
     */
    public function getParametrosAsArray(): ?array
    {
        if ($this->parametros) {
            return json_decode($this->parametros, true);
        }

        return [];
    }

    /**
     * @return Relatorio
     */
    public function setParametros(?string $parametros): self
    {
        $this->setVisited('parametros');

        $this->parametros = $parametros;

        return $this;
    }

    /**
     * @param VinculacaoEtiqueta $vinculacaoEtiqueta
     *
     * @return Relatorio
     */
    public function addVinculacaoEtiqueta(VinculacaoEtiquetaDTO $vinculacaoEtiqueta): self
    {
        $this->vinculacoesEtiquetas[] = $vinculacaoEtiqueta;

        return $this;
    }

    public function getVinculacoesEtiquetas(): array
    {
        return $this->vinculacoesEtiquetas;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @param int|null $status
     * @return Relatorio
     */
    public function setStatus(?int $status): self
    {
        $this->setVisited('status');

        $this->status = $status;

        return $this;
    }
}
