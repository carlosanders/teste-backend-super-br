<?php

declare(strict_types=1);
/**
 * /src/Api/V1/DTO/Dossie.php.
 *
 * @author  Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\DTO;

use DateTime;
use JMS\Serializer\Annotation as Serializer;
use Nelmio\ApiDocBundle\Annotation\Model;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Documento as DocumentoDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Pessoa as PessoaDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Processo as ProcessoDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\TipoDossie as TipoDossieDTO;
use SuppCore\AdministrativoBackend\DTO\RestDto;
use SuppCore\AdministrativoBackend\DTO\Traits\Blameable;
use SuppCore\AdministrativoBackend\DTO\Traits\IdUuid;
use SuppCore\AdministrativoBackend\DTO\Traits\OrigemDados;
use SuppCore\AdministrativoBackend\DTO\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\DTO\Traits\Timeblameable;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\Pessoa as PessoaEntity;
use SuppCore\AdministrativoBackend\Entity\TipoDossie as TipoDossieEntity;
use SuppCore\AdministrativoBackend\Form\Annotations as Form;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;
use OpenApi\Annotations as OA;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Dossie.
 *
 * @author  Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @DTOMapper\JsonLD(
 *     jsonLDId="/v1/administrativo/dossie",
 *     jsonLDType="Dossie",
 *     jsonLDContext="/api/doc/#model-Dossie"
 * )
 *
 * @Form\Form()
 */
