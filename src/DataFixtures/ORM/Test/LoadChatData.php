<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Test/LoadChatData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Test;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\Chat;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadChatData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadChatData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $chat = new Chat();
        $chat->setNome('CHAT 1');
        $chat->setDescricao('DESCRIÇÃO CHAT 1');
        $chat->setGrupo(true);
        $chat->setCapa(null);

        // Persist entity
        $this->manager->persist($chat);

        // Create reference for later usage
        $this->addReference('Chat1', $chat);

        $chat = new Chat();
        $chat->setNome('CHAT 2');
        $chat->setDescricao('DESCRIÇÃO CHAT 2');
        $chat->setGrupo(false);
        $chat->setCapa(null);

        // Persist entity
        $this->manager->persist($chat);

        // Create reference for later usage
        $this->addReference('Chat2', $chat);

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
        return ['test'];
    }
}
