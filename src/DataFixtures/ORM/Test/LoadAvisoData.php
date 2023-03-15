<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Test/LoadAvisoData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Test;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use SuppCore\AdministrativoBackend\Entity\Aviso;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadAvisoData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
{
    private \Symfony\Component\DependencyInjection\ContainerInterface $container;

    private \Doctrine\Persistence\ObjectManager $manager;

    /**
     * Setter for container.
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
     * @throws Exception
     */
    public function load(\Doctrine\Persistence\ObjectManager $manager): void
    {
        $this->manager = $manager;

        for ($i = 1; $i <= 8; ++$i) {
            $aviso = new Aviso();

            $aviso->setNome('NOME_'.$i);
            $aviso->setDescricao('Descrição Teste');
            $aviso->setSistema(true);
            $aviso->setAtivo(true);
            $aviso->setApagadoEm(null);
            $aviso->setApagadoPor(null);
            $aviso->setAtualizadoEm(date_create('now'));
            $aviso->setAtualizadoPor(null);
            $aviso->setCriadoEm(date_create('now'));
            $aviso->setCriadoPor($this->getReference('Usuario-00000000002'));

            $this->manager->persist($aviso);

            $this->addReference('Aviso-'.$aviso->getNome(), $aviso);

        }
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
