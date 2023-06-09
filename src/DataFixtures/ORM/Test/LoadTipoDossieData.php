<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Test/LoadTipoDossieData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Test;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\TipoDossie;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadTipoDossieData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadTipoDossieData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $tipoDossie = new TipoDossie();
        $tipoDossie->setFonteDados('FONTE DE DADOS');
        $tipoDossie->setPeriodoGuarda(100);
        $tipoDossie->setNome('ADMINISTRATIVO');
        $tipoDossie->setSigla('ADM');
        $tipoDossie->setDescricao('DOSSIÊ ADMINISTRATIVO');
        $tipoDossie->setAtivo(true);

        // Persist entity
        $this->manager->persist($tipoDossie);

        $tipoDossie = new TipoDossie();
        $tipoDossie->setFonteDados('FONTE DE DADOS');
        $tipoDossie->setPeriodoGuarda(100);
        $tipoDossie->setNome('TÉCNICO');
        $tipoDossie->setSigla('TEC');
        $tipoDossie->setDescricao('DOSSIÊ TÉCNICO');
        $tipoDossie->setAtivo(true);

        // Persist entity
        $this->manager->persist($tipoDossie);

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
