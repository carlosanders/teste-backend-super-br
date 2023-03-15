<?php

declare(strict_types=1);
/**
 * /src/Entity/Estado.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Entity;

use DMS\Filter\Rules as Filter;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Gedmo\Mapping\Annotation as Gedmo;
use SuppCore\AdministrativoBackend\Doctrine\ORM\Enableable\Enableable;
use SuppCore\AdministrativoBackend\Entity\Traits\Ativo;
use SuppCore\AdministrativoBackend\Entity\Traits\Blameable;
use SuppCore\AdministrativoBackend\Entity\Traits\Id;
use SuppCore\AdministrativoBackend\Entity\Traits\Nome;
use SuppCore\AdministrativoBackend\Entity\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\Entity\Traits\Timestampable;
use SuppCore\AdministrativoBackend\Entity\Traits\Uuid;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Estado.
 *
 *  @ORM\Table(
 *     name="ad_estado",
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(columns={"nome","apagado_em"}),
 *     }
 * )
 *
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 *
 * @UniqueEntity(
 *     fields = {"nome","apagadoEm"},
 *     message = "Nome já está em utilização!"
 * )
 * @Enableable()
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Estado implements EntityInterface
{
    // Traits
    use Blameable;
    use Timestampable;
    use Softdeleteable;
    use Id;
    use Uuid;
    use Nome;
    use Ativo;

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
     *     min = 2,
     *     exactMessage="O campo deve ter caracteres!",
     *     max = 2
     * )
     * @ORM\Column(
     *     type="string",
     *     nullable=false
     * )
     */
    protected string $uf;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(targetEntity="Pais")
     * @ORM\JoinColumn(
     *     name="pais_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected Pais $pais;

    /**
     * Set uf.
     *
     * @param string $uf
     *
     * @return self
     */
    public function setUf(string $uf): self
    {
        $this->uf = $uf;

        return $this;
    }

    /**
     * Get uf.
     *
     * @return string
     */
    public function getUf(): string
    {
        return $this->uf;
    }

    /**
     * @return Pais
     */
    public function getPais(): Pais
    {
        return $this->pais;
    }

    /**
     * @param Pais $pais
     *
     * @return Estado
     */
    public function setPais(Pais $pais): self
    {
        $this->pais = $pais;

        return $this;
    }
}
