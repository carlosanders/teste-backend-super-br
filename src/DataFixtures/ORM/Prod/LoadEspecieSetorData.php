<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Prod/LoadEspecieSetorData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Prod;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\EspecieSetor;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadEspecieSetorData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadEspecieSetorData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $especieSetor = new EspecieSetor();
        $especieSetor->setNome('PROTOCOLO');
        $especieSetor->setDescricao('PROTOCOLO');
        $especieSetor->setGeneroSetor($this->getReference('GeneroSetor-ADMINISTRATIVO'));

        $this->manager->persist($especieSetor);

        $this->addReference(
            'EspecieSetor-'.$especieSetor->getNome(),
            $especieSetor
        );

        $especieSetor = new EspecieSetor();
        $especieSetor->setNome('ARQUIVO');
        $especieSetor->setDescricao('ARQUIVO');
        $especieSetor->setGeneroSetor($this->getReference('GeneroSetor-ADMINISTRATIVO'));

        $this->manager->persist($especieSetor);

        $this->addReference(
            'EspecieSetor-'.$especieSetor->getNome(),
            $especieSetor
        );

        $especieSetor = new EspecieSetor();
        $especieSetor->setNome('SECRETARIA');
        $especieSetor->setDescricao('SECRETARIA');
        $especieSetor->setGeneroSetor($this->getReference('GeneroSetor-ADMINISTRATIVO'));

        $this->manager->persist($especieSetor);

        $this->addReference(
            'EspecieSetor-'.$especieSetor->getNome(),
            $especieSetor
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
        return 2;
    }

    /**
     * This method must return an array of groups
     * on which the implementing class belongs to.
     *
     * @return string[]
     */
    public static function getGroups(): array
    {
        return ['prod', 'dev', 'test'];
    }
}
