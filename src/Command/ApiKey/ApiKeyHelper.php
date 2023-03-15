<?php

declare(strict_types=1);
/**
 * /src/Command/ApiKey/ApiKeyHelper.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Command\ApiKey;

use function array_map;
use Closure;
use function implode;
use function sprintf;
use SuppCore\AdministrativoBackend\Api\V1\Resource\ApiKeyResource;
use SuppCore\AdministrativoBackend\Entity\ApiKey as ApiKeyEntity;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Security\RolesService;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Class ApiKeyHelper.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class ApiKeyHelper
{
    private ApiKeyResource $apiKeyResource;

    private RolesService $rolesService;

    /**
     * ApiKeyHelper constructor.
     *
     * @param ApiKeyResource $apiKeyResource
     * @param RolesService   $rolesService
     */
    public function __construct(ApiKeyResource $apiKeyResource, RolesService $rolesService)
    {
        $this->apiKeyResource = $apiKeyResource;
        $this->rolesService = $rolesService;
    }

    /**
     * Method to get API key entity. Also note that this may return a null in cases that user do not want to make any
     * changes to API keys.
     *
     * @param SymfonyStyle $io
     * @param string       $question
     *
     * @return ApiKeyEntity|null
     */
    public function getApiKey(SymfonyStyle $io, string $question): ?ApiKeyEntity
    {
        $apiKeyFound = false;

        while (true !== $apiKeyFound) {
            /** @var ApiKeyEntity|null $apiKeyEntity */
            $apiKeyEntity = $this->getApiKeyEntity($io, $question);

            if (null === $apiKeyEntity) {
                break;
            }

            $message = sprintf(
                'Is this the correct API key \'[%s] [%s] %s\'?',
                $apiKeyEntity->getId(),
                $apiKeyEntity->getToken(),
                $apiKeyEntity->getDescription()
            );

            $apiKeyFound = (bool) $io->confirm($message, false);
        }

        return $apiKeyEntity ?? null;
    }

    /**
     * Helper method to get "normalized" message for API key. This is used on following cases:
     *  - User changes API key token
     *  - User creates new API key
     *  - User modifies API key
     *  - User removes API key.
     *
     * @param string       $message
     * @param ApiKeyEntity $apiKey
     *
     * @return mixed[]
     */
    public function getApiKeyMessage(string $message, ApiKeyEntity $apiKey): array
    {
        return [
            $message,
            sprintf(
                "GUID:  %s\nToken: %s",
                $apiKey->getId(),
                $apiKey->getToken()
            ),
        ];
    }

    /**
     * Method to list ApiKeys where user can select desired one.
     *
     * @param SymfonyStyle $io
     * @param string       $question
     *
     * @return ApiKeyEntity|EntityInterface|null
     */
    private function getApiKeyEntity(SymfonyStyle $io, string $question): ?EntityInterface
    {
        $choices = [];
        $iterator = $this->getApiKeyIterator($choices);

        array_map($iterator, $this->apiKeyResource->find([], ['token' => 'ASC']));

        $choices['Exit'] = 'Exit command';

        return $this->apiKeyResource->findOne($io->choice($question, $choices));
    }

    /**
     * Method to return ApiKeyIterator closure. This will format ApiKey entities for choice list.
     *
     * @param string[] $choices
     *
     * @return Closure
     */
    private function getApiKeyIterator(array &$choices): Closure
    {
        /*
         * Lambda function create api key choices
         *
         * @param ApiKeyEntity $apiKey
         */
        return function (ApiKeyEntity $apiKey) use (&$choices): void {
            $value = sprintf(
                '[%s] %s - Roles: %s',
                $apiKey->getToken(),
                $apiKey->getDescription(),
                implode(', ', $this->rolesService->getUserRolesNames($apiKey))
            );

            $choices[$apiKey->getId()] = $value;
        };
    }
}
