<?php
#PROD
declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/ProdExec/LoadClassificacaoData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\ProdExec;

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
    public function load(\Doctrine\Persistence\ObjectManager $manager): void
    {
        $this->manager = $manager;

        $classificacao = new Classificacao();
        $classificacao->setNome('ADMINISTRAÇÃO GERAL');
        $classificacao->setPermissaoUso(False);
        $classificacao->setCodigo('000');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('000', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('RELAÇÃO INTERINSTITUCIONAL');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('001');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Enquanto vigora');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(20);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('001', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ATENDIMENTO AO CIDADÃO');
        $classificacao->setPermissaoUso(False);
        $classificacao->setCodigo('002');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('002', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('NORMATIZAÇÃO. REGULAMENTAÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('002.01');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Enquanto vigora');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('002.01', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ACESSO À INFORMAÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('002.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('002.1', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PEDIDO DE ACESSO À INFORMAÇÃO E RECURSO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('002.11');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até o término do atendimento*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* Aguardar o resultado do provimento do recurso em última instância, no caso de indeferimento do pedido de acesso.');
        $this->addReference('002.11', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ACOMPANHAMENTO DO ATENDIMENTO AO CIDADÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('002.12');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(2);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao('Eliminar, após 2 anos, os documentos cujas informações estejam recapituladas ou consolidadas em outros.');
        $this->addReference('002.12', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONTROLE DE SATISFAÇÃO DO USUÁRIO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('002.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(2);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('002.2', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONTROLE E FISCALIZAÇÃO DA GESTÃO PÚBLICA');
        $classificacao->setPermissaoUso(False);
        $classificacao->setCodigo('003');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao('Eliminar, após 2 anos, os documentos cujas informações estejam recapituladas ou consolidadas em outros.');
        $this->addReference('003', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('NORMATIZAÇÃO. REGULAMENTAÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('003.01');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Enquanto vigora');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('003.01', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONTROLE INTERNO. AUDITORIA INTERNA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('003.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(9);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('003.1', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('AÇÃO PREVENTIVA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('003.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(9);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('003.2', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CORREIÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('003.3');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(9);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('003.3', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ASSESSORAMENTO JURÍDICO');
        $classificacao->setPermissaoUso(False);
        $classificacao->setCodigo('004');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('004', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ORIENTAÇÃO TÉCNICA E NORMATIVA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('004.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('004.1', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('UNIFORMIZAÇÃO DO ENTENDIMENTO JURÍDICO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('004.11');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Enquanto vigora');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('004.11', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ANÁLISE DOS INSTRUMENTOS ADMINISTRATIVOS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('004.12');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até o término da análise');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('004.12', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ATUAÇÃO EM CONTENCIOSO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('004.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('004.2', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('REPRESENTAÇÃO EXTRAJUDICIAL');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('004.21');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a solução do litígio');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('004.21', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('REPRESENTAÇÃO JUDICIAL');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('004.22');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até o trânsito em julgado');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('004.22', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PARTICIPAÇÃO EM ÓRGÃOS COLEGIADOS');
        $classificacao->setPermissaoUso(False);
        $classificacao->setCodigo('005');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('005', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CRIAÇÃO E ATUAÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('005.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(4);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('005.1', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('OPERACIONALIZAÇÃO DE REUNIÕES');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('005.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(2);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('005.2', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ORGANIZAÇÃO E FUNCIONAMENTO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('010');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('010', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('NORMATIZAÇÃO. REGULAMENTAÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('010.01');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Enquanto vigora');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('010.01', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ORGANIZAÇÃO ADMINISTRATIVA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('011');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Enquanto vigora');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao('Eliminar, após 2 anos, os estudos preliminares ou as versões não implementadas das mudanças estruturais.');
        $this->addReference('011', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('HABILITAÇÃO JURÍDICA E REGULARIZAÇÃO FISCAL');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('012');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Enquanto vigora');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(2);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('012', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('COORDENAÇÃO E GESTÃO DE REUNIÕES');
        $classificacao->setPermissaoUso(False);
        $classificacao->setCodigo('013');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('013', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('OPERACIONALIZAÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('013.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(2);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('013.1', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('REGISTRO DE DELIBERAÇÕES');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('013.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(4);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('013.2', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PREENCHIMENTO DE FUNÇÃO DE DIREÇÃO');
        $classificacao->setPermissaoUso(False);
        $classificacao->setCodigo('014');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('014', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('NOMEAÇÃO E ATUAÇÃO DA COMISSÃO ELEITORAL');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('014.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a homologação do evento');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(1);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('014.1', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('INSCRIÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('014.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a homologação do evento');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(1);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('014.2', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('VOTAÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('014.3');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a homologação do evento');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(1);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao('Eliminar, após 2 anos da homologação do evento, as cédulas de votação.');
        $this->addReference('014.3', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DIVULGAÇÃO DOS RESULTADOS E INTERPOSIÇÃO DE RECURSOS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('014.4');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a homologação do evento');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(1);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao('* Aguardar o término da ação, no caso de interposição de recursos. Eliminar, após 2 anos da homologação do evento, os documentos de recursos indeferidos.');
        $this->addReference('014.4', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('GESTÃO INSTITUCIONAL');
        $classificacao->setPermissaoUso(False);
        $classificacao->setCodigo('015');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('015', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PLANEJAMENTO INSTITUCIONAL');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('015.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(9);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('015.1', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ACOMPANHAMENTO DAS ATIVIDADES');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('015.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(9);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao('Eliminar, após 2 anos, os documentos cujas informações encontram-se recapituladas ou consolidadas em outros.');
        $this->addReference('015.2', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('AVALIAÇÃO DA GESTÃO INSTITUCIONAL');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('015.3');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao('Eliminar, após 2 anos, os documentos cujas informações encontram-se recapituladas ou consolidadas em outros.');
        $this->addReference('015.3', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ELABORAÇÃO DOS INSTRUMENTOS DE AVALIAÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('015.31');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(9);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('015.31', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('EXECUÇÃO E ACOMPANHAMENTO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('015.32');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(9);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('015.32', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CERTIFICAÇÃO DA CONFORMIDADE');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('015.33');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(9);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('015.33', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('GESTÃO DE PROCESSOS');
        $classificacao->setPermissaoUso(False);
        $classificacao->setCodigo('016');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('016', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PLANEJAMENTO DO MAPEAMENTO DE PROCESSOS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('016.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(9);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('016.1', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('EXECUÇÃO E ACOMPANHAMENTO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('016.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(9);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('016.2', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('RESULTADO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('016.3');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(9);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao('Eliminar, após 2 anos, os documentos cujas informações encontram-se recapituladas ou consolidadas em outros.');
        $this->addReference('016.3', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('MODELAGEM DE PROCESSOS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('016.4');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(9);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('016.4', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('GERENCIAMENTO DE DESEMPENHO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('016.5');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(9);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao('Eliminar, após 2 anos, os documentos cujas informações encontram-se recapituladas ou consolidadas em outros.');
        $this->addReference('016.5', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('GESTÃO AMBIENTAL');
        $classificacao->setPermissaoUso(False);
        $classificacao->setCodigo('017');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('017', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PROTEÇÃO AMBIENTAL INTERNA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('017.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(2);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('Arquivar um exemplar do material de divulgação produzido para cada evento.');
        $this->addReference('017.1', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PROTEÇÃO AMBIENTAL EXTERNA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('017.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(9);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao('Eliminar, após 2 anos, os documentos cujas informações encontram-se recapituladas ou consolidadas em outros.');
        $this->addReference('017.2', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONTRATAÇÃO DE PRESTAÇÃO DE SERVIÇOS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('018');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da aprovação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão Eliminar, após 2 anos, os documentos referentes às contratações não efetivadas.');
        $this->addReference('018', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('OUTRAS AÇÕES REFERENTES À ORGANIZAÇÃO E FUNCIONAMENTO');
        $classificacao->setPermissaoUso(False);
        $classificacao->setCodigo('019');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('019', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('COMUNICAÇÃO SOCIAL');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('019.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('019.1', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('COMUNICAÇÃO EXTERNA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('019.11');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('019.11', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CREDENCIAMENTO DE JORNALISTAS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('019.111');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Enquanto vigora');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(1);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('019.111', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('RELAÇÃO COM A IMPRENSA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('019.112');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(1);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('Arquivar os documentos cujas informações reflitam a política do órgão ou entidade.');
        $this->addReference('019.112', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ELABORAÇÃO DE CAMPANHAS PUBLICITÁRIAS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('019.113');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(4);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(10);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('019.113', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('COMUNICAÇÃO INTERNA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('019.12');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(2);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('Arquivar os documentos cujas informações reflitam a política do órgão ou entidade.');
        $this->addReference('019.12', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('AÇÃO DE RESPONSABILIDADE SOCIAL');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('019.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(9);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao('Eliminar, após 2 anos, os documentos cujas informações encontram-se recapituladas ou consolidadas em outros.');
        $this->addReference('019.2', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('GESTÃO DE PESSOAS');
        $classificacao->setPermissaoUso(False);
        $classificacao->setCodigo('020');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('020', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('NORMATIZAÇÃO. REGULAMENTAÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('020.01');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Enquanto vigora');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('020.01', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('IMPLEMENTAÇÃO DAS POLÍTICAS DE PESSOAL');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('020.02');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('020.02', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PLANEJAMENTO DA FORÇA DE TRABALHO. PREVISÃO DE PESSOAL');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('020.021');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('020.021', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CRIAÇÃO, EXTINÇÃO, CLASSIFICAÇÃO, TRANSFORMAÇÃO E TRANSPOSIÇÃO DE CARGOS E DE CARREIRAS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('020.022');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('020.022', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('RELACIONAMENTO COM ENTIDADES REPRESENTATIVAS DE CLASSES');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('020.03');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('020.03', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('RELAÇÃO COM SINDICATOS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('020.031');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('020.031', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('MOVIMENTOS REIVINDICATÓRIOS. GREVES. PARALISAÇÕES');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('020.032');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('020.032', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('RELAÇÃO COM CONSELHOS PROFISSIONAIS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('020.033');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(2);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao('ELIMINAÇÃO');
        $this->addReference('020.033', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ASSENTAMENTO FUNCIONAL');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('020.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('020.1', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('SERVIDORES E EMPREGADOS PÚBLICOS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('020.11');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Enquanto o servidor mantiver o vínculo com a administração pública');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* Transferir os documentos para fase intermediária após o  término  do  vínculo,  sendo  o  prazo  total  de  guarda  dos documentos de 100 anos.');
        $this->addReference('020.11', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('SERVIDORES TEMPORÁRIOS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('020.12');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Enquanto o servidor mantiver o vínculo com a administração pública');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* Transferir os documentos para fase intermediária após o  término  do  vínculo,  sendo  o  prazo  total  de  guarda  dos documentos de 100 anos.');
        $this->addReference('020.12', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('RESIDENTES E ESTAGIÁRIOS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('020.13');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Enquanto o servidor mantiver o vínculo com a administração pública');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* Transferir os documentos para fase intermediária após o término do vínculo, sendo o prazo total de guarda dos documentos de 100 anos.');
        $this->addReference('020.13', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('OCUPANTES DE CARGO COMISSIONADO E DE FUNÇÃO DE CONFIANÇA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('020.14');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Enquanto o servidor mantiver o vínculo com a administração pública');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* Transferir os documentos para fase intermediária após o término do vínculo, sendo o prazo total de guarda dos documentos de 100 anos.');
        $this->addReference('020.14', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('IDENTIFICAÇÃO FUNCIONAL');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('020.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Enquanto o servidor mantiver o vínculo com a administração pública');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('020.2', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('RECRUTAMENTO E SELEÇÃO');
        $classificacao->setPermissaoUso(False);
        $classificacao->setCodigo('021');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('021', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PLANEJAMENTO DO PROCESSO SELETIVO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('021.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a homologação do evento');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(2);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('021.1', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('INSCRIÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('021.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a homologação do evento*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(2);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* Aguardar o término da ação, no caso de interposição de recursos.');
        $this->addReference('021.2', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONTROLE DE APLICAÇÃO DE PROVAS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('021.3');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a homologação do evento*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(2);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* Aguardar o término da ação, no caso de interposição de recursos.');
        $this->addReference('021.3', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CORREÇÃO DE PROVAS. AVALIAÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('021.4');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a homologação do evento*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(2);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* Aguardar o término da ação, no caso de interposição de recursos.');
        $this->addReference('021.4', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DIVULGAÇÃO DOS RESULTADOS E INTERPOSIÇÃO DE RECURSOS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('021.5');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a homologação do evento*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(2);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao('* Aguardar o término da ação, no caso de interposição de recursos. Eliminar, após 2 anos da homologação do evento, os documentos de recursos indeferidos.');
        $this->addReference('021.5', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PROVIMENTO, MOVIMENTAÇÃO E VACÂNCIA');
        $classificacao->setPermissaoUso(False);
        $classificacao->setCodigo('022');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('022', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PROVIMENTO DE CARGO PÚBLICO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('022.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(52);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('022.1', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('MOVIMENTAÇÃO DE PESSOAL');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('022.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('022.2', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('LOTAÇÃO, EXERCÍCIO E PERMUTA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('022.21');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(4);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('022.21', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CESSÃO. REQUISIÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('022.22');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(52);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('022.22', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('REMOÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('022.3');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(4);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('022.3', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('REDISTRIBUIÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('022.4');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(52);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('022.4', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('SUBSTITUIÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('022.5');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(52);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('022.5', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('AVALIAÇÃO DE DESEMPENHO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('022.6');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('022.6', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CUMPRIMENTO DE ESTÁGIO PROBATÓRIO. HOMOLOGAÇÃO DA ESTABILIDADE.');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('022.61');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(52);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('022.61', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CUMPRIMENTO DE PERÍODO DE EXPERIÊNCIA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('022.62');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(52);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('022.62', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PROMOÇÃO E PROGRESSÃO FUNCIONAL');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('022.63');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(52);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('022.63', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('VACÂNCIA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('022.7');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(52);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('022.7', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONCESSÃO DE DIREITOS E VANTAGENS');
        $classificacao->setPermissaoUso(False);
        $classificacao->setCodigo('023');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('023', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PAGAMENTO DE VENCIMENTOS. REMUNERAÇÕES. SALÁRIOS. PROVENTOS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('023.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('023.1', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('FOLHAS DE PAGAMENTO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('023.11');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(95);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('023.11', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('REESTRUTURAÇÃO E ALTERAÇÃO SALARIAL');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('023.12');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(52);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('023.12', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ABONO PROVISÓRIO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('023.13');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(7);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('023.13', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ABONO DE PERMANÊNCIA EM SERVIÇO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('023.14');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a homologação da aposentadoria');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('023.14', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('GRATIFICAÇÕES');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('023.15');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('023.15', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('FUNÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('023.151');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(52);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('023.151', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('JETONS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('023.152');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(7);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('023.152', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CARGOS EM COMISSÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('023.153');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(52);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('023.153', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('NATALINA. DÉCIMO TERCEIRO SALÁRIO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('023.154');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(7);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('023.154', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DESEMPENHO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('023.155');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(52);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('023.155', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ENCARGO DE CURSO E CONCURSO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('023.156');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(7);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('023.156', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('TITULAÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('023.157');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(52);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('023.157', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ADICIONAIS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('023.16');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('023.16', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('TEMPO DE SERVIÇO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('023.161');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(52);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('023.161', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('NOTURNO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('023.162');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(52);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('023.162', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PERICULOSIDADE');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('023.163');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(52);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('023.163', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('INSALUBRIDADE');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('023.164');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(52);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('023.164', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ATIVIDADE PENOSA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('023.165');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(52);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('023.165', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('SERVIÇO EXTRAORDINÁRIO. HORAS EXTRAS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('023.166');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(52);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('023.166', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('UM TERÇO DE FÉRIAS. ABONO PECUNIÁRIO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('023.167');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(7);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('023.167', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DESCONTOS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('023.17');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('023.17', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONTRIBUIÇÃO SINDICAL, ASSISTENCIAL E CONFEDERATIVA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('023.171');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(7);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('023.171', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONTRIBUIÇÃO PARA O PLANO DE SEGURIDADE SOCIAL');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('023.172');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(52);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('023.172', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('IMPOSTO DE RENDA RETIDO NA FONTE (IRRF)');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('023.173');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(7);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('023.173', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PENSÃO ALIMENTÍCIA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('023.174');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(95);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('023.174', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONSIGNAÇÕES FACULTATIVAS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('023.175');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Enquanto vigora a consignação');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(7);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('023.175', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('OBRIGAÇÕES TRABALHISTAS E ESTATUTÁRIAS, ENCARGOS PATRONAIS E RECOLHIMENTOS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('023.18');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('023.18', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PROGRAMA DE FORMAÇÃO DO PATRIMÔNIO DO SERVIDOR PÚBLICO (PASEP). PROGRAMA DE INTEGRAÇÃO SOCIAL (PIS)');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('023.181');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('023.181', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('FUNDO DE GARANTIA DO TEMPO DE SERVIÇO (FGTS)');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('023.182');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(52);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('023.182', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONTRIBUIÇÃO SINDICAL DO EMPREGADOR');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('023.183');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(7);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('023.183', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONTRIBUIÇÃO PARA O PLANO DE SEGURIDADE SOCIAL');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('023.184');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(95);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('023.184', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('IMPOSTO DE RENDA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('023.185');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(7);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('023.185', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('LEI DOS DOIS TERÇOS. RELAÇÃO ANUAL DE INFORMAÇÕES SOCIAIS (RAIS)');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('023.186');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('023.186', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('OUTRAS AÇÕES REFERENTES AO PAGAMENTO DE VENCIMENTOS. REMUNERAÇÕES. SALÁRIOS. PROVENTOS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('023.19');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('023.19', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('RETIFICAÇÃO DE PAGAMENTO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('023.191');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(7);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('023.191', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('FÉRIAS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('023.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(7);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('023.2', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('LICENÇAS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('023.3');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(52);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('023.3', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('AFASTAMENTOS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('023.4');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(52);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('023.4', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONCESSÕES');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('023.5');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(52);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('023.5', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('AUXÍLIOS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('023.6');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('023.6', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('REEMBOLSO DE DESPESAS. INDENIZAÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('023.7');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('023.7', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('MUDANÇA DE DOMICÍLIO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('023.71');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('023.71', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('LOCOMOÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('023.72');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('023.72', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('RESSARCIMENTO DE PLANO DE SAÚDE');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('023.73');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('023.73', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('OUTRAS AÇÕES REFERENTES À CONCESSÃO DE DIREITOS E VANTAGENS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('023.9');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('023.9', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONTRATAÇÃO DE SEGURO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('023.91');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('023.91', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('OCUPAÇÃO DE IMÓVEL FUNCIONAL');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('023.92');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Enquanto permanecer a ocupação');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('023.92', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('FORNECIMENTO DE TRANSPORTE');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('023.93');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('023.93', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CAPACITAÇÃO DO SERVIDOR');
        $classificacao->setPermissaoUso(False);
        $classificacao->setCodigo('024');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao('Utilizar os prazos de guarda e a destinação final dos assentamentos funcionais para os documentos comprobatórios de participação.');
        $this->addReference('024', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PLANEJAMENTO DA CAPACITAÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('024.01');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('024.01', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PROMOÇÃO DE CURSOS PELO ÓRGÃO E ENTIDADE');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('024.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('024.1', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PROGRAMAÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('024.11');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('024.11', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('INSCRIÇÃO E FREQUÊNCIA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('024.12');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('024.12', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('AVALIAÇÃO E RESULTADOS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('024.13');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('024.13', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PARTICIPAÇÃO EM CURSOS PROMOVIDOS POR OUTROS ÓRGÃOS E ENTIDADES');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('024.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('024.2', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PROMOÇÃO DE ESTÁGIOS PELO ÓRGÃO E ENTIDADE');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('024.3');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('024.3', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PROGRAMAÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('024.31');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('024.31', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('INSCRIÇÃO E FREQUÊNCIA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('024.32');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('024.32', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('AVALIAÇÃO E RESULTADOS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('024.33');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('024.33', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PARTICIPAÇÃO EM ESTÁGIOS PROMOVIDOS POR OUTROS ÓRGÃOS E ENTIDADES');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('024.4');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('024.4', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONCESSÃO DE ESTÁGIOS E BOLSAS PARA ESTUDANTES');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('024.5');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('024.5', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('RELAÇÃO COM INSTITUIÇÕES DE ENSINO E AGENTES DE INTEGRAÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('024.51');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Enquanto vigora o convênio');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(2);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('024.51', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PLANO DE ESTÁGIO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('024.52');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Enquanto o estudante mantiver o vínculo com a administração pública');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(2);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('024.52', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PROMOÇÃO DA SAÚDE E BEM-ESTAR');
        $classificacao->setPermissaoUso(False);
        $classificacao->setCodigo('025');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('025', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ASSISTÊNCIA À SAÚDE');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('025.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('025.1', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CELEBRAÇÃO DE CONVÊNIOS DE PLANOS DE SAÚDE');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('025.11');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('025.11', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ORIENTAÇÃO MÉDICA, NUTRICIONAL, ODONTOLÓGICA E PSICOLÓGICA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('025.12');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(2);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('025.12', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PROMOÇÃO DE ATIVIDADE FÍSICA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('025.13');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(2);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('025.13', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PRONTUÁRIO MÉDICO E ODONTOLÓGICO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('025.14');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(95);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('025.14', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PRESERVAÇÃO DA SAÚDE E HIGIENE');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('025.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('025.2', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONTROLE DE RISCOS AMBIENTAIS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('025.21');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(15);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('025.21', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('OFERTA DE SERVIÇOS DE REFEITÓRIOS, CANTINAS E COPAS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('025.22');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Enquanto vigora');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(2);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('025.22', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('SEGURANÇA DO TRABALHO. PREVENÇÃO DE ACIDENTES DE TRABALHO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('025.3');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('025.3', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONSTITUIÇÃO DA COMISSÃO INTERNA DE PREVENÇÃO DE ACIDENTES (CIPA)');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('025.31');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('025.31', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('COMPOSIÇÃO E ATUAÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('025.311');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('025.311', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('OPERACIONALIZAÇÃO DE REUNIÕES');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('025.312');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(2);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('025.312', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('REGISTRO DE OCORRÊNCIAS DE ACIDENTES DE TRABALHO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('025.32');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(52);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('025.32', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONCESSÃO DE BENEFÍCIOS DE SEGURIDADE E PREVIDÊNCIA SOCIAL');
        $classificacao->setPermissaoUso(False);
        $classificacao->setCodigo('026');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('026', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ADESÃO À PREVIDÊNCIA COMPLEMENTAR');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('026.01');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(52);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('026.01', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONTAGEM E AVERBAÇÃO DE TEMPO DE SERVIÇO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('026.02');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a homologação da aposentadoria');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('026.02', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('SALÁRIO FAMÍLIA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('026.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(19);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou 95 anos, nos casos previstos na legislação específica para as concessões especiais');
        $this->addReference('026.1', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('SALÁRIO MATERNIDADE');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('026.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(7);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('026.2', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('AUXÍLIOS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('026.3');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('026.3', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('LICENÇAS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('026.4');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(52);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('026.4', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('APOSENTADORIA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('026.5');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('026.5', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('INVALIDEZ PERMANENTE');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('026.51');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(95);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('026.51', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('COMPULSÓRIA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('026.52');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(95);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('026.52', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('VOLUNTÁRIA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('026.53');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(95);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('026.53', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ESPECIAL');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('026.54');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(95);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('026.54', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PENSÃO POR MORTE');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('026.6');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('026.6', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PENSÃO PROVISÓRIA. PENSÃO TEMPORÁRIA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('026.61');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Enquanto vigora');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('026.61', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PENSÃO VITALÍCIA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('026.62');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(95);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('026.62', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('OUTRAS AÇÕES REFERENTES À CONCESSÃO DE BENEFÍCIOS DE SEGURIDADE E PREVIDÊNCIA SOCIAL');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('026.9');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('026.9', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('AUXÍLIO RECLUSÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('026.91');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(52);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('026.91', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('APURAÇÃO DE RESPONSABILIDADE DISCIPLINAR');
        $classificacao->setPermissaoUso(False);
        $classificacao->setCodigo('027');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('027', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('AVERIGUAÇÃO DE DENÚNCIAS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('027.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(95);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('027.1', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('APLICAÇÃO DE PENALIDADES DISCIPLINARES');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('027.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(95);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('027.2', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('AJUSTAMENTO DE CONDUTA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('027.3');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(52);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('027.3', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CUMPRIMENTO DE MISSÕES E VIAGENS A SERVIÇO');
        $classificacao->setPermissaoUso(False);
        $classificacao->setCodigo('028');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('028', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('NO PAÍS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('028.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('028.1', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('COM ÔNUS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('028.11');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('028.11', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('COM ÔNUS LIMITADO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('028.12');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(7);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('028.12', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('NO EXTERIOR');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('028.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('028.2', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('COM ÔNUS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('028.21');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('028.21', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('COM ÔNUS LIMITADO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('028.22');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(7);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('028.22', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('SEM ÔNUS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('028.23');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(7);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('028.23', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('OUTRAS AÇÕES REFERENTES À GESTÃO DE PESSOAS');
        $classificacao->setPermissaoUso(False);
        $classificacao->setCodigo('029');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('029', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONTROLE DE ASSIDUIDADE E PONTUALIDADE');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('029.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('029.1', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONTROLE DE FREQUÊNCIA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('029.11');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(52);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('029.11', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DEFINIÇÃO DO HORÁRIO DE EXPEDIENTE');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('029.12');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(2);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('029.12', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('INSTITUIÇÃO DO PROGRAMA DE CRECHE');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('029.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('029.2', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PUBLICAÇÃO E DIVULGAÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('029.21');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('029.21', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('INSCRIÇÃO, SELEÇÃO, ADMISSÃO E RENOVAÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('029.22');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Enquanto vigora o vínculo do beneficiário');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(10);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('029.22', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ACOMPANHAMENTO PEDAGÓGICO, MÉDICO E DO DESENVOLVIMENTO DA CRIANÇA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('029.23');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Enquanto vigora o vínculo do beneficiário');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(10);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('029.23', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('AVALIAÇÃO DO PROGRAMA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('029.24');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao('Eliminar, após 2 anos, os documentos cujas informações encontram-se recapituladas ou consolidadas em outros.');
        $this->addReference('029.24', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('INCENTIVOS FUNCIONAIS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('029.3');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('029.3', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DELEGAÇÃO DE COMPETÊNCIA E PROCURAÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('029.4');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Enquanto vigora');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('Utilizar  os  prazos  dos  documentos  financeiros  para  os documentos referentes aos ordenadores de despesas.');
        $this->addReference('029.4', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONTRATAÇÃO DE SERVIÇOS PROFISSIONAIS TRANSITÓRIOS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('029.5');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão Eliminar, após 2 anos, os documentos referentes às con- tratações não efetivadas.');
        $this->addReference('029.5', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PETIÇÃO DE DIREITOS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('029.6');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a solução da interposição de pedido de reconsideração ou de recurso');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('029.6', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('GESTÃO DE MATERIAIS');
        $classificacao->setPermissaoUso(False);
        $classificacao->setCodigo('030');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('030', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('NORMATIZAÇÃO. REGULAMENTAÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('030.01');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Enquanto vigora');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('030.01', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CADASTRAMENTO DE FORNECEDORES E DE PRESTADORES DE SERVIÇOS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('030.02');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('030.02', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ESPECIFICAÇÃO, PADRONIZAÇÃO, CODIFICAÇÃO, PREVISÃO, IDENTIFICAÇÃO E CLASSIFICAÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('030.03');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(2);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('030.03', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('AQUISIÇÃO E INCORPORAÇÃO');
        $classificacao->setPermissaoUso(False);
        $classificacao->setCodigo('031');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao('Eliminar, após 2 anos, os documentos referentes às ações de aquisição e incorporação não efetivadas.');
        $this->addReference('031', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('COMPRA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('031.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('031.1', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('MATERIAL PERMANENTE');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('031.11');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('031.11', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('MATERIAL DE CONSUMO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('031.12');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('031.12', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DOAÇÃO E PERMUTA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('031.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('031.2', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('MATERIAL PERMANENTE');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('031.21');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(4);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('Utilizar os prazos dos documentos financeiros para as transações que envolvam pagamento de despesas.');
        $this->addReference('031.21', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('MATERIAL DE CONSUMO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('031.22');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(4);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('Utilizar os prazos dos documentos financeiros para as transações que envolvam pagamento de despesas.');
        $this->addReference('031.22', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DAÇÃO. ADJUDICAÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('031.3');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('031.3', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('MATERIAL PERMANENTE');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('031.31');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a quitação total da dívida');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('Utilizar os prazos dos documentos financeiros para as transações que envolvam pagamento de despesas.');
        $this->addReference('031.31', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('MATERIAL DE CONSUMO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('031.32');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a quitação total da dívida');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('Utilizar os prazos dos documentos financeiros para as transações que envolvam pagamento de despesas.');
        $this->addReference('031.32', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CESSÃO, COMODATO E EMPRÉSTIMO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('031.4');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('031.4', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('MATERIAL PERMANENTE');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('031.41');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Enquanto vigora');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('Utilizar os prazos dos documentos financeiros para as transações que envolvam pagamento de despesas.');
        $this->addReference('031.41', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('MATERIAL DE CONSUMO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('031.42');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Enquanto vigora');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('Utilizar os prazos dos documentos financeiros para as transações que envolvam pagamento de despesas.');
        $this->addReference('031.42', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('LOCAÇÃO. ARRENDAMENTO MERCANTIL (LEASING)');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('031.5');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('031.5', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('MOVIMENTAÇÃO DE MATERIAL');
        $classificacao->setPermissaoUso(False);
        $classificacao->setCodigo('032');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('032', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('TERMOS DE RESPONSABILIDADE. CAUTELA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('032.01');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('032.01', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONTROLE DE ESTOQUE');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('032.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(2);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('Observar os prazos da legislação em vigor para os documentos referentes a produtos e insumos químicos e outras substâncias entorpecentes.');
        $this->addReference('032.1', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('AUTORIZAÇÃO DE ENTRADA E SAÍDA DE MATERIAL');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('032.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(1);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('Observar os prazos da legislação em vigor para os documentos referentes a produtos e insumos químicos e outras substâncias entorpecentes.');
        $this->addReference('032.2', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('RECOLHIMENTO DE MATERIAL INSERVÍVEL AO DEPÓSITO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('032.3');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(2);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('Observar os prazos da legislação em vigor para os documentos referentes a produtos e insumos químicos e outras substâncias entorpecentes.');
        $this->addReference('032.3', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('TOMBAMENTO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('032.4');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a alienação');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('032.4', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ALIENAÇÃO E BAIXA');
        $classificacao->setPermissaoUso(False);
        $classificacao->setCodigo('033');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao('Eliminar, após 2 anos, os documentos referentes às ações de alienação e baixa não efetivadas.');
        $this->addReference('033', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('VENDA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('033.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('033.1', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('MATERIAL PERMANENTE');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('033.11');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('033.11', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('MATERIAL DE CONSUMO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('033.12');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('033.12', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DOAÇÃO E PERMUTA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('033.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('033.2', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('MATERIAL PERMANENTE');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('033.21');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(4);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('Utilizar os prazos dos documentos financeiros para as transações que envolvam pagamento de despesas.');
        $this->addReference('033.21', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('MATERIAL DE CONSUMO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('033.22');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(4);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('Utilizar os prazos dos documentos financeiros para as transações que envolvam pagamento de despesas.');
        $this->addReference('033.22', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DAÇÃO. ADJUDICAÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('033.3');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('033.3', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('MATERIAL PERMANENTE');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('033.31');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a quitação total da dívida');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('Utilizar os prazos dos documentos financeiros para as transações que envolvam pagamento de despesas.');
        $this->addReference('033.31', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('MATERIAL DE CONSUMO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('033.32');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a quitação total da dívida');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('Utilizar os prazos dos documentos financeiros para as transações que envolvam pagamento de despesas.');
        $this->addReference('033.32', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DESFAZIMENTO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('033.4');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('033.4', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('MATERIAL PERMANENTE');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('033.41');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(4);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('Utilizar os prazos dos documentos financeiros para as transações que envolvam pagamento de despesas.');
        $this->addReference('033.41', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('MATERIAL DE CONSUMO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('033.42');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(4);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('Utilizar os prazos dos documentos financeiros para as transações que envolvam pagamento de despesas.');
        $this->addReference('033.42', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CESSÃO, COMODATO E EMPRÉSTIMO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('033.5');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('033.5', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('MATERIAL PERMANENTE');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('033.51');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(4);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('Utilizar os prazos dos documentos financeiros para as transações que envolvam pagamento de despesas.');
        $this->addReference('033.51', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('MATERIAL DE CONSUMO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('033.52');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(4);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('Utilizar os prazos dos documentos financeiros para as transações que envolvam pagamento de despesas.');
        $this->addReference('033.52', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('EXTRAVIO, ROUBO, DESAPARECIMENTO, FURTO E AVARIA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('033.6');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a conclusão do caso');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('Observar os prazos da legislação em vigor para os documentos referentes a produtos e insumos químicos e outras substâncias entorpecentes.');
        $this->addReference('033.6', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONTRATAÇÃO DE PRESTAÇÃO DE SERVIÇOS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('034');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão Eliminar, após 2 anos, os documentos referentes às con- tratações não efetivadas.');
        $this->addReference('034', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('EXECUÇÃO DE SERVIÇOS DE INSTALAÇÃO E MANUTENÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('035');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(1);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('035', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONTROLE DE MATERIAIS');
        $classificacao->setPermissaoUso(False);
        $classificacao->setCodigo('036');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('036', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('COMISSÃO DE INVENTÁRIO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('036.01');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Enquanto vigora');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('036.01', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('INVENTÁRIO DE MATERIAL PERMANENTE');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('036.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('036.1', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('INVENTÁRIO DE MATERIAL DE CONSUMO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('036.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('036.2', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('OUTRAS AÇÕES REFERENTES À GESTÃO DE MATERIAIS');
        $classificacao->setPermissaoUso(False);
        $classificacao->setCodigo('039');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('039', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('RACIONALIZAÇÃO DO USO DE MATERIAL');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('039.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('039.1', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CRIAÇÃO E ATUAÇÃO DE GRUPOS DE TRABALHO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('039.11');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(4);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('039.11', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('OPERACIONALIZAÇÃO DE REUNIÕES');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('039.12');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(2);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('039.12', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('EMPRÉSTIMO E DEVOLUÇÃO DE MATERIAL PERMANENTE');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('039.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Enquanto vigora');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(1);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('039.2', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('GESTÃO DE BENS PATRIMONIAIS E DE SERVIÇOS');
        $classificacao->setPermissaoUso(False);
        $classificacao->setCodigo('040');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('040', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('NORMATIZAÇÃO. REGULAMENTAÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('040.01');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Enquanto vigora');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('040.01', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('AQUISIÇÃO E INCORPORAÇÃO');
        $classificacao->setPermissaoUso(False);
        $classificacao->setCodigo('041');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao('Eliminar, após 2 anos, os documentos referentes às ações de aquisição e incorporação não efetivadas.');
        $this->addReference('041', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('COMPRA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('041.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('041.1', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('BENS IMÓVEIS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('041.11');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('041.11', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('VEÍCULOS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('041.12');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('041.12', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('BENS SEMOVENTES');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('041.13');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('041.13', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DOAÇÃO E PERMUTA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('041.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('041.2', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('BENS IMÓVEIS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('041.21');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(4);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('041.21', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('VEÍCULOS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('041.22');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(4);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('Utilizar os prazos dos documentos financeiros para as transações que envolvam pagamento de despesas.');
        $this->addReference('041.22', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('BENS SEMOVENTES');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('041.23');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(4);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('Utilizar os prazos dos documentos financeiros para as transações que envolvam pagamento de despesas.');
        $this->addReference('041.23', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DAÇÃO. ADJUDICAÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('041.3');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('041.3', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('BENS IMÓVEIS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('041.31');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a quitação total da dívida');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('041.31', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('VEÍCULOS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('041.32');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a quitação total da dívida');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('Utilizar os prazos dos documentos financeiros para as transações que envolvam pagamento de despesas.');
        $this->addReference('041.32', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PROCRIAÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('041.4');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(4);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('Utilizar os prazos dos documentos financeiros para as transações que envolvam pagamento de despesas.');
        $this->addReference('041.4', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CESSÃO E COMODATO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('041.5');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('041.5', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('BENS IMÓVEIS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('041.51');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(4);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('041.51', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('VEÍCULOS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('041.52');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(4);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('Utilizar os prazos dos documentos financeiros para as transações que envolvam pagamento de despesas.');
        $this->addReference('041.52', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('BENS SEMOVENTES');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('041.53');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(4);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('Utilizar os prazos dos documentos financeiros para as transações que envolvam pagamento de despesas.');
        $this->addReference('041.53', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('LOCAÇÃO. ARRENDAMENTO MERCANTIL (LEASING). SUBLOCAÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('041.6');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('041.6', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('BENS IMÓVEIS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('041.61');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('041.61', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('VEÍCULOS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('041.62');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('041.62', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ALIENAÇÃO');
        $classificacao->setPermissaoUso(False);
        $classificacao->setCodigo('042');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao('Eliminar, após 2 anos, os documentos referentes às ações de alienação não efetivadas.');
        $this->addReference('042', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('VENDA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('042.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('042.1', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('BENS IMÓVEIS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('042.11');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('042.11', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('VEÍCULOS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('042.12');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('042.12', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('BENS SEMOVENTES');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('042.13');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('042.13', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DOAÇÃO E PERMUTA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('042.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('042.2', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('BENS IMÓVEIS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('042.21');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(4);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('042.21', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('VEÍCULOS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('042.22');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(4);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('Utilizar prazos dos documentos financeiros para as transações que envolvam pagamento de despesas.');
        $this->addReference('042.22', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('BENS SEMOVENTES');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('042.23');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(4);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('Utilizar os prazos os dos documentos financeiros para as transações que envolvam pagamento de despesas.');
        $this->addReference('042.23', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DAÇÃO. ADJUDICAÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('042.3');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('042.3', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('BENS IMÓVEIS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('042.31');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a quitação total da dívida');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('042.31', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('VEÍCULOS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('042.32');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a quitação total da dívida');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('Utilizar os prazos dos documentos financeiros para as transações que envolvam pagamento de despesas.');
        $this->addReference('042.32', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DESAPROPRIAÇÃO E DESMEMBRAMENTO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('042.4');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('042.4', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CESSÃO E COMODATO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('042.5');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('042.5', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('BENS IMÓVEIS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('042.51');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(4);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('042.51', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('VEÍCULOS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('042.52');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(4);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('Utilizar os prazos dos documentos financeiros para as transações que envolvam pagamento de despesas.');
        $this->addReference('042.52', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('BENS SEMOVENTES');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('042.53');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(4);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('Utilizar os prazos dos documentos financeiros para as transações que envolvam pagamento de despesas.');
        $this->addReference('042.53', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('LOCAÇÃO. ARRENDAMENTO. SUBLOCAÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('042.6');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('042.6', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('BAIXA. DESFAZIMENTO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('042.7');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('042.7', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('VEÍCULOS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('042.71');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(4);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('042.71', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('BENS SEMOVENTES');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('042.72');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(4);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('042.72', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ADMINISTRAÇÃO CONDOMINIAL');
        $classificacao->setPermissaoUso(False);
        $classificacao->setCodigo('043');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('043', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('REGISTRO DOS IMÓVEIS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('043.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(3);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('043.1', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('SERVIÇOS DE CONDOMÍNIO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('043.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('043.2', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('REINTEGRAÇÃO DE POSSE. REIVINDICAÇÃO DE DOMÍNIO. DESPEJO DE PERMISSIONÁRIO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('043.3');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('043.3', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('TOMBAMENTO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('043.4');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a alienação');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('043.4', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('INSPEÇÃO PATRIMONIAL');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('043.5');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(3);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('043.5', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('MUDANÇA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('043.6');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('043.6', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PARA OUTROS IMÓVEIS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('043.61');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('043.61', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DENTRO DO MESMO IMÓVEL');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('043.62');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(1);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('Utilizar os prazos dos documentos financeiros para as transações que envolvam pagamento de despesas.');
        $this->addReference('043.62', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('USO DE DEPENDÊNCIAS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('043.7');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(2);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('043.7', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ADMINISTRAÇÃO DA FROTA DE VEÍCULOS');
        $classificacao->setPermissaoUso(False);
        $classificacao->setCodigo('044');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('044', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CADASTRAMENTO, LICENCIAMENTO E EMPLACAMENTO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('044.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a alienação');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('044.1', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('TOMBAMENTO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('044.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a alienação');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('044.2', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('OCORRÊNCIA DE SINISTROS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('044.3');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão Observar para os acidentes com vítimas, o prazo total de guarda de 20 anos, após a conclusão do caso.');
        $this->addReference('044.3', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONTROLE DE USO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('044.4');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(2);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('044.4', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ESTACIONAMENTO. GARAGEM');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('044.5');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(2);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('044.5', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('NOTIFICAÇÕES DE INFRAÇÕES E MULTAS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('044.6');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('044.6', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONTRATAÇÃO DE PRESTAÇÃO DE SERVIÇOS');
        $classificacao->setPermissaoUso(False);
        $classificacao->setCodigo('045');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao('Eliminar, após 2 anos, os documentos referentes às contratações não efetivadas.');
        $this->addReference('045', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('SEGURO PATRIMONIAL');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('045.01');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('045.01', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('FORNECIMENTO DE SERVIÇOS PÚBLICOS ESSENCIAIS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('045.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('045.1', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ÁGUA E ESGOTAMENTO SANITÁRIO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('045.11');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('045.11', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('GÁS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('045.12');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('045.12', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ENERGIA ELÉTRICA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('045.13');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('045.13', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('MANUTENÇÃO E REPARO DAS INSTALAÇÕES');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('045.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('045.2', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ELEVADORES');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('045.21');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('045.21', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('SISTEMAS CENTRAIS DE AR CONDICIONADO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('045.22');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('045.22', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('SUBESTAÇÕES ELÉTRICAS E GERADORES');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('045.23');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('045.23', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONSERVAÇÃO PREDIAL');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('045.24');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('045.24', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('EXECUÇÃO DE OBRAS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('045.3');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('045.3', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONSTRUÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('045.31');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('045.31', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('REFORMA. RECUPERAÇÃO. RESTAURAÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('045.32');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('045.32', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ADAPTAÇÃO DE USO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('045.33');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('045.33', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('VIGILÂNCIA PATRIMONIAL');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('045.4');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('045.4', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ABASTECIMENTO E MANUTENÇÃO DE VEÍCULOS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('045.5');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('045.5', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ASSISTÊNCIA VETERINÁRIA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('045.6');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('045.6', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ADESTRAMENTO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('045.7');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('045.7', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PROTEÇÃO, GUARDA E SEGURANÇA PATRIMONIAL');
        $classificacao->setPermissaoUso(False);
        $classificacao->setCodigo('046');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('046', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PREVENÇÃO DE INCÊNDIO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('046.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('046.1', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PLANEJAMENTO, ELABORAÇÃO E ACOMPANHAMENTO DE PROJETOS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('046.11');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(4);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('046.11', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONSTITUIÇÃO DE BRIGADA VOLUNTÁRIA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('046.12');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(4);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('046.12', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('INSTALAÇÃO E MANUTENÇÃO DE EQUIPAMENTOS DE COMBATE A INCÊNDIO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('046.13');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(2);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('046.13', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('MONITORAMENTO. VIGILÂNCIA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('046.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(2);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('046.2', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('OCORRÊNCIA DE SINISTROS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('046.3');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a conclusão do caso');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('046.3', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONTROLE DE PORTARIA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('046.4');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(2);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* Observar para os registros de ocorrências, o prazo total de guarda de 10 anos.');
        $this->addReference('046.4', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONTROLE DE BENS PATRIMONIAIS');
        $classificacao->setPermissaoUso(False);
        $classificacao->setCodigo('047');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('047', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('COMISSÃO DE INVENTÁRIO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('047.01');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Enquanto vigora');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('047.01', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('INVENTÁRIO DE BENS IMÓVEIS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('047.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('047.1', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('INVENTÁRIO DE VEÍCULOS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('047.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('047.2', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('INVENTÁRIO DE BENS SEMOVENTES');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('047.3');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('047.3', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('OUTRAS AÇÕES REFERENTES À GESTÃO DE BENS PATRIMONIAIS E DE SERVIÇOS');
        $classificacao->setPermissaoUso(False);
        $classificacao->setCodigo('049');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('049', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('RACIONALIZAÇÃO DO USO DE BENS E SERVIÇOS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('049.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('049.1', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CRIAÇÃO E ATUAÇÃO DE GRUPOS DE TRABALHO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('049.11');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(4);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('049.11', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('OPERACIONALIZAÇÃO DE REUNIÕES');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('049.12');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(2);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('049.12', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('GESTÃO ORÇAMENTÁRIA E FINANCEIRA');
        $classificacao->setPermissaoUso(False);
        $classificacao->setCodigo('050');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('050', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('NORMATIZAÇÃO. REGULAMENTAÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('050.01');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Enquanto vigora');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('050.01', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONFORMIDADE DE REGISTRO DE GESTÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('050.02');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('050.02', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONFORMIDADE CONTÁBIL');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('050.03');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('050.03', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('GESTÃO ORÇAMENTÁRIA');
        $classificacao->setPermissaoUso(False);
        $classificacao->setCodigo('051');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('051', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PROGRAMAÇÃO ORÇAMENTÁRIA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('051.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao('Eliminar, após 2 anos, os documentos cujas informações sobre  previsão  orçamentária  encontrem-se  recapitula- das ou consolidadas em outros.');
        $this->addReference('051.1', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DETALHAMENTO DE DESPESA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('051.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(2);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('051.2', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('EXECUÇÃO ORÇAMENTÁRIA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('051.3');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('051.3', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('RETIFICAÇÃO ORÇAMENTÁRIA. CRÉDITOS ADICIONAIS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('051.4');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('051.4', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('GESTÃO FINANCEIRA');
        $classificacao->setPermissaoUso(False);
        $classificacao->setCodigo('052');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('052', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PROGRAMAÇÃO FINANCEIRA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('052.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('052.1', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('EXECUÇÃO FINANCEIRA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('052.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('052.2', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('RECEITA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('052.21');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('052.21', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('RECEITA CORRENTE');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('052.211');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('052.211', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('RECEITA DE CAPITAL');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('052.212');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('052.212', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('INGRESSO EXTRAORÇAMENTÁRIO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('052.213');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('052.213', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DESPESA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('052.22');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('052.22', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DESPESA CORRENTE');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('052.221');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('052.221', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DESPESA DE CAPITAL');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('052.222');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('052.222', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DEMONSTRAÇÃO CONTÁBIL');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('052.23');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('052.23', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('GESTÃO DE FUNDOS ESPECIAIS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('052.24');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da aprovação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('052.24', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONCESSÃO DE BENEFÍCIOS, ESTÍMULOS E INCENTIVOS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('052.25');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('052.25', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('FINANCEIROS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('052.251');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da aprovação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('052.251', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CREDITÍCIOS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('052.252');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da aprovação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('052.252', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('OPERAÇÃO BANCÁRIA');
        $classificacao->setPermissaoUso(False);
        $classificacao->setCodigo('053');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('053', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONCILIAÇÃO BANCÁRIA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('053.01');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da aprovação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('053.01', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PAGAMENTO EM MOEDA ESTRANGEIRA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('053.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da aprovação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('053.1', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('GESTÃO DA CONTA ÚNICA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('053.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da aprovação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('053.2', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('GESTÃO DE CONTAS CORRENTES BANCÁRIAS: TIPO A, B, C, D e E');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('053.3');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('053.3', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('GESTÃO DE CONTAS ESPECIAIS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('053.4');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('053.4', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONTROLE EXTERNO. AUDITORIA EXTERNA');
        $classificacao->setPermissaoUso(False);
        $classificacao->setCodigo('054');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('054', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PRESTAÇÃO DE CONTAS. TOMADA DE CONTAS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('054.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('054.1', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('TOMADA DE CONTAS ESPECIAL');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('054.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('054.2', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('OUTRAS AÇÕES REFERENTES À GESTÃO ORÇAMENTÁRIA E FINANCEIRA');
        $classificacao->setPermissaoUso(False);
        $classificacao->setCodigo('059');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('059', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('COMPRA E SUBSCRIÇÃO DE AÇÕES');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('059.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('059.1', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('RECOLHIMENTO DE TRIBUTOS, IMPOSTOS E TAXAS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('059.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('059.2', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('FIXAÇÃO DE CUSTOS DE SERVIÇOS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('059.3');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Enquanto vigora');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('059.3', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DEVOLUÇÃO AO ERÁRIO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('059.4');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('059.4', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('RESTITUIÇÃO DE RENDAS ARRECADADAS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('059.5');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('059.5', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('GESTÃO DA DOCUMENTAÇÃO E DA INFORMAÇÃO');
        $classificacao->setPermissaoUso(False);
        $classificacao->setCodigo('060');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('060', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('NORMATIZAÇÃO. REGULAMENTAÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('060.01');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Enquanto vigora');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('060.01', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('GESTÃO DE DOCUMENTOS DE ARQUIVO');
        $classificacao->setPermissaoUso(False);
        $classificacao->setCodigo('061');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('061', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONSTITUIÇÃO DA COMISSÃO PERMANENTE DE AVALIAÇÃO DE DOCUMENTOS (CPAD)');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('061.01');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('061.01', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('COMPOSIÇÃO E ATUAÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('061.011');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(4);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('061.011', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('OPERACIONALIZAÇÃO DE REUNIÕES');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('061.012');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(2);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('061.012', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ADOÇÃO E CONTROLE DOS PROCEDIMENTOS DE PROTOCOLO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('061.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(2);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('061.1', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ANÁLISE DA SITUAÇÃO ARQUIVÍSTICA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('061.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('061.2', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('LEVANTAMENTO DA PRODUÇÃO E DO FLUXO DOCUMENTAL');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('061.3');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a finalização da elaboração dos instrumentos');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('061.3', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ELABORAÇÃO DOS INSTRUMENTOS TÉCNICOS DE GESTÃO DE DOCUMENTOS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('061.4');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a finalização da elaboração dos instrumentos');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao('Eliminar, 2 anos após a finalização da elaboração, as versões preliminares dos instrumentos, assim como os demais exemplares quando ocorrerem atualizações.');
        $this->addReference('061.4', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('APLICAÇÃO DOS INSTRUMENTOS TÉCNICOS DE GESTÃO DE DOCUMENTOS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('061.5');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('061.5', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CLASSIFICAÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('061.51');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(2);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('061.51', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('AVALIAÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('061.52');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('061.52', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ELIMINAÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('061.521');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('061.521', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('TRANSFERÊNCIA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('061.522');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('061.522', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('RECOLHIMENTO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('061.523');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('061.523', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('GESTÃO DE ACERVOS BIBLIOGRÁFICO E MUSEOLÓGICO');
        $classificacao->setPermissaoUso(False);
        $classificacao->setCodigo('062');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('062', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('AQUISIÇÃO E INCORPORAÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('062.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao('Eliminar, após 2 anos, os documentos referentes às ações de aquisição e incorporação não efetivadas.');
        $this->addReference('062.1', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('COMPRA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('062.11');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da aprovação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('062.11', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DOAÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('062.12');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(4);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('Utilizar os prazos dos documentos financeiros para as transações que envolvam pagamento de despesas.');
        $this->addReference('062.12', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PERMUTA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('062.13');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(4);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('Utilizar os prazos dos documentos financeiros para as transações que envolvam pagamento de despesas.');
        $this->addReference('062.13', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PROCESSAMENTO TÉCNICO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('062.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('062.2', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('REGISTRO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('062.21');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(2);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('062.21', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CATALOGAÇÃO, CLASSIFICAÇÃO E INDEXAÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('062.22');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(2);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('062.22', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('INVENTÁRIO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('062.3');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('062.3', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DESINCORPORAÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('062.4');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('062.4', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DOAÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('062.41');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(4);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('Utilizar os prazos dos documentos financeiros para as transações que envolvam pagamento de despesas.');
        $this->addReference('062.41', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DESCARTE');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('062.42');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(4);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('Utilizar os prazos dos documentos financeiros para as transações que envolvam pagamento de despesas.');
        $this->addReference('062.42', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONTROLE DE ACESSO E DE MOVIMENTAÇÃO DE ACERVOS');
        $classificacao->setPermissaoUso(False);
        $classificacao->setCodigo('063');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('063', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONSULTAS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('063.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(2);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('063.1', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('EMPRÉSTIMOS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('063.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a devolução');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(1);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('063.2', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('MOVIMENTAÇÃO DE ACERVOS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('063.3');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(2);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('063.3', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONSERVAÇÃO E PRESERVAÇÃO DE ACERVOS');
        $classificacao->setPermissaoUso(False);
        $classificacao->setCodigo('064');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('064', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('AVALIAÇÃO E MONITORAMENTO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('064.01');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Enquanto vigora');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('064.01', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DESINFESTAÇÃO E HIGIENIZAÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('064.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(2);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('Utilizar os prazos dos documentos financeiros para as transações que envolvam pagamento de despesas.');
        $this->addReference('064.1', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONTROLE DAS ÁREAS DE ARMAZENAMENTO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('064.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(2);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('Utilizar os prazos dos documentos financeiros para as transações que envolvam pagamento de despesas.');
        $this->addReference('064.2', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('REFORMATAÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('064.3');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('064.3', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('MICROFILMAGEM');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('064.31');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(2);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('Utilizar os prazos dos documentos financeiros para as transações que envolvam pagamento de despesas.');
        $this->addReference('064.31', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DIGITALIZAÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('064.32');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(2);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('Utilizar os prazos dos documentos financeiros para as transações que envolvam pagamento de despesas.');
        $this->addReference('064.32', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('RESTAURAÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('064.4');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(2);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('Utilizar os prazos dos documentos financeiros para as transações que envolvam pagamento de despesas.');
        $this->addReference('064.4', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PRODUÇÃO EDITORIAL');
        $classificacao->setPermissaoUso(False);
        $classificacao->setCodigo('065');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('065', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('EDIÇÃO. COEDIÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('065.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Enquanto vigora');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('065.1', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('EDITORAÇÃO E PROGRAMAÇÃO VISUAL');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('065.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('Utilizar os prazos dos documentos financeiros para as transações que envolvam pagamento de despesas.');
        $this->addReference('065.2', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PROMOÇÃO, DIVULGAÇÃO E DISTRIBUIÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('065.3');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('Utilizar os prazos dos documentos financeiros para as transa- ções que envolvam pagamento de despesas.');
        $this->addReference('065.3', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('GESTÃO DE TECNOLOGIA DA INFORMAÇÃO');
        $classificacao->setPermissaoUso(False);
        $classificacao->setCodigo('066');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao('Utilizar os prazos dos documentos financeiros para as transações que envolvam pagamento de despesas.');
        $this->addReference('066', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DESENVOLVIMENTO E CONTROLE DE SISTEMAS INFORMATIZADOS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('066.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Enquanto vigora');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('066.1', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('INSTALAÇÃO DE EQUIPAMENTOS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('066.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Enquanto vigora');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('066.2', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ADMINISTRAÇÃO DA INFRAESTRUTURA TECNOLÓGICA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('066.3');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('066.3', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PROJETO DE MANUTENÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('066.31');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Enquanto vigora');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('066.31', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('GERENCIAMENTO E USO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('066.32');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Enquanto vigora');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('066.32', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ADMINISTRAÇÃO DE BANCO DE DADOS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('066.4');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('066.4', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('INSTALAÇÃO E CONFIGURAÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('066.41');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Enquanto vigora');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('066.41', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('GERENCIAMENTO E USO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('066.42');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Enquanto vigora');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('066.42', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('OUTRAS AÇÕES REFERENTES À GESTÃO DE TECNOLOGIA DA INFORMAÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('066.9');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('066.9', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONTROLE DO SUPORTE TÉCNICO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('066.91');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('066.91', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONTRATAÇÃO DE PRESTAÇÃO DE SERVIÇOS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('067');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da aprovação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão Eliminar, após 2 anos, os documentos referentes às con- tratações não efetivadas.');
        $this->addReference('067', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('OUTRAS AÇÕES REFERENTES À GESTÃO DA DOCUMENTAÇÃO E DA INFORMAÇÃO');
        $classificacao->setPermissaoUso(False);
        $classificacao->setCodigo('069');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('069', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('TRATAMENTO TÉCNICO DA DOCUMENTAÇÃO ARQUIVÍSTICA PERMANENTE');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('069.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('069.1', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ARRANJO E DESCRIÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('069.11');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a conclusão da organização');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(2);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao('Eliminar, 2 anos após a conclusão da organização, as ver- sões preliminares das planilhas e dos estudos de apoio.');
        $this->addReference('069.11', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ELABORAÇÃO DE INSTRUMENTOS DE PESQUISA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('069.12');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a finalização da elaboração dos instru- mentos de pesquisa');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao('Eliminar, 2 anos após a finalização da elaboração, as versões preliminares dos instrumentos assim como os demais exemplares quando ocorrerem atualizações.');
        $this->addReference('069.12', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('FORNECIMENTO DE CÓPIAS DE DOCUMENTOS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('069.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(2);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('Utilizar os prazos dos documentos financeiros para as transações que envolvam pagamento de despesas.');
        $this->addReference('069.2', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PUBLICAÇÃO DE MATÉRIAS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('069.3');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('069.3', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('GESTÃO DOS SERVIÇOS POSTAIS E DE TELECOMUNICAÇÕES');
        $classificacao->setPermissaoUso(False);
        $classificacao->setCodigo('070');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('070', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('NORMATIZAÇÃO. REGULAMENTAÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('070.01');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Enquanto vigora');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('070.01', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONTRATAÇÃO DE PRESTAÇÃO DE SERVIÇOS');
        $classificacao->setPermissaoUso(False);
        $classificacao->setCodigo('071');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao('Eliminar, após 2 anos, os documentos referentes às contratações não efetivadas.');
        $this->addReference('071', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('SERVIÇO POSTAL');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('071.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('071.1', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('SERVIÇO DE RADIOFREQUÊNCIA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('071.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('071.2', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('SERVIÇO DE TELEX');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('071.3');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('071.3', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('SERVIÇO DE TELEFONIA. SERVIÇO DE FAX');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('071.4');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('071.4', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('SERVIÇO DE TRANSMISSÃO DE DADOS, VOZ E IMAGEM');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('071.5');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão');
        $this->addReference('071.5', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('EXECUÇÃO DE SERVIÇOS PELO ÓRGÃO E ENTIDADE');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('072');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(2);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('072', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('AUTORIZAÇÃO E CONTROLE DE USO');
        $classificacao->setPermissaoUso(False);
        $classificacao->setCodigo('073');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('073', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('SERVIÇO DE RADIOFREQUÊNCIA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('073.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(2);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('073.1', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('SERVIÇO DE TELEX');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('073.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(2);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('073.2', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('SERVIÇO DE TELEFONIA. SERVIÇO DE FAX');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('073.3');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('073.3', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('TRANSFERÊNCIA DE PROPRIEDADE OU TITULARIDADE');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('073.31');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a conclusão da transferência');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(2);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('073.31', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('REGISTRO DE LIGAÇÕES');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('073.32');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(2);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('073.32', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DIVULGAÇÃO DE LISTAS TELEFÔNICAS INTERNAS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('073.33');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Enquanto vigora');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('073.33', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('SERVIÇO DE TRANSMISSÃO DE DADOS, VOZ E IMAGEM');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('073.4');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(2);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('073.4', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PESSOAL MILITAR - ver anexo 1');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('080');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('080', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('VAGA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('090');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('090', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ADMINISTRAÇÃO DE ATIVIDADES ACESSÓRIAS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('900');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('900', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('GESTÃO DE EVENTOS');
        $classificacao->setPermissaoUso(False);
        $classificacao->setCodigo('910');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao('Eliminar, após 2 anos, os documentos referentes aos eventos não efetivados.');
        $this->addReference('910', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('NORMATIZAÇÃO. REGULAMENTAÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('910.01');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Enquanto vigora');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('910.01', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PLANEJAMENTO E PROGRAMAÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('911');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('911', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DIVULGAÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('912');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(1);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(2);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('Arquivar um exemplar do material de divulgação de cada evento.');
        $this->addReference('912', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('INSCRIÇÃO E CONTROLE DE FREQUÊNCIA');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('913');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a homologação do evento');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(2);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('913', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('EMISSÃO DE CERTIFICADOS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('914');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(2);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(3);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('914', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('AVALIAÇÃO DOS RESULTADOS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('915');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a homologação do evento');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(2);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao('Eliminar, após 2 anos, os documentos cujas informações encontram-se recapituladas ou consolidadas em outros.');
        $this->addReference('915', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('HABILITAÇÃO, JULGAMENTO E RECURSOS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('916');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a homologação do evento*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(2);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao('* Aguardar o término da ação, no caso de interposição de recursos. Eliminar, após 2 anos da homologação do evento, os documentos de recursos indeferidos.');
        $this->addReference('916', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PREMIAÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('917');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a homologação do evento');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(2);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('917', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONTRATAÇÃO DE PRESTAÇÃO DE SERVIÇOS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('918');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Até a aprovação das contas pelo Tribunal de Contas*');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('5 anos a contar da apro- vação das contas pelo Tribunal de Contas**');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('* ou até a apresentação do Relatório de Gestão ** ou 10 anos a contar da apresentação do Relatório de Gestão Eliminar, após 2 anos, os documentos referentes às contratações não efetivadas.');
        $this->addReference('918', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('OUTRAS AÇÕES REFERENTES À GESTÃO DE EVENTOS');
        $classificacao->setPermissaoUso(False);
        $classificacao->setCodigo('919');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('919', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PARTICIPAÇÃO EM EVENTOS PROMOVIDOS E REALIZADOS POR OUTRAS INSTITUIÇÕES');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('919.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao('Utilizar os prazos de guarda e a destinação final dos assentamentos funcionais para os documentos comprobatórios de participação.');
        $this->addReference('919.1', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PROMOÇÃO DE VISITAS');
        $classificacao->setPermissaoUso(False);
        $classificacao->setCodigo('920');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('920', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('NORMATIZAÇÃO. REGULAMENTAÇÃO');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('920.01');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Enquanto vigora');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('920.01', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PROGRAMAÇÃO DE VISITAS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('921');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $classificacao->setObservacao(null);
        $this->addReference('921', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONTROLE DE VISITAS E VISITANTES');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('922');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(2);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('922', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('OUTRAS AÇÕES REFERENTES À ADMINISTRAÇÃO DE ATIVIDADES ACESSÓRIAS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('990');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $classificacao->setObservacao(null);
        $this->addReference('990', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('GESTÃO DE COMUNICAÇÕES EVENTUAIS');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('991');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(1);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('991', $classificacao);

        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('RELACIONAMENTO COM ASSOCIAÇÕES CULTURAIS, DE AMIGOS E DE SERVIDORES');
        $classificacao->setPermissaoUso(True);
        $classificacao->setCodigo('992');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(1);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $classificacao->setObservacao(null);
        $this->addReference('992', $classificacao);

        $this->manager->persist($classificacao);
        
        

        $classificacao = $this->getReference('002.01');
        $classificacao->setParent($this->getReference('002'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('002.1');
        $classificacao->setParent($this->getReference('002'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('002.11');
        $classificacao->setParent($this->getReference('002'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('002.12');
        $classificacao->setParent($this->getReference('002'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('002.2');
        $classificacao->setParent($this->getReference('002'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('003.01');
        $classificacao->setParent($this->getReference('003'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('003.1');
        $classificacao->setParent($this->getReference('003'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('003.2');
        $classificacao->setParent($this->getReference('003'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('003.3');
        $classificacao->setParent($this->getReference('003'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('004.1');
        $classificacao->setParent($this->getReference('004'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('004.11');
        $classificacao->setParent($this->getReference('004'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('004.12');
        $classificacao->setParent($this->getReference('004'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('004.2');
        $classificacao->setParent($this->getReference('004'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('004.21');
        $classificacao->setParent($this->getReference('004'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('004.22');
        $classificacao->setParent($this->getReference('004'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('005.1');
        $classificacao->setParent($this->getReference('005'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('005.2');
        $classificacao->setParent($this->getReference('005'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('010.01');
        $classificacao->setParent($this->getReference('010'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('013.1');
        $classificacao->setParent($this->getReference('013'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('013.2');
        $classificacao->setParent($this->getReference('013'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('014.1');
        $classificacao->setParent($this->getReference('014'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('014.2');
        $classificacao->setParent($this->getReference('014'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('014.3');
        $classificacao->setParent($this->getReference('014'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('014.4');
        $classificacao->setParent($this->getReference('014'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('015.1');
        $classificacao->setParent($this->getReference('015'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('015.2');
        $classificacao->setParent($this->getReference('015'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('015.3');
        $classificacao->setParent($this->getReference('015'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('015.31');
        $classificacao->setParent($this->getReference('015'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('015.32');
        $classificacao->setParent($this->getReference('015'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('015.33');
        $classificacao->setParent($this->getReference('015'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('016.1');
        $classificacao->setParent($this->getReference('016'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('016.2');
        $classificacao->setParent($this->getReference('016'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('016.3');
        $classificacao->setParent($this->getReference('016'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('016.4');
        $classificacao->setParent($this->getReference('016'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('016.5');
        $classificacao->setParent($this->getReference('016'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('017.1');
        $classificacao->setParent($this->getReference('017'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('017.2');
        $classificacao->setParent($this->getReference('017'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('019.1');
        $classificacao->setParent($this->getReference('019'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('019.11');
        $classificacao->setParent($this->getReference('019'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('019.111');
        $classificacao->setParent($this->getReference('019'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('019.112');
        $classificacao->setParent($this->getReference('019'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('019.113');
        $classificacao->setParent($this->getReference('019'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('019.12');
        $classificacao->setParent($this->getReference('019'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('019.2');
        $classificacao->setParent($this->getReference('019'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('020.01');
        $classificacao->setParent($this->getReference('020'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('020.02');
        $classificacao->setParent($this->getReference('020'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('020.021');
        $classificacao->setParent($this->getReference('020'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('020.022');
        $classificacao->setParent($this->getReference('020'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('020.03');
        $classificacao->setParent($this->getReference('020'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('020.031');
        $classificacao->setParent($this->getReference('020'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('020.032');
        $classificacao->setParent($this->getReference('020'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('020.033');
        $classificacao->setParent($this->getReference('020'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('020.1');
        $classificacao->setParent($this->getReference('020'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('020.11');
        $classificacao->setParent($this->getReference('020'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('020.12');
        $classificacao->setParent($this->getReference('020'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('020.13');
        $classificacao->setParent($this->getReference('020'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('020.14');
        $classificacao->setParent($this->getReference('020'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('020.2');
        $classificacao->setParent($this->getReference('020'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('021.1');
        $classificacao->setParent($this->getReference('021'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('021.2');
        $classificacao->setParent($this->getReference('021'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('021.3');
        $classificacao->setParent($this->getReference('021'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('021.4');
        $classificacao->setParent($this->getReference('021'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('021.5');
        $classificacao->setParent($this->getReference('021'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('022.1');
        $classificacao->setParent($this->getReference('022'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('022.2');
        $classificacao->setParent($this->getReference('022'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('022.21');
        $classificacao->setParent($this->getReference('022'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('022.22');
        $classificacao->setParent($this->getReference('022'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('022.3');
        $classificacao->setParent($this->getReference('022'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('022.4');
        $classificacao->setParent($this->getReference('022'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('022.5');
        $classificacao->setParent($this->getReference('022'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('022.6');
        $classificacao->setParent($this->getReference('022'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('022.61');
        $classificacao->setParent($this->getReference('022'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('022.62');
        $classificacao->setParent($this->getReference('022'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('022.63');
        $classificacao->setParent($this->getReference('022'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('022.7');
        $classificacao->setParent($this->getReference('022'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('023.1');
        $classificacao->setParent($this->getReference('023'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('023.11');
        $classificacao->setParent($this->getReference('023'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('023.12');
        $classificacao->setParent($this->getReference('023'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('023.13');
        $classificacao->setParent($this->getReference('023'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('023.14');
        $classificacao->setParent($this->getReference('023'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('023.15');
        $classificacao->setParent($this->getReference('023'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('023.151');
        $classificacao->setParent($this->getReference('023'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('023.152');
        $classificacao->setParent($this->getReference('023'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('023.153');
        $classificacao->setParent($this->getReference('023'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('023.154');
        $classificacao->setParent($this->getReference('023'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('023.155');
        $classificacao->setParent($this->getReference('023'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('023.156');
        $classificacao->setParent($this->getReference('023'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('023.157');
        $classificacao->setParent($this->getReference('023'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('023.16');
        $classificacao->setParent($this->getReference('023'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('023.161');
        $classificacao->setParent($this->getReference('023'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('023.162');
        $classificacao->setParent($this->getReference('023'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('023.163');
        $classificacao->setParent($this->getReference('023'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('023.164');
        $classificacao->setParent($this->getReference('023'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('023.165');
        $classificacao->setParent($this->getReference('023'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('023.166');
        $classificacao->setParent($this->getReference('023'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('023.167');
        $classificacao->setParent($this->getReference('023'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('023.17');
        $classificacao->setParent($this->getReference('023'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('023.171');
        $classificacao->setParent($this->getReference('023'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('023.172');
        $classificacao->setParent($this->getReference('023'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('023.173');
        $classificacao->setParent($this->getReference('023'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('023.174');
        $classificacao->setParent($this->getReference('023'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('023.175');
        $classificacao->setParent($this->getReference('023'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('023.18');
        $classificacao->setParent($this->getReference('023'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('023.181');
        $classificacao->setParent($this->getReference('023'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('023.182');
        $classificacao->setParent($this->getReference('023'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('023.183');
        $classificacao->setParent($this->getReference('023'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('023.184');
        $classificacao->setParent($this->getReference('023'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('023.185');
        $classificacao->setParent($this->getReference('023'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('023.186');
        $classificacao->setParent($this->getReference('023'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('023.19');
        $classificacao->setParent($this->getReference('023'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('023.191');
        $classificacao->setParent($this->getReference('023'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('023.2');
        $classificacao->setParent($this->getReference('023'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('023.3');
        $classificacao->setParent($this->getReference('023'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('023.4');
        $classificacao->setParent($this->getReference('023'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('023.5');
        $classificacao->setParent($this->getReference('023'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('023.6');
        $classificacao->setParent($this->getReference('023'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('023.7');
        $classificacao->setParent($this->getReference('023'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('023.71');
        $classificacao->setParent($this->getReference('023'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('023.72');
        $classificacao->setParent($this->getReference('023'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('023.73');
        $classificacao->setParent($this->getReference('023'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('023.9');
        $classificacao->setParent($this->getReference('023'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('023.91');
        $classificacao->setParent($this->getReference('023'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('023.92');
        $classificacao->setParent($this->getReference('023'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('023.93');
        $classificacao->setParent($this->getReference('023'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('024.01');
        $classificacao->setParent($this->getReference('024'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('024.1');
        $classificacao->setParent($this->getReference('024'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('024.11');
        $classificacao->setParent($this->getReference('024'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('024.12');
        $classificacao->setParent($this->getReference('024'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('024.13');
        $classificacao->setParent($this->getReference('024'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('024.2');
        $classificacao->setParent($this->getReference('024'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('024.3');
        $classificacao->setParent($this->getReference('024'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('024.31');
        $classificacao->setParent($this->getReference('024'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('024.32');
        $classificacao->setParent($this->getReference('024'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('024.33');
        $classificacao->setParent($this->getReference('024'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('024.4');
        $classificacao->setParent($this->getReference('024'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('024.5');
        $classificacao->setParent($this->getReference('024'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('024.51');
        $classificacao->setParent($this->getReference('024'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('024.52');
        $classificacao->setParent($this->getReference('024'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('025.1');
        $classificacao->setParent($this->getReference('025'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('025.11');
        $classificacao->setParent($this->getReference('025'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('025.12');
        $classificacao->setParent($this->getReference('025'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('025.13');
        $classificacao->setParent($this->getReference('025'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('025.14');
        $classificacao->setParent($this->getReference('025'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('025.2');
        $classificacao->setParent($this->getReference('025'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('025.21');
        $classificacao->setParent($this->getReference('025'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('025.22');
        $classificacao->setParent($this->getReference('025'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('025.3');
        $classificacao->setParent($this->getReference('025'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('025.31');
        $classificacao->setParent($this->getReference('025'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('025.311');
        $classificacao->setParent($this->getReference('025'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('025.312');
        $classificacao->setParent($this->getReference('025'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('025.32');
        $classificacao->setParent($this->getReference('025'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('026.01');
        $classificacao->setParent($this->getReference('026'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('026.02');
        $classificacao->setParent($this->getReference('026'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('026.1');
        $classificacao->setParent($this->getReference('026'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('026.2');
        $classificacao->setParent($this->getReference('026'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('026.3');
        $classificacao->setParent($this->getReference('026'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('026.4');
        $classificacao->setParent($this->getReference('026'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('026.5');
        $classificacao->setParent($this->getReference('026'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('026.51');
        $classificacao->setParent($this->getReference('026'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('026.52');
        $classificacao->setParent($this->getReference('026'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('026.53');
        $classificacao->setParent($this->getReference('026'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('026.54');
        $classificacao->setParent($this->getReference('026'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('026.6');
        $classificacao->setParent($this->getReference('026'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('026.61');
        $classificacao->setParent($this->getReference('026'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('026.62');
        $classificacao->setParent($this->getReference('026'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('026.9');
        $classificacao->setParent($this->getReference('026'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('026.91');
        $classificacao->setParent($this->getReference('026'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('027.1');
        $classificacao->setParent($this->getReference('027'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('027.2');
        $classificacao->setParent($this->getReference('027'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('027.3');
        $classificacao->setParent($this->getReference('027'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('028.1');
        $classificacao->setParent($this->getReference('028'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('028.11');
        $classificacao->setParent($this->getReference('028'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('028.12');
        $classificacao->setParent($this->getReference('028'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('028.2');
        $classificacao->setParent($this->getReference('028'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('028.21');
        $classificacao->setParent($this->getReference('028'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('028.22');
        $classificacao->setParent($this->getReference('028'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('028.23');
        $classificacao->setParent($this->getReference('028'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('029.1');
        $classificacao->setParent($this->getReference('029'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('029.11');
        $classificacao->setParent($this->getReference('029'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('029.12');
        $classificacao->setParent($this->getReference('029'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('029.2');
        $classificacao->setParent($this->getReference('029'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('029.21');
        $classificacao->setParent($this->getReference('029'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('029.22');
        $classificacao->setParent($this->getReference('029'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('029.23');
        $classificacao->setParent($this->getReference('029'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('029.24');
        $classificacao->setParent($this->getReference('029'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('029.3');
        $classificacao->setParent($this->getReference('029'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('029.4');
        $classificacao->setParent($this->getReference('029'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('029.5');
        $classificacao->setParent($this->getReference('029'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('029.6');
        $classificacao->setParent($this->getReference('029'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('030.01');
        $classificacao->setParent($this->getReference('030'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('030.02');
        $classificacao->setParent($this->getReference('030'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('030.03');
        $classificacao->setParent($this->getReference('030'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('031.1');
        $classificacao->setParent($this->getReference('031'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('031.11');
        $classificacao->setParent($this->getReference('031'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('031.12');
        $classificacao->setParent($this->getReference('031'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('031.2');
        $classificacao->setParent($this->getReference('031'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('031.21');
        $classificacao->setParent($this->getReference('031'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('031.22');
        $classificacao->setParent($this->getReference('031'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('031.3');
        $classificacao->setParent($this->getReference('031'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('031.31');
        $classificacao->setParent($this->getReference('031'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('031.32');
        $classificacao->setParent($this->getReference('031'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('031.4');
        $classificacao->setParent($this->getReference('031'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('031.41');
        $classificacao->setParent($this->getReference('031'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('031.42');
        $classificacao->setParent($this->getReference('031'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('031.5');
        $classificacao->setParent($this->getReference('031'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('032.01');
        $classificacao->setParent($this->getReference('032'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('032.1');
        $classificacao->setParent($this->getReference('032'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('032.2');
        $classificacao->setParent($this->getReference('032'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('032.3');
        $classificacao->setParent($this->getReference('032'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('032.4');
        $classificacao->setParent($this->getReference('032'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('033.1');
        $classificacao->setParent($this->getReference('033'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('033.11');
        $classificacao->setParent($this->getReference('033'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('033.12');
        $classificacao->setParent($this->getReference('033'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('033.2');
        $classificacao->setParent($this->getReference('033'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('033.21');
        $classificacao->setParent($this->getReference('033'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('033.22');
        $classificacao->setParent($this->getReference('033'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('033.3');
        $classificacao->setParent($this->getReference('033'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('033.31');
        $classificacao->setParent($this->getReference('033'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('033.32');
        $classificacao->setParent($this->getReference('033'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('033.4');
        $classificacao->setParent($this->getReference('033'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('033.41');
        $classificacao->setParent($this->getReference('033'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('033.42');
        $classificacao->setParent($this->getReference('033'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('033.5');
        $classificacao->setParent($this->getReference('033'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('033.51');
        $classificacao->setParent($this->getReference('033'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('033.52');
        $classificacao->setParent($this->getReference('033'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('033.6');
        $classificacao->setParent($this->getReference('033'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('036.01');
        $classificacao->setParent($this->getReference('036'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('036.1');
        $classificacao->setParent($this->getReference('036'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('036.2');
        $classificacao->setParent($this->getReference('036'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('039.1');
        $classificacao->setParent($this->getReference('039'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('039.11');
        $classificacao->setParent($this->getReference('039'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('039.12');
        $classificacao->setParent($this->getReference('039'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('039.2');
        $classificacao->setParent($this->getReference('039'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('040.01');
        $classificacao->setParent($this->getReference('040'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('041.1');
        $classificacao->setParent($this->getReference('041'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('041.11');
        $classificacao->setParent($this->getReference('041'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('041.12');
        $classificacao->setParent($this->getReference('041'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('041.13');
        $classificacao->setParent($this->getReference('041'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('041.2');
        $classificacao->setParent($this->getReference('041'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('041.21');
        $classificacao->setParent($this->getReference('041'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('041.22');
        $classificacao->setParent($this->getReference('041'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('041.23');
        $classificacao->setParent($this->getReference('041'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('041.3');
        $classificacao->setParent($this->getReference('041'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('041.31');
        $classificacao->setParent($this->getReference('041'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('041.32');
        $classificacao->setParent($this->getReference('041'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('041.4');
        $classificacao->setParent($this->getReference('041'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('041.5');
        $classificacao->setParent($this->getReference('041'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('041.51');
        $classificacao->setParent($this->getReference('041'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('041.52');
        $classificacao->setParent($this->getReference('041'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('041.53');
        $classificacao->setParent($this->getReference('041'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('041.6');
        $classificacao->setParent($this->getReference('041'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('041.61');
        $classificacao->setParent($this->getReference('041'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('041.62');
        $classificacao->setParent($this->getReference('041'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('042.1');
        $classificacao->setParent($this->getReference('042'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('042.11');
        $classificacao->setParent($this->getReference('042'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('042.12');
        $classificacao->setParent($this->getReference('042'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('042.13');
        $classificacao->setParent($this->getReference('042'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('042.2');
        $classificacao->setParent($this->getReference('042'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('042.21');
        $classificacao->setParent($this->getReference('042'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('042.22');
        $classificacao->setParent($this->getReference('042'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('042.23');
        $classificacao->setParent($this->getReference('042'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('042.3');
        $classificacao->setParent($this->getReference('042'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('042.31');
        $classificacao->setParent($this->getReference('042'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('042.32');
        $classificacao->setParent($this->getReference('042'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('042.4');
        $classificacao->setParent($this->getReference('042'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('042.5');
        $classificacao->setParent($this->getReference('042'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('042.51');
        $classificacao->setParent($this->getReference('042'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('042.52');
        $classificacao->setParent($this->getReference('042'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('042.53');
        $classificacao->setParent($this->getReference('042'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('042.6');
        $classificacao->setParent($this->getReference('042'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('042.7');
        $classificacao->setParent($this->getReference('042'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('042.71');
        $classificacao->setParent($this->getReference('042'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('042.72');
        $classificacao->setParent($this->getReference('042'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('043.1');
        $classificacao->setParent($this->getReference('043'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('043.2');
        $classificacao->setParent($this->getReference('043'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('043.3');
        $classificacao->setParent($this->getReference('043'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('043.4');
        $classificacao->setParent($this->getReference('043'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('043.5');
        $classificacao->setParent($this->getReference('043'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('043.6');
        $classificacao->setParent($this->getReference('043'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('043.61');
        $classificacao->setParent($this->getReference('043'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('043.62');
        $classificacao->setParent($this->getReference('043'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('043.7');
        $classificacao->setParent($this->getReference('043'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('044.1');
        $classificacao->setParent($this->getReference('044'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('044.2');
        $classificacao->setParent($this->getReference('044'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('044.3');
        $classificacao->setParent($this->getReference('044'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('044.4');
        $classificacao->setParent($this->getReference('044'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('044.5');
        $classificacao->setParent($this->getReference('044'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('044.6');
        $classificacao->setParent($this->getReference('044'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('045.01');
        $classificacao->setParent($this->getReference('045'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('045.1');
        $classificacao->setParent($this->getReference('045'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('045.11');
        $classificacao->setParent($this->getReference('045'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('045.12');
        $classificacao->setParent($this->getReference('045'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('045.13');
        $classificacao->setParent($this->getReference('045'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('045.2');
        $classificacao->setParent($this->getReference('045'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('045.21');
        $classificacao->setParent($this->getReference('045'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('045.22');
        $classificacao->setParent($this->getReference('045'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('045.23');
        $classificacao->setParent($this->getReference('045'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('045.24');
        $classificacao->setParent($this->getReference('045'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('045.3');
        $classificacao->setParent($this->getReference('045'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('045.31');
        $classificacao->setParent($this->getReference('045'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('045.32');
        $classificacao->setParent($this->getReference('045'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('045.33');
        $classificacao->setParent($this->getReference('045'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('045.4');
        $classificacao->setParent($this->getReference('045'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('045.5');
        $classificacao->setParent($this->getReference('045'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('045.6');
        $classificacao->setParent($this->getReference('045'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('045.7');
        $classificacao->setParent($this->getReference('045'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('046.1');
        $classificacao->setParent($this->getReference('046'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('046.11');
        $classificacao->setParent($this->getReference('046'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('046.12');
        $classificacao->setParent($this->getReference('046'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('046.13');
        $classificacao->setParent($this->getReference('046'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('046.2');
        $classificacao->setParent($this->getReference('046'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('046.3');
        $classificacao->setParent($this->getReference('046'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('046.4');
        $classificacao->setParent($this->getReference('046'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('047.01');
        $classificacao->setParent($this->getReference('047'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('047.1');
        $classificacao->setParent($this->getReference('047'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('047.2');
        $classificacao->setParent($this->getReference('047'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('047.3');
        $classificacao->setParent($this->getReference('047'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('049.1');
        $classificacao->setParent($this->getReference('049'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('049.11');
        $classificacao->setParent($this->getReference('049'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('049.12');
        $classificacao->setParent($this->getReference('049'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('050.01');
        $classificacao->setParent($this->getReference('050'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('050.02');
        $classificacao->setParent($this->getReference('050'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('050.03');
        $classificacao->setParent($this->getReference('050'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('051.1');
        $classificacao->setParent($this->getReference('051'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('051.2');
        $classificacao->setParent($this->getReference('051'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('051.3');
        $classificacao->setParent($this->getReference('051'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('051.4');
        $classificacao->setParent($this->getReference('051'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('052.1');
        $classificacao->setParent($this->getReference('052'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('052.2');
        $classificacao->setParent($this->getReference('052'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('052.21');
        $classificacao->setParent($this->getReference('052'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('052.211');
        $classificacao->setParent($this->getReference('052'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('052.212');
        $classificacao->setParent($this->getReference('052'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('052.213');
        $classificacao->setParent($this->getReference('052'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('052.22');
        $classificacao->setParent($this->getReference('052'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('052.221');
        $classificacao->setParent($this->getReference('052'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('052.222');
        $classificacao->setParent($this->getReference('052'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('052.23');
        $classificacao->setParent($this->getReference('052'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('052.24');
        $classificacao->setParent($this->getReference('052'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('052.25');
        $classificacao->setParent($this->getReference('052'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('052.251');
        $classificacao->setParent($this->getReference('052'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('052.252');
        $classificacao->setParent($this->getReference('052'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('053.01');
        $classificacao->setParent($this->getReference('053'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('053.1');
        $classificacao->setParent($this->getReference('053'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('053.2');
        $classificacao->setParent($this->getReference('053'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('053.3');
        $classificacao->setParent($this->getReference('053'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('053.4');
        $classificacao->setParent($this->getReference('053'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('054.1');
        $classificacao->setParent($this->getReference('054'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('054.2');
        $classificacao->setParent($this->getReference('054'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('059.1');
        $classificacao->setParent($this->getReference('059'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('059.2');
        $classificacao->setParent($this->getReference('059'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('059.3');
        $classificacao->setParent($this->getReference('059'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('059.4');
        $classificacao->setParent($this->getReference('059'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('059.5');
        $classificacao->setParent($this->getReference('059'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('060.01');
        $classificacao->setParent($this->getReference('060'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('061.01');
        $classificacao->setParent($this->getReference('061'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('061.011');
        $classificacao->setParent($this->getReference('061'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('061.012');
        $classificacao->setParent($this->getReference('061'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('061.1');
        $classificacao->setParent($this->getReference('061'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('061.2');
        $classificacao->setParent($this->getReference('061'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('061.3');
        $classificacao->setParent($this->getReference('061'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('061.4');
        $classificacao->setParent($this->getReference('061'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('061.5');
        $classificacao->setParent($this->getReference('061'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('061.51');
        $classificacao->setParent($this->getReference('061'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('061.52');
        $classificacao->setParent($this->getReference('061'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('061.521');
        $classificacao->setParent($this->getReference('061'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('061.522');
        $classificacao->setParent($this->getReference('061'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('061.523');
        $classificacao->setParent($this->getReference('061'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('062.1');
        $classificacao->setParent($this->getReference('062'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('062.11');
        $classificacao->setParent($this->getReference('062'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('062.12');
        $classificacao->setParent($this->getReference('062'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('062.13');
        $classificacao->setParent($this->getReference('062'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('062.2');
        $classificacao->setParent($this->getReference('062'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('062.21');
        $classificacao->setParent($this->getReference('062'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('062.22');
        $classificacao->setParent($this->getReference('062'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('062.3');
        $classificacao->setParent($this->getReference('062'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('062.4');
        $classificacao->setParent($this->getReference('062'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('062.41');
        $classificacao->setParent($this->getReference('062'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('062.42');
        $classificacao->setParent($this->getReference('062'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('063.1');
        $classificacao->setParent($this->getReference('063'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('063.2');
        $classificacao->setParent($this->getReference('063'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('063.3');
        $classificacao->setParent($this->getReference('063'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('064.01');
        $classificacao->setParent($this->getReference('064'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('064.1');
        $classificacao->setParent($this->getReference('064'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('064.2');
        $classificacao->setParent($this->getReference('064'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('064.3');
        $classificacao->setParent($this->getReference('064'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('064.31');
        $classificacao->setParent($this->getReference('064'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('064.32');
        $classificacao->setParent($this->getReference('064'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('064.4');
        $classificacao->setParent($this->getReference('064'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('065.1');
        $classificacao->setParent($this->getReference('065'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('065.2');
        $classificacao->setParent($this->getReference('065'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('065.3');
        $classificacao->setParent($this->getReference('065'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('066.1');
        $classificacao->setParent($this->getReference('066'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('066.2');
        $classificacao->setParent($this->getReference('066'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('066.3');
        $classificacao->setParent($this->getReference('066'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('066.31');
        $classificacao->setParent($this->getReference('066'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('066.32');
        $classificacao->setParent($this->getReference('066'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('066.4');
        $classificacao->setParent($this->getReference('066'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('066.41');
        $classificacao->setParent($this->getReference('066'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('066.42');
        $classificacao->setParent($this->getReference('066'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('066.9');
        $classificacao->setParent($this->getReference('066'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('066.91');
        $classificacao->setParent($this->getReference('066'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('069.1');
        $classificacao->setParent($this->getReference('069'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('069.11');
        $classificacao->setParent($this->getReference('069'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('069.12');
        $classificacao->setParent($this->getReference('069'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('069.2');
        $classificacao->setParent($this->getReference('069'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('069.3');
        $classificacao->setParent($this->getReference('069'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('070.01');
        $classificacao->setParent($this->getReference('070'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('071.1');
        $classificacao->setParent($this->getReference('071'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('071.2');
        $classificacao->setParent($this->getReference('071'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('071.3');
        $classificacao->setParent($this->getReference('071'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('071.4');
        $classificacao->setParent($this->getReference('071'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('071.5');
        $classificacao->setParent($this->getReference('071'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('073.1');
        $classificacao->setParent($this->getReference('073'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('073.2');
        $classificacao->setParent($this->getReference('073'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('073.3');
        $classificacao->setParent($this->getReference('073'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('073.31');
        $classificacao->setParent($this->getReference('073'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('073.32');
        $classificacao->setParent($this->getReference('073'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('073.33');
        $classificacao->setParent($this->getReference('073'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('073.4');
        $classificacao->setParent($this->getReference('073'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('910.01');
        $classificacao->setParent($this->getReference('910'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('919.1');
        $classificacao->setParent($this->getReference('919'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('920.01');
        $classificacao->setParent($this->getReference('920'));
        $this->manager->persist($classificacao);

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
        return ['prodexec'];
    }
}
