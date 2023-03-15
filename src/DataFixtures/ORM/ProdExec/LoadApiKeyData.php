<?php

declare(strict_types=1);
/**
 * /src/DevDataFixtures/ORM/ProdExec/LoadApiKeyData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\ProdExec;

use function array_map;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use function str_pad;
use SuppCore\AdministrativoBackend\Entity\ApiKey;
use SuppCore\AdministrativoBackend\Security\RolesService;
use SuppCore\AdministrativoBackend\Security\RolesServiceInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadApiKeyData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadApiKeyData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
{
    private ContainerInterface $container;

    private ObjectManager $manager;

    private RolesServiceInterface $roles;

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
        /** @var RolesServiceInterface $roles */
        $roles = $this->container->get('supp_core.administrativo_backend.service_locator')->get(RolesService::class);

        $this->roles = $roles;
        $this->manager = $manager;

        // Create entities
        array_map([$this, 'createApiKey'], $this->roles->getRoles());

        $this->createApiKey();

        // Flush database changes
        $this->manager->flush();
    }

    /**
     * @param string|null $role
     *
     * @throws Exception
     */
    private function createApiKey(?string $role = null): void
    {
        // Create new entity
        $entity = new ApiKey();
        $entity->setDescription('ApiKey Description: '.(null === $role ? '' : $this->roles->getShort($role)));
        $entity->setToken(
            str_pad((null === $role ? '' : $this->roles->getShort($role)), 40, '_')
        );

        $suffix = '';

        if (null !== $role) {
            $suffix = '-'.$this->roles->getShort($role);
        }

        // Persist entity
        $this->manager->persist($entity);

        // Create reference for later usage
        $this->addReference('ApiKey'.$suffix, $entity);
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
        return ['prodexec'];
    }
}
