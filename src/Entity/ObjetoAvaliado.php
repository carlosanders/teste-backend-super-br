<?php

declare(strict_types=1);
/**
 * /src/Entity/ObjetoAvaliado.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Entity;

use DateTime;
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
 * Class ObjetoAvaliado.
 *
 * @ORM\Table(
 *     name="ad_objeto_avaliado",
 *     indexes={
 *         @ORM\Index(name="idx_objeto_classe", columns={"classe"}),
 *         @ORM\Index(name="idx_objeto_id", columns={"objeto_id"}),
 *     }
 * )
 *
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 *
 * @Gedmo\Loggable
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class ObjetoAvaliado implements EntityInterface
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
     *   message="O campo não pode ser nulo!"
     * )
     *
     * @Assert\Length(
     *   min = 3,
     *   minMessage = "O campo deve ter no mínimo 3 caracteres!",
     *   max = 255,
     *   maxMessage = "O campo deve ter no máximo 255 caracteres!"
     * )
     *
     * @ORM\Column(
     *   type="string",
     *   name="classe",
     *   nullable=false
     * )
     */
    protected string $classe;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\Column(
     *   type="integer",
     *   name="objeto_id",
     *   nullable=false
     * )
     */
    protected int $objetoId;

    /**
     * @ORM\Column(
     *     type="float",
     *     nullable=true
     * )
     */
    protected null|float $avaliacaoResultante = null;

    /**
     * @ORM\Column(
     *     type="datetime",
     *     name="dt_ult_avaliacao",
     *     nullable=true
     * )
     */
    protected null|DateTime $dataUltimaAvaliacao = null;

    /**
     * @ORM\Column(
     *     type="integer",
     *     name="qtd_avaliacoes",
     *     nullable=true
     * )
     */
    protected null|int $quantidadeAvaliacoes = null;

    /**
     * @return string
     */
    public function getClasse(): string
    {
        return $this->classe;
    }

    /**
     * @param string $classe
     *
     * @return ObjetoAvaliado
     */
    public function setClasse(string $classe): ObjetoAvaliado
    {
        $this->classe = $classe;

        return $this;
    }

    /**
     * @return int
     */
    public function getObjetoId(): int
    {
        return $this->objetoId;
    }

    /**
     * @param int $objetoId
     *
     * @return ObjetoAvaliado
     */
    public function setObjetoId(int $objetoId): ObjetoAvaliado
    {
        $this->objetoId = $objetoId;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getAvaliacaoResultante(): ?float
    {
        return $this->avaliacaoResultante;
    }

    /**
     * @param float|null $avaliacaoResultante
     *
     * @return ObjetoAvaliado
     */
    public function setAvaliacaoResultante(?float $avaliacaoResultante): ObjetoAvaliado
    {
        $this->avaliacaoResultante = $avaliacaoResultante;

        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getDataUltimaAvaliacao(): ?DateTime
    {
        return $this->dataUltimaAvaliacao;
    }

    /**
     * @param DateTime|null $dataUltimaAvaliacao
     *
     * @return ObjetoAvaliado
     */
    public function setDataUltimaAvaliacao(?DateTime $dataUltimaAvaliacao): ObjetoAvaliado
    {
        $this->dataUltimaAvaliacao = $dataUltimaAvaliacao;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getQuantidadeAvaliacoes(): ?int
    {
        return $this->quantidadeAvaliacoes;
    }

    /**
     * @param int|null $quantidadeAvaliacoes
     *
     * @return ObjetoAvaliado
     */
    public function setQuantidadeAvaliacoes(?int $quantidadeAvaliacoes): ObjetoAvaliado
    {
        $this->quantidadeAvaliacoes = $quantidadeAvaliacoes;

        return $this;
    }
}
