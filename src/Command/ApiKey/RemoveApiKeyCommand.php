<?php

declare(strict_types=1);
/**
 * /src/Command/ApiKey/RemoveApiKeyCommand.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Command\ApiKey;

use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\Exception\ORMException;
use SuppCore\AdministrativoBackend\Api\V1\Resource\ApiKeyResource;
use SuppCore\AdministrativoBackend\Command\Traits\SymfonyStyleTrait;
use SuppCore\AdministrativoBackend\Entity\ApiKey as ApiKeyEntity;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\LogicException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class RemoveApiKeyCommand.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class RemoveApiKeyCommand extends Command
{
    // Traits
    use SymfonyStyleTrait;

    private ApiKeyResource $apiKeyResource;

    private ApiKeyHelper $apiKeyHelper;

    /**
     * RemoveApiKeyCommand constructor.
     *
     * @param ApiKeyResource $apiKeyResource
     * @param ApiKeyHelper   $apiKeyHelper
     *
     * @throws LogicException
     */
    public function __construct(ApiKeyResource $apiKeyResource, ApiKeyHelper $apiKeyHelper)
    {
        parent::__construct('api-key:remove');

        $this->apiKeyResource = $apiKeyResource;
        $this->apiKeyHelper = $apiKeyHelper;

        $this->setDescription('Console command to remove existing API key');
    }

    /** @noinspection PhpMissingParentCallCommonInspection */

    /**
     * Executes the current command.
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int|null
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    protected function execute(InputInterface $input, OutputInterface $output): ?int
    {
        $io = $this->getSymfonyStyle($input, $output);

        // Get API key entity
        $apiKey = $this->apiKeyHelper->getApiKey($io, 'Which API key you want to remove?');

        if ($apiKey instanceof ApiKeyEntity) {
            // Delete API key
            $this->apiKeyResource->delete($apiKey->getId());

            $message = $this->apiKeyHelper->getApiKeyMessage('API key deleted - have a nice day', $apiKey);
        }

        if ($input->isInteractive()) {
            $io->success($message ?? 'Nothing changed - have a nice day');
        }

        return null;
    }
}
