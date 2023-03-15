<?php

declare(strict_types=1);

namespace SuppCore\AdministrativoBackend\EmailClient\PHPIMAP;


use Carbon\Carbon;
use DateTime;
use SuppCore\AdministrativoBackend\EmailClient\ConnectionException;
use SuppCore\AdministrativoBackend\EmailClient\EmailClientServiceInterface;
use SuppCore\AdministrativoBackend\EmailClient\Message as EmailClientMessage;
use SuppCore\AdministrativoBackend\EmailClient\Folder as EmailClientFolder;
use SuppCore\AdministrativoBackend\EmailClient\Attachment as EmailClientAttachment;
use SuppCore\AdministrativoBackend\EmailClient\Address as EmailClientAddress;
use SuppCore\AdministrativoBackend\Entity\ContaEmail;
use Webklex\PHPIMAP\Client as PHPIMAPClient;
use Webklex\PHPIMAP\ClientManager as PHPIMAPClientManager;
use Webklex\PHPIMAP\Exceptions\ConnectionFailedException;
use Webklex\PHPIMAP\Exceptions\EventNotFoundException;
use Webklex\PHPIMAP\Exceptions\FolderFetchingException;
use Webklex\PHPIMAP\Exceptions\GetMessagesFailedException;
use Webklex\PHPIMAP\Exceptions\InvalidMessageDateException;
use Webklex\PHPIMAP\Exceptions\MaskNotFoundException;
use Webklex\PHPIMAP\Exceptions\MessageContentFetchingException;
use Webklex\PHPIMAP\Exceptions\MessageFlagException;
use Webklex\PHPIMAP\Exceptions\MessageHeaderFetchingException;
use Webklex\PHPIMAP\Exceptions\MessageNotFoundException;
use Webklex\PHPIMAP\Exceptions\RuntimeException;
use Webklex\PHPIMAP\Folder as PHPIMAPFolder;
use Webklex\PHPIMAP\Message as PHPIMAPMessage;
use Webklex\PHPIMAP\Attachment as PHPIMAPAttachment;
use Webklex\PHPIMAP\Address as PHPIMAPAddress;
use Webklex\PHPIMAP\Query\Query;
use Webklex\PHPIMAP\Query\WhereQuery;

/**
 * Class EmailClientService
 * @package SuppCore\AdministrativoBackend\EmailClient\PHPIMAP
 */
class EmailClientService implements EmailClientServiceInterface
{
    private array $configs = [];

    private PHPIMAPClient|null $client = null;

    private function getMessageCriterias(): array
    {
        return [
            'folder' => fn(WhereQuery $query, string $value) => $query->getClient()->openFolder(base64_decode($value)),
            'from' => fn(WhereQuery $query, string $value) => $query->whereFrom($value),
            'to' => fn(WhereQuery $query, string $value) => $query->whereTo($value),
            'bcc' => fn(WhereQuery $query, string $value) => $query->whereBcc($value),
            'cc' => fn(WhereQuery $query, string $value) => $query->whereCc($value),
            'text' => fn(WhereQuery $query, string $value) => $query->whereText($this->parseTextToServer($value)),
            'body' => fn(WhereQuery $query, string $value) => $query->whereBody($this->parseTextToServer($value)),
            'subject' => fn(WhereQuery $query, string $value) => $query->whereSubject($this->parseTextToServer($value)),
            'new' => fn(WhereQuery $query, string $value = null) => $query->whereNew(),
            'old' => fn(WhereQuery $query, string $value = null) => $query->whereOld(),
            'recent' => fn(WhereQuery $query, string $value = null) => $query->whereRecent(),
            'readed' => fn(WhereQuery $query, string $value = null) => $query->whereSeen(),
            'unreaded' => fn(WhereQuery $query, string $value = null) => $query->whereUnseen(),
            'deleted' => fn(WhereQuery $query, string $value = null) => $query->whereDeleted(),
            'sended' => fn(WhereQuery $query, string $value = null) => $query->whereAnswered(),
        ];
    }

    public function setConfigs(array $configs = []): void
    {
        $this->configs = $configs;
    }

    /**
     * @param ContaEmail $contaEmail
     * @return bool
     * @throws MaskNotFoundException
     */
    public function testConnection(ContaEmail $contaEmail): bool
    {
        try {
            $this->getClient($contaEmail)->checkConnection();
            return true;
        } catch (ConnectionFailedException $e) {
            return false;
        }
    }

