<?php

declare(strict_types=1);

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Prod;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Api\V1\Triggers\VinculacaoEtiqueta\Trigger0001;
use SuppCore\AdministrativoBackend\Api\V1\Triggers\VinculacaoEtiqueta\Trigger0003;
use SuppCore\AdministrativoBackend\Api\V1\Triggers\VinculacaoEtiqueta\Trigger0004;
use SuppCore\AdministrativoBackend\Api\V1\Triggers\VinculacaoEtiqueta\Trigger0005;
use SuppCore\AdministrativoBackend\Entity\ModalidadeAcaoEtiqueta;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadModalidadeAcaoEtiquetaData.
 */
class LoadModalidadeAcaoEtiquetaData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $modalidadeAcaoEtiqueta = (new ModalidadeAcaoEtiqueta())
            ->setValor('MINUTA')
            ->setDescricao('GERA AUTOMATICAMENTE UMA MINUTA NA TAREFA ETIQUETADA DE ACORDO COM O MODELO PRÉ-SELECIONADO')
            ->setTrigger(Trigger0001::class)
            ->setModalidadeEtiqueta($this->getReference('ModalidadeEtiqueta-TAREFA'))
            ->setAtivo(true);

        $this->manager->persist($modalidadeAcaoEtiqueta);

        $this->addReference(
            'ModalidadeAcaoEtiqueta-'.$modalidadeAcaoEtiqueta->getValor(),
            $modalidadeAcaoEtiqueta
        );

        $modalidadeAcaoEtiqueta = (new ModalidadeAcaoEtiqueta())
            ->setValor('DISTRIBUIÇÃO AUTOMÁTICA')
            ->setDescricao('DISTRIBUIR AS TAREFAS DE FORMA AUTOMÁTICA OU POR RESPONSÁVEL')
            ->setTrigger(Trigger0003::class)
            ->setModalidadeEtiqueta($this->getReference('ModalidadeEtiqueta-TAREFA'))
            ->setAtivo(true);

        $this->manager->persist($modalidadeAcaoEtiqueta);

        $this->addReference(
            'ModalidadeAcaoEtiqueta-'.$modalidadeAcaoEtiqueta->getValor(),
            $modalidadeAcaoEtiqueta
        );

        $modalidadeAcaoEtiqueta = (new ModalidadeAcaoEtiqueta())
            ->setValor('COMPARTILHAMENTO')
            ->setDescricao('COMPARTILHA A TAREFA ENTRE USUÁRIOS')
            ->setTrigger(Trigger0004::class)
            ->setModalidadeEtiqueta($this->getReference('ModalidadeEtiqueta-TAREFA'))
            ->setAtivo(true);

        $this->manager->persist($modalidadeAcaoEtiqueta);

        $this->addReference(
            'ModalidadeAcaoEtiqueta-'.$modalidadeAcaoEtiqueta->getValor(),
            $modalidadeAcaoEtiqueta
        );

        $modalidadeAcaoEtiqueta = (new ModalidadeAcaoEtiqueta())
            ->setValor('OFÍCIO')
            ->setDescricao('GERA AUTOMATICAMENTE UM OFICIO NA TAREFA ETIQUETADA')
            ->setTrigger(Trigger0005::class)
            ->setModalidadeEtiqueta($this->getReference('ModalidadeEtiqueta-TAREFA'))
            ->setAtivo(true);

        $this->manager->persist($modalidadeAcaoEtiqueta);

        $this->addReference(
            'ModalidadeAcaoEtiqueta-'.$modalidadeAcaoEtiqueta->getValor(),
            $modalidadeAcaoEtiqueta
        );

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
        return ['prod', 'dev', 'test'];
    }
}
