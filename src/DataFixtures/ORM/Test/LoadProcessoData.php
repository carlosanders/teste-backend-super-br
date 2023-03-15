<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Test/LoadProcessoData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Test;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\Processo;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadProcessoData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadProcessoData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $processo = new Processo();
        $processo->setUnidadeArquivistica(10);
        $processo->setTipoProtocolo(110);
        $processo->setSemValorEconomico(false);
        $processo->setProtocoloEletronico(false);
        $processo->setNUP('TESTE_1');
        $processo->setEspecieProcesso($this->getReference('EspecieProcesso-COMUM'));
        $processo->setVisibilidadeExterna(true);
        $processo->setDataHoraAbertura(\DateTime::createFromFormat('Y-m-d', '2021-01-05'));
        $processo->setTitulo('TESTE_1');
        $processo->setChaveAcesso('TESTE_1');
        $processo->setModalidadeFase($this->getReference('ModalidadeFase-CORRENTE'));
        $processo->setModalidadeMeio($this->getReference('ModalidadeMeio-FÍSICO'));
        $processo->setClassificacao($this->getReference('Classificacao2'));
        $processo->setProcedencia($this->getReference('Pessoa-12312312387'));
        $processo->setSetorAtual($this->getReference('Unidade-PROCURADORIA-GERAL FEDERAL'));
        $processo->setSetorInicial($this->getReference('Unidade-PROCURADORIA-GERAL FEDERAL'));

        // Persist entity
        $this->manager->persist($processo);

        // Create reference for later usage
        $this->addReference(
            'Processo-'.$processo->getChaveAcesso(),
            $processo
        );

        $processo = new Processo();
        $processo->setUnidadeArquivistica(11);
        $processo->setTipoProtocolo(111);
        $processo->setSemValorEconomico(false);
        $processo->setProtocoloEletronico(false);
        $processo->setNUP('TESTE_2');
        $processo->setEspecieProcesso($this->getReference('EspecieProcesso-COMUM'));
        $processo->setVisibilidadeExterna(true);
        $processo->setDataHoraAbertura(\DateTime::createFromFormat('Y-m-d', '2021-01-05'));
        $processo->setTitulo('TESTE_2');
        $processo->setChaveAcesso('TESTE_2');
        $processo->setModalidadeFase($this->getReference('ModalidadeFase-CORRENTE'));
        $processo->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        $processo->setClassificacao($this->getReference('Classificacao2'));
        $processo->setProcedencia($this->getReference('Pessoa-12312312387'));
        $processo->setSetorAtual($this->getReference('Setor-SECRETARIA-1-SECR'));
        $processo->setSetorInicial($this->getReference('Setor-SECRETARIA-1-SECR'));

        // Persist entity
        $this->manager->persist($processo);

        // Create reference for later usage
        $this->addReference(
            'Processo-'.$processo->getChaveAcesso(),
            $processo
        );

        $processo = new Processo();
        $processo->setUnidadeArquivistica(11);
        $processo->setTipoProtocolo(111);
        $processo->setSemValorEconomico(false);
        $processo->setProtocoloEletronico(false);
        $processo->setNUP('TESTE_TRAMITAÇÃO');
        $processo->setEspecieProcesso($this->getReference('EspecieProcesso-COMUM'));
        $processo->setVisibilidadeExterna(true);
        $processo->setDataHoraAbertura(\DateTime::createFromFormat('Y-m-d', '2021-01-05'));
        $processo->setTitulo('TESTE_TRAMITAÇÃO');
        $processo->setChaveAcesso('TESTE_TRAMITAÇÃO');
        $processo->setModalidadeFase($this->getReference('ModalidadeFase-CORRENTE'));
        $processo->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        $processo->setClassificacao($this->getReference('Classificacao2'));
        $processo->setProcedencia($this->getReference('Pessoa-12312312387'));
        $processo->setSetorAtual($this->getReference('Setor-SECRETARIA-1-SECR'));
        $processo->setSetorInicial($this->getReference('Setor-SECRETARIA-1-SECR'));

        // Persist entity
        $this->manager->persist($processo);

        // Create reference for later usage
        $this->addReference(
            'Processo-'.$processo->getChaveAcesso(),
            $processo
        );


        $processo = new Processo();
        $processo->setUnidadeArquivistica(11);
        $processo->setTipoProtocolo(111);
        $processo->setSemValorEconomico(false);
        $processo->setProtocoloEletronico(false);
        $processo->setNUP('TESTE_3');
        $processo->setEspecieProcesso($this->getReference('EspecieProcesso-COMUM'));
        $processo->setVisibilidadeExterna(true);
        $processo->setDataHoraAbertura(\DateTime::createFromFormat('Y-m-d', '2021-01-05'));
        $processo->setTitulo('TESTE_3');
        $processo->setChaveAcesso('TESTE_3');
        $processo->setModalidadeFase($this->getReference('ModalidadeFase-CORRENTE'));
        $processo->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        $processo->setClassificacao($this->getReference('Classificacao2'));
        $processo->setProcedencia($this->getReference('Pessoa-12312312387'));
        $processo->setSetorAtual($this->getReference('Setor-ARQUIVO-PGF-SEDE'));
        $processo->setSetorInicial($this->getReference("Setor-SECRETARIA-1-SECR"));

        // Persist entity
        $this->manager->persist($processo);

        // Create reference for later usage
        $this->addReference(
            'Processo-'.$processo->getChaveAcesso(),
            $processo
        );

        $processo = new Processo();
        $processo->setUnidadeArquivistica(10);
        $processo->setTipoProtocolo(110);
        $processo->setSemValorEconomico(false);
        $processo->setProtocoloEletronico(false);
        $processo->setNUP('TESTE_4');
        $processo->setEspecieProcesso($this->getReference('EspecieProcesso-COMUM'));
        $processo->setVisibilidadeExterna(true);
        $processo->setDataHoraAbertura(\DateTime::createFromFormat('Y-m-d', '2021-01-05'));
        $processo->setTitulo('TESTE_4');
        $processo->setChaveAcesso('TESTE_4');
        $processo->setModalidadeFase($this->getReference('ModalidadeFase-CORRENTE'));
        $processo->setModalidadeMeio($this->getReference('ModalidadeMeio-FÍSICO'));
        $processo->setClassificacao($this->getReference('Classificacao2'));
        $processo->setProcedencia($this->getReference('Pessoa-12312312387'));
        $processo->setSetorAtual($this->getReference('Unidade-PROCURADORIA-GERAL FEDERAL'));
        $processo->setSetorInicial($this->getReference('Unidade-PROCURADORIA-GERAL FEDERAL'));

        // Persist entity
        $this->manager->persist($processo);

        // Create reference for later usage
        $this->addReference(
            'Processo-'.$processo->getChaveAcesso(),
            $processo
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
