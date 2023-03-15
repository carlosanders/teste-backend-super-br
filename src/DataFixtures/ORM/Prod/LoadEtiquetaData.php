<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Prod/LoadEtiquetaData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Prod;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\Etiqueta;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadEtiquetaData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadEtiquetaData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $etiqueta = new Etiqueta();
        $etiqueta->setNome('MINUTA');
        $etiqueta->setDescricao($etiqueta->getNome());
        $etiqueta->setCorHexadecimal('#FFFFF0');
        $etiqueta->setSistema(true);
        $etiqueta->setModalidadeEtiqueta($this->getReference('ModalidadeEtiqueta-TAREFA'));
        $this->addReference('Etiqueta-'.$etiqueta->getNome(), $etiqueta);
        $this->manager->persist($etiqueta);

        $etiqueta = new Etiqueta();
        $etiqueta->setNome('COMPARTILHADA');
        $etiqueta->setDescricao($etiqueta->getNome());
        $etiqueta->setCorHexadecimal('#FFFFF0');
        $etiqueta->setSistema(true);
        $etiqueta->setModalidadeEtiqueta($this->getReference('ModalidadeEtiqueta-TAREFA'));
        $this->addReference('Etiqueta-'.$etiqueta->getNome(), $etiqueta);
        $this->manager->persist($etiqueta);

        $etiqueta = new Etiqueta();
        $etiqueta->setNome('OFÍCIO EM ELABORAÇÃO');
        $etiqueta->setDescricao($etiqueta->getNome());
        $etiqueta->setCorHexadecimal('#FFFFF0');
        $etiqueta->setSistema(true);
        $etiqueta->setModalidadeEtiqueta($this->getReference('ModalidadeEtiqueta-TAREFA'));
        $this->addReference('Etiqueta-'.$etiqueta->getNome(), $etiqueta);
        $this->manager->persist($etiqueta);

        $etiqueta = new Etiqueta();
        $etiqueta->setNome('OFÍCIO REMETIDO');
        $etiqueta->setDescricao($etiqueta->getNome());
        $etiqueta->setCorHexadecimal('#FFFFF0');
        $etiqueta->setSistema(true);
        $etiqueta->setModalidadeEtiqueta($this->getReference('ModalidadeEtiqueta-TAREFA'));
        $this->addReference('Etiqueta-'.$etiqueta->getNome(), $etiqueta);
        $this->manager->persist($etiqueta);

        $etiqueta = new Etiqueta();
        $etiqueta->setNome('OFÍCIO RESPONDIDO');
        $etiqueta->setDescricao($etiqueta->getNome());
        $etiqueta->setCorHexadecimal('#FFFFF0');
        $etiqueta->setSistema(true);
        $etiqueta->setModalidadeEtiqueta($this->getReference('ModalidadeEtiqueta-TAREFA'));
        $this->addReference('Etiqueta-'.$etiqueta->getNome(), $etiqueta);
        $this->manager->persist($etiqueta);

        $etiqueta = new Etiqueta();
        $etiqueta->setNome('OFÍCIO VENCIDO');
        $etiqueta->setDescricao($etiqueta->getNome());
        $etiqueta->setCorHexadecimal('#FFFFF0');
        $etiqueta->setSistema(true);
        $etiqueta->setModalidadeEtiqueta($this->getReference('ModalidadeEtiqueta-TAREFA'));
        $this->addReference('Etiqueta-'.$etiqueta->getNome(), $etiqueta);
        $this->manager->persist($etiqueta);

        $etiqueta = new Etiqueta();
        $etiqueta->setNome('REDISTRIBUÍDA');
        $etiqueta->setDescricao($etiqueta->getNome());
        $etiqueta->setCorHexadecimal('#FFFFF0');
        $etiqueta->setSistema(true);
        $etiqueta->setModalidadeEtiqueta($this->getReference('ModalidadeEtiqueta-TAREFA'));
        $this->addReference('Etiqueta-'.$etiqueta->getNome(), $etiqueta);
        $this->manager->persist($etiqueta);

        $etiqueta = new Etiqueta();
        $etiqueta->setNome('EM TRAMITAÇÃO');
        $etiqueta->setDescricao($etiqueta->getNome());
        $etiqueta->setCorHexadecimal('#FFFFF0');
        $etiqueta->setSistema(true);
        $etiqueta->setModalidadeEtiqueta($this->getReference('ModalidadeEtiqueta-PROCESSO'));
        $this->addReference('Etiqueta-'.$etiqueta->getNome(), $etiqueta);
        $this->manager->persist($etiqueta);

        $etiqueta = new Etiqueta();
        $etiqueta->setNome('SIGILOSO');
        $etiqueta->setDescricao($etiqueta->getNome());
        $etiqueta->setCorHexadecimal('#FFFFF0');
        $etiqueta->setSistema(true);
        $etiqueta->setModalidadeEtiqueta($this->getReference('ModalidadeEtiqueta-PROCESSO'));
        $this->addReference('Etiqueta-'.$etiqueta->getNome(), $etiqueta);
        $this->manager->persist($etiqueta);

        $etiqueta = new Etiqueta();
        $etiqueta->setNome('RELEVANTE');
        $etiqueta->setDescricao($etiqueta->getNome());
        $etiqueta->setCorHexadecimal('#FFFFF0');
        $etiqueta->setSistema(true);
        $etiqueta->setModalidadeEtiqueta($this->getReference('ModalidadeEtiqueta-PROCESSO'));
        $this->addReference('Etiqueta-'.$etiqueta->getNome(), $etiqueta);
        $this->manager->persist($etiqueta);

        $etiqueta = new Etiqueta();
        $etiqueta->setNome('ACESSO RESTRITO');
        $etiqueta->setDescricao($etiqueta->getNome());
        $etiqueta->setCorHexadecimal('#FFFFF0');
        $etiqueta->setSistema(true);
        $etiqueta->setModalidadeEtiqueta($this->getReference('ModalidadeEtiqueta-PROCESSO'));
        $this->addReference('Etiqueta-'.$etiqueta->getNome(), $etiqueta);
        $this->manager->persist($etiqueta);

        $etiqueta = new Etiqueta();
        $etiqueta->setNome('LEMBRETE');
        $etiqueta->setDescricao($etiqueta->getNome());
        $etiqueta->setCorHexadecimal('#FFFFF0');
        $etiqueta->setSistema(true);
        $etiqueta->setModalidadeEtiqueta($this->getReference('ModalidadeEtiqueta-PROCESSO'));
        $this->addReference('Etiqueta-'.$etiqueta->getNome(), $etiqueta);
        $this->manager->persist($etiqueta);

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
        return 2;
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
