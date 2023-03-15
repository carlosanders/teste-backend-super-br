<?php

declare(strict_types=1);
/**
 * /src/Entity/ChatParticipante.php.
 */

namespace SuppCore\AdministrativoBackend\Entity;

use Doctrine\ORM\Mapping as ORM;
use Exception;
use Symfony\Component\Validator\Constraints as Assert;
use SuppCore\AdministrativoBackend\Entity\Traits\Blameable;
use SuppCore\AdministrativoBackend\Entity\Traits\Id;
use SuppCore\AdministrativoBackend\Entity\Traits\Timestampable;
use SuppCore\AdministrativoBackend\Entity\Traits\Uuid;
use DateTime;

/**
 * Class ChatParticipante.
 *
 *  @ORM\Table(
 *     name="ad_chat_participante"
 * )
 *
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 */
class ChatParticipante implements EntityInterface
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
     * @ORM\Column(
     *     name="administrador",
     *     type="boolean",
     *     nullable=false
     * )
     */
    protected bool $administrador = false;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     * @ORM\ManyToOne(
     *     targetEntity="Usuario"
     * )
     * @ORM\JoinColumn(
     *     name="usuario_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected ?Usuario $usuario = null;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(
     *     targetEntity="Chat",
     *     inversedBy="participantes"
     * )
     * @ORM\JoinColumn(
     *     name="chat_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected ?Chat $chat = null;

    /**
     * @ORM\Column(
     *     name="ultima_visualizacao",
     *     type="datetime",
     *     nullable=true
     * )
     */
    protected ?DateTime $ultimaVisualizacao = null;


    /**
     * @ORM\Column(
     *     type="integer",
     *     name="mensagens_nao_lidas",
     *     nullable=true
     * )
     */
    protected ?int $mensagensNaoLidas = 0;

    /**
     * @return bool
     */
    public function getAdministrador(): bool
    {
        return $this->administrador;
    }

    /**
     * @param bool $administrador
     * @return $this
     */
    public function setAdministrador(bool $administrador): self
    {
        $this->administrador = $administrador;

        return $this;
    }

    /**
     * @return Usuario
     */
    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    /**
     * @param Usuario $usuario
     * @return $this
     */
    public function setUsuario(Usuario $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * @return Chat
     */
    public function getChat(): Chat
    {
        return $this->chat;
    }

    /**
     * @param Chat $chat
     * @return $this
     */
    public function setChat(Chat $chat): self
    {
        $this->chat = $chat;

        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getUltimaVisualizacao(): ?DateTime
    {
        return $this->ultimaVisualizacao;
    }

    /**
     * @param DateTime|null $ultimaVisualizacao
     * @return $this
     */
    public function setUltimaVisualizacao(?DateTime $ultimaVisualizacao): self
    {
        $this->ultimaVisualizacao = $ultimaVisualizacao;

        return $this;
    }

    /**
     * @return int
     */
    public function getMensagensNaoLidas(): int
    {
        return (int) $this->mensagensNaoLidas;
    }

    /**
     * @param int $mensagensNaoLidas
     * @return $this
     */
    public function setMensagensNaoLidas(int $mensagensNaoLidas): self
    {
        $this->mensagensNaoLidas = $mensagensNaoLidas;

        return $this;
    }

}
