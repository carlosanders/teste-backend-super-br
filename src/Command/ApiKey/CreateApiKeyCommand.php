<?php

declare(strict_types=1);
/**
 * /src/Command/ApiKey/CreateApiKeyCommand.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Command\ApiKey;

use Doctrine\ORM\NonUniqueResultException;
use Exception;
use InvalidArgumentException;
use SuppCore\AdministrativoBackend\Api\V1\Resource\ApiKeyResource;
use SuppCore\AdministrativoBackend\Api\V1\Resource\VinculacaoRoleResource;
use SuppCore\AdministrativoBackend\Command\HelperConfigure;
use SuppCore\AdministrativoBackend\Command\Traits\ApiKeyUserManagementHelperTrait;
use SuppCore\AdministrativoBackend\DTO\ApiKey;
use SuppCore\AdministrativoBackend\Entity\ApiKey as ApiKeyEntity;
use SuppCore\AdministrativoBackend\Form\Type\Console\ApiKeyType;
use SuppCore\AdministrativoBackend\Security\RolesService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\CommandNotFoundException;
use Symfony\Component\Console\Exception\LogicException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Class CreateApiKeyCommand.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class CreateApiKeyCommand extends Command
{
    // Traits
    use ApiKeyUserManagementHelperTrait;

    /**
     * @var mixed[]
     */
    private static array $commandParameters = [
        [
            'name' => 'description',
            'description' => 'Description',
        ],
    ];

    private ApiKeyHelper $apiKeyHelper;

    private ApiKeyResource $apiKeyResource;

    private VinculacaoRoleResource $vinculacaoRoleResource;

    private RolesService $rolesService;

    private SymfonyStyle $io;

    /**
     * CreateApiKeyCommand constructor.
     *
     * @param ApiKeyHelper           $apiKeyHelper
     * @param ApiKeyResource         $apiKeyResource
     * @param VinculacaoRoleResource $vinculacaoRoleResource
     * @param RolesService           $rolesService
     *
     * @throws LogicException
     */
    public function __construct(
        ApiKeyHelper $apiKeyHelper,
        ApiKeyResource $apiKeyResource,
        VinculacaoRoleResource $vinculacaoRoleResource,
        RolesService $rolesService
    ) {
        parent::__construct('api-key:create');

        $this->apiKeyHelper = $apiKeyHelper;
        $this->apiKeyResource = $apiKeyResource;
        $this->vinculacaoRoleResource = $vinculacaoRoleResource;
        $this->rolesService = $rolesService;

        $this->setDescription('Command to create new API key');
    }

    /**
     * Getter for RolesService.
     *
     * @return RolesService
     */
    public function getRolesService(): RolesService
    {
        return $this->rolesService;
    }

    /**
     * Configures the current command.
     *
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    protected function configure(): void
    {
        HelperConfigure::configure($this, self::$commandParameters);
    }

    /** @noinspection PhpMissingParentCallCommonInspection */

    /**
     * Executes the current command.
     *
     * @param InputInterface  $input  An InputInterface instance
     * @param OutputInterface $output An OutputInterface instance
     *
     * @return int|null null or 0 if everything went fine, or an error code
     *
     * @throws Exception
     * @throws InvalidArgumentException
     * @throws NonUniqueResultException
     * @throws CommandNotFoundException
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     * @throws LogicException
     */
    protected function execute(InputInterface $input, OutputInterface $output): ?int
    {
        $this->io = new SymfonyStyle($input, $output);
        $this->io->write("\033\143");

        // Check that user group(s) exists
        $this->checkVinculacoesRoles($output, $input->isInteractive());

        /** @var ApiKey $dto */
        $dto = $this->getHelper('form')->interactUsingForm(ApiKeyType::class, $input, $output);

        // Create new API key
        /** @var ApiKeyEntity $apiKey */
        $apiKey = $this->apiKeyResource->create($dto);

        if ($input->isInteractive()) {
            $this->io->success($this->apiKeyHelper->getApiKeyMessage('API key created - have a nice day', $apiKey));
        }

        return null;
    }

    /**
     * Method to check if database contains user groups, if non exists method will run 'user:create-group' command
     * to create those automatically according to '$this->roles->getRoles()' output. Basically this will automatically
     * create user groups for each role that is defined to application.
     *
     * Also note that if groups are not found method will reset application 'role' table content, so that we can be
     * sure that we can create all groups correctly.
     *
     * @param OutputInterface $output
     * @param bool            $interactive
     *
     * @throws Exception
     * @throws InvalidArgumentException
     * @throws NonUniqueResultException
     * @throws CommandNotFoundException
     */
    private function checkVinculacoesRoles(OutputInterface $output, bool $interactive): void
    {
        if (0 !== $this->vinculacaoRoleResource->count()) {
            return;
        }

        if ($interactive) {
            $this->io->block(['User groups are not yet created, creating those now...']);
        }

        // Create user groups for each roles
        $this->createVinculacoesRoles($output);
    }
}
