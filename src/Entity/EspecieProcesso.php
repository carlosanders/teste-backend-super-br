<?php

declare(strict_types=1);
/**
 * /src/Entity/EspecieProcesso.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Entity;

use DMS\Filter\Rules as Filter;
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
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class EspecieProcesso.
 *
 *  @ORM\Table(
 *     name="ad_especie_processo",
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(columns={"nome", "genero_processo_id", "apagado_em"}),
 *     }
 * )
 *
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 *
 * @UniqueEntity(
 *     fields = {"nome", "generoProcesso"},
 *     message = "Nome já está em utilização para esse gênero!"
 * )
 *
 * @Enableable()
 * @Immutable(fieldName="nome", expression=Immutable::EXPRESSION_IN, expressionValues="env:constantes.entidades.especie_processo.immutable")
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class EspecieProcesso implements EntityInterface
{
    // Traits
    use Blameable;
    use Timestampable;
    use Softdeleteable;
    use Id;
    use Uuid;
    use Nome;
    use Descricao;
    use Ativo;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(targetEntity="GeneroProcesso")
     * @ORM\JoinColumn(
     *     name="genero_processo_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?GeneroProcesso $generoProcesso = null;

    /**
     * @ORM\OneToMany(
     *     targetEntity="VinculacaoEspecieProcessoWorkflow",
     *     mappedBy="especieProcesso",
     *     cascade={"all"}
     * )
     * @var Collection<VinculacaoEspecieProcessoWorkflow>|ArrayCollection<VinculacaoEspecieProcessoWorkflow>
     */
    protected ArrayCollection|Collection $vinculacoesEspecieProcessoWorkflow;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="Classificacao"
     * )
     * @ORM\JoinColumn(
     *     name="classificacao_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?Classificacao $classificacao = null;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="ModalidadeMeio"
     * )
     * @ORM\JoinColumn(
     *     name="mod_meio_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?ModalidadeMeio $modalidadeMeio = null;

    /**
     * @Assert\Length(
     *     max = 255,
     *     maxMessage = "O campo deve ter no máximo 255 caracteres!"
     * )
     *
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Filter\ToUpper(encoding="UTF-8")
     *
     * @ORM\Column(
     *     type="string",
     *     nullable=true
     * )
     */
    protected ?string $titulo = null;

    /**
     * EspecieProcesso constructor.
     *
     * @throws Exception
     */
    public function __construct()
    {
        $this->setUuid();
        $this->vinculacoesEspecieProcessoWorkflow = new ArrayCollection();
    }

    /**
     * @return GeneroProcesso
     */
    public function getGeneroProcesso(): GeneroProcesso
    {
        return $this->generoProcesso;
    }

    /**
     * @param GeneroProcesso $generoProcesso
     *
     * @return EspecieProcesso
     */
    public function setGeneroProcesso(GeneroProcesso $generoProcesso): self
    {
        $this->generoProcesso = $generoProcesso;

        return $this;
    }

    /**
     * @return Classificacao|null
     */
    public function getClassificacao(): ?Classificacao
    {
        return $this->classificacao;
    }

    /**
     * @param Classificacao|null $classificacao
     *
     * @return EspecieProcesso
     */
    public function setClassificacao(?Classificacao $classificacao): EspecieProcesso
    {
        $this->classificacao = $classificacao;

        return $this;
    }

    /**
     * @return ModalidadeMeio|null
     */
    public function getModalidadeMeio(): ?ModalidadeMeio
    {
        return $this->modalidadeMeio;
    }

    /**
     * @param ModalidadeMeio|null $modalidadeMeio
     *
     * @return EspecieProcesso
     */
    public function setModalidadeMeio(?ModalidadeMeio $modalidadeMeio): EspecieProcesso
    {
        $this->modalidadeMeio = $modalidadeMeio;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    /**
     * @param string|null $titulo
     *
     * @return EspecieProcesso
     */
    public function setTitulo(?string $titulo): EspecieProcesso
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * @return Collection|ArrayCollection<VinculacaoEspecieProcessoWorkflow>
     */
    public function getVinculacoesEspecieProcessoWorkflow(): ArrayCollection|Collection
    {
        return $this->vinculacoesEspecieProcessoWorkflow;
    }

    /**
     * @param VinculacaoEspecieProcessoWorkflow $vinculacaoEspecieProcessoWorkflow
     * @return EspecieProcesso
     */
    public function addVinculacaoEspecieProcessoWorkflow(
        VinculacaoEspecieProcessoWorkflow $vinculacaoEspecieProcessoWorkflow
    ): self
    {
        if (!$this->vinculacoesEspecieProcessoWorkflow->contains($vinculacaoEspecieProcessoWorkflow)) {
            $this->vinculacoesEspecieProcessoWorkflow->add($vinculacaoEspecieProcessoWorkflow);
            $vinculacaoEspecieProcessoWorkflow->setEspecieProcesso($this);
        }

        return $this;
    }

    /**
     * @param VinculacaoEspecieProcessoWorkflow $vinculacaoEspecieProcessoWorkflow
     * @return EspecieProcesso
     */
    public function removeVinculacaoEspecieProcessoWorkflow(
        VinculacaoEspecieProcessoWorkflow $vinculacaoEspecieProcessoWorkflow
    ): self
    {
        if ($this->vinculacoesEspecieProcessoWorkflow->contains($vinculacaoEspecieProcessoWorkflow)) {
            $this->vinculacoesEspecieProcessoWorkflow->removeElement($vinculacaoEspecieProcessoWorkflow);
        }

        return $this;
    }

}
