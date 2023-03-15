<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Test/LoadVinculacaoWorkflowData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Test;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\VinculacaoWorkflow;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadVinculacaoWorkflowData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadVinculacaoWorkflowData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $vinculacaoWorkflow = new VinculacaoWorkflow();
        $vinculacaoWorkflow->setTarefaInicial($this->getReference('Tarefa-TESTE_1'));
        $vinculacaoWorkflow->setTarefaAtual($this->getReference('Tarefa-TESTE_2'));
        $vinculacaoWorkflow->setWorkflow($this->getReference('Workflow-ELABORAÇÃO DE ATO NORMATIVO'));

        // Persist entity
        $this->manager->persist($vinculacaoWorkflow);

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
        return 6;
    }

    /**
     * This method must return an array of groups
     * on which the implementing class belongs to.
     *
     * @return string[]
     */
    public static function getGroups(): array
    {
        return ['test'];
    }
}
