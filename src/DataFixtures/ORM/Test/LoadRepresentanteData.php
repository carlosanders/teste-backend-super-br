<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Test/LoadRepresentanteData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Test;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\Representante;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadRepresentanteData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadRepresentanteData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $representante = new Representante();
        $representante->setOrigemDados($this->getReference('OrigemDados-FONTE_DADOS_1'));
        $representante->setModalidadeRepresentante($this->getReference('ModalidadeRepresentante-ADVOGADO'));
        $representante->setInteressado($this->getReference('Interessado-12312312355'));
        $representante->setNome('NOME REPRESENTANTE');
        $representante->setInscricao('SP0000001A');

        // Persist entity
        $this->manager->persist($representante);

        // Flush database changes
        $this->manager->flush();
    }

    /**
     * Get the order of this fixture.
     */
    public function getOrder(): int
    {
        return 7;
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
