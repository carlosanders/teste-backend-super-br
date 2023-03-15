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
use SuppCore\AdministrativoBackend\Entity\VinculacaoAviso;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;

/**
 * Class LoadVinculacaoAvisoData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadVinculacaoAvisoData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $vinculacaoAviso = new VinculacaoAviso();
        $vinculacaoAviso->setAviso($this->getReference('Aviso-NOME_1'));
        $vinculacaoAviso->setEspecieSetor(null);
        $vinculacaoAviso->setModalidadeOrgaoCentral(null);
        $vinculacaoAviso->setSetor(null);
        $vinculacaoAviso->setUnidade(null);
        $vinculacaoAviso->setUsuario($this->getReference('Usuario-00000000004'));

        $this->manager->persist($vinculacaoAviso);

        $this->addReference('VinculacaoAviso-'.$vinculacaoAviso->getAviso()->getNome(), $vinculacaoAviso);

        $vinculacaoAviso = new VinculacaoAviso();
        $vinculacaoAviso->setAviso($this->getReference('Aviso-NOME_2'));
        $vinculacaoAviso->setEspecieSetor(null);
        $vinculacaoAviso->setModalidadeOrgaoCentral(null);
        $vinculacaoAviso->setSetor(null);
        $vinculacaoAviso->setUnidade(null);
        $vinculacaoAviso->setUsuario($this->getReference('Usuario-00000000004'));

        $this->manager->persist($vinculacaoAviso);

        $this->addReference('VinculacaoAviso-'.$vinculacaoAviso->getAviso()->getNome(), $vinculacaoAviso);

        $this->manager->flush();
    }

    /**
     * @return int|void
     */
    public function getOrder()
    {
        return 7;
    }

    /**
     * @return array
     */
    public static function getGroups(): array
    {
        return ['test'];
    }
}
