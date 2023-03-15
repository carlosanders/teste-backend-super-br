<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Dev/LoadVinculacaoPessoaUsuarioData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Dev;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\VinculacaoPessoaUsuario;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadVinculacaoPessoaUsuarioData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadVinculacaoPessoaUsuarioData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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
     * @param \Doctrine\Persistence\ObjectManager $manager
     *
     * @throws Exception
     */
    public function load(\Doctrine\Persistence\ObjectManager $manager): void
    {
        $this->manager = $manager;

        $vinculacaoPessoaUsuario = new VinculacaoPessoaUsuario();
        $vinculacaoPessoaUsuario->setUsuarioVinculado($this->getReference('Usuario-00000000001'));
        $vinculacaoPessoaUsuario->setPessoa($this->getReference('Pessoa-00000000001'));

        $this->manager->persist($vinculacaoPessoaUsuario);

        $vinculacaoPessoaUsuario = new VinculacaoPessoaUsuario();
        $vinculacaoPessoaUsuario->setUsuarioVinculado($this->getReference('Usuario-10000000001'));
        $vinculacaoPessoaUsuario->setPessoa($this->getReference('Pessoa-10000000001'));

        $this->manager->persist($vinculacaoPessoaUsuario);

        $vinculacaoPessoaUsuario = new VinculacaoPessoaUsuario();
        $vinculacaoPessoaUsuario->setUsuarioVinculado($this->getReference('Usuario-20000000001'));
        $vinculacaoPessoaUsuario->setPessoa($this->getReference('Pessoa-20000000001'));

        $this->manager->persist($vinculacaoPessoaUsuario);

        $vinculacaoPessoaUsuario = new VinculacaoPessoaUsuario();
        $vinculacaoPessoaUsuario->setUsuarioVinculado($this->getReference('Usuario-30000000001'));
        $vinculacaoPessoaUsuario->setPessoa($this->getReference('Pessoa-30000000001'));

        $this->manager->persist($vinculacaoPessoaUsuario);

        $vinculacaoPessoaUsuario = new VinculacaoPessoaUsuario();
        $vinculacaoPessoaUsuario->setUsuarioVinculado($this->getReference('Usuario-40000000001'));
        $vinculacaoPessoaUsuario->setPessoa($this->getReference('Pessoa-40000000001'));

        $this->manager->persist($vinculacaoPessoaUsuario);

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
        return ['dev'];
    }
}