class Dossie extends RestDto
{
    use IdUuid;
    use Blameable;
    use Softdeleteable;
    use Timeblameable;
    use OrigemDados;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=false
     * )
     * @DTOMapper\Property()
     */
    protected ?string $numeroDocumentoPrincipal = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Pessoa",
     *     required=true
     * )
     * @OA\Property(ref=@Model(type=PessoaDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Pessoa")
     */
    protected ?EntityInterface $pessoa = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\TipoDossie",
     *     required=true
     * )
     *
     * @OA\Property(ref=@Model(type=TipoDossieDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\TipoDossie")
     */
    protected ?EntityInterface $tipoDossie = null;

    /**
     * @OA\Property(type="string", format="date-time")
     * @DTOMapper\Property()
     */
    protected ?DateTime $dataConsulta = null;

    /**
     * @DTOMapper\Property()
     */
    protected ?string $conteudo = null;

    /**
     *  @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Documento",
     *     required=false
     * )
     * @OA\Property(ref=@Model(type=DocumentoDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Documento")
     */
    protected ?EntityInterface $documento = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Processo",
     *     required=true
     * )
     * @OA\Property(ref=@Model(type=ProcessoDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Processo")
     */
    protected ?EntityInterface $processo = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\CheckboxType",
     *     required=false
     * )
     *
     * @OA\Property(type="boolean", default=false)
     * @Serializer\Exclude()
     */
    protected ?bool $sobDemanda = false;

    /**
     * @DTOMapper\Property()
     */
    protected ?string $protocoloRequerimento = null;

    /**
     * @DTOMapper\Property()
     */
    protected ?string $statusRequerimento = null;

    /**
     * @DTOMapper\Property()
     */
    protected ?string $fonteDados = null;

    /**
     * @DTOMapper\Property()
     */
    protected ?int $versao = null;

    /**
     * @return string|null
     */
    public function getConteudo(): ?string
    {
        return $this->conteudo;
    }

    /**
     * @param string|null $conteudo
     *
     * @return self
     */
    public function setConteudo(?string $conteudo): self
    {
        $this->setVisited('conteudo');
        $this->conteudo = $conteudo;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getNumeroDocumentoPrincipal(): ?string
    {
        return $this->numeroDocumentoPrincipal;
    }

    /**
     * @param string $numeroDocumentoPrincipal
     *
     * @return Dossie
     */
    public function setNumeroDocumentoPrincipal(?string $numeroDocumentoPrincipal): self
    {
        $this->setVisited('numeroDocumentoPrincipal');

        $this->numeroDocumentoPrincipal = $numeroDocumentoPrincipal;

        return $this;
    }

    /**
     * @return EntityInterface|PessoaDTO|PessoaEntity|null
     */
    public function getPessoa(): EntityInterface | PessoaDTO | PessoaEntity | null
    {
        return $this->pessoa;
    }

    /**
     * @param EntityInterface|null $pessoa
     *
     * @return Dossie
     */
    public function setPessoa(?EntityInterface $pessoa): self
    {
        $this->setVisited('pessoa');

        $this->pessoa = $pessoa;

        return $this;
    }

    /**
     * @return EntityInterface|TipoDossieDTO|TipoDossieEntity|null
     */
    public function getTipoDossie(): EntityInterface | TipoDossieDTO | TipoDossieEntity | null
    {
        return $this->tipoDossie;
    }

    /**
     * @param TipoDossieDTO|TipoDossieEntity $tipoDossie
     *
     * @return Dossie
     * @noinspection PhpUnused
     */
    public function setTipoDossie(TipoDossieDTO | TipoDossieEntity $tipoDossie): self
    {
        $this->setVisited('tipoDossie');

        $this->tipoDossie = $tipoDossie;

        return $this;
    }

    /**
     * @return int|null
     * @noinspection PhpUnused
     */
    public function getVersao(): ?int
    {
        return $this->versao;
    }

    /**
     * @param ?int $versao
     *
     * @return Dossie
     */
    public function setVersao(?int $versao): self
    {
        $this->setVisited('versao');

        $this->versao = $versao;

        return $this;
    }

    /**
     * @return EntityInterface|null
     */
    public function getDocumento(): ?EntityInterface
    {
        return $this->documento;
    }

    /**
     * @param EntityInterface|null $documento
     *
     * @return Dossie
     */
    public function setDocumento(?EntityInterface $documento): self
    {
        $this->setVisited('documento');

        $this->documento = $documento;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getProtocoloRequerimento(): ?string
    {
        return $this->protocoloRequerimento;
    }

    /**
     * @param string|null $protocoloRequerimento
     *
     * @return Dossie
     */
    public function setProtocoloRequerimento(?string $protocoloRequerimento): self
    {
        $this->setVisited('protocoloRequerimento');

        $this->protocoloRequerimento = $protocoloRequerimento;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getStatusRequerimento(): ?string
    {
        return $this->statusRequerimento;
    }

    /**
     * @param string|null $statusRequerimento
     *
     * @return Dossie
     */
    public function setStatusRequerimento(?string $statusRequerimento): self
    {
        $this->setVisited('statusRequerimento');

        $this->statusRequerimento = $statusRequerimento;

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
     * @return Dossie
     */
    public function setProcesso(?EntityInterface $processo): self
    {
        $this->setVisited('processo');

        $this->processo = $processo;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFonteDados(): ?string
    {
        return $this->fonteDados;
    }

    /**
     * @param string|null $fonteDados
     * @return Dossie
     */
    public function setFonteDados(?string $fonteDados): self
    {
        $this->setVisited('fonteDados');

        $this->fonteDados = $fonteDados;

        return $this;
    }


    /**
     * @return DateTime|null
     */
    public function getDataConsulta(): ?DateTime
    {
        return $this->dataConsulta;
    }

    /**
     * @param DateTime|null $dataConsulta
     * @return Dossie
     */
    public function setDataConsulta(?DateTime $dataConsulta): self
    {
        $this->setVisited('dataConsulta');

        $this->dataConsulta = $dataConsulta;

        return $this;
    }

    public function getSobDemanda(): ?bool
    {
        return $this->sobDemanda;
    }

    public function setSobDemanda(?bool $sobDemanda): self
    {
        $this->setVisited('sobDemanda');

        $this->sobDemanda = $sobDemanda;

        return $this;
    }
}
