<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Test/LoadDocumentoData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Test;

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
    public function load(ObjectManager $manager): void
    {
        $this->manager = $manager;

        $documento = new Documento();
        $documento->setTipoDocumento($this->getReference('TipoDocumento-DESPACHO'));
        $documento->setChaveAcesso(substr(md5(uniqid((string) rand(), true)), 0, 8));

        // Persist entity
        $this->manager->persist($documento);

        // Create reference for later usage
        $this->addReference(
            'Documento-TEMPLATE-DESPACHO-TESTE',
            $documento
        );

        $documento = new Documento();
        $documento->setTipoDocumento($this->getReference('TipoDocumento-DESPACHO'));
        $documento->setChaveAcesso(substr(md5(uniqid((string) rand(), true)), 0, 8));
        $documento->setTarefaOrigem($this->getReference('Tarefa-TESTE_1'));
        $documento->setProcessoOrigem($this->getReference('Processo-TESTE_1'));
        $documento->setSetorOrigem($this->getReference('Setor-ARQUIVO-PGF-SEDE'));

        // Persist entity
        $this->manager->persist($documento);

        // Create reference for later usage
        $this->addReference(
            'Documento-TEMPLATE DESPACHO2',
            $documento
        );

        $documento = new Documento();
        $documento->setTipoDocumento($this->getReference('TipoDocumento-DESPACHO'));
        $documento->setChaveAcesso(substr(md5(uniqid((string) rand(), true)), 0, 8));

        // Persist entity
        $this->manager->persist($documento);

        // Create reference for later usage
        $this->addReference(
            'Documento-MODELO DESPACHO DE APROVAÇÃO2',
            $documento
        );

        $documento = new Documento();
        $documento->setTipoDocumento($this->getReference('TipoDocumento-OFÍCIO'));
        $documento->setChaveAcesso(substr(md5(uniqid((string) rand(), true)), 0, 8));

        // Persist entity
        $this->manager->persist($documento);

        // Create reference for later usage
        $this->addReference(
            'Documento-MODELO OFÍCIO EM BRANCO2',
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
