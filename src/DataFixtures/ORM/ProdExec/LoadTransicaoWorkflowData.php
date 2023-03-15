<?php

declare(strict_types=1);

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\ProdExec;

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
 * @author  Felipe Pena <felipe.pena@datainfo.inf.br>
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
        $transicaoWorkflow->setEspecieTarefaFrom($this->getReference('EspecieTarefa-PARTICIPAR DE REUNIÃO'));
        $transicaoWorkflow->setEspecieTarefaTo($this->getReference('EspecieTarefa-ELABORAR MINUTA DE ATO NORMATIVO'));
        $transicaoWorkflow->setWorkflow($this->getReference('Workflow-ACOMPANHAMENTO LEGISLATIVO: SENADO FEDERAL'));

        $this->manager->persist($transicaoWorkflow);

        $transicaoWorkflow = new TransicaoWorkflow();
        $transicaoWorkflow->setEspecieAtividade($this->getReference('EspecieAtividade-MINUTA DE ATO NORMATIVO, REVISADA COM APROVAÇÃO'));
        $transicaoWorkflow->setEspecieTarefaFrom($this->getReference('EspecieTarefa-REVISAR MINUTA DE ATO NORMATIVO'));
        $transicaoWorkflow->setEspecieTarefaTo($this->getReference('EspecieTarefa-ASSINAR MINUTA DE ATO NORMATIVO'));
        $transicaoWorkflow->setWorkflow($this->getReference('Workflow-ACOMPANHAMENTO LEGISLATIVO: SENADO FEDERAL'));

        $this->manager->persist($transicaoWorkflow);

        $transicaoWorkflow = new TransicaoWorkflow();
        $transicaoWorkflow->setEspecieAtividade($this->getReference('EspecieAtividade-MINUTA DE ATO NORMATIVO, REVISADA COM REJEIÇÃO'));
        $transicaoWorkflow->setEspecieTarefaFrom($this->getReference('EspecieTarefa-REVISAR MINUTA DE ATO NORMATIVO'));
        $transicaoWorkflow->setEspecieTarefaTo($this->getReference('EspecieTarefa-ELABORAR MINUTA DE ATO NORMATIVO'));
        $transicaoWorkflow->setWorkflow($this->getReference('Workflow-ACOMPANHAMENTO LEGISLATIVO: SENADO FEDERAL'));

        $this->manager->persist($transicaoWorkflow);

        $transicaoWorkflow = new TransicaoWorkflow();
        $transicaoWorkflow->setEspecieAtividade($this->getReference('EspecieAtividade-PROVIDÊNCIAS ADMINISTRATIVAS, ADOTADAS'));
        $transicaoWorkflow->setEspecieTarefaFrom($this->getReference('EspecieTarefa-PARTICIPAR DE REUNIÃO'));
        $transicaoWorkflow->setEspecieTarefaTo($this->getReference('EspecieTarefa-APROVAR DOCUMENTO'));
        $transicaoWorkflow->setWorkflow($this->getReference('Workflow-PLANEJAMENTO ESTRATÉGICO: ELABORAÇÃO DO PLANO OPERACIONAL'));

        $this->manager->persist($transicaoWorkflow);

        $transicaoWorkflow = new TransicaoWorkflow();
        $transicaoWorkflow->setEspecieAtividade($this->getReference('EspecieAtividade-PROVIDÊNCIAS ADMINISTRATIVAS, ADOTADAS'));
        $transicaoWorkflow->setEspecieTarefaFrom($this->getReference('EspecieTarefa-APROVAR DOCUMENTO'));
        $transicaoWorkflow->setEspecieTarefaTo($this->getReference('EspecieTarefa-APROVAR DOCUMENTO'));
        $transicaoWorkflow->setWorkflow($this->getReference('Workflow-PLANEJAMENTO ESTRATÉGICO: ELABORAÇÃO DO PLANO OPERACIONAL'));

        $this->manager->persist($transicaoWorkflow);

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
        return ['prodexec'];
    }
}
