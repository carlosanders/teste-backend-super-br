<?php

declare(strict_types=1);
/**
 * /src/Api/V1/DTO/Tramitacao.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\DTO;

use DateTime;
use DMS\Filter\Rules as Filter;
use Nelmio\ApiDocBundle\Annotation\Model;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Pessoa as PessoaDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Processo as ProcessoDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Setor as SetorDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Usuario as UsuarioDTO;
use SuppCore\AdministrativoBackend\DTO\RestDto;
use SuppCore\AdministrativoBackend\DTO\Traits\Blameable;
use SuppCore\AdministrativoBackend\DTO\Traits\IdUuid;
use SuppCore\AdministrativoBackend\DTO\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\DTO\Traits\Timeblameable;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\Pessoa as PessoaEntity;
use SuppCore\AdministrativoBackend\Entity\Processo as ProcessoEntity;
use SuppCore\AdministrativoBackend\Entity\Setor as SetorEntity;
use SuppCore\AdministrativoBackend\Entity\Usuario as UsuarioEntity;
use SuppCore\AdministrativoBackend\Form\Annotations as Form;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;
use OpenApi\Annotations as OA;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Tramitacao.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @DTOMapper\JsonLD(
 *     jsonLDId="/v1/administrativo/tramitacao/{id}",
 *     jsonLDType="Tramitacao",
 *     jsonLDContext="/api/doc/#model-Tramitacao"
 * )
 *
 * @Form\Form()
 */
class Tramitacao extends RestDto
{
    use IdUuid;
    use Timeblameable;
    use Blameable;
    use Softdeleteable;

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
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\CheckboxType",
     *     required=false
     * )
     *
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     * @OA\Property(type="boolean", default=false)
     * @DTOMapper\Property()
     */
    protected bool $urgente = false;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Processo",
     *     required=true
     * )
     *
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @OA\Property(ref=@Model(type=ProcessoDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Processo")
     */
    protected ?EntityInterface $processo = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Setor",
     *     required=true
     * )
     *
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @OA\Property(ref=@Model(type=SetorDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Setor")
     */
    protected ?EntityInterface $setorOrigem = null;

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
    protected ?EntityInterface $setorDestino = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Pessoa",
     *     required=false
     * )
     *
     * @OA\Property(ref=@Model(type=PessoaDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Pessoa")
     */
    protected ?EntityInterface $pessoaDestino = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\DateTimeType",
     *     widget="single_text",
     *     required=false
     * )
     *
     * @OA\Property(type="string", format="date-time")
     * @DTOMapper\Property()
     */
    protected ?DateTime $dataHoraRecebimento = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=true
     * )
     *
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $mecanismoRemessa = null;

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
    protected ?EntityInterface $usuarioRecebimento = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Setor",
     *     required=false
     * )
     *
     * @OA\Property(ref=@Model(type=SetorDTO::class))
     */
    protected ?EntityInterface $setorAtual = null;

    public function getObservacao(): ?string
    {
        return $this->observacao;
    }

    public function setObservacao(?string $observacao): self
    {
        $this->setVisited('observacao');

        $this->observacao = $observacao;

        return $this;
    }

    public function getUrgente(): ?bool
    {
        return $this->urgente;
    }

    public function setUrgente(?bool $urgente): self
    {
        $this->setVisited('urgente');

        $this->urgente = $urgente;

        return $this;
    }

    /**
     * @return EntityInterface|ProcessoDTO|ProcessoEntity|null
     */
    public function getProcesso(): ?EntityInterface
    {
        return $this->processo;
    }

    /**
     * @param EntityInterface|ProcessoDTO|ProcessoEntity|null $processo
     */
    public function setProcesso(?EntityInterface $processo): self
    {
        $this->setVisited('processo');

        $this->processo = $processo;

        return $this;
    }

    /**
     * @return EntityInterface|SetorDTO|SetorEntity|null
     */
    public function getSetorOrigem(): ?EntityInterface
    {
        return $this->setorOrigem;
    }

    /**
     * @param EntityInterface|SetorDTO|SetorEntity|null $setorOrigem
     */
    public function setSetorOrigem(?EntityInterface $setorOrigem): self
    {
        $this->setVisited('setorOrigem');

        $this->setorOrigem = $setorOrigem;

        return $this;
    }

    /**
     * @return EntityInterface|SetorDTO|SetorEntity|null
     */
    public function getSetorDestino(): ?EntityInterface
    {
        return $this->setorDestino;
    }

    /**
     * @param EntityInterface|SetorDTO|SetorEntity|null $setorDestino
     */
    public function setSetorDestino(?EntityInterface $setorDestino): self
    {
        $this->setVisited('setorDestino');

        $this->setorDestino = $setorDestino;

        return $this;
    }

    /**
     * @return EntityInterface|PessoaDTO|PessoaEntity|null
     */
    public function getPessoaDestino(): ?EntityInterface
    {
        return $this->pessoaDestino;
    }

    /**
     * @param EntityInterface|PessoaDTO|PessoaEntity|null $pessoaDestino
     */
    public function setPessoaDestino(?EntityInterface $pessoaDestino): self
    {
        $this->setVisited('pessoaDestino');

        $this->pessoaDestino = $pessoaDestino;

        return $this;
    }

    public function getDataHoraRecebimento(): ?DateTime
    {
        return $this->dataHoraRecebimento;
    }

    public function setDataHoraRecebimento(?DateTime $dataHoraRecebimento): self
    {
        $this->setVisited('dataHoraRecebimento');

        $this->dataHoraRecebimento = $dataHoraRecebimento;

        return $this;
    }

    /**
     * @return UsuarioDTO|UsuarioEntity|EntityInterface|int|null
     */
    public function getUsuarioRecebimento(): ?EntityInterface
    {
        return $this->usuarioRecebimento;
    }

    /**
     * @param UsuarioDTO|UsuarioEntity|EntityInterface|int|null $usuarioRecebimento
     */
    public function setUsuarioRecebimento(?EntityInterface $usuarioRecebimento): self
    {
        $this->setVisited('usuarioRecebimento');

        $this->usuarioRecebimento = $usuarioRecebimento;

        return $this;
    }

    /**
     * @return EntityInterface|SetorDTO|SetorEntity|null
     */
    public function getSetorAtual(): ?EntityInterface
    {
        return $this->setorAtual;
    }

    /**
     * @param EntityInterface|SetorDTO|SetorEntity|null $setorAtual
     */
    public function setSetorAtual(?EntityInterface $setorAtual): self
    {
        $this->setVisited('setorAtual');

        $this->setorAtual = $setorAtual;

        return $this;
    }

    public function getMecanismoRemessa(): ?string
    {
        return $this->mecanismoRemessa;
    }

    public function setMecanismoRemessa(?string $mecanismoRemessa): self
    {
        $this->setVisited('mecanismoRemessa');

        $this->mecanismoRemessa = $mecanismoRemessa;

        return $this;
    }
}
