<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Prod/LoadRelevanciaData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Test;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\Relevancia;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadRelevanciaData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadRelevanciaData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $relevancia = new Relevancia();
        $relevancia->setObservacao('RELEVANCIA-1');
        $relevancia->setEspecieRelevancia($this->getReference('EspecieRelevancia-PESSOA IDOSA'));
        $relevancia->setProcesso($this->getReference('Processo-TESTE_1'));

        $this->manager->persist($relevancia);

        $this->addReference('Relevancia-'.$relevancia->getObservacao(), $relevancia);

        $relevancia = new Relevancia();
        $relevancia->setObservacao('RELEVANCIA-2');
        $relevancia->setEspecieRelevancia($this->getReference('EspecieRelevancia-ALTO VALOR ECONÔMICO'));
        $relevancia->setProcesso($this->getReference('Processo-TESTE_2'));

        $this->manager->persist($relevancia);

        $this->addReference('Relevancia-'.$relevancia->getObservacao(), $relevancia);


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
