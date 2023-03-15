<?php

declare(strict_types=1);
/**
 * /src/Entity/Interessado.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Entity;

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
 * Class Interessado.
 *
 *  @ORM\Table(
 *     name="ad_interessado",
 * )
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Interessado implements EntityInterface
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
        $this->representantes = new ArrayCollection();
    }

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(
     *     targetEntity="Processo",
     *     inversedBy="interessados"
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
     *     message="Campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(
     *     targetEntity="ModalidadeInteressado"
     * )
     * @ORM\JoinColumn(
     *     name="mod_interessado_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected ModalidadeInteressado $modalidadeInteressado;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(
     *     targetEntity="Pessoa",
     *     inversedBy="interessados"
     *
     * )
     * @ORM\JoinColumn(
     *     name="pessoa_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected Pessoa $pessoa;

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
     * @var Collection|ArrayCollection|ArrayCollection<Representante>
     *
     * @ORM\OneToMany(
     *     targetEntity="Representante",
     *     mappedBy="interessado",
     *     cascade={"all"}
     * )
     */
    protected $representantes;

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
     * @return Interessado
     */
    public function setProcesso(Processo $processo): self
    {
        $this->processo = $processo;

        return $this;
    }

    /**
     * @return ModalidadeInteressado
     */
    public function getModalidadeInteressado(): ModalidadeInteressado
    {
        return $this->modalidadeInteressado;
    }

    /**
     * @param ModalidadeInteressado $modalidadeInteressado
     *
     * @return Interessado
     */
    public function setModalidadeInteressado(ModalidadeInteressado $modalidadeInteressado): self
    {
        $this->modalidadeInteressado = $modalidadeInteressado;

        return $this;
    }

    /**
     * @return Pessoa
     */
    public function getPessoa(): Pessoa
    {
        return $this->pessoa;
    }

    /**
     * @param Pessoa $pessoa
     *
     * @return Interessado
     */
    public function setPessoa(Pessoa $pessoa): self
    {
        $this->pessoa = $pessoa;

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
     * @return Interessado
     */
    public function setOrigemDados(?OrigemDados $origemDados): self
    {
        $this->origemDados = $origemDados;

        return $this;
    }

    /**
     * @param Representante $representante
     *
     * @return Interessado
     */
    public function addRepresentante(Representante $representante): self
    {
        if (!$this->representantes->contains($representante)) {
            $this->representantes[] = $representante;
            $representante->setInteressado($this);
        }

        return $this;
    }

    /**
     * @param Representante $representante
     *
     * @return Interessado
     */
    public function removeRepresentante(Representante $representante): self
    {
        if ($this->representantes->contains($representante)) {
            $this->representantes->removeElement($representante);
        }

        return $this;
    }

    /**
     * @return Collection|ArrayCollection|ArrayCollection<Representante>
     */
    public function getRepresentantes(): Collection
    {
        return $this->representantes;
    }
}
