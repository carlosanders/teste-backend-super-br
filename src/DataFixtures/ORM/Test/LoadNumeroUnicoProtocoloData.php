<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Test/LoadNumeroUnicoProtocoloData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Test;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\NumeroUnicoProtocolo;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadNumeroUnicoProtocoloData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadNumeroUnicoProtocoloData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $numeroUnicoProtocolo = new NumeroUnicoProtocolo();
        $numeroUnicoProtocolo->setSetor($this->getReference('Setor-ARQUIVO-PGF-SEDE'));
        $numeroUnicoProtocolo->setAno(2021);
        $numeroUnicoProtocolo->setSequencia(10);
        $numeroUnicoProtocolo->setPrefixoNUP('10000');

        // Persist entity
        $this->manager->persist($numeroUnicoProtocolo);

        // Flush database changes
        $this->manager->flush();
    }

    /**
     * Get the order of this fixture.
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
