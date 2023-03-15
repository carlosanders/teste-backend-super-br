<?php

declare(strict_types=1);
/**
 * /src/Entity/Repositorio.php.
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
use SuppCore\AdministrativoBackend\Doctrine\ORM\Enableable\Enableable;
use SuppCore\AdministrativoBackend\Entity\Traits\Ativo;
use SuppCore\AdministrativoBackend\Entity\Traits\Nome;
use SuppCore\AdministrativoBackend\Entity\Traits\Descricao;
use SuppCore\AdministrativoBackend\Entity\Traits\Blameable;
use SuppCore\AdministrativoBackend\Entity\Traits\Id;
use SuppCore\AdministrativoBackend\Entity\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\Entity\Traits\Timestampable;
use SuppCore\AdministrativoBackend\Entity\Traits\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Repositorio.
 *
 *  @ORM\Table(
 *     name="ad_repositorio"
 * )
 *
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @Enableable()
 */
class Repositorio implements EntityInterface
{
    // Traits
    use Blameable;
    use Timestampable;
    use Softdeleteable;
    use Nome;
    use Descricao;
    use Ativo;
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
        $this->vinculacoesRepositorios = new ArrayCollection();
    }

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\OneToOne(
     *     targetEntity="Documento",
     *     inversedBy="repositorio"
     * )
     * @ORM\JoinColumn(
     *     name="documento_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected Documento $documento;

    /**
     * @Assert\NotNull(
     *     message="Campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(targetEntity="ModalidadeRepositorio")
     * @ORM\JoinColumn(
     *     name="mod_repositorio_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected ?ModalidadeRepositorio $modalidadeRepositorio = null;

    /**
     * @var Collection|ArrayCollection|ArrayCollection<VinculacaoRepositorio>
     *
     * @ORM\OneToMany(
     *     targetEntity="VinculacaoRepositorio",
     *     mappedBy="repositorio"
     * )
     */
    protected $vinculacoesRepositorios;

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
     * @param ModalidadeRepositorio $modalidadeRepositorio
     *
     * @return Repositorio
     */
    public function setModalidadeRepositorio(?ModalidadeRepositorio $modalidadeRepositorio): self
    {
        $this->modalidadeRepositorio = $modalidadeRepositorio;

        return $this;
    }

    /**
     * @return ModalidadeRepositorio
     */
    public function getModalidadeRepositorio(): ?ModalidadeRepositorio
    {
        return $this->modalidadeRepositorio;
    }

    /**
     * @return Documento
     */
    public function getDocumento(): Documento
    {
        return $this->documento;
    }

    /**
     * @param Documento $documento
     *
     * @return Repositorio
     */
    public function setDocumento(Documento $documento): self
    {
        $this->documento = $documento;

        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getDataHoraIndexacao(): ?DateTime
    {
        return $this->dataHoraIndexacao;
    }

    /**
     * @param DateTime|null $dataHoraIndexacao
     *
     * @return Repositorio
     */
    public function setDataHoraIndexacao(?DateTime $dataHoraIndexacao): self
    {
        $this->dataHoraIndexacao = $dataHoraIndexacao;

        return $this;
    }

    /**
     * @return Collection|ArrayCollection|ArrayCollection<VinculacaoRepositorio>
     */
    public function getVinculacoesRepositorios(): Collection
    {
        return $this->vinculacoesRepositorios;
    }

    /**
     * Method to attach new usuario group to usuario.
     *
     * @param VinculacaoRepositorio $vinculacaoRepositorio
     *
     * @return Repositorio
     */
    public function addVinculacaoRepositorio(VinculacaoRepositorio $vinculacaoRepositorio): Repositorio
    {
        if (!$this->vinculacoesRepositorios->contains($vinculacaoRepositorio)) {
            $this->vinculacoesRepositorios->add($vinculacaoRepositorio);
            $vinculacaoRepositorio->setRepositorio($this);
        }

        return $this;
    }

    /**
     * @param VinculacaoRepositorio $vinculacaoRepositorio
     *
     * @return Repositorio
     */
    public function removeVinculacaoRepositorio(VinculacaoRepositorio $vinculacaoRepositorio): Repositorio
    {
        if ($this->vinculacoesRepositorios->contains($vinculacaoRepositorio)) {
            $this->vinculacoesRepositorios->removeElement($vinculacaoRepositorio);
        }

        return $this;
    }

    /**
     * Set highlights.
     *
     * @param string|null $highlights
     *
     * @return Repositorio
     */
    public function setHighlights(?string $highlights): self
    {
        $this->highlights = $highlights;

        return $this;
    }

    /**
     * Get highlights.
     *
     * @return string|null
     */
    public function getHighlights(): ?string
    {
        return $this->highlights;
    }
}