    /**
     * @param ContaEmail $contaEmail
     * @return array
     * @throws ConnectionException
     * @throws ConnectionFailedException
     * @throws FolderFetchingException
     * @throws MaskNotFoundException
     * @throws RuntimeException
     */
    public function getDefaultFolders(ContaEmail $contaEmail): array
    {
        $folders = $this->connect($contaEmail)
            ->getFolders(true);

        if ($folders && $gmail = $folders->filter(fn($folder) => $folder->path === '[Gmail]')->first()) {
            $inbox = $folders->filter(fn($folder) => $folder->path === 'INBOX')->first();
            $gmail->children->push($inbox);
            $folders = $gmail->children;
        }

        $folders = $folders
            ->map(fn($folder) => $this->parseFolder($folder))
            ->sort(fn($folderA, $folderB) => $this->getFolderOrderScore($folderA)
            > $this->getFolderOrderScore($folderB) ? 1 : -1)
            ->filter(fn($folder) => in_array(
                $folder->getParsedName(),
                explode('|', self::DEFAULT_FOLDERS)
            ));

        return [
            'total' => $folders->count(),
            'entities' => $folders->toArray()
        ];
    }

    /**
     * @param ContaEmail $contaEmail
     * @param int $limit
     * @param int $offset
     * @return array
     * @throws ConnectionException
     * @throws ConnectionFailedException
     * @throws FolderFetchingException
     * @throws MaskNotFoundException
     * @throws RuntimeException
     */
    public function getFolders(ContaEmail $contaEmail, int $limit = 100, int $offset = 0): array
    {
        $folders = $this->connect($contaEmail)
            ->getFolders(false)
            ->map(fn($folder) => $this->parseFolder($folder))
            ->sort(fn($folderA, $folderB) => $this->getFolderOrderScore($folderA)
            > $this->getFolderOrderScore($folderB) ? 1 : -1)
            ->filter(fn($folder) => !in_array(
                $folder->getParsedName(),
                explode(
                    '|', $this->configs['blacklist_folders'] ?? self::BLACKLIST_FOLDERS
                )
            ));

        return [
            'total' => $folders->count(),
            'entities' => $folders->toArray()
        ];
    }

    /**
     * @param ContaEmail $contaEmail
     * @param string $idenfifier
     * @return EmailClientFolder|null
     * @throws ConnectionException
     * @throws ConnectionFailedException
     * @throws FolderFetchingException
     * @throws MaskNotFoundException
     * @throws RuntimeException
     */
    public function getFolder(ContaEmail $contaEmail, string $idenfifier): ?EmailClientFolder
    {
        $folder = $this->connect($contaEmail)->getFolderByPath($idenfifier);
        return $folder ? $this->parseFolder($folder) : null;
    }

    /**
     * @param ContaEmail $contaEmail
     * @return EmailClientFolder|null
     * @throws ConnectionException
     * @throws ConnectionFailedException
     * @throws FolderFetchingException
     * @throws MaskNotFoundException
     * @throws RuntimeException
     */
    public function getInboxFolder(ContaEmail $contaEmail): ?EmailClientFolder
    {
        $inbox = $this->newConnection($contaEmail)
            ->getFolderByPath('INBOX') ?? $this->newConnection($contaEmail)
                ->getFolderByPath('Inbox');

        return $inbox ? $this->parseFolder($inbox) : null;
    }

    /**
     * @param ContaEmail $contaEmail
     * @param EmailClientFolder $folder
     * @param int $limit
     * @param int $offset
     * @param bool $withAttachments
     * @return array
     * @throws ConnectionException
     * @throws ConnectionFailedException
     * @throws GetMessagesFailedException
     * @throws MaskNotFoundException
     * @throws RuntimeException
     */
    public function getMessages(
        ContaEmail $contaEmail,
        EmailClientFolder $folder,
        int $limit = 10,
        int $offset = 0,
        bool $withAttachments = false
    ): array
    {
        $client = $this->connect($contaEmail);
        $client->openFolder($folder->getPath());

        $messages = (new WhereQuery($client))
            ->setFetchOrderDesc()
            ->leaveUnread()
            ->all();

        return [
            'total' => $messages->count(),
            'entities' => $messages
                ->paginate($limit, floor($offset/$limit))
                ->map(fn($message) => $this->parseMessage($message, $withAttachments))
                ->toArray()
        ];
    }

