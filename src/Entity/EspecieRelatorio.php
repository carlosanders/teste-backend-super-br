<?php

declare(strict_types=1);
/**
 * /src/Entity/EspecieRelatorio.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Entity;

use Doctrine\ORM\Mapping as ORM;
use Exception;
use Gedmo\Mapping\Annotation as Gedmo;
use SuppCore\AdministrativoBackend\Entity\Traits\Ativo;
use SuppCore\AdministrativoBackend\Entity\Traits\Blameable;
use SuppCore\AdministrativoBackend\Entity\Traits\Descricao;
use SuppCore\AdministrativoBackend\Entity\Traits\Id;
use SuppCore\AdministrativoBackend\Entity\Traits\Nome;
use SuppCore\AdministrativoBackend\Entity\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\Entity\Traits\Timestampable;
use SuppCore\AdministrativoBackend\Entity\Traits\Uuid;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use SuppCore\AdministrativoBackend\Doctrine\ORM\Enableable\Enableable;

/**
 * Class EspecieRelatorio.
 *
 *  @ORM\Table(
 *     name="ad_especie_relatorio",
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(columns={"nome", "genero_relatorio_id", "apagado_em"}),
 *     }
 * )
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @UniqueEntity(
 *     fields = {"nome", "generoRelatorio"},
 *     message = "Nome já está em utilização para esse gênero!"
 * )
 *
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 *
 * @Enableable()
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class EspecieRelatorio implements EntityInterface
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
     * Constructor.
     *
     * @throws Exception
     */
    public function __construct()
    {
        $this->setUuid();
    }

    /**
     * @ORM\ManyToOne(
     *     targetEntity="GeneroRelatorio"
     * )
     * @ORM\JoinColumn(
     *     name="genero_relatorio_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected ?GeneroRelatorio $generoRelatorio = null;

    /**
     * @return GeneroRelatorio
     */
    public function getGeneroRelatorio(): ?GeneroRelatorio
    {
        return $this->generoRelatorio;
    }

    /**
     * @param GeneroRelatorio $generoRelatorio
     *
     * @return EspecieRelatorio
     */
    public function setGeneroRelatorio(GeneroRelatorio $generoRelatorio): self
    {
        $this->generoRelatorio = $generoRelatorio;

        return $this;
    }
}
