<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Test/LoadChatParticipanteData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Test;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\ChatParticipante;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadChatParticipanteData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadChatParticipanteData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $chatParticipante = new ChatParticipante();
        $chatParticipante->setChat($this->getReference('Chat1'));
        $chatParticipante->setUsuario($this->getReference('Usuario-00000000002'));
        $chatParticipante->setAdministrador(true);
        $chatParticipante->setMensagensNaoLidas(2);

        // Persist entity
        $this->manager->persist($chatParticipante);

        $chatParticipante = new ChatParticipante();
        $chatParticipante->setChat($this->getReference('Chat1'));
        $chatParticipante->setUsuario($this->getReference('Usuario-00000000006'));
        $chatParticipante->setAdministrador(true);
        $chatParticipante->setMensagensNaoLidas(2);

        // Persist entity
        $this->manager->persist($chatParticipante);

        $chatParticipante = new ChatParticipante();
        $chatParticipante->setChat($this->getReference('Chat1'));
        $chatParticipante->setUsuario($this->getReference('Usuario-00000000010'));
        $chatParticipante->setMensagensNaoLidas(2);

        // Persist entity
        $this->manager->persist($chatParticipante);

        $chatParticipante = new ChatParticipante();
        $chatParticipante->setChat($this->getReference('Chat2'));
        $chatParticipante->setUsuario($this->getReference('Usuario-00000000002'));
        $chatParticipante->setMensagensNaoLidas(1);

        // Persist entity
        $this->manager->persist($chatParticipante);

        $chatParticipante = new ChatParticipante();
        $chatParticipante->setChat($this->getReference('Chat2'));
        $chatParticipante->setUsuario($this->getReference('Usuario-00000000006'));
        $chatParticipante->setMensagensNaoLidas(1);

        // Persist entity
        $this->manager->persist($chatParticipante);

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
