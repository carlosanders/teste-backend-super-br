<?php

declare(strict_types=1);
/**
 * /src/Command/ApiKey/ApiKeyManagementCommand.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Command\ApiKey;

use SuppCore\AdministrativoBackend\Command\Traits\ExecuteMultipleCommandTrait;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\LogicException;

/**
 * Class ApiKeyManagementCommand.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class ApiKeyManagementCommand extends Command
{
    // Traits
    use ExecuteMultipleCommandTrait;

    /**
     * ManagementCommand constructor.
     *
     * @throws LogicException
     */
    public function __construct()
    {
        parent::__construct('api-key:management');

        $this->setDescription('Console command to manage API keys');

        $this->setChoices([
            'api-key:list' => 'List API keys',
            'api-key:create' => 'Create API key',
            'api-key:edit' => 'Edit API key',
            'api-key:change-token' => 'Change API key token',
            'api-key:remove' => 'Remove API key',
            false => 'Exit',
        ]);
    }
}
