<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Test/LoadColaboradorData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Test;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
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
     * @param \Doctrine\Persistence\ObjectManager $manager
     *
     * @throws Exception
     */
    public function load(\Doctrine\Persistence\ObjectManager $manager): void
    {
        $this->manager = $manager;

        $colaborador = new Colaborador();
        $colaborador->setCargo($this->getReference('Cargo-PROCURADOR FEDERAL'));
        $colaborador->setModalidadeColaborador($this->getReference('ModalidadeColaborador-MEMBRO'));
        $colaborador->setUsuario($this->getReference('Usuario-00000000002'));
        $this->manager->persist($colaborador);

        $this->addReference('Colaborador-00000000002', $colaborador);

        $colaborador = new Colaborador();
        $colaborador->setCargo($this->getReference('Cargo-PROCURADOR FEDERAL'));
        $colaborador->setModalidadeColaborador($this->getReference('ModalidadeColaborador-MEMBRO'));
        $colaborador->setUsuario($this->getReference('Usuario-00000000003'));

        $this->manager->persist($colaborador);

        $this->addReference('Colaborador-00000000003', $colaborador);

        $colaborador = new Colaborador();
        $colaborador->setCargo($this->getReference('Cargo-PROCURADOR FEDERAL'));
        $colaborador->setModalidadeColaborador($this->getReference('ModalidadeColaborador-MEMBRO'));
        $colaborador->setUsuario($this->getReference('Usuario-00000000004'));

        $this->manager->persist($colaborador);

        $this->addReference('Colaborador-00000000004', $colaborador);

        $colaborador = new Colaborador();
        $colaborador->setCargo($this->getReference('Cargo-PROCURADOR FEDERAL'));
        $colaborador->setModalidadeColaborador($this->getReference('ModalidadeColaborador-MEMBRO'));
        $colaborador->setUsuario($this->getReference('Usuario-00000000006'));

        $this->manager->persist($colaborador);

        $this->addReference('Colaborador-00000000006', $colaborador);

        $colaborador = new Colaborador();
        $colaborador->setCargo($this->getReference('Cargo-PROCURADOR FEDERAL'));
        $colaborador->setModalidadeColaborador($this->getReference('ModalidadeColaborador-MEMBRO'));
        $colaborador->setUsuario($this->getReference('Usuario-00000000007'));

        $this->manager->persist($colaborador);

        $this->addReference('Colaborador-00000000007', $colaborador);

        $colaborador = new Colaborador();
        $colaborador->setCargo($this->getReference('Cargo-PROCURADOR FEDERAL'));
        $colaborador->setModalidadeColaborador($this->getReference('ModalidadeColaborador-MEMBRO'));
        $colaborador->setUsuario($this->getReference('Usuario-00000000008'));

        $this->manager->persist($colaborador);

        $this->addReference('Colaborador-00000000008', $colaborador);

        $colaborador = new Colaborador();
        $colaborador->setCargo($this->getReference('Cargo-PROCURADOR FEDERAL'));
        $colaborador->setModalidadeColaborador($this->getReference('ModalidadeColaborador-MEMBRO'));
        $colaborador->setUsuario($this->getReference('Usuario-00000000010'));

        $this->manager->persist($colaborador);

        $this->addReference('Colaborador-00000000010', $colaborador);

        $colaborador = new Colaborador();
        $colaborador->setCargo($this->getReference('Cargo-PROCURADOR FEDERAL'));
        $colaborador->setModalidadeColaborador($this->getReference('ModalidadeColaborador-MEMBRO'));
        $colaborador->setUsuario($this->getReference('Usuario-00000000011'));

        $this->manager->persist($colaborador);

        $this->addReference('Colaborador-00000000011', $colaborador);

        $colaborador = new Colaborador();
        $colaborador->setCargo($this->getReference('Cargo-PROCURADOR FEDERAL'));
        $colaborador->setModalidadeColaborador($this->getReference('ModalidadeColaborador-MEMBRO'));
        $colaborador->setUsuario($this->getReference('Usuario-00000000012'));
        $this->manager->persist($colaborador);

        $this->addReference('Colaborador-00000000012', $colaborador);

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
        return ['test'];
    }
}
