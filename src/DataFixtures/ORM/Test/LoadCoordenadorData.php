<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Test/LoadCoordenadorData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Test;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\Coordenador;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadCoordenadorData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadCoordenadorData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $coordenador = new Coordenador();
        $coordenador->setUsuario($this->getReference('Usuario-00000000012'));
        $coordenador->setSetor($this->getReference('Setor-ARQUIVO-PGF-SEDE'));
        $coordenador->setUnidade(null);
        $coordenador->setOrgaoCentral(null);

        // Persist entity
        $this->manager->persist($coordenador);

        // Create reference for later usage
        $this->addReference(
            'Coordenador1',
            $coordenador
        );

        $coordenador = new Coordenador();
        $coordenador->setUsuario($this->getReference('Usuario-00000000006'));
        $coordenador->setSetor(null);
        $coordenador->setUnidade($this->getReference('Unidade-ADVOCACIA-GERAL DA UNIÃO'));
        $coordenador->setOrgaoCentral(null);

        // Persist entity
        $this->manager->persist($coordenador);

        // Create reference for later usage
        $this->addReference(
            'Coordenador2',
            $coordenador
        );

        $coordenador = new Coordenador();
        $coordenador->setUsuario($this->getReference('Usuario-00000000010'));
        $coordenador->setSetor(null);
        $coordenador->setUnidade(null);
        $coordenador->setOrgaoCentral($this->getReference('ModalidadeOrgaoCentral-AGU'));

        // Persist entity
        $this->manager->persist($coordenador);

        // Create reference for later usage
        $this->addReference(
            'Coordenador3',
            $coordenador
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
        return ['test'];
    }
}
