<?php

declare(strict_types=1);
/**
 * /src/Entity/Aviso.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Gedmo\Mapping\Annotation as Gedmo;
use SuppCore\AdministrativoBackend\Doctrine\ORM\Enableable\Enableable;
use SuppCore\AdministrativoBackend\Entity\Traits\Ativo;
use SuppCore\AdministrativoBackend\Entity\Traits\Nome;
use SuppCore\AdministrativoBackend\Entity\Traits\Descricao;
use SuppCore\AdministrativoBackend\Entity\Traits\Blameable;
use SuppCore\AdministrativoBackend\Entity\Traits\Id;
use SuppCore\AdministrativoBackend\Entity\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\Entity\Traits\Timestampable;
use SuppCore\AdministrativoBackend\Entity\Traits\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Aviso.
 *
 *  @ORM\Table(
 *     name="ad_aviso"
 * )
 *
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 *
 * @Enableable()
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Aviso implements EntityInterface
{
    // Traits
    use Blameable;
    use Timestampable;
    use Softdeleteable;
    use Ativo;
    use Nome;
    use Descricao;
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
        $this->vinculacoesAvisos = new ArrayCollection();
    }

    /**
     * @var Collection|ArrayCollection|ArrayCollection<VinculacaoAviso>
     *
     * @ORM\OneToMany(
     *     targetEntity="VinculacaoAviso",
     *     mappedBy="aviso"
     * )
     */
    protected ArrayCollection|Collection $vinculacoesAvisos;

    /**
     * @ORM\Column(
     *     name="sistema",
     *     type="boolean",
     *     nullable=false
     * )
     */
    protected bool $sistema = false;


    /**
     * @return Collection
     */
    public function getVinculacoesAvisos(): Collection
    {
        return $this->vinculacoesAvisos;
    }

    /**
     *
     * @param VinculacaoAviso $vinculacaoAviso
     * @return Aviso
     */
    public function addVinculacaoAviso(VinculacaoAviso $vinculacaoAviso): Aviso
    {
        if (!$this->vinculacoesAvisos->contains($vinculacaoAviso)) {
            $this->vinculacoesAvisos->add($vinculacaoAviso);
            $vinculacaoAviso->setAviso($this);
        }
        return $this;
    }

    /**
     * @param VinculacaoAviso $vinculacaoAviso
     * @return Aviso
     */
    public function removeVinculacaoAviso(VinculacaoAviso $vinculacaoAviso): Aviso
    {
        if ($this->vinculacoesAvisos->contains($vinculacaoAviso)) {
            $this->vinculacoesAvisos->removeElement($vinculacaoAviso);
        }
        return $this;
    }

    /**
     * @return bool
     */
    public function getSistema(): bool
    {
        return $this->sistema;
    }

    /**
     * @param bool $sistema
     *
     * @return AreaTrabalho
     */
    public function setSistema(bool $sistema): self
    {
        $this->sistema = $sistema;
        return $this;
    }
}
