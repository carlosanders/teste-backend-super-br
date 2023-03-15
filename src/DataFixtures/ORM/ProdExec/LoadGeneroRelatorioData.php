<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/ProdExec/LoadGeneroRelatorioData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\ProdExec;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\GeneroRelatorio;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadGeneroRelatorioData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadGeneroRelatorioData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        // Adicionar novos gêneros no final da listagem

        $generoRelatorio = new GeneroRelatorio();
        $generoRelatorio->setNome('OPERACIONAL');
        $generoRelatorio->setDescricao('OPERACIONAL');

        $this->manager->persist($generoRelatorio);

        $this->addReference(
            'GeneroRelatorio-' . $generoRelatorio->getNome(),
            $generoRelatorio
        );

        $generoRelatorio = new GeneroRelatorio();
        $generoRelatorio->setNome('GERENCIAL');
        $generoRelatorio->setDescricao('GERENCIAL');

        $this->manager->persist($generoRelatorio);

        $this->addReference(
            'GeneroRelatorio-' . $generoRelatorio->getNome(),
            $generoRelatorio
        );

        $generoRelatorio = new GeneroRelatorio();
        $generoRelatorio->setNome('SISTEMA');
        $generoRelatorio->setDescricao('SISTEMA');

        $this->manager->persist($generoRelatorio);

        $this->addReference(
            'GeneroRelatorio-' . $generoRelatorio->getNome(),
            $generoRelatorio
        );


        $generoRelatorio = new GeneroRelatorio();
        $generoRelatorio->setNome('ARQUIVÍSTICO');
        $generoRelatorio->setDescricao('ARQUIVÍSTICO');

        $this->manager->persist($generoRelatorio);

        $this->addReference(
            'GeneroRelatorio-' . $generoRelatorio->getNome(),
            $generoRelatorio
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
        return ['prodexec'];
    }
}
