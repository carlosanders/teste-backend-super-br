<?php

declare(strict_types=1);

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Test;

use BadMethodCallException;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use SuppCore\AdministrativoBackend\Entity\VinculacaoModelo as VinculacaoModeloEntity;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;

/**
 * Class LoadVinculacaoModeloData.
 *
 * @author Felipe Pena <felipe.pena@datainfo.inf.br>
 */
class LoadVinculacaoModeloData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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
     * @param ObjectManager $manager
     *
     * @throws BadMethodCallException
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     * @throws ServiceCircularReferenceException
     * @throws ServiceNotFoundException
     * @throws Exception
     */
    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;

        $entity1 = new VinculacaoModeloEntity();
        $entity1->setModelo($this->getReference('Modelo-TESTE_FIXTURE_1'));
        $entity1->setUsuario($this->getReference('Usuario-00000000004'));

        $this->manager->persist($entity1);

        $entity2 = new VinculacaoModeloEntity();
        $entity2->setModelo($this->getReference('Modelo-TESTE_FIXTURE_2'));
        $entity2->setUsuario($this->getReference('Usuario-00000000004'));

        $this->manager->persist($entity2);

        $entity3 = new VinculacaoModeloEntity();
        $entity3->setModelo($this->getReference('Modelo-TESTE_FIXTURE_3'));
        $entity3->setUsuario($this->getReference('Usuario-00000000004'));

        $this->manager->persist($entity3);

        $this->manager->flush();
    }

    /**
     * @return int|void
     */
    public function getOrder()
    {
        return 5;
    }

    /**
     * @return array
     */
    public static function getGroups(): array
    {
        return ['testModelo'];
    }
}
