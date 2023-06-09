<?php

declare(strict_types=1);
/**
 * /src/Command/ApiKey/EditApiKeyCommand.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Command\ApiKey;

use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\Exception\ORMException;
use SuppCore\AdministrativoBackend\Api\V1\Resource\ApiKeyResource;
use SuppCore\AdministrativoBackend\Command\Traits\SymfonyStyleTrait;
use SuppCore\AdministrativoBackend\DTO\ApiKey as ApiKeyDto;
use SuppCore\AdministrativoBackend\Entity\ApiKey as ApiKeyEntity;
use SuppCore\AdministrativoBackend\Form\Type\Console\ApiKeyType;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Exception\LogicException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class EditApiKeyCommand.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class EditApiKeyCommand extends Command
{
    // Traits
    use SymfonyStyleTrait;

    private ApiKeyResource $apiKeyResource;

    private ApiKeyHelper $apiKeyHelper;

    /**
     * EditUserCommand constructor.
     *
     * @param ApiKeyResource $apiKeyResource
     * @param ApiKeyHelper   $apiKeyHelper
     *
     * @throws LogicException
     */
    public function __construct(ApiKeyResource $apiKeyResource, ApiKeyHelper $apiKeyHelper)
    {
        parent::__construct('api-key:edit');

        $this->apiKeyResource = $apiKeyResource;
        $this->apiKeyHelper = $apiKeyHelper;

        $this->setDescription('Command to edit existing API key');
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
     * @throws LogicException
     * @throws InvalidArgumentException
     */
    protected function execute(InputInterface $input, OutputInterface $output): ?int
    {
        $io = $this->getSymfonyStyle($input, $output);

        // Get API key entity
        $apiKey = $this->apiKeyHelper->getApiKey($io, 'Which API key you want to edit?');

        if ($apiKey instanceof ApiKeyEntity) {
            $message = $this->updateApiKey($input, $output, $apiKey);
        }

        if ($input->isInteractive()) {
            $io->success($message ?? 'Nothing changed - have a nice day');
        }

        return null;
    }

    /**
     * Method to update specified API key via specified form.
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     * @param ApiKeyEntity    $apiKey
     *
     * @return mixed[]
     *
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws LogicException
     * @throws InvalidArgumentException
     */
    private function updateApiKey(InputInterface $input, OutputInterface $output, ApiKeyEntity $apiKey): array
    {
        // Load entity to DTO
        $dtoLoaded = new ApiKeyDto();
        $dtoLoaded->load($apiKey);

        /** @var ApiKeyDto $dtoEdit */
        $dtoEdit = $this->getHelper('form')->interactUsingForm(
            ApiKeyType::class,
            $input,
            $output,
            ['data' => $dtoLoaded]
        );

        // Update API key
        $this->apiKeyResource->update($apiKey->getId(), $dtoEdit);

        return $this->apiKeyHelper->getApiKeyMessage('API key updated - have a nice day', $apiKey);
    }
}
