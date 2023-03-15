<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Test/LoadLembreteData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Test;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\Lembrete;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadLembreteData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadLembreteData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $lembrete = new Lembrete();
        $lembrete->setProcesso($this->getReference('Processo-TESTE_1'));
        $lembrete->setConteudo('LEMBRETE 1');

        // Persist entity
        $this->manager->persist($lembrete);

        $lembrete = new Lembrete();
        $lembrete->setProcesso($this->getReference('Processo-TESTE_1'));
        $lembrete->setConteudo('LEMBRETE 2');

        // Persist entity
        $this->manager->persist($lembrete);

        $lembrete = new Lembrete();
        $lembrete->setProcesso($this->getReference('Processo-TESTE_1'));
        $lembrete->setConteudo('LEMBRETE 3');

        // Persist entity
        $this->manager->persist($lembrete);

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
        return ['testLembrete'];
    }
}
