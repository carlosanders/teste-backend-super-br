<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Dev/LoadVinculacaoPessoaBarramentoData.php.
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Dev;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\VinculacaoPessoaBarramento;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadVinculacaoPessoaBarramentoData.
 */
class LoadVinculacaoPessoaBarramentoData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
{
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

        $vinculacaoPessoaBarramento = new VinculacaoPessoaBarramento();
        $vinculacaoPessoaBarramento->setPessoa($this->getReference('Pessoa-30682'));
        $vinculacaoPessoaBarramento
            ->setNomeRepositorio('PODER EXECUTIVO FEDERAL');
        $vinculacaoPessoaBarramento->setRepositorio(1);
        $vinculacaoPessoaBarramento
            ->setNomeEstrutura('SECRETARIA ESPECIAL DE DESBUROCRATIZAÇÃO, GESTÃO E GOVERNO DIGITAL');
        $vinculacaoPessoaBarramento->setEstrutura(30682);

        $this->manager->persist($vinculacaoPessoaBarramento);

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
        return ['dev', 'test'];
    }
}
