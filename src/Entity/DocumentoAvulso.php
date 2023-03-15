<?php

declare(strict_types=1);
/**
 * /src/Entity/DocumentoAvulso.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Entity;

use DateTime;
use DMS\Filter\Rules as Filter;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
 * Class DocumentoAvulso.
 *
 *  @ORM\Table(
 *     name="ad_doc_avulso",
 * )
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 *
 * @Gedmo\Loggable
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class DocumentoAvulso implements EntityInterface
{
    // Traits
    use Blameable;
    use Timestampable;
    use Softdeleteable;
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
        $this->juntadas = new ArrayCollection();
        $this->vinculacoesEtiquetas = new ArrayCollection();
    }

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
     * @var Collection|ArrayCollection|ArrayCollection<VinculacaoEtiqueta>
     *
     * @ORM\OneToMany(
     *     targetEntity="VinculacaoEtiqueta",
     *     mappedBy="documentoAvulso"
     * )
     */
    protected $vinculacoesEtiquetas;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(
     *     targetEntity="EspecieDocumentoAvulso"
     * )
     * @ORM\JoinColumn(
     *     name="especie_doc_avulso_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected EspecieDocumentoAvulso $especieDocumentoAvulso;

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
     * @ORM\Column(
     *     name="mecanismo_remessa",
     *     type="string",
     *     nullable=true
     * )
     */
    protected ?string $mecanismoRemessa = null;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     * @ORM\Column(
     *     type="boolean",
     *     nullable=false
     * )
     */
    protected bool $urgente = false;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(
     *     targetEntity="Modelo"
     * )
     * @ORM\JoinColumn(
     *     name="modelo_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected Modelo $modelo;

    /**
     * @Gedmo\Versioned
     * @ORM\Column(
     *     type="datetime",
     *     name="data_hora_encerramento",
     *     nullable=true
     * )
     */
    protected ?DateTime $dataHoraEncerramento = null;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     * @Gedmo\Versioned
     * @ORM\Column(
     *     type="datetime",
     *     name="data_hora_inicio_prazo",
     *     nullable=false
     * )
     */
    protected DateTime $dataHoraInicioPrazo;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     * @Gedmo\Versioned
     * @ORM\Column(
     *     type="datetime",
     *     name="data_hora_final_prazo",
     *     nullable=false
     * )
     */
    protected DateTime $dataHoraFinalPrazo;

    /**
     * @ORM\Column(
     *     type="datetime",
     *     name="data_hora_conclusao_prazo",
     *     nullable=true
     * )
     */
    protected ?DateTime $dataHoraConclusaoPrazo = null;

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
     * @ORM\Column(
     *     type="datetime",
     *     name="data_hora_remessa",
     *     nullable=true
     * )
     */
    protected ?DateTime $dataHoraRemessa = null;

    /**
     * @ORM\Column(
     *     type="datetime",
     *     name="data_hora_resposta",
     *     nullable=true
     * )
     */
    protected ?DateTime $dataHoraResposta = null;

    /**
     * @ORM\Column(
     *     type="datetime",
     *     name="data_hora_reiteracao",
     *     nullable=true
     * )
     */
    protected ?DateTime $dataHoraReiteracao = null;

    /**
     * @ORM\OneToOne(
     *     targetEntity="Documento",
     *     inversedBy="documentoAvulsoResposta"
     * )
     * @ORM\JoinColumn(
     *     name="documento_resposta_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?Documento $documentoResposta = null;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\OneToOne(
     *     targetEntity="Documento",
     *     inversedBy="documentoAvulsoRemessa"
     * )
     * @ORM\JoinColumn(
     *     name="documento_remessa_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected Documento $documentoRemessa;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @Gedmo\Versioned
     *
     * @ORM\ManyToOne(
     *     targetEntity="Usuario"
     * )
     * @ORM\JoinColumn(
     *     name="usuario_responsavel_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected Usuario $usuarioResponsavel;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @Gedmo\Versioned
     *
     * @ORM\ManyToOne(
     *     targetEntity="Setor"
     * )
     * @ORM\JoinColumn(
     *     name="setor_responsavel_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected Setor $setorResponsavel;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="Usuario"
     * )
     * @ORM\JoinColumn(
     *     name="usuario_resposta_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?Usuario $usuarioResposta = null;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="Usuario"
     * )
     * @ORM\JoinColumn(
     *     name="usuario_remessa_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?Usuario $usuarioRemessa = null;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(
     *     targetEntity="Processo",
     *     inversedBy="documentosAvulsos"
     * )
     * @ORM\JoinColumn(
     *     name="processo_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected Processo $processo;

    /**
     * @ORM\OneToOne(
     *     targetEntity="Processo",
     *     mappedBy="documentoAvulsoOrigem"
     * )
     */
    protected ?Processo $processoDestino = null;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="DocumentoAvulso"
     * )
     * @ORM\JoinColumn(
     *     name="doc_avulso_origem_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?DocumentoAvulso $documentoAvulsoOrigem = null;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="Tarefa",
     *     inversedBy="documentosAvulsos"
     * )
     *
     * @ORM\JoinColumn(
     *     name="tarefa_origem_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?Tarefa $tarefaOrigem = null;

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
     *     name="post_it",
     *     nullable=true
     * )
     */
    protected ?string $postIt = null;

    /**
     * @var Collection|ArrayCollection|ArrayCollection<Juntada>
     *
     * @ORM\OneToMany(
     *     targetEntity="Juntada",
     *     mappedBy="documentoAvulso"
     * )
     */
    protected $juntadas;

    /**
     * Registro de data e hora de leitura do oficio pelo usuário.
     *
     * @Gedmo\Versioned
     * @ORM\Column(
     *     type="datetime",
     *     name="data_hora_leitura",
     *     nullable=true
     * )
     */
    protected ?DateTime $dataHoraLeitura = null;

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
     * @return DocumentoAvulso
     */
    public function setSetorOrigem(Setor $setorOrigem): self
    {
        $this->setorOrigem = $setorOrigem;

        return $this;
    }

    /**
     * @return EspecieDocumentoAvulso
     */
    public function getEspecieDocumentoAvulso(): EspecieDocumentoAvulso
    {
        return $this->especieDocumentoAvulso;
    }

    /**
     * @param EspecieDocumentoAvulso $especieDocumentoAvulso
     *
     * @return DocumentoAvulso
     */
    public function setEspecieDocumentoAvulso(EspecieDocumentoAvulso $especieDocumentoAvulso): self
    {
        $this->especieDocumentoAvulso = $especieDocumentoAvulso;

        return $this;
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
     * @return DocumentoAvulso
     */
    public function setObservacao(?string $observacao): self
    {
        $this->observacao = $observacao;

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
     * @return DocumentoAvulso
     */
    public function setMecanismoRemessa(?string $mecanismoRemessa): self
    {
        $this->mecanismoRemessa = $mecanismoRemessa;

        return $this;
    }

    /**
     * @return bool
     */
    public function getUrgente(): bool
    {
        return $this->urgente;
    }

    /**
     * @param bool $urgente
     *
     * @return DocumentoAvulso
     */
    public function setUrgente(bool $urgente): self
    {
        $this->urgente = $urgente;

        return $this;
    }

    /**
     * @return Modelo
     */
    public function getModelo(): Modelo
    {
        return $this->modelo;
    }

    /**
     * @param Modelo $modelo
     *
     * @return DocumentoAvulso
     */
    public function setModelo(Modelo $modelo): self
    {
        $this->modelo = $modelo;

        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getDataHoraEncerramento(): ?DateTime
    {
        return $this->dataHoraEncerramento;
    }

    /**
     * @param DateTime|null $dataHoraEncerramento
     *
     * @return DocumentoAvulso
     */
    public function setDataHoraEncerramento(?DateTime $dataHoraEncerramento): self
    {
        $this->dataHoraEncerramento = $dataHoraEncerramento;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDataHoraInicioPrazo(): DateTime
    {
        return $this->dataHoraInicioPrazo;
    }

    /**
     * @param DateTime $dataHoraInicioPrazo
     *
     * @return DocumentoAvulso
     */
    public function setDataHoraInicioPrazo(DateTime $dataHoraInicioPrazo): self
    {
        $this->dataHoraInicioPrazo = $dataHoraInicioPrazo;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDataHoraFinalPrazo(): DateTime
    {
        return $this->dataHoraFinalPrazo;
    }

    /**
     * @param DateTime $dataHoraFinalPrazo
     *
     * @return DocumentoAvulso
     */
    public function setDataHoraFinalPrazo(DateTime $dataHoraFinalPrazo): self
    {
        $this->dataHoraFinalPrazo = $dataHoraFinalPrazo;

        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getDataHoraConclusaoPrazo(): ?DateTime
    {
        return $this->dataHoraConclusaoPrazo;
    }

    /**
     * @param DateTime|null $dataHoraConclusaoPrazo
     *
     * @return DocumentoAvulso
     */
    public function setDataHoraConclusaoPrazo(?DateTime $dataHoraConclusaoPrazo): self
    {
        $this->dataHoraConclusaoPrazo = $dataHoraConclusaoPrazo;

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
     * @return DocumentoAvulso
     */
    public function setPessoaDestino(?Pessoa $pessoaDestino): self
    {
        $this->pessoaDestino = $pessoaDestino;

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
     * @return DocumentoAvulso
     */
    public function setSetorDestino(?Setor $setorDestino): self
    {
        $this->setorDestino = $setorDestino;

        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getDataHoraRemessa(): ?DateTime
    {
        return $this->dataHoraRemessa;
    }

    /**
     * @param DateTime|null $dataHoraRemessa
     *
     * @return DocumentoAvulso
     */
    public function setDataHoraRemessa(?DateTime $dataHoraRemessa): self
    {
        $this->dataHoraRemessa = $dataHoraRemessa;

        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getDataHoraResposta(): ?DateTime
    {
        return $this->dataHoraResposta;
    }

    /**
     * @param DateTime|null $dataHoraResposta
     *
     * @return DocumentoAvulso
     */
    public function setDataHoraResposta(?DateTime $dataHoraResposta): self
    {
        $this->dataHoraResposta = $dataHoraResposta;

        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getDataHoraReiteracao(): ?DateTime
    {
        return $this->dataHoraReiteracao;
    }

    /**
     * @param DateTime|null $dataHoraReiteracao
     *
     * @return DocumentoAvulso
     */
    public function setDataHoraReiteracao(?DateTime $dataHoraReiteracao): self
    {
        $this->dataHoraReiteracao = $dataHoraReiteracao;

        return $this;
    }

    /**
     * @return Documento|null
     */
    public function getDocumentoResposta(): ?Documento
    {
        return $this->documentoResposta;
    }

    /**
     * @param Documento|null $documentoResposta
     *
     * @return DocumentoAvulso
     */
    public function setDocumentoResposta(?Documento $documentoResposta): self
    {
        $this->documentoResposta = $documentoResposta;

        return $this;
    }

    /**
     * @return Documento
     */
    public function getDocumentoRemessa(): Documento
    {
        return $this->documentoRemessa;
    }

    /**
     * @param Documento $documentoRemessa
     *
     * @return DocumentoAvulso
     */
    public function setDocumentoRemessa(Documento $documentoRemessa): self
    {
        $this->documentoRemessa = $documentoRemessa;

        return $this;
    }

    /**
     * @return Usuario
     */
    public function getUsuarioResponsavel(): Usuario
    {
        return $this->usuarioResponsavel;
    }

    /**
     * @param Usuario $usuarioResponsavel
     *
     * @return DocumentoAvulso
     */
    public function setUsuarioResponsavel(Usuario $usuarioResponsavel): self
    {
        $this->usuarioResponsavel = $usuarioResponsavel;

        return $this;
    }

    /**
     * @return Setor
     */
    public function getSetorResponsavel(): Setor
    {
        return $this->setorResponsavel;
    }

    /**
     * @param Setor $setorResponsavel
     *
     * @return DocumentoAvulso
     */
    public function setSetorResponsavel(Setor $setorResponsavel): self
    {
        $this->setorResponsavel = $setorResponsavel;

        return $this;
    }

    /**
     * @return Usuario|null
     */
    public function getUsuarioResposta(): ?Usuario
    {
        return $this->usuarioResposta;
    }

    /**
     * @param Usuario|null $usuarioResposta
     *
     * @return DocumentoAvulso
     */
    public function setUsuarioResposta(?Usuario $usuarioResposta): self
    {
        $this->usuarioResposta = $usuarioResposta;

        return $this;
    }

    /**
     * @return Usuario|null
     */
    public function getUsuarioRemessa(): ?Usuario
    {
        return $this->usuarioRemessa;
    }

    /**
     * @param Usuario|null $usuarioRemessa
     *
     * @return DocumentoAvulso
     */
    public function setUsuarioRemessa(?Usuario $usuarioRemessa): self
    {
        $this->usuarioRemessa = $usuarioRemessa;

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
     * @return DocumentoAvulso
     */
    public function setProcesso(Processo $processo): self
    {
        $this->processo = $processo;

        return $this;
    }

    /**
     * @return Processo|null
     */
    public function getProcessoDestino(): ?Processo
    {
        return $this->processoDestino;
    }

    /**
     * @param Processo|null $processoDestino
     *
     * @return DocumentoAvulso
     */
    public function setProcessoDestino(?Processo $processoDestino): self
    {
        $this->processoDestino = $processoDestino;

        return $this;
    }

    /**
     * @return DocumentoAvulso|null
     */
    public function getDocumentoAvulsoOrigem(): ?DocumentoAvulso
    {
        return $this->documentoAvulsoOrigem;
    }

    /**
     * @param DocumentoAvulso|null $documentoAvulsoOrigem
     *
     * @return DocumentoAvulso
     */
    public function setDocumentoAvulsoOrigem(?DocumentoAvulso $documentoAvulsoOrigem): self
    {
        $this->documentoAvulsoOrigem = $documentoAvulsoOrigem;

        return $this;
    }

    /**
     * @return Tarefa|null
     */
    public function getTarefaOrigem(): ?Tarefa
    {
        return $this->tarefaOrigem;
    }

    /**
     * @param Tarefa|null $tarefaOrigem
     *
     * @return DocumentoAvulso
     */
    public function setTarefaOrigem(?Tarefa $tarefaOrigem): self
    {
        $this->tarefaOrigem = $tarefaOrigem;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPostIt(): ?string
    {
        return $this->postIt;
    }

    /**
     * @param string|null $postIt
     *
     * @return DocumentoAvulso
     */
    public function setPostIt(?string $postIt): self
    {
        $this->postIt = $postIt;

        return $this;
    }

    /**
     * @param Juntada $juntada
     *
     * @return DocumentoAvulso
     */
    public function addJuntada(Juntada $juntada): self
    {
        if (!$this->juntadas->contains($juntada)) {
            $this->juntadas[] = $juntada;
            $juntada->setDocumentoAvulso($this);
        }

        return $this;
    }

    /**
     * @param Juntada $juntada
     *
     * @return DocumentoAvulso
     */
    public function removeJuntada(Juntada $juntada): self
    {
        if ($this->juntadas->contains($juntada)) {
            $this->juntadas->removeElement($juntada);
        }

        return $this;
    }

    /**
     * @return Collection|ArrayCollection|ArrayCollection<Juntada>
     */
    public function getJuntadas(): Collection
    {
        return $this->juntadas;
    }

    /**
     * @return Collection|ArrayCollection|ArrayCollection<VinculacaoEtiqueta>
     */
    public function getVinculacoesEtiquetas(): ?Collection
    {
        return $this->vinculacoesEtiquetas;
    }

    /**
     * @param VinculacaoEtiqueta $vinculacaoEtiqueta
     *
     * @return DocumentoAvulso
     */
    public function addVinculacaoEtiqueta(VinculacaoEtiqueta $vinculacaoEtiqueta): self
    {
        if (!$this->vinculacoesEtiquetas->contains($vinculacaoEtiqueta)) {
            $this->vinculacoesEtiquetas->add($vinculacaoEtiqueta);
            $vinculacaoEtiqueta->setDocumentoAvulso($this);
        }

        return $this;
    }

    /**
     * @param VinculacaoEtiqueta $vinculacaoEtiqueta
     *
     * @return DocumentoAvulso
     */
    public function removeVinculacaoEtiqueta(VinculacaoEtiqueta $vinculacaoEtiqueta): self
    {
        if ($this->vinculacoesEtiquetas->contains($vinculacaoEtiqueta)) {
            $this->vinculacoesEtiquetas->removeElement($vinculacaoEtiqueta);
        }

        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getDataHoraLeitura(): ?DateTime
    {
        return $this->dataHoraLeitura;
    }

    /**
     * @param DateTime|null $dataHoraLeitura
     *
     * @return Tarefa
     */
    public function setDataHoraLeitura(?DateTime $dataHoraLeitura): self
    {
        $this->dataHoraLeitura = $dataHoraLeitura;

        return $this;
    }
}
