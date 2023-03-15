<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Prod/LoadModalidadeEtiquetaData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Prod;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\ModalidadeEtiqueta;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadModalidadeEtiquetaData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadModalidadeEtiquetaData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $modalidadeEtiqueta = new ModalidadeEtiqueta();
        $modalidadeEtiqueta->setValor('TAREFA');
        $modalidadeEtiqueta->setDescricao('TAREFA');

        $this->manager->persist($modalidadeEtiqueta);

        $this->addReference('ModalidadeEtiqueta-'.$modalidadeEtiqueta->getValor(), $modalidadeEtiqueta);

        $modalidadeEtiqueta = new ModalidadeEtiqueta();
        $modalidadeEtiqueta->setValor('PROCESSO');
        $modalidadeEtiqueta->setDescricao('PROCESSO');

        $this->manager->persist($modalidadeEtiqueta);

        $this->addReference('ModalidadeEtiqueta-'.$modalidadeEtiqueta->getValor(), $modalidadeEtiqueta);

        $modalidadeEtiqueta = new ModalidadeEtiqueta();
        $modalidadeEtiqueta->setValor('DOCUMENTO');
        $modalidadeEtiqueta->setDescricao('DOCUMENTO');

        $this->manager->persist($modalidadeEtiqueta);

        $this->addReference('ModalidadeEtiqueta-'.$modalidadeEtiqueta->getValor(), $modalidadeEtiqueta);

        $modalidadeEtiqueta = new ModalidadeEtiqueta();
        $modalidadeEtiqueta->setValor('RELATORIO');
        $modalidadeEtiqueta->setDescricao('RELATORIO');

        $this->manager->persist($modalidadeEtiqueta);

        $this->addReference('ModalidadeEtiqueta-'.$modalidadeEtiqueta->getValor(), $modalidadeEtiqueta);

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
        return ['prod', 'dev', 'test'];
    }
}
