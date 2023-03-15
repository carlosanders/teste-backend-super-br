<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Test/LoadLotacaoData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Test;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\Lotacao;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadLotacaoData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadLotacaoData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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
     * @param \Doctrine\Persistence\ObjectManager $manager
     *
     * @throws Exception
     */
    public function load(\Doctrine\Persistence\ObjectManager $manager): void
    {
        $this->manager = $manager;

        $lotacao = new Lotacao();
        $lotacao->setColaborador($this->getReference('Colaborador-00000000002'));
        $lotacao->setSetor($this->getReference('Setor-PROTOCOLO-AGU-SEDE'));
        $lotacao->setPrincipal(true);

        $this->manager->persist($lotacao);

        $this->addReference(
            'Lotacao-Colaborador-00000000002'.'-'.$lotacao->getSetor()->getNome(
            ).'-'.$lotacao->getSetor()->getUnidade()->getSigla(),
            $lotacao
        );

        $lotacao = new Lotacao();
        $lotacao->setColaborador($this->getReference('Colaborador-00000000003'));
        $lotacao->setSetor($this->getReference('Setor-PROTOCOLO-AGU-SEDE'));
        $lotacao->setPrincipal(true);

        $this->manager->persist($lotacao);

        $this->addReference(
            'Lotacao-Colaborador-00000000003'.'-'.$lotacao->getSetor()->getNome(
            ).'-'.$lotacao->getSetor()->getUnidade()->getSigla(),
            $lotacao
        );

        $lotacao = new Lotacao();
        $lotacao->setColaborador($this->getReference('Colaborador-00000000004'));
        $lotacao->setSetor($this->getReference('Setor-ARQUIVO-AGU-SEDE'));
        $lotacao->setPrincipal(true);

        $this->manager->persist($lotacao);

        $this->addReference(
            'Lotacao-Colaborador-00000000004'.'-'.$lotacao->getSetor()->getNome(
            ).'-'.$lotacao->getSetor()->getUnidade()->getSigla(),
            $lotacao
        );

        $lotacao = new Lotacao();
        $lotacao->setColaborador($this->getReference('Colaborador-00000000006'));
        $lotacao->setSetor($this->getReference('Setor-PROTOCOLO-PGF-SEDE'));
        $lotacao->setPrincipal(true);

        $this->manager->persist($lotacao);

        $this->addReference(
            'Lotacao-Colaborador-00000000006'.'-'.$lotacao->getSetor()->getNome(
            ).'-'.$lotacao->getSetor()->getUnidade()->getSigla(),
            $lotacao
        );

        $lotacao = new Lotacao();
        $lotacao->setColaborador($this->getReference('Colaborador-00000000007'));
        $lotacao->setSetor($this->getReference('Setor-PROTOCOLO-PGF-SEDE'));
        $lotacao->setPrincipal(true);

        $this->manager->persist($lotacao);

        $this->addReference(
            'Lotacao-Colaborador-00000000007'.'-'.$lotacao->getSetor()->getNome(
            ).'-'.$lotacao->getSetor()->getUnidade()->getSigla(),
            $lotacao
        );

        $lotacao = new Lotacao();
        $lotacao->setColaborador($this->getReference('Colaborador-00000000008'));
        $lotacao->setSetor($this->getReference('Setor-ARQUIVO-PGF-SEDE'));
        $lotacao->setPrincipal(true);

        $this->manager->persist($lotacao);

        $this->addReference(
            'Lotacao-Colaborador-00000000008'.'-'.$lotacao->getSetor()->getNome(
            ).'-'.$lotacao->getSetor()->getUnidade()->getSigla(),
            $lotacao
        );

        $lotacao = new Lotacao();
        $lotacao->setColaborador($this->getReference('Colaborador-00000000010'));
        $lotacao->setSetor($this->getReference('Setor-PROTOCOLO-PGF-SEDE'));
        $lotacao->setPrincipal(true);

        $this->manager->persist($lotacao);

        $this->addReference(
            'Lotacao-Colaborador-00000000010'.'-'.$lotacao->getSetor()->getNome(
            ).'-'.$lotacao->getSetor()->getUnidade()->getSigla(),
            $lotacao
        );

        $lotacao = new Lotacao();
        $lotacao->setColaborador($this->getReference('Colaborador-00000000011'));
        $lotacao->setSetor($this->getReference('Setor-PROTOCOLO-AGU-SEDE'));
        $lotacao->setPrincipal(true);

        $this->manager->persist($lotacao);

        $this->addReference(
            'Lotacao-Colaborador-00000000011'.'-'.$lotacao->getSetor()->getNome(
            ).'-'.$lotacao->getSetor()->getUnidade()->getSigla(),
            $lotacao
        );

        $lotacao = new Lotacao();
        $lotacao->setColaborador($this->getReference('Colaborador-00000000012'));
        $lotacao->setSetor($this->getReference('Setor-ARQUIVO-PGF-SEDE'));
        $lotacao->setPrincipal(true);

        $this->manager->persist($lotacao);

        $this->addReference(
            'Lotacao-Colaborador-00000000012'.'-'.$lotacao->getSetor()->getNome(
            ).'-'.$lotacao->getSetor()->getUnidade()->getSigla(),
            $lotacao
        );

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
