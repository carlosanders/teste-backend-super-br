<?php

declare(strict_types=1);
/**
 * /src/Command/Traits/ExecuteMultipleCommandTrait.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Command\Traits;

use function array_flip;
use function array_search;
use function array_values;
use Exception;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Exception\CommandNotFoundException;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Trait ExecuteMultipleCommandTrait.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @method Application getApplication()
 */
trait ExecuteMultipleCommandTrait
{
    /**
     * @var mixed[]
     */
    private array $choices = [];

    private SymfonyStyle $io;

    /**
     * Setter method for choices to use.
     *
     * @param mixed[] $choices
     */
    protected function setChoices(array $choices): void
    {
        $this->choices = $choices;
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
     * @throws Exception
     * @throws CommandNotFoundException
     */
    protected function execute(InputInterface $input, OutputInterface $output): ?int
    {
        $this->io = new SymfonyStyle($input, $output);
        $this->io->write("\033\143");

        while ($command = $this->ask()) {
            $arguments = [
                'command' => $command,
            ];

            $input = new ArrayInput($arguments);

            $cmd = $this->getApplication()->find((string) $command);
            $cmd->run($input, $output);
        }

        if ($input->isInteractive()) {
            $this->io->success('Have a nice day');
        }

        return null;
    }

    /**
     * Method to ask user to make choose one of defined choices.
     *
     * @return string|bool
     */
    private function ask()
    {
        $index = array_search(
            $this->io->choice('What you want to do', array_values($this->choices)),
            array_values($this->choices),
            true
        );

        return array_values(array_flip($this->choices))[(int) $index];
    }
}
