<?php

declare(strict_types=1);
/**
 * /src/Entity/Bookmark.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Entity;

use Doctrine\ORM\Mapping as ORM;
use Exception;
use Gedmo\Mapping\Annotation as Gedmo;
use SuppCore\AdministrativoBackend\Entity\Traits\Blameable;
use SuppCore\AdministrativoBackend\Entity\Traits\Id;
use SuppCore\AdministrativoBackend\Entity\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\Entity\Traits\Timestampable;
use SuppCore\AdministrativoBackend\Entity\Traits\Uuid;
use Symfony\Component\Validator\Constraints as Assert;
use DMS\Filter\Rules as Filter;

/**
 * Class Bookmark.
 *
 *  @ORM\Table(
 *     name="ad_bookmark",
 *     indexes={
 *         @ORM\Index(name="usuario_id", columns={"usuario_id"}),
 *         @ORM\Index(name="processo_id", columns={"processo_id"}),
 *         @ORM\Index(name="componente_digital_id", columns={"componente_digital_id"}),
 *     },
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(
 *              columns={
 *                  "usuario_id",
 *                  "processo_id",
 *                  "componente_digital_id",
 *                  "pagina",
 *                  "apagado_em"
 *              }
 *          )
 *      }
 * )
 *
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Bookmark implements EntityInterface
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
     *     targetEntity="Usuario"
     * )
     * @ORM\JoinColumn(
     *     name="usuario_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected Usuario $usuario;

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
     *
     * @ORM\Column(
     *     name="nome",
     *     type="string",
     *     nullable=false
     * )
     */
    protected string $nome = '';

    /**
     * @Assert\Length(
     *     max = 255,
     *     maxMessage = "Campo deve ter no máximo {{ limit }} letras ou números"
     * )
     *
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     *
     * @ORM\Column(
     *     name="descricao",
     *     type="string",
     *     nullable=true
     * )
     */
    protected ?string $descricao = '';

    /**
     * @ORM\Column(
     *     name="pagina",
     *     type="integer",
     *     nullable=false
     * )
     */
    protected int $pagina = 0;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(
     *     targetEntity="ComponenteDigital",
     *     inversedBy="bookmarks"
     * )
     * @ORM\JoinColumn(
     *     name="componente_digital_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected ComponenteDigital $componenteDigital;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(
     *     targetEntity="Processo"
     * )
     * @ORM\JoinColumn(
     *     name="processo_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected ?Processo $processo = null;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(
     *     targetEntity="Juntada"
     * )
     * @ORM\JoinColumn(
     *     name="juntada_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected ?Juntada $juntada = null;

    /**
     * @Assert\Length(
     *     max = 7,
     *     maxMessage = "O campo deve ter no máximo 7 caracteres!"
     * )
     *
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Filter\ToUpper(encoding="UTF-8")
     * @ORM\Column(
     *     name="cor_hexadecimal",
     *     type="string",
     *     nullable=true
     * )
     */
    protected ?string $corHexadecimal = '';

    /**
     * @return Usuario
     */
    public function getUsuario(): Usuario
    {
        return $this->usuario;
    }

    /**
     * @param Usuario $usuario
     *
     * @return $this
     */
    public function setUsuario(Usuario $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * @return string
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     *
     * @return $this
     */
    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    /**
     * @param string $descricao
     *
     * @return $this
     */
    public function setDescricao(?string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * @return int
     */
    public function getPagina(): int
    {
        return $this->pagina;
    }

    /**
     * @param int $pagina
     *
     * @return $this
     */
    public function setPagina(int $pagina): self
    {
        $this->pagina = $pagina;

        return $this;
    }

    /**
     * @return ComponenteDigital
     */
    public function getComponenteDigital(): ComponenteDigital
    {
        return $this->componenteDigital;
    }

    /**
     * @param ComponenteDigital $componenteDigital
     *
     * @return $this
     */
    public function setComponenteDigital(ComponenteDigital $componenteDigital): self
    {
        $this->componenteDigital = $componenteDigital;

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
     * @return $this
     */
    public function setProcesso(Processo $processo): self
    {
        $this->processo = $processo;

        return $this;
    }

    /**
     * @return Juntada
     */
    public function getJuntada(): ?Juntada
    {
        return $this->juntada;
    }

    /**
     * @param Juntada $juntada
     *
     * @return $this
     */
    public function setJuntada(?Juntada $juntada): self
    {
        $this->juntada = $juntada;

        return $this;
    }

    /**
     * @return string
     */
    public function getCorHexadecimal(): ?string
    {
        return $this->corHexadecimal;
    }

    /**
     * @param string $corHexadecimal
     *
     * @return Bookmark
     */
    public function setCorHexadecimal(string $corHexadecimal): self
    {
        $this->corHexadecimal = $corHexadecimal;

        return $this;
    }
}
