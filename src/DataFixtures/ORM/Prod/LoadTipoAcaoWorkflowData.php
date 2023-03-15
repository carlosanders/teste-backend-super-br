<?php

declare(strict_types=1);

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Prod;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Api\V1\Triggers\AcaoTransicaoWorkflow\Trigger0001;
use SuppCore\AdministrativoBackend\Api\V1\Triggers\AcaoTransicaoWorkflow\Trigger0002;
use SuppCore\AdministrativoBackend\Api\V1\Triggers\AcaoTransicaoWorkflow\Trigger0003;
use SuppCore\AdministrativoBackend\Api\V1\Triggers\AcaoTransicaoWorkflow\Trigger0004;
use SuppCore\AdministrativoBackend\Entity\TipoAcaoWorkflow;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadTipoAcaoWorkflowData.
 */
class LoadTipoAcaoWorkflowData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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
                'valor' => 'MINUTA',
                'descricao' => 'GERA AUTOMATICAMENTE UMA MINUTA NA TAREFA DE ACORDO COM O MODELO PRÉ-SELECIONADO',
                'trigger' => Trigger0001::class,
            ],
            [
                'valor' => 'DISTRIBUIÇÃO AUTOMÁTICA',
                'descricao' => 'DISTRIBUI AS TAREFAS DE FORMA AUTOMÁTICA OU POR RESPONSÁVEL',
                'trigger' => Trigger0002::class,
            ],
            [
                'valor' => 'COMPARTILHAMENTO',
                'descricao' => 'COMPARTILHA A TAREFA ENTRE USUÁRIOS',
                'trigger' => Trigger0003::class,
            ],
            [
                'valor' => 'OFÍCIO',
                'descricao' => 'GERA AUTOMATICAMENTE UM OFICIO NA TAREFA',
                'trigger' => Trigger0004::class,
            ],
        ];

        foreach ($data as $item) {
            $tipoAcaoWorkflow = (new TipoAcaoWorkflow())
                ->setValor($item['valor'])
                ->setDescricao($item['descricao'])
                ->setTrigger($item['trigger'])
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
        return ['prod', 'dev', 'test'];
    }
}
