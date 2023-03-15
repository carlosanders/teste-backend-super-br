<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Test/LoadDocumentoIdentificadorData.php
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Test;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\DocumentoIdentificador;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadDocumentoIdentificadorData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadDocumentoIdentificadorData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $documentoIdentificador = new DocumentoIdentificador();
        $documentoIdentificador->setNome('DOC-ID-ADMINISTRATIVO-1');
        $documentoIdentificador->setCodigoDocumento('DOC-ID-ADM1');
        $documentoIdentificador->setDataEmissao(null);
        $documentoIdentificador->setEmissorDocumento('SECRETARIA 1');
        $documentoIdentificador->setModalidadeDocumentoIdentificador(
            $this->getReference('ModalidadeDocumentoIdentificador-CARTEIRA DE IDENTIDADE'));
        $documentoIdentificador->setOrigemDados(null);
        $documentoIdentificador->setPessoa($this->getReference('Pessoa-12312312355'));

        $this->manager->persist($documentoIdentificador);

        $this->addReference(
            'DocumentoIdentificador-'.$documentoIdentificador->getNome(),
            $documentoIdentificador
        );


        $documentoIdentificador = new DocumentoIdentificador();
        $documentoIdentificador->setNome('DOC-ID-ADMINISTRATIVO-2');
        $documentoIdentificador->setCodigoDocumento('DOC-ID-ADM2');
        $documentoIdentificador->setDataEmissao(null);
        $documentoIdentificador->setEmissorDocumento('SECRETARIA 2');
        $documentoIdentificador->setModalidadeDocumentoIdentificador(
            $this->getReference('ModalidadeDocumentoIdentificador-CARTEIRA NACIONAL DE HABILITAÇÃO'));
        $documentoIdentificador->setOrigemDados(null);
        $documentoIdentificador->setPessoa($this->getReference('Pessoa-12312312355'));

        $this->manager->persist($documentoIdentificador);

        $this->addReference(
            'DocumentoIdentificador-'.$documentoIdentificador->getNome(),
            $documentoIdentificador
        );

        $documentoIdentificador = new DocumentoIdentificador();
        $documentoIdentificador->setNome('DOC-ID-JURÍDICO-1');
        $documentoIdentificador->setCodigoDocumento('DOC-ID-JUR1');
        $documentoIdentificador->setDataEmissao(null);
        $documentoIdentificador->setEmissorDocumento('JURÍDICO 1');
        $documentoIdentificador->setModalidadeDocumentoIdentificador(
            $this->getReference('ModalidadeDocumentoIdentificador-TÍTULO DE ELEITOR'));
        $documentoIdentificador->setOrigemDados(null);
        $documentoIdentificador->setPessoa($this->getReference('Pessoa-12312312355'));

        $this->manager->persist($documentoIdentificador);

        $this->addReference(
            'DocumentoIdentificador-'.$documentoIdentificador->getNome(),
            $documentoIdentificador
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
        return 4;
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
