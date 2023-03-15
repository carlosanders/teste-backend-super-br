<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Test/LoadAssuntoData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Test;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use SuppCore\AdministrativoBackend\Entity\Assunto;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadAssuntoData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $assunto = new Assunto();

        $assunto->setPrincipal(true);
        $assunto->setAssuntoAdministrativo($this->getReference('AssuntoAdministrativo-RECURSOS HUMANOS'));
        $assunto->setOrigemDados($this->getReference('OrigemDados-FONTE_DADOS_1'));
        $assunto->setProcesso($this->getReference('Processo-TESTE_1'));
        $assunto->setApagadoEm(null);
        $assunto->setApagadoPor(null);
        $assunto->setAtualizadoEm(date_create('now'));
        $assunto->setAtualizadoPor(null);
        $assunto->setCriadoEm(date_create('now'));
        $assunto->setCriadoPor($this->getReference('Usuario-00000000004'));

        // Persist entity
        $this->manager->persist($assunto);


        $assunto = new Assunto();

        $assunto->setPrincipal(false);
        $assunto->setAssuntoAdministrativo($this->getReference('AssuntoAdministrativo-DIREITO TRIBUTARIO'));
        $assunto->setOrigemDados($this->getReference('OrigemDados-FONTE_DADOS_1'));
        $assunto->setProcesso($this->getReference('Processo-TESTE_1'));
        $assunto->setApagadoEm(null);
        $assunto->setApagadoPor(null);
        $assunto->setAtualizadoEm(date_create('now'));
        $assunto->setAtualizadoPor(null);
        $assunto->setCriadoEm(date_create('now'));
        $assunto->setCriadoPor($this->getReference('Usuario-00000000004'));

        // Persist entity
        $this->manager->persist($assunto);

        // Flush database changes
        $this->manager->flush();
    }

    /**
     * Get the order of this fixture.
     */
    public function getOrder(): int
    {
        return 6;
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
