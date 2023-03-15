<?php

declare(strict_types=1);
/**
 * /src/Entity/EspecieRelevancia.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Entity;

use Doctrine\ORM\Mapping as ORM;
use Exception;
use Gedmo\Mapping\Annotation as Gedmo;
use SuppCore\AdministrativoBackend\Doctrine\ORM\Enableable\Enableable;
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
 * Class EspecieRelevancia.
 *
 *  @ORM\Table(
 *     name="ad_especie_relevancia",
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(columns={"nome", "genero_relevancia_id", "apagado_em"}),
 *     }
 * )
 *
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 *
 * @UniqueEntity(
 *     fields = {"nome", "generoRelevancia"},
 *     message = "Nome já está em utilização para esse gênero!"
 * )
 *
 * @Enableable()
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class EspecieRelevancia implements EntityInterface
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
     * @ORM\ManyToOne(targetEntity="GeneroRelevancia")
     * @ORM\JoinColumn(
     *     name="genero_relevancia_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?GeneroRelevancia $generoRelevancia = null;

    /**
     * EspecieRelevancia constructor.
     *
     * @throws Exception
     */
    public function __construct()
    {
        $this->setUuid();
    }

    /**
     * @return GeneroRelevancia
     */
    public function getGeneroRelevancia(): GeneroRelevancia
    {
        return $this->generoRelevancia;
    }

    /**
     * @param GeneroRelevancia $generoRelevancia
     *
     * @return EspecieRelevancia
     */
    public function setGeneroRelevancia(GeneroRelevancia $generoRelevancia): self
    {
        $this->generoRelevancia = $generoRelevancia;

        return $this;
    }
}
