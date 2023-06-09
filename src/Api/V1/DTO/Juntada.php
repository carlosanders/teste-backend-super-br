<?php

declare(strict_types=1);
/**
 * /src/Api/V1/DTO/Juntada.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\DTO;

use DMS\Filter\Rules as Filter;
use JMS\Serializer\Annotation as Serializer;
use Nelmio\ApiDocBundle\Annotation\Model;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Atividade as AtividadeDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Documento as DocumentoDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\DocumentoAvulso as DocumentoAvulsoDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Juntada as JuntadaDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Tarefa as TarefaDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Volume as VolumeDTO;
use SuppCore\AdministrativoBackend\DTO\RestDto;
use SuppCore\AdministrativoBackend\DTO\Traits\Ativo;
use SuppCore\AdministrativoBackend\DTO\Traits\Blameable;
use SuppCore\AdministrativoBackend\DTO\Traits\IdUuid;
use SuppCore\AdministrativoBackend\DTO\Traits\OrigemDados;
use SuppCore\AdministrativoBackend\DTO\Traits\Timeblameable;
use SuppCore\AdministrativoBackend\Entity\Atividade as AtividadeEntity;
use SuppCore\AdministrativoBackend\Entity\Documento as DocumentoEntity;
use SuppCore\AdministrativoBackend\Entity\DocumentoAvulso as DocumentoAvulsoEntity;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\Juntada as JuntadaEntity;
use SuppCore\AdministrativoBackend\Entity\Tarefa as TarefaEntity;
use SuppCore\AdministrativoBackend\Entity\Volume as VolumeEntity;
use SuppCore\AdministrativoBackend\Form\Annotations as Form;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;
use SuppCore\AdministrativoBackend\Validator\Constraints as AppAssert;
use OpenApi\Annotations as OA;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Juntada.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @DTOMapper\JsonLD(
 *     jsonLDId="/v1/administrativo/juntada/{id}",
 *     jsonLDType="Juntada",
 *     jsonLDContext="/api/doc/#model-Juntada"
 * )
 *
 * @AppAssert\DtoUniqueEntity(
 *     fieldMapping = {"documento": "documento","volume": "volume"},
 *     entityClass="SuppCore\AdministrativoBackend\Entity\Juntada",
 *     message = "Esse documento já pertenceu a esse NUP e não pode retornar! Utilize uma cópia dele!"
 * )
 *
 * @Form\Form()
 */
class Juntada extends RestDto
{
    use IdUuid;
    use Ativo;
    use Timeblameable;
    use Blameable;
    use OrigemDados;

