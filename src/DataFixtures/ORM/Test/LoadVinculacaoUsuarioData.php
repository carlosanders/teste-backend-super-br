<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Test/LoadVinculacaoUsuarioData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Test;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\VinculacaoUsuario;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadVinculacaoUsuarioData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadVinculacaoUsuarioData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $vinculacaoUsuario = new VinculacaoUsuario();
        $vinculacaoUsuario->setUsuario($this->getReference('Usuario-00000000002'));
        $vinculacaoUsuario->setUsuarioVinculado($this->getReference('Usuario-00000000005'));
        $vinculacaoUsuario->setEncerraTarefa(true);
        $vinculacaoUsuario->setCompartilhaTarefa(true);
        $vinculacaoUsuario->setCriaMinuta(true);
        $vinculacaoUsuario->setCriaOficio(true);

        // Persist entity
        $this->manager->persist($vinculacaoUsuario);

        $vinculacaoUsuario = new VinculacaoUsuario();
        $vinculacaoUsuario->setUsuario($this->getReference('Usuario-00000000006'));
        $vinculacaoUsuario->setUsuarioVinculado($this->getReference('Usuario-00000000009'));
        $vinculacaoUsuario->setEncerraTarefa(true);
        $vinculacaoUsuario->setCompartilhaTarefa(true);
        $vinculacaoUsuario->setCriaMinuta(true);
        $vinculacaoUsuario->setCriaOficio(true);

        // Persist entity
        $this->manager->persist($vinculacaoUsuario);

        // Flush database changes
        $this->manager->flush();
    }

    /**
     * Get the order of this fixture.
     */
    public function getOrder(): int
    {
        return 3;
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
