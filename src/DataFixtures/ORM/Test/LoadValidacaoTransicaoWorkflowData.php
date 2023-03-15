<?php

declare(strict_types=1);

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Test;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\ValidacaoTransicaoWorkflow;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadValidacaoTransicaoWorkflowData.
 *
 * @author  Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadValidacaoTransicaoWorkflowData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $validacaoTransicaoWorkflow = new ValidacaoTransicaoWorkflow();
        $validacaoTransicaoWorkflow->setNome('NOME-1');
        $validacaoTransicaoWorkflow->setDescricao('DESCRIÇÃO-1');
        $validacaoTransicaoWorkflow->setContexto('CONTEXTO-1');
        $validacaoTransicaoWorkflow->setTipoValidacaoWorkflow($this->getReference('TipoAcaoWorkflow-TIPO DE DOCUMENTO'));
        $validacaoTransicaoWorkflow->setTransicaoWorkflow($this->getReference('TransicaoWorkflow-MINUTA DE ATO NORMATIVO, PUBLICADA'));

        // Persist entity
        $this->manager->persist($validacaoTransicaoWorkflow);

        // Create reference for later usage
        $this->addReference('ValidacaoTransicaoWorkflow-'.$validacaoTransicaoWorkflow->getNome(), $validacaoTransicaoWorkflow);

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
