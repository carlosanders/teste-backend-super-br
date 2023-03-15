<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Prod/LoadModeloData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Prod;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\Modelo;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadModeloData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadModeloData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $modelo = new Modelo();
        $modelo->setNome('DESPACHO EM BRANCO');
        $modelo->setDescricao('DESPACHO EM BRANCO');
        $modelo->setModalidadeModelo($this->getReference('ModalidadeModelo-EM BRANCO'));
        $modelo->setTemplate($this->getReference('Template-DESPACHO'));
        $modelo->setDocumento($this->getReference('Documento-MODELO DESPACHO EM BRANCO'));

        $this->manager->persist($modelo);

        $this->addReference(
            'Modelo-DESPACHO EM BRANCO',
            $modelo
        );

        $modelo = new Modelo();
        $modelo->setNome('OFÍCIO EM BRANCO');
        $modelo->setDescricao('OFÍCIO EM BRANCO');
        $modelo->setModalidadeModelo($this->getReference('ModalidadeModelo-EM BRANCO'));
        $modelo->setTemplate($this->getReference('Template-OFÍCIO'));
        $modelo->setDocumento($this->getReference('Documento-MODELO OFÍCIO EM BRANCO'));

        $this->manager->persist($modelo);

        $this->addReference(
            'Modelo-OFÍCIO EM BRANCO',
            $modelo
        );
        $modelo = new Modelo();
        $modelo->setNome('APROVAÇÃO DE DOCUMENTO');
        $modelo->setDescricao('DESPACHO EM BRANCO');
        $modelo->setModalidadeModelo($this->getReference('ModalidadeModelo-EM BRANCO'));
        $modelo->setTemplate($this->getReference('Template-DESPACHO'));
        $modelo->setDocumento($this->getReference('Documento-MODELO DESPACHO DE APROVAÇÃO'));

        $this->manager->persist($modelo);

        $this->addReference(
            'Modelo-APROVAÇÃO DE DOCUMENTO',
            $modelo
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
        return ['prod', 'dev', 'test'];
    }
}
