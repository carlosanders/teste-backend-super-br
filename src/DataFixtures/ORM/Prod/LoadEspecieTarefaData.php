<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Prod/LoadEspecieTarefaData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Prod;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\EspecieTarefa;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadEspecieTarefaData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadEspecieTarefaData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $especieTarefa = new EspecieTarefa();
        $especieTarefa->setNome('ADOTAR PROVIDÊNCIAS ADMINISTRATIVAS');
        $especieTarefa->setDescricao('ADOTAR PROVIDÊNCIAS ADMINISTRATIVAS');
        $especieTarefa->setGeneroTarefa($this->getReference('GeneroTarefa-ADMINISTRATIVO'));

        $this->manager->persist($especieTarefa);

        $this->addReference(
            'EspecieTarefa-'.$especieTarefa->getNome(),
            $especieTarefa
        );

        $especieTarefa = new EspecieTarefa();
        $especieTarefa->setNome('ANALISAR DEMANDAS');
        $especieTarefa->setDescricao('ANALISAR DEMANDAS');
        $especieTarefa->setGeneroTarefa($this->getReference('GeneroTarefa-ADMINISTRATIVO'));

        $this->manager->persist($especieTarefa);

        $this->addReference(
            'EspecieTarefa-'.$especieTarefa->getNome(),
            $especieTarefa
        );

        $especieTarefa = new EspecieTarefa();
        $especieTarefa->setNome('APROVAR DOCUMENTO');
        $especieTarefa->setDescricao('APROVAR DOCUMENTO');
        $especieTarefa->setGeneroTarefa($this->getReference('GeneroTarefa-ADMINISTRATIVO'));

        $this->manager->persist($especieTarefa);

        $this->addReference(
            'EspecieTarefa-'.$especieTarefa->getNome(),
            $especieTarefa
        );

        $especieTarefa = new EspecieTarefa();
        $especieTarefa->setNome('PARTICIPAR DE REUNIÃO');
        $especieTarefa->setDescricao('PARTICIPAR DE REUNIÃO');
        $especieTarefa->setGeneroTarefa($this->getReference('GeneroTarefa-ADMINISTRATIVO'));
        $especieTarefa->setEvento(true);

        $this->manager->persist($especieTarefa);

        $this->addReference(
            'EspecieTarefa-'.$especieTarefa->getNome(),
            $especieTarefa
        );

        $especieTarefa = new EspecieTarefa();
        $especieTarefa->setNome('DESARQUIVAR/REATIVAR PROCESSO/DOCUMENTO AVULSO');
        $especieTarefa->setDescricao('DESARQUIVAR/REATIVAR PROCESSO/DOCUMENTO AVULSO');
        $especieTarefa->setGeneroTarefa($this->getReference('GeneroTarefa-ARQUIVÍSTICO'));

        $this->manager->persist($especieTarefa);

        $this->addReference(
            'EspecieTarefa-'.$especieTarefa->getNome(),
            $especieTarefa
        );

        $especieTarefa = new EspecieTarefa();
        $especieTarefa->setNome('ELIMINAR PROCESSO/DOCUMENTO AVULSO');
        $especieTarefa->setDescricao('ELIMINAR PROCESSO/DOCUMENTO AVULSO');
        $especieTarefa->setGeneroTarefa($this->getReference('GeneroTarefa-ARQUIVÍSTICO'));

        $this->manager->persist($especieTarefa);

        $this->addReference(
            'EspecieTarefa-'.$especieTarefa->getNome(),
            $especieTarefa
        );

        $especieTarefa = new EspecieTarefa();
        $especieTarefa->setNome('MANTER SOB GUARDA TEMPORÁRIA NO ARQUIVO CORRENTE');
        $especieTarefa->setDescricao('MANTER SOB GUARDA TEMPORÁRIA NO ARQUIVO CORRENTE');
        $especieTarefa->setGeneroTarefa($this->getReference('GeneroTarefa-ARQUIVÍSTICO'));

        $this->manager->persist($especieTarefa);

        $this->addReference(
            'EspecieTarefa-'.$especieTarefa->getNome(),
            $especieTarefa
        );

        $especieTarefa = new EspecieTarefa();
        $especieTarefa->setNome('MARCAR PROCESSO/DOCUMENTO AVULSO COMO EXTRAVIADO');
        $especieTarefa->setDescricao('MARCAR PROCESSO/DOCUMENTO AVULSO COMO EXTRAVIADO');
        $especieTarefa->setGeneroTarefa($this->getReference('GeneroTarefa-ARQUIVÍSTICO'));

        $this->manager->persist($especieTarefa);

        $this->addReference(
            'EspecieTarefa-'.$especieTarefa->getNome(),
            $especieTarefa
        );

        $especieTarefa = new EspecieTarefa();
        $especieTarefa->setNome('RECOLHER PROCESSO/DOCUMENTO AVULSO AO ARQUIVO DEFINITIVO');
        $especieTarefa->setDescricao('RECOLHER PROCESSO/DOCUMENTO AVULSO AO ARQUIVO DEFINITIVO');
        $especieTarefa->setGeneroTarefa($this->getReference('GeneroTarefa-ARQUIVÍSTICO'));

        $this->manager->persist($especieTarefa);

        $this->addReference(
            'EspecieTarefa-'.$especieTarefa->getNome(),
            $especieTarefa
        );

        $especieTarefa = new EspecieTarefa();
        $especieTarefa->setNome('TRANSFERIR PROCESSO/DOCUMENTO AVULSO AO ARQUIVO INTERMEDIÁRIO');
        $especieTarefa->setDescricao('TRANSFERIR PROCESSO/DOCUMENTO AVULSO AO ARQUIVO INTERMEDIÁRIO');
        $especieTarefa->setGeneroTarefa($this->getReference('GeneroTarefa-ARQUIVÍSTICO'));

        $this->manager->persist($especieTarefa);

        $this->addReference(
            'EspecieTarefa-'.$especieTarefa->getNome(),
            $especieTarefa
        );

        $especieTarefa = new EspecieTarefa();
        $especieTarefa->setNome('ELABORAR MINUTA DE ATO NORMATIVO');
        $especieTarefa->setDescricao('ELABORAR MINUTA DE ATO NORMATIVO');
        $especieTarefa->setGeneroTarefa($this->getReference('GeneroTarefa-ADMINISTRATIVO'));

        $this->manager->persist($especieTarefa);

        $this->addReference(
            'EspecieTarefa-'.$especieTarefa->getNome(),
            $especieTarefa
        );

        $especieTarefa = new EspecieTarefa();
        $especieTarefa->setNome('REVISAR MINUTA DE ATO NORMATIVO');
        $especieTarefa->setDescricao('REVISAR MINUTA DE ATO NORMATIVO');
        $especieTarefa->setGeneroTarefa($this->getReference('GeneroTarefa-ADMINISTRATIVO'));

        $this->manager->persist($especieTarefa);

        $this->addReference(
            'EspecieTarefa-'.$especieTarefa->getNome(),
            $especieTarefa
        );

        $especieTarefa = new EspecieTarefa();
        $especieTarefa->setNome('ASSINAR MINUTA DE ATO NORMATIVO');
        $especieTarefa->setDescricao('ASSINAR MINUTA DE ATO NORMATIVO');
        $especieTarefa->setGeneroTarefa($this->getReference('GeneroTarefa-ADMINISTRATIVO'));

        $this->manager->persist($especieTarefa);

        $this->addReference(
            'EspecieTarefa-'.$especieTarefa->getNome(),
            $especieTarefa
        );

        $especieTarefa = new EspecieTarefa();
        $especieTarefa->setNome('PUBLICAR MINUTA DE ATO NORMATIVO');
        $especieTarefa->setDescricao('PUBLICAR MINUTA DE ATO NORMATIVO');
        $especieTarefa->setGeneroTarefa($this->getReference('GeneroTarefa-ADMINISTRATIVO'));

        $this->manager->persist($especieTarefa);

        $this->addReference(
            'EspecieTarefa-'.$especieTarefa->getNome(),
            $especieTarefa
        );

        $especieTarefa = new EspecieTarefa();
        $especieTarefa->setNome('MANTER SOB GUARDA NO ARQUIVO CORRENTE');
        $especieTarefa->setDescricao('MANTER SOB GUARDA NO ARQUIVO CORRENTE');
        $especieTarefa->setGeneroTarefa($this->getReference('GeneroTarefa-ADMINISTRATIVO'));

        $this->manager->persist($especieTarefa);

        $this->addReference(
            'EspecieTarefa-'.$especieTarefa->getNome(),
            $especieTarefa
        );

        $especieTarefa = new EspecieTarefa();
        $especieTarefa->setNome('DAR ANDAMENTO AO PROCESSO');
        $especieTarefa->setDescricao('ADMINISTRATIVO');
        $especieTarefa->setGeneroTarefa($this->getReference('GeneroTarefa-ADMINISTRATIVO'));
        $this->manager->persist($especieTarefa);

        $this->addReference(
            'EspecieTarefa-'.$especieTarefa->getNome(),
            $especieTarefa
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
        return ['prod', 'dev', 'test'];
    }
}
