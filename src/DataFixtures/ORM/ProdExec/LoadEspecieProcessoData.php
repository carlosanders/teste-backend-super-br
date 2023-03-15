<?php
#PROD
declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/ProdExec/LoadEspecieProcessoData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\ProdExec;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\EspecieProcesso;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadEspecieProcessoData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadEspecieProcessoData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('ACESSO À INFORMAÇÃO: DEMANDA DO E-SIC');
        $especieProcesso->setDescricao('TRATAMENTO DE DEMANDAS E RECURSOS DO E-SIC.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('991'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('ACOMPANHAMENTO LEGISLATIVO: CÂMARA DOS DEPUTADOS');
        $especieProcesso->setDescricao('ACOMPANHAR PROCESSO LEGISLATIVO A FIM DE PROMOVER OS INTERESSES DO ÓRGÃO, INCLUINDO ENCAMINHAMENTO DE PARECERES SOBRE PROJETOS DE LEI, INTERAÇÃO PRESENCIAL COM PARLAMENTARES E PARTICIPAÇÃO EM AUDIÊNCIAS PÚBLICAS.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('013.2'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('ACOMPANHAMENTO LEGISLATIVO: CONGRESSO NACIONAL');
        $especieProcesso->setDescricao('ACOMPANHAR PROCESSO LEGISLATIVO A FIM DE PROMOVER OS INTERESSES DO ÓRGÃO, INCLUINDO ENCAMINHAMENTO DE PARECERES SOBRE PROJETOS DE LEI, INTERAÇÃO PRESENCIAL COM PARLAMENTARES E PARTICIPAÇÃO EM AUDIÊNCIAS PÚBLICAS.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('013.2'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('ACOMPANHAMENTO LEGISLATIVO: ESTADUAL/DISTRITAL');
        $especieProcesso->setDescricao('ACOMPANHAR PROCESSO LEGISLATIVO A FIM DE PROMOVER OS INTERESSES DO ÓRGÃO, INCLUINDO ENCAMINHAMENTO DE PARECERES SOBRE PROJETOS DE LEI, INTERAÇÃO PRESENCIAL COM PARLAMENTARES E PARTICIPAÇÃO EM AUDIÊNCIAS PÚBLICAS.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('013.2'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('ACOMPANHAMENTO LEGISLATIVO: MUNICIPAL');
        $especieProcesso->setDescricao('ACOMPANHAR PROCESSO LEGISLATIVO A FIM DE PROMOVER OS INTERESSES DO ÓRGÃO, INCLUINDO ENCAMINHAMENTO DE PARECERES SOBRE PROJETOS DE LEI, INTERAÇÃO PRESENCIAL COM PARLAMENTARES E PARTICIPAÇÃO EM AUDIÊNCIAS PÚBLICAS.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('013.2'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('ACOMPANHAMENTO LEGISLATIVO: SENADO FEDERAL');
        $especieProcesso->setDescricao('ACOMPANHAR PROCESSO LEGISLATIVO A FIM DE PROMOVER OS INTERESSES DO ÓRGÃO, INCLUINDO ENCAMINHAMENTO DE PARECERES SOBRE PROJETOS DE LEI, INTERAÇÃO PRESENCIAL COM PARLAMENTARES E PARTICIPAÇÃO EM AUDIÊNCIAS PÚBLICAS.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('013.2'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('ARRECADAÇÃO: COBRANÇA');
        $especieProcesso->setDescricao('ARRECADAÇÃO: COBRANÇA');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('052.211'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('ARRECADAÇÃO: CUMPRIMENTO DE AÇÃO JUDICIAL');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('004.21'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('ARRECADAÇÃO: ENCAMINHAMENTO PARA DÍVIDA ATIVA');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('004.21'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('ARRECADAÇÃO: NORMATIZAÇÃO INTERNA');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('050.01'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('ARRECADAÇÃO: NOTIFICAÇÃO/COMUNICADO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('052.211'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('ARRECADAÇÃO: PARCELAMENTO ADMINISTRATIVO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('052.211'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('ARRECADAÇÃO: RECEITA');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('052.211'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('ARRECADAÇÃO: REGULARIZAÇÃO DE INDÉBITOS');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('052.211'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('ARRECADAÇÃO: RESTITUIÇÃO/COMPENSAÇÃO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('052.211'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('ARRECADAÇÃO: SUBSIDIAR AÇÃO JUDICIAL');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('004.22'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('COMUNICAÇÃO: EVENTO INSTITUCIONAL PÚBLICO EXTERNO');
        $especieProcesso->setDescricao('PROCESSO PARA RECEBIMENTO DE PEDIDOS DE APOIO PARA A REALIZAÇÃO DE EVENTOS INSTITUCIONAIS DIRECIONADOS AO PÚBLICO EXTERNO, POR EXEMPLO, AUDIÊNCIAS PÚBLICAS E SESSÕES PÚBLICAS.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('019.113'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('COMUNICAÇÃO: EVENTO INSTITUCIONAL PÚBLICO INTERNO');
        $especieProcesso->setDescricao('PEDIDOS DE APOIO PARA A REALIZAÇÃO DE EVENTOS INSTITUCIONAIS DIRECIONADOS AO PÚBLICO INTERNO, POR EXEMPLO, ANIVERSÁRIO DO ÓRGÃO OU EVENTOS DA SEMANA DO SERVIDOR PÚBLICO.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('019.113'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('COMUNICAÇÃO: PEDIDO DE APOIO INSTITUCIONAL');
        $especieProcesso->setDescricao('PEDIDOS PARA UTILIZAÇÃO DA LOGOMARCA DO ÓRGÃO EM EVENTOS INSTITUCIONAIS PROMOVIDOS POR TERCEIROS, SEJAM PÚBLICOS OU PRIVADOS.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('019.113'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('COMUNICAÇÃO: PUBLICIDADE INSTITUCIONAL');
        $especieProcesso->setDescricao('DEMANDAS PARA A REALIZAÇÃO DE AÇÕES DE COMUNICAÇÃO PARA DISSEMINAR - PARA OS PÚBLICOS INTERNO OU EXTERNO - INFORMAÇÕES SOBRE DETERMINADOS TEMAS DE MAIOR RELEVÂNCIA.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('019.113'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('COMUNICAÇÃO: PUBLICIDADE LEGAL');
        $especieProcesso->setDescricao('DEMANDAS PARA PUBLICAÇÃO EM VEÍCULOS DE COMUNICAÇÃO DE GRANDE CIRCULAÇÃO, PARA FINS DE PUBLICIDADE EXIGIDA POR LEI, POR EXEMPLO, AVISOS DE REALIZAÇÃO DE PREGÕES E DE AUDIÊNCIAS PÚBLICAS.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('069.3'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('CONTABILIDADE: ANÁLISE CONTÁBIL');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('052.23'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('CONTABILIDADE: CONFORMIDADE DE GESTÃO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('050.02'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('CONTABILIDADE: CONTRATOS E GARANTIAS');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('001'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('CONTABILIDADE: DIRF');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.185'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('CONTABILIDADE: ENCERRAMENTO DO EXERCÍCIO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('050.03'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('CONTABILIDADE: FECHAMENTO CONTÁBIL - ESTOQUE');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('052.23'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('CONTABILIDADE: FECHAMENTO CONTÁBIL PATRIMONIAL');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('052.23'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('CONTABILIDADE: MANUAIS');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('066.2'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('CONTABILIDADE: NORMATIZAÇÃO INTERNA');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('050.01'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('CONTABILIDADE: PRESTAÇÃO DE CONTAS');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('054.1'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('CONVÊNIOS/AJUSTES: ACOMPANHAMENTO DA EXECUÇÃO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('001'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('CONVÊNIOS/AJUSTES: FORMALIZAÇÃO/ALTERAÇÃO COM REPASSE');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('001'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('CONVÊNIOS/AJUSTES: FORMALIZAÇÃO/ALTERAÇÃO SEM REPASSE');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('001'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('CORREGEDORIA: ANÁLISE PRESCRICIONAL DE PROCESSO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('027.1'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('CORREGEDORIA: AVALIAÇÃO PARA ESTABILIDADE');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('027.1'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('CORREGEDORIA: CORREIÇÃO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('027.1'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('CORREGEDORIA: INVESTIGAÇÃO PRELIMINAR');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('027.1'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('CORREGEDORIA: PROCEDIMENTO GERAL');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('027.1'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('CORREGEDORIA: PROCESSO ADMINISTRATIVO DISCIPLINAR');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('027.1'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('CORREGEDORIA: SINDICÂNCIA PUNITIVA');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('027.1'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('DEMANDA EXTERNA: CIDADÃO (PESSOA FÍSICA)');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('991'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('DEMANDA EXTERNA: DEPUTADO ESTADUAL/DISTRITAL');
        $especieProcesso->setDescricao('ATENDER SOLICITAÇÕES PARLAMENTARES, COMO PEDIDOS DE INFORMAÇÃO, CONSULTA A PROCESSOS, AGENDA COM PRESIDENTE OU DEMAIS GESTORES DO ÓRGÃO E VISITA TÉCNICA.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('991'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('DEMANDA EXTERNA: DEPUTADO FEDERAL');
        $especieProcesso->setDescricao('ATENDER SOLICITAÇÕES PARLAMENTARES, COMO PEDIDOS DE INFORMAÇÃO, CONSULTA A PROCESSOS, AGENDA COM PRESIDENTE OU DEMAIS GESTORES DO ÓRGÃO E VISITA TÉCNICA.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('991'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('DEMANDA EXTERNA: JUDICIÁRIO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('004.22'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('DEMANDA EXTERNA: MINISTÉRIO PÚBLICO ESTADUAL');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('991'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('DEMANDA EXTERNA: MINISTÉRIO PÚBLICO FEDERAL');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('991'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('DEMANDA EXTERNA: ORGÃOS GOVERNAMENTAIS ESTADUAIS');
        $especieProcesso->setDescricao('ATENDER SOLICITAÇÕES INSTITUCIONAIS DE ÓRGÃOS GOVERNAMENTAIS ESTADUAIS, COMO PEDIDOS DE INFORMAÇÃO, AGENDA COM PRESIDENTE OU DEMAIS GESTORES DO ÓRGÃO, VISITA TÉCNICA, REUNIÕES, ESCLARECIMENTO DE DÚVIDAS OU OUTROS QUESTIONAMENTOS.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('991'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('DEMANDA EXTERNA: ORGÃOS GOVERNAMENTAIS FEDERAIS');
        $especieProcesso->setDescricao('ATENDER SOLICITAÇÕES INSTITUCIONAIS DE ÓRGÃOS GOVERNAMENTAIS FEDERAIS, COMO PEDIDOS DE INFORMAÇÃO, AGENDA COM PRESIDENTE OU DEMAIS GESTORES DO ÓRGÃO, VISITA TÉCNICA, REUNIÕES, ESCLARECIMENTO DE DÚVIDAS OU OUTROS QUESTIONAMENTOS.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('991'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('DEMANDA EXTERNA: ORGÃOS GOVERNAMENTAIS MUNICIPAIS');
        $especieProcesso->setDescricao('ATENDER SOLICITAÇÕES INSTITUCIONAIS DE ÓRGÃOS GOVERNAMENTAIS MUNICIPAIS, COMO PEDIDOS DE INFORMAÇÃO, AGENDA COM PRESIDENTE OU DEMAIS GESTORES DO ÓRGÃO, VISITA TÉCNICA, REUNIÕES, ESCLARECIMENTO DE DÚVIDAS OU OUTROS QUESTIONAMENTOS.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('991'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('DEMANDA EXTERNA: OUTRAS ENTIDADES PRIVADAS');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('991'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('DEMANDA EXTERNA: OUTROS ORGÃOS PÚBLICOS');
        $especieProcesso->setDescricao('ATENDER SOLICITAÇÕES INSTITUCIONAIS DE OUTROS ÓRGÃOS GOVERNAMENTAIS, COMO PEDIDOS DE INFORMAÇÃO, AGENDA COM PRESIDENTE OU DEMAIS GESTORES DO ÓRGÃO, VISITA TÉCNICA, REUNIÕES, ESCLARECIMENTO DE DÚVIDAS OU OUTROS QUESTIONAMENTOS.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('991'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('DEMANDA EXTERNA: SENADOR');
        $especieProcesso->setDescricao('ATENDER SOLICITAÇÕES PARLAMENTARES, COMO PEDIDOS DE INFORMAÇÃO, CONSULTA A PROCESSOS, AGENDA COM PRESIDENTE OU DEMAIS GESTORES DO ÓRGÃO E VISITA TÉCNICA.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('991'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('DEMANDA EXTERNA: VEREADOR/CÂMARA MUNICIPAL');
        $especieProcesso->setDescricao('ATENDER SOLICITAÇÕES PARLAMENTARES, COMO PEDIDOS DE INFORMAÇÃO, CONSULTA A PROCESSOS, AGENDA COM PRESIDENTE OU DEMAIS GESTORES DO ÓRGÃO E VISITA TÉCNICA.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('991'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('ÉTICA: ANÁLISE DE CONFLITO DE INTERESSE');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('027.1'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('ÉTICA: PROCESSO DE APURAÇÃO ÉTICA');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('027.1'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('FINANÇAS: EXECUÇÃO FINANCEIRA');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('052.221'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('FINANÇAS: NORMATIZAÇÃO INTERNA');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('050.01'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('FINANÇAS: REEMBOLSO/RESSARCIMENTO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.73'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('GESTÃO DA INFORMAÇÃO: ARRECADAÇÃO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('052.211'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('GESTÃO DA INFORMAÇÃO: AVALIAÇÃO/DESTINAÇÃO DE DOCUMENTOS');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('061.51'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('GESTÃO DA INFORMAÇÃO: CADASTRO DE USUÁRIO EXTERNO NO SEI');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('060.01'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('GESTÃO DA INFORMAÇÃO: CONTROLE DE MALOTE');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('061.1'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('GESTÃO DA INFORMAÇÃO: CREDENCIAMENTO DE SEGURANÇA');
        $especieProcesso->setDescricao('CREDENCIAMENTO PARA ACESSO A DOCUMENTOS CLASSIFICADOS.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('060.01'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('GESTÃO DA INFORMAÇÃO: GESTÃO DOCUMENTAL');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('060.01'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('GESTÃO DA INFORMAÇÃO: NORMATIZAÇÃO INTERNA');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('060.01'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('GESTÃO DA INFORMAÇÃO: RECEBIMENTO DE PROCESSO EXTERNO');
        $especieProcesso->setDescricao('APLICADO AUTOMATICAMENTE EM PROCESSOS RECEBIDOS PELO SEI FEDERAÇÃO.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('061.2'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('GESTÃO DA INFORMAÇÃO: RECONSTITUIÇÃO DOCUMENTAL');
        $especieProcesso->setDescricao('RECONSTITUIÇÃO DE PROCESSOS OU DOCUMENTOS PERDIDOS OU DANIFICADOS.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('991'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('GESTÃO DA INFORMAÇÃO: ROL ANUAL DE INFORMAÇÕES CLASSIFICADAS');
        $especieProcesso->setDescricao('PROCESSO DE DIVULGAÇÃO ANUAL DO ROL DE INFORMAÇÕES CLASSIFICADAS.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('991'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('GESTÃO DA INFORMAÇÃO: SEGURANÇA DA INFORMAÇÃO E COMUNICAÇÕES');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('066.32'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('GESTÃO DE CONTRATO: ACOMPANHAMENTO DA EXECUÇÃO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('001'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('GESTÃO DE CONTRATO: ACRÉSCIMO CONTRATUAL');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('001'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('GESTÃO DE CONTRATO: ALTERAÇÕES CONTRATUAIS CONJUNTAS');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('001'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('GESTÃO DE CONTRATO: APLICAÇÃO DE SANÇÃO CONTRATUAL');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('018'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('GESTÃO DE CONTRATO: CONSULTA À PROCURADORIA/CONJUR');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('001'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('GESTÃO DE CONTRATO: EXECUÇÃO DE GARANTIA');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('018'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('GESTÃO DE CONTRATO: OUTRAS ALTERAÇÕES CONTRATUAIS NÃO RELACIONADAS');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('001'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('GESTÃO DE CONTRATO: PAGAMENTO DIRETO A TERCEIROS');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('018'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('GESTÃO DE CONTRATO: PROCESSO DE PAGAMENTO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('018'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('GESTÃO DE CONTRATO: PRORROGAÇÃO CONTRATUAL');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('001'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('GESTÃO DE CONTRATO: REAJUSTE OU REPACTUAÇÃO CONTRATUAL');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('001'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('GESTÃO DE CONTRATO: RESCISÃO CONTRATUAL');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('001'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('GESTÃO DE CONTRATO: REVISÃO CONTRATUAL');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('001'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('GESTÃO DE CONTRATO: SUPRESSÃO CONTRATUAL');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('001'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('GESTÃO DE PROCESSOS: MAPEAMENTO E MODELAGEM');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('016.4'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('GESTÃO DE PROJETOS: PLANEJAMENTO E EXECUÇÃO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('015.1'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('GESTÃO DE TI: CITI');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('066.2'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('GESTÃO E CONTROLE: COORDENAÇÃO - DEMANDAS EXTERNAS');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('003.1'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('GESTÃO E CONTROLE: COORDENAÇÃO - DEMANDAS INTERNAS');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('003.1'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('GESTÃO E CONTROLE: DEMANDAS DE ÓRGÃOS DE CONTROLE');
        $especieProcesso->setDescricao('ADMINISTRAR DEMANDAS E ACOMPANHAR AS DELIBERAÇÕES DOS ÓRGÃOS DE CONTROLE DO GOVERNO FEDERAL.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('003.1'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('GESTÃO E CONTROLE: EXECUTAR AUDITORIA INTERNA');
        $especieProcesso->setDescricao('ANALISAR A FIDEDIGNIDADE DAS INFORMAÇÕES QUE TRAMITAM NOS PROCESSOS DO ÓRGÃO, IDENTIFICAR NECESSIDADE DE PONTOS DE CONTROLE DE NÃO CONFORMIDADES, SUAS CAUSAS, QUALIFICAR E QUANTIFICAR AS PERDAS E RECOMENDAR AÇÕES CORRETIVAS E PREVENTIVAS.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('003.1'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('INFRAESTRUTURA: ABASTECIMENTO DE ÁGUA E ESGOTO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('045.11'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('INFRAESTRUTURA: APOIO DE ENGENHARIA CIVIL');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('043.1'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('INFRAESTRUTURA: FORNECIMENTO DE ENERGIA ELÉTRICA');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('045.13'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('LICITAÇÃO: ADESÃO A ATA DE RP-NÃO PARTICIPANTE');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('034'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('LICITAÇÃO: ADESÃO A ATA DE RP-PARTICIPANTE');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('034'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('LICITAÇÃO: APLICAÇÃO DE SANÇÃO DECORRENTE DE PROCEDIMENTO LICITATÓRIO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('018'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('LICITAÇÃO: CONCORRÊNCIA');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('034'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('LICITAÇÃO: CONCORRÊNCIA-REGISTRO DE PREÇO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('034'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('LICITAÇÃO: CONCURSO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('034'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('LICITAÇÃO: CONSULTA');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('034'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('LICITAÇÃO: CONVITE');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('034'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('LICITAÇÃO: DISPENSA - ACIMA DE R$ 8 MIL');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('034'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('LICITAÇÃO: DISPENSA - ATÉ R$ 8 MIL');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('034'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('LICITAÇÃO: INEXIGIBILIDADE');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('034'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('LICITAÇÃO: LEILÃO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('034'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('LICITAÇÃO: PLANO DE AQUISIÇÕES');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('015.1'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('LICITAÇÃO: PREGÃO ELETRÔNICO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('034'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('LICITAÇÃO: PREGÃO ELETRÔNICO-REGISTRO DE PREÇO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('034'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('LICITAÇÃO: PREGÃO PRESENCIAL');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('034'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('LICITAÇÃO: REGIME DIFERENCIADO DE CONTRATAÇÃO-RDC');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('034'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('LICITAÇÃO: TOMADA DE PREÇOS');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('034'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('MATERIAL: DESFAZIMENTO DE MATERIAL DE CONSUMO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('033.42'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('MATERIAL: DESFAZIMENTO DE MATERIAL PERMANENTE');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('033.41'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('MATERIAL: INVENTÁRIO DE MATERIAL DE CONSUMO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('036.2'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('MATERIAL: INVENTÁRIO DE MATERIAL PERMANENTE');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('036.1'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('MATERIAL: MOVIMENTAÇÃO DE MATERIAL DE CONSUMO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('032.1'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('MATERIAL: MOVIMENTAÇÃO DE MATERIAL PERMANENTE');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('032.01'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('ORÇAMENTO: ACOMPANHAMENTO DE DESPESA MENSAL');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('051.3'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('ORÇAMENTO: CONTINGENCIAMENTO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('051.3'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('ORÇAMENTO: CRÉDITOS ADICIONAIS');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('051.4'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('ORÇAMENTO: DESCENTRALIZAÇÃO DE CRÉDITOS');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('051.3'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('ORÇAMENTO: MANUAIS');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('066.2'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('ORÇAMENTO: PROGRAMAÇÃO ORÇAMENTÁRIA');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('051.1'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('OUVIDORIA: AGRADECIMENTO AO ÓRGÃO');
        $especieProcesso->setDescricao('TIPO DE PROCESSO UTILIZADO PELO FORMULÁRIO DE PETICIONAMENTO DA OUVIDORIA. - EXCLUSIVO DA OUVIDORIA');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('991'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('OUVIDORIA: CRÍTICA À ATUAÇÃO DO ÓRGÃO');
        $especieProcesso->setDescricao('TIPO DE PROCESSO UTILIZADO PELO FORMULÁRIO DE PETICIONAMENTO DA OUVIDORIA. - EXCLUSIVO DA OUVIDORIA');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('991'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('OUVIDORIA: DENÚNCIA CONTRA A ATUAÇÃO DO ÓRGÃO');
        $especieProcesso->setDescricao('TIPO DE PROCESSO UTILIZADO PELO FORMULÁRIO DE PETICIONAMENTO DA OUVIDORIA. - EXCLUSIVO DA OUVIDORIA');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('991'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('OUVIDORIA: ELOGIO À ATUAÇÃO DO ÓRGÃO');
        $especieProcesso->setDescricao('TIPO DE PROCESSO UTILIZADO PELO FORMULÁRIO DE PETICIONAMENTO DA OUVIDORIA. - EXCLUSIVO DA OUVIDORIA');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('991'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('OUVIDORIA: PEDIDO DE INFORMAÇÃO');
        $especieProcesso->setDescricao('TIPO DE PROCESSO UTILIZADO PELO FORMULÁRIO DE PETICIONAMENTO DA OUVIDORIA. - EXCLUSIVO DA OUVIDORIA');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('991'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('OUVIDORIA: RECLAMAÇÃO À ATUAÇÃO DO ÓRGÃO');
        $especieProcesso->setDescricao('TIPO DE PROCESSO UTILIZADO PELO FORMULÁRIO DE PETICIONAMENTO DA OUVIDORIA. - EXCLUSIVO DA OUVIDORIA');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('991'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PATRIMÔNIO: COBRANÇA DE ACERVO BIBLIOGRÁFICO - REGISTRO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('062.21'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PATRIMÔNIO: COBRANÇA DE ACERVO BIBLIOGRÁFICO - CATALOGAÇÃO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('062.22'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PATRIMÔNIO: COBRANÇA DE ACERVO BIBLIOGRÁFICO - INVENTÁRIO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('062.3'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PATRIMÔNIO: COBRANÇA DE ACERVO BIBLIOGRÁFICO - EMPRÉSTIMOS');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('063.2'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PATRIMÔNIO: GESTÃO DE ACERVO BIBLIOGRÁFICO - REGISTRO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('062.21'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PATRIMÔNIO: GESTÃO DE ACERVO BIBLIOGRÁFICO - CATALOGAÇÃO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('062.22'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PATRIMÔNIO: GESTÃO DE ACERVO BIBLIOGRÁFICO - INVENTÁRIO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('062.3'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PATRIMÔNIO: GESTÃO DE ACERVO BIBLIOGRÁFICO - EMPRÉSTIMOS');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('063.2'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PATRIMÔNIO: GESTÃO DE BENS IMÓVEIS');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('043.1'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: ABONO PERMANÊNCIA - CONCESSÃO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.14'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: ABONO PERMANÊNCIA - REVISÃO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.14'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: ADICIONAL DE FÉRIAS (1/3 CONSTITUCIONAL)');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.167'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: ADICIONAL DE INSALUBRIDADE');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.164'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: ADICIONAL DE PERICULOSIDADE');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.163'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: ADICIONAL NOTURNO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.162'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: ADICIONAL POR ATIVIDADE PENOSA');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.165'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: ADICIONAL POR SERVIÇO EXTRAORDINÁRIO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.166'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: ADICIONAL POR TEMPO DE SERVIÇO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.161'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: AFASTAMENTO PARA ATIVIDADE DESPORTIVA');
        $especieProcesso->setDescricao('ART. 102, INCISO X, DA LEI Nº 8.112/1990.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.4'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: AFASTAMENTO PARA CURSO DE FORMAÇÃO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.4'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: AFASTAMENTO PARA DEPOR');
        $especieProcesso->setDescricao('ART. 102, INCISO VI, DA LEI Nº 8.112/1990.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.4'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: AFASTAMENTO PARA EXERCER MANDATO ELETIVO');
        $especieProcesso->setDescricao('ART. 94 LEI Nº 8.112/1990.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.4'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: AFASTAMENTO PARA PÓS-GRADUAÇÃO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.4'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: AFASTAMENTO PARA SERVIÇO ELEITORAL (TRE)');
        $especieProcesso->setDescricao('ART. 102, INCISO VI, DA LEI Nº 8.112/1990.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.4'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: AFASTAMENTO PARA SERVIR COMO JURADO');
        $especieProcesso->setDescricao('ART. 102, INCISO VI, DA LEI Nº 8.112/1990.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.4'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: AFASTAMENTO PARA SERVIR EM ORGANISMO INTERNACIONAL');
        $especieProcesso->setDescricao('ART. 102, INCISO XI, DA LEI Nº 8.112/1990.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.4'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: AJUDA DE CUSTO COM MUDANÇA DE DOMICÍLIO');
        $especieProcesso->setDescricao('ART. 53 DA LEI Nº 8.112/1990.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.71'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: APOSENTADORIA - CONCESSÃO - INVALIDEZ');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('026.51'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: APOSENTADORIA - CONCESSÃO - COMPULSÓRIA');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('026.52'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: APOSENTADORIA - CONCESSÃO - VOLUNTÁRIA');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('026.53'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: APOSENTADORIA - CONCESSÃO - ESPECIAL');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('026.54'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: APOSENTADORIA - CONTAGEM TEMPO DE SERVIÇO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('026.02'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: APOSENTADORIA - PENSÃO TEMPORÁRIA');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('026.61'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: APOSENTADORIA - PENSÃO VITALÍCIA');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('026.62'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: APOSENTADORIA - REVISÃO - INVALIDEZ');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('026.51'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: APOSENTADORIA - REVISÃO - COMPULSÓRIA');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('026.52'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: APOSENTADORIA - REVISÃO - VOLUNTÁRIA');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('026.53'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: APOSENTADORIA - REVISÃO - ESPECIAL');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('026.54'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: APRESENTAÇÃO DE CERTIFICADO DE CURSO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('024.2'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: ASSENTAMENTO FUNCIONAL DO SERVIDOR');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('020.11'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: AUSÊNCIA EM RAZÃO DE CASAMENTO');
        $especieProcesso->setDescricao('ART. 97, INCISO III, DA LEI Nº 8.112/1990.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.5'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: AUSÊNCIA PARA ALISTAMENTO ELEITORAL');
        $especieProcesso->setDescricao('ART. 97, INCISO II, DA LEI Nº 8.112/1990.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.5'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: AUSÊNCIA PARA DOAÇÃO DE SANGUE');
        $especieProcesso->setDescricao('ART. 97, INCISO I, DA LEI Nº 8.112/1990.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.5'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: AUSÊNCIA POR FALECIMENTO DE FAMILIAR');
        $especieProcesso->setDescricao('ART. 97, INCISO III, DA LEI Nº 8.112/1990.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.5'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: AUXÍLIO ACIDENTE');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.6'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: AUXÍLIO ALIMENTAÇÃO/REFEIÇÃO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.6'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: AUXÍLIO ASSISTÊNCIA PRÉ-ESCOLAR/CRECHE');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.6'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: AUXÍLIO DOENÇA');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.6'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: AUXÍLIO FUNERAL');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.6'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: AUXÍLIO MORADIA');
        $especieProcesso->setDescricao('ART. 60-A DA LEI Nº 8.112/1990.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.6'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: AUXÍLIO NATALIDADE');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.6'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: AUXÍLIO RECLUSÃO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('026.91'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: AUXÍLIO-TRANSPORTE');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.6'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: AVALIAÇÃO DE DESEMPENHO INDIVIDUAL');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.155'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: AVALIAÇÃO DE DESEMPENHO INSTITUCIONAL');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('015.32'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: AVALIAÇÃO DE ESTÁGIO PROBATÓRIO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.12'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: AVERBAÇÃO DE TEMPO DE SERVIÇO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('026.02'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: BOLSA DE ESTUDO DE IDIOMA ESTRANGEIRO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('024.2'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: BOLSA DE PÓS-GRADUAÇÃO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('024.2'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: CADASTRO DE DEPENDENTE NO IMPOSTO DE RENDA');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.173'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: CESSÃO DE SERVIDOR PARA OUTRO ÓRGÃO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('022.22'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: CIPA');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('025.311'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: COLETA DE IMAGEM DE ASSINATURA');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('020.2'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: CONCURSO PÚBLICO - EXAMES ADMISSIONAIS');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('021.1'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: CONCURSO PÚBLICO - ORGANIZAÇÃO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('021.1'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: CONCURSO PÚBLICO - PROVAS E TÍTULOS');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('021.1'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: CONTROLE DE FREQUÊNCIA/ABONO DE FALTA');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('029.11'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: CONTROLE DE FREQUÊNCIA/CUMPRIR HORA EXTRA');
        $especieProcesso->setDescricao('CUMPRIMENTO DE HORAS EXTRAS');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('029.11'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: CONTROLE DE FREQUÊNCIA/FOLHA DE PONTO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('029.11'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: CURSO DE PÓS-GRADUAÇÃO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('024.2'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: CURSO NO EXTERIOR - COM ÔNUS');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('024.2'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: CURSO NO EXTERIOR - ÔNUS LIMITADO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('024.2'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: CURSO NO EXTERIOR - SEM ÔNUS');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('024.2'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: CURSO PROMOVIDO PELA PRÓPRIA INSTITUIÇÃO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('024.11'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: CURSO PROMOVIDO POR OUTRA INSTITUIÇÃO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('024.2'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: DELEGAÇÃO DE COMPETÊNCIA');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('029.4'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: DESCONTO DA CONTRIBUIÇÃO PARA O INSS');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.172'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: DESCONTO DE CONTRIBUIÇÃO ASSOCIATIVA');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.171'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: DESCONTO DE CONTRIBUIÇÃO SINDICAL');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.171'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: DESCONTO DE EMPRÉSTIMO CONSIGNADO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.175'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: DESCONTO DE PENSÃO ALIMENTÍCIA');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.174'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: DESCONTO DO IRPF RETIDO NA FONTE');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.173'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: EMISSÃO DE CERTIDÕES E DECLARAÇÕES');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('020.11'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: EMISSÃO DE PROCURAÇÃO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('029.4'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: ENCARGO PATRONAL - CONTRIBUIÇÃO PARA INSS');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.184'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: ESTÁGIO - DOSSIÊ DO ESTAGIÁRIO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('024.52'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: ESTÁGIO - PLANEJAMENTO/ORGANIZAÇÃO GERAL');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('024.31'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: ESTÁGIO DE SERVIDOR NO BRASIL');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('024.4'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: ESTÁGIO DE SERVIDOR NO EXTERIOR');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('024.4'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: EXONERAÇÃO DE CARGO EFETIVO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('022.7'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: FALECIMENTO DE SERVIDOR');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('022.7'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: FÉRIAS - ALTERAÇÃO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.2'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: FÉRIAS - INTERRUPÇÃO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.2'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: FÉRIAS - SOLICITAÇÃO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.2'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: FICHA FINANCEIRA');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.11'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: FOLHA DE PAGAMENTO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.11'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: GRATIFICAÇÃO DE DESEMPENHO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.155'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: GRATIFICAÇÃO NATALINA (DÉCIMO TERCEIRO)');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.154'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: GRATIFICAÇÃO POR ENCARGO - CURSO/CONCURSO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.156'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: HORÁRIO DE EXPEDIENTE - DEFINIÇÃO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('029.12'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: HORÁRIO DE EXPEDIENTE - ESCALA DE PLANTÃO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('029.12'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: HORÁRIO ESPECIAL - FAMILIAR DEFICIENTE');
        $especieProcesso->setDescricao('ART. 98, § 3º, DA LEI Nº 8.112/1990.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.5'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: HORÁRIO ESPECIAL - INSTRUTOR DE CURSO');
        $especieProcesso->setDescricao('ART. 98, § 4º, DA LEI Nº 8.112/1990.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.5'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: HORÁRIO ESPECIAL - SERVIDOR DEFICIENTE');
        $especieProcesso->setDescricao('ART. 98, § 2º, DA LEI Nº 8.112/1990.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.5'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: HORÁRIO ESPECIAL - SERVIDOR ESTUDANTE');
        $especieProcesso->setDescricao('ART. 98, § 1º, DA LEI Nº 8.112/1990.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.5'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: INDENIZAÇÃO DE TRANSPORTE (MEIO PRÓPRIO)');
        $especieProcesso->setDescricao('ART. 60 DA LEI Nº 8.112/1990.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.72'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: LICENÇA ADOTANTE');
        $especieProcesso->setDescricao('ART. 102, INCISO VIII, DA LEI Nº 8.112/1990.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('026.4'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: LICENÇA GESTANTE');
        $especieProcesso->setDescricao('ART. 102, INCISO VIII, DA LEI Nº 8.112/1990.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('026.4'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: LICENÇA PARA ATIVIDADE POLÍTICA');
        $especieProcesso->setDescricao('ART. 81, INCISO IV, LEI Nº 8.112/1990.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.3'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: LICENÇA PARA CAPACITAÇÃO');
        $especieProcesso->setDescricao('ART. 81, INCISO V, LEI Nº 8.112/1990.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.3'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: LICENÇA PARA MANDATO CLASSISTA');
        $especieProcesso->setDescricao('ART. 81, INCISO VII, LEI Nº 8.112/1990.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.3'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: LICENÇA PARA SERVIÇO MILITAR');
        $especieProcesso->setDescricao('ART. 81, INCISO III, DA LEI Nº 8.112/1990.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.3'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: LICENÇA PARA TRATAMENTO DA PRÓPRIA SAÚDE');
        $especieProcesso->setDescricao('ART. 102, INCISO VIII, DA LEI Nº 8.112/1990.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('026.4'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: LICENÇA PARA TRATAR DE INTERESSES PARTICULARES');
        $especieProcesso->setDescricao('ART. 81, INCISO VI, LEI Nº 8.112/1990.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.3'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: LICENÇA PATERNIDADE');
        $especieProcesso->setDescricao('ART. 102, INCISO VIII, DA LEI Nº 8.112/1990.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('026.4'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: LICENÇA POR ACIDENTE EM SERVIÇO');
        $especieProcesso->setDescricao('ART. 102, INCISO VIII, DA LEI Nº 8.112/1990.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('026.4'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: LICENÇA POR AFASTAMENTO DO CÔNJUGE');
        $especieProcesso->setDescricao('ART. 84 DA LEI Nº 8.112/1990.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.3'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: LICENÇA POR DOENÇA EM PESSOA DA FAMÍLIA');
        $especieProcesso->setDescricao('ART. 83 DA LEI Nº 8.112/1990.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.3'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: LICENÇA POR DOENÇA PROFISSIONAL');
        $especieProcesso->setDescricao('ART. 102, INCISO VIII, DA LEI Nº 8.112/1990.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('026.4'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: LICENÇA PRÊMIO POR ASSIDUIDADE');
        $especieProcesso->setDescricao('REDAÇÃO ANTERIOR DO ART. 81, INCISO V, LEI Nº 8.112/1990. EM RAZÃO DE POSSÍVEL DIREITO ADQUIRIDO, MUITOS SERVIDORES AINDA USUFRUEM ESTE TIPO DE LICENÇA.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.3'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: LICENÇAS POR ABORTO/NATIMORTO');
        $especieProcesso->setDescricao('ART. 102, INCISO VIII, C/C ART. 207, § 3º E § 4º, DA LEI Nº 8.112/1990.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.3'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: MOVIMENTAÇÃO DE SERVIDOR');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('022.21'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: MOVIMENTO REIVINDICATÓRIO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('020.032'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: NEGOCIAÇÃO SINDICAL E ACORDO COLETIVO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('020.031'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: NOMEAÇÃO/EXONERAÇÃO DE CARGO COMISSIONADO E DESIGNAÇÃO/DISPENSA DE SUBSTITUTO - PROVIMENTO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('022.1'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: NOMEAÇÃO/EXONERAÇÃO DE CARGO COMISSIONADO E DESIGNAÇÃO/DISPENSA DE SUBSTITUTO - SUBSTITUIÇÃO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('022.5'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: NORMATIZAÇÃO INTERNA');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('050.01'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: OCUPAÇÃO DE IMÓVEL FUNCIONAL');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.92'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: ORIENTAÇÕES E DIRETRIZES GERAIS');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('010.01'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: PAGAMENTO DE PROVENTO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.11'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: PAGAMENTO DE REMUNERAÇÃO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.11'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: PENALIDADE ADVERTÊNCIA');
        $especieProcesso->setDescricao('APLICAÇÃO DE PENALIDADE. O REGISTRO DAS PENALIDADES DISCIPLINARES DEVERÁ SER FEITO NA PASTA DE ASSENTAMENTO INDIVIDUAL DO SERVIDOR.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('027.2'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: PENALIDADE CASSAÇÃO DE APOSENTADORIA');
        $especieProcesso->setDescricao('APLICAÇÃO DE PENALIDADE. O REGISTRO DAS PENALIDADES DISCIPLINARES DEVERÁ SER FEITO NA PASTA DE ASSENTAMENTO INDIVIDUAL DO SERVIDOR.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('027.2'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: PENALIDADE DEMISSÃO DE CARGO EFETIVO');
        $especieProcesso->setDescricao('APLICAÇÃO DE PENALIDADE. O REGISTRO DAS PENALIDADES DISCIPLINARES DEVERÁ SER FEITO NA PASTA DE ASSENTAMENTO INDIVIDUAL DO SERVIDOR.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('027.2'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: PENALIDADE DESTITUIÇÃO CARGO EM COMISSÃO');
        $especieProcesso->setDescricao('APLICAÇÃO DE PENALIDADE. O REGISTRO DAS PENALIDADES DISCIPLINARES DEVERÁ SER FEITO NA PASTA DE ASSENTAMENTO INDIVIDUAL DO SERVIDOR.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('027.2'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: PENALIDADE DISPONIBILIDADE');
        $especieProcesso->setDescricao('APLICAÇÃO DE PENALIDADE. O REGISTRO DAS PENALIDADES DISCIPLINARES DEVERÁ SER FEITO NA PASTA DE ASSENTAMENTO INDIVIDUAL DO SERVIDOR.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('027.2'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: PENALIDADE SUSPENSÃO');
        $especieProcesso->setDescricao('APLICAÇÃO DE PENALIDADE. O REGISTRO DAS PENALIDADES DISCIPLINARES DEVERÁ SER FEITO NA PASTA DE ASSENTAMENTO INDIVIDUAL DO SERVIDOR.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('027.2'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: PENSÃO POR MORTE DE SERVIDOR');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('026.61'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: PLANEJAMENTO DA FORÇA DE TRABALHO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('020.021'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: PLANO DE CAPACITAÇÃO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('024.4'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: PRÊMIOS DE RECONHECIMENTO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('029.3'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: PREVENÇÃO DE ACIDENTES NO TRABALHO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('025.32'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: PROGRESSÃO E PROMOÇÃO (QUADRO EFETIVO)');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('022.63'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: PROGRESSÃO E PROMOÇÃO (QUADRO ESPECÍFICO)');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('022.63'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: PROVIMENTO - NOMEAÇÃO PARA CARGO EFETIVO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('022.1'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: PROVIMENTO - NOMEAÇÃO PARA CARGO EM COMISSÃO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('022.1'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: PROVIMENTO - POR APROVEITAMENTO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('022.1'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: PROVIMENTO - POR READAPTAÇÃO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('022.1'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: PROVIMENTO - POR RECONDUÇÃO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('022.1'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: PROVIMENTO - POR REINTEGRAÇÃO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('022.1'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: PROVIMENTO - POR REVERSÃO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('022.1'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: RELAÇÃO COM CONSELHO PROFISSIONAL');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('020.033'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: REMOÇÃO A PEDIDO - CONCURSO INTERNO');
        $especieProcesso->setDescricao('ART. 36, PARÁGRAFO ÚNICO, INCISO III, ALÍNEA "C", DA LEI Nº 8.112/1990.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('022.21'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: REMOÇÃO A PEDIDO COM MUDANÇA DE SEDE');
        $especieProcesso->setDescricao('ART. 36, PARÁGRAFO ÚNICO, INCISO II, DA LEI Nº 8.112/1990.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('022.21'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: REMOÇÃO A PEDIDO PARA ACOMPANHAR CÔNJUGE');
        $especieProcesso->setDescricao('ART. 36, PARÁGRAFO ÚNICO, INCISO III, ALÍNEA "A", DA LEI Nº 8.112/1990.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('022.21'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: REMOÇÃO A PEDIDO POR MOTIVO DE SAÚDE');
        $especieProcesso->setDescricao('ART. 36, PARÁGRAFO ÚNICO, INCISO III, ALÍNEA "B", DA LEI Nº 8.112/1990.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('022.21'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: REMOÇÃO A PEDIDO SEM MUDANÇA DE SEDE');
        $especieProcesso->setDescricao('ART. 36, PARÁGRAFO ÚNICO, INCISO II, DA LEI Nº 8.112/1990.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('022.21'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: REMOÇÃO DE OFÍCIO COM MUDANÇA DE SEDE');
        $especieProcesso->setDescricao('ART. 36, PARÁGRAFO ÚNICO, INCISO I, DA LEI Nº 8.112/1990.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('022.21'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: REMOÇÃO DE OFÍCIO SEM MUDANÇA DE SEDE');
        $especieProcesso->setDescricao('ART. 36, PARÁGRAFO ÚNICO, INCISO I, DA LEI Nº 8.112/1990.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('022.21'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: REQUISIÇÃO DE SERVIDOR EXTERNO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('022.22'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: REQUISIÇÃO DE SERVIDOR INTERNO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('022.22'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: RESSARCIMENTO AO ERÁRIO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.11'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: RESTRUTURAÇÃO DE CARGOS E FUNÇÕES');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('020.022'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: RETRIBUIÇÃO POR CARGO EM COMISSÃO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.153'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: SALÁRIO-FAMÍLIA');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('026.1'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: SAÚDE - ATESTADO DE COMPARECIMENTO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('025.14'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: SAÚDE - AUXÍLIO-SAÚDE GEAP');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.6'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: SAÚDE - CADASTRO DE DEPENDENTE ESTUDANTE NO AUXÍLIO-SAÚDE');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.6'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: SAÚDE - EXCLUSÃO DE AUXÍLIO-SAÚDE');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.6'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: SAÚDE - INSPEÇÃO PERIÓDICA');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('025.14'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: SAÚDE - LANÇAMENTO MENSAL DO AUXÍLIO-SAÚDE NO SIAPE');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.6'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: SAÚDE - PAGAMENTO DE AUXÍLIO-SAÚDE');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.6'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: SAÚDE - PAGAMENTO DE RETROATIVO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.6'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: SAÚDE - PLANO DE SAÚDE');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('025.11'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: SAÚDE - PRONTUÁRIO MÉDICO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('025.14'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: SAÚDE - RESSARCIMENTO AO ERÁRIO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('059.4'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: SAÚDE - SOLICITAÇÃO DE AUXÍLIO-SAÚDE');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('023.6'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: SAÚDE E QUALIDADE DE VIDA NO TRABALHO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('025.14'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: SUBSIDIAR AÇÃO JUDICIAL');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('004.22'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PESSOAL: VACÂNCIA - POSSE EM CARGO INACUMULÁVEL');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('022.7'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PLANEJAMENTO ESTRATÉGICO: ACOMPANHAMENTO DO PLANO OPERACIONAL');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('015.1'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PLANEJAMENTO ESTRATÉGICO: ELABORAÇÃO DO PLANO ESTRATÉGICO');
        $especieProcesso->setDescricao('ELABORAÇÃO DAS PROPOSTAS DO PLANO ESTRATÉGICO DO ÓRGÃO.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('015.1'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PLANEJAMENTO ESTRATÉGICO: ELABORAÇÃO DO PLANO OPERACIONAL');
        $especieProcesso->setDescricao('CONSOLIDAÇÃO DO PLANO OPERACIONAL DO ÓRGÃO.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('015.1'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PLANEJAMENTO ESTRATÉGICO: GESTÃO DE RISCO');
        $especieProcesso->setDescricao('GESTÃO DOS RISCOS E CONTROLE DE RISCOS COM VISTA AO ALCANCE DOS OBJETIVOS ESTRATÉGICOS.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('015.1'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PLANEJAMENTO ESTRATÉGICO: GESTÃO DO PLANO ESTRATÉGICO');
        $especieProcesso->setDescricao('GESTÃO DO PLANO ESTRATÉGICO DO ÓRGÃO.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('015.1'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('PLANEJAMENTO ESTRATÉGICO: INTELIGÊNCIA ESTRATÉGICA');
        $especieProcesso->setDescricao('MONITORAMENTO DOS OBJETIVOS ESTRATÉGICOS, CENÁRIOS PROSPECTIVOS E ESTRATÉGIAS DOS ATORES QUE IMPACTAM NO ALCANCE DO OBJETIVOS ESTRATÉGICOS.');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('015.1'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('RELAÇÕES INTERNACIONAIS: COMPOSIÇÃO DE DELEGAÇÃO - COM ÔNUS');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('028.21'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('RELAÇÕES INTERNACIONAIS: COMPOSIÇÃO DE DELEGAÇÃO - ÔNUS LIMITADO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('028.22'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('RELAÇÕES INTERNACIONAIS: COMPOSIÇÃO DE DELEGAÇÃO - SEM ÔNUS');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('028.23'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('RELAÇÕES INTERNACIONAIS: COOPERAÇÃO INTERNACIONAL');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('001'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('SEGURANÇA INSTITUCIONAL: AUTOMAÇÃO E CONTROLE PREDIAL');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('046.2'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('SEGURANÇA INSTITUCIONAL: CONTROLE DE ACESSO/GARAGEM');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('046.4'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('SEGURANÇA INSTITUCIONAL: CONTROLE DE ACESSO/PORTARIA');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('046.4'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('SEGURANÇA INSTITUCIONAL: PREVENÇÃO CONTRA INCÊNDIO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('046.13'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('SEGURANÇA INSTITUCIONAL: PROJETO CONTRA INCÊNDIO');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('046.12'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('SEGURANÇA INSTITUCIONAL: SERVIÇO DE VIGILÂNCIA');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('045.4'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('SUPRIMENTO DE FUNDOS: CONCESSÃO E PRESTAÇÃO DE CONTAS');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('052.221'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('SUPRIMENTO DE FUNDOS: SOLICITAÇÃO DE DESPESA');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('052.221'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('VIAGEM: EXTERIOR - PRESTAÇÃO DE CONTAS');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('028.21'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('VIAGEM: NO PAÍS - PRESTAÇÃO DE CONTAS');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('028.11'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('VIAGEM: PUBLICAÇÃO DE BOLETIM');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('028.11'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);
        
        
        $especieProcesso = new EspecieProcesso();
        $especieProcesso->setNome('VIAGEM: PUBLICAÇÃO DE BOLETIM - AFASTAMENTO DO PAÍS');
        $especieProcesso->setDescricao('-');
        $especieProcesso->setGeneroProcesso($this->getReference('GeneroProcesso-ADMINISTRATIVO'));
        $especieProcesso->setModalidadeMeio($this->getReference('ModalidadeMeio-ELETRÔNICO'));
        
        $especieProcesso->setClassificacao($this->getReference('028.21'));
        $this->manager->persist($especieProcesso);
        
        $this->addReference('EspecieProcesso-'.$especieProcesso->getNome(),$especieProcesso);        
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
