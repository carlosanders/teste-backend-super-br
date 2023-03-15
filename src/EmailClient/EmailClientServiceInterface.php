<?php
declare(strict_types=1);

namespace SuppCore\AdministrativoBackend\EmailClient;

use SuppCore\AdministrativoBackend\Entity\ContaEmail;

/**
 * Interface EmailClientServiceInterface
 * @package SuppCore\AdministrativoBackend\EmailClient
 */
interface EmailClientServiceInterface
{

    public const FOLDER_INBOX = 'Caixa de Entrada';
    public const FOLDER_SPAM = 'Spam';
    public const FOLDER_SENT = 'Enviados';
    public const FOLDER_TRASH = 'Lixeira';
    public const FOLDER_DRAFT = 'Rascunhos';

    public const DEFAULT_FOLDERS =
        self::FOLDER_INBOX
        .'|'. self::FOLDER_SPAM
        .'|'. self::FOLDER_SENT
        .'|'. self::FOLDER_TRASH
        .'|'. self::FOLDER_DRAFT;

    public const BLACKLIST_FOLDERS = 'Tarefas|Journal|Histórico de Conversa|Contatos|Calendário|Anotações|[Gmail]'
        .'|Com estrela';

    /**
     * @param array $configs
     */
    public function setConfigs(array $configs = []): void;

    /**
     * @param ContaEmail $contaEmail
     * @return bool
     * @throws ConnectionException
     */
    public function testConnection(ContaEmail $contaEmail): bool;

    /**
     * @param ContaEmail $contaEmail
     * @return Folder[]
     */
    public function getDefaultFolders(ContaEmail $contaEmail): array;

    /**
     * @param ContaEmail $contaEmail
     * @param int $limit
     * @param int $offset
     * @return Folder[]
     */
    public function getFolders(ContaEmail $contaEmail, int $limit = 10, int $offset = 0): array;

    /**
     * @param ContaEmail $contaEmail
     * @return Folder|null
     */
    public function getInboxFolder(ContaEmail $contaEmail): ? Folder;

    /**
     * @param ContaEmail $contaEmail
     * @param string $idenfifier
     * @return Folder|null
     */
    public function getFolder(ContaEmail $contaEmail, string $idenfifier): ? Folder;

    /**
     * @param ContaEmail $contaEmail
     * @param Folder $folder
     * @param int $limit
     * @param int $offset
     * @param bool $withAttachments
     * @return array
     */
    public function getMessages(
        ContaEmail $contaEmail,
        Folder $folder,
        int $limit = 10,
        int $offset = 0,
        bool $withAttachments = false
    ): array;

    /**
     * @param ContaEmail $contaEmail
     * @param array $criterias
     * @param int $limit
     * @param int $offset
     * @param bool $withAttachments
     * @return array
     */
    public function searchMessages(
        ContaEmail $contaEmail,
        array $criterias,
        int $limit = 10,
        int $offset = 0,
        bool $withAttachments = false
    ): array;

    /**
     * @param ContaEmail $contaEmail
     * @param string|int $folderIdentifier
     * @param string|int $messageIdentifier
     * @param bool $withAttachments
     * @return Message|null
     */
    public function getMessage(
        ContaEmail $contaEmail,
        string|int $folderIdentifier,
        string|int $messageIdentifier,
        bool $withAttachments = false
    ): ?Message;

    /**
     * @param ContaEmail $contaEmail
     * @param string|int $folderIdentifier
     * @param string|int $messageIdentifier
     * @return Attachment[]
     */
    public function getAttachments(
        ContaEmail $contaEmail,
        string|int $folderIdentifier,
        string|int $messageIdentifier
    ): array;

    /**
     * @param ContaEmail $contaEmail
     * @param string|int $folderIdentifier
     * @param string|int $messageIdentifier
     * @param string|int $attachmentIdentifier
     * @return Attachment|null
     */
    public function getAttachment(
        ContaEmail $contaEmail,
        string|int $folderIdentifier,
        string|int $messageIdentifier,
        string|int $attachmentIdentifier
    ): ?Attachment;
}
