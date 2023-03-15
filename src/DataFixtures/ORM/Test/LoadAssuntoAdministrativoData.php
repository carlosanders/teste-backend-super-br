<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Test/LoadAssuntoAdministrativoData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Test;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use SuppCore\AdministrativoBackend\Entity\AssuntoAdministrativo;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadAssuntoAdministrativoData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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
     * Load data fixtures with the passed EntityManager.
     *
     * @param \Doctrine\Persistence\ObjectManager $manager
     *
     * @throws Exception
     */
    public function load(ObjectManager $manager): void
    {
        $this->manager = $manager;

        $assuntoAdministrativo = new AssuntoAdministrativo();
        $assuntoAdministrativo->setNome('ATIVIDADE MEIO');

        // Persist entity
        $this->manager->persist($assuntoAdministrativo);

        $this->addReference('AssuntoAdministrativo-'.$assuntoAdministrativo->getNome(), $assuntoAdministrativo);

        $assuntoAdministrativo = new AssuntoAdministrativo();
        $assuntoAdministrativo->setNome('RECURSOS HUMANOS');
        $assuntoAdministrativo->setParent($this->getReference('AssuntoAdministrativo-ATIVIDADE MEIO'));

        // Persist entity
        $this->manager->persist($assuntoAdministrativo);

        $this->addReference('AssuntoAdministrativo-'.$assuntoAdministrativo->getNome(), $assuntoAdministrativo);

        $assuntoAdministrativo = new AssuntoAdministrativo();
        $assuntoAdministrativo->setNome('ATIVIDADE FIM');

        // Persist entity
        $this->manager->persist($assuntoAdministrativo);

        $this->addReference('AssuntoAdministrativo-'.$assuntoAdministrativo->getNome(), $assuntoAdministrativo);

        $assuntoAdministrativo = new AssuntoAdministrativo();
        $assuntoAdministrativo->setNome('DIREITO TRIBUTARIO');
        $assuntoAdministrativo->setParent($this->getReference('AssuntoAdministrativo-ATIVIDADE FIM'));

        // Persist entity
        $this->manager->persist($assuntoAdministrativo);

        $this->addReference('AssuntoAdministrativo-'.$assuntoAdministrativo->getNome(), $assuntoAdministrativo);

        // Flush database changes
        $this->manager->flush();
    }

    /**
     * Get the order of this fixture.
     */
    public function getOrder(): int
    {
        return 4;
    }

    /**
     * This method must return an array of groups
     * on which the implementing class belongs to.
     *vamos
     * @return string[]
     */
    public static function getGroups(): array
    {
        return ['test'];
    }

}
