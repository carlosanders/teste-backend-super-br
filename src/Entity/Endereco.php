<?php

declare(strict_types=1);
/**
 * /src/Entity/Endereco.php.
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
 * Class Endereco.
 *
 *  @ORM\Table(
 *     name="ad_endereco",
 * )
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Endereco implements EntityInterface
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
    protected ?string $bairro = null;

    /**
     * @Assert\Length(
     *     max = 8,
     *     maxMessage = "Campo deve ter no máximo {{ limit }} letras ou números"
     * )
     * @Assert\Regex(
     *     pattern="/\d{8}/",
     *     message="CEP Inválido!"
     * )
     *
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Filter\Digits()
     * @ORM\Column(
     *     type="string",
     *     nullable=true
     * )
     */
    protected ?string $cep = null;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="Municipio"
     * )
     * @ORM\JoinColumn(
     *     name="municipio_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?Municipio $municipio = null;

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
    protected ?string $complemento = null;

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
    protected ?string $logradouro = null;

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
    protected ?string $numero = null;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="Pais"
     * )
     * @ORM\JoinColumn(
     *     name="pais_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?Pais $pais = null;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     * @ORM\Column(
     *     type="boolean",
     *     nullable=false
     * )
     */
    protected bool $principal = true;

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
     *
     * @ORM\ManyToOne(
     *     targetEntity="Pessoa",
     *     inversedBy="enderecos"
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
     * @return string|null
     */
    public function getBairro(): ?string
    {
        return $this->bairro;
    }

    /**
     * @param string|null $bairro
     *
     * @return Endereco
     */
    public function setBairro(?string $bairro): self
    {
        $this->bairro = $bairro;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCep(): ?string
    {
        return $this->cep;
    }

    /**
     * @param string|null $cep
     *
     * @return Endereco
     */
    public function setCep(?string $cep): self
    {
        $this->cep = $cep;

        return $this;
    }

    /**
     * @return Municipio|null
     */
    public function getMunicipio(): ?Municipio
    {
        return $this->municipio;
    }

    /**
     * @param Municipio|null $municipio
     *
     * @return Endereco
     */
    public function setMunicipio(?Municipio $municipio): self
    {
        $this->municipio = $municipio;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getComplemento(): ?string
    {
        return $this->complemento;
    }

    /**
     * @param string|null $complemento
     *
     * @return Endereco
     */
    public function setComplemento(?string $complemento): self
    {
        $this->complemento = $complemento;

        return $this;
    }

    /**
     * @return string|null
     */

    /**
     * @return string|null
     */
    public function getLogradouro(): ?string
    {
        return $this->logradouro;
    }

    /**
     * @param string|null $logradouro
     *
     * @return Endereco
     */
    public function setLogradouro(?string $logradouro): self
    {
        $this->logradouro = $logradouro;

        return $this;
    }

    /**
     * @return string|null
     */

    /**
     * @return string|null
     */
    public function getNumero(): ?string
    {
        return $this->numero;
    }

    /**
     * @param string|null $numero
     *
     * @return Endereco
     */
    public function setNumero(?string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * @return Pais|null
     */
    public function getPais(): ?Pais
    {
        return $this->pais;
    }

    /**
     * @param Pais|null $pais
     *
     * @return Endereco
     */
    public function setPais(?Pais $pais): self
    {
        $this->pais = $pais;

        return $this;
    }

    /**
     * @return bool
     */
    public function getPrincipal(): bool
    {
        return $this->principal;
    }

    /**
     * @param bool $principal
     *
     * @return Endereco
     */
    public function setPrincipal(bool $principal): self
    {
        $this->principal = $principal;

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
     * @return Endereco
     */
    public function setObservacao(?string $observacao): self
    {
        $this->observacao = $observacao;

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
     * @return Endereco
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
     * @return Endereco
     */
    public function setOrigemDados(?OrigemDados $origemDados): self
    {
        $this->origemDados = $origemDados;

        return $this;
    }

    /**
     * @return string
     */
    public function getEnderecoFormatadoHTML()
    {
        $html = '';
        if ($this->getLogradouro() || $this->getNumero() || $this->getComplemento()) {
            $html .= '<p class="esquerda">';
        }
        if ($this->getLogradouro()) {
            $html .= $this->getLogradouro();
        }
        if ($this->getNumero()) {
            $html .= ', '.$this->getNumero();
        }
        if ($this->getComplemento()) {
            $html .= ', '.$this->getComplemento();
        }
        if ($this->getLogradouro() || $this->getNumero() || $this->getComplemento()) {
            $html .= '</p>';
        }
        if ($this->getBairro()) {
            $html .= '<p class="esquerda">'.$this->getBairro().'</p>';
        }
        if ($this->getMunicipio()) {
            $html .= '<p class="esquerda">'.$this->getMunicipio()->getNome().' - '.$this->getMunicipio()->getEstado()->getUf().'</p>';
        }
        if ($this->getCep()) {
            $html .= '<p class="esquerda">'.$this->getCep().'</p>';
        }

        return $html;
    }
}
