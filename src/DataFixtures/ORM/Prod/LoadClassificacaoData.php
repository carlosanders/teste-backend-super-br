<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Prod/LoadClassificacaoData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Prod;

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
        $classificacao->setPermissaoUso(false);
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
        $this->addReference('Classificacao1', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('MODERNIZAÇÃO E REFORMA ADMINISTRATIVA PROJETOS, ESTUDOS E NORMAS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('001');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ENQUANTO VIGORA');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao2', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PLANOS, PROGRAMAS E PROJETOS DE TRABALHO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('002');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(9);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao3', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('RELATÓRIOS DE ATIVIDADES');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('003');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(9);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao4', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ACORDOS. AJUSTES. CONTRATOS. CONVÊNIOS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('004');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(9);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ENQUANTO VIGORA');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao5', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ORGANIZAÇÃO E FUNCIONAMENTO: NORMAS, REGULAMENTAÇÕES, DIRETRIZES, PROCEDIMENTOS, ESTUDOS E/OU DECISÕES DE CARÁTER GERAL');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('010');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ENQUANTO VIGORA');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao6', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('REGISTRO NOS ÓRGÃOS COMPETENTES');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('010.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ENQUANTO VIGORA');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao7', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('REGIMENTOS. REGULAMENTOS. ESTATUTOS. ORGANOGRAMAS. ESTRUTURAS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('010.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ENQUANTO VIGORA');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao8', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('AUDIÊNCIAS. DESPACHOS. REUNIÕES');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('010.3');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(2);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao9', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('COMISSÕES. CONSELHOS. GRUPOS DE TRABALHO. JUNTAS. COMITÊS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('011');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(4);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao10', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ATOS DE CRIAÇÃO, ATAS, RELATÓRIOS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('011.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(4);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao11', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('COMUNICAÇÃO SOCIAL');
        $classificacao->setPermissaoUso(false);
        $classificacao->setCodigo('012');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $this->addReference('Classificacao12', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('RELAÇÕES COM A IMPRENSA');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('012.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(1);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao13', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CREDENCIAMENTO DE JORNALISTAS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('012.11');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ENQUANTO VIGORA');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao14', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ENTREVISTAS. NOTICIÁRIOS. REPORTAGENS. EDITORIAIS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('012.12');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(2);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao15', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DIVULGAÇÃO INTERNA');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('012.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(2);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao16', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CAMPANHAS INSTITUCIONAIS. PUBLICIDADE');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('012.3');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(10);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(4);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao17', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('OUTROS ASSUNTOS REFERENTES À ORGANIZAÇÃO E FUNCIONAMENTO');
        $classificacao->setPermissaoUso(false);
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
        $this->addReference('Classificacao18', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('INFORMAÇÕES SOBRE O ÓRGÃO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('019.01');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(2);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao19', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PESSOAL');
        $classificacao->setPermissaoUso(false);
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
        $this->addReference('Classificacao20', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('LEGISLAÇÃO NORMAS, REGULAMENTAÇÕES, DIRETRIZES, ESTATUTOS, REGULAMENTOS, PROCEDIMENTOS, ESTUDOS E/OU DECISÕES DE CARÁTER GERAL');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('020.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ENQUANTO VIGORA');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao21', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('BOLETINS ADMINISTRATIVO, DE PESSOAL E DE SERVIÇO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('020.11');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(10);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(10);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao22', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('IDENTIFICAÇÃO FUNCIONAL (INCLUSIVE CARTEIRA, CARTÃO, CRACHÁ, CREDENCIAL E PASSAPORTE DIPLOMÁTICO)');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('020.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('Enquanto o servidor permanecer');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao23', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('OBRIGAÇÕES TRABALHISTAS E ESTATUTÁRIAS. RELAÇÕES COM ÓRGÃOS NORMATIZADORES DA ADMINISTRAÇÃO PÚBLICA. LEI DOS 2/3. RAIS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('020.3');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao24', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('RELAÇÕES COM OS CONSELHOS PROFISSIONAIS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('020.31');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(2);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao25', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('SINDICATOS. ACORDOS. DISSÍDIOS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('020.4');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao26', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ASSENTAMENTOS INDIVIDUAIS. CADASTRO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('020.5');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('100 Anos. Ver detalhes no campo observação');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('Enquanto o servidor permanecer');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao27', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('RECRUTAMENTO E SELEÇÃO');
        $classificacao->setPermissaoUso(false);
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
        $this->addReference('Classificacao28', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CANDIDATOS A CARGO E EMPREGO PÚBLICOS: INSCRIÇÃO E CURRICULUM VITAE');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('021.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(2);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao29', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('EXAMES DE SELEÇÃO (CONCURSOS PÚBLICOS) PROVAS E TÍTULOS, TESTES PSICOTÉCNICOS E EXAMES MÉDICOS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('021.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(6);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao30', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONSTITUIÇÃO DE BANCAS EXAMINADORAS, EDITAIS, EXEMPLARES ÚNICOS DE PROVAS, GABARITOS, RESULTADOS E RECURSOS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('021.3');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(6);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao31', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('APERFEIÇOAMENTO E TREINAMENTO');
        $classificacao->setPermissaoUso(false);
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
        $this->addReference('Classificacao32', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CURSOS (INCLUSIVE BOLSAS DE ESTUDO)');
        $classificacao->setPermissaoUso(false);
        $classificacao->setCodigo('022.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $this->addReference('Classificacao33', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PROMOVIDOS PELA INSTITUIÇÃO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('022.11');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao34', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PROPOSTAS, ESTUDOS, EDITAIS, PROGRAMAS, RELATÓRIOS FINAIS, EXEMPLARES ÚNICOS DE EXERCÍCIOS, RELAÇÃO DE PARTICIPANTES, AVALIAÇÃO E CONTROLE DE EXPEDIÇÃO DE CERTIFICADOS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('022.111');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao35', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PROMOVIDOS POR OUTRAS INSTITUIÇÕES');
        $classificacao->setPermissaoUso(false);
        $classificacao->setCodigo('022.12');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $this->addReference('Classificacao36', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('NO BRASIL');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('022.121');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao37', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('NO EXTERIOR');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('022.122');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao38', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PROMOVIDOS PELA INSTITUIÇÃO (INCLUSIVE PROPOSTAS)');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('022.21');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao39', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ESTUDOS, PROPOSTAS, PROGRAMAS, RELATÓRIOS FINAIS, RELAÇÃO DE PARTICIPANTES, AVALIAÇÃO E DECLARAÇÃO DE COMPROVAÇÃO DE ESTÁGIO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('022.211');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao40', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PROMOVIDOS POR OUTRAS INSTITUIÇÕES');
        $classificacao->setPermissaoUso(false);
        $classificacao->setCodigo('022.22');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $this->addReference('Classificacao41', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('NO BRASIL');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('022.221');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao42', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('NO EXTERIOR');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('022.222');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao43', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('OUTROS ASSUNTOS REFERENTES A APERFEIÇOAMENTO E TREINAMENTO');
        $classificacao->setPermissaoUso(false);
        $classificacao->setCodigo('022.9');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $this->addReference('Classificacao44', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('QUADROS, TABELAS E POLÍTICA DE PESSOAL');
        $classificacao->setPermissaoUso(false);
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
        $this->addReference('Classificacao45', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ESTUDOS E PREVISÃO DE PESSOAL');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('023.01');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao46', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CRIAÇÃO, CLASSIFICAÇÃO, TRANSFORMAÇÃO, TRANSPOSIÇÃO E REMUNERAÇÃO DE CARGOS E FUNÇÕES');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('023.02');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao47', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('REESTRUTURAÇÕES E ALTERAÇÕES SALARIAIS. ASCENSÃO E PROGRESSÃO FUNCIONAL AVALIAÇÃO DE DESEMPENHO. ENQUADRAMENTO. EQUIPARAÇÃO, REAJUSTE E REPOSIÇÃO SALARIAL PROMOÇÕES');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('023.03');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(47);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao48', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('MOVIMENTAÇÃO DE PESSOAL');
        $classificacao->setPermissaoUso(false);
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
        $this->addReference('Classificacao49', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ADMISSÃO. APROVEITAMENTO. CONTRATAÇÃO. NOMEAÇÃO. READMISSÃO. READAPTAÇÃO. RECONDUÇÃO. REINTEGRAÇÃO. REVERSÃO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('023.11');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(47);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao50', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DEMISSÃO. DISPENSA. EXONERAÇÃO. RESCISÃO CONTRATUAL. FALECIMENTO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('023.12');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(47);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao51', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('LOTAÇÃO. REMOÇÃO. TRANSFERÊNCIA. PERMUTA');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('023.13');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(4);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao52', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DESIGNAÇÃO. DISPONIBILIDADE. REDISTRIBUIÇÃO. SUBSTITUIÇÃO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('023.14');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(47);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao53', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('REQUISIÇÃO. CESSÃO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('023.15');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(47);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao54', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DIREITOS, OBRIGAÇÕES E VANTAGENS');
        $classificacao->setPermissaoUso(false);
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
        $this->addReference('Classificacao55', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('FOLHAS DE PAGAMENTO. FICHAS FINANCEIRAS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('024.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(95);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao56', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('SALÁRIOS, VENCIMENTOS, PROVENTOS E REMUNERAÇÕES');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('024.11');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(7);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao57', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('SALÁRIO-FAMÍLIA');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('024.111');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(19);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao58', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ABONO OU PROVENTO PROVISÓRIO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('024.112');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(7);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao59', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ABONO DE PERMANÊNCIA EM SERVIÇO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('024.113');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A HOMOLOGAÇÃO DA APOSENTADORIA');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao60', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('OUTROS SALÁRIOS, VENCIMENTOS, PROVENTOS E REMUNERAÇÕES');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('024.119');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(7);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao61', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('GRATIFICAÇÕES (INCLUSIVE INCORPORAÇÕES)');
        $classificacao->setPermissaoUso(false);
        $classificacao->setCodigo('024.12');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $this->addReference('Classificacao62', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DE FUNÇÃO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('024.121');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(47);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao63', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DE JETONS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('024.122');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(7);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao64', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CARGOS EM COMISSÃO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('024.123');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(47);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao65', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('NATALINAS (DÉCIMO TERCEIRO SALÁRIO)');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('024.124');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(7);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao66', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('OUTRAS GRATIFICAÇÕES');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('024.129');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(47);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao67', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ADICIONAIS');
        $classificacao->setPermissaoUso(false);
        $classificacao->setCodigo('024.13');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $this->addReference('Classificacao68', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('TEMPO DE SERVIÇO (ANUÊNIOS, BIÊNIOS E QUINQUÊNIOS)');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('024.131');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(47);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao69', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('NOTURNO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('024.132');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(47);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao70', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PERICULOSIDADE');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('024.133');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(47);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao71', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('INSALUBRIDADE');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('024.134');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(47);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao72', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ATIVIDADES PENOSAS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('024.135');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(47);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao73', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('SERVIÇOS EXTRAORDINÁRIOS (HORAS EXTRAS)');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('024.136');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(47);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao74', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('FÉRIAS: ADICIONAL DE 1/3 E ABONO PECUNIÁRIO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('024.137');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(7);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao75', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('OUTROS ADICIONAIS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('024.139');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(47);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao76', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DESCONTOS');
        $classificacao->setPermissaoUso(false);
        $classificacao->setCodigo('024.14');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $this->addReference('Classificacao77', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONTRIBUIÇÃO SINDICAL DO SERVIDOR');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('024.141');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(7);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao78', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONTRIBUIÇÃO PARA O PLANO DE SEGURIDADE SOCIAL');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('024.142');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(47);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao79', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('IMPOSTO DE RENDA RETIDO NA FONTE (IRRF)');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('024.143');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(7);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao80', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PENSÕES ALIMENTÍCIAS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('024.144');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(95);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao81', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONSIGNAÇÕES');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('024.145');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(7);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao82', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('OUTROS DESCONTOS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('024.149');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(7);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao83', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ENCARGOS PATRONAIS. RECOLHIMENTOS');
        $classificacao->setPermissaoUso(false);
        $classificacao->setCodigo('024.15');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $this->addReference('Classificacao84', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PROGRAMA DE FORMAÇÃO DO PATRIMÔNIO DO SERVIDOR PÚBLICO (PASEP). PROGRAMA DE INTEGRAÇÃO SOCIAL (PIS)');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('024.151');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao85', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('FUNDO DE GARANTIA POR TEMPO DE SERVIÇO (FGTS)');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('024.152');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(47);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao86', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONTRIBUIÇÃO SINDICAL DO EMPREGADOR');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('024.153');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(7);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao87', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONTRIBUIÇÃO PARA O PLANO DE SEGURIDADE SOCIAL (INCLUSIVE CONTRIBUIÇÕES ANTERIORES)');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('024.154');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(95);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao88', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('SALÁRIO MATERNIDADE');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('024.155');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(7);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao89', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('IMPOSTO DE RENDA');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('024.156');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(7);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao90', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('FÉRIAS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('024.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(7);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao91', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('LICENÇAS: ACIDENTE EM SERVIÇO. ADOTANTE. AFAST DO CÔNJUGE/COMPANHEIRO. ATIV POLÍTICA. CAPACITAÇÃO PROF. DESEMP DE MANDATO CLASSISTA. DOENÇA EM PESSOA DA FAMÍLIA. GESTANTE. PATERNIDADE. PRÊMIO POR ASSID SVÇO MILITAR. TRAT DE INTER PART.');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('024.3');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(47);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao92', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('AFASTAMENTOS: PARA DEPOR. PARA EXERCER MANDATO ELETIVO. PARA SERVIR AO TRIBUNAL REGIONAL ELEITORAL (TRE). PARA SERVIR COMO JURADO. SUSPENSÃO DE CONTRATO DE TRABALHO (CLT)');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('024.4');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(47);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao93', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('REEMBOLSO DE DESPESAS');
        $classificacao->setPermissaoUso(false);
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
        $this->addReference('Classificacao94', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('MUDANÇA DE DOMICÍLIO DE SERVIDORES');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('024.51');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao95', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('LOCOMOÇÃO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('024.52');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao96', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('OUTROS REEMBOLSOS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('024.59');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao97', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('OUTROS DIREITOS, OBRIGAÇÕES E VANTAGENS');
        $classificacao->setPermissaoUso(false);
        $classificacao->setCodigo('024.9');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $this->addReference('Classificacao98', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONCESSÕES: ALISTAMENTO ELEITORAL. CASAMENTO (GALA). DOAÇÃO DE SANGUE. FALECIMENTO DE FAMILIARES (NOJO). HORÁRIO ESPECIAL PARA SERVIDOR ESTUDANTE. HORÁRIO ESPECIAL PARA SERVIDOR PORTADOR DE DEFICIÊNCIA');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('024.91');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(47);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao99', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('AUXÍLIOS: ALIMENTAÇÃO/REFEIÇÃO. ASSISTÊNCIA PRÉ-ESCOLAR/CRECHE. FARDAMENTO/UNIFORME. MORADIA. VALE-TRANSPORTE');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('024.92');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao100', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('APURAÇÃO DE RESPONSABILIDADE E AÇÃO DISCIPLINAR');
        $classificacao->setPermissaoUso(false);
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
        $this->addReference('Classificacao101', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DENÚNCIAS. SINDICÂNCIAS. INQUÉRITOS');
        $classificacao->setPermissaoUso(false);
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
        $this->addReference('Classificacao102', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PROCESSOS DISCIPLINARES');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('025.11');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(95);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao103', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PPENALIDADES DISCIPLINARES');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('025.12');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(95);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao104', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PREVIDÊNCIA, ASSISTÊNCIA E SEGURIDADE SOCIAL');
        $classificacao->setPermissaoUso(false);
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
        $this->addReference('Classificacao105', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PREVIDÊNCIA PRIVADA');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('026.01');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(47);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao106', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('BENEFÍCIOS');
        $classificacao->setPermissaoUso(false);
        $classificacao->setCodigo('026.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $this->addReference('Classificacao107', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('SEGUROS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('026.11');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao108', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('AUXÍLIOS: ACIDENTE. DOENÇA. FUNERAL. NATALIDADE');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('026.12');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao109', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('RECLUSÃO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('026.121');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(47);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao110', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('APOSENTADORIA');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('026.13');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(95);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao111', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONTAGEM E AVERBAÇÃO DE TEMPO DE SERVIÇO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('026.131');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A HOMOLOGAÇÃO DA APOSENTADORIA');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao112', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PENSÕES: PROVISÓRIA E TEMPORÁRIA');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('026.132');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ENQUANTO VIGORA');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao113', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PENSÃO VITALÍCIA');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('026.1321');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(95);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao114', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('OUTROS BENEFÍCIOS');
        $classificacao->setPermissaoUso(false);
        $classificacao->setCodigo('026.19');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $this->addReference('Classificacao115', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ADIANTAMENTOS E EMPRÉSTIMOS A SERVIDORES');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('026.191');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A QUITAÇÃO DA DÍVIDA');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao116', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ASSISTÊNCIA À SAÚDE (INCLUSIVE PLANOS DE SAÚDE)');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('026.192');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao117', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PRONTUÁRIO MÉDICO DO SERVIDOR');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('026.1921');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(95);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao118', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('AQUISIÇÃO DE IMÓVEIS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('026.193');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A QUITAÇÃO DA DÍVIDA');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao119', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('OCUPAÇÃO DE PRÓPRIOS DA UNIÃO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('026.194');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ENQUANTO PERMANECE A OCUPAÇÃO');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao120', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('TRANSPORTES PARA SERVIDORES');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('026.195');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(2);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao121', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('HIGIENE E SEGURANÇA DO TRABALHO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('026.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(2);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao122', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PREVENÇÃO DE ACIDENTES DE TRABALHO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('026.21');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(47);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao123', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('COMISSÃO INTERNA DE PREVENÇÃO DE ACIDENTES (CIPA)');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('026.211');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(2);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao124', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CRIAÇÃO, DESIGNAÇÃO, PROPOSTAS, RELATÓRIOS E ATAS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('026.212');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(3);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao125', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('REFEITÓRIOS, CANTINAS E COPAS (FORNECIMENTO DE REFEIÇÕES)');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('026.22');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(2);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao126', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('INSPEÇÕES PERIÓDICAS DE SAÚDE');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('026.23');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao127', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('OUTROS ASSUNTOS REFERENTES A PESSOAL');
        $classificacao->setPermissaoUso(false);
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
        $this->addReference('Classificacao128', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('HORÁRIO DE EXPEDIENTE (INCLUSIVE ESCALA DE PLANTÃO)');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('029.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(2);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao129', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONTROLE DE FREQUÊNCIA: LIVROS, CARTÕES, FOLHAS DE PONTO, ABONO DE FALTAS, CUMPRIMENTO DE HORAS EXTRAS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('029.11');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(47);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao130', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('MISSÕES FORA DA SEDE. VIAGENS A SERVIÇO');
        $classificacao->setPermissaoUso(false);
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
        $this->addReference('Classificacao131', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('NO PAÍS: AJUDAS DE CUSTO, DIÁRIAS, PASSAGENS (INCLUSIVE DEVOLUÇÃO), PRESTAÇÕES DE CONTAS, RELATÓRIOS DE VIAGEM');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('029.21');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao132', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('NO EXTERIOR (AFASTAMENTO DO PAÍS)');
        $classificacao->setPermissaoUso(false);
        $classificacao->setCodigo('029.22');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $this->addReference('Classificacao133', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('SEM ÔNUS PARA A INSTITUIÇÃO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('029.221');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(7);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao134', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('COM ÔNUS PARA A INSTITUIÇÃO. AUTOR. DE AFASTAMENTO. DIÁRIAS (INC. COMPRA DE MOEDA ESTRANGEIRA). LISTA DE PARTICIPANTES (COMITIVAS E DELEGAÇÕES). PASSAGENS. PASSAPORTES. PRESTAÇÕES DE CONTAS. RELATÓRIOS DE VIAGEM. RESERVAS DE HOTEL');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('029.222');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao135', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('INCENTIVOS FUNCIONAIS');
        $classificacao->setPermissaoUso(false);
        $classificacao->setCodigo('029.3');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $this->addReference('Classificacao136', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PRÊMIOS: CONCESSÃO DE MEDALHAS, DIPLOMAS DE HONRA AO MÉRITO E ELOGIOS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('029.31');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao137', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DELEGAÇÕES DE COMPETÊNCIA. PROCURAÇÃO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('029.4');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ENQUANTO VIGORA');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao138', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('SERVIÇOS PROFISSIONAIS TRANSITÓRIOS: AUTÔNOMOS E COLABORADORES (INCLUSIVE LICITAÇÕES)');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('029.5');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('Ver observações');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ENQUANTO VIGORA A PRESTAÇÃO DO SERVIÇO');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao139', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('AÇÕES TRABALHISTAS. RECLAMAÇÕES TRABALHISTAS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('029.6');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ O TRÂNSITO EM JULGADO');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao140', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('MOVIMENTOS REIVINDICATÓRIOS: GREVES E PARALISAÇÕES');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('029.7');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao141', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('MATERIAL: NORMAS, REGULAMENTAÇÕES, DIRETRIZES, PROCEDIMENTOS, ESTUDOS E/OU DECISÕES DE CARÁTER GERAL');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('030');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ENQUANTO VIGORA');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao142', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CADASTRO DE FORNECEDORES');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('030.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao143', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ESPECIFICAÇÃO. PADRONIZAÇÃO. CODIFICAÇÃO. PREVISÃO. CATÁLOGO. IDENTIFICAÇÃO. CLASSIFICAÇÃO (INCLUSIVE AMOSTRAS)');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('031');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(2);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao144', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('REQUISIÇÃO E CONTROLE DE SERVIÇOS REPROGRÁFICOS (INCLUSIVE ASSINATURAS AUTORIZADAS E REPRODUÇÕES DE FORMULÁRIOS)');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('032');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(1);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao145', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('AQUISIÇÃO (INCLUSIVE LICITAÇÕES)');
        $classificacao->setPermissaoUso(false);
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
        $this->addReference('Classificacao146', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('MATERIAL PERMANENTE');
        $classificacao->setPermissaoUso(false);
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
        $this->addReference('Classificacao147', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('COMPRA (INCLUSIVE COMPRA POR IMPORTAÇÃO)');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('033.11');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao148', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ALUGUEL. COMODATO. LEASING');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('033.12');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao149', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('EMPRÉSTIMO. CESSÃO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('033.13');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ENQUANTO VIGORA');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao150', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DOAÇÃO. PERMUTA');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('033.14');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(4);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao151', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('MATERIAL DE CONSUMO');
        $classificacao->setPermissaoUso(false);
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
        $this->addReference('Classificacao152', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('COMPRA');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('033.21');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao153', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CESSÃO. DOAÇÃO. PERMUTA');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('033.22');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(4);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao154', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONFECÇÃO DE IMPRESSOS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('033.23');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao155', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('MOVIMENTAÇÃO DE MATERIAL (PERMANENTE E DE CONSUMO)');
        $classificacao->setPermissaoUso(false);
        $classificacao->setCodigo('034');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $this->addReference('Classificacao156', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('TERMOS DE RESPONSABILIDADE (INCLUSIVE RMB OU RMBM)');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('034.01');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao157', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONTROLE DE ESTOQUE (INCLUSIVE REQUISIÇÃO, DISTRIBUIÇÃO E RMA)');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('034.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(2);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao158', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('EXTRAVIO. ROUBO. DESAPARECIMENTO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('034.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('Até a conclusão do caso');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao159', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('TRANSPORTE DE MATERIAL');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('034.3');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(2);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao160', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('AUTORIZAÇÃO DE SAÍDA DE MATERIAL');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('034.4');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(1);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao161', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('RECOLHIMENTO DE MATERIAL AO DEPÓSITO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('034.5');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(2);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao162', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ALIENAÇÃO. BAIXA (MATERIAL PERMANENTE E DE CONSUMO)');
        $classificacao->setPermissaoUso(false);
        $classificacao->setCodigo('035');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $this->addReference('Classificacao163', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('VENDA (INCLUSIVE LEILÃO)');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('035.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao164', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CESSÃO. DOAÇÃO. PERMUTA');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('035.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(4);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao165', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('INSTALAÇÃO E MANUTENÇÃO');
        $classificacao->setPermissaoUso(false);
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
        $this->addReference('Classificacao166', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('REQUISIÇÃO E CONTRATAÇÃO DE SERVIÇOS (INCLUSIVE LICITAÇÕES)');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('036.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao167', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('SERVIÇOS EXECUTADOS EM OFICINAS DO ÓRGÃO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('036.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(1);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao168', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('INVENTÁRIO');
        $classificacao->setPermissaoUso(false);
        $classificacao->setCodigo('037');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $this->addReference('Classificacao169', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('MATERIAL PERMANENTE');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('037.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao170', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('MATERIAL DE CONSUMO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('037.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao171', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('OUTROS ASSUNTOS REFERENTES A MATERIAL');
        $classificacao->setPermissaoUso(false);
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
        $this->addReference('Classificacao172', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PATRIMÔNIO: NORMAS, REGULAMENTAÇÕES, DIRETRIZES, PROCEDI- MENTOS, ESTUDOS E/OU DECISÕES DE CARÁTER GERAL');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('040');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ENQUANTO VIGORA');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao173', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('BENS IMÓVEIS: PROJETOS, PLANTAS E ESCRITURAS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('041');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(3);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao174', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('FORNECIMENTO E MANUTENÇÃO DE SERVIÇOS BÁSICOS');
        $classificacao->setPermissaoUso(false);
        $classificacao->setCodigo('041.01');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $this->addReference('Classificacao175', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ÁGUA E ESGOTO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('041.011');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao176', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('GÁS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('041.012');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao177', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('LUZ E FORÇA');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('041.013');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao178', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('COMISSÃO INTERNA DE CONSERVAÇÃO DE ENERGIA (CICE)');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('041.02');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(2);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao179', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CRIAÇÃO, DESIGNAÇÃO, PROPOSTAS DE REDUÇÃO DE GASTOS COM ENERGIA, RELATÓRIOS E ATAS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('041.021');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(3);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao180', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONDOMÍNIO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('041.03');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao181', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('AQUISIÇÃO');
        $classificacao->setPermissaoUso(false);
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
        $this->addReference('Classificacao182', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('COMPRA');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('041.11');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao183', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CESSÃO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('041.12');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(4);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao184', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DOAÇÃO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('041.13');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(4);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao185', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PERMUTA');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('041.14');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(4);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao186', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('LOCAÇÃO. ARRENDAMENTO. COMODATO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('041.15');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao187', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ALIENAÇÃO');
        $classificacao->setPermissaoUso(false);
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
        $this->addReference('Classificacao188', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('VENDA');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('041.21');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao189', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CESSÃO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('041.22');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(4);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao190', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DOAÇÃO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('041.23');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(4);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao191', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PERMUTA');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('041.24');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(4);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao192', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DESAPROPRIAÇÃO. REINTEGRAÇÃO DE POSSE. REIVINDICAÇÃO DE DOMÍNIO. TOMBAMENTO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('041.3');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao193', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('OBRAS');
        $classificacao->setPermissaoUso(false);
        $classificacao->setCodigo('041.4');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $this->addReference('Classificacao194', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('REFORMA. RECUPERAÇÃO. RESTAURAÇÃO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('041.41');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao195', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONSTRUÇÃO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('041.42');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao196', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('SERVIÇOS DE MANUTENÇÃO (INCLUSIVE LICITAÇÕES)');
        $classificacao->setPermissaoUso(false);
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
        $this->addReference('Classificacao197', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('MANUTENÇÃO DE ELEVADORES');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('041.51');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao198', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('MANUTENÇÃO DE AR-CONDICIONADO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('041.52');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao199', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('MANUTENÇÃO DE SUBESTAÇÕES E GERADORES');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('041.53');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao200', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('LIMPEZA. IMUNIZAÇÃO. DESINFESTAÇÃO (INCLUSIVE PARA JARDINS)');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('041.54');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao201', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('OUTROS SERVIÇOS DE MANUTENÇÃO');
        $classificacao->setPermissaoUso(false);
        $classificacao->setCodigo('041.59');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $this->addReference('Classificacao202', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('VEÍCULOS');
        $classificacao->setPermissaoUso(false);
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
        $this->addReference('Classificacao203', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('AQUISIÇÃO (INCLUSIVE LICITAÇÕES)');
        $classificacao->setPermissaoUso(false);
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
        $this->addReference('Classificacao204', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('COMPRA (INCLUSIVE COMPRA POR IMPORTAÇÃO)');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('042.11');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao205', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('COMPRA (INCLUSIVE COMPRA POR IMPORTAÇÃO)');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('042.12');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao206', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CESSÃO. DOAÇÃO. PERMUTA. TRANSFERÊNCIA');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('042.13');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(4);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao207', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CADASTRO. LICENCIAMENTO. EMPLACAMENTO. TOMBAMENTO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('042.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('Até a alienação');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao208', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ALIENAÇÃO (INCLUSIVE LICITAÇÕES)');
        $classificacao->setPermissaoUso(false);
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
        $this->addReference('Classificacao209', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('VENDA (INCLUSIVE LEILÃO)');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('042.31');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao210', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CESSÃO. DOAÇÃO. PERMUTA. TRANSFERÊNCIA');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('042.32');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(4);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao211', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ABASTECIMENTO. LIMPEZA. MANUTENÇÃO. REPARO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('042.4');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao212', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ACIDENTES. INFRAÇÕES. MULTAS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('042.5');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao213', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('OUTROS ASSUNTOS REFERENTES A VEÍCULOS');
        $classificacao->setPermissaoUso(false);
        $classificacao->setCodigo('042.9');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $this->addReference('Classificacao214', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONTROLE DE USO DE VEÍCULOS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('042.91');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(2);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao215', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('REQUISIÇÃO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('042.911');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(2);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao216', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('AUTORIZAÇÃO PARA USO FORA DO HORÁRIO DE EXPEDIENTE');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('042.912');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(2);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao217', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ESTACIONAMENTO. GARAGEM');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('042.913');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(2);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao218', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('BENS SEMOVENTES');
        $classificacao->setPermissaoUso(false);
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
        $this->addReference('Classificacao219', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('INVENTÁRIO (INCLUSIVE RMBI)');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('044');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao220', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('OUTROS ASSUNTOS REFERENTES A PATRIMÔNIO');
        $classificacao->setPermissaoUso(false);
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
        $this->addReference('Classificacao221', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('GUARDA E SEGURANÇA');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('049.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(2);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao222', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('SERVIÇOS DE VIGILÂNCIA');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('049.11');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao223', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('SEGUROS (INCLUSIVE DE VEÍCULOS)');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('049.12');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao224', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PREVENÇÃO DE INCÊNDIO: TREINAMENTO DE PESSOAL, INSTALAÇÃO E MANUTENÇÃO DE EXTINTORES, INSPEÇÕES PERIÓDICAS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('049.13');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(2);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao225', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONSTITUIÇÃO DE BRIGADAS DE INCÊNDIO, PLANOS, PROJETOS E RELATÓRIOS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('049.131');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(4);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao226', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('SINISTRO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('049.14');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('Até a conclusão do caso');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao227', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONTROLE DE PORTARIA');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('049.15');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(2);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao228', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('REGISTRO DE OCORRÊNCIAS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('049.151');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao229', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('MUDANÇAS');
        $classificacao->setPermissaoUso(false);
        $classificacao->setCodigo('049.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $this->addReference('Classificacao230', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PARA OUTROS IMÓVEIS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('049.21');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao231', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DENTRO DO MESMO IMÓVEL');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('049.22');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao232', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('USO DE DEPENDÊNCIAS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('049.3');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(2);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao233', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ORÇAMENTO E FINANÇAS: NORMAS, REGULAMENTAÇÕES, DIRETRIZES, PROCEDIMENTOS, ESTUDOS E/OU DECISÕES DE CARÁTER GERAL');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('050');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ENQUANTO VIGORA');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao234', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('AUDITORIA');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('050.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao235', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ORÇAMENTO');
        $classificacao->setPermissaoUso(false);
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
        $this->addReference('Classificacao236', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PROGRAMAÇÃO ORÇAMENTÁRIA');
        $classificacao->setPermissaoUso(false);
        $classificacao->setCodigo('051.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $this->addReference('Classificacao237', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PREVISÃO ORÇAMENTÁRIA');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('051.11');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(2);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao238', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PROPOSTA ORÇAMENTÁRIA');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('051.12');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao239', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('QUADRO DE DETALHAMENTO DE DESPESA (QDD)');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('051.13');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(2);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao240', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CRÉDITOS ADICIONAIS: CRÉDITO SUPLEMENTAR. CRÉDITO ESPECIAL. CRÉDITO EXTRAORDINÁRIO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('051.14');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao241', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('EXECUÇÃO ORÇAMENTÁRIA');
        $classificacao->setPermissaoUso(false);
        $classificacao->setCodigo('051.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $this->addReference('Classificacao242', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DESCENTRALIZAÇÃO DE RECURSOS (DISTRIBUIÇÃO ORÇAMENTÁRIA)');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('051.21');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao243', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ACOMPANHAMENTO DE DESPESA MENSAL (PESSOAL/DÍVIDA)');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('051.22');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao244', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PLANO OPERATIVO. CRONOGRAMA DE DESEMBOLSO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('051.23');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao245', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('FINANÇAS');
        $classificacao->setPermissaoUso(false);
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
        $this->addReference('Classificacao246', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('EXECUÇÃO FINANCEIRA');
        $classificacao->setPermissaoUso(false);
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
        $this->addReference('Classificacao247', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('RECEITA');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('052.21');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao248', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DESPESA');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('052.22');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao249', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('FUNDOS ESPECIAIS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('053');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao250', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ESTÍMULOS FINANCEIROS E CREDITÍCIOS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('054');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao251', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('OPERAÇÕES BANCÁRIAS');
        $classificacao->setPermissaoUso(false);
        $classificacao->setCodigo('055');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $this->addReference('Classificacao252', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PAGAMENTOS EM MOEDA ESTRANGEIRA');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('055.01');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao253', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONTA ÚNICA (INCLUSIVE ASSINATURAS AUTORIZADAS E EXTRATOS DE CONTAS)');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('055.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao254', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('OUTRAS CONTAS: TIPO B, C e D (INCLUSIVE ASSINATURAS AUTORIZADAS E EXTRATOS DE CONTAS)');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('055.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao255', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('BALANÇOS. BALANCETES');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('056');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao256', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('TOMADA DE CONTAS. PRESTAÇÃO DE CONTAS (INCLUSIVE PARECER DE APROVAÇÃO DAS CONTAS)');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('057');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao257', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('OUTROS ASSUNTOS REFERENTES A ORÇAMENTO E FINANÇAS');
        $classificacao->setPermissaoUso(false);
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
        $this->addReference('Classificacao258', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('TRIBUTOS (IMPOSTOS E TAXAS)');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('059.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao259', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DOCUMENTAÇÃO E INFORMAÇÃO');
        $classificacao->setPermissaoUso(false);
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
        $this->addReference('Classificacao260', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PUBLICAÇÃO DE MATÉRIAS NO DIÁRIO OFICIAL');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('060.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao261', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PUBLICAÇÃO DE MATÉRIAS NOS BOLETINS ADMINISTRATIVO, DE PESSOAL E DE SERVIÇO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('060.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(1);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao262', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PUBLICAÇÃO DE MATÉRIAS EM OUTROS PERIÓDICOS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('060.3');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao263', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PRODUÇÃO EDITORIAL (INCLUSIVE EDIÇÃO OU COEDIÇÃO DE PUBLICAÇÕES EM GERAL PRODUZIDAS PELO ÓRGÃO EM QUALQUER SUPORTE)');
        $classificacao->setPermissaoUso(false);
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
        $this->addReference('Classificacao264', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('EDITORAÇÃO. PROGRAMAÇÃO VISUAL');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('061.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao265', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DISTRIBUIÇÃO. PROMOÇÃO. DIVULGAÇÃO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('061.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao266', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DOCUMENTAÇÃO BIBLIOGRÁFICA (LIVROS, PERIÓDICOS, FOLHETOS E AUDIOVISUAIS)');
        $classificacao->setPermissaoUso(false);
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
        $this->addReference('Classificacao267', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('NORMAS E MANUAIS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('062.01');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ENQUANTO VIGORA');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao268', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('AQUISIÇÃO (NO BRASIL E NO EXTERIOR)');
        $classificacao->setPermissaoUso(false);
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
        $this->addReference('Classificacao269', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('COMPRA (INCLUSIVE ASSINATURAS DE PERIÓDICOS)');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('062.11');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao270', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DOAÇÃO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('062.12');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(4);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao271', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PERMUTA');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('062.13');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(4);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao272', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('REGISTRO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('062.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(2);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao273', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CATALOGAÇÃO. CLASSIFICAÇÃO. INDEXAÇÃO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('062.3');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(2);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao274', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('REFERÊNCIA E CIRCULAÇÃO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('062.4');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(2);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao275', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('INVENTÁRIO)');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('062.5');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao276', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DOCUMENTAÇÃO ARQUIVÍSTICA: GESTÃO DE DOCUMENTOS E SISTEMA DE ARQUIVOS');
        $classificacao->setPermissaoUso(false);
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
        $this->addReference('Classificacao277', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('NORMAS E MANUAIS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('063.01');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(7);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ENQUANTO VIGORA');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao278', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PRODUÇÃO DE DOCUMENTOS. LEVANTAMENTO. FLUXO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('063.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(4);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao279', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DIAGNÓSTICO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('063.11');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao280', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PROTOCOLO: RECEPÇÃO, TRAMITAÇÃO E EXPEDIÇÃO DE DOCUMENTOS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('063.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(2);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao281', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ASSISTÊNCIA TÉCNICA');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('063.3');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao282', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CLASSIFICAÇÃO E ARQUIVAMENTO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('063.4');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(2);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao283', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CÓDIGO DE CLASSIFICAÇÃO DE DOCUMENTOS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('063.41');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('O prazo total de guarda do documento é de 100 anos, devendo o órgão permanecer com um exemplar por igual período. Ver observação');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ENQUANTO VIGORA');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao284', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('POLÍTICA DE ACESSO AOS DOCUMENTOS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('063.5');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao285', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONSULTAS. EMPRÉSTIMOS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('063.51');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('1 ano após a devolução');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao286', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DESTINAÇÃO DE DOCUMENTOS');
        $classificacao->setPermissaoUso(false);
        $classificacao->setCodigo('063.6');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $this->addReference('Classificacao287', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ANÁLISE. AVALIAÇÃO. SELEÇÃO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('063.61');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao288', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('TABELA DE TEMPORALIDADE');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('063.611');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('O prazo total de guarda do documento é de 100 anos, devendo o órgão permanecer com um exemplar por igual período. Ver observação');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ENQUANTO VIGORA');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao289', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ELIMINAÇÃO: TERMOS, LISTAGENS E EDITAIS DE CIÊNCIA DE ELIMINAÇÃO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('063.62');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao290', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('TRANSFERÊNCIA. RECOLHIMENTO. GUIAS E TERMOS DE TRANSFERÊNCIA, GUIAS, RELAÇÕES E TERMOS DE RECOLHIMENTO, LISTAGENS DESCRITIVAS DO ACERVO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('063.63');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao291', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DOCUMENTAÇÃO MUSEOLÓGICA');
        $classificacao->setPermissaoUso(false);
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
        $this->addReference('Classificacao292', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('REPRODUÇÃO DE DOCUMENTOS, ESTUDOS, PROJETOS E NORMAS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('065');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ENQUANTO VIGORA');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao293', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONSERVAÇÃO DE DOCUMENTOS');
        $classificacao->setPermissaoUso(false);
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
        $this->addReference('Classificacao294', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DESINFESTAÇÃO. HIGIENIZAÇÃO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('066.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao295', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ARMAZENAMENTO. DEPÓSITOS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('066.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(2);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao296', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('RESTAURAÇÃO DE DOCUMENTOS (INCLUSIVE ENCADERNAÇÃO)');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('066.3');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao297', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('INFORMÁTICA');
        $classificacao->setPermissaoUso(false);
        $classificacao->setCodigo('067');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $this->addReference('Classificacao298', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PLANOS E PROJETOS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('067.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ENQUANTO VIGORA');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao299', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PROGRAMAS. SISTEMAS. REDES (INCLUSIVE LICENÇA E REGISTRO DE USO E COMPRA)');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('067.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ENQUANTO VIGORA');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao300', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('MANUAIS TÉCNICOS (EXEMPLARES ÚNICOS)');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('067.21');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ENQUANTO VIGORA');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao301', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('MANUAIS DO USUÁRIO (EXEMPLARES ÚNICOS)');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('067.22');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ENQUANTO VIGORA');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao302', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ASSISTÊNCIA TÉCNICA');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('067.3');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao303', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('OUTROS ASSUNTOS REFERENTES À DOCUMENTAÇÃO E INFORMAÇÃO');
        $classificacao->setPermissaoUso(false);
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
        $this->addReference('Classificacao304', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('COMUNICAÇÕES: NORMAS, REGULAMENTAÇÕES, DIRETRIZES, PROCEDIMENTOS, ESTUDOS E/OU DECISÕES DE CARÁTER GERAL');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('070');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ENQUANTO VIGORA');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao305', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('SERVIÇO POSTAL');
        $classificacao->setPermissaoUso(false);
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
        $this->addReference('Classificacao306', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('SERVIÇOS DE ENTREGA EXPRESSA');
        $classificacao->setPermissaoUso(false);
        $classificacao->setCodigo('071.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $this->addReference('Classificacao307', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('NACIONAL');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('071.11');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao308', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('INTERNACIONAL');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('071.12');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao309', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('SERVIÇOS DE COLETA, TRANSPORTE E ENTREGA DE CORRESPONDÊNCIA AGRUPADA – MALOTE');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('071.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao310', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('MALA OFICIAL');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('071.3');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao311', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('OUTROS SERVIÇOS POSTAIS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('071.9');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao312', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('SERVIÇO DE RÁDIO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('072');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao313', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('INSTALAÇÃO. MANUTENÇÃO. REPARO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('072.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao314', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('SERVIÇO DE TELEX');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('073');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao315', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('INSTALAÇÃO. MANUTENÇÃO. REPARO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('073.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao316', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('SERVIÇO TELEFÔNICO (INCLUSIVE AUTORIZAÇÃO PARA LIGAÇÕES INTERURBANAS). FAC-SÍMILE (FAX)');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('074');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(2);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao317', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('INSTALAÇÃO. TRANSFERÊNCIA. MANUTENÇÃO. REPARO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('074.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao318', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('LISTAS TELEFÔNICAS INTERNAS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('074.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ENQUANTO VIGORA');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao319', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONTAS TELEFÔNICAS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('074.3');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao320', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('SERVIÇOS DE TRANSMISSÃO DE DADOS, VOZ E IMAGEM');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('075');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS A CONTAR DA DATA DE APROCAÇÃO DAS CONTAS');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento('ATÉ A APROVAÇÃO DAS CONTAS');
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao321', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('OUTROS ASSUNTOS REFERENTES À COMUNICAÇÕES');
        $classificacao->setPermissaoUso(false);
        $classificacao->setCodigo('079');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $this->addReference('Classificacao322', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('OUTROS ASSUNTOS REFERENTES À ADMINISTRAÇÃO GERAL');
        $classificacao->setPermissaoUso(false);
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
        $this->addReference('Classificacao323', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('AÇÕES JUDICIAIS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('091');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(95);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao324', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ASSUNTOS DIVERSOS');
        $classificacao->setPermissaoUso(false);
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
        $this->addReference('Classificacao325', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('SOLENIDADES. COMEMORAÇÕES. HOMENAGENS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('910');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(1);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao326', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PLANEJAMENTO, PROGRAMAÇÃO, DISCURSOS, PALESTRAS E TRABALHOS APRESENTADOS POR TÉCNICOS DO ÓRGÃO');
        $classificacao->setPermissaoUso(true);
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
        $this->addReference('Classificacao327', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONGRESSOS. CONFERÊNCIAS. SEMINÁRIOS. SIMPÓSIOS. ENCONTROS. CONVENÇÕES. CICLOS DE PALESTRAS. MESAS REDONDAS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('920');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(1);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao328', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PLANEJAMENTO, PROGRAMAÇÃO, DISCURSOS, PALESTRAS E TRABALHOS APRESENTADOS POR TÉCNICOS DO ÓRGÃO');
        $classificacao->setPermissaoUso(true);
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
        $this->addReference('Classificacao329', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('FEIRAS. SALÕES. EXPOSIÇÕES. MOSTRAS. FESTAS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('930');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(1);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao330', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PLANEJAMENTO, PROGRAMAÇÃO, DISCURSOS, PALESTRAS E TRABALHOS APRESENTADOS POR TÉCNICOS DO ÓRGÃO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('931');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao331', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONCURSOS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('932');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(1);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao332', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PLANEJAMENTO, NORMAS, EDITAIS, HABILITAÇÃO DOS CANDIDATOS, JULGAMENTO DA BANCA, TRABALHOS CONCORRENTES, PREMIAÇÃO E RECURSOS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('933');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(5);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao333', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('VISITAS E VISITANTES');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('940');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(1);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao334', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('VISITAS E VISITANTES');
        $classificacao->setPermissaoUso(false);
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
        $this->addReference('Classificacao335', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('APRESENTAÇÃO. RECOMENDAÇÃO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('991');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(1);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao336', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('COMUNICADOS E INFORMES');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('992');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(1);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao337', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('AGRADECIMENTOS. CONVITES. FELICITAÇÕES. PÊSAMES');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('993');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(1);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao338', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PROTESTOS. REIVINDICAÇÕES. SUGESTÕES');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('994');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(1);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao339', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PEDIDOS, OFERECIMENTOS E INFORMAÇÕES DIVERSAS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('995');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(1);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao340', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ASSOCIAÇÕES: CULTURAIS, DE AMIGOS E DE SERVIDORES');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('996');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(1);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao341', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONTENCIOSO JUDICIAL');
        $classificacao->setPermissaoUso(false);
        $classificacao->setCodigo('100');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $this->addReference('Classificacao342', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('NORMATIZAÇÃO E REGULAMENTAÇÃO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('101');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(10);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(30);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao343', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PLANEJAMENTO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('102');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(10);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(30);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao344', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('COORDENAÇÃO E SUPERVISÃO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('103');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(10);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(30);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao345', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('REPRESENTAÇÃO E DEFESA JUDICIAL DOS PODERES DA UNIÃO');
        $classificacao->setPermissaoUso(false);
        $classificacao->setCodigo('110');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $this->addReference('Classificacao346', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DA ADMINISTRAÇÃO DIRETA E INDIRETA');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('111');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANOS DO TRÂNSITO EM JULGADO');
        $classificacao->setPrazoGuardaFaseCorrenteDia(30);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao347', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PRECATÓRIOS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('111.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 (CINCO) ANOS DA QUITAÇÃO');
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao348', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('REQUISIÇÕES DE PEQUENO VALOR');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('111.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 (CINCO) ANOS DA QUITAÇÃO');
        $classificacao->setPrazoGuardaFaseCorrenteDia(30);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao349', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('COBRANÇA JUDICIAL DE CRÉDITOS E PATRIMÔNIO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('111.3');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 (CINCO) ANOS DO TRANSITO EM JULGADO');
        $classificacao->setPrazoGuardaFaseCorrenteDia(30);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao350', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DO AGENTE PÚBLICO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('112');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 (CINCO) ANOS DO TRANSITO EM JULGADO');
        $classificacao->setPrazoGuardaFaseCorrenteDia(30);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao351', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ANÁLISE DA FORÇA EXECUTÓRIA');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('120');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('20 ANOS DO TRANSITO EM JULGADO');
        $classificacao->setPrazoGuardaFaseCorrenteDia(30);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao352', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('COOPERAÇÃO JURÍDICA INTERNACIONAL');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('130');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 ANSO DO TRANSITO EM JULGADO');
        $classificacao->setPrazoGuardaFaseCorrenteDia(30);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao353', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONTENCIOSO ADMINISTRATIVO');
        $classificacao->setPermissaoUso(false);
        $classificacao->setCodigo('200');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $this->addReference('Classificacao354', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('NORMATIZAÇÃO E REGULAMENTAÇÃO (CA)');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('201');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(10);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(30);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao355', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PLANEJAMENTO (CA)');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('202');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(10);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(30);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao356', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('COORDENAÇÃO E SUPERVISÃO (CA)');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('203');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(10);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(30);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao357', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('REPRESENTAÇÃO E DEFESA EXTRAJUDICIAL DOS PODERES DA UNIÃO');
        $classificacao->setPermissaoUso(false);
        $classificacao->setCodigo('210');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $this->addReference('Classificacao358', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('DA ADMINISTRAÇÃO DIRETA E INDIRETA DA UNIÃO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('211');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(30);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao359', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PROBIDADE ADMINISTRATIVA');
        $classificacao->setPermissaoUso(false);
        $classificacao->setCodigo('211.1');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $this->addReference('Classificacao360', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('RECUPEARÇÃO DE CRÉDITOS E PATRIMÔNIO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('211.11');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 (CINCO) ANOS A PARTIR DA QUITAÇÃO');
        $classificacao->setPrazoGuardaFaseCorrenteDia(30);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao361', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('COMBATE À CORRUPÇÃO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('211.12');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(10);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(30);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao362', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('COBRANÇA EXTRAJUDICIAL DE CRÉDITOS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('211.2');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(10);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(30);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao363', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('AGENTE PÚBLICO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('212');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(10);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(30);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao364', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONSULTORIA E ASSESSORAMENTO JURÍDICO');
        $classificacao->setPermissaoUso(false);
        $classificacao->setCodigo('300');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $this->addReference('Classificacao365', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('NORMATIZAÇÃO E REGULAMENTAÇÃO (CAJ)');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('301');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(10);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(30);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao366', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PLANEJAMENTO (CAJ)');
        $classificacao->setPermissaoUso(false);
        $classificacao->setCodigo('302');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(10);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(30);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao367', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('COORDENAÇÃO E SUPERVISÃO (CAJ)');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('303');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(10);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(30);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao368', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ANÁLISE DE LEGALIDADE DO ATO ADMINISTRATIVO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('304');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(40);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(30);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao369', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('SUBSÍDIO PARA DEFESA EM JUÍZO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('305');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento('5 (CINCO) ANOS A PARTIR DO TRANSITO EM JULGADO DO PROCESSO A QUE SE REFERE');
        $classificacao->setPrazoGuardaFaseCorrenteDia(30);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $this->addReference('Classificacao370', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONCILIAÇÃO E ARBITRAGEM');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('306');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(95);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(30);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao371', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('UNIFORMIZAÇÃO DE ENTENDIMENTO JURÍDICO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('307');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(10);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(30);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao372', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('EDIÇÃO DE ATOS NORMATIVOS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('308');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(10);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(30);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao373', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('CONTENCIOSO INTERNACIONAL E ESTRANGEIRO');
        $classificacao->setPermissaoUso(false);
        $classificacao->setCodigo('400');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $this->addReference('Classificacao374', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('NORMATIZAÇÃO E REGULAMENTAÇÃO (CIE)');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('401');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(10);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(30);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao375', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('PLANEJAMENTO (CIE)');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('402');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(10);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(30);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-RECOLHIMENTO'));
        $this->addReference('Classificacao376', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ATUAÇÃO E FOROS ESTRANGEIROS');
        $classificacao->setPermissaoUso(false);
        $classificacao->setCodigo('410');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(null);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(null);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao(null);
        $this->addReference('Classificacao377', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('REPRESENTAÇÃO E DEFES JURÍDICA EM DEMANDA RELACIONADAS À UNIÃO');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('411');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(10);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(30);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao378', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('RECUPERAÇÃO INTERNACIONAL DE ATIVOS (PATRIMÔNIO E CRÉDITOS)');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('412');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(5);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(30);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao379', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = new Classificacao();
        $classificacao->setNome('ATUAÇÃO EM ORGANISMOS INTERNACIONAIS');
        $classificacao->setPermissaoUso(true);
        $classificacao->setCodigo('420');
        $classificacao->setPrazoGuardaFaseIntermediariaDia(null);
        $classificacao->setPrazoGuardaFaseIntermediariaMes(null);
        $classificacao->setPrazoGuardaFaseIntermediariaAno(10);
        $classificacao->setPrazoGuardaFaseIntermediariaEvento(null);
        $classificacao->setPrazoGuardaFaseCorrenteDia(30);
        $classificacao->setPrazoGuardaFaseCorrenteMes(null);
        $classificacao->setPrazoGuardaFaseCorrenteAno(null);
        $classificacao->setPrazoGuardaFaseCorrenteEvento(null);
        $classificacao->setModalidadeDestinacao($this->getReference('ModalidadeDestinacao-ELIMINAÇÃO'));
        $this->addReference('Classificacao380', $classificacao);
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao2');
        $classificacao->setParent($this->getReference('Classificacao1'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao3');
        $classificacao->setParent($this->getReference('Classificacao1'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao4');
        $classificacao->setParent($this->getReference('Classificacao1'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao5');
        $classificacao->setParent($this->getReference('Classificacao1'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao6');
        $classificacao->setParent($this->getReference('Classificacao1'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao7');
        $classificacao->setParent($this->getReference('Classificacao6'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao8');
        $classificacao->setParent($this->getReference('Classificacao6'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao9');
        $classificacao->setParent($this->getReference('Classificacao6'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao10');
        $classificacao->setParent($this->getReference('Classificacao6'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao11');
        $classificacao->setParent($this->getReference('Classificacao10'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao12');
        $classificacao->setParent($this->getReference('Classificacao6'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao13');
        $classificacao->setParent($this->getReference('Classificacao12'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao14');
        $classificacao->setParent($this->getReference('Classificacao12'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao15');
        $classificacao->setParent($this->getReference('Classificacao12'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao16');
        $classificacao->setParent($this->getReference('Classificacao12'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao17');
        $classificacao->setParent($this->getReference('Classificacao12'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao18');
        $classificacao->setParent($this->getReference('Classificacao6'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao19');
        $classificacao->setParent($this->getReference('Classificacao18'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao20');
        $classificacao->setParent($this->getReference('Classificacao1'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao21');
        $classificacao->setParent($this->getReference('Classificacao20'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao22');
        $classificacao->setParent($this->getReference('Classificacao20'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao23');
        $classificacao->setParent($this->getReference('Classificacao20'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao24');
        $classificacao->setParent($this->getReference('Classificacao20'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao25');
        $classificacao->setParent($this->getReference('Classificacao20'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao26');
        $classificacao->setParent($this->getReference('Classificacao20'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao27');
        $classificacao->setParent($this->getReference('Classificacao20'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao28');
        $classificacao->setParent($this->getReference('Classificacao20'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao29');
        $classificacao->setParent($this->getReference('Classificacao28'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao30');
        $classificacao->setParent($this->getReference('Classificacao28'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao31');
        $classificacao->setParent($this->getReference('Classificacao28'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao32');
        $classificacao->setParent($this->getReference('Classificacao20'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao33');
        $classificacao->setParent($this->getReference('Classificacao32'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao34');
        $classificacao->setParent($this->getReference('Classificacao32'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao35');
        $classificacao->setParent($this->getReference('Classificacao32'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao36');
        $classificacao->setParent($this->getReference('Classificacao32'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao37');
        $classificacao->setParent($this->getReference('Classificacao32'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao38');
        $classificacao->setParent($this->getReference('Classificacao32'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao39');
        $classificacao->setParent($this->getReference('Classificacao32'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao40');
        $classificacao->setParent($this->getReference('Classificacao32'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao41');
        $classificacao->setParent($this->getReference('Classificacao32'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao42');
        $classificacao->setParent($this->getReference('Classificacao32'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao43');
        $classificacao->setParent($this->getReference('Classificacao32'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao44');
        $classificacao->setParent($this->getReference('Classificacao32'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao45');
        $classificacao->setParent($this->getReference('Classificacao20'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao46');
        $classificacao->setParent($this->getReference('Classificacao45'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao47');
        $classificacao->setParent($this->getReference('Classificacao45'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao48');
        $classificacao->setParent($this->getReference('Classificacao45'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao49');
        $classificacao->setParent($this->getReference('Classificacao45'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao50');
        $classificacao->setParent($this->getReference('Classificacao45'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao51');
        $classificacao->setParent($this->getReference('Classificacao45'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao52');
        $classificacao->setParent($this->getReference('Classificacao45'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao53');
        $classificacao->setParent($this->getReference('Classificacao45'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao54');
        $classificacao->setParent($this->getReference('Classificacao45'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao55');
        $classificacao->setParent($this->getReference('Classificacao20'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao56');
        $classificacao->setParent($this->getReference('Classificacao55'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao57');
        $classificacao->setParent($this->getReference('Classificacao55'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao58');
        $classificacao->setParent($this->getReference('Classificacao55'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao59');
        $classificacao->setParent($this->getReference('Classificacao55'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao60');
        $classificacao->setParent($this->getReference('Classificacao55'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao61');
        $classificacao->setParent($this->getReference('Classificacao55'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao62');
        $classificacao->setParent($this->getReference('Classificacao55'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao63');
        $classificacao->setParent($this->getReference('Classificacao55'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao64');
        $classificacao->setParent($this->getReference('Classificacao55'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao65');
        $classificacao->setParent($this->getReference('Classificacao55'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao66');
        $classificacao->setParent($this->getReference('Classificacao55'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao67');
        $classificacao->setParent($this->getReference('Classificacao55'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao68');
        $classificacao->setParent($this->getReference('Classificacao55'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao69');
        $classificacao->setParent($this->getReference('Classificacao55'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao70');
        $classificacao->setParent($this->getReference('Classificacao55'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao71');
        $classificacao->setParent($this->getReference('Classificacao55'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao72');
        $classificacao->setParent($this->getReference('Classificacao55'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao73');
        $classificacao->setParent($this->getReference('Classificacao55'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao74');
        $classificacao->setParent($this->getReference('Classificacao55'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao75');
        $classificacao->setParent($this->getReference('Classificacao55'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao76');
        $classificacao->setParent($this->getReference('Classificacao55'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao77');
        $classificacao->setParent($this->getReference('Classificacao55'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao78');
        $classificacao->setParent($this->getReference('Classificacao55'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao79');
        $classificacao->setParent($this->getReference('Classificacao55'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao80');
        $classificacao->setParent($this->getReference('Classificacao55'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao81');
        $classificacao->setParent($this->getReference('Classificacao55'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao82');
        $classificacao->setParent($this->getReference('Classificacao55'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao83');
        $classificacao->setParent($this->getReference('Classificacao55'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao84');
        $classificacao->setParent($this->getReference('Classificacao55'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao85');
        $classificacao->setParent($this->getReference('Classificacao55'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao86');
        $classificacao->setParent($this->getReference('Classificacao55'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao87');
        $classificacao->setParent($this->getReference('Classificacao55'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao88');
        $classificacao->setParent($this->getReference('Classificacao55'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao89');
        $classificacao->setParent($this->getReference('Classificacao55'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao90');
        $classificacao->setParent($this->getReference('Classificacao55'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao91');
        $classificacao->setParent($this->getReference('Classificacao55'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao92');
        $classificacao->setParent($this->getReference('Classificacao55'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao93');
        $classificacao->setParent($this->getReference('Classificacao55'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao94');
        $classificacao->setParent($this->getReference('Classificacao55'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao95');
        $classificacao->setParent($this->getReference('Classificacao55'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao96');
        $classificacao->setParent($this->getReference('Classificacao55'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao97');
        $classificacao->setParent($this->getReference('Classificacao55'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao98');
        $classificacao->setParent($this->getReference('Classificacao55'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao99');
        $classificacao->setParent($this->getReference('Classificacao55'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao100');
        $classificacao->setParent($this->getReference('Classificacao55'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao101');
        $classificacao->setParent($this->getReference('Classificacao20'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao102');
        $classificacao->setParent($this->getReference('Classificacao101'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao103');
        $classificacao->setParent($this->getReference('Classificacao101'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao104');
        $classificacao->setParent($this->getReference('Classificacao101'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao105');
        $classificacao->setParent($this->getReference('Classificacao20'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao106');
        $classificacao->setParent($this->getReference('Classificacao105'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao107');
        $classificacao->setParent($this->getReference('Classificacao105'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao108');
        $classificacao->setParent($this->getReference('Classificacao105'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao109');
        $classificacao->setParent($this->getReference('Classificacao105'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao110');
        $classificacao->setParent($this->getReference('Classificacao105'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao111');
        $classificacao->setParent($this->getReference('Classificacao105'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao112');
        $classificacao->setParent($this->getReference('Classificacao105'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao113');
        $classificacao->setParent($this->getReference('Classificacao105'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao114');
        $classificacao->setParent($this->getReference('Classificacao105'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao115');
        $classificacao->setParent($this->getReference('Classificacao105'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao116');
        $classificacao->setParent($this->getReference('Classificacao105'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao117');
        $classificacao->setParent($this->getReference('Classificacao105'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao118');
        $classificacao->setParent($this->getReference('Classificacao105'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao119');
        $classificacao->setParent($this->getReference('Classificacao105'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao120');
        $classificacao->setParent($this->getReference('Classificacao105'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao121');
        $classificacao->setParent($this->getReference('Classificacao105'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao122');
        $classificacao->setParent($this->getReference('Classificacao105'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao123');
        $classificacao->setParent($this->getReference('Classificacao105'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao124');
        $classificacao->setParent($this->getReference('Classificacao105'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao125');
        $classificacao->setParent($this->getReference('Classificacao105'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao126');
        $classificacao->setParent($this->getReference('Classificacao105'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao127');
        $classificacao->setParent($this->getReference('Classificacao105'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao128');
        $classificacao->setParent($this->getReference('Classificacao20'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao129');
        $classificacao->setParent($this->getReference('Classificacao128'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao130');
        $classificacao->setParent($this->getReference('Classificacao128'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao131');
        $classificacao->setParent($this->getReference('Classificacao128'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao132');
        $classificacao->setParent($this->getReference('Classificacao128'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao133');
        $classificacao->setParent($this->getReference('Classificacao128'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao134');
        $classificacao->setParent($this->getReference('Classificacao128'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao135');
        $classificacao->setParent($this->getReference('Classificacao128'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao136');
        $classificacao->setParent($this->getReference('Classificacao128'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao137');
        $classificacao->setParent($this->getReference('Classificacao128'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao138');
        $classificacao->setParent($this->getReference('Classificacao128'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao139');
        $classificacao->setParent($this->getReference('Classificacao128'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao140');
        $classificacao->setParent($this->getReference('Classificacao128'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao141');
        $classificacao->setParent($this->getReference('Classificacao128'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao142');
        $classificacao->setParent($this->getReference('Classificacao1'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao143');
        $classificacao->setParent($this->getReference('Classificacao142'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao144');
        $classificacao->setParent($this->getReference('Classificacao142'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao145');
        $classificacao->setParent($this->getReference('Classificacao142'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao146');
        $classificacao->setParent($this->getReference('Classificacao142'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao147');
        $classificacao->setParent($this->getReference('Classificacao146'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao148');
        $classificacao->setParent($this->getReference('Classificacao146'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao149');
        $classificacao->setParent($this->getReference('Classificacao146'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao150');
        $classificacao->setParent($this->getReference('Classificacao146'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao151');
        $classificacao->setParent($this->getReference('Classificacao146'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao152');
        $classificacao->setParent($this->getReference('Classificacao146'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao153');
        $classificacao->setParent($this->getReference('Classificacao146'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao154');
        $classificacao->setParent($this->getReference('Classificacao146'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao155');
        $classificacao->setParent($this->getReference('Classificacao146'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao156');
        $classificacao->setParent($this->getReference('Classificacao142'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao157');
        $classificacao->setParent($this->getReference('Classificacao156'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao158');
        $classificacao->setParent($this->getReference('Classificacao156'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao159');
        $classificacao->setParent($this->getReference('Classificacao156'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao160');
        $classificacao->setParent($this->getReference('Classificacao156'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao161');
        $classificacao->setParent($this->getReference('Classificacao156'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao162');
        $classificacao->setParent($this->getReference('Classificacao156'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao163');
        $classificacao->setParent($this->getReference('Classificacao142'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao164');
        $classificacao->setParent($this->getReference('Classificacao163'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao165');
        $classificacao->setParent($this->getReference('Classificacao163'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao166');
        $classificacao->setParent($this->getReference('Classificacao142'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao167');
        $classificacao->setParent($this->getReference('Classificacao166'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao168');
        $classificacao->setParent($this->getReference('Classificacao166'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao169');
        $classificacao->setParent($this->getReference('Classificacao142'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao170');
        $classificacao->setParent($this->getReference('Classificacao169'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao171');
        $classificacao->setParent($this->getReference('Classificacao169'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao172');
        $classificacao->setParent($this->getReference('Classificacao142'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao173');
        $classificacao->setParent($this->getReference('Classificacao1'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao174');
        $classificacao->setParent($this->getReference('Classificacao173'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao175');
        $classificacao->setParent($this->getReference('Classificacao174'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao176');
        $classificacao->setParent($this->getReference('Classificacao174'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao177');
        $classificacao->setParent($this->getReference('Classificacao174'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao178');
        $classificacao->setParent($this->getReference('Classificacao174'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao179');
        $classificacao->setParent($this->getReference('Classificacao174'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao180');
        $classificacao->setParent($this->getReference('Classificacao174'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao181');
        $classificacao->setParent($this->getReference('Classificacao174'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao182');
        $classificacao->setParent($this->getReference('Classificacao174'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao183');
        $classificacao->setParent($this->getReference('Classificacao174'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao184');
        $classificacao->setParent($this->getReference('Classificacao174'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao185');
        $classificacao->setParent($this->getReference('Classificacao174'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao186');
        $classificacao->setParent($this->getReference('Classificacao174'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao187');
        $classificacao->setParent($this->getReference('Classificacao174'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao188');
        $classificacao->setParent($this->getReference('Classificacao174'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao189');
        $classificacao->setParent($this->getReference('Classificacao174'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao190');
        $classificacao->setParent($this->getReference('Classificacao174'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao191');
        $classificacao->setParent($this->getReference('Classificacao174'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao192');
        $classificacao->setParent($this->getReference('Classificacao174'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao193');
        $classificacao->setParent($this->getReference('Classificacao174'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao194');
        $classificacao->setParent($this->getReference('Classificacao174'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao195');
        $classificacao->setParent($this->getReference('Classificacao174'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao196');
        $classificacao->setParent($this->getReference('Classificacao174'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao197');
        $classificacao->setParent($this->getReference('Classificacao174'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao198');
        $classificacao->setParent($this->getReference('Classificacao174'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao199');
        $classificacao->setParent($this->getReference('Classificacao174'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao200');
        $classificacao->setParent($this->getReference('Classificacao174'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao201');
        $classificacao->setParent($this->getReference('Classificacao174'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao202');
        $classificacao->setParent($this->getReference('Classificacao174'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao203');
        $classificacao->setParent($this->getReference('Classificacao173'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao204');
        $classificacao->setParent($this->getReference('Classificacao203'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao205');
        $classificacao->setParent($this->getReference('Classificacao203'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao206');
        $classificacao->setParent($this->getReference('Classificacao203'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao207');
        $classificacao->setParent($this->getReference('Classificacao203'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao208');
        $classificacao->setParent($this->getReference('Classificacao203'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao209');
        $classificacao->setParent($this->getReference('Classificacao203'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao210');
        $classificacao->setParent($this->getReference('Classificacao203'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao211');
        $classificacao->setParent($this->getReference('Classificacao203'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao212');
        $classificacao->setParent($this->getReference('Classificacao203'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao213');
        $classificacao->setParent($this->getReference('Classificacao203'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao214');
        $classificacao->setParent($this->getReference('Classificacao203'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao215');
        $classificacao->setParent($this->getReference('Classificacao203'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao216');
        $classificacao->setParent($this->getReference('Classificacao203'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao217');
        $classificacao->setParent($this->getReference('Classificacao203'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao218');
        $classificacao->setParent($this->getReference('Classificacao203'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao219');
        $classificacao->setParent($this->getReference('Classificacao173'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao220');
        $classificacao->setParent($this->getReference('Classificacao173'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao221');
        $classificacao->setParent($this->getReference('Classificacao173'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao222');
        $classificacao->setParent($this->getReference('Classificacao221'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao223');
        $classificacao->setParent($this->getReference('Classificacao221'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao224');
        $classificacao->setParent($this->getReference('Classificacao221'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao225');
        $classificacao->setParent($this->getReference('Classificacao221'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao226');
        $classificacao->setParent($this->getReference('Classificacao221'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao227');
        $classificacao->setParent($this->getReference('Classificacao221'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao228');
        $classificacao->setParent($this->getReference('Classificacao221'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao229');
        $classificacao->setParent($this->getReference('Classificacao221'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao230');
        $classificacao->setParent($this->getReference('Classificacao221'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao231');
        $classificacao->setParent($this->getReference('Classificacao221'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao232');
        $classificacao->setParent($this->getReference('Classificacao221'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao233');
        $classificacao->setParent($this->getReference('Classificacao221'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao234');
        $classificacao->setParent($this->getReference('Classificacao1'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao235');
        $classificacao->setParent($this->getReference('Classificacao234'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao236');
        $classificacao->setParent($this->getReference('Classificacao234'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao237');
        $classificacao->setParent($this->getReference('Classificacao236'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao238');
        $classificacao->setParent($this->getReference('Classificacao236'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao239');
        $classificacao->setParent($this->getReference('Classificacao236'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao240');
        $classificacao->setParent($this->getReference('Classificacao236'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao241');
        $classificacao->setParent($this->getReference('Classificacao236'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao242');
        $classificacao->setParent($this->getReference('Classificacao236'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao243');
        $classificacao->setParent($this->getReference('Classificacao236'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao244');
        $classificacao->setParent($this->getReference('Classificacao236'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao245');
        $classificacao->setParent($this->getReference('Classificacao236'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao246');
        $classificacao->setParent($this->getReference('Classificacao234'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao247');
        $classificacao->setParent($this->getReference('Classificacao246'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao248');
        $classificacao->setParent($this->getReference('Classificacao246'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao249');
        $classificacao->setParent($this->getReference('Classificacao246'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao250');
        $classificacao->setParent($this->getReference('Classificacao234'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao251');
        $classificacao->setParent($this->getReference('Classificacao234'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao252');
        $classificacao->setParent($this->getReference('Classificacao234'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao253');
        $classificacao->setParent($this->getReference('Classificacao252'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao254');
        $classificacao->setParent($this->getReference('Classificacao252'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao255');
        $classificacao->setParent($this->getReference('Classificacao252'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao256');
        $classificacao->setParent($this->getReference('Classificacao234'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao257');
        $classificacao->setParent($this->getReference('Classificacao234'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao258');
        $classificacao->setParent($this->getReference('Classificacao234'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao259');
        $classificacao->setParent($this->getReference('Classificacao258'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao260');
        $classificacao->setParent($this->getReference('Classificacao1'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao261');
        $classificacao->setParent($this->getReference('Classificacao260'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao262');
        $classificacao->setParent($this->getReference('Classificacao260'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao263');
        $classificacao->setParent($this->getReference('Classificacao260'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao264');
        $classificacao->setParent($this->getReference('Classificacao260'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao265');
        $classificacao->setParent($this->getReference('Classificacao264'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao266');
        $classificacao->setParent($this->getReference('Classificacao264'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao267');
        $classificacao->setParent($this->getReference('Classificacao260'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao268');
        $classificacao->setParent($this->getReference('Classificacao267'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao269');
        $classificacao->setParent($this->getReference('Classificacao267'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao270');
        $classificacao->setParent($this->getReference('Classificacao267'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao271');
        $classificacao->setParent($this->getReference('Classificacao267'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao272');
        $classificacao->setParent($this->getReference('Classificacao267'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao273');
        $classificacao->setParent($this->getReference('Classificacao267'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao274');
        $classificacao->setParent($this->getReference('Classificacao267'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao275');
        $classificacao->setParent($this->getReference('Classificacao267'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao276');
        $classificacao->setParent($this->getReference('Classificacao267'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao277');
        $classificacao->setParent($this->getReference('Classificacao260'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao278');
        $classificacao->setParent($this->getReference('Classificacao277'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao279');
        $classificacao->setParent($this->getReference('Classificacao277'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao280');
        $classificacao->setParent($this->getReference('Classificacao277'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao281');
        $classificacao->setParent($this->getReference('Classificacao277'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao282');
        $classificacao->setParent($this->getReference('Classificacao277'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao283');
        $classificacao->setParent($this->getReference('Classificacao277'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao284');
        $classificacao->setParent($this->getReference('Classificacao277'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao285');
        $classificacao->setParent($this->getReference('Classificacao277'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao286');
        $classificacao->setParent($this->getReference('Classificacao277'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao287');
        $classificacao->setParent($this->getReference('Classificacao277'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao288');
        $classificacao->setParent($this->getReference('Classificacao277'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao289');
        $classificacao->setParent($this->getReference('Classificacao277'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao290');
        $classificacao->setParent($this->getReference('Classificacao277'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao291');
        $classificacao->setParent($this->getReference('Classificacao277'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao292');
        $classificacao->setParent($this->getReference('Classificacao260'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao293');
        $classificacao->setParent($this->getReference('Classificacao260'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao294');
        $classificacao->setParent($this->getReference('Classificacao260'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao295');
        $classificacao->setParent($this->getReference('Classificacao294'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao296');
        $classificacao->setParent($this->getReference('Classificacao294'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao297');
        $classificacao->setParent($this->getReference('Classificacao294'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao298');
        $classificacao->setParent($this->getReference('Classificacao294'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao299');
        $classificacao->setParent($this->getReference('Classificacao298'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao300');
        $classificacao->setParent($this->getReference('Classificacao298'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao301');
        $classificacao->setParent($this->getReference('Classificacao298'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao302');
        $classificacao->setParent($this->getReference('Classificacao298'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao303');
        $classificacao->setParent($this->getReference('Classificacao298'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao304');
        $classificacao->setParent($this->getReference('Classificacao260'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao305');
        $classificacao->setParent($this->getReference('Classificacao1'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao306');
        $classificacao->setParent($this->getReference('Classificacao305'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao307');
        $classificacao->setParent($this->getReference('Classificacao306'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao308');
        $classificacao->setParent($this->getReference('Classificacao306'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao309');
        $classificacao->setParent($this->getReference('Classificacao306'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao310');
        $classificacao->setParent($this->getReference('Classificacao306'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao311');
        $classificacao->setParent($this->getReference('Classificacao306'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao312');
        $classificacao->setParent($this->getReference('Classificacao306'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao313');
        $classificacao->setParent($this->getReference('Classificacao305'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao314');
        $classificacao->setParent($this->getReference('Classificacao313'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao315');
        $classificacao->setParent($this->getReference('Classificacao305'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao316');
        $classificacao->setParent($this->getReference('Classificacao315'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao317');
        $classificacao->setParent($this->getReference('Classificacao305'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao318');
        $classificacao->setParent($this->getReference('Classificacao317'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao319');
        $classificacao->setParent($this->getReference('Classificacao317'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao320');
        $classificacao->setParent($this->getReference('Classificacao317'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao321');
        $classificacao->setParent($this->getReference('Classificacao305'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao322');
        $classificacao->setParent($this->getReference('Classificacao305'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao323');
        $classificacao->setParent($this->getReference('Classificacao1'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao324');
        $classificacao->setParent($this->getReference('Classificacao323'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao326');
        $classificacao->setParent($this->getReference('Classificacao325'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao327');
        $classificacao->setParent($this->getReference('Classificacao326'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao328');
        $classificacao->setParent($this->getReference('Classificacao325'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao329');
        $classificacao->setParent($this->getReference('Classificacao328'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao330');
        $classificacao->setParent($this->getReference('Classificacao325'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao331');
        $classificacao->setParent($this->getReference('Classificacao330'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao332');
        $classificacao->setParent($this->getReference('Classificacao330'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao333');
        $classificacao->setParent($this->getReference('Classificacao330'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao334');
        $classificacao->setParent($this->getReference('Classificacao325'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao335');
        $classificacao->setParent($this->getReference('Classificacao325'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao336');
        $classificacao->setParent($this->getReference('Classificacao335'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao337');
        $classificacao->setParent($this->getReference('Classificacao335'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao338');
        $classificacao->setParent($this->getReference('Classificacao335'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao339');
        $classificacao->setParent($this->getReference('Classificacao335'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao340');
        $classificacao->setParent($this->getReference('Classificacao335'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao341');
        $classificacao->setParent($this->getReference('Classificacao335'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao343');
        $classificacao->setParent($this->getReference('Classificacao342'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao344');
        $classificacao->setParent($this->getReference('Classificacao342'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao345');
        $classificacao->setParent($this->getReference('Classificacao342'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao346');
        $classificacao->setParent($this->getReference('Classificacao342'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao347');
        $classificacao->setParent($this->getReference('Classificacao346'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao348');
        $classificacao->setParent($this->getReference('Classificacao347'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao349');
        $classificacao->setParent($this->getReference('Classificacao347'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao350');
        $classificacao->setParent($this->getReference('Classificacao347'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao351');
        $classificacao->setParent($this->getReference('Classificacao346'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao352');
        $classificacao->setParent($this->getReference('Classificacao342'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao353');
        $classificacao->setParent($this->getReference('Classificacao342'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao355');
        $classificacao->setParent($this->getReference('Classificacao354'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao356');
        $classificacao->setParent($this->getReference('Classificacao354'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao357');
        $classificacao->setParent($this->getReference('Classificacao354'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao358');
        $classificacao->setParent($this->getReference('Classificacao354'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao359');
        $classificacao->setParent($this->getReference('Classificacao354'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao360');
        $classificacao->setParent($this->getReference('Classificacao359'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao361');
        $classificacao->setParent($this->getReference('Classificacao360'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao362');
        $classificacao->setParent($this->getReference('Classificacao360'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao363');
        $classificacao->setParent($this->getReference('Classificacao359'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao364');
        $classificacao->setParent($this->getReference('Classificacao359'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao366');
        $classificacao->setParent($this->getReference('Classificacao365'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao367');
        $classificacao->setParent($this->getReference('Classificacao365'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao368');
        $classificacao->setParent($this->getReference('Classificacao365'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao369');
        $classificacao->setParent($this->getReference('Classificacao365'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao370');
        $classificacao->setParent($this->getReference('Classificacao365'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao371');
        $classificacao->setParent($this->getReference('Classificacao365'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao372');
        $classificacao->setParent($this->getReference('Classificacao365'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao373');
        $classificacao->setParent($this->getReference('Classificacao365'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao375');
        $classificacao->setParent($this->getReference('Classificacao374'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao376');
        $classificacao->setParent($this->getReference('Classificacao374'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao377');
        $classificacao->setParent($this->getReference('Classificacao374'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao378');
        $classificacao->setParent($this->getReference('Classificacao377'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao379');
        $classificacao->setParent($this->getReference('Classificacao377'));
        $this->manager->persist($classificacao);

        $classificacao = $this->getReference('Classificacao380');
        $classificacao->setParent($this->getReference('Classificacao374'));
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
        return ['prod', 'dev', 'test'];
    }
}
