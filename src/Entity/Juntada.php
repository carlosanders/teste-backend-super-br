<?php

declare(strict_types=1);
/**
 * /src/Entity/Juntada.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Entity;

use DMS\Filter\Rules as Filter;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Gedmo\Mapping\Annotation as Gedmo;
use SuppCore\AdministrativoBackend\Entity\Traits\Blameable;
use SuppCore\AdministrativoBackend\Entity\Traits\Id;
use SuppCore\AdministrativoBackend\Entity\Traits\Timestampable;
use SuppCore\AdministrativoBackend\Entity\Traits\Uuid;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Juntada.
 *
 *  @ORM\Table(
 *     name="ad_juntada",
 *     uniqueConstraints={
 *        @ORM\UniqueConstraint(columns={"numeracao_sequencial", "volume_id"}),
 *        @ORM\UniqueConstraint(columns={"volume_id", "documento_id"}),
 *     }
 * )
 *
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @Gedmo\Loggable
 *
 * @UniqueEntity(
 *     fields = {"numeracaoSequencial", "volume"},
 *     message = "Numeração sequencial já está em utilização para esse volume!"
 * )
 * @UniqueEntity(
 *     fields = {"documento", "volume"},
 *     message = "Documento já está juntado nesse volume!"
 * )
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Juntada implements EntityInterface
{
    // Traits
    use Blameable;
    use Timestampable;
    use Id;
    use Uuid;

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
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     * @ORM\Column(
     *     type="integer",
     *     name="numeracao_sequencial",
     *     nullable=false
     * )
     */
    protected int $numeracaoSequencial;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(
     *     targetEntity="Documento",
     *     inversedBy="juntadas",
     *     cascade={"persist"}
     * )
     * @ORM\JoinColumn(
     *     name="documento_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected ?Documento $documento = null;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(
     *     targetEntity="Volume",
     *     inversedBy="juntadas"
     * )
     * @ORM\JoinColumn(
     *     name="volume_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected Volume $volume;

    /**
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Filter\ToUpper(encoding="UTF-8")
     *
     * @Gedmo\Versioned
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
     * @ORM\Column(
     *     type="string",
     *     length=4000,
     *     nullable=false
     * )
     */
    protected string $descricao = '';

    /**
     * @ORM\ManyToOne(
     *     targetEntity="Atividade",
     *     inversedBy="juntadas"
     * )
     * @ORM\JoinColumn(
     *     name="atividade_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?Atividade $atividade = null;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="Tarefa",
     *     inversedBy="juntadas"
     * )
     * @ORM\JoinColumn(
     *     name="tarefa_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?Tarefa $tarefa = null;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="DocumentoAvulso",
     *     inversedBy="juntadas"
     * )
     * @ORM\JoinColumn(
     *     name="doc_avulso_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?DocumentoAvulso $documentoAvulso = null;

    /**
     * @ORM\Column(
     *     name="ativo",
     *     type="boolean",
     *     nullable=false
     * )
     */
    protected bool $ativo = true;

    /**
     * @ORM\Column(
     *     name="vinculada",
     *     type="boolean",
     *     nullable=false
     * )
     */
    protected bool $vinculada = false;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="OrigemDados",
     *     cascade={"persist"}
     * )
     * @ORM\JoinColumn(
     *     name="origem_dados_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?OrigemDados $origemDados = null;

    /**
     * @ORM\OneToOne(
     *     targetEntity="Documento",
     *     mappedBy="juntadaAtual",
     *     cascade={"persist"}
     * )
     */
    protected ?Documento $documentoJuntadaAtual;

    /**
     * @return int
     */
    public function getNumeracaoSequencial(): int
    {
        return $this->numeracaoSequencial;
    }

    /**
     * @param int $numeracaoSequencial
     *
     * @return Juntada
     */
    public function setNumeracaoSequencial(int $numeracaoSequencial): self
    {
        $this->numeracaoSequencial = $numeracaoSequencial;

        return $this;
    }

    /**
     * @return Documento|null
     */
    public function getDocumento(): ?Documento
    {
        return $this->documento;
    }

    /**
     * @param Documento|null $documento
     *
     * @return Juntada
     */
    public function setDocumento(?Documento $documento): self
    {
        // seta apenas na criação
        if (!$this->id) {
            $this->setDocumentoJuntadaAtual($documento);
        }
        $this->documento = $documento;

        return $this;
    }

    /**
     * @return Volume
     */
    public function getVolume(): Volume
    {
        return $this->volume;
    }

    /**
     * @param Volume $volume
     *
     * @return Juntada
     */
    public function setVolume(Volume $volume): self
    {
        $this->volume = $volume;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescricao(): string
    {
        return $this->descricao;
    }

    /**
     * @param string $descricao
     *
     * @return Juntada
     */
    public function setDescricao(string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * @return Atividade|null
     */
    public function getAtividade(): ?Atividade
    {
        return $this->atividade;
    }

    /**
     * @param Atividade|null $atividade
     *
     * @return Juntada
     */
    public function setAtividade(?Atividade $atividade): self
    {
        $this->atividade = $atividade;

        return $this;
    }

    /**
     * @return Tarefa|null
     */
    public function getTarefa(): ?Tarefa
    {
        return $this->tarefa;
    }

    /**
     * @param Tarefa|null $tarefa
     *
     * @return Juntada
     */
    public function setTarefa(?Tarefa $tarefa): self
    {
        $this->tarefa = $tarefa;

        return $this;
    }

    /**
     * @return DocumentoAvulso|null
     */
    public function getDocumentoAvulso(): ?DocumentoAvulso
    {
        return $this->documentoAvulso;
    }

    /**
     * @param DocumentoAvulso|null $documentoAvulso
     *
     * @return Juntada
     */
    public function setDocumentoAvulso(?DocumentoAvulso $documentoAvulso): self
    {
        $this->documentoAvulso = $documentoAvulso;

        return $this;
    }

    /**
     * @return bool
     */
    public function getAtivo(): bool
    {
        return $this->ativo;
    }

    /**
     * @param bool $ativo
     *
     * @return Juntada
     */
    public function setAtivo(bool $ativo): self
    {
        $this->ativo = $ativo;

        return $this;
    }

    /**
     * @return bool
     */
    public function getVinculada(): bool
    {
        return $this->vinculada;
    }

    /**
     * @param bool $vinculada
     *
     * @return Juntada
     */
    public function setVinculada(bool $vinculada): self
    {
        $this->vinculada = $vinculada;

        return $this;
    }

    /**
     * @return OrigemDados|null
     */
    public function getOrigemDados(): ?OrigemDados
    {
        return $this->origemDados;
    }

    /**
     * @param OrigemDados|null $origemDados
     *
     * @return Juntada
     */
    public function setOrigemDados(?OrigemDados $origemDados): self
    {
        $this->origemDados = $origemDados;

        return $this;
    }

    /**
     * @return Documento|null
     */
    public function getDocumentoJuntadaAtual(): ?Documento
    {
        return $this->documentoJuntadaAtual;
    }

    /**
     * @param Documento|null $documentoJuntadaAtual
     */
    public function setDocumentoJuntadaAtual(?Documento $documentoJuntadaAtual): void
    {
        $documentoJuntadaAtual->setJuntadaAtual($this);
        $this->documentoJuntadaAtual = $documentoJuntadaAtual;
    }
}
