<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Test/LoadSetorData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Test;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\Setor;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadSetorData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadSetorData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $setor = new Setor();
        $setor->setNome('SECRETARIA-1');
        $setor->setSigla('SECR');
        $setor->setPrefixoNUP('00400');
        $setor->setSequenciaInicialNUP(1);
        $setor->setEspecieSetor($this->getReference('EspecieSetor-SECRETARIA'));
        $setor->setUnidade($this->getReference('Unidade-ADVOCACIA-GERAL DA UNIÃO'));
        $setor->setParent($this->getReference('Unidade-ADVOCACIA-GERAL DA UNIÃO'));
        $setor->setMunicipio($this->getReference('Municipio-BRASÍLIA-DF'));

        $this->manager->persist($setor);

        $this->addReference(
            'Setor-'.$setor->getNome().'-'.$setor->getSigla(),
            $setor
        );

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
