<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Prod/LoadModalidadeAfastamentoData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Prod;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\ModalidadeAfastamento;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadModalidadeAfastamentoData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadModalidadeAfastamentoData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $modalidadeAfastamento = new ModalidadeAfastamento();
        $modalidadeAfastamento->setValor('FÉRIAS');
        $modalidadeAfastamento->setDescricao('FÉRIAS');

        $this->manager->persist($modalidadeAfastamento);

        $this->addReference('ModalidadeAfastamento-'.$modalidadeAfastamento->getValor(), $modalidadeAfastamento);

        $modalidadeAfastamento = new ModalidadeAfastamento();
        $modalidadeAfastamento->setValor('LICENÇA');
        $modalidadeAfastamento->setDescricao('LICENÇA');

        $this->manager->persist($modalidadeAfastamento);

        $this->addReference('ModalidadeAfastamento-'.$modalidadeAfastamento->getValor(), $modalidadeAfastamento);

        $modalidadeAfastamento = new ModalidadeAfastamento();
        $modalidadeAfastamento->setValor('RECESSO');
        $modalidadeAfastamento->setDescricao('RECESSO');

        $this->manager->persist($modalidadeAfastamento);

        $this->addReference('ModalidadeAfastamento-'.$modalidadeAfastamento->getValor(), $modalidadeAfastamento);

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
        return ['prod', 'dev', 'test'];
    }
}
