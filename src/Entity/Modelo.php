<?php

declare(strict_types=1);
/**
 * /src/Entity/Modelo.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Gedmo\Mapping\Annotation as Gedmo;
use SuppCore\AdministrativoBackend\Doctrine\ORM\Enableable\Enableable;
use SuppCore\AdministrativoBackend\Doctrine\ORM\Immutable\Immutable;
use SuppCore\AdministrativoBackend\Entity\Traits\Ativo;
use SuppCore\AdministrativoBackend\Entity\Traits\Blameable;
use SuppCore\AdministrativoBackend\Entity\Traits\Descricao;
use SuppCore\AdministrativoBackend\Entity\Traits\Id;
use SuppCore\AdministrativoBackend\Entity\Traits\Nome;
use SuppCore\AdministrativoBackend\Entity\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\Entity\Traits\Timestampable;
use SuppCore\AdministrativoBackend\Entity\Traits\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Modelo.
 *
 *  @ORM\Table(
 *     name="ad_modelo"
 * )
 *
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 *
 * @Enableable()
 * @Immutable(fieldName="nome", expression=Immutable::EXPRESSION_IN, expressionValues="env:constantes.entidades.modelo.immutable")
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Modelo implements EntityInterface
{
    // Traits
    use Blameable;
    use Timestampable;
    use Softdeleteable;
    use Ativo;
    use Nome;
    use Descricao;
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
        $this->vinculacoesModelos = new ArrayCollection();
    }

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\OneToOne(
     *     targetEntity="Documento",
     *     inversedBy="modelo"
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
     * @ORM\ManyToOne(targetEntity="Template")
     * @ORM\JoinColumn(
     *     name="template_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?Template $template = null;

    /**
     * @ORM\ManyToOne(targetEntity="ModalidadeModelo")
     * @ORM\JoinColumn(
     *     name="mod_modelo_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected ?ModalidadeModelo $modalidadeModelo = null;

    /**
     * @var Collection|ArrayCollection<VinculacaoModelo>
     *
     * @ORM\OneToMany(
     *     targetEntity="VinculacaoModelo",
     *     mappedBy="modelo"
     * )
     */
    protected $vinculacoesModelos;

    /**
     * @ORM\Column(
     *     type="datetime",
     *     name="data_hora_indexacao",
     *     nullable=true
     * )
     */
    protected ?DateTime $dataHoraIndexacao = null;

    /**
     * Utilizado para exibir o resumo do elasticsearch.
     */
    protected ?string $highlights = null;

    /**
     * Utilizado para permitir a passagem de um contexto especifico de criação de modelos.
     */
    protected ?array $contextoEspecifico = null;

    public function getTemplate(): ?Template
    {
        return $this->template;
    }

    /**
     * @param Template|null $template
     * @return Modelo
     */
    public function setTemplate(?Template $template): self
    {
        $this->template = $template;

        return $this;
    }

    public function setModalidadeModelo(?ModalidadeModelo $modalidadeModelo): self
    {
        $this->modalidadeModelo = $modalidadeModelo;

        return $this;
    }

    public function getModalidadeModelo(): ?ModalidadeModelo
    {
        return $this->modalidadeModelo;
    }

    public function getDocumento(): ?Documento
    {
        return $this->documento;
    }

    /**
     * @param Documento $documento
     * @return Modelo
     */
    public function setDocumento(Documento $documento): self
    {
        $this->documento = $documento;

        return $this;
    }

    public function getDataHoraIndexacao(): ?DateTime
    {
        return $this->dataHoraIndexacao;
    }

    /**
     * @param DateTime|null $dataHoraIndexacao
     * @return Modelo
     */
    public function setDataHoraIndexacao(?DateTime $dataHoraIndexacao): self
    {
        $this->dataHoraIndexacao = $dataHoraIndexacao;

        return $this;
    }

    /**
     * @return Collection|ArrayCollection
     */
    public function getVinculacoesModelos(): Collection
    {
        return $this->vinculacoesModelos;
    }

    /**
     * Method to attach new usuario group to usuario.
     *
     * @noinspection PhpUnused
     */
    public function addVinculacaoModelo(VinculacaoModelo $vinculacaoModelo): Modelo
    {
        if (!$this->vinculacoesModelos->contains($vinculacaoModelo)) {
            $this->vinculacoesModelos->add($vinculacaoModelo);
            $vinculacaoModelo->setModelo($this);
        }

        return $this;
    }

    /** @noinspection PhpUnused */
    public function removeVinculacaoModelo(VinculacaoModelo $vinculacaoModelo): Modelo
    {
        if ($this->vinculacoesModelos->contains($vinculacaoModelo)) {
            $this->vinculacoesModelos->removeElement($vinculacaoModelo);
        }

        return $this;
    }

    /**
     * Set highlights.
     *
     * @param string|null $highlights
     * @return Modelo
     * @noinspection PhpUnused
     */
    public function setHighlights(?string $highlights): self
    {
        $this->highlights = $highlights;

        return $this;
    }

    /**
     * Get highlights.
     */
    public function getHighlights(): ?string
    {
        return $this->highlights;
    }

    public function getContextoEspecifico(): ?array
    {
        return $this->contextoEspecifico;
    }

    public function setContextoEspecifico(?array $contextoEspecifico): self
    {
        $this->contextoEspecifico = $contextoEspecifico;

        return $this;
    }
}
