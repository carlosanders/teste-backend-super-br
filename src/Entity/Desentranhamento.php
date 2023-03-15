<?php

declare(strict_types=1);
/**
 * /src/Entity/Desentranhamento.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Entity;

use DMS\Filter\Rules as Filter;
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
 * Class Desentranhamento.
 *
 *  @ORM\Table(
 *     name="ad_desentranhamento",
 * )
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Desentranhamento implements EntityInterface
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
     *     targetEntity="Juntada"
     * )
     * @ORM\JoinColumn(
     *     name="processo_juntada_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected Juntada $juntada;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(
     *     targetEntity="Processo"
     * )
     * @ORM\JoinColumn(
     *     name="processo_destino_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected Processo $processoDestino;

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
     * @ORM\Column(
     *     type="string",
     *     nullable=true
     * )
     */
    protected ?string $observacao = null;

    /**
     * @return Juntada
     */
    public function getJuntada(): Juntada
    {
        return $this->juntada;
    }

    /**
     * @param Juntada $juntada
     *
     * @return Desentranhamento
     */
    public function setJuntada(Juntada $juntada): self
    {
        $this->juntada = $juntada;

        return $this;
    }

    /**
     * @return Processo
     */
    public function getProcessoDestino(): Processo
    {
        return $this->processoDestino;
    }

    /**
     * @param Processo $processoDestino
     *
     * @return Desentranhamento
     */
    public function setProcessoDestino(Processo $processoDestino): self
    {
        $this->processoDestino = $processoDestino;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getObservacao(): ?string
    {
        return $this->observacao;
    }

    /**
     * @param string|null $observacao
     *
     * @return Desentranhamento
     */
    public function setObservacao(?string $observacao): self
    {
        $this->observacao = $observacao;

        return $this;
    }
}
