<?php

declare(strict_types=1);
/**
 * /src/Entity/ModalidadeRepositorio.php.
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
use SuppCore\AdministrativoBackend\Entity\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\Entity\Traits\Timestampable;
use SuppCore\AdministrativoBackend\Entity\Traits\Uuid;
use SuppCore\AdministrativoBackend\Entity\Traits\Valor;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Class ModalidadeRepositorio.
 *
 *  @ORM\Table(
 *     name="ad_mod_repositorio",
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(columns={"valor", "apagado_em"}),
 *     }
 * )
 *
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 *
 * @UniqueEntity(
 *     fields = {"valor"},
 *     message = "Valor já está em utilização para essa modalidade!"
 * )
 *
 * @Enableable()
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class ModalidadeRepositorio implements EntityInterface
{
    // Traits
    use Blameable;
    use Timestampable;
    use Softdeleteable;
    use Id;
    use Uuid;
    use Valor;
    use Descricao;
    use Ativo;

    /**
     * ModalidadeRepositorio constructor.
     *
     * @throws Exception
     */
    public function __construct()
    {
        $this->setUuid();
    }
}
