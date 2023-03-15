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
use SuppCore\AdministrativoBackend\Entity\Modelo as ModeloEntity;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;

/**
 * Class LoadModeloData.
 *
 * @author Felipe Pena <felipe.pena@datainfo.inf.br>
 */
class LoadModeloData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $modelo = new ModeloEntity();
        $modelo->setDescricao('DESCRICAO TESTE');
        $modelo->setTemplate($this->getReference('Template-DESPACHO'));
        $modelo->setNome('TESTE_FIXTURE_1');
        $modelo->setDocumento($this->getReference('Documento-TEMPLATE DESPACHO'));
        $modelo->setModalidadeModelo($this->getReference('ModalidadeModelo-INDIVIDUAL'));

        $this->manager->persist($modelo);
        if (!$this->hasReference('Modelo-'.$modelo->getNome())) {
            $this->addReference('Modelo-'.$modelo->getNome(), $modelo);
        }

        $modelo = new ModeloEntity();
        $modelo->setDescricao('DESCRICAO TESTE2');
        $modelo->setNome('TESTE_FIXTURE_2');
        $modelo->setTemplate($this->getReference('Template-OFÍCIO'));
        $modelo->setDocumento($this->getReference('Documento-MODELO OFÍCIO EM BRANCO2'));
        $modelo->setModalidadeModelo($this->getReference('ModalidadeModelo-INDIVIDUAL'));

        $this->manager->persist($modelo);

        if (!$this->hasReference('Modelo-'.$modelo->getNome())) {
            $this->addReference('Modelo-'.$modelo->getNome(), $modelo);
        }

        $modelo = new ModeloEntity();
        $modelo->setDescricao('DESCRICAO TESTE3');
        $modelo->setNome('TESTE_FIXTURE_3');
        $modelo->setTemplate($this->getReference('Template-OFÍCIO'));
        $modelo->setDocumento($this->getReference('Documento-MODELO DESPACHO DE APROVAÇÃO2'));
        $modelo->setModalidadeModelo($this->getReference('ModalidadeModelo-INDIVIDUAL'));

        $this->manager->persist($modelo);

        if (!$this->hasReference('Modelo-'.$modelo->getNome())) {
            $this->addReference('Modelo-'.$modelo->getNome(), $modelo);
        }

        $this->manager->flush();
    }

    /**
     * @return int|void
     */
    public function getOrder()
    {
        return 4;
    }

    /**
     * @return array
     */
    public static function getGroups(): array
    {
        return ['testModelo'];
    }
}
