<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Test/LoadAcaoTransicaoWorkflowData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Test;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\AcaoTransicaoWorkflow;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadAcaoTransicaoWorkflowData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadAcaoTransicaoWorkflowData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $acaoTransicaoWorkflow = new AcaoTransicaoWorkflow();
        $acaoTransicaoWorkflow->setContexto("Ação Transição Workflow 01");
        $acaoTransicaoWorkflow->setTipoAcaoWorkflow($this->getReference('TipoAcaoWorkflow-MINUTA'));
        $acaoTransicaoWorkflow->setTransicaoWorkflow($this->getReference('TransicaoWorkflow-MINUTA DE ATO NORMATIVO, ELABORADA'));
        $acaoTransicaoWorkflow->setCriadoPor($this->getReference('Usuario-00000000002'));

        // Persist entity
        $this->manager->persist($acaoTransicaoWorkflow);

        $this->manager = $manager;

        $acaoTransicaoWorkflow = new AcaoTransicaoWorkflow();
        $acaoTransicaoWorkflow->setContexto("Ação Transição Workflow 02");
        $acaoTransicaoWorkflow->setTipoAcaoWorkflow($this->getReference('TipoAcaoWorkflow-MINUTA'));
        $acaoTransicaoWorkflow->setTransicaoWorkflow($this->getReference('TransicaoWorkflow-MINUTA DE ATO NORMATIVO, REVISADA COM APROVAÇÃO'));
        $acaoTransicaoWorkflow->setCriadoPor($this->getReference('Usuario-00000000002'));

        // Persist entity
        $this->manager->persist($acaoTransicaoWorkflow);

        $this->manager = $manager;

        $acaoTransicaoWorkflow = new AcaoTransicaoWorkflow();
        $acaoTransicaoWorkflow->setContexto("Ação Transição Workflow 03");
        $acaoTransicaoWorkflow->setTipoAcaoWorkflow($this->getReference('TipoAcaoWorkflow-MINUTA'));
        $acaoTransicaoWorkflow->setTransicaoWorkflow($this->getReference('TransicaoWorkflow-MINUTA DE ATO NORMATIVO, REVISADA COM REJEIÇÃO'));
        $acaoTransicaoWorkflow->setCriadoPor($this->getReference('Usuario-00000000002'));

        // Persist entity
        $this->manager->persist($acaoTransicaoWorkflow);

        $this->manager = $manager;

        $acaoTransicaoWorkflow = new AcaoTransicaoWorkflow();
        $acaoTransicaoWorkflow->setContexto("Ação Transição Workflow 04");
        $acaoTransicaoWorkflow->setTipoAcaoWorkflow($this->getReference('TipoAcaoWorkflow-COMPARTILHAMENTO'));
        $acaoTransicaoWorkflow->setTransicaoWorkflow($this->getReference('TransicaoWorkflow-MINUTA DE ATO NORMATIVO, PUBLICADA'));
        $acaoTransicaoWorkflow->setCriadoPor($this->getReference('Usuario-00000000002'));


        // Persist entity
        $this->manager->persist($acaoTransicaoWorkflow);

        $this->manager = $manager;

        $acaoTransicaoWorkflow = new AcaoTransicaoWorkflow();
        $acaoTransicaoWorkflow->setContexto("Ação Transição Workflow 05");
        $acaoTransicaoWorkflow->setTipoAcaoWorkflow($this->getReference('TipoAcaoWorkflow-OFÍCIO'));
        $acaoTransicaoWorkflow->setTransicaoWorkflow($this->getReference('TransicaoWorkflow-MINUTA DE ATO NORMATIVO, PUBLICADA'));
        $acaoTransicaoWorkflow->setCriadoPor($this->getReference('Usuario-00000000002'));


        // Persist entity
        $this->manager->persist($acaoTransicaoWorkflow);

        // Flush database changes
        $this->manager->flush();
    }

    /**
     * Get the order of this fixture.
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
