<?php

declare(strict_types=1);
/**
 * /src/Entity/Tramitacao.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Entity;

use DateTime;
use DMS\Filter\Rules as Filter;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Gedmo\Mapping\Annotation as Gedmo;
use SuppCore\AdministrativoBackend\Entity\Traits\Blameable;
use SuppCore\AdministrativoBackend\Entity\Traits\Id;
use SuppCore\AdministrativoBackend\Entity\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\Entity\Traits\Timestampable;
use SuppCore\AdministrativoBackend\Entity\Traits\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Tramitacao.
 *
 *  @ORM\Table(
 *     name="ad_tramitacao",
 * )
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Tramitacao implements EntityInterface
{
    // Traits
    use Blameable;
    use Timestampable;
    use Softdeleteable;
    use Id;
    use Uuid;

    /**
     * @Assert\Length(
     *     max = 255,
     *     maxMessage = "Campo deve ter no máximo {{ limit }} letras ou números"
     * )
     *
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Filter\ToUpper(encoding="UTF-8")
     * @ORM\Column(
     *     type="string",
     *     nullable=true
     * )
     */
    protected ?string $observacao = null;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     * @ORM\Column(
     *     type="boolean",
     *     nullable=false
     * )
     */
    protected ?bool $urgente = false;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(
     *     targetEntity="Processo",
     *     inversedBy="tramitacoes"
     * )
     * @ORM\JoinColumn(
     *     name="processo_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected Processo $processo;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(
     *     targetEntity="Setor"
     * )
     * @ORM\JoinColumn(
     *     name="setor_origem_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected Setor $setorOrigem;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="Setor"
     * )
     * @ORM\JoinColumn(
     *     name="setor_destino_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?Setor $setorDestino = null;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="Pessoa"
     * )
     * @ORM\JoinColumn(
     *     name="pessoa_destino_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?Pessoa $pessoaDestino = null;

    /**
     * @ORM\Column(
     *     type="datetime",
     *     name="data_hora_recebimento",
     *     nullable=true
     * )
     */
    protected ?DateTime $dataHoraRecebimento = null;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="Usuario"
     * )
     * @ORM\JoinColumn(
     *     name="usuario_recebimento_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?Usuario $usuarioRecebimento = null;

    /**
     * @ORM\Column(
     *     name="mecanismo_remessa",
     *     type="string",
     *     nullable=true
     * )
     */
    protected ?string $mecanismoRemessa = null;

    /**
     * Constructor.
     *
     * @throws Exception
     */
    public function __construct()
    {
        $this->setUuid();
    }

    /**
     * @return string|null
     */
    public function getObservacao(): ?string
    {
        return $this->observacao;
    }

    /**
     * @param string|null $observacao
     *
     * @return Tramitacao
     */
    public function setObservacao(?string $observacao): self
    {
        $this->observacao = $observacao;

        return $this;
    }

    /**
     * @return bool
     */
    public function getUrgente(): ?bool
    {
        return $this->urgente;
    }

    /**
     * @param bool $urgente
     *
     * @return Tramitacao
     */
    public function setUrgente(bool $urgente): self
    {
        $this->urgente = $urgente;

        return $this;
    }

    /**
     * @return Processo
     */
    public function getProcesso(): Processo
    {
        return $this->processo;
    }

    /**
     * @param Processo $processo
     *
     * @return Tramitacao
     */
    public function setProcesso(Processo $processo): self
    {
        $this->processo = $processo;

        return $this;
    }

    /**
     * @return Setor
     */
    public function getSetorOrigem(): Setor
    {
        return $this->setorOrigem;
    }

    /**
     * @param Setor $setorOrigem
     *
     * @return Tramitacao
     */
    public function setSetorOrigem(Setor $setorOrigem): self
    {
        $this->setorOrigem = $setorOrigem;

        return $this;
    }

    /**
     * @return Setor|null
     */
    public function getSetorDestino(): ?Setor
    {
        return $this->setorDestino;
    }

    /**
     * @param Setor|null $setorDestino
     *
     * @return Tramitacao
     */
    public function setSetorDestino(?Setor $setorDestino): self
    {
        $this->setorDestino = $setorDestino;

        return $this;
    }

    /**
     * @return Pessoa|null
     */
    public function getPessoaDestino(): ?Pessoa
    {
        return $this->pessoaDestino;
    }

    /**
     * @param Pessoa|null $pessoaDestino
     *
     * @return Tramitacao
     */
    public function setPessoaDestino(?Pessoa $pessoaDestino): self
    {
        $this->pessoaDestino = $pessoaDestino;

        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getDataHoraRecebimento(): ?DateTime
    {
        return $this->dataHoraRecebimento;
    }

    /**
     * @param DateTime|null $dataHoraRecebimento
     *
     * @return Tramitacao
     */
    public function setDataHoraRecebimento(?DateTime $dataHoraRecebimento): self
    {
        $this->dataHoraRecebimento = $dataHoraRecebimento;

        return $this;
    }

    /**
     * @return Usuario|null
     */
    public function getUsuarioRecebimento(): ?Usuario
    {
        return $this->usuarioRecebimento;
    }

    /**
     * @param Usuario|null $usuarioRecebimento
     *
     * @return Tramitacao
     */
    public function setUsuarioRecebimento(?Usuario $usuarioRecebimento): self
    {
        $this->usuarioRecebimento = $usuarioRecebimento;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMecanismoRemessa(): ?string
    {
        return $this->mecanismoRemessa;
    }

    /**
     * @param string|null $mecanismoRemessa
     *
     * @return Tramitacao
     */
    public function setMecanismoRemessa(?string $mecanismoRemessa): self
    {
        $this->mecanismoRemessa = $mecanismoRemessa;

        return $this;
    }
}
