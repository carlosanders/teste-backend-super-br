<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/ProdExec/LoadModalidadeModeloData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\ProdExec;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\ModalidadeModelo;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadModalidadeModeloData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadModalidadeModeloData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $modalidadeModelo = new ModalidadeModelo();
        $modalidadeModelo->setValor('EM BRANCO');
        $modalidadeModelo->setDescricao('EM BRANCO');

        $this->manager->persist($modalidadeModelo);

        $this->addReference('ModalidadeModelo-'.$modalidadeModelo->getValor(), $modalidadeModelo);

        $modalidadeModelo = new ModalidadeModelo();
        $modalidadeModelo->setValor('INDIVIDUAL');
        $modalidadeModelo->setDescricao('INDIVIDUAL');

        $this->manager->persist($modalidadeModelo);

        $this->addReference('ModalidadeModelo-'.$modalidadeModelo->getValor(), $modalidadeModelo);

        $modalidadeModelo = new ModalidadeModelo();
        $modalidadeModelo->setValor('LOCAL');
        $modalidadeModelo->setDescricao('LOCAL');

        $this->manager->persist($modalidadeModelo);

        $this->addReference('ModalidadeModelo-'.$modalidadeModelo->getValor(), $modalidadeModelo);

        $modalidadeModelo = new ModalidadeModelo();
        $modalidadeModelo->setValor('NACIONAL');
        $modalidadeModelo->setDescricao('NACIONAL');

        $this->manager->persist($modalidadeModelo);

        $this->addReference('ModalidadeModelo-'.$modalidadeModelo->getValor(), $modalidadeModelo);

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
