<?php

declare(strict_types=1);
/**
 * /src/Entity/Representante.php.
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
use SuppCore\AdministrativoBackend\Entity\Traits\Nome;
use SuppCore\AdministrativoBackend\Entity\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\Entity\Traits\Timestampable;
use SuppCore\AdministrativoBackend\Entity\Traits\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Representante.
 *
 *  @ORM\Table(
 *     name="ad_representante",
 * )
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 * @Gedmo\Loggable
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Representante implements EntityInterface
{
    // Traits
    use Blameable;
    use Timestampable;
    use Softdeleteable;
    use Nome;
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
     * @Assert\Regex(
     *     pattern="/[A-Z]{2}\d{7}[A-Z]{1}/",
     *     message="Formato deve ser CCDDDDDDDC, sendo os primeiros C a UF, os D seguintes o número da inscrição, devendo incluir zeros (0) à esquerda e o último C a letra identificadora do tipo de inscrição"
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
    protected ?string $inscricao = null;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(
     *     targetEntity="ModalidadeRepresentante"
     * )
     * @ORM\JoinColumn(
     *     name="mod_representante_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected ModalidadeRepresentante $modalidadeRepresentante;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(
     *     targetEntity="Interessado",
     *     inversedBy="representantes"
     * )
     * @ORM\JoinColumn(
     *     name="interessado_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected Interessado $interessado;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="OrigemDados",
     *     cascade={"persist"}
     * )
     * @ORM\JoinColumn(
     *     name="origem_dados_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?OrigemDados $origemDados = null;

    /**
     * @return string|null
     */
    public function getInscricao(): ?string
    {
        return $this->inscricao;
    }

    /**
     * @param string|null $inscricao
     *
     * @return Representante
     */
    public function setInscricao(?string $inscricao): self
    {
        $this->inscricao = $inscricao;

        return $this;
    }

    /**
     * @return ModalidadeRepresentante
     */
    public function getModalidadeRepresentante(): ModalidadeRepresentante
    {
        return $this->modalidadeRepresentante;
    }

    /**
     * @param ModalidadeRepresentante $modalidadeRepresentante
     *
     * @return Representante
     */
    public function setModalidadeRepresentante(ModalidadeRepresentante $modalidadeRepresentante): self
    {
        $this->modalidadeRepresentante = $modalidadeRepresentante;

        return $this;
    }

    /**
     * @return Interessado
     */
    public function getInteressado(): Interessado
    {
        return $this->interessado;
    }

    /**
     * @param Interessado $interessado
     *
     * @return Representante
     */
    public function setInteressado(Interessado $interessado): self
    {
        $this->interessado = $interessado;

        return $this;
    }

    /**
     * @return OrigemDados|null
     */
    public function getOrigemDados(): ?OrigemDados
    {
        return $this->origemDados;
    }

    /**
     * @param OrigemDados|null $origemDados
     *
     * @return Representante
     */
    public function setOrigemDados(?OrigemDados $origemDados): self
    {
        $this->origemDados = $origemDados;

        return $this;
    }
}
