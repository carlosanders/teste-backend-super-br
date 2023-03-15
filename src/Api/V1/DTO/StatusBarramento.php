<?php

declare(strict_types=1);
/**
 * /src/Api/V1/DTO/StatusBarramento.php.
 */

namespace SuppCore\AdministrativoBackend\Api\V1\DTO;

use Nelmio\ApiDocBundle\Annotation\Model;
use SuppCore\AdministrativoBackend\Api\V1\DTO\DocumentoAvulso as DocumentoAvulsoDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Processo as ProcessoDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Tramitacao as TramitacaoDTO;
use SuppCore\AdministrativoBackend\DTO\RestDto;
use SuppCore\AdministrativoBackend\DTO\Traits\Blameable;
use SuppCore\AdministrativoBackend\DTO\Traits\IdUuid;
use SuppCore\AdministrativoBackend\DTO\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\DTO\Traits\Timeblameable;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Form\Annotations as Form;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;
use OpenApi\Annotations as OA;

/**
 * Class StatusBarramento.
 *
 * @Form\Form()
 */
class StatusBarramento extends RestDto
{
    use IdUuid;
    use Timeblameable;
    use Blameable;
    use Softdeleteable;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\NumberType",
     *     required=false
     * )
     *
     * @OA\Property(type="integer")
     *
     * @DTOMapper\Property()
     */
    protected ?int $idtComponenteDigital = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\NumberType",
     *     required=true
     * )
     *
     * @OA\Property(type="integer")
     *
     * @DTOMapper\Property()
     */
    protected int $idt;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Processo",
     *     required=false
     * )
     *
     * @OA\Property(ref=@Model(type=ProcessoDTO::class))
     *
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Processo")
     */
    protected ?EntityInterface $processo = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\DocumentoAvulso",
     *     required=false
     * )
     *
     * @OA\Property(ref=@Model(type=DocumentoAvulsoDTO::class))
     *
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\DocumentoAvulso")
     */
    protected ?EntityInterface $documentoAvulso = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Tramitacao",
     *     required=false
     * )
     *
     * @OA\Property(ref=@Model(type=TramitacaoDTO::class))
     *
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Tramitacao")
     */
    protected ?EntityInterface $tramitacao = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\NumberType",
     *     required=true
     * )
     *
     * @OA\Property(type="integer")
     *
     * @DTOMapper\Property()
     */
    protected int $codSituacaoTramitacao;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\NumberType",
     *     required=false
     * )
     *
     * @OA\Property(type="integer")
     *
     * @DTOMapper\Property()
     */
    protected ?int $codigoErro = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=false
     * )
     *
     * @OA\Property(type="string")
     *
     * @DTOMapper\Property()
     */
    protected ?string $mensagemErro = null;

    public function getIdt(): int
    {
        return $this->idt;
    }

    public function setIdt(int $idt): self
    {
        $this->setVisited('idt');

        $this->idt = $idt;

        return $this;
    }

    /**
     * @return EntityInterface|null
     */
    public function getTramitacao(): ?EntityInterface
    {
        return $this->tramitacao;
    }

    /**
     * @param EntityInterface|null $tramitacao
     * @return StatusBarramento
     */
    public function setTramitacao(?EntityInterface $tramitacao): self
    {
        $this->setVisited('tramitacao');

        $this->tramitacao = $tramitacao;

        return $this;
    }

    public function getCodSituacaoTramitacao(): int
    {
        return $this->codSituacaoTramitacao;
    }

    public function setCodSituacaoTramitacao(int $codSituacaoTramitacao): self
    {
        $this->setVisited('codSituacaoTramitacao');

        $this->codSituacaoTramitacao = $codSituacaoTramitacao;

        return $this;
    }

    public function getIdtComponenteDigital(): ?int
    {
        return $this->idtComponenteDigital;
    }

    public function setIdtComponenteDigital(?int $idtComponenteDigital): StatusBarramento
    {
        $this->idtComponenteDigital = $idtComponenteDigital;

        $this->setVisited('idtComponenteDigital');

        return $this;
    }

    /**
     * @return EntityInterface|null
     */
    public function getDocumentoAvulso(): ?EntityInterface
    {
        return $this->documentoAvulso;
    }

    /**
     * @param EntityInterface|null $documentoAvulso
     *
     * @return StatusBarramento
     */
    public function setDocumentoAvulso(?EntityInterface $documentoAvulso): self
    {
        $this->setVisited('documentoAvulso');

        $this->documentoAvulso = $documentoAvulso;

        return $this;
    }

    /**
     * @return EntityInterface|null
     */
    public function getProcesso(): ?EntityInterface
    {
        return $this->processo;
    }

    /**
     * @param EntityInterface|null $processo
     *
     * @return StatusBarramento
     */
    public function setProcesso(?EntityInterface $processo): self
    {
        $this->setVisited('processo');

        $this->processo = $processo;

        return $this;
    }

    public function getCodigoErro(): ?int
    {
        return $this->codigoErro;
    }

    public function setCodigoErro(?int $codigoErro): StatusBarramento
    {
        $this->setVisited('codigoErro');

        $this->codigoErro = $codigoErro;

        return $this;
    }

    public function getMensagemErro(): ?string
    {
        return $this->mensagemErro;
    }

    public function setMensagemErro(?string $mensagemErro): StatusBarramento
    {
        $this->setVisited('mensagemErro');

        $this->mensagemErro = $mensagemErro;

        return $this;
    }
}
