<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Test/LoadTransicaoWorkflowData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Test;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\TransicaoWorkflow;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadTransicaoWorkflowData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadTransicaoWorkflowData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $transicaoWorkflow = new TransicaoWorkflow();
        $transicaoWorkflow->setEspecieAtividade($this->getReference('EspecieAtividade-MINUTA DE ATO NORMATIVO, ELABORADA'));
        $transicaoWorkflow->setEspecieTarefaFrom($this->getReference('EspecieTarefa-ELABORAR MINUTA DE ATO NORMATIVO'));
        $transicaoWorkflow->setEspecieTarefaTo($this->getReference('EspecieTarefa-REVISAR MINUTA DE ATO NORMATIVO'));
        $transicaoWorkflow->setWorkflow($this->getReference('Workflow-ELABORAÇÃO DE ATO NORMATIVO'));
        $transicaoWorkflow->setQtdDiasPrazo(5);

        // Persist entity
        $this->manager->persist($transicaoWorkflow);

        // Create reference for later usage
        $this->addReference('TransicaoWorkflow-' . $transicaoWorkflow->getEspecieAtividade()->getNome(), $transicaoWorkflow);

        $transicaoWorkflow = new TransicaoWorkflow();
        $transicaoWorkflow->setEspecieAtividade($this->getReference('EspecieAtividade-MINUTA DE ATO NORMATIVO, REVISADA COM APROVAÇÃO'));
        $transicaoWorkflow->setEspecieTarefaFrom($this->getReference('EspecieTarefa-REVISAR MINUTA DE ATO NORMATIVO'));
        $transicaoWorkflow->setEspecieTarefaTo($this->getReference('EspecieTarefa-ASSINAR MINUTA DE ATO NORMATIVO'));
        $transicaoWorkflow->setWorkflow($this->getReference('Workflow-ELABORAÇÃO DE ATO NORMATIVO'));
        $transicaoWorkflow->setQtdDiasPrazo(5);

        // Persist entity
        $this->manager->persist($transicaoWorkflow);

        // Create reference for later usage
        $this->addReference('TransicaoWorkflow-' . $transicaoWorkflow->getEspecieAtividade()->getNome(), $transicaoWorkflow);

        $transicaoWorkflow = new TransicaoWorkflow();
        $transicaoWorkflow->setEspecieAtividade($this->getReference('EspecieAtividade-MINUTA DE ATO NORMATIVO, REVISADA COM REJEIÇÃO'));
        $transicaoWorkflow->setEspecieTarefaFrom($this->getReference('EspecieTarefa-REVISAR MINUTA DE ATO NORMATIVO'));
        $transicaoWorkflow->setEspecieTarefaTo($this->getReference('EspecieTarefa-ELABORAR MINUTA DE ATO NORMATIVO'));
        $transicaoWorkflow->setWorkflow($this->getReference('Workflow-ELABORAÇÃO DE ATO NORMATIVO'));
        $transicaoWorkflow->setQtdDiasPrazo(5);

        // Persist entity
        $this->manager->persist($transicaoWorkflow);

        // Create reference for later usage
        $this->addReference('TransicaoWorkflow-' . $transicaoWorkflow->getEspecieAtividade()->getNome(), $transicaoWorkflow);

        $transicaoWorkflow = new TransicaoWorkflow();
        $transicaoWorkflow->setEspecieAtividade($this->getReference('EspecieAtividade-MINUTA DE ATO NORMATIVO, ASSINADA'));
        $transicaoWorkflow->setEspecieTarefaFrom($this->getReference('EspecieTarefa-ASSINAR MINUTA DE ATO NORMATIVO'));
        $transicaoWorkflow->setEspecieTarefaTo($this->getReference('EspecieTarefa-PUBLICAR MINUTA DE ATO NORMATIVO'));
        $transicaoWorkflow->setWorkflow($this->getReference('Workflow-ELABORAÇÃO DE ATO NORMATIVO'));
        $transicaoWorkflow->setQtdDiasPrazo(5);

        // Persist entity
        $this->manager->persist($transicaoWorkflow);

        // Create reference for later usage
        $this->addReference('TransicaoWorkflow-' . $transicaoWorkflow->getEspecieAtividade()->getNome(), $transicaoWorkflow);

        $transicaoWorkflow = new TransicaoWorkflow();
        $transicaoWorkflow->setEspecieAtividade($this->getReference('EspecieAtividade-MINUTA DE ATO NORMATIVO, PUBLICADA'));
        $transicaoWorkflow->setEspecieTarefaFrom($this->getReference('EspecieTarefa-PUBLICAR MINUTA DE ATO NORMATIVO'));
        $transicaoWorkflow->setEspecieTarefaTo($this->getReference('EspecieTarefa-MANTER SOB GUARDA NO ARQUIVO CORRENTE'));
        $transicaoWorkflow->setWorkflow($this->getReference('Workflow-ELABORAÇÃO DE ATO NORMATIVO'));
        $transicaoWorkflow->setQtdDiasPrazo(5);

        // Persist entity
        $this->manager->persist($transicaoWorkflow);

        // Create reference for later usage
        $this->addReference('TransicaoWorkflow-' . $transicaoWorkflow->getEspecieAtividade()->getNome(), $transicaoWorkflow);

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
