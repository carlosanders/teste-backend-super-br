<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Test/LoadAcaoData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Test;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\Acao;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadAcaoData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadAcaoData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $acao = new Acao();
        $acao->setContexto("Ação 0001");
        $acao->setEtiqueta($this->getReference('Etiqueta-LEMBRETE'));
        $acao->setModalidadeAcaoEtiqueta($this->getReference('ModalidadeAcaoEtiqueta-MINUTA'));
        $acao->setCriadoPor($this->getReference('Usuario-00000000002'));
        $acao->setCriadoEm(\DateTime::createFromFormat('Y-m-d', '2021-05-30'));

        // Persist entity
        $this->manager->persist($acao);

        $acao = new Acao();
        $acao->setContexto("Ação 0002");
        $acao->setEtiqueta($this->getReference('Etiqueta-SIGILOSO'));
        $acao->setModalidadeAcaoEtiqueta($this->getReference('ModalidadeAcaoEtiqueta-OFÍCIO'));
        $acao->setCriadoPor($this->getReference('Usuario-00000000002'));
        $acao->setCriadoEm(\DateTime::createFromFormat('Y-m-d', '1999-05-30'));

        // Persist entity
        $this->manager->persist($acao);

        $acao = new Acao();
        $acao->setContexto("Ação 0003");
        $acao->setEtiqueta($this->getReference('Etiqueta-EM TRAMITAÇÃO'));
        $acao->setModalidadeAcaoEtiqueta($this->getReference('ModalidadeAcaoEtiqueta-COMPARTILHAMENTO'));
        $acao->setCriadoPor($this->getReference('Usuario-00000000002'));
        $acao->setCriadoEm(\DateTime::createFromFormat('Y-m-d', '2021-05-30'));

        // Persist entity
        $this->manager->persist($acao);

        $acao = new Acao();
        $acao->setContexto("Ação 0004");
        $acao->setEtiqueta($this->getReference('Etiqueta-REDISTRIBUÍDA'));
        $acao->setModalidadeAcaoEtiqueta($this->getReference('ModalidadeAcaoEtiqueta-DISTRIBUIÇÃO AUTOMÁTICA'));
        $acao->setCriadoPor($this->getReference('Usuario-00000000002'));
        $acao->setCriadoEm(\DateTime::createFromFormat('Y-m-d', '2021-05-30'));

        // Persist entity
        $this->manager->persist($acao);

        $acao = new Acao();
        $acao->setContexto("Ação 0005");
        $acao->setEtiqueta($this->getReference('Etiqueta-OFÍCIO VENCIDO'));
        $acao->setModalidadeAcaoEtiqueta($this->getReference('ModalidadeAcaoEtiqueta-OFÍCIO'));
        $acao->setCriadoPor($this->getReference('Usuario-00000000002'));
        $acao->setCriadoEm(\DateTime::createFromFormat('Y-m-d', '1999-05-30'));

        // Persist entity
        $this->manager->persist($acao);

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
        return ['test'];
    }
}
