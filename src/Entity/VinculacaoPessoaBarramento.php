<?php

declare(strict_types=1);

/**
 * /src/Entity/VinculacaoPessoaBarramento.php.
 *
 *
 */

namespace SuppCore\AdministrativoBackend\Entity;

use DMS\Filter\Rules as Filter;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Gedmo\Mapping\Annotation as Gedmo;
use Ramsey\Uuid\Uuid;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\Pessoa;
use SuppCore\AdministrativoBackend\Entity\Traits\Blameable;
use SuppCore\AdministrativoBackend\Entity\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\Entity\Traits\Timestampable;

/**
 * Class VinculacaoPessoaBarramento
 *
 * @ORM\Table(
 *     name="br_vinc_pessoa_barramento",
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(
 *              columns={
 *                  "pessoa_id",
 *                  "repositorio_id",
 *                  "estrutura_id",
 *                  "apagado_em"
 *              }
 *          ),
 *     }
 * )
 * @ORM\Entity()
 *
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 *
 */
class VinculacaoPessoaBarramento implements EntityInterface
{
    // Traits
    use Blameable;
    use Timestampable;
    use Softdeleteable;

    /**
     * @ORM\Column(
     *     name="id",
     *     type="integer",
     *     nullable=false
     * )
     * @ORM\Id()
     * @ORM\GeneratedValue("AUTO")
     */
    protected ?int $id = null;

    /**
     * @ORM\Column(
     *     name="uuid",
     *     type="guid",
     *     nullable=false
     * )
     */
    protected string $uuid;

    /**
     * @ORM\OneToOne(
     *     targetEntity="SuppCore\AdministrativoBackend\Entity\Pessoa",
     *     inversedBy="vinculacaoPessoaBarramento"
     * )
     * @ORM\JoinColumn(
     *     name="pessoa_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected Pessoa $pessoa;

    /**
     * @ORM\Column(
     *     name="repositorio_id",
     *     type="integer",
     *     nullable=false
     * )
     */
    protected int $repositorio;

    /**
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Filter\ToUpper(encoding="UTF-8")
     * @ORM\Column(
     *     type="string",
     *     nullable=true
     * )
     */
    protected ?string $nomeRepositorio = null;

    /**
     * @ORM\Column(
     *     name="estrutura_id",
     *     type="integer",
     *     nullable=false
     * )
     */
    protected int $estrutura;

    /**
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Filter\ToUpper(encoding="UTF-8")
     * @ORM\Column(
     *     type="string",
     *     nullable=true
     * )
     */
    protected ?string $nomeEstrutura = null;

    /**
     * VinculacaoPessoaBarramento constructor.
     *
     * @throws Exception
     */
    public function __construct()
    {
        $this->uuid = Uuid::uuid4()->toString();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     *
     * @return VinculacaoPessoaBarramento
     */
    public function setId(?int $id): VinculacaoPessoaBarramento
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     *
     * @return VinculacaoPessoaBarramento
     */
    public function setUuid(string $uuid): VinculacaoPessoaBarramento
    {
        $this->uuid = $uuid;

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
     * @return VinculacaoPessoaBarramento
     */
    public function setPessoa(Pessoa $pessoa): VinculacaoPessoaBarramento
    {
        $this->pessoa = $pessoa;

        return $this;
    }

    /**
     * @return int
     */
    public function getEstrutura(): int
    {
        return $this->estrutura;
    }

    /**
     * @param int $estrutura
     *
     * @return VinculacaoPessoaBarramento
     */
    public function setEstrutura(int $estrutura): VinculacaoPessoaBarramento
    {
        $this->estrutura = $estrutura;

        return $this;
    }

    /**
     * @return int
     */
    public function getRepositorio(): int
    {
        return $this->repositorio;
    }

    /**
     * @param int $repositorio
     *
     * @return VinculacaoPessoaBarramento
     */
    public function setRepositorio(int $repositorio): VinculacaoPessoaBarramento
    {
        $this->repositorio = $repositorio;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getNomeRepositorio(): ?string
    {
        return $this->nomeRepositorio;
    }

    /**
     * @param string|null $nomeRepositorio
     *
     * @return VinculacaoPessoaBarramento
     */
    public function setNomeRepositorio(?string $nomeRepositorio): VinculacaoPessoaBarramento
    {
        $this->nomeRepositorio = $nomeRepositorio;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getNomeEstrutura(): ?string
    {
        return $this->nomeEstrutura;
    }

    /**
     * @param string|null $nomeEstrutura
     *
     * @return VinculacaoPessoaBarramento
     */
    public function setNomeEstrutura(?string $nomeEstrutura): VinculacaoPessoaBarramento
    {
        $this->nomeEstrutura = $nomeEstrutura;

        return $this;
    }
    
    
}