    /**
     * @DTOMapper\Property()
     * @OA\Property(type="integer")
     */
    protected ?int $numeracaoSequencial = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Documento",
     *     required=true,
     *     methods={
     *          @Form\Method(
     *              "createMethod"
     *          ),
     *          @Form\Method(
     *              "updateMethod",
     *              roles={
     *                  "ROLE_ROOT"
     *              }
     *          ),
     *          @Form\Method(
     *              "patchMethod",
     *              roles={
     *                  "ROLE_ROOT"
     *              }
     *          )
     *     }
     * )
     *
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @OA\Property(ref=@Model(type=DocumentoDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Documento")
     */
    protected ?EntityInterface $documento = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Volume",
     *     required=false,
     *     methods={
     *          @Form\Method(
     *              "createMethod"
     *          ),
     *          @Form\Method(
     *              "updateMethod",
     *              roles={
     *                  "ROLE_ROOT"
     *              }
     *          ),
     *          @Form\Method(
     *              "patchMethod",
     *              roles={
     *                  "ROLE_ROOT"
     *              }
     *          )
     *     }
     * )
     *
     * @OA\Property(ref=@Model(type=VolumeDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Volume")
     */
    protected ?EntityInterface $volume = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Tarefa",
     *     required=false,
     *     methods={
     *          @Form\Method(
     *              "createMethod"
     *          ),
     *          @Form\Method(
     *              "updateMethod",
     *              roles={
     *                  "ROLE_ROOT"
     *              }
     *          ),
     *          @Form\Method(
     *              "patchMethod",
     *              roles={
     *                  "ROLE_ROOT"
     *              }
     *          )
     *     }
     * )
     *
     * @OA\Property(ref=@Model(type=TarefaDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Tarefa")
     */
    protected ?EntityInterface $tarefa = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Atividade",
     *     required=false,
     *     methods={
     *          @Form\Method(
     *              "createMethod"
     *          ),
     *          @Form\Method(
     *              "updateMethod",
     *              roles={
     *                  "ROLE_ROOT"
     *              }
     *          ),
     *          @Form\Method(
     *              "patchMethod",
     *              roles={
     *                  "ROLE_ROOT"
     *              }
     *          )
     *     }
     * )
     *
     * @OA\Property(ref=@Model(type=AtividadeDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Atividade")
     */
    protected ?EntityInterface $atividade = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\DocumentoAvulso",
     *     required=false,
     *     methods={
     *          @Form\Method(
     *              "createMethod"
     *          ),
     *          @Form\Method(
     *              "updateMethod",
     *              roles={
     *                  "ROLE_ROOT"
     *              }
     *          ),
     *          @Form\Method(
     *              "patchMethod",
     *              roles={
     *                  "ROLE_ROOT"
     *              }
     *          )
     *     }
     * )
     *
     * @OA\Property(ref=@Model(type=DocumentoAvulsoDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\DocumentoAvulso")
     */
    protected ?EntityInterface $documentoAvulso = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=true
     * )
     *
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Filter\ToUpper(encoding="UTF-8")
     *
     * @Assert\NotNull(
     *     message="O campo não pode estar em branco!"
     * )
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     * @Assert\Length(
     *     min = 3,
     *     minMessage = "O campo deve ter no mínimo 3 caracteres!",
     *     max = 4000,
     *     maxMessage = "O campo deve ter no máximo 4000 caracteres!"
     * )
     *
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $descricao = null;

    /**
     * @Serializer\Exclude()
     */
    protected ?EntityInterface $juntadaDesentranhada = null;

    /**
     * @DTOMapper\Property()
     * @Serializer\Exclude()
     */
    protected bool $vinculada = false;

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

    public function getNumeracaoSequencial(): ?int
    {
        return $this->numeracaoSequencial;
    }

    /**
     * @return $this|Juntada
     */
    public function setNumeracaoSequencial(?int $numeracaoSequencial): self
    {
        $this->setVisited('numeracaoSequencial');

        $this->numeracaoSequencial = $numeracaoSequencial;

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

    /**
     * @return EntityInterface|VolumeDTO|VolumeEntity|null
     */
    public function getVolume(): ?EntityInterface
    {
        return $this->volume;
    }

    /**
     * @param EntityInterface|VolumeDTO|VolumeEntity|null $volume
     */
    public function setVolume(?EntityInterface $volume): self
    {
        $this->setVisited('volume');

        $this->volume = $volume;

        return $this;
    }

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

    /**
     * @return EntityInterface|AtividadeDTO|AtividadeEntity|null
     */
    public function getAtividade(): ?EntityInterface
    {
        return $this->atividade;
    }

    /**
     * @param EntityInterface|AtividadeDTO|AtividadeEntity|null $atividade
     */
    public function setAtividade(?EntityInterface $atividade): self
    {
        $this->setVisited('atividade');

        $this->atividade = $atividade;

        return $this;
    }

    /**
     * @return EntityInterface|DocumentoAvulsoDTO|DocumentoAvulsoEntity|null
     */
    public function getDocumentoAvulso(): ?EntityInterface
    {
        return $this->documentoAvulso;
    }

    /**
     * @param EntityInterface|DocumentoAvulsoDTO|DocumentoAvulsoEntity|null $documentoAvulso
     */
    public function setDocumentoAvulso(?EntityInterface $documentoAvulso): self
    {
        $this->setVisited('documentoAvulso');

        $this->documentoAvulso = $documentoAvulso;

        return $this;
    }

    /**
     * @return EntityInterface|JuntadaDTO|JuntadaEntity|null
     */
    public function getJuntadaDesentranhada(): ?EntityInterface
    {
        return $this->juntadaDesentranhada;
    }

    /**
     * @param EntityInterface|JuntadaDTO|JuntadaEntity|null $juntadaDesentranhada
     */
    public function setJuntadaDesentranhada(?EntityInterface $juntadaDesentranhada): self
    {
        $this->setVisited('juntadaDesentranhada');

        $this->juntadaDesentranhada = $juntadaDesentranhada;

        return $this;
    }

    /**
     * Set vinculada.
     */
    public function setVinculada(?bool $vinculada): self
    {
        $this->setVisited('vinculada');

        $this->vinculada = $vinculada;

        return $this;
    }

    /**
     * Get vinculada|null.
     *
     * @return bool
     */
    public function getVinculada(): ?bool
    {
        return $this->vinculada;
    }
}
