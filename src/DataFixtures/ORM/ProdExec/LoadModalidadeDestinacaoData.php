<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/ProdExec/LoadModalidadeDestinacaoData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\ProdExec;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\ModalidadeDestinacao;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadModalidadeDestinacaoData.
 */
class LoadModalidadeDestinacaoData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $modalidadeDestinacao = new ModalidadeDestinacao();
        $modalidadeDestinacao->setValor('TRANSFERÊNCIA');
        $modalidadeDestinacao->setDescricao('TRANSFERÊNCIA');

        $this->manager->persist($modalidadeDestinacao);

        $this->addReference('ModalidadeDestinacao-'.$modalidadeDestinacao->getValor(), $modalidadeDestinacao);

        $modalidadeDestinacao = new ModalidadeDestinacao();
        $modalidadeDestinacao->setValor('RECOLHIMENTO');
        $modalidadeDestinacao->setDescricao('RECOLHIMENTO');

        $this->manager->persist($modalidadeDestinacao);

        $this->addReference('ModalidadeDestinacao-'.$modalidadeDestinacao->getValor(), $modalidadeDestinacao);

        $modalidadeDestinacao = new ModalidadeDestinacao();
        $modalidadeDestinacao->setValor('ELIMINAÇÃO');
        $modalidadeDestinacao->setDescricao('ELIMINAÇÃO');

        $this->manager->persist($modalidadeDestinacao);

        $this->addReference('ModalidadeDestinacao-'.$modalidadeDestinacao->getValor(), $modalidadeDestinacao);

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
