<?php

declare(strict_types=1);
/**
 * /src/Entity/NumeroUnicoDocumento.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Entity;

use Doctrine\ORM\Mapping as ORM;
use Exception;
use SuppCore\AdministrativoBackend\Entity\Traits\Blameable;
use SuppCore\AdministrativoBackend\Entity\Traits\Id;
use SuppCore\AdministrativoBackend\Entity\Traits\Timestampable;
use SuppCore\AdministrativoBackend\Entity\Traits\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class NumeroUnicoDocumento.
 *
 *  @ORM\Table(
 *     name="ad_numero_unico_documento",
 * )
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class NumeroUnicoDocumento implements EntityInterface
{
    // Traits
    use Blameable;
    use Timestampable;
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
     * @ORM\Column(
     *     type="integer",
     *     name="sequencia",
     *     nullable=false
     * )
     */
    protected int $sequencia = 0;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     * @ORM\Column(
     *     type="integer",
     *     name="ano",
     *     nullable=false
     * )
     */
    protected int $ano = 0;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(
     *     targetEntity="TipoDocumento"
     * )
     * @ORM\JoinColumn(
     *     name="tipo_documento_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected ?TipoDocumento $tipoDocumento = null;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(
     *     targetEntity="Setor"
     * )
     * @ORM\JoinColumn(
     *     name="setor_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected ?Setor $setor = null;

    /**
     * @ORM\OneToOne(
     *     targetEntity="Documento",
     *     mappedBy="numeroUnicoDocumento"
     * )
     */
    protected ?Documento $documento = null;

    /**
     * @return int|null
     */
    public function getSequencia(): ?int
    {
        return $this->sequencia;
    }

    /**
     * @param int $sequencia
     *
     * @return NumeroUnicoDocumento
     */
    public function setSequencia(int $sequencia): self
    {
        $this->sequencia = $sequencia;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getAno(): ?int
    {
        return $this->ano;
    }

    /**
     * @param int $ano
     *
     * @return NumeroUnicoDocumento
     */
    public function setAno(int $ano): self
    {
        $this->ano = $ano;

        return $this;
    }

    /**
     * @return TipoDocumento|null
     */
    public function getTipoDocumento(): ?TipoDocumento
    {
        return $this->tipoDocumento;
    }

    /**
     * @param TipoDocumento $tipoDocumento
     *
     * @return NumeroUnicoDocumento
     */
    public function setTipoDocumento(TipoDocumento $tipoDocumento): self
    {
        $this->tipoDocumento = $tipoDocumento;

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
     * @param Setor $setor
     *
     * @return NumeroUnicoDocumento
     */
    public function setSetor(Setor $setor): self
    {
        $this->setor = $setor;

        return $this;
    }

    /**
     * @return Documento|null
     */
    public function getDocumento(): ?Documento
    {
        return $this->documento;
    }

    /**
     * @param Documento|null $documento
     *
     * @return NumeroUnicoDocumento
     */
    public function setDocumento(?Documento $documento): self
    {
        $this->documento = $documento;

        return $this;
    }

    /**
     * @return string
     */
    public function geraNumeroUnico()
    {
        if ($this->getSetor()) {
            $numUnico = str_pad((string) $this->getSequencia(), 5, '0', STR_PAD_LEFT).
                '/'.$this->getAno();

            $particulas = [];

            $particulas[] = $this->getSetor()->getSigla();

            if ($this->getSetor()->getParent()) {
                //numeracao por setor
                if ($this->getSetor()->getUnidade() &&
                    ($siglaUnidade = $this->getSetor()->getUnidade()->getSigla())) {
                    if (!in_array($siglaUnidade, $particulas)) {
                        $particulas[] = $siglaUnidade;
                    }
                }

                if ($this->getSetor()->getUnidade() &&
                    ($orgaoCentral = $this->getSetor()->getUnidade()->getModalidadeOrgaoCentral()) &&
                    ($siglaOrgaoCentral = $orgaoCentral->getValor()) &&
                    !in_array($siglaOrgaoCentral, $particulas)) {
                    if (!in_array($siglaOrgaoCentral, $particulas)) {
                        $particulas[] = $siglaOrgaoCentral;
                    }
                }
            } else {
                //numeracao por unidade
                if (($orgaoCentral = $this->getSetor()->getModalidadeOrgaoCentral()) &&
                    ($siglaOrgaoCentral = $orgaoCentral->getValor()) &&
                    !in_array($siglaOrgaoCentral, $particulas)) {
                    if (!in_array($siglaOrgaoCentral, $particulas)) {
                        $particulas[] = $siglaOrgaoCentral;
                    }
                }
            }

            foreach ($particulas as $particula) {
                $numUnico .= '/'.$particula;
            }

            return $numUnico;
        }
    }
}
