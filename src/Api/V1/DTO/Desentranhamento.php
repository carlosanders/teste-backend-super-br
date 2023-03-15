<?php

declare(strict_types=1);
/**
 * /src/Api/V1/DTO/Desentranhamento.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\DTO;

use DMS\Filter\Rules as Filter;
use JMS\Serializer\Annotation as Serializer;
use Nelmio\ApiDocBundle\Annotation\Model;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Juntada as JuntadaDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Processo as ProcessoDTO;
use SuppCore\AdministrativoBackend\DTO\RestDto;
use SuppCore\AdministrativoBackend\DTO\Traits\Blameable;
use SuppCore\AdministrativoBackend\DTO\Traits\IdUuid;
use SuppCore\AdministrativoBackend\DTO\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\DTO\Traits\Timeblameable;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\Juntada as JuntadaEntity;
use SuppCore\AdministrativoBackend\Entity\Processo as ProcessoEntity;
use SuppCore\AdministrativoBackend\Form\Annotations as Form;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;
use OpenApi\Annotations as OA;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * Class Desentranhamento.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @DTOMapper\JsonLD(
 *     jsonLDId="/v1/administrativo/desentranhamento/{id}",
 *     jsonLDType="Desentranhamento",
 *     jsonLDContext="/api/doc/#model-Desentranhamento"
 * )
 *
 * @Form\Form()
 */
class Desentranhamento extends RestDto
{
    use IdUuid;
    use Timeblameable;
    use Blameable;
    use Softdeleteable;
    public const TIPOS = ['processo_existente', 'novo_processo', 'arquivo'];

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Juntada",
     *     required=true
     * )
     *
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @OA\Property(ref=@Model(type=JuntadaDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Juntada")
     */
    protected ?EntityInterface $juntada = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Processo",
     *     required=false
     * )
     *
     * @OA\Property(ref=@Model(type=ProcessoDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Processo")
     */
    protected ?EntityInterface $processoDestino = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=false
     * )
     *
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Campo deve ter no máximo {{ limit }} letras ou números"
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
    protected ?string $observacao = null;

    /**
     * @Serializer\Exclude()
     *
     * @Assert\Choice    (     {"processo_existente", "novo_processo", "arquivo"} )
     *
     * @OA\Property(type="string")
     *
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=true
     * )
     */
    protected ?string $tipo = null;

    /**
     * @Serializer\Exclude()
     *
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Juntada",
     *     multiple=true,
     *     required=false
     * )
     */
    public $juntadasBloco = [];

    public function __construct()
    {
        $this->juntadasBloco = [];
    }

    /**
     * @return EntityInterface|JuntadaDTO|JuntadaEntity|null
     */
    public function getJuntada(): ?EntityInterface
    {
        return $this->juntada;
    }

    /**
     * @param EntityInterface|JuntadaDTO|JuntadaEntity|null $juntada
     *
     * @return self
     */
    public function setJuntada(?EntityInterface $juntada): Desentranhamento
    {
        $this->setVisited('juntada');

        $this->juntada = $juntada;

        return $this;
    }

    /**
     * @return EntityInterface|ProcessoDTO|ProcessoEntity|null
     */
    public function getProcessoDestino(): ?EntityInterface
    {
        return $this->processoDestino;
    }

    /**
     * @param EntityInterface|ProcessoDTO|ProcessoEntity|null $processoDestino
     *
     * @return self
     */
    public function setProcessoDestino(?EntityInterface $processoDestino): Desentranhamento
    {
        $this->setVisited('processoDestino');

        $this->processoDestino = $processoDestino;

        return $this;
    }

    public function getObservacao(): ?string
    {
        return $this->observacao;
    }

    /**
     * @return self
     */
    public function setObservacao(?string $observacao): Desentranhamento
    {
        $this->setVisited('observacao');

        $this->observacao = $observacao;

        return $this;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    /**
     * @return Desentranhamento
     */
    public function setTipo(?string $tipo): self
    {
        $this->setVisited('tipo');

        $this->tipo = $tipo;

        return $this;
    }

    /**
     * @Assert\Callback
     */
    public function isValid(ExecutionContextInterface $context): void
    {
        if ('processo_existente' === $this->getTipo() && !$this->getProcessoDestino()) {
            $context->buildViolation(
                'É necessário informar o processo existente para onde a o documento será enviado!'
            )
                ->atPath('id')
                ->addViolation();
        }
    }

    /**
     * @param EntityInterface|JuntadaDTO|JuntadaEntity|null $juntadasBloco
     */
    public function addJuntadasBloco(?EntityInterface $juntadasBloco): self
    {
        $this->juntadasBloco[] = $juntadasBloco;

        return $this;
    }

    /**
     * @return self
     */
    public function resetJuntadasBloco()
    {
        $this->juntadasBloco = [];

        return $this;
    }

    /**
     * @return array
     */
    public function getJuntadasBloco()
    {
        return $this->juntadasBloco;
    }
}
