<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Prod/LoadColaboradorData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Prod;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\Colaborador;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadColaboradorData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadColaboradorData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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
    public function load(\Doctrine\Persistence\ObjectManager $manager): void
    {
        $this->manager = $manager;

        $colaborador = new Colaborador();
        $colaborador->setCargo($this->getReference('Cargo-SERVIDOR'));
        $colaborador->setModalidadeColaborador($this->getReference('ModalidadeColaborador-SERVIDOR'));
        $colaborador->setUsuario($this->getReference('Usuario-00000000000'));
        $this->manager->persist($colaborador);

        $this->addReference('Colaborador-00000000000', $colaborador);

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
        return 3;
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
