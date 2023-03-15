<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Dev/LoadColaboradorData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Dev;

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
        $colaborador->setUsuario($this->getReference('Usuario-00000000005'));

        $this->manager->persist($colaborador);

        $this->addReference('Colaborador-00000000005', $colaborador);

        $colaborador = new Colaborador();
        $colaborador->setCargo($this->getReference('Cargo-ADVOGADO DA UNIÃO'));
        $colaborador->setModalidadeColaborador($this->getReference('ModalidadeColaborador-MEMBRO'));
        $colaborador->setUsuario($this->getReference('Usuario-10000000002'));
        $this->manager->persist($colaborador);

        $this->addReference('Colaborador-10000000002', $colaborador);

        $colaborador = new Colaborador();
        $colaborador->setCargo($this->getReference('Cargo-ADVOGADO DA UNIÃO'));
        $colaborador->setModalidadeColaborador($this->getReference('ModalidadeColaborador-MEMBRO'));
        $colaborador->setUsuario($this->getReference('Usuario-10000000003'));

        $this->manager->persist($colaborador);

        $this->addReference('Colaborador-10000000003', $colaborador);

        $colaborador = new Colaborador();
        $colaborador->setCargo($this->getReference('Cargo-ADVOGADO DA UNIÃO'));
        $colaborador->setModalidadeColaborador($this->getReference('ModalidadeColaborador-MEMBRO'));
        $colaborador->setUsuario($this->getReference('Usuario-10000000004'));

        $this->manager->persist($colaborador);

        $this->addReference('Colaborador-10000000004', $colaborador);

        $colaborador = new Colaborador();
        $colaborador->setCargo($this->getReference('Cargo-ADVOGADO DA UNIÃO'));
        $colaborador->setModalidadeColaborador($this->getReference('ModalidadeColaborador-MEMBRO'));
        $colaborador->setUsuario($this->getReference('Usuario-10000000005'));

        $this->manager->persist($colaborador);

        $this->addReference('Colaborador-10000000005', $colaborador);

        $colaborador = new Colaborador();
        $colaborador->setCargo($this->getReference('Cargo-ADVOGADO DA UNIÃO'));
        $colaborador->setModalidadeColaborador($this->getReference('ModalidadeColaborador-MEMBRO'));
        $colaborador->setUsuario($this->getReference('Usuario-20000000002'));
        $this->manager->persist($colaborador);

        $this->addReference('Colaborador-20000000002', $colaborador);

        $colaborador = new Colaborador();
        $colaborador->setCargo($this->getReference('Cargo-ADVOGADO DA UNIÃO'));
        $colaborador->setModalidadeColaborador($this->getReference('ModalidadeColaborador-MEMBRO'));
        $colaborador->setUsuario($this->getReference('Usuario-20000000003'));

        $this->manager->persist($colaborador);

        $this->addReference('Colaborador-20000000003', $colaborador);

        $colaborador = new Colaborador();
        $colaborador->setCargo($this->getReference('Cargo-ADVOGADO DA UNIÃO'));
        $colaborador->setModalidadeColaborador($this->getReference('ModalidadeColaborador-MEMBRO'));
        $colaborador->setUsuario($this->getReference('Usuario-20000000004'));

        $this->manager->persist($colaborador);

        $this->addReference('Colaborador-20000000004', $colaborador);

        $colaborador = new Colaborador();
        $colaborador->setCargo($this->getReference('Cargo-ADVOGADO DA UNIÃO'));
        $colaborador->setModalidadeColaborador($this->getReference('ModalidadeColaborador-MEMBRO'));
        $colaborador->setUsuario($this->getReference('Usuario-20000000005'));

        $this->manager->persist($colaborador);

        $this->addReference('Colaborador-20000000005', $colaborador);

        $colaborador = new Colaborador();
        $colaborador->setCargo($this->getReference('Cargo-ADVOGADO DA UNIÃO'));
        $colaborador->setModalidadeColaborador($this->getReference('ModalidadeColaborador-MEMBRO'));
        $colaborador->setUsuario($this->getReference('Usuario-30000000002'));
        $this->manager->persist($colaborador);

        $this->addReference('Colaborador-30000000002', $colaborador);

        $colaborador = new Colaborador();
        $colaborador->setCargo($this->getReference('Cargo-ADVOGADO DA UNIÃO'));
        $colaborador->setModalidadeColaborador($this->getReference('ModalidadeColaborador-MEMBRO'));
        $colaborador->setUsuario($this->getReference('Usuario-30000000003'));

        $this->manager->persist($colaborador);

        $this->addReference('Colaborador-30000000003', $colaborador);

        $colaborador = new Colaborador();
        $colaborador->setCargo($this->getReference('Cargo-ADVOGADO DA UNIÃO'));
        $colaborador->setModalidadeColaborador($this->getReference('ModalidadeColaborador-MEMBRO'));
        $colaborador->setUsuario($this->getReference('Usuario-30000000004'));

        $this->manager->persist($colaborador);

        $this->addReference('Colaborador-30000000004', $colaborador);

        $colaborador = new Colaborador();
        $colaborador->setCargo($this->getReference('Cargo-ADVOGADO DA UNIÃO'));
        $colaborador->setModalidadeColaborador($this->getReference('ModalidadeColaborador-MEMBRO'));
        $colaborador->setUsuario($this->getReference('Usuario-30000000005'));

        $this->manager->persist($colaborador);

        $this->addReference('Colaborador-30000000005', $colaborador);

        $colaborador = new Colaborador();
        $colaborador->setCargo($this->getReference('Cargo-SERVIDOR'));
        $colaborador->setModalidadeColaborador($this->getReference('ModalidadeColaborador-SERVIDOR'));
        $colaborador->setUsuario($this->getReference('Usuario-40000000002'));
        $this->manager->persist($colaborador);

        $this->addReference('Colaborador-40000000002', $colaborador);

        $colaborador = new Colaborador();
        $colaborador->setCargo($this->getReference('Cargo-SERVIDOR'));
        $colaborador->setModalidadeColaborador($this->getReference('ModalidadeColaborador-SERVIDOR'));
        $colaborador->setUsuario($this->getReference('Usuario-40000000003'));

        $this->manager->persist($colaborador);

        $this->addReference('Colaborador-40000000003', $colaborador);

        $colaborador = new Colaborador();
        $colaborador->setCargo($this->getReference('Cargo-SERVIDOR'));
        $colaborador->setModalidadeColaborador($this->getReference('ModalidadeColaborador-SERVIDOR'));
        $colaborador->setUsuario($this->getReference('Usuario-40000000004'));

        $this->manager->persist($colaborador);

        $this->addReference('Colaborador-40000000004', $colaborador);

        $colaborador = new Colaborador();
        $colaborador->setCargo($this->getReference('Cargo-SERVIDOR'));
        $colaborador->setModalidadeColaborador($this->getReference('ModalidadeColaborador-SERVIDOR'));
        $colaborador->setUsuario($this->getReference('Usuario-40000000005'));

        $this->manager->persist($colaborador);

        $this->addReference('Colaborador-40000000005', $colaborador);

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
        return ['dev'];
    }
}
