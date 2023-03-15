<?php

declare(strict_types=1);
/**
 * /src/Command/ApiKey/ListApiKeysCommand.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Command\ApiKey;

use function array_map;
use Closure;
use function implode;
use function sprintf;
use SuppCore\AdministrativoBackend\Api\V1\Resource\ApiKeyResource;
use SuppCore\AdministrativoBackend\Entity\ApiKey;
use SuppCore\AdministrativoBackend\Entity\VinculacaoRole;
use SuppCore\AdministrativoBackend\Security\RolesService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\LogicException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Class ListApiKeysCommand.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class ListApiKeysCommand extends Command
{
    private ApiKeyResource $apiKeyResource;

    private RolesService $rolesService;

    private SymfonyStyle $io;

    /**
     * ListUsersCommand constructor.
     *
     * @param ApiKeyResource $apiKeyResource
     * @param RolesService   $rolesService
     *
     * @throws LogicException
     */
    public function __construct(ApiKeyResource $apiKeyResource, RolesService $rolesService)
    {
        parent::__construct('api-key:list');

        $this->apiKeyResource = $apiKeyResource;
        $this->rolesService = $rolesService;

        $this->setDescription('Console command to list API keys');
    }

    /** @noinspection PhpMissingParentCallCommonInspection */

    /**
     * Executes the current command.
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int|null
     */
    protected function execute(InputInterface $input, OutputInterface $output): ?int
    {
        $this->io = new SymfonyStyle($input, $output);
        $this->io->write("\033\143");

        static $headers = [
            'Id',
            'Token',
            'Description',
            'Groups',
            'Roles (inherited)',
        ];

        $this->io->title('Current API keys');
        $this->io->table($headers, $this->getRows());

        return null;
    }

    /**
     * Getter method for formatted API key rows for console table.
     *
     * @return mixed[]
     */
    private function getRows(): array
    {
        return array_map($this->getFormatterApiKey(), $this->apiKeyResource->find(null, ['token' => 'ASC']));
    }

    /**
     * Getter method for API key formatter closure. This closure will format single ApiKey entity for console
     * table.
     *
     * @return Closure
     */
    private function getFormatterApiKey(): Closure
    {
        return fn (ApiKey $apiToken): array => [
            $apiToken->getId(),
            $apiToken->getToken(),
            $apiToken->getDescription(),
            implode(",\n", $apiToken->getVinculacoesRoles()->map($this->getFormatterVinculacaoRole())->toArray()),
            implode(",\n", $this->rolesService->getInheritedRoles($apiToken->getRoles())),
        ];
    }

    /**
     * Getter method for user group formatter closure. This closure will format single VinculacaoRole entity for console
     * table.
     *
     * @return Closure
     */
    private function getFormatterVinculacaoRole(): Closure
    {
        return fn (VinculacaoRole $vinculacaoRole): string => sprintf(
            '%s (%s)',
            $vinculacaoRole->getName(),
            $vinculacaoRole->getRole()
        );
    }
}
