<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Test/LoadOrigemDadosData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Test;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use SuppCore\AdministrativoBackend\Entity\OrigemDados;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadOrigemDadosData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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


            $origemDados = new OrigemDados();
            $origemDados->setStatus(1);
            $origemDados->setDataHoraUltimaConsulta(date_create('now'));
            $origemDados->setFonteDados('FONTE_DADOS_1');
            $origemDados->setIdExterno('id_externo1');
            $origemDados->setServico('Serviço1');
            $origemDados->setAtualizadoEm(date_create('now'));
            $origemDados->setAtualizadoPor($this->getReference('Usuario-00000000004'));
            $origemDados->setCriadoEm(date_create('now'));
            $origemDados->setCriadoPor($this->getReference('Usuario-00000000004'));

            // Persist entity
            $this->manager->persist($origemDados);

            // Create reference for later usage
            $this->addReference('OrigemDados-'.$origemDados->getFonteDados(), $origemDados);


        // Flush database changes
        $this->manager->flush();
    }

    /**
     * Get the order of this fixture.
     */
    public function getOrder(): int
    {
        return 4;
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
