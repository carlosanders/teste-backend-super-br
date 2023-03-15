<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Test/VinculacaoTransicaoWorkflowData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Test;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\VinculacaoTransicaoWorkflow;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class VinculacaoTransicaoWorkflowData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class VinculacaoTransicaoWorkflowData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $vinculacaoTransicaoWorkflow = new VinculacaoTransicaoWorkflow();
        $vinculacaoTransicaoWorkflow->setWorkflow($this->getReference('Workflow-ELABORAÇÃO DE ATO NORMATIVO'));
        $vinculacaoTransicaoWorkflow->setTransicaoWorkflow($this->getReference('TransicaoWorkflow-MINUTA DE ATO NORMATIVO, ELABORADA'));

        // Persist entity
        $this->manager->persist($vinculacaoTransicaoWorkflow);

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
