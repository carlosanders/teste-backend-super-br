<?php
#PROD
declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/ProdExec/LoadModalidadeMeioData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\ProdExec;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\ModalidadeMeio;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadModalidadeMeioData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadModalidadeMeioData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $modalidadeMeio = new ModalidadeMeio();
        $modalidadeMeio->setValor('FÍSICO');
        $modalidadeMeio->setDescricao('FÍSICO');

        $this->manager->persist($modalidadeMeio);

        $this->addReference('ModalidadeMeio-'.$modalidadeMeio->getValor(), $modalidadeMeio);

        $modalidadeMeio = new ModalidadeMeio();
        $modalidadeMeio->setValor('ELETRÔNICO');
        $modalidadeMeio->setDescricao('ELETRÔNICO');

        $this->manager->persist($modalidadeMeio);

        $this->addReference('ModalidadeMeio-'.$modalidadeMeio->getValor(), $modalidadeMeio);

        $modalidadeMeio = new ModalidadeMeio();
        $modalidadeMeio->setValor('HÍBRIDO');
        $modalidadeMeio->setDescricao('HÍBRIDO');

        $this->manager->persist($modalidadeMeio);

        $this->addReference('ModalidadeMeio-'.$modalidadeMeio->getValor(), $modalidadeMeio);

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
        return 1;
    }

    /**
     * This method must return an array of groups
     * on which the implementing class belongs to.
     *
     * @return string[]
     */
    public static function getGroups(): array
    {
        return ['prodexec'];
    }
}
