<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Prod/LoadSigiloData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Test;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\Sigilo;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadSigiloData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadSigiloData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $dataInicioSigilo1 = new \DateTime('now');
        $dataValidadeSigilo1 = new \DateTime('now +1 day');
        $sigilo = new Sigilo();
        $sigilo->setObservacao('SIGILO-1');
        $sigilo->setFundamentoLegal('Fundamento Legal 1');
        $sigilo->setNivelAcesso(1);
        $sigilo->setRazoesClassificacaoSigilo(null);
        $sigilo->setTipoSigilo($this->getReference('TipoSigilo-SIGILO LEGAL'));
        $sigilo->setOrigemDados($this->getReference('OrigemDados-FONTE_DADOS_1'));
        $sigilo->setProcesso($this->getReference('Processo-TESTE_1'));
        $sigilo->setDocumento(null);
        $sigilo->setModalidadeCategoriaSigilo(null);
        $sigilo->setCodigoIndexacao(null);
        $sigilo->setDesclassificado(false);
        $sigilo->setDataHoraInicioSigilo($dataInicioSigilo1);
        $sigilo->setDataHoraValidadeSigilo($dataValidadeSigilo1);


        $this->manager->persist($sigilo);

        $this->addReference('Sigilo-'.$sigilo->getObservacao(), $sigilo);

        $dataInicioSigilo2 = new \DateTime('now');
        $dataValidadeSigilo2 = new \DateTime('now +2 day');
        $sigilo = new Sigilo();
        $sigilo->setObservacao('SIGILO-2');
        $sigilo->setFundamentoLegal('Fundamento Legal 1');
        $sigilo->setNivelAcesso(1);
        $sigilo->setRazoesClassificacaoSigilo(null);
        $sigilo->setTipoSigilo($this->getReference('TipoSigilo-SIGILO LEGAL'));
        $sigilo->setOrigemDados($this->getReference('OrigemDados-FONTE_DADOS_1'));
        $sigilo->setProcesso($this->getReference('Processo-TESTE_1'));
        $sigilo->setDocumento(null);
        $sigilo->setModalidadeCategoriaSigilo(null);
        $sigilo->setCodigoIndexacao(null);
        $sigilo->setDesclassificado(false);
        $sigilo->setDataHoraInicioSigilo($dataInicioSigilo2);
        $sigilo->setDataHoraValidadeSigilo($dataValidadeSigilo2);


        $this->manager->persist($sigilo);

        $this->addReference('Sigilo-'.$sigilo->getObservacao(), $sigilo);


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
