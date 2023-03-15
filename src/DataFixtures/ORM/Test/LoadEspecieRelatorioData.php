<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Test/LoadEspecieRelatorioData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Test;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Exception;
use SuppCore\AdministrativoBackend\Entity\EspecieRelatorio;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadModalidadeEtiquetaData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadEspecieRelatorioData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
{
    private \Symfony\Component\DependencyInjection\ContainerInterface $container;

    private \Doctrine\Persistence\ObjectManager $manager;

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
     * @param \Doctrine\Persistence\ObjectManager $manager
     *
     * @throws Exception
     */
    public function load(\Doctrine\Persistence\ObjectManager $manager): void
    {
        $this->manager = $manager;

        $especierelatorio = new EspecieRelatorio();
        $especierelatorio->setNome('GERENCIAL');
        $especierelatorio->setAtivo(true);
        $especierelatorio->setDescricao('Gerencial');
        $especierelatorio->setGeneroRelatorio($this->getReference('GeneroRelatorio-GERENCIAL'));
        $this->manager->persist($especierelatorio);
        $this->addReference('Especie-' . $especierelatorio->getNome(), $especierelatorio);

        $especierelatorio = new EspecieRelatorio();
        $especierelatorio->setNome('ATIVIDADE');
        $especierelatorio->setAtivo(true);
        $especierelatorio->setDescricao('Atividade');
        $especierelatorio->setGeneroRelatorio($this->getReference('GeneroRelatorio-OPERACIONAL'));
        $this->manager->persist($especierelatorio);
        $this->addReference('Especie-' . $especierelatorio->getNome(), $especierelatorio);

        $especierelatorio = new EspecieRelatorio();
        $especierelatorio->setNome('TABELAS');
        $especierelatorio->setAtivo(true);
        $especierelatorio->setDescricao('Tabelas');
        $especierelatorio->setGeneroRelatorio($this->getReference('GeneroRelatorio-SISTEMA'));
        $this->manager->persist($especierelatorio);
        $this->addReference('Especie-' . $especierelatorio->getNome(), $especierelatorio);

        // Flush database changes
        $this->manager->flush();
    }

    /**
     * Get the order of this fixture.
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
        return ['test'];
    }
}
