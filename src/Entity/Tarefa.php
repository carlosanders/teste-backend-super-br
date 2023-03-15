<?php

declare(strict_types=1);
/**
 * /src/Entity/Tarefa.php.
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
 * Class Tarefa.
 *
 *  @ORM\Table(
 *     name="ad_tarefa",
 * )
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 * @Gedmo\Loggable
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Tarefa implements EntityInterface
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
        $this->atividades = new ArrayCollection();
        $this->distribuicoes = new ArrayCollection();
        $this->compartilhamentos = new ArrayCollection();
        $this->minutas = new ArrayCollection();
        $this->documentosAvulsos = new ArrayCollection();
        $this->juntadas = new ArrayCollection();
        $this->vinculacoesEtiquetas = new ArrayCollection();
    }

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(
     *     targetEntity="Processo",
     *     inversedBy="tarefas"
     * )
     * @ORM\JoinColumn(
     *     name="processo_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected ?Processo $processo = null;

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
     *     name="local_evento",
     *     type="string",
     *     nullable=true
     * )
     */
    protected ?string $localEvento = null;

    /**
     * @ORM\OneToOne(
     *     targetEntity="Atividade",
     *     mappedBy="tarefaAprovacao"
     * )
     */
    protected ?Atividade $atividadeAprovacao = null;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="VinculacaoWorkflow"
     * )
     * @ORM\JoinColumn(
     *     name="vinculacao_workflow_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?VinculacaoWorkflow $vinculacaoWorkflow = null;

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
     * Registro de data e hora de leitura da tarefa pelo usuário.
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
    protected ?DateTime $dataHoraInicioPrazo = null;

    /**
     * @Gedmo\Versioned
     * @ORM\Column(
     *     type="datetime",
     *     name="data_hora_final_prazo",
     *     nullable=true
     * )
     */
    protected ?DateTime $dataHoraFinalPrazo = null;

    /**
     * @ORM\Column(
     *     type="datetime",
     *     name="data_hora_conclusao_prazo",
     *     nullable=true
     * )
     */
    protected ?DateTime $dataHoraConclusaoPrazo = null;

    /**
     * @ORM\Column(
     *     type="datetime",
     *     name="data_hora_distribuicao",
     *     nullable=true
     * )
     */
    protected ?DateTime $dataHoraDistribuicao = null;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(
     *     targetEntity="EspecieTarefa",
     *     inversedBy="tarefas"
     * )
     * @ORM\JoinColumn(
     *     name="especie_tarefa_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected ?EspecieTarefa $especieTarefa = null;

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
    protected ?Setor $setorResponsavel = null;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="Usuario"
     * )
     * @ORM\JoinColumn(
     *     name="usuario_concl_prazo_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?Usuario $usuarioConclusaoPrazo = null;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="Setor"
     * )
     * @ORM\JoinColumn(
     *     name="setor_origem_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?Setor $setorOrigem = null;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     * @ORM\Column(
     *     type="boolean",
     *     name="redistribuida",
     *     nullable=false
     * )
     */
    protected bool $redistribuida = false;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     * @ORM\Column(
     *     type="boolean",
     *     name="distribuicao_automatica",
     *     nullable=false
     * )
     */
    protected bool $distribuicaoAutomatica = false;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     * @ORM\Column(
     *     type="boolean",
     *     name="livre_balanceamento",
     *     nullable=false
     * )
     */
    protected bool $livreBalanceamento = false;

    /**
     * @ORM\Column(
     *     type="text",
     *     name="auditoria_distribuicao",
     *     nullable=true
     * )
     */
    protected ?string $auditoriaDistribuicao = null;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     * @ORM\Column(
     *     type="integer",
     *     name="tipo_distribuicao",
     *     nullable=false
     * )
     */
    protected int $tipoDistribuicao = 0;

    /**
     * @var Collection<Atividade>|ArrayCollection<Atividade>
     *
     * @ORM\OneToMany(
     *     targetEntity="Atividade",
     *     mappedBy="tarefa",
     *     cascade={"all"}
     * )
     * @ORM\OrderBy(
     *     {"criadoEm" = "ASC"}
     * )
     */
    protected Collection|ArrayCollection $atividades;

    /**
     * @var Collection<Distribuicao>|ArrayCollection<Distribuicao>
     *
     * @ORM\OneToMany(
     *     targetEntity="Distribuicao",
     *     mappedBy="tarefa"
     * )
     * @ORM\OrderBy(
     *     {"dataHoraDistribuicao" = "ASC"}
     * )
     */
    protected Collection|ArrayCollection $distribuicoes;

    /**
     * @var Collection<Compartilhamento>|ArrayCollection<Compartilhamento>
     *
     * @ORM\OneToMany(
     *     targetEntity="Compartilhamento",
     *     mappedBy="tarefa",
     *     cascade={"all"}
     * )
     */
    protected Collection|ArrayCollection $compartilhamentos;

    /**
     * @var Collection<Documento>|ArrayCollection<Documento>
     *
     * @ORM\OneToMany(
     *     targetEntity="Documento",
     *     mappedBy="tarefaOrigem"
     * )
     * @ORM\OrderBy(
     *     {"criadoEm" = "ASC", "id" = "ASC"}
     * )
     */
    protected Collection|ArrayCollection $minutas;

    /**
     * @var Collection<DocumentoAvulso>|ArrayCollection<DocumentoAvulso>
     *
     * @ORM\OneToMany(
     *     targetEntity="DocumentoAvulso",
     *     mappedBy="tarefaOrigem"
     * )
     */
    protected Collection|ArrayCollection $documentosAvulsos;

    /**
     * @var Collection<Juntada>|ArrayCollection<Juntada>
     *
     * @ORM\OneToMany(
     *     targetEntity="Juntada",
     *     mappedBy="tarefa"
     * )
     */
    protected Collection|ArrayCollection $juntadas;

    /**
     * @var Collection<VinculacaoEtiqueta>|ArrayCollection<VinculacaoEtiqueta>
     *
     * @ORM\OneToMany(
     *     targetEntity="VinculacaoEtiqueta",
     *     mappedBy="tarefa"
     * )
     */
    protected Collection|ArrayCollection $vinculacoesEtiquetas;

    /**
     * @Gedmo\Versioned
     *
     * @ORM\ManyToOne(
     *     targetEntity="Folder"
     * )
     * @ORM\JoinColumn(
     *     name="folder_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?Folder $folder = null;

    /**
     * @return Processo|null
     */
    public function getProcesso(): ?Processo
    {
        return $this->processo;
    }

    /**
     * @param Processo|null $processo
     *
     * @return $this
     */
    public function setProcesso(?Processo $processo): self
    {
        $this->processo = $processo;

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
     * @return $this
     */
    public function setObservacao(?string $observacao): self
    {
        $this->observacao = $observacao;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLocalEvento(): ?string
    {
        return $this->localEvento;
    }

    /**
     * @param string|null $localEvento
     *
     * @return $this
     */
    public function setLocalEvento(?string $localEvento): self
    {
        $this->localEvento = $localEvento;

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
     * @return $this
     */
    public function setDataHoraLeitura(?DateTime $dataHoraLeitura): self
    {
        $this->dataHoraLeitura = $dataHoraLeitura;

        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getDataHoraDistribuicao(): ?DateTime
    {
        return $this->dataHoraDistribuicao;
    }

    /**
     * @param DateTime|null $dataHoraDistribuicao
     *
     * @return $this
     */
    public function setDataHoraDistribuicao(?DateTime $dataHoraDistribuicao): self
    {
        $this->dataHoraDistribuicao = $dataHoraDistribuicao;

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
     * @return Folder|null
     */
    public function getFolder(): ?Folder
    {
        return $this->folder;
    }

    /**
     * @param Folder|null $folder
     *
     * @return $this
     */
    public function setFolder(?Folder $folder): self
    {
        $this->folder = $folder;

        return $this;
    }

    /**
     * @param string|null $postIt
     *
     * @return $this
     */
    public function setPostIt(?string $postIt): self
    {
        $this->postIt = $postIt;

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
     * @return $this
     */
    public function setUrgente(bool $urgente): self
    {
        $this->urgente = $urgente;

        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getDataHoraInicioPrazo(): ?DateTime
    {
        return $this->dataHoraInicioPrazo;
    }

    /**
     * @param DateTime|null $dataHoraInicioPrazo
     *
     * @return $this
     */
    public function setDataHoraInicioPrazo(?DateTime $dataHoraInicioPrazo): self
    {
        $this->dataHoraInicioPrazo = $dataHoraInicioPrazo;

        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getDataHoraFinalPrazo(): ?DateTime
    {
        return $this->dataHoraFinalPrazo;
    }

    /**
     * @param DateTime|null $dataHoraFinalPrazo
     *
     * @return $this
     */
    public function setDataHoraFinalPrazo(?DateTime $dataHoraFinalPrazo): self
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
     * @return $this
     */
    public function setDataHoraConclusaoPrazo(?DateTime $dataHoraConclusaoPrazo): self
    {
        $this->dataHoraConclusaoPrazo = $dataHoraConclusaoPrazo;

        return $this;
    }

    /**
     * @return EspecieTarefa|null
     */
    public function getEspecieTarefa(): ?EspecieTarefa
    {
        return $this->especieTarefa;
    }

    /**
     * @param EspecieTarefa|null $especieTarefa
     *
     * @return $this
     */
    public function setEspecieTarefa(?EspecieTarefa $especieTarefa): self
    {
        $this->especieTarefa = $especieTarefa;

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
     * @return $this
     */
    public function setUsuarioResponsavel(Usuario $usuarioResponsavel): self
    {
        $this->usuarioResponsavel = $usuarioResponsavel;

        return $this;
    }

    /**
     * @return Setor|null
     */
    public function getSetorResponsavel(): ?Setor
    {
        return $this->setorResponsavel;
    }

    /**
     * @param Setor|null $setorResponsavel
     * @return $this
     */
    public function setSetorResponsavel(?Setor $setorResponsavel): self
    {
        $this->setorResponsavel = $setorResponsavel;

        return $this;
    }

    /**
     * @return Usuario|null
     */
    public function getUsuarioConclusaoPrazo(): ?Usuario
    {
        return $this->usuarioConclusaoPrazo;
    }

    /**
     * @param Usuario|null $usuarioConclusaoPrazo
     *
     * @return $this
     */
    public function setUsuarioConclusaoPrazo(?Usuario $usuarioConclusaoPrazo): self
    {
        $this->usuarioConclusaoPrazo = $usuarioConclusaoPrazo;

        return $this;
    }

    /**
     * @return Setor|null
     */
    public function getSetorOrigem(): ?Setor
    {
        return $this->setorOrigem;
    }

    /**
     * @param Setor|null $setorOrigem
     *
     * @return $this
     */
    public function setSetorOrigem(?Setor $setorOrigem): self
    {
        $this->setorOrigem = $setorOrigem;

        return $this;
    }

    /**
     * @return bool
     */
    public function getRedistribuida(): bool
    {
        return $this->redistribuida;
    }

    /**
     * @param bool $redistribuida
     *
     * @return $this
     */
    public function setRedistribuida(bool $redistribuida): self
    {
        $this->redistribuida = $redistribuida;

        return $this;
    }

    /**
     * @return bool
     */
    public function getDistribuicaoAutomatica(): bool
    {
        return $this->distribuicaoAutomatica;
    }

    /**
     * @param bool $distribuicaoAutomatica
     *
     * @return $this
     */
    public function setDistribuicaoAutomatica(bool $distribuicaoAutomatica): self
    {
        $this->distribuicaoAutomatica = $distribuicaoAutomatica;

        return $this;
    }

    /**
     * @return bool
     */
    public function getLivreBalanceamento(): bool
    {
        return $this->livreBalanceamento;
    }

    /**
     * @param bool $livreBalanceamento
     *
     * @return $this
     */
    public function setLivreBalanceamento(bool $livreBalanceamento): self
    {
        $this->livreBalanceamento = $livreBalanceamento;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAuditoriaDistribuicao(): ?string
    {
        return $this->auditoriaDistribuicao;
    }

    /**
     * @param string|null $auditoriaDistribuicao
     *
     * @return $this
     */
    public function setAuditoriaDistribuicao(?string $auditoriaDistribuicao): self
    {
        $this->auditoriaDistribuicao = $auditoriaDistribuicao;

        return $this;
    }

    /**
     * @return int
     */
    public function getTipoDistribuicao(): int
    {
        return $this->tipoDistribuicao;
    }

    /**
     * @param int $tipoDistribuicao
     *
     * @return $this
     */
    public function setTipoDistribuicao(int $tipoDistribuicao): self
    {
        $this->tipoDistribuicao = $tipoDistribuicao;

        return $this;
    }

    /**
     * @param Atividade $atividade
     *
     * @return $this
     */
    public function addAtividade(Atividade $atividade): self
    {
        if (!$this->atividades->contains($atividade)) {
            $this->atividades[] = $atividade;
            $atividade->setTarefa($this);
        }

        return $this;
    }

    /**
     * @param Atividade $atividade
     *
     * @return $this
     */
    public function removeAtividade(Atividade $atividade): self
    {
        if ($this->atividades->contains($atividade)) {
            $this->atividades->removeElement($atividade);
        }

        return $this;
    }

    /**
     * @return Collection<Atividade>|ArrayCollection<Atividade>
     */
    public function getAtividades(): Collection|ArrayCollection
    {
        return $this->atividades;
    }

    /**
     * @param Compartilhamento $compartilhamento
     *
     * @return $this
     */
    public function addCompartilhamento(Compartilhamento $compartilhamento): self
    {
        if (!$this->compartilhamentos->contains($compartilhamento)) {
            $this->compartilhamentos[] = $compartilhamento;
            $compartilhamento->setTarefa($this);
        }

        return $this;
    }

    /**
     * @param Compartilhamento $compartilhamento
     *
     * @return $this
     */
    public function removeCompartilhamento(Compartilhamento $compartilhamento): self
    {
        if ($this->compartilhamentos->contains($compartilhamento)) {
            $this->compartilhamentos->removeElement($compartilhamento);
        }

        return $this;
    }

    /**
     * @return Collection<Compartilhamento>|ArrayCollection<Compartilhamento>
     */
    public function getCompartilhamentos(): Collection|ArrayCollection
    {
        return $this->compartilhamentos;
    }

    /**
     * @param Documento $minuta
     *
     * @return $this
     */
    public function addMinuta(Documento $minuta): self
    {
        if (!$this->minutas->contains($minuta)) {
            $this->minutas[] = $minuta;
            $minuta->setTarefaOrigem($this);
        }

        return $this;
    }

    /**
     * @param Documento $minuta
     *
     * @return $this
     */
    public function removeMinuta(Documento $minuta): self
    {
        if ($this->minutas->contains($minuta)) {
            $this->minutas->removeElement($minuta);
        }

        return $this;
    }

    /**
     * @return Collection<Documento>|ArrayCollection<Documento>
     */
    public function getMinutas(): Collection|ArrayCollection
    {
        return $this->minutas;
    }

    /**
     * @param DocumentoAvulso $documentoAvulso
     *
     * @return $this
     */
    public function addDocumentoAvulso(DocumentoAvulso $documentoAvulso): self
    {
        if (!$this->documentosAvulsos->contains($documentoAvulso)) {
            $this->documentosAvulsos[] = $documentoAvulso;
            $documentoAvulso->setTarefaOrigem($this);
        }

        return $this;
    }

    /**
     * @param DocumentoAvulso $documentoAvulso
     *
     * @return $this
     */
    public function removeDocumentoAvulso(DocumentoAvulso $documentoAvulso): self
    {
        if ($this->documentosAvulsos->contains($documentoAvulso)) {
            $this->documentosAvulsos->removeElement($documentoAvulso);
        }

        return $this;
    }

    /**
     * @return Collection<DocumentoAvulso>|ArrayCollection<DocumentoAvulso>
     */
    public function getDocumentosAvulsos(): Collection|ArrayCollection
    {
        return $this->documentosAvulsos;
    }

    /**
     * @param Distribuicao $distribuicao
     *
     * @return $this
     */
    public function addDistribuicao(Distribuicao $distribuicao): self
    {
        if (!$this->distribuicoes->contains($distribuicao)) {
            $this->distribuicoes[] = $distribuicao;
            $distribuicao->setTarefa($this);
        }

        return $this;
    }

    /**
     * @param Distribuicao $distribuicao
     *
     * @return $this
     */
    public function removeDistribuicao(Distribuicao $distribuicao): self
    {
        if ($this->distribuicoes->contains($distribuicao)) {
            $this->distribuicoes->removeElement($distribuicao);
        }

        return $this;
    }

    /**
     * @return Collection<Distribuicao>|ArrayCollection<Distribuicao>
     */
    public function getDistribuicoes(): Collection|ArrayCollection
    {
        return $this->distribuicoes;
    }

    /**
     * @param Juntada $juntada
     *
     * @return $this
     */
    public function addJuntada(Juntada $juntada): self
    {
        if (!$this->juntadas->contains($juntada)) {
            $this->juntadas[] = $juntada;
            $juntada->setTarefa($this);
        }

        return $this;
    }

    /**
     * @param Juntada $juntada
     *
     * @return $this
     */
    public function removeJuntada(Juntada $juntada): self
    {
        if ($this->juntadas->contains($juntada)) {
            $this->juntadas->removeElement($juntada);
        }

        return $this;
    }

    /**
     * @return Collection<Juntada>|ArrayCollection<Juntada>
     */
    public function getJuntadas(): Collection|ArrayCollection
    {
        return $this->juntadas;
    }

    /**
     * @return Collection<VinculacaoEtiqueta>|ArrayCollection<VinculacaoEtiqueta>
     */
    public function getVinculacoesEtiquetas(): Collection|ArrayCollection
    {
        return $this->vinculacoesEtiquetas;
    }

    /**
     * @param VinculacaoEtiqueta $vinculacaoEtiqueta
     *
     * @return $this
     */
    public function addVinculacaoEtiqueta(VinculacaoEtiqueta $vinculacaoEtiqueta): self
    {
        if (!$this->vinculacoesEtiquetas->contains($vinculacaoEtiqueta)) {
            $this->vinculacoesEtiquetas->add($vinculacaoEtiqueta);
            $vinculacaoEtiqueta->setTarefa($this);
        }

        return $this;
    }

    /**
     * @param VinculacaoEtiqueta $vinculacaoEtiqueta
     *
     * @return $this
     */
    public function removeVinculacaoEtiqueta(VinculacaoEtiqueta $vinculacaoEtiqueta): self
    {
        if ($this->vinculacoesEtiquetas->contains($vinculacaoEtiqueta)) {
            $this->vinculacoesEtiquetas->removeElement($vinculacaoEtiqueta);
        }

        return $this;
    }

    /**
     * @return Atividade|null
     */
    public function getAtividadeAprovacao(): ?Atividade
    {
        return $this->atividadeAprovacao;
    }

    /**
     * @param Atividade|null $atividadeAprovacao
     *
     * @return $this
     */
    public function setAtividadeAprovacao(?Atividade $atividadeAprovacao): self
    {
        $this->atividadeAprovacao = $atividadeAprovacao;

        $atividadeAprovacao->setTarefaAprovacao($this);

        return $this;
    }

    /**
     * @return VinculacaoWorkflow|null
     */
    public function getVinculacaoWorkflow(): ?VinculacaoWorkflow
    {
        return $this->vinculacaoWorkflow;
    }

    /**
     * @param VinculacaoWorkflow|null $vinculacaoWorkflow
     * @return $this
     */
    public function setVinculacaoWorkflow(?VinculacaoWorkflow $vinculacaoWorkflow): self
    {
        $this->vinculacaoWorkflow = $vinculacaoWorkflow;

        return $this;
    }

}
