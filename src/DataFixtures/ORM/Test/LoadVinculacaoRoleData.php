<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Test/LoadVinculacaoRoleData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Test;

use BadMethodCallException;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Exception;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use SuppCore\AdministrativoBackend\Entity\VinculacaoRole;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;

/**
 * Class LoadVinculacaoRoleData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadVinculacaoRoleData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var ObjectManager
     */
    private $manager;

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
     * @throws BadMethodCallException
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     * @throws ServiceCircularReferenceException
     * @throws ServiceNotFoundException
     * @throws Exception
     */
    public function load(\Doctrine\Persistence\ObjectManager $manager): void
    {
        $this->manager = $manager;

        // Create new entity
        $entity = new VinculacaoRole();
        $entity->setRole('ROLE_USER');
        $entity->setUsuario($this->getReference('Usuario-00000000001'));

        // Persist entity
        $this->manager->persist($entity);

        $this->addReference('VinculacaoRole-Usuario-00000000001', $entity);

        // Create new entity
        $entity = new VinculacaoRole();
        $entity->setRole('ROLE_COLABORADOR');
        $entity->setUsuario($this->getReference('Usuario-00000000002'));

        // Persist entity
        $this->manager->persist($entity);

        $this->addReference('VinculacaoRole-Usuario-00000000002', $entity);

        // Create new entity
        $entity = new VinculacaoRole();
        $entity->setRole('ROLE_ADMIN');
        $entity->setUsuario($this->getReference('Usuario-00000000003'));

        // Persist entity
        $this->manager->persist($entity);

        $this->addReference('VinculacaoRole-Usuario-00000000003', $entity);

        // Create new entity
        $entity = new VinculacaoRole();
        $entity->setRole('ROLE_ROOT');
        $entity->setUsuario($this->getReference('Usuario-00000000004'));

        // Persist entity
        $this->manager->persist($entity);

        $this->addReference('VinculacaoRole-Usuario-00000000004', $entity);

        // Create new entity
        $entity = new VinculacaoRole();
        $entity->setRole('ROLE_USER');
        $entity->setUsuario($this->getReference('Usuario-00000000005'));

        // Persist entity
        $this->manager->persist($entity);

        $this->addReference('VinculacaoRole-Usuario-00000000005', $entity);

        // Create new entity
        $entity = new VinculacaoRole();
        $entity->setRole('ROLE_COLABORADOR');
        $entity->setUsuario($this->getReference('Usuario-00000000006'));

        // Persist entity
        $this->manager->persist($entity);

        $this->addReference('VinculacaoRole-Usuario-00000000006', $entity);

        // Create new entity
        $entity = new VinculacaoRole();
        $entity->setRole('ROLE_ADMIN');
        $entity->setUsuario($this->getReference('Usuario-00000000007'));

        // Persist entity
        $this->manager->persist($entity);

        $this->addReference('VinculacaoRole-Usuario-00000000007', $entity);

        // Create new entity
        $entity = new VinculacaoRole();
        $entity->setRole('ROLE_ROOT');
        $entity->setUsuario($this->getReference('Usuario-00000000008'));

        // Persist entity
        $this->manager->persist($entity);

        $this->addReference('VinculacaoRole-Usuario-00000000008', $entity);

        // Create new entity
        $entity = new VinculacaoRole();
        $entity->setRole('ROLE_USER');
        $entity->setUsuario($this->getReference('Usuario-00000000009'));

        // Persist entity
        $this->manager->persist($entity);

        $this->addReference('VinculacaoRole-Usuario-00000000009', $entity);

        // Create new entity
        $entity = new VinculacaoRole();
        $entity->setRole('ROLE_COLABORADOR');
        $entity->setUsuario($this->getReference('Usuario-00000000010'));

        // Persist entity
        $this->manager->persist($entity);

        $this->addReference('VinculacaoRole-Usuario-00000000010', $entity);

        // Create new entity
        $entity = new VinculacaoRole();
        $entity->setRole('ROLE_ADMIN');
        $entity->setUsuario($this->getReference('Usuario-00000000011'));

        // Persist entity
        $this->manager->persist($entity);

        $this->addReference('VinculacaoRole-Usuario-00000000011', $entity);

        // Create new entity
        $entity = new VinculacaoRole();
        $entity->setRole('ROLE_ROOT');
        $entity->setUsuario($this->getReference('Usuario-00000000012'));

        // Persist entity
        $this->manager->persist($entity);

        $this->addReference('VinculacaoRole-Usuario-00000000012', $entity);

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