    /**
     * @param ContaEmail $contaEmail
     * @param array $criterias
     * @param int $limit
     * @param int $offset
     * @param bool $withAttachments
     * @return array
     *
     * @throws ConnectionException
     * @throws ConnectionFailedException
     * @throws FolderFetchingException
     * @throws GetMessagesFailedException
     * @throws MaskNotFoundException
     * @throws RuntimeException
     */
    public function searchMessages(
        ContaEmail $contaEmail,
        array $criterias,
        int $limit = 10,
        int $offset = 0,
        bool $withAttachments = false
    ): array
    {
        $client = $this->newConnection($contaEmail);

        if (empty($criterias) || !isset($criterias['folder'])) {
            $inbox = $this->getInboxFolder($contaEmail);
            $client->openFolder($inbox->getPath());
        }

        $query = (new WhereQuery($client))
            ->leaveUnread()
            ->fetchBody(false)
            ->fetchOrderDesc()
            ->all();

        $messageCriterias = $this->getMessageCriterias();

        foreach ($criterias as $operator => $value) {
            if (!array_key_exists($operator, $messageCriterias)) {
                throw new RuntimeException(sprintf('Operador %s não suportado.', $operator));
            }

            $messageCriterias[$operator]($query, $value);
        }


        return [
            'total' => $query->count(),
            'entities' => $query
                ->paginate($limit, (int) floor($offset/$limit) + 1)
                ->map(fn($message) => $this->parseMessage($message, $withAttachments))
                ->sort(function($messageA, $messageB) {
                    return $messageA->getId() === $messageB->getId() ? 0 :
                        ($messageA->getId() < $messageB->getId() ? 1 : -1);
                })
                ->toArray()
        ];
    }

    /**
     * @param ContaEmail $contaEmail
     * @param string|int $folderIdentifier
     * @param string|int $messageIdentifier
     * @param bool $withAttachments
     * @return EmailClientMessage|null
     * @throws ConnectionException
     * @throws ConnectionFailedException
     * @throws EventNotFoundException
     * @throws FolderFetchingException
     * @throws InvalidMessageDateException
     * @throws MaskNotFoundException
     * @throws MessageContentFetchingException
     * @throws MessageFlagException
     * @throws MessageHeaderFetchingException
     * @throws MessageNotFoundException
     * @throws RuntimeException
     */
    public function getMessage(
        ContaEmail $contaEmail,
        string|int $folderIdentifier,
        string|int $messageIdentifier,
        bool $withAttachments = false
    ): ?EmailClientMessage
    {
        $client = $this->newConnection($contaEmail);
        $client->openFolder(base64_decode($folderIdentifier));

        $message = (new Query($client))
            ->getMessageByMsgn($messageIdentifier);

        if ($message === null) return null;

        $message->setFlag('Seen');

        return $this->parseMessage($message, $withAttachments);
    }

    /**
     * @param ContaEmail $contaEmail
     * @param string|int $folderIdentifier
     * @param string|int $messageIdentifier
     * @return array
     * @throws ConnectionException
     * @throws ConnectionFailedException
     * @throws EventNotFoundException
     * @throws InvalidMessageDateException
     * @throws MaskNotFoundException
     * @throws MessageContentFetchingException
     * @throws MessageFlagException
     * @throws MessageHeaderFetchingException
     * @throws MessageNotFoundException
     * @throws RuntimeException
     */
    public function getAttachments(
        ContaEmail $contaEmail,
        string|int $folderIdentifier,
        string|int $messageIdentifier
    ): array
    {
        $client = $this->newConnection($contaEmail);
        $client->openFolder(base64_decode($folderIdentifier));

        $message = (new Query($client))
            ->getMessageByMsgn($messageIdentifier);

        if ($message === null) return [];

        return $message
            ->attachments()
            ->filter(
                fn($attachment) => $attachment?->disposition?->get()
                    && $attachment->disposition->first() == 'attachment'
            )
            ->map(fn($attachment) => $this->parseAttachment($attachment))
            ->toArray();
    }

    /**
     * @param ContaEmail $contaEmail
     * @param int|string $folderIdentifier
     * @param int|string $messageIdentifier
     * @param int|string $attachmentIdentifier
     * @return EmailClientAttachment|null
     * @throws ConnectionException
     * @throws ConnectionFailedException
     * @throws EventNotFoundException
     * @throws InvalidMessageDateException
     * @throws MaskNotFoundException
     * @throws MessageContentFetchingException
     * @throws MessageFlagException
     * @throws MessageHeaderFetchingException
     * @throws MessageNotFoundException
     * @throws RuntimeException
     */
    public function getAttachment(
        ContaEmail $contaEmail,
        int|string $folderIdentifier,
        int|string $messageIdentifier,
        int|string $attachmentIdentifier
    ): ?EmailClientAttachment {
        $client = $this->newConnection($contaEmail);
        $client->openFolder(base64_decode($folderIdentifier));

        $message = (new Query($client))
            ->getMessageByMsgn($messageIdentifier);

        if ($message === null) return null;

        return $message
            ->attachments()
            ->filter(
                fn($attachment) => $attachment->getId() == $attachmentIdentifier
            )
            ->map(fn($attachment) => $this->parseAttachment($attachment, true))
            ->first();
    }


