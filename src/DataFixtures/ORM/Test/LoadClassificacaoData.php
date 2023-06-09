<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Test/LoadClassificacaoData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Test;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\Classificacao;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadClassificacaoData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadClassificacaoData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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
    public function load(ObjectManager $manager): void
    {
        $this->manager = $manager;

        $classificacao = new Classificacao();
        $classificacao->setNome('CLASSIFICAÇÃO INATIVA');
        $classificacao->setPermissaoUso(false);
        $classificacao->setCodigo('I00');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setAtivo(false);

        // Persist entity
        $this->manager->persist($classificacao);

        // Create reference for later usage
        $this->addReference('Classificacao381', $classificacao);

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
        return 2;
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
