<?php

declare(strict_types=1);

namespace SuppCore\AdministrativoBackend\Command\Elastic;

use ONGR\ElasticsearchBundle\Command\AbstractIndexServiceAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

/**
 * Class DenseVectorCreateCommand.
 */
class DenseVectorCreateCommand extends AbstractIndexServiceAwareCommand
{
    public const NAME = 'ongr:es:densevector:create';

    /**
     * @param ParameterBagInterface $parameterBag
     */
    public function __construct(
        private ContainerInterface $container,
        private ParameterBagInterface $parameterBag
    ) {
        parent::__construct($container);
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        parent::configure();

        $this
            ->setName(self::NAME)
            ->setDescription('Update a ElasticSearch index do add dense vector mapping.');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $index = $this->getIndex($input->getOption(parent::INDEX_OPTION));
        $client = $index->getClient();

        $params = ['index' => $index->getIndexName()];
        $mapping = $client->indices()->getMapping($params);
        $properties = $mapping[$index->getIndexName()]['mappings']['properties'];
        $vector = 'knn_vector';
        $rootDim = 'dimension';
        if ('prod' === $this->parameterBag->get('kernel.environment')) {
            $vector = 'dense_vector';
            $rootDim = 'dims';
        }

        $properties['dense_vector'] = [
            'type' => $vector,
            $rootDim => 768,
        ];

        $params = [
            'index' => $index->getIndexName(),
            'body' => [
                '_source' => [
                    'enabled' => true,
                ],
                'properties' => $properties,
            ],
        ];

        $result = $client->indices()->putMapping($params);

        if (isset($result['acknowledged']) && $result['acknowledged']) {
            $io->text(
                sprintf(
                    'Created `<comment>%s</comment>` mapping.',
                    'dense_vector'
                )
            );
        }

        return 0;
    }
}
