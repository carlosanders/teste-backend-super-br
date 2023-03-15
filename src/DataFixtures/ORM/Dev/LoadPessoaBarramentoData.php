<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Prod/LoadPessoaBarramentoData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Dev;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\Pessoa;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadPessoaBarramentoData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadPessoaBarramentoData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
{
    private ObjectManager $manager;

    /**
     * Setter for container.
     */
    public function setContainer(?ContainerInterface $container = null): void
    {
        if (null !== $container) {
            $this->container = $container;
        }
    }

    /**
     * @throws Exception
     */
    public function load(ObjectManager $manager): void
    {
        $this->manager = $manager;

        $pessoa = new Pessoa();
        $pessoa->setNome('SECRETARIA ESPECIAL DE DESBUROCRATIZAÇÃO, GESTÃO E GOVERNO DIGITAL');
        $pessoa->setModalidadeQualificacaoPessoa(
            $this->getReference('ModalidadeQualificacaoPessoa-PESSOA JURÍDICA')
        );
        $pessoa->setPessoaValidada(true);
        $this->addReference('Pessoa-30682', $pessoa);
        $this->manager->persist($pessoa);

        // Flush database changes
        $this->manager->flush();
    }

    /**
     * Get the order of this fixture.
     */
    public function getOrder(): int
    {
        return 3;
    }

    /**
     * This method must return an array of groups
     * on which the implementing class belongs to.
     *
     * @return string[]
     */
    public static function getGroups(): array
    {
        return ['dev', 'test'];
    }
}
