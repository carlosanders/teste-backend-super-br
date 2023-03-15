<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Test/LoadTarefaData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Test;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\Tarefa;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadTarefaData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadTarefaData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $tarefa = new Tarefa();
        $tarefa->setProcesso($this->getReference('Processo-TESTE_1'));
        $tarefa->setUrgente(false);
        $tarefa->setDataHoraInicioPrazo(\DateTime::createFromFormat('Y-m-d', '2021-01-05'));
        $tarefa->setDataHoraFinalPrazo(\DateTime::createFromFormat('Y-m-d', '2021-12-05'));
        $tarefa->setEspecieTarefa($this->getReference('EspecieTarefa-ADOTAR PROVIDÊNCIAS ADMINISTRATIVAS'));
        $tarefa->setUsuarioResponsavel($this->getReference('Usuario-00000000002'));
        $tarefa->setSetorResponsavel($this->getReference('Setor-ARQUIVO-PGF-SEDE'));
        $tarefa->setRedistribuida(false);
        $tarefa->setDistribuicaoAutomatica(false);
        $tarefa->setLivreBalanceamento(false);
        $tarefa->setTipoDistribuicao(0);
        $tarefa->setObservacao("TESTE_1");
        $tarefa->setApagadoEm(null);

        // Persist entity
        $this->manager->persist($tarefa);

        // Create reference for later usage
        $this->addReference(
            'Tarefa-TESTE_1',
            $tarefa
        );

        $tarefa = new Tarefa();
        $tarefa->setProcesso($this->getReference('Processo-TESTE_1'));
        $tarefa->setUrgente(false);
        $tarefa->setDataHoraInicioPrazo(\DateTime::createFromFormat('Y-m-d', '2021-07-29'));
        $tarefa->setDataHoraFinalPrazo(\DateTime::createFromFormat('Y-m-d', '2021-07-29'));
        $tarefa->setEspecieTarefa($this->getReference('EspecieTarefa-ADOTAR PROVIDÊNCIAS ADMINISTRATIVAS'));
        $tarefa->setUsuarioResponsavel($this->getReference('Usuario-00000000004'));
        $tarefa->setSetorResponsavel($this->getReference('Setor-ARQUIVO-PGF-SEDE'));
        $tarefa->setRedistribuida(false);
        $tarefa->setDistribuicaoAutomatica(false);
        $tarefa->setLivreBalanceamento(false);
        $tarefa->setTipoDistribuicao(0);
        $tarefa->setObservacao("TESTE_2");
        $tarefa->setApagadoEm(null);

        // Persist entity
        $this->manager->persist($tarefa);

        // Create reference for later usage
        $this->addReference(
            'Tarefa-TESTE_2',
            $tarefa
        );


        $tarefa = new Tarefa();
        $tarefa->setProcesso($this->getReference('Processo-TESTE_1'));
        $tarefa->setUrgente(false);
        $tarefa->setDataHoraInicioPrazo(\DateTime::createFromFormat('Y-m-d', '2021-01-05'));
        $tarefa->setDataHoraFinalPrazo(\DateTime::createFromFormat('Y-m-d', '2021-12-05'));
        $tarefa->setEspecieTarefa($this->getReference('EspecieTarefa-ADOTAR PROVIDÊNCIAS ADMINISTRATIVAS'));
        $tarefa->setUsuarioResponsavel($this->getReference('Usuario-00000000012'));
        $tarefa->setSetorResponsavel($this->getReference('Setor-ARQUIVO-PGF-SEDE'));
        $tarefa->setRedistribuida(false);
        $tarefa->setDistribuicaoAutomatica(false);
        $tarefa->setLivreBalanceamento(false);
        $tarefa->setTipoDistribuicao(0);
        $tarefa->setObservacao("TESTE");
        $tarefa->setApagadoEm(null);

        // Persist entity
        $this->manager->persist($tarefa);

        // Create reference for later usage
        $this->addReference(
            'Tarefa-TESTE_SEM_ATIVIDADE',
            $tarefa
        );

        $tarefa = new Tarefa();
        $tarefa->setProcesso($this->getReference('Processo-TESTE_1'));
        $tarefa->setUrgente(false);
        $tarefa->setDataHoraInicioPrazo(\DateTime::createFromFormat('Y-m-d', '2021-01-05'));
        $tarefa->setDataHoraFinalPrazo(\DateTime::createFromFormat('Y-m-d', '2021-12-05'));
        $tarefa->setEspecieTarefa($this->getReference('EspecieTarefa-ADOTAR PROVIDÊNCIAS ADMINISTRATIVAS'));
        $tarefa->setUsuarioResponsavel($this->getReference('Usuario-00000000001'));
        $tarefa->setSetorResponsavel($this->getReference('Setor-ARQUIVO-PGF-SEDE'));
        $tarefa->setRedistribuida(false);
        $tarefa->setDistribuicaoAutomatica(false);
        $tarefa->setLivreBalanceamento(false);
        $tarefa->setTipoDistribuicao(0);
        $tarefa->setObservacao("TESTE");
        $tarefa->setApagadoEm(\DateTime::createFromFormat('Y-m-d', '2021-06-04'));

        // Persist entity
        $this->manager->persist($tarefa);

        $tarefa = new Tarefa();
        $tarefa->setProcesso($this->getReference('Processo-TESTE_1'));
        $tarefa->setUrgente(false);
        $tarefa->setDataHoraInicioPrazo(\DateTime::createFromFormat('Y-m-d', '2021-01-05'));
        $tarefa->setDataHoraFinalPrazo(\DateTime::createFromFormat('Y-m-d', '2021-12-05'));
        $tarefa->setEspecieTarefa($this->getReference('EspecieTarefa-ADOTAR PROVIDÊNCIAS ADMINISTRATIVAS'));
        $tarefa->setUsuarioResponsavel($this->getReference('Usuario-00000000009'));
        $tarefa->setSetorResponsavel($this->getReference('Setor-ARQUIVO-PGF-SEDE'));
        $tarefa->setRedistribuida(false);
        $tarefa->setDistribuicaoAutomatica(false);
        $tarefa->setLivreBalanceamento(false);
        $tarefa->setTipoDistribuicao(0);
        $tarefa->setObservacao("TESTE");
        $tarefa->setApagadoEm(null);

        // Persist entity
        $this->manager->persist($tarefa);

        // Create reference for later usage
        $this->addReference(
            'Tarefa-TESTE_USER_LEVEL',
            $tarefa
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
