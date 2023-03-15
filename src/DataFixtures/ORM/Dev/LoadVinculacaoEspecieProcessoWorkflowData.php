<?php

declare(strict_types=1);

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Dev;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\VinculacaoEspecieProcessoWorkflow;
use SuppCore\AdministrativoBackend\Entity\Workflow;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadVinculacaoEspecieProcessoWorkflowData.
 *
 */
class LoadVinculacaoEspecieProcessoWorkflowData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $vinculacaoEspecieProcessoWorkflow = (new VinculacaoEspecieProcessoWorkflow())
            ->setWorkflow($this->getReference('Workflow-ELABORAÇÃO DE ATO NORMATIVO'))
            ->setEspecieProcesso($this->getReference('EspecieProcesso-ELABORAÇÃO DE ATO NORMATIVO'));

        $this->manager->persist($vinculacaoEspecieProcessoWorkflow);

        $this->addReference(
            'VinculacaoEspecieProcessoWorkflow-ELABORAÇÃO DE ATO NORMATIVO-ELABORAÇÃO DE ATO NORMATIVO',
            $vinculacaoEspecieProcessoWorkflow
        );
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
        return 5;
    }

    /**
     * This method must return an array of groups
     * on which the implementing class belongs to.
     *
     * @return string[]
     */
    public static function getGroups(): array
    {
        return ['dev', 'test'];
    }
}
