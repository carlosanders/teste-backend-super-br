<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Test/LoadModalidadeEtiquetaData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Test;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\Afastamento;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadModalidadeEtiquetaData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadAfastamentoData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface
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
     * @param \Doctrine\Persistence\ObjectManager $manager
     *
     * @throws Exception
     */
    public function load(\Doctrine\Persistence\ObjectManager $manager): void
    {
        $this->manager = $manager;

        $afastamento = new Afastamento();
        $afastamento->setModalidadeAfastamento($this->getReference('ModalidadeAfastamento-RECESSO'));
        $afastamento->setColaborador($this->getReference('Colaborador-00000000002'));
        $afastamento->setDataInicio(\DateTime::createFromFormat('Y-m-d', '2020-01-05'));
        $afastamento->setDataInicioBloqueio(\DateTime::createFromFormat('Y-m-d', '2020-01-01'));
        $afastamento->setDataFim(\DateTime::createFromFormat('Y-m-d', '2020-02-05'));
        $afastamento->setDataFimBloqueio(\DateTime::createFromFormat('Y-m-d', '2020-02-01'));

        $this->manager->persist($afastamento);

        $afastamento = new Afastamento();
        $afastamento->setModalidadeAfastamento($this->getReference('ModalidadeAfastamento-LICENÇA'));
        $afastamento->setColaborador($this->getReference('Colaborador-00000000003'));
        $afastamento->setDataInicio(\DateTime::createFromFormat('Y-m-d', '2020-01-05'));
        $afastamento->setDataInicioBloqueio(\DateTime::createFromFormat('Y-m-d', '2020-01-01'));
        $afastamento->setDataFim(\DateTime::createFromFormat('Y-m-d', '2020-02-05'));
        $afastamento->setDataFimBloqueio(\DateTime::createFromFormat('Y-m-d', '2020-02-01'));
        $this->manager->persist($afastamento);

        $afastamento = new Afastamento();
        $afastamento->setModalidadeAfastamento($this->getReference('ModalidadeAfastamento-FÉRIAS'));
        $afastamento->setColaborador($this->getReference('Colaborador-00000000004'));
        $afastamento->setDataInicio(\DateTime::createFromFormat('Y-m-d', '2020-01-05'));
        $afastamento->setDataInicioBloqueio(\DateTime::createFromFormat('Y-m-d', '2020-01-01'));
        $afastamento->setDataFim(\DateTime::createFromFormat('Y-m-d', '2020-02-05'));
        $afastamento->setDataFimBloqueio(\DateTime::createFromFormat('Y-m-d', '2020-02-01'));
        $this->manager->persist($afastamento);

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
}
