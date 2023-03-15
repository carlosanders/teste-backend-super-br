<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Test/LoadCargoData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Test;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
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
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var ObjectManager
     */
    private $manager;

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
        $cargo->setNome('PROCURADOR FEDERAL');
        $cargo->setDescricao('PROCURADOR FEDERAL');

        $this->manager->persist($cargo);

        $this->addReference('Cargo-'.$cargo->getNome(), $cargo);

        $cargo = new Cargo();
        $cargo->setNome('ADVOGADO DA UNIÃO');
        $cargo->setDescricao('ADVOGADO DA UNIÃO');

        $this->manager->persist($cargo);

        $this->addReference('Cargo-'.$cargo->getNome(), $cargo);

        $cargo = new Cargo();
        $cargo->setNome('PROCURADOR DA FAZENDA NACIONAL');
        $cargo->setDescricao('PROCURADOR DA FAZENDA NACIONAL');

        $this->manager->persist($cargo);

        $this->addReference('Cargo-'.$cargo->getNome(), $cargo);

        $cargo = new Cargo();
        $cargo->setNome('PROCURADOR DO BANCO CENTRAL');
        $cargo->setDescricao('PROCURADOR DO BANCO CENTRAL');

        $this->manager->persist($cargo);

        $this->addReference('Cargo-'.$cargo->getNome(), $cargo);

        // Flush database changes
        $this->manager->flush();
    }

    /**
     * Get the order of this fixture.
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
        return ['test'];
    }
}
