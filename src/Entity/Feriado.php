<?php

declare(strict_types=1);
/**
 * /src/Entity/Feriado.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Entity;

use DateTime;
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
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Feriado.
 *
 *  @ORM\Table(
 *     name="ad_feriado"
 * )
 *
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 *
 * @Gedmo\Loggable
 *
 * @Enableable()
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Feriado implements EntityInterface
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
     * @ORM\ManyToOne(targetEntity="Estado")
     * @ORM\JoinColumn(
     *     name="estado_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?Estado $estado = null;

    /**
     * @Gedmo\Versioned
     *
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
     * Todas as notificações devem possuir uma data e hora de expiração.
     *
     * @Assert\NotNull(
     *     message="A data do feriado não pode ser nula!"
     * )
     * @ORM\Column(
     *     type="datetime",
     *     name="data_feriado",
     *     nullable=false
     * )
     */
    protected DateTime $dataFeriado;

    /**
     * @return Estado|null
     */
    public function getEstado(): ?Estado
    {
        return $this->estado;
    }

    /**
     * @param Estado|null $estado
     *
     * @return Feriado
     */
    public function setEstado(?Estado $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * @return Municipio|null
     */
    public function getMunicipio(): Municipio
    {
        return $this->municipio;
    }

    /**
     * @param Municipio|null $municipio
     *
     * @return Feriado
     */
    public function setMunicipio(?Municipio $municipio): self
    {
        $this->municipio = $municipio;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDataFeriado(): DateTime
    {
        return $this->dataFeriado;
    }

    /**
     * @param DateTime $dataFeriado
     *
     * @return Feriado
     */
    public function setDataFeriado(DateTime $dataFeriado): self
    {
        $this->dataFeriado = $dataFeriado;

        return $this;
    }
}
