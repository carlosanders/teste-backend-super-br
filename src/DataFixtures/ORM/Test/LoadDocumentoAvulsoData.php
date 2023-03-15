<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Test/LoadDocumentoAvulsoData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Test;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use SuppCore\AdministrativoBackend\Entity\DocumentoAvulso;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadDocumentoAvulsoData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $documentoAvulso = new DocumentoAvulso();

        $documentoAvulso->setDataHoraConclusaoPrazo(null);
        $documentoAvulso->setDataHoraInicioPrazo(date_create('now'));
        $documentoAvulso->setDataHoraEncerramento(null);
        $documentoAvulso->setDataHoraFinalPrazo(date_create('2022-06-15 17:00:00'));
        $documentoAvulso->setDataHoraLeitura(null);
        $documentoAvulso->setDataHoraReiteracao(null);
        $documentoAvulso->setDataHoraRemessa(null);
        $documentoAvulso->setDataHoraResposta(null);
        $documentoAvulso->setMecanismoRemessa(null);
        $documentoAvulso->setObservacao(null);
        $documentoAvulso->setPostIt('TESTE_1');
        $documentoAvulso->setUrgente(false);

        $documentoAvulso->setDocumentoAvulsoOrigem(null);
        $documentoAvulso->setDocumentoResposta(null);
        $documentoAvulso->setProcessoDestino(null);
        $documentoAvulso->setPessoaDestino(null);
        $documentoAvulso->setSetorDestino(null);
        $documentoAvulso->setTarefaOrigem(null);
        $documentoAvulso->setUsuarioRemessa(null);
        $documentoAvulso->setUsuarioResposta(null);

        $documentoAvulso->setDocumentoRemessa($this->getReference('Documento-MODELO DESPACHO DE APROVAÇÃO'));
        $documentoAvulso->setEspecieDocumentoAvulso($this->getReference('EspecieDocumentoAvulso-SOLICITAÇÃO'));
        $documentoAvulso->setModelo($this->getReference('Modelo-DESPACHO EM BRANCO'));
        $documentoAvulso->setProcesso($this->getReference('Processo-TESTE_1'));
        $documentoAvulso->setSetorOrigem($this->getReference('Unidade-ADVOCACIA-GERAL DA UNIÃO'));
        $documentoAvulso->setSetorResponsavel($this->getReference('Unidade-ADVOCACIA-GERAL DA UNIÃO'));
        $documentoAvulso->setUsuarioResponsavel($this->getReference('Usuario-00000000004'));
        $documentoAvulso->setCriadoPor($this->getReference('Usuario-00000000004'));

        // Persist entity
        $this->manager->persist($documentoAvulso);

        // Create reference for later usage
        $this->addReference('DocumentoAvulso-'.$documentoAvulso->getPostIt(), $documentoAvulso);

        // Flush database changes
        $this->manager->flush();
    }
    /**
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
