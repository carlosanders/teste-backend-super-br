<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Prod/LoadTipoDocumentoData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Prod;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\TipoDocumento;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadTipoDocumentoData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadTipoDocumentoData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $tipoDocumento = new TipoDocumento();
        $tipoDocumento->setEspecieDocumento($this->getReference('EspecieDocumento-ADMINISTRATIVO'));
        $tipoDocumento->setSigla('ALVAR');
        $tipoDocumento->setNome('ALVARÁ');
        $tipoDocumento->setDescricao('ALVARÁ');
        $this->manager->persist($tipoDocumento);
        $this->addReference('TipoDocumento-'.$tipoDocumento->getNome(), $tipoDocumento);

        $tipoDocumento = new TipoDocumento();
        $tipoDocumento->setEspecieDocumento($this->getReference('EspecieDocumento-ADMINISTRATIVO'));
        $tipoDocumento->setSigla('APOST');
        $tipoDocumento->setNome('APOSTILA');
        $tipoDocumento->setDescricao('APOSTILA');
        $this->manager->persist($tipoDocumento);
        $this->addReference('TipoDocumento-'.$tipoDocumento->getNome(), $tipoDocumento);

        $tipoDocumento = new TipoDocumento();
        $tipoDocumento->setEspecieDocumento($this->getReference('EspecieDocumento-ADMINISTRATIVO'));
        $tipoDocumento->setSigla('ATA');
        $tipoDocumento->setNome('ATA');
        $tipoDocumento->setDescricao('ATA');
        $this->manager->persist($tipoDocumento);
        $this->addReference('TipoDocumento-'.$tipoDocumento->getNome(), $tipoDocumento);

        $tipoDocumento = new TipoDocumento();
        $tipoDocumento->setEspecieDocumento($this->getReference('EspecieDocumento-ADMINISTRATIVO'));
        $tipoDocumento->setSigla('ATEST');
        $tipoDocumento->setNome('ATESTADO');
        $tipoDocumento->setDescricao('ATESTADO');
        $this->manager->persist($tipoDocumento);
        $this->addReference('TipoDocumento-'.$tipoDocumento->getNome(), $tipoDocumento);

        $tipoDocumento = new TipoDocumento();
        $tipoDocumento->setEspecieDocumento($this->getReference('EspecieDocumento-ADMINISTRATIVO'));
        $tipoDocumento->setSigla('AUTO');
        $tipoDocumento->setNome('AUTO');
        $tipoDocumento->setDescricao('AUTO');
        $this->manager->persist($tipoDocumento);
        $this->addReference('TipoDocumento-'.$tipoDocumento->getNome(), $tipoDocumento);

        $tipoDocumento = new TipoDocumento();
        $tipoDocumento->setEspecieDocumento($this->getReference('EspecieDocumento-ADMINISTRATIVO'));
        $tipoDocumento->setSigla('AVISO');
        $tipoDocumento->setNome('AVISO');
        $tipoDocumento->setDescricao('AVISO');
        $this->manager->persist($tipoDocumento);
        $this->addReference('TipoDocumento-'.$tipoDocumento->getNome(), $tipoDocumento);

        $tipoDocumento = new TipoDocumento();
        $tipoDocumento->setEspecieDocumento($this->getReference('EspecieDocumento-ADMINISTRATIVO'));
        $tipoDocumento->setSigla('BOLET');
        $tipoDocumento->setNome('BOLETIM');
        $tipoDocumento->setDescricao('BOLETIM');
        $this->manager->persist($tipoDocumento);
        $this->addReference('TipoDocumento-'.$tipoDocumento->getNome(), $tipoDocumento);

        $tipoDocumento = new TipoDocumento();
        $tipoDocumento->setEspecieDocumento($this->getReference('EspecieDocumento-ADMINISTRATIVO'));
        $tipoDocumento->setSigla('CARTA');
        $tipoDocumento->setNome('CARTA');
        $tipoDocumento->setDescricao('CARTA');
        $this->manager->persist($tipoDocumento);
        $this->addReference('TipoDocumento-'.$tipoDocumento->getNome(), $tipoDocumento);

        $tipoDocumento = new TipoDocumento();
        $tipoDocumento->setEspecieDocumento($this->getReference('EspecieDocumento-ADMINISTRATIVO'));
        $tipoDocumento->setSigla('CERTI');
        $tipoDocumento->setNome('CERTIDÃO');
        $tipoDocumento->setDescricao('CERTIDÃO');
        $this->manager->persist($tipoDocumento);
        $this->addReference('TipoDocumento-'.$tipoDocumento->getNome(), $tipoDocumento);

        $tipoDocumento = new TipoDocumento();
        $tipoDocumento->setEspecieDocumento($this->getReference('EspecieDocumento-ADMINISTRATIVO'));
        $tipoDocumento->setSigla('CIRCU');
        $tipoDocumento->setNome('CIRCULAR');
        $tipoDocumento->setDescricao('CIRCULAR');
        $this->manager->persist($tipoDocumento);
        $this->addReference('TipoDocumento-'.$tipoDocumento->getNome(), $tipoDocumento);

        $tipoDocumento = new TipoDocumento();
        $tipoDocumento->setEspecieDocumento($this->getReference('EspecieDocumento-ADMINISTRATIVO'));
        $tipoDocumento->setSigla('CONTR');
        $tipoDocumento->setNome('CONTRATO');
        $tipoDocumento->setDescricao('CONTRATO');
        $this->manager->persist($tipoDocumento);
        $this->addReference('TipoDocumento-'.$tipoDocumento->getNome(), $tipoDocumento);

        $tipoDocumento = new TipoDocumento();
        $tipoDocumento->setEspecieDocumento($this->getReference('EspecieDocumento-ADMINISTRATIVO'));
        $tipoDocumento->setSigla('CONVE');
        $tipoDocumento->setNome('CONVÊNIO');
        $tipoDocumento->setDescricao('CONVÊNIO');
        $this->manager->persist($tipoDocumento);
        $this->addReference('TipoDocumento-'.$tipoDocumento->getNome(), $tipoDocumento);

        $tipoDocumento = new TipoDocumento();
        $tipoDocumento->setEspecieDocumento($this->getReference('EspecieDocumento-ADMINISTRATIVO'));
        $tipoDocumento->setSigla('CONVI');
        $tipoDocumento->setNome('CONVITE');
        $tipoDocumento->setDescricao('CONVITE');
        $this->manager->persist($tipoDocumento);
        $this->addReference('TipoDocumento-'.$tipoDocumento->getNome(), $tipoDocumento);

        $tipoDocumento = new TipoDocumento();
        $tipoDocumento->setEspecieDocumento($this->getReference('EspecieDocumento-ADMINISTRATIVO'));
        $tipoDocumento->setSigla('CONVO');
        $tipoDocumento->setNome('CONVOCAÇÃO');
        $tipoDocumento->setDescricao('CONVOCAÇÃO');
        $this->manager->persist($tipoDocumento);
        $this->addReference('TipoDocumento-'.$tipoDocumento->getNome(), $tipoDocumento);

        $tipoDocumento = new TipoDocumento();
        $tipoDocumento->setEspecieDocumento($this->getReference('EspecieDocumento-ADMINISTRATIVO'));
        $tipoDocumento->setSigla('DECLA');
        $tipoDocumento->setNome('DECLARAÇÃO');
        $tipoDocumento->setDescricao('DECLARAÇÃO');
        $this->manager->persist($tipoDocumento);
        $this->addReference('TipoDocumento-'.$tipoDocumento->getNome(), $tipoDocumento);

        $tipoDocumento = new TipoDocumento();
        $tipoDocumento->setEspecieDocumento($this->getReference('EspecieDocumento-ADMINISTRATIVO'));
        $tipoDocumento->setSigla('DECRE');
        $tipoDocumento->setNome('DECRETO');
        $tipoDocumento->setDescricao('DECRETO');
        $this->manager->persist($tipoDocumento);
        $this->addReference('TipoDocumento-'.$tipoDocumento->getNome(), $tipoDocumento);

        $tipoDocumento = new TipoDocumento();
        $tipoDocumento->setEspecieDocumento($this->getReference('EspecieDocumento-ADMINISTRATIVO'));
        $tipoDocumento->setSigla('DELIB');
        $tipoDocumento->setNome('DELIBERAÇÃO');
        $tipoDocumento->setDescricao('DELIBERAÇÃO');
        $this->manager->persist($tipoDocumento);
        $this->addReference('TipoDocumento-'.$tipoDocumento->getNome(), $tipoDocumento);

        $tipoDocumento = new TipoDocumento();
        $tipoDocumento->setEspecieDocumento($this->getReference('EspecieDocumento-ADMINISTRATIVO'));
        $tipoDocumento->setSigla('DESPA');
        $tipoDocumento->setNome('DESPACHO');
        $tipoDocumento->setDescricao('DESPACHO');
        $this->manager->persist($tipoDocumento);
        $this->addReference('TipoDocumento-'.$tipoDocumento->getNome(), $tipoDocumento);

        $tipoDocumento = new TipoDocumento();
        $tipoDocumento->setEspecieDocumento($this->getReference('EspecieDocumento-ADMINISTRATIVO'));
        $tipoDocumento->setSigla('EDITA');
        $tipoDocumento->setNome('EDITAL');
        $tipoDocumento->setDescricao('EDITAL');
        $this->manager->persist($tipoDocumento);
        $this->addReference('TipoDocumento-'.$tipoDocumento->getNome(), $tipoDocumento);

        $tipoDocumento = new TipoDocumento();
        $tipoDocumento->setEspecieDocumento($this->getReference('EspecieDocumento-ADMINISTRATIVO'));
        $tipoDocumento->setSigla('EMAIL');
        $tipoDocumento->setNome('E-MAIL');
        $tipoDocumento->setDescricao('E-MAIL');
        $this->manager->persist($tipoDocumento);
        $this->addReference('TipoDocumento-'.$tipoDocumento->getNome(), $tipoDocumento);

        $tipoDocumento = new TipoDocumento();
        $tipoDocumento->setEspecieDocumento($this->getReference('EspecieDocumento-ADMINISTRATIVO'));
        $tipoDocumento->setSigla('ESTAT');
        $tipoDocumento->setNome('ESTATUTO');
        $tipoDocumento->setDescricao('ESTATUTO');
        $this->manager->persist($tipoDocumento);
        $this->addReference('TipoDocumento-'.$tipoDocumento->getNome(), $tipoDocumento);

        $tipoDocumento = new TipoDocumento();
        $tipoDocumento->setEspecieDocumento($this->getReference('EspecieDocumento-ADMINISTRATIVO'));
        $tipoDocumento->setSigla('EXPOS');
        $tipoDocumento->setNome('EXPOSIÇÃO DE MOTIVOS');
        $tipoDocumento->setDescricao('EXPOSIÇÃO DE MOTIVOS');
        $this->manager->persist($tipoDocumento);
        $this->addReference('TipoDocumento-'.$tipoDocumento->getNome(), $tipoDocumento);

        $tipoDocumento = new TipoDocumento();
        $tipoDocumento->setEspecieDocumento($this->getReference('EspecieDocumento-ADMINISTRATIVO'));
        $tipoDocumento->setSigla('FAX');
        $tipoDocumento->setNome('FAX');
        $tipoDocumento->setDescricao('FAX');
        $this->manager->persist($tipoDocumento);
        $this->addReference('TipoDocumento-'.$tipoDocumento->getNome(), $tipoDocumento);

        $tipoDocumento = new TipoDocumento();
        $tipoDocumento->setEspecieDocumento($this->getReference('EspecieDocumento-ADMINISTRATIVO'));
        $tipoDocumento->setSigla('GUIA');
        $tipoDocumento->setNome('GUIA');
        $tipoDocumento->setDescricao('GUIA');
        $this->manager->persist($tipoDocumento);
        $this->addReference('TipoDocumento-'.$tipoDocumento->getNome(), $tipoDocumento);

        $tipoDocumento = new TipoDocumento();
        $tipoDocumento->setEspecieDocumento($this->getReference('EspecieDocumento-ADMINISTRATIVO'));
        $tipoDocumento->setSigla('INSTR');
        $tipoDocumento->setNome('INSTRUÇÃO NORMATIVA');
        $tipoDocumento->setDescricao('INSTRUÇÃO NORMATIVA');
        $this->manager->persist($tipoDocumento);
        $this->addReference('TipoDocumento-'.$tipoDocumento->getNome(), $tipoDocumento);

        $tipoDocumento = new TipoDocumento();
        $tipoDocumento->setEspecieDocumento($this->getReference('EspecieDocumento-ADMINISTRATIVO'));
        $tipoDocumento->setSigla('MEMOR');
        $tipoDocumento->setNome('MEMORANDO');
        $tipoDocumento->setDescricao('MEMORANDO');
        $this->manager->persist($tipoDocumento);
        $this->addReference('TipoDocumento-'.$tipoDocumento->getNome(), $tipoDocumento);

        $tipoDocumento = new TipoDocumento();
        $tipoDocumento->setEspecieDocumento($this->getReference('EspecieDocumento-ADMINISTRATIVO'));
        $tipoDocumento->setSigla('MENSAGEM');
        $tipoDocumento->setNome('MENSAGEM');
        $tipoDocumento->setDescricao('MENSAGEM');
        $this->manager->persist($tipoDocumento);
        $this->addReference('TipoDocumento-'.$tipoDocumento->getNome(), $tipoDocumento);

        $tipoDocumento = new TipoDocumento();
        $tipoDocumento->setEspecieDocumento($this->getReference('EspecieDocumento-ADMINISTRATIVO'));
        $tipoDocumento->setSigla('OFICIO');
        $tipoDocumento->setNome('OFÍCIO');
        $tipoDocumento->setDescricao('OFÍCIO');
        $this->manager->persist($tipoDocumento);
        $this->addReference('TipoDocumento-'.$tipoDocumento->getNome(), $tipoDocumento);

        $tipoDocumento = new TipoDocumento();
        $tipoDocumento->setEspecieDocumento($this->getReference('EspecieDocumento-ADMINISTRATIVO'));
        $tipoDocumento->setSigla('ORDEM');
        $tipoDocumento->setNome('ORDEM DE SERVIÇO');
        $tipoDocumento->setDescricao('ORDEM DE SERVIÇO');
        $this->manager->persist($tipoDocumento);
        $this->addReference('TipoDocumento-'.$tipoDocumento->getNome(), $tipoDocumento);

        $tipoDocumento = new TipoDocumento();
        $tipoDocumento->setEspecieDocumento($this->getReference('EspecieDocumento-ADMINISTRATIVO'));
        $tipoDocumento->setSigla('PORTA');
        $tipoDocumento->setNome('PORTARIA');
        $tipoDocumento->setDescricao('PORTARIA');
        $this->manager->persist($tipoDocumento);
        $this->addReference('TipoDocumento-'.$tipoDocumento->getNome(), $tipoDocumento);

        $tipoDocumento = new TipoDocumento();
        $tipoDocumento->setEspecieDocumento($this->getReference('EspecieDocumento-ADMINISTRATIVO'));
        $tipoDocumento->setSigla('RELAT');
        $tipoDocumento->setNome('RELATÓRIO');
        $tipoDocumento->setDescricao('RELATÓRIO');
        $this->manager->persist($tipoDocumento);
        $this->addReference('TipoDocumento-'.$tipoDocumento->getNome(), $tipoDocumento);

        $tipoDocumento = new TipoDocumento();
        $tipoDocumento->setEspecieDocumento($this->getReference('EspecieDocumento-ADMINISTRATIVO'));
        $tipoDocumento->setSigla('REQUE');
        $tipoDocumento->setNome('REQUERIMENTO');
        $tipoDocumento->setDescricao('REQUERIMENTO');
        $this->manager->persist($tipoDocumento);
        $this->addReference('TipoDocumento-'.$tipoDocumento->getNome(), $tipoDocumento);

        $tipoDocumento = new TipoDocumento();
        $tipoDocumento->setEspecieDocumento($this->getReference('EspecieDocumento-ADMINISTRATIVO'));
        $tipoDocumento->setSigla('RESOL');
        $tipoDocumento->setNome('RESOLUÇÃO');
        $tipoDocumento->setDescricao('RESOLUÇÃO');
        $this->manager->persist($tipoDocumento);
        $this->addReference('TipoDocumento-'.$tipoDocumento->getNome(), $tipoDocumento);

        $tipoDocumento = new TipoDocumento();
        $tipoDocumento->setEspecieDocumento($this->getReference('EspecieDocumento-ADMINISTRATIVO'));
        $tipoDocumento->setSigla('ARDIG');
        $tipoDocumento->setNome('AR DIGITAL');
        $tipoDocumento->setDescricao('AR DIGITAL');
        $this->manager->persist($tipoDocumento);
        $this->addReference('TipoDocumento-'.$tipoDocumento->getNome(), $tipoDocumento);

        $tipoDocumento = new TipoDocumento();
        $tipoDocumento->setEspecieDocumento($this->getReference('EspecieDocumento-ADMINISTRATIVO'));
        $tipoDocumento->setSigla('ANEXO');
        $tipoDocumento->setNome('ANEXO');
        $tipoDocumento->setDescricao('ANEXO');
        $this->manager->persist($tipoDocumento);
        $this->addReference('TipoDocumento-'.$tipoDocumento->getNome(), $tipoDocumento);

        $tipoDocumento = new TipoDocumento();
        $tipoDocumento->setEspecieDocumento($this->getReference('EspecieDocumento-ADMINISTRATIVO'));
        $tipoDocumento->setSigla('REPO');
        $tipoDocumento->setNome('REPOSITÓRIO');
        $tipoDocumento->setDescricao('REPOSITÓRIO');
        $this->manager->persist($tipoDocumento);
        $this->addReference('TipoDocumento-'.$tipoDocumento->getNome(), $tipoDocumento);

        $tipoDocumento = new TipoDocumento();
        $tipoDocumento->setEspecieDocumento($this->getReference('EspecieDocumento-ADMINISTRATIVO'));
        $tipoDocumento->setSigla('OUTRO');
        $tipoDocumento->setNome('OUTROS');
        $tipoDocumento->setDescricao('OUTROS');
        $this->manager->persist($tipoDocumento);
        $this->addReference('TipoDocumento-'.$tipoDocumento->getNome(), $tipoDocumento);

        $tipoDocumento = new TipoDocumento();
        $tipoDocumento->setEspecieDocumento($this->getReference('EspecieDocumento-ADMINISTRATIVO'));
        $tipoDocumento->setSigla('RECI');
        $tipoDocumento->setNome('RECIBO');
        $tipoDocumento->setDescricao('RECIBO');
        $this->manager->persist($tipoDocumento);
        $this->addReference('TipoDocumento-'.$tipoDocumento->getNome(), $tipoDocumento);

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
        return ['prod', 'dev', 'test'];
    }
}
