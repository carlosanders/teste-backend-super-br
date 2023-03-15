<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Test/LoadBookmarkData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Test;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\Bookmark;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadBookmarkData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadBookmarkData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $bookmark = new Bookmark();
        $bookmark->setNome('BOOKMARK TESTE');
        $bookmark->setCorHexadecimal('#F0FFFF');
        $bookmark->setDescricao('BOOKMARK TESTE');
        $bookmark->setPagina(1);
        $bookmark->setComponenteDigital($this->getReference('ComponenteDigital-TEMPLATE DESPACHO'));
        $bookmark->setProcesso($this->getReference('Processo-TESTE_1'));
        $bookmark->setJuntada($this->getReference('Juntada-TESTE_11'));
        $bookmark->setUsuario($this->getReference('Usuario-00000000002'));

        // Persist entity
        $this->manager->persist($bookmark);

        // Flush database changes
        $this->manager->flush();
    }

    /**
     * Get the order of this fixture.
     */
    public function getOrder(): int
    {
        return 7;
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
