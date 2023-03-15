<?php

declare(strict_types=1);
/**
 * /src/Entity/Transicao.php.
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
use SuppCore\AdministrativoBackend\Entity\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\Entity\Traits\Timestampable;
use SuppCore\AdministrativoBackend\Entity\Traits\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Transicao.
 *
 *  @ORM\Table(
 *     name="ad_transicao",
 * )
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Transicao implements EntityInterface
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
    }

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(
     *     targetEntity="ModalidadeTransicao"
     * )
     * @ORM\JoinColumn(
     *     name="mod_transicao_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected ModalidadeTransicao $modalidadeTransicao;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(
     *     targetEntity="Processo",
     *     inversedBy="transicoes"
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
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Filter\ToUpper(encoding="UTF-8")
     *
     * @Assert\NotBlank(
     *     message="O campo não pode estar em branco!"
     * )
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     * @Assert\Length(
     *     max = 255,
     *     maxMessage = "O campo deve ter no máximo 255 caracteres!"
     * )
     * @ORM\Column(
     *     type="string",
     *     nullable=false
     * )
     */
    protected ?string $metodo = null;

    /**
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Filter\ToUpper(encoding="UTF-8")
     *
     * @Assert\Length(
     *     max = 255,
     *     maxMessage = "O campo deve ter no máximo 255 caracteres!"
     * )
     * @ORM\Column(
     *     type="string",
     *     nullable=true
     * )
     */
    protected ?string $edital = null;

    protected ?bool $acessoNegado = false;

    /**
     * @return ModalidadeTransicao
     */
    public function getModalidadeTransicao(): ModalidadeTransicao
    {
        return $this->modalidadeTransicao;
    }

    /**
     * @param ModalidadeTransicao $modalidadeTransicao
     *
     * @return Transicao
     */
    public function setModalidadeTransicao(ModalidadeTransicao $modalidadeTransicao): self
    {
        $this->modalidadeTransicao = $modalidadeTransicao;

        return $this;
    }

    /**
     * @return Processo
     */
    public function getProcesso(): ?Processo
    {
        return $this->processo;
    }

    /**
     * @param Processo $processo
     *
     * @return Transicao
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
     * @return Transicao
     */
    public function setObservacao(?string $observacao): self
    {
        $this->observacao = $observacao;

        return $this;
    }

    /**
     * @return string
     */
    public function getMetodo(): ?string
    {
        return $this->metodo;
    }

    /**
     * @param string $metodo
     *
     * @return Transicao
     */
    public function setMetodo(?string $metodo): self
    {
        $this->metodo = $metodo;

        return $this;
    }

    /**
     * @return string
     */
    public function getEdital(): ?string
    {
        return $this->edital;
    }

    /**
     * @param string $edital
     *
     * @return Transicao
     */
    public function setEdital(?string $edital): self
    {
        $this->edital = $edital;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getAcessoNegado(): ?bool
    {
        return $this->acessoNegado;
    }

    /**
     * @param bool|null $acessoNegado
     *
     * @return self
     */
    public function setAcessoNegado(?bool $acessoNegado): self
    {
        $this->acessoNegado = $acessoNegado;

        return $this;
    }
}
