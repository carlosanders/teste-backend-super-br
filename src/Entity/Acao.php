<?php

declare(strict_types=1);
/**
 * /src/Entity/Acao.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Entity;

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
 * Class Acao.
 *
 *  @ORM\Table(
 *     name="ad_acao",
 * )
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Acao implements EntityInterface
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
     *     targetEntity="Etiqueta",
     *     inversedBy="acoes"
     * )
     * @ORM\JoinColumn(
     *     name="etiqueta_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected Etiqueta $etiqueta;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(
     *     targetEntity="ModalidadeAcaoEtiqueta",
     *     inversedBy="acoes"
     * )
     * @ORM\JoinColumn(
     *     name="mod_acao_etiqueta",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected ModalidadeAcaoEtiqueta $modalidadeAcaoEtiqueta;

    /**
     * @ORM\Column(
     *     type="text",
     *     nullable=true
     * )
     */
    protected ?string $contexto = null;

    /**
     * @return Etiqueta
     */
    public function getEtiqueta(): Etiqueta
    {
        return $this->etiqueta;
    }

    /**
     * @param Etiqueta $etiqueta
     *
     * @return Acao
     */
    public function setEtiqueta(Etiqueta $etiqueta): self
    {
        $this->etiqueta = $etiqueta;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getContexto(): ?string
    {
        return $this->contexto;
    }

    /**
     * @param string|null $contexto
     *
     * @return Acao
     */
    public function setContexto(?string $contexto): self
    {
        $this->contexto = $contexto;

        return $this;
    }

    /**
     * @return ModalidadeAcaoEtiqueta
     */
    public function getModalidadeAcaoEtiqueta(): ModalidadeAcaoEtiqueta
    {
        return $this->modalidadeAcaoEtiqueta;
    }

    /**
     * @param ModalidadeAcaoEtiqueta $modalidadeAcaoEtiqueta
     * @return self
     */
    public function setModalidadeAcaoEtiqueta(ModalidadeAcaoEtiqueta $modalidadeAcaoEtiqueta): self
    {
        $this->modalidadeAcaoEtiqueta = $modalidadeAcaoEtiqueta;

        return $this;
    }

}
