<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Test/LoadAreaTrabalhoData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Test;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\AreaTrabalho;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadAreaTrabalhoData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadAreaTrabalhoData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $areaTrabalho = new AreaTrabalho();
        $areaTrabalho->setDocumento($this->getReference('Documento-TEMPLATE DESPACHO'));
        $areaTrabalho->setUsuario($this->getReference('Usuario-00000000002'));
        $areaTrabalho->setDono(true);

        // Persist entity
        $this->manager->persist($areaTrabalho);

        $areaTrabalho = new AreaTrabalho();
        $areaTrabalho->setDocumento($this->getReference('Documento-TEMPLATE DESPACHO'));
        $areaTrabalho->setUsuario($this->getReference('Usuario-00000000004'));
        $areaTrabalho->setDono(true);

        // Persist entity
        $this->manager->persist($areaTrabalho);

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
        return ['testAreaTrabalho'];
    }
}
