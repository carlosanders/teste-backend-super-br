<?php

declare(strict_types=1);
/**
 * /src/Entity/VinculacaoAviso.php.
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
 * Class VinculacaoAviso.
 *
 *  @ORM\Table(
 *     name="ad_vinc_aviso",
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(
 *              columns={
 *                  "aviso_id",
 *                  "orgao_central_id",
 *                  "especie_setor_id",
 *                  "apagado_em",
 *                  "usuario_id",
 *                  "setor_id"
 *              }
 *          ),
 *     }
 * )
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class VinculacaoAviso implements EntityInterface
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
     *     targetEntity="Aviso",
     *     inversedBy="vinculacoesAvisos"
     * )
     * @ORM\JoinColumn(
     *     name="aviso_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected Aviso $aviso;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="EspecieSetor"
     * )
     * @ORM\JoinColumn(
     *     name="especie_setor_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?EspecieSetor $especieSetor = null;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="Setor"
     * )
     * @ORM\JoinColumn(
     *     name="setor_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?Setor $setor = null;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="usuario"
     * )
     * @ORM\JoinColumn(
     *     name="usuario_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?Usuario $usuario = null;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="ModalidadeOrgaoCentral"
     * )
     * @ORM\JoinColumn(
     *     name="orgao_central_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?ModalidadeOrgaoCentral $modalidadeOrgaoCentral = null;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="Setor"
     * )
     * @ORM\JoinColumn(
     *     name="unidade_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?Setor $unidade = null;

    /**
     * @return Aviso
     */
    public function getAviso(): Aviso
    {
        return $this->aviso;
    }

    /**
     * @param Aviso $aviso
     *
     * @return VinculacaoAviso
     */
    public function setAviso(Aviso $aviso): self
    {
        $this->aviso = $aviso;

        return $this;
    }

    /**
     * @return EspecieSetor|null
     */
    public function getEspecieSetor(): ?EspecieSetor
    {
        return $this->especieSetor;
    }

    /**
     * @param EspecieSetor|null $especieSetor
     *
     * @return VinculacaoAviso
     */
    public function setEspecieSetor(?EspecieSetor $especieSetor): self
    {
        $this->especieSetor = $especieSetor;

        return $this;
    }

    /**
     * @return Setor|null
     */
    public function getSetor(): ?Setor
    {
        return $this->setor;
    }

    /**
     * @param Setor|null $setor
     *
     * @return VinculacaoAviso
     */
    public function setSetor(?Setor $setor): self
    {
        $this->setor = $setor;

        return $this;
    }

    /**
     * @return Setor|null
     */
    public function getUnidade(): ?Setor
    {
        return $this->unidade;
    }

    /**
     * @param Setor|null $unidade
     *
     * @return VinculacaoAviso
     */
    public function setUnidade(?Setor $unidade): VinculacaoAviso
    {
        $this->unidade = $unidade;

        return $this;
    }

    /**
     * @return Usuario|null
     */
    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    /**
     * @param Usuario|null $usuario
     *
     * @return VinculacaoAviso
     */
    public function setUsuario(?Usuario $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * @return ModalidadeOrgaoCentral|null
     */
    public function getModalidadeOrgaoCentral(): ?ModalidadeOrgaoCentral
    {
        return $this->modalidadeOrgaoCentral;
    }

    /**
     * @param ModalidadeOrgaoCentral|null $modalidadeOrgaoCentral
     *
     * @return VinculacaoAviso
     */
    public function setModalidadeOrgaoCentral(?ModalidadeOrgaoCentral $modalidadeOrgaoCentral): VinculacaoAviso
    {
        $this->modalidadeOrgaoCentral = $modalidadeOrgaoCentral;

        return $this;
    }
}
