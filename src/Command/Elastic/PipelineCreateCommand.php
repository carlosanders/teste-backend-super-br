<?php

declare(strict_types=1);

namespace SuppCore\AdministrativoBackend\Command\Elastic;

use ONGR\ElasticsearchBundle\Command\AbstractIndexServiceAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Class PipelineCreateCommand.
 */
class PipelineCreateCommand extends AbstractIndexServiceAwareCommand
{
    public const NAME = 'ongr:es:pipeline:create';

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        parent::configure();

        $this
            ->setName(self::NAME)
            ->setDescription('Creates a ElasticSearch pipeline.');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $index = $this->getIndex($input->getOption(parent::INDEX_OPTION));
        $client = $index->getClient();

        $params = [
            'id' => 'attachment_componente_digital_conteudo',
            'body' => [
                'description' => 'Extract attachment information',
                'processors' => [
                    [
                        'attachment' => [
                            'field' => 'conteudo',
                            'indexed_chars' => -1,
                            'ignore_missing' => true,
                        ],
                    ],
                ],
            ],
        ];

        $result = $client->ingest()->putPipeline($params);

        if (isset($result['acknowledged']) && $result['acknowledged']) {
            $io->text(
                sprintf(
                    'Created `<comment>%s</comment>` pipeline.',
                    'attachment_componente_digital_conteudo'
                )
            );
        }

        $params = [
            'id' => 'attachment_documento_componentes_digitais_conteudo',
            'body' => [
                'description' => 'Extract attachment information',
                'processors' => [
                    [
                        'foreach' => [
                            'field' => 'documento',
                            'processor' => [
                                'foreach' => [
                                    'field' => '_ingest._value.componentes_digitais',
                                    'processor' => [
                                        'attachment' => [
                                            'field' => '_ingest._value.conteudo',
                                            'indexed_chars' => -1,
                                            'ignore_missing' => true,
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];

        $result = $client->ingest()->putPipeline($params);

        if (isset($result['acknowledged']) && $result['acknowledged']) {
            $io->text(
                sprintf(
                    'Created `<comment>%s</comment>` pipeline.',
                    'attachment_documento_componentes_digitais_conteudo'
                )
            );
        }

        return 0;
    }
}
