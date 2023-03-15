<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Prod/LoadTransicaoData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Test;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\Nome;
use SuppCore\AdministrativoBackend\Entity\Transicao;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadNomeData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadTransicaoData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $transicao = new Transicao();
        $transicao->setObservacao('OBSERVACAO_1');
        $transicao->setAcessoNegado(false);
        $transicao->setEdital('Edital 1');
        $transicao->setMetodo('Metodo 1');
        $transicao->setModalidadeTransicao($this->getReference('ModalidadeTransicao-ARQUIVAMENTO'));
        $transicao->setProcesso($this->getReference('Processo-TESTE_3'));
        $this->manager->persist($transicao);

        $this->addReference('Transicao-'.$transicao->getObservacao(), $transicao);

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
        return 5;
    }

    /**
     * This method must return an array of groups
     * on which the implementing class belongs to.
     *
     * @return string[]
     */
    public static function getGroups(): array
    {
        return ['test'];
    }
}
