<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Test/LoadVolumeData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Test;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use SuppCore\AdministrativoBackend\Entity\Volume;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadVolumeData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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
     * Load data fixtures with the passed EntityManager.
     *
     * @param \Doctrine\Persistence\ObjectManager $manager
     *
     * @throws Exception
     */
    public function load(ObjectManager $manager): void
    {
        $this->manager = $manager;

        $volume = new Volume();

        $volume->setNumeracaoSequencial(100);
        $volume->setEncerrado(false);

        $volume->setProcesso($this->getReference('Processo-TESTE_2'));
        $volume->setOrigemDados($this->getReference('OrigemDados-FONTE_DADOS_1'));
        $volume->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        $volume->setCriadoPor($this->getReference('Usuario-00000000004'));

        // Persist entity
        $this->manager->persist($volume);

        // Create reference for later usage
        $this->addReference('Volume-'.$volume->getNumeracaoSequencial(), $volume);

        $volume = new Volume();

        $volume->setNumeracaoSequencial(200);
        $volume->setEncerrado(false);

        $volume->setProcesso($this->getReference('Processo-TESTE_2'));
        $volume->setOrigemDados($this->getReference('OrigemDados-FONTE_DADOS_1'));
        $volume->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        $volume->setCriadoPor($this->getReference('Usuario-00000000004'));

        // Persist entity
        $this->manager->persist($volume);

        // Create reference for later usage
        $this->addReference('Volume-'.$volume->getNumeracaoSequencial(), $volume);

        $volume = new Volume();

        $volume->setNumeracaoSequencial(300);
        $volume->setEncerrado(false);

        $volume->setProcesso($this->getReference('Processo-TESTE_2'));
        $volume->setOrigemDados($this->getReference('OrigemDados-FONTE_DADOS_1'));
        $volume->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        $volume->setCriadoPor($this->getReference('Usuario-00000000004'));

        // Persist entity
        $this->manager->persist($volume);

        // Create reference for later usage
        $this->addReference('Volume-'.$volume->getNumeracaoSequencial(), $volume);

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
