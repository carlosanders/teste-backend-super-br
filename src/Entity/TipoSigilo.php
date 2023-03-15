<?php

declare(strict_types=1);
/**
 * /src/Entity/TipoSigilo.php.
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
use SuppCore\AdministrativoBackend\Entity\Traits\Nome;
use SuppCore\AdministrativoBackend\Entity\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\Entity\Traits\Timestampable;
use SuppCore\AdministrativoBackend\Entity\Traits\Uuid;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class TipoSigilo.
 *
 *  @ORM\Table(
 *     name="ad_tipo_sigilo",
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(columns={"nome", "apagado_em"}),
 *     }
 * )
 *
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 *
 * @UniqueEntity(
 *     fields = {"nome"},
 *     message = "Nome já está em utilização!"
 * )
 *
 * @Enableable()
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class TipoSigilo implements EntityInterface
{
    // Traits
    use Blameable;
    use Timestampable;
    use Softdeleteable;
    use Nome;
    use Descricao;
    use Ativo;
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
     * @Assert\Range(
     *     min = 0,
     *     max = 4,
     *     notInRangeMessage = "Campo ser entre {{ min }} e {{ max }}"
     * )
     * @ORM\Column(
     *     type="integer",
     *     name="nivel_acesso",
     *     nullable=false
     * )
     */
    protected int $nivelAcesso;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     * @Assert\Range(
     *     min = 0,
     *     max = 100,
     *     notInRangeMessage = "Campo ser entre {{ min }} e {{ max }}"
     * )
     * @ORM\Column(
     *     type="integer",
     *     name="prazo_anos",
     *     nullable=false
     * )
     */
    protected int $prazoAnos;

    /**
     * @ORM\Column(
     *     name="lei_acesso_informacao",
     *     type="boolean",
     *     nullable=false
     * )
     */
    protected bool $leiAcessoInformacao = false;

    /**
     * @return int
     */
    public function getNivelAcesso(): int
    {
        return $this->nivelAcesso;
    }

    /**
     * @param int $nivelAcesso
     *
     * @return TipoSigilo
     */
    public function setNivelAcesso(int $nivelAcesso): self
    {
        $this->nivelAcesso = $nivelAcesso;

        return $this;
    }

    /**
     * @return int
     */
    public function getPrazoAnos(): int
    {
        return $this->prazoAnos;
    }

    /**
     * @param int $prazoAnos
     *
     * @return TipoSigilo
     */
    public function setPrazoAnos(int $prazoAnos): self
    {
        $this->prazoAnos = $prazoAnos;

        return $this;
    }

    /**
     * @return bool
     */
    public function getLeiAcessoInformacao(): bool
    {
        return $this->leiAcessoInformacao;
    }

    /**
     * @param bool $leiAcessoInformacao
     *
     * @return TipoSigilo
     */
    public function setLeiAcessoInformacao(bool $leiAcessoInformacao): self
    {
        $this->leiAcessoInformacao = $leiAcessoInformacao;

        return $this;
    }
}
