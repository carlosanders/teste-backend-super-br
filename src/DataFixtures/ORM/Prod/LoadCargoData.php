<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Prod/LoadCargoData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Prod;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\Cargo;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadCargoData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadCargoData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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
    public function load(\Doctrine\Persistence\ObjectManager $manager): void
    {
        $this->manager = $manager;

        $cargo = new Cargo();
        $cargo->setNome('SERVIDOR');
        $cargo->setDescricao('SERVIDOR');

        $this->manager->persist($cargo);

        $this->addReference('Cargo-'.$cargo->getNome(), $cargo);

        $cargo = new Cargo();
        $cargo->setNome('CONTADOR');
        $cargo->setDescricao('CONTADOR');

        $this->manager->persist($cargo);

        $this->addReference('Cargo-'.$cargo->getNome(), $cargo);

        $cargo = new Cargo();
        $cargo->setNome('ADMINISTRADOR');
        $cargo->setDescricao('ADMINISTRADOR');

        $this->manager->persist($cargo);

        $this->addReference('Cargo-'.$cargo->getNome(), $cargo);

        $cargo = new Cargo();
        $cargo->setNome('ESTAGIÁRIO');
        $cargo->setDescricao('ESTAGIÁRIO');

        $this->manager->persist($cargo);

        $this->addReference('Cargo-'.$cargo->getNome(), $cargo);

        $cargo = new Cargo();
        $cargo->setNome('TERCEIRIZADO');
        $cargo->setDescricao('TERCEIRIZADO');

        $this->manager->persist($cargo);

        $this->addReference('Cargo-'.$cargo->getNome(), $cargo);

        $cargo = new Cargo();
        $cargo->setNome('BIBLIOTECÁRIO');
        $cargo->setDescricao('BIBLIOTECÁRIO');

        $this->manager->persist($cargo);

        $this->addReference('Cargo-'.$cargo->getNome(), $cargo);

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
        return 1;
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
