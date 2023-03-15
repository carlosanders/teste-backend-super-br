<?php

declare(strict_types=1);
/**
 * /src/Entity/ConfiguracaoNup.php.
 */

namespace SuppCore\AdministrativoBackend\Entity;

use DateTime;
use DMS\Filter\Rules as Filter;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use SuppCore\AdministrativoBackend\Doctrine\ORM\Enableable\Enableable;
use SuppCore\AdministrativoBackend\Entity\Traits\Ativo;
use SuppCore\AdministrativoBackend\Entity\Traits\Blameable;
use SuppCore\AdministrativoBackend\Entity\Traits\Descricao;
use SuppCore\AdministrativoBackend\Entity\Traits\Id;
use SuppCore\AdministrativoBackend\Entity\Traits\Nome;
use SuppCore\AdministrativoBackend\Entity\Traits\Sigla;
use SuppCore\AdministrativoBackend\Entity\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\Entity\Traits\Timestampable;
use SuppCore\AdministrativoBackend\Entity\Traits\Uuid;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class ConfiguracaoNup.
 *
 *  @ORM\Table(
 *     name="ad_configuracao_nup"
 * )
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @UniqueEntity(
 *     fields = {"nome"},
 *     message = "Nome já está em utilização!"
 * )
 *
 * @Enableable()
 */
class ConfiguracaoNup implements EntityInterface
{
    // Traits
    use Blameable;
    use Timestampable;
    use Softdeleteable;
    use Id;
    use Uuid;
    use Nome;
    use Sigla;
    use Descricao;
    use Ativo;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\Column(
     *     type="datetime",
     *     name="data_hora_inicio_vigencia",
     *     nullable=false
     * )
     */
    protected ?DateTime $dataHoraInicioVigencia = null;

    /**
     * @ORM\Column(
     *     type="datetime",
     *     name="data_hora_fim_vigencia",
     *     nullable=true
     * )
     */
    protected ?DateTime $dataHoraFimVigencia = null;

    /**
     * ConfiguracaoNup constructor.
     *
     * @throws Exception
     */
    public function __construct()
    {
        $this->setUuid();
    }

    /**
     * @return DateTime|null
     */
    public function getDataHoraInicioVigencia(): ?DateTime
    {
        return $this->dataHoraInicioVigencia;
    }

    /**
     * @param DateTime|null $dataHoraInicioVigencia
     */
    public function setDataHoraInicioVigencia(?DateTime $dataHoraInicioVigencia): void
    {
        $this->dataHoraInicioVigencia = $dataHoraInicioVigencia;
    }

    /**
     * @return DateTime|null
     */
    public function getDataHoraFimVigencia(): ?DateTime
    {
        return $this->dataHoraFimVigencia;
    }

    /**
     * @param DateTime|null $dataHoraFimVigencia
     */
    public function setDataHoraFimVigencia(?DateTime $dataHoraFimVigencia): void
    {
        $this->dataHoraFimVigencia = $dataHoraFimVigencia;
    }
}
