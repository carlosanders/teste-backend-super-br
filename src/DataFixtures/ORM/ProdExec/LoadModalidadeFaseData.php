<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/ProdExec/LoadModalidadeFaseData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\ProdExec;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\ModalidadeFase;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadModalidadeFaseData.
 */
class LoadModalidadeFaseData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
{
    private ContainerInterface $container;

    private ObjectManager $manager;

    /**
     * Sets the container.
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

        $modalidadeFase = new ModalidadeFase();
        $modalidadeFase->setValor('CORRENTE');
        $modalidadeFase->setDescricao('CORRENTE');

        $this->manager->persist($modalidadeFase);

        $this->addReference('ModalidadeFase-'.$modalidadeFase->getValor(), $modalidadeFase);

        $modalidadeFase = new ModalidadeFase();
        $modalidadeFase->setValor('INTERMEDIÁRIA');
        $modalidadeFase->setDescricao('INTERMEDIÁRIA');

        $this->manager->persist($modalidadeFase);

        $this->addReference('ModalidadeFase-'.$modalidadeFase->getValor(), $modalidadeFase);

        $modalidadeFase = new ModalidadeFase();
        $modalidadeFase->setValor('DEFINITIVA');
        $modalidadeFase->setDescricao('DEFINITIVA');

        $this->manager->persist($modalidadeFase);

        $this->addReference('ModalidadeFase-'.$modalidadeFase->getValor(), $modalidadeFase);

        $modalidadeFase = new ModalidadeFase();
        $modalidadeFase->setValor('ELIMINADO');
        $modalidadeFase->setDescricao('ELIMINADO');

        $this->manager->persist($modalidadeFase);

        $this->addReference('ModalidadeFase-'.$modalidadeFase->getValor(), $modalidadeFase);

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
