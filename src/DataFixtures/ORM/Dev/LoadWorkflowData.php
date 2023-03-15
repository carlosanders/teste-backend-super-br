<?php

declare(strict_types=1);

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Dev;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\Workflow;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadWorkflowData.
 *
 * @author  Felipe Pena <felipe.pena@datainfo.inf.br>
 */
class LoadWorkflowData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $workflow = (new Workflow())
            ->setNome($this->getReference('EspecieProcesso-ELABORAÇÃO DE ATO NORMATIVO')->getNome())
            ->setDescricao($this->getReference('EspecieProcesso-ELABORAÇÃO DE ATO NORMATIVO')->getNome())
            ->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'))
            ->setEspecieTarefaInicial($this->getReference('EspecieTarefa-ELABORAR MINUTA DE ATO NORMATIVO'));

        $this->manager->persist($workflow);

        $this->addReference(
            'Workflow-'.$workflow->getNome(),
            $workflow
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
        return ['dev', 'test'];
    }
}
