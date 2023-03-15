<?php

declare(strict_types=1);

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\ProdExec;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\TipoValidacaoWorkflow;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadTipoValidacaoWorkflowData.
 */
class LoadTipoValidacaoWorkflowData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $data = [
            [
                'valor' => 'TIPO DE DOCUMENTO',
                'descricao' => 'TIPO DE DOCUMENTO',
                'sigla' => 'TIPO_DOC',
            ],
            [
                'valor' => 'SETOR DE ORIGEM',
                'descricao' => 'SETOR DE ORIGEM',
                'sigla' => 'SETOR_ORG',
            ],
            [
                'valor' => 'CRIADO POR',
                'descricao' => 'CRIADO POR',
                'sigla' => 'CRIADO_POR',
            ],
            [
                'valor' => 'ATRIBUIDO PARA',
                'descricao' => 'ATRIBUIDO PARA',
                'sigla' => 'ATR_PARA',
            ],
            [
                'valor' => 'UNIDADE',
                'descricao' => 'UNIDADE',
                'sigla' => 'UNIDADE',
            ],
        ];

        foreach ($data as $item) {
            $tipoAcaoWorkflow = (new TipoValidacaoWorkflow())
                ->setValor($item['valor'])
                ->setDescricao($item['descricao'])
                ->setSigla($item['sigla'])
                ->setAtivo(true);

            $this->manager->persist($tipoAcaoWorkflow);

            $this->addReference(
                'TipoAcaoWorkflow-'.$tipoAcaoWorkflow->getValor(),
                $tipoAcaoWorkflow
            );
        }

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
        return 4;
    }

    /**
     * This method must return an array of groups
     * on which the implementing class belongs to.
     *
     * @return string[]
     */
    public static function getGroups(): array
    {
        return ['prodexec'];
    }
}
