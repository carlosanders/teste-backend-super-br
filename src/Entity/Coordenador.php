<?php

declare(strict_types=1);

namespace SuppCore\AdministrativoBackend\Entity;

use Doctrine\ORM\Mapping as ORM;
use Exception;
use Gedmo\Mapping\Annotation as Gedmo;
use SuppCore\AdministrativoBackend\Entity\Traits\Blameable;
use SuppCore\AdministrativoBackend\Entity\Traits\Id;
use SuppCore\AdministrativoBackend\Entity\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\Entity\Traits\Timestampable;
use SuppCore\AdministrativoBackend\Entity\Traits\Uuid;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Coordenador.
 *
 * Vínculo que faz o usuário coordenador de um setor, unidade ou órgão central.
 *
 *  @ORM\Table(
 *     name="ad_coordenador"
 * )
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @UniqueEntity(
 *     fields = {"unidade", "usuario"},
 *     message = "Usuário já é coordenador desta unidade!"
 * )
 *
 * @UniqueEntity(
 *     fields = {"setor", "usuario"},
 *     message = "Usuário já é coordenador deste setor!"
 * )
 *
 * @UniqueEntity(
 *     fields = {"orgaoCentral", "usuario"},
 *     message = "Usuário já é coordenador deste orgao central!"
 * )
 *
 * @Gedmo\Loggable
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 *
 * @author  Felipe Pena <felipe.pena@datainfo.inf.br>
 */
class Coordenador implements EntityInterface
{
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
     * @Gedmo\Versioned
     *
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
     * @Gedmo\Versioned
     *
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
     * @Gedmo\Versioned
     *
     * @ORM\ManyToOne(
     *     targetEntity="ModalidadeOrgaoCentral"
     * )
     * @ORM\JoinColumn(
     *     name="orgao_central_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?ModalidadeOrgaoCentral $orgaoCentral = null;

    /**
     * @Gedmo\Versioned
     *
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(
     *     targetEntity="Usuario",
     *     inversedBy="coordenadores"
     * )
     * @ORM\JoinColumn(
     *     name="usuario_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected Usuario $usuario;

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
     * @return Coordenador
     */
    public function setUnidade(?Setor $unidade): Coordenador
    {
        $this->unidade = $unidade;

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
     * @return Coordenador
     */
    public function setSetor(?Setor $setor): Coordenador
    {
        $this->setor = $setor;

        return $this;
    }

    /**
     * @return ModalidadeOrgaoCentral
     */
    public function getOrgaoCentral(): ?ModalidadeOrgaoCentral
    {
        return $this->orgaoCentral;
    }

    /**
     * @param ModalidadeOrgaoCentral|null $orgaoCentral
     *
     * @return Coordenador
     */
    public function setOrgaoCentral(?ModalidadeOrgaoCentral $orgaoCentral): Coordenador
    {
        $this->orgaoCentral = $orgaoCentral;

        return $this;
    }

    /**
     * @return Usuario
     */
    public function getUsuario(): Usuario
    {
        return $this->usuario;
    }

    /**
     * @param Usuario $usuario
     *
     * @return Coordenador
     */
    public function setUsuario(Usuario $usuario): Coordenador
    {
        $this->usuario = $usuario;

        return $this;
    }
}
