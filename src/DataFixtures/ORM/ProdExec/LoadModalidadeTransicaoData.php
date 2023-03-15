<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/ProdExec/LoadModalidadeTransicaoData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\ProdExec;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\ModalidadeTransicao;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadModalidadeTransicaoData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadModalidadeTransicaoData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $modalidadeTransicao = new ModalidadeTransicao();
        $modalidadeTransicao->setValor('TRANSFERÊNCIA');
        $modalidadeTransicao->setDescricao('TRANSFERÊNCIA');

        $this->manager->persist($modalidadeTransicao);

        $this->addReference('ModalidadeTransicao-'.$modalidadeTransicao->getValor(), $modalidadeTransicao);

        $modalidadeTransicao = new ModalidadeTransicao();
        $modalidadeTransicao->setValor('RECOLHIMENTO');
        $modalidadeTransicao->setDescricao('RECOLHIMENTO');

        $this->manager->persist($modalidadeTransicao);

        $this->addReference('ModalidadeTransicao-'.$modalidadeTransicao->getValor(), $modalidadeTransicao);

        $modalidadeTransicao = new ModalidadeTransicao();
        $modalidadeTransicao->setValor('DESARQUIVAMENTO');
        $modalidadeTransicao->setDescricao('DESARQUIVAMENTO');

        $this->manager->persist($modalidadeTransicao);

        $this->addReference('ModalidadeTransicao-'.$modalidadeTransicao->getValor(), $modalidadeTransicao);

        $modalidadeTransicao = new ModalidadeTransicao();
        $modalidadeTransicao->setValor('ELIMINAÇÃO');
        $modalidadeTransicao->setDescricao('ELIMINAÇÃO');

        $this->manager->persist($modalidadeTransicao);

        $this->addReference('ModalidadeTransicao-'.$modalidadeTransicao->getValor(), $modalidadeTransicao);

        $modalidadeTransicao = new ModalidadeTransicao();
        $modalidadeTransicao->setValor('EXTRAVIO');
        $modalidadeTransicao->setDescricao('EXTRAVIO');

        $this->manager->persist($modalidadeTransicao);

        $this->addReference('ModalidadeTransicao-'.$modalidadeTransicao->getValor(), $modalidadeTransicao);

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