    /**
     * @param ContaEmail $contaEmail
     * @return PHPIMAPClient
     * @throws MaskNotFoundException
     */
    private function getClient(ContaEmail $contaEmail): PHPIMAPClient
    {
        if (!$this->client) {
            $config = [
                'host'          => $contaEmail->getServidorEmail()->getHost(),
                'port'          => $contaEmail->getServidorEmail()->getPorta(),
                'encryption'    => mb_strtolower($contaEmail->getServidorEmail()->getMetodoEncriptacao()),
                'validate_cert' => $contaEmail->getServidorEmail()->getValidaCertificado(),
                'protocol'      => mb_strtolower($contaEmail->getServidorEmail()->getProtocolo()),
                'username'      => $contaEmail->getLogin(),
                'password'      => $contaEmail->getSenha(),
            ];
            if ($contaEmail->getMetodoAutenticacao()) {
                $config['oauth'] = mb_strtolower($contaEmail->getMetodoAutenticacao());
            }
            $cm = new PHPIMAPClientManager();
            $this->client = $cm->make($config);
        }

        return $this->client;
    }

    /**
     * @param PHPIMAPFolder $folder
     * @return EmailClientFolder
     * @throws ConnectionFailedException
     * @throws RuntimeException
     */
    private function parseFolder(PHPIMAPFolder $folder): EmailClientFolder
    {
        $folderData = $folder->examine();
        return (new EmailClientFolder())
            ->setTotalMessages($folderData ? (int) $folderData['exists'] : 0)
            ->setRecentMessages($folderData ? (int) $folderData['recent'] : 0)
//            ->setUnread($folder->messages()->whereUnseen()->fetchBody(false)->count())
            ->setHasChildren($folder->hasChildren())
            ->setUuid(base64_encode($folder->path))
            ->setPath($folder->path)
            ->setFullname($folder->name)
            ->setName($folder->name)
            ->setParsedName($this->parseFolderName($this->parseTextFromServer($folder->name)));
    }

    /**
     * @param string $folderName
     * @return string
     */
    private function parseFolderName(string $folderName): string
    {
        return match (mb_strtolower($folderName)) {
            'inbox',
                => self::FOLDER_INBOX,
            'lixo eletrônico',
            'junk'
                => self::FOLDER_SPAM,
            'itens excluídos',
            'deleted'
                => self::FOLDER_TRASH,
            'itens enviados',
            'e-mails enviados',
            'sent'
                => self::FOLDER_SENT,
            'rascunhos',
            'drafts'
                => self::FOLDER_DRAFT,
            default => $folderName
        };
    }

    /**
     * @param PHPIMAPMessage $message
     * @param bool $withAttachments
     * @return EmailClientMessage
     * @throws ConnectionFailedException
     * @throws FolderFetchingException
     * @throws RuntimeException
     */
    private function parseMessage(PHPIMAPMessage $message, bool $withAttachments = false): EmailClientMessage
    {
        return (new EmailClientMessage())
            ->setUuid((string) $message->msgn)
            ->setAttachments(array_values(
                $message
                    ->attachments()
                    ->filter(
                        fn($attachment) => $attachment?->disposition?->get()
                            && $attachment->disposition->first() == 'attachment'
                    )
                    ->map(fn($attachment) => $this->parseAttachment($attachment, $withAttachments))
                    ->toArray()
            ))
            ->setFolder($message->getFolder() ? $this->parseFolder($message->getFolder()) : null)
            ->setFrom(!$message->getFrom() ? null : $this->parseAddress($message->getFrom()->first()))
            ->setCc(
                !$message->getCc() ? [] : array_map(
                    fn($cc) => $this->parseAddress($cc),
                    array_filter($message->getCc()->get(), fn($cc) => $cc->mail !== false)
                )
            )
            ->setBcc(
                !$message->getBcc() ? [] : array_map(
                    fn($bcc) => $this->parseAddress($bcc),
                    array_filter($message->getBcc()->get(), fn($bcc) => $bcc->mail !== false)
                )
            )
            ->setTo(
                !$message->getTo() ? [] : array_map(
                    fn($to) => $this->parseAddress($to),
                    array_filter($message->getTo()->get(), fn($to) => $to->mail !== false)
                )
            )
            ->setDate($message->getDate()->first()?->toDate())
            ->setReaded($message->getFlags()->contains('Seen'))
            ->setSubject($this->parseTextFromServer($message->getSubject()->toString()))
            ->setHtmlBody(
                $message->hasHTMLBody() ?
                    $this->parseHtmlBodyImages($message)
                    : $message->getTextBody()
            );
    }

