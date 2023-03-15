<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Test/LoadLocalizadorData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Test;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\Localizador;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadLocalizadorData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadLocalizadorData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $localizador = new Localizador();
        $localizador->setSetor($this->getReference('Setor-ARQUIVO-PGF-SEDE'));
        $localizador->setNome('LOCALIZADOR 1');
        $localizador->setDescricao('LOCALIZADOR 1');
        $localizador->setAtivo(true);

        // Persist entity
        $this->manager->persist($localizador);

        $localizador = new Localizador();
        $localizador->setSetor($this->getReference('Setor-SECRETARIA-1-SECR'));
        $localizador->setNome('LOCALIZADOR 2');
        $localizador->setDescricao('LOCALIZADOR 2');
        $localizador->setAtivo(true);

        // Persist entity
        $this->manager->persist($localizador);

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
        return ['testLocalizador'];
    }
}
