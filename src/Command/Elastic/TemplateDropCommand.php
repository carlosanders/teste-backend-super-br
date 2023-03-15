<?php

declare(strict_types=1);

namespace SuppCore\AdministrativoBackend\Command\Elastic;

use ONGR\ElasticsearchBundle\Command\AbstractIndexServiceAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Class TemplateDropCommand.
 */
class TemplateDropCommand extends AbstractIndexServiceAwareCommand
{
    const NAME = 'ongr:es:template:drop';

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        parent::configure();

        $this
            ->setName(self::NAME)
            ->setDescription('Drop the ElasticSearch template.');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $index = $this->getIndex($input->getOption(parent::INDEX_OPTION));
        $indexName = $index->getIndexName();

        $index->getClient()->indices()->deleteTemplate(['name' => $indexName]);

        $io->text(
            sprintf(
                'Dropped `<comment>%s</comment>` template.',
                $index->getIndexName()
            )
        );

        return 0;
    }
}
