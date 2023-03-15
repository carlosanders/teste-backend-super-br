<?php
/** @noinspection PhpUnused */
declare(strict_types=1);
/**
 * /src/Entity/Modulo.php
 *
 * @author  Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Entity;

use Exception;
use SuppCore\AdministrativoBackend\Entity\Traits\Descricao;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Entity\Traits\Ativo;
use SuppCore\AdministrativoBackend\Entity\Traits\Blameable;
use SuppCore\AdministrativoBackend\Entity\Traits\Id;
use SuppCore\AdministrativoBackend\Entity\Traits\Nome;
use SuppCore\AdministrativoBackend\Entity\Traits\Sigla;
use SuppCore\AdministrativoBackend\Entity\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\Entity\Traits\Timestampable;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use DMS\Filter\Rules as Filter;
use SuppCore\AdministrativoBackend\Entity\Traits\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Modulo
 *
 * @ORM\Table(
 *     name="ad_modulo",
 *     indexes={
 *          @ORM\Index(columns={"apagado_em", "id"})
 *      }
 * )
* @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 *
 * @package SuppCore\AdministrativoBackend\Entity
 * @author  Advocacia-Geral da União <supp@agu.gov.br>
 */
class Modulo implements EntityInterface
{
    // Traits
    use Blameable;
    use Timestampable;
    use Softdeleteable;

    use Id;
    use Uuid;
    use Nome;
    use Descricao;
    use Sigla;
    use Ativo;

    /**
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Filter\ToLower(encoding="UTF-8")
     *
     * @Assert\NotBlank(
     *     message="O campo não pode estar em branco!"
     * )
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     * @ORM\Column(
     *     type="string",
     *     nullable=false
     * )
     */
    protected string $prefixo;
    
    /**
     * Modulo constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $this->setUuid();
    }

    /**
     * @return string
     */
    public function getPrefixo(): string
    {
        return $this->prefixo;
    }

    /**
     * @param string $prefixo
     * @return self
     */
    public function setPrefixo(string $prefixo): self
    {
        $this->prefixo = $prefixo;

        return $this;
    }
}
