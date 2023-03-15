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
use SuppCore\AdministrativoBackend\Entity\VinculacaoProcesso;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;

/**
 * Class LoadVinculacaoProcessoData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadVinculacaoProcessoData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $entity1 = new VinculacaoProcesso();
        $entity1->setProcesso($this->getReference('Processo-TESTE_1'));
        $entity1->setObservacao('Observação 1');
        $entity1->setProcessoVinculado($this->getReference('Processo-TESTE_TRAMITAÇÃO'));
        $entity1->setModalidadeVinculacaoProcesso($this->getReference('ModalidadeVinculacaoProcesso-DESAPENSAMENTO'));

        $this->manager->persist($entity1);

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
        return ['test'];
    }
}
