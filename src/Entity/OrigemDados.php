<?php

declare(strict_types=1);
/**
 * /src/Entity/OrigemDados.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Entity;

use DateTime;
use DMS\Filter\Rules as Filter;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Gedmo\Mapping\Annotation as Gedmo;
use SuppCore\AdministrativoBackend\Entity\Traits\Blameable;
use SuppCore\AdministrativoBackend\Entity\Traits\Id;
use SuppCore\AdministrativoBackend\Entity\Traits\Timestampable;
use SuppCore\AdministrativoBackend\Entity\Traits\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class OrigemDados.
 *
 *  @ORM\Table(
 *     name="ad_origem_dados",
 * )
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @Gedmo\Loggable
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class OrigemDados implements EntityInterface
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
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Filter\ToUpper(encoding="UTF-8")
     *
     * @Assert\NotBlank(
     *     message="O campo não pode estar em branco!"
     * )
     * @Assert\Length(
     *     max = 255,
     *     maxMessage = "O campo deve ter no máximo 255 caracteres!"
     * )
     * @ORM\Column(
     *     type="string",
     *     name="id_externo",
     *     nullable=true
     * )
     */
    protected ?string $idExterno = null;

    /**
     * @Gedmo\Versioned
     * @ORM\Column(
     *     type="datetime",
     *     name="data_hora_ultima_consulta",
     *     nullable=false
     * )
     */
    protected DateTime $dataHoraUltimaConsulta;

    /**
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Filter\ToUpper(encoding="UTF-8")
     *
     * @Assert\NotBlank(
     *     message="O campo não pode estar em branco!"
     * )
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     * @Assert\Length(
     *     max = 255,
     *     maxMessage = "O campo deve ter no máximo 255 caracteres!"
     * )
     * @ORM\Column(
     *     type="string",
     *     nullable=false
     * )
     */
    protected string $servico;

    /**
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Filter\ToUpper(encoding="UTF-8")
     *
     * @Assert\NotBlank(
     *     message="O campo não pode estar em branco!"
     * )
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     * @Assert\Length(
     *     max = 255,
     *     maxMessage = "O campo deve ter no máximo 255 caracteres!"
     * )
     * @ORM\Column(
     *     type="string",
     *     name="fonte_dados",
     *     nullable=false
     * )
     */
    protected string $fonteDados;

    /**
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Filter\ToUpper(encoding="UTF-8")
     *
     * @Assert\Length(
     *     max = 255,
     *     maxMessage = "O campo deve ter no máximo 255 caracteres!"
     * )
     * @ORM\Column(
     *     type="string",
     *     name="msg_ultima_consulta",
     *     nullable=true
     * )
     */
    protected ?string $mensagemUltimaConsulta = null;

    /**
     * @ORM\Column(
     *     type="integer",
     *     nullable=false
     * )
     */
    protected int $status = 0;

    /**
     * @return string|null
     */
    public function getIdExterno(): ?string
    {
        return $this->idExterno;
    }

    /**
     * @param string|null $idExterno
     *
     * @return OrigemDados
     */
    public function setIdExterno(?string $idExterno = null): self
    {
        $this->idExterno = $idExterno;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDataHoraUltimaConsulta(): DateTime
    {
        return $this->dataHoraUltimaConsulta;
    }

    /**
     * @param DateTime $dataHoraUltimaConsulta
     *
     * @return OrigemDados
     */
    public function setDataHoraUltimaConsulta(DateTime $dataHoraUltimaConsulta): self
    {
        $this->dataHoraUltimaConsulta = $dataHoraUltimaConsulta;

        return $this;
    }

    /**
     * @return string
     */
    public function getServico(): string
    {
        return $this->servico;
    }

    /**
     * @param string $servico
     *
     * @return OrigemDados
     */
    public function setServico(string $servico): self
    {
        $this->servico = $servico;

        return $this;
    }

    /**
     * @return string
     */
    public function getFonteDados(): string
    {
        return $this->fonteDados;
    }

    /**
     * @param string $fonteDados
     *
     * @return OrigemDados
     */
    public function setFonteDados(string $fonteDados): self
    {
        $this->fonteDados = $fonteDados;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMensagemUltimaConsulta(): ?string
    {
        return $this->mensagemUltimaConsulta;
    }

    /**
     * @param string|null $mensagemUltimaConsulta
     *
     * @return OrigemDados
     */
    public function setMensagemUltimaConsulta(?string $mensagemUltimaConsulta): self
    {
        $this->mensagemUltimaConsulta = $mensagemUltimaConsulta;

        return $this;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     *
     * @return OrigemDados
     */
    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }
}
