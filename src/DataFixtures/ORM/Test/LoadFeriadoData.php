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
use SuppCore\AdministrativoBackend\Entity\Feriado;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadCFeriadoData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadFeriadoData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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
        $date = new \DateTime('2021-01-01');

        $feriado = new Feriado();
        $feriado->setNome('Feriado 01');
        $feriado->setDataFeriado($date);
        $feriado->setAtivo(true);
        $feriado->setEstado($this->getReference('Estado-SP'));
        $feriado->setMunicipio($this->getReference('Municipio-OSASCO-SP'));
        $this->manager->persist($feriado);

        $this->addReference('Feriado-001',$feriado);

        $feriado = new Feriado();
        $feriado->setNome('Feriado 02');
        $feriado->setDataFeriado($date);
        $feriado->setAtivo(true);
        $feriado->setEstado($this->getReference('Estado-SP'));
        $feriado->setMunicipio($this->getReference('Municipio-CAMPINAS-SP'));
        $this->manager->persist($feriado);

        $this->addReference('Feriado-002',$feriado);

        $feriado = new Feriado();
        $feriado->setNome('Feriado 03');
        $feriado->setDataFeriado($date);
        $feriado->setAtivo(true);
        $feriado->setEstado($this->getReference('Estado-SP'));
        $feriado->setMunicipio($this->getReference('Municipio-LORENA-SP'));
        $this->manager->persist($feriado);

        $this->addReference('Feriado-003',$feriado);

        $feriado = new Feriado();
        $feriado->setNome('Feriado 04');
        $feriado->setDataFeriado($date);
        $feriado->setAtivo(true);
        $feriado->setEstado($this->getReference('Estado-SP'));
        $feriado->setMunicipio($this->getReference('Municipio-CRUZEIRO-SP'));
        $this->manager->persist($feriado);

        $this->addReference('Feriado-004',$feriado);

        $feriado = new Feriado();
        $feriado->setNome('Feriado 05');
        $feriado->setDataFeriado($date);
        $feriado->setAtivo(true);
        $feriado->setEstado($this->getReference('Estado-SP'));
        $feriado->setMunicipio($this->getReference('Municipio-PIRACICABA-SP'));
        $this->manager->persist($feriado);

        $this->addReference('Feriado-005',$feriado);


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
