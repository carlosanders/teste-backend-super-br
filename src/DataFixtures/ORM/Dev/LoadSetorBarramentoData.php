<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Dev/LoadSetorBarramentoData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Dev;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\Setor;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadSetorBarramentoData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadSetorBarramentoData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
{
    private ObjectManager $manager;

    /**
     * Setter for container.
     */
    public function setContainer(?ContainerInterface $container = null): void
    {
        if (null !== $container) {
            $this->container = $container;
        }
    }

    /**
     * @throws Exception
     */
    public function load(ObjectManager $manager): void
    {
        $this->manager = $manager;

        $setor = new Setor();
        $setor->setNome('COORDENAÇÃO-GERAL DE SOLUÇÕES JURÍDICO-TECNOLÓGICAS');
        $setor->setSigla('CGSJT-DGE');
        $setor->setPrefixoNUP('00400');
        $setor->setSequenciaInicialNUP(1);
        $setor->setEspecieSetor($this->getReference('EspecieSetor-SECRETARIA'));
        $setor->setUnidade($this->getReference('Unidade-ADVOCACIA-GERAL DA UNIÃO'));
        $setor->setParent($this->getReference('Unidade-ADVOCACIA-GERAL DA UNIÃO'));
        $setor->setMunicipio($this->getReference('Municipio-BRASÍLIA-DF'));
        $this->manager->persist($setor);
        // Flush database changes
        $this->manager->flush();
    }

    /**
     * Get the order of this fixture.
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
        return ['dev'];
    }
}
