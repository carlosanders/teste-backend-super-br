<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/ProdExec/LoadModalidadeRepositorioData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\ProdExec;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\ModalidadeRepositorio;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadModalidadeRepositorioData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadModalidadeRepositorioData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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
    public function load(\Doctrine\Persistence\ObjectManager $manager): void
    {
        $this->manager = $manager;

        $modalidadeRepositorio = new ModalidadeRepositorio();
        $modalidadeRepositorio->setValor('TESE');
        $modalidadeRepositorio->setDescricao('TESE');

        $this->manager->persist($modalidadeRepositorio);

        $this->addReference('ModalidadeRepositorio-'.$modalidadeRepositorio->getValor(), $modalidadeRepositorio);

        $modalidadeRepositorio = new ModalidadeRepositorio();
        $modalidadeRepositorio->setValor('JURISPRUDÊNCIA');
        $modalidadeRepositorio->setDescricao('JURISPRUDÊNCIA');

        $this->manager->persist($modalidadeRepositorio);

        $this->addReference('ModalidadeRepositorio-'.$modalidadeRepositorio->getValor(), $modalidadeRepositorio);

        $modalidadeRepositorio = new ModalidadeRepositorio();
        $modalidadeRepositorio->setValor('LEGISLAÇÃO');
        $modalidadeRepositorio->setDescricao('LEGISLAÇÃO');

        $this->manager->persist($modalidadeRepositorio);

        $this->addReference('ModalidadeRepositorio-'.$modalidadeRepositorio->getValor(), $modalidadeRepositorio);

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
        return 1;
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
