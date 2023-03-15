<?php

declare(strict_types=1);
/**
 * /src/Entity/Avaliacao.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Entity;

use DateTime;
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
 * Class Avaliacao.
 *
 * @ORM\Table(
 *     name="ad_avaliacao"
 * )
 *
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 *
 * @Gedmo\Loggable
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Avaliacao implements EntityInterface
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
     * @ORM\ManyToOne(
     *     targetEntity="ObjetoAvaliado"
     * )
     *
     * @ORM\JoinColumn(
     *     name="objeto_avaliado_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected ObjetoAvaliado $objetoAvaliado;

    /**
     * @Assert\NotBlank(
     *     message="O campo não pode estar em branco!"
     * )
     *
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\Column(
     *     type="integer",
     *     nullable=false
     * )
     */
    protected int $avaliacao;

    /**
     * @return ObjetoAvaliado
     */
    public function getObjetoAvaliado(): ObjetoAvaliado
    {
        return $this->objetoAvaliado;
    }

    /**
     * @param ObjetoAvaliado $objetoAvaliado
     */
    public function setObjetoAvaliado(ObjetoAvaliado $objetoAvaliado): void
    {
        $this->objetoAvaliado = $objetoAvaliado;
    }

    /**
     * @return int
     */
    public function getAvaliacao(): int
    {
        return $this->avaliacao;
    }

    /**
     * @param int $avaliacao
     */
    public function setAvaliacao(int $avaliacao): void
    {
        $this->avaliacao = $avaliacao;
    }
}
