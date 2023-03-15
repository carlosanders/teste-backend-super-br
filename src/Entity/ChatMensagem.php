<?php

declare(strict_types=1);
/**
 * /src/Entity/ChatMensagem.php.
 */

namespace SuppCore\AdministrativoBackend\Entity;

use Doctrine\ORM\Mapping as ORM;
use Exception;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use SuppCore\AdministrativoBackend\Entity\Traits\Blameable;
use SuppCore\AdministrativoBackend\Entity\Traits\Id;
use SuppCore\AdministrativoBackend\Entity\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\Entity\Traits\Timestampable;
use SuppCore\AdministrativoBackend\Entity\Traits\Uuid;
use DMS\Filter\Rules as Filter;

/**
 * Class ChatMensagem.
 *
 *  @ORM\Table(
 *     name="ad_chat_mensagem"
 * )
 *
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 *
 */
class ChatMensagem implements EntityInterface
{
    // Traits
    use Blameable;
    use Timestampable;
    use Softdeleteable;
    use Id;
    use Uuid;

    /**
     * Constructor.
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
     *
     * @Assert\Length(
     *     max = 255,
     *     maxMessage = "O campo deve ter no máximo 255 caracteres!"
     * )
     * @ORM\Column(
     *     type="string",
     *     nullable=true
     * )
     */
    protected string $mensagem = '';

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(
     *     targetEntity="Usuario",
     *     inversedBy="vinculacoesUsuarios"
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
     *     inversedBy="mensagens"
     * )
     * @ORM\JoinColumn(
     *     name="chat_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected ?Chat $chat = null;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="ChatMensagem"
     * )
     * @ORM\JoinColumn(
     *     name="mensagem_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?ChatMensagem $replyTo = null;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="ComponenteDigital"
     * )
     * @ORM\JoinColumn(
     *     name="componente_digital_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?ComponenteDigital $componenteDigital = null;

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
     * @return string|null
     */
    public function getMensagem(): ?string
    {
        return $this->mensagem;
    }

    /**
     * @param string|null $mensagem
     * @return $this
     */
    public function setMensagem(?string $mensagem): self
    {
        $this->mensagem = $mensagem;

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
     * @return $this
     */
    public function setUsuario(Usuario $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * @return ChatMensagem|null
     */
    public function getReplyTo(): ChatMensagem|null
    {
        return $this->replyTo;
    }

    /**
     * @param ChatMensagem|null $replyTo
     * @return $this
     */
    public function setReplyTo(?ChatMensagem $replyTo): self
    {
        $this->replyTo = $replyTo;

        return $this;
    }

    /**
     * @return ComponenteDigital|null
     */
    public function getComponenteDigital(): ComponenteDigital|null
    {
        return $this->componenteDigital;
    }

    /**
     * @param ComponenteDigital|null $componenteDigital
     * @return $this
     */
    public function setComponenteDigital(?ComponenteDigital $componenteDigital): self
    {
        $this->componenteDigital = $componenteDigital;

        return $this;
    }

}
