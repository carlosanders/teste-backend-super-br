<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Prod/LoadModuloData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Prod;

use BadMethodCallException;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use SuppCore\AdministrativoBackend\Entity\ConfigModulo;
use SuppCore\AdministrativoBackend\Entity\Modulo;
use SuppCore\AdministrativoBackend\Fields\FieldsManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;

/**
 * Class LoadModuloData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadModuloData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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
     * @param ObjectManager $manager
     *
     * @throws BadMethodCallException
     * @throws ServiceCircularReferenceException
     * @throws ServiceNotFoundException
     * @throws Exception
     */
    public function load(ObjectManager $manager): void
    {
        $this->manager = $manager;

        // Create new entity
        $modulo = $manager
            ->createQuery(
                "
                SELECT m 
                FROM SuppCore\AdministrativoBackend\Entity\Modulo m 
                WHERE m.nome = 'ADMINISTRATIVO'"
            )
            ->getOneOrNullResult() ?: new Modulo();

        $modulo->setNome("ADMINISTRATIVO");
        $modulo->setDescricao("MÓDULO ADMINISTRATIVO");
        $modulo->setSigla("AD");
        $modulo->setPrefixo("supp_core.administrativo_backend");
        $modulo->setAtivo(true);

        // Persist entity
        $manager->persist($modulo);

        $this->addReference('Modulo-'.$modulo->getNome(), $modulo);

        // Flush database changes
        $manager->flush();
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
        return [
            'prod', 'dev', 'test',
            'config-modulo-administrativo-prod',
            'config-modulo-administrativo-hom',
            'config-modulo-administrativo-dev'
        ];
    }
}