    /**
     * @param PHPIMAPMessage $message
     * @param bool $bodyImages
     * @return string|null
     */
    private function parseHtmlBodyImages(PHPIMAPMessage $message, bool $bodyImages = true): ?string
    {
        $body = $message->getHTMLBody();
        if($body === null) return null;

        if ($bodyImages) {
            $message->getAttachments()
                ->filter(fn($attachment) => $attachment->id)
                ->each(function($attachment) use (&$body) {
                    $body = str_replace('cid:'.$attachment->id,
                        $this->parseAttachmentContent($attachment),
                        $body
                    );
                });
        }

        return $body;
    }

    /**
     * @param PHPIMAPAddress $address
     * @return EmailClientAddress
     */
    private function parseAddress(PHPIMAPAddress $address): EmailClientAddress
    {
        return (new EmailClientAddress())
            ->setEmail($address->mail ?? '')
            ->setFull($this->parseTextFromServer($address->full ?: ''))
            ->setName($this->parseTextFromServer($address->personal ?: ''));
    }

    /**
     * @param string|null $text
     * @return string|null
     */
    private function parseTextFromServer(?string $text): ?string
    {
        return imap_utf8($text);
    }

    /**
     * @param string|null $text
     * @return string
     */
    private function parseTextToServer(?string $text): string
    {
        $search = [
            'à', 'á', 'â', 'ã', 'ä', 'å',
            'ç',
            'è', 'é', 'ê', 'ë',
            'ì', 'í', 'î', 'ï',
            'ñ',
            'ò', 'ó', 'ô', 'õ', 'ö',
            'ù', 'ü', 'ú',
            'ÿ',
        ];

        $replace = [
            'a', 'a', 'a', 'a', 'a', 'a',
            'c',
            'e', 'e', 'e', 'e',
            'i', 'i', 'i', 'i',
            'n',
            'o', 'o', 'o', 'o', 'o',
            'u', 'u', 'u',
            'y',
        ];

        return str_replace($search, $replace, mb_strtolower($text));
    }

    /**
     * @param PHPIMAPAttachment $attachment
     * @return EmailClientAttachment
     */
    private function parseAttachment(PHPIMAPAttachment $attachment, $content = false): EmailClientAttachment
    {
        return (new EmailClientAttachment())
            ->setUuid($attachment->id)
            ->setDisposition($attachment->getDisposition()->toString())
            ->setFileName($attachment->getName())
            ->setMimetype($attachment->getMimeType())
            ->setSize((int) $attachment->getSize())
            ->setExtension($attachment->getExtension())
            ->setContent($content ? $this->parseAttachmentContent($attachment) : null)
            ->setImgSrc($attachment->img_src);
    }

    /**
     * @param PHPIMAPAttachment $attachment
     * @return string|null
     */
    private function parseAttachmentContent(PHPIMAPAttachment $attachment): ?string
    {
        return 'data:'.$attachment->getMimeType()
            .';name='.$attachment->getName().';charset=UTF-8;base64,'.base64_encode($attachment->getContent());
    }

    /**
     * @param ContaEmail $contaEmail
     * @return PHPIMAPClient
     * @throws ConnectionException
     * @throws MaskNotFoundException
     */
    private function connect(ContaEmail $contaEmail): PHPIMAPClient
    {
        try {
            if (!$this->client || !$this->client->isConnected()) {
                return $this->getClient($contaEmail)->connect();
            }

            return $this->getClient($contaEmail);
        } catch (ConnectionFailedException $e) {
            throw new ConnectionException(message: 'Falha ao conectar na conta de e-mail.', previous: $e);
        }
    }

    /**
     * @param ContaEmail $contaEmail
     * @return PHPIMAPClient
     * @throws ConnectionException
     * @throws MaskNotFoundException
     */
    private function newConnection(ContaEmail $contaEmail): PHPIMAPClient
    {
        $this->disconnect();
        return $this->connect($contaEmail);
    }

    private function disconnect(): void
    {
        if ($this->client && $this->client->isConnected()) {
            $this->client->disconnect();
        }
        $this->client = null;
    }

    private function getFolderOrderScore(EmailClientFolder $folder): int
    {
        return match ($folder->getParsedName()) {
            self::FOLDER_INBOX
                => 0,
            self::FOLDER_SENT
                => 2,
            self::FOLDER_DRAFT
                => 3,
            self::FOLDER_SPAM
                => 4,
            self::FOLDER_TRASH
                => 5,
            default => 999
        };
    }
}
