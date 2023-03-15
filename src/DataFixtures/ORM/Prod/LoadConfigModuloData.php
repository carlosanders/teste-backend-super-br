<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Prod/LoadConfigModuloData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Prod;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\ConfigModulo;
use SuppCore\AdministrativoBackend\Entity\Processo;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadConfigModuloData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadConfigModuloData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
{
    private ContainerInterface $container;

    private ObjectManager $manager;

    /**
     * Setter for container.
     *
     * @param ContainerInterface|null $container
     */
    public function setContainer(?ContainerInterface $container = null): void
    {
        if (null !== $container) {
            $this->container = $container;
        }
    }

    /**
     * @param ObjectManager $manager
     *
     * @throws Exception
     */
    public function load(ObjectManager $manager): void
    {
        $this->manager = $manager;

        $configModulo = $manager
            ->createQuery(
                "
                SELECT c 
                FROM SuppCore\AdministrativoBackend\Entity\ConfigModulo c 
                WHERE c.nome = 'supp_core.administrativo_backend.gerador_dossie.template'"
            )
            ->getOneOrNullResult() ?: new ConfigModulo();
        $configModulo->setModulo($this->getReference('Modulo-ADMINISTRATIVO'));
        $configModulo->setNome('supp_core.administrativo_backend.gerador_dossie.template');
        $configModulo->setDescricao('CONFIGURAÇÕES RELATIVAS À GERAÇÃO DE DOSSIÊS');
        $configModulo->setInvalid(false);
        $configModulo->setMandatory(false);
        $configModulo->setDataType('json');
        $configModulo->setDataSchema(
            json_encode([
                '$schema'   => 'http://json-schema.org/draft-07/schema#',
                '$id'       => 'supp_core.administrativo_backend.gerador_dossie.template',
                '$comment'  => 'Template para geração de um dossie.',
                'title'     => 'Template para geração de um dossie.',
                'type'      => 'array',
                'minItems'  => 1,
                'items'     => [
                    '$comment' => 'Parâmetros de configuração de utilização de um dossiê da defesa digital.',
                    'type' => 'object',
                    'additionalProperties' => false,
                    'required' => [
                        0 => 'nome_tipo_dossie',
                        1 => 'ativo',
                        2 => 'assuntos_suportados',
                        3 => 'siglas_unidades_suportadas',
                        4 => 'tarefas_suportadas',
                        5 => 'pesquisa_assunto_pai',
                        6 => 'template',
                    ],
                    'properties' => [
                        'nome_tipo_dossie' => [
                            '$comment' => '',
                            'type' => 'string',
                            'minLength' => 1,
                        ],
                        'ativo' => [
                            '$comment' => '',
                            'type' => 'boolean',
                            'default' => true,
                        ],
                        'num_max_interessados' => [
                            '$comment' => '',
                            'type' => 'integer'
                        ],
                        'assuntos_suportados' => [
                            '$comment' => '',
                            'type' => 'array',
                            'items' => [
                                'type' => 'string'
                            ],
                            'default' => [
                                0 => '*',
                            ],
                            'examples' => [
                                0 => [
                                    0 => 'MILITAR',
                                    1 => 'SERVIDOR PÚBLICO CIVIL',
                                ],
                            ],
                        ],
                        'siglas_unidades_suportadas' => [
                            '$comment' => '',
                            'type' => 'array',
                            'items' => [
                                'type' => 'string'
                            ],
                            'default' => [
                                0 => '*',
                            ],
                            'examples' => [
                                0 => [
                                    0 => 'AGU-SEDE',
                                    1 => 'PGF-SEDE',
                                ],
                            ],
                        ],
                        'tarefas_suportadas' => [
                            '$comment' => '',
                            'type' => 'array',
                            'items' => [
                                'type' => 'string'
                            ],
                            'default' => [
                                0 => '*',
                            ],
                            'examples' => [
                                0 => [
                                    0 => 'ADOTAR PROVIDÊNCIAS ADMINISTRATIVAS',
                                    1 => 'ANALISAR DEMANDAS',
                                ],
                            ],
                        ],
                        'pesquisa_assunto_pai' => [
                            '$comment' => '',
                            'type' => 'boolean',
                            'default' => true,
                        ],
                        'template' => [
                            '$comment' => '',
                            'type' => 'string',
                            'minLength' => 1,
                        ],
                    ],
                ],
            ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
        );
        $this->manager->persist($configModulo);
        $this->addReference(
            'ConfigModulo-'.$configModulo->getNome(),
            $configModulo
        );

        $configModulo = $manager
            ->createQuery(
                "
                SELECT c 
                FROM SuppCore\AdministrativoBackend\Entity\ConfigModulo c 
                WHERE c.nome = 'supp_core.administrativo_backend.processo.template'"
            )
            ->getOneOrNullResult() ?: new ConfigModulo();
        $configModulo->setModulo($this->getReference('Modulo-ADMINISTRATIVO'));
        $configModulo->setNome('supp_core.administrativo_backend.processo.template');
        $configModulo->setDescricao('TEMPLATE PARA CRIAÇÃO DE PROCESSO');
        $configModulo->setInvalid(false);
        $configModulo->setMandatory(false);
        $configModulo->setDataType('json');
        $configModulo->setDataSchema(
            json_encode([
                '$schema'   => 'http://json-schema.org/draft-07/schema#',
                '$id'       => 'supp_core.administrativo_backend.processo.template',
                '$comment'  => 'Template para criação de um processo.',
                'title'     => 'Template para criação de um processo.',
                'type'      => 'object',
                'additionalProperties' => false,
                'properties' => [
                    'nup' => [
                        '$comment' => 'Caso não seja informado, será cadastrado como novo tipo de processo',
                        'type' => 'string',
                        'pattern' => '$([0-9]{17})|([0-9]{21})^',
                        'example' => [
                            '00400000020201813'
                        ],
                    ],
                    'unidade_arquivistica' => [
                        '$comment' => 'Indica se o processo surgirá como processo ou como documento avulso.',
                        'type' => 'integer',
                        'example' => [
                            Processo::UA_PROCESSO
                        ],
                        'default' => Processo::UA_PROCESSO
                    ],
                    'cpf_cnpj_procedencia' => [
                        '$comment' => 'CPF ou CNPJ da pessoa de procedência.',
                        'type' => 'string',
                        'pattern' => '$([0-9]{11})|([0-9]{14})^',
                        'example' => [
                            '23298001856',
                            '33415411000105'
                        ]
                    ],
                    'nome_especie_processo' => [
                        '$comment' => 'Nome da espécie de processo',
                        'type' => 'string',
                        'minLength' => 1,
                        'example' => 'ADMINISTRATIVO COMUM',
                    ],
                    'nome_genero_processo' => [
                        '$comment' => 'Nome do gênero de processo',
                        'type' => 'string',
                        'minLength' => 1,
                        'example' => 'ADMINISTRATIVO',
                    ],
                    'codigo_classificacao' => [
                        '$comment' => 'Código da classificação',
                        'type' => 'string',
                        'minLength' => 1,
                        'example' => '060.1',
                    ],
                    'valor_modalidade_interessado_ativo' => [
                        '$comment' => '',
                        'type' => 'string',
                        'minLength' => 1,
                        'example' => [
                            'REQUERENTE (PÓLO ATIVO)'
                        ],
                    ],
                    'valor_modalidade_interessado_passivo' => [
                        '$comment' => '',
                        'type' => 'string',
                        'minLength' => 1,
                        'example' => [
                            'REQUERIDO (PÓLO PASSIVO)'
                        ],
                    ],
                    'assunto_administrativo' => [
                        '$comment' => '',
                        'type' => 'object',
                        'additionalProperties' => false,
                        'properties' => [
                            'nome' => [
                                '$comment' => '',
                                'type' => 'string',
                                'minLength' => 1,
                                'example' => ['DOSSIÊ DE GESTÃO DEVEDOR'],
                            ],
                            'codigo_cnj' => [
                                '$comment' => '',
                                'type' => 'string',
                                'minLength' => 1,
                                'example' => ['5989'],
                            ]
                        ],
                    ],
                    'valor_modalidade_meio' => [
                        '$comment' => '',
                        'type' => 'string',
                        'minLength' => 1,
                        'example' => [
                            'HÍBRIDO',
                            'ELETRÔNICO'
                        ],
                    ],
                    'prefixo_titulo' => [
                        '$comment' => '',
                        'type' => 'string',
                        'minLength' => 1,
                        'example' => [
                            'DOSSIÊ DO PROCESSO JUDICIAL'
                        ],
                    ],
                    'id_setor_atual' => [
                        '$comment' => '',
                        'type' => 'integer',
                        'example' => [
                            10
                        ],
                    ],
                ],
                'required' => [],
            ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
        );
        $this->manager->persist($configModulo);
        $this->addReference(
            'ConfigModulo-'.$configModulo->getNome(),
            $configModulo
        );

        $configModulo = $manager
            ->createQuery(
                "
                SELECT c 
                FROM SuppCore\AdministrativoBackend\Entity\ConfigModulo c 
                WHERE c.nome = 'supp_core.administrativo_backend.parametros.template'"
            )
            ->getOneOrNullResult() ?: new ConfigModulo();
        $configModulo->setModulo($this->getReference('Modulo-ADMINISTRATIVO'));
        $configModulo->setNome('supp_core.administrativo_backend.parametros.template');
        $configModulo->setDescricao('TEMPLATE PARA CRIAÇÃO DE CONFIGURAÇÕES');
        $configModulo->setInvalid(false);
        $configModulo->setMandatory(false);
        $configModulo->setDataType('json');
        $configModulo->setDataSchema(
            json_encode(
                [
                    '$schema' => 'http://json-schema.org/draft-07/schema#',
                    '$id' => 'supp_core.administrativo_backend.parametros.template',
                    '$comment' => 'Template para criação de configurações ',
                    'title' => 'Template para criação de configurações',
                    'type' => 'array',
                    'items' => [
                        '$comment' => '',
                        'type' => 'object',
                        'additionalProperties' => false,
                        'required' => [
                            'chave',
                            'valor',
                        ],
                        'properties' => [
                            'chave' => [
                                '$comment' => 'Chave',
                                'type' => 'string',
                                'example' => 'tamanho_lote_execucao',
                            ],
                            'valor' => [
                                '$comment' => 'Valor',
                                'type' => 'string',
                                'example' => '100',
                            ],
                            'valor_modalidade_orgao_central' => [
                                '$comment' => 'Valor modalidade órgão central',
                                'type' => 'string',
                                'example' => 'PGF',
                            ],
                        ],
                    ],
                ],
                JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
            )
        );
        $this->manager->persist($configModulo);
        $this->addReference('ConfigModulo-'.$configModulo->getNome(), $configModulo);
        $configModulo = new ConfigModulo();
        $configModulo->setModulo($this->getReference('Modulo-ADMINISTRATIVO'));
        $configModulo->setNome('supp_core.administrativo_backend.datalake.kafka.enabled');
        $configModulo->setDescricao('SERVIÇO DE TÓPICOS KAFKA');
        $configModulo->setInvalid(false);
        $configModulo->setMandatory(true);
        $configModulo->setDataType('bool');
        $configModulo->setDataSchema(null);
        $configModulo->setDataValue('false');
        $this->manager->persist($configModulo);
        $this->addReference('ConfigModulo-'.$configModulo->getNome(), $configModulo);


        $configModulo = new ConfigModulo();
        $configModulo->setModulo($this->getReference('Modulo-ADMINISTRATIVO'));
        $configModulo->setNome('supp_core.administrativo_backend.datalake.kafka.config');
        $configModulo->setDescricao('CONFIGURAÇÃO DO SERVIÇO DE TÓPICOS KAFKA, SE EXISTENTE');
        $configModulo->setInvalid(false);
        $configModulo->setMandatory(false);
        $configModulo->setDataType('json');
        $configModulo->setDataSchema(
            json_encode(
                [
                    '$schema' => 'http://json-schema.org/draft-07/schema#',
                    '$id' => 'supp_core.administrativo_backend.datalake.kafka',
                    '$comment' => 'Configuração do Datalake, se existente na infraestrutura',
                    'title' => 'Configuração do Datalake',
                    'type' => 'object',
                    'required' => [
                        'server',
                        'username',
                        'password',
                    ],
                    'properties' => [
                        'server' => [
                            '$comment' => 'Nome do servidor (DNS)  que hospeda o datalake',
                            'type' => 'string',
                            'examples' => ['datalake.org'],
                        ],
                        'username' => [
                            '$comment' => 'Nome do usuário de acesso ao datalake',
                            'type' => 'string',
                            'examples' => ['username'],
                        ],
                        'password' => [
                            '$comment' => 'Senha do usuário de acesso ao datalake',
                            'type' => 'string',
                            'examples' => ['mypassword'],
                        ],
                        'group' => [
                            '$comment' => 'Senha do usuário de acesso ao datalake',
                            'type' => 'string',
                            'examples' => ['mypassword'],
                        ],
                        'url' => [
                            '$comment' => 'URL de acesso ao datalake',
                            'type' => 'string',
                            'examples' => ['/topics'],
                        ],
                        'ativo' => [
                            '$comment' => 'Configuração está ativa',
                            'type' => 'boolean',
                            'examples' => [true],
                        ],

                    ],
                ],
                JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
            )
        );
        $configModulo->setDataValue(
            json_encode(
                [
                    'server'    => $_ENV['DATALAKE_SERVER'] ?? "",
                    'username'  => $_ENV['DATALAKE_USER'] ?? "",
                    'password'  => $_ENV['DATALAKE_PASS'] ?? "",
                    'url'       => '/topics',
                    'ativo'     => boolval($_ENV['DATALAKE_SERVER']?? false)
                ],
                JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
            )
        );
        $this->manager->persist($configModulo);
        $this->addReference('ConfigModulo-'.$configModulo->getNome(), $configModulo);

        // Flush database changes
        $this->manager->flush();
    }

    /**
     * Get the order of this fixture.
     *
     * @return int
     */
    public function getOrder(): int
    {
        return 10012;
    }

    /**
     * This method must return an array of groups
     * on which the implementing class belongs to.
     *
     * @return string[]
     */
    public static function getGroups(): array
    {
        return [
            'prod', 'dev', 'test', 'prod-config-modulo',
            'config-modulo-administrativo-prod',
            'config-modulo-administrativo-hom',
            'config-modulo-administrativo-dev'
        ];
    }
}
