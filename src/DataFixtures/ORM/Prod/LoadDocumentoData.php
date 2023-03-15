<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Prod/LoadDocumentoData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Prod;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\Documento;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadDocumentoData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadDocumentoData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $documento = new Documento();
        $documento->setTipoDocumento($this->getReference('TipoDocumento-DESPACHO'));
        $documento->setChaveAcesso(substr(md5(uniqid((string) rand(), true)), 0, 8));

        $this->manager->persist($documento);

        $this->addReference(
            'Documento-TEMPLATE DESPACHO',
            $documento
        );

        $documento = new Documento();
        $documento->setTipoDocumento($this->getReference('TipoDocumento-DESPACHO'));
        $documento->setChaveAcesso(substr(md5(uniqid((string) rand(), true)), 0, 8));

        $this->manager->persist($documento);

        $this->addReference(
            'Documento-MODELO DESPACHO EM BRANCO',
            $documento
        );

        $documento = new Documento();
        $documento->setTipoDocumento($this->getReference('TipoDocumento-OFÍCIO'));
        $documento->setChaveAcesso(substr(md5(uniqid((string) rand(), true)), 0, 8));

        $this->manager->persist($documento);

        $this->addReference(
            'Documento-TEMPLATE OFÍCIO',
            $documento
        );

        $documento = new Documento();
        $documento->setTipoDocumento($this->getReference('TipoDocumento-OFÍCIO'));
        $documento->setChaveAcesso(substr(md5(uniqid((string) rand(), true)), 0, 8));

        $this->manager->persist($documento);

        $this->addReference(
            'Documento-MODELO OFÍCIO EM BRANCO',
            $documento
        );

        $documento = new Documento();
        $documento->setTipoDocumento($this->getReference('TipoDocumento-DESPACHO'));
        $documento->setChaveAcesso(substr(md5(uniqid((string) rand(), true)), 0, 8));

        $this->manager->persist($documento);

        $this->addReference(
            'Documento-MODELO DESPACHO DE APROVAÇÃO',
            $documento
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
        return ['prod', 'dev', 'test'];
    }
}
