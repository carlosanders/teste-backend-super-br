<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Test/LoadObjetoAvaliadoData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Test;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\ObjetoAvaliado;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadObjetoAvaliadoData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadObjetoAvaliadoData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $objetoAvaliado = new ObjetoAvaliado();
        $objetoAvaliado->setClasse('CLASSE TESTE');
        $objetoAvaliado->setObjetoId(1);
        $objetoAvaliado->setAvaliacaoResultante(50);
        $objetoAvaliado->setQuantidadeAvaliacoes(1);

        // Persist entity
        $this->manager->persist($objetoAvaliado);

        // Create reference for later usage
        $this->addReference('ObjetoAvaliado-'.$objetoAvaliado->getObjetoId(), $objetoAvaliado);

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
