<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Test/LoadJuntadaData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Test;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use SuppCore\AdministrativoBackend\Entity\Juntada;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadJuntadaData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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
     * Load data fixtures with the passed EntityManager.
     *
     * @param \Doctrine\Persistence\ObjectManager $manager
     *
     * @throws Exception
     */
    public function load(ObjectManager $manager): void
    {
        $this->manager = $manager;

        $juntada = new Juntada();

        $juntada->setAtivo(true);
        $juntada->setVinculada(true);
        $juntada->setDescricao("TESTE_11");
        $juntada->setNumeracaoSequencial(1);
        $juntada->setAtividade($this->getReference('Atividade-TESTE_1'));
        $juntada->setDocumento($this->getReference('Documento-TEMPLATE DESPACHO'));
        $juntada->setDocumentoJuntadaAtual($this->getReference('Documento-TEMPLATE DESPACHO'));
        $juntada->setOrigemDados($this->getReference('OrigemDados-FONTE_DADOS_1'));
        $juntada->setTarefa($this->getReference('Tarefa-TESTE_1'));
        $juntada->setVolume($this->getReference('Volume-100'));
        $juntada->setAtualizadoPor($this->getReference('Usuario-00000000004'));
        $juntada->setCriadoPor($this->getReference('Usuario-00000000004'));

        // Persist entity
        $this->manager->persist($juntada);

        // Create reference for later usage
        $this->addReference('Juntada-'.$juntada->getDescricao(), $juntada);

        $juntada = new Juntada();

        $juntada->setAtivo(true);
        $juntada->setVinculada(true);
        $juntada->setDescricao("TESTE_12");
        $juntada->setNumeracaoSequencial(2);
        $juntada->setAtividade($this->getReference('Atividade-TESTE_1'));
        $juntada->setDocumento($this->getReference('Documento-TEMPLATE DESPACHO'));
        $juntada->setDocumentoAvulso($this->getReference('DocumentoAvulso-TESTE_1'));
        $juntada->setDocumentoJuntadaAtual($this->getReference('Documento-TEMPLATE DESPACHO'));
        $juntada->setOrigemDados($this->getReference('OrigemDados-FONTE_DADOS_1'));
        $juntada->setTarefa($this->getReference('Tarefa-TESTE_1'));
        $juntada->setVolume($this->getReference('Volume-200'));
        $juntada->setAtualizadoPor($this->getReference('Usuario-00000000004'));
        $juntada->setCriadoPor($this->getReference('Usuario-00000000004'));

        // Persist entity
        $this->manager->persist($juntada);

        // Create reference for later usage
        $this->addReference('Juntada-'.$juntada->getDescricao(), $juntada);

        $juntada = new Juntada();

        $juntada->setAtivo(true);
        $juntada->setVinculada(true);
        $juntada->setDescricao("TESTE_13");
        $juntada->setNumeracaoSequencial(3);
        $juntada->setAtividade($this->getReference('Atividade-TESTE_1'));
        $juntada->setDocumento($this->getReference('Documento-TEMPLATE-DESPACHO-TESTE'));
        $juntada->setDocumentoAvulso($this->getReference('DocumentoAvulso-TESTE_1'));
        $juntada->setDocumentoJuntadaAtual($this->getReference('Documento-TEMPLATE-DESPACHO-TESTE'));
        $juntada->setOrigemDados($this->getReference('OrigemDados-FONTE_DADOS_1'));
        $juntada->setTarefa($this->getReference('Tarefa-TESTE_1'));
        $juntada->setVolume($this->getReference('Volume-300'));
        $juntada->setAtualizadoPor($this->getReference('Usuario-00000000004'));
        $juntada->setCriadoPor($this->getReference('Usuario-00000000004'));

        // Persist entity
        $this->manager->persist($juntada);

        // Create reference for later usage
        $this->addReference('Juntada-'.$juntada->getDescricao(), $juntada);

        // Flush database changes
        $this->manager->flush();
    }

    /***
     * Get the order of this fixture.
     */
    public function getOrder(): int
    {
        return 6;
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
