<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Test/LoadChatMensagemData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Test;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\ChatMensagem;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadChatMensagemData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadChatMensagemData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $chatMensagem = new ChatMensagem();
        $chatMensagem->setChat($this->getReference('Chat1'));
        $chatMensagem->setUsuario($this->getReference('Usuario-00000000002'));
        $chatMensagem->setComponenteDigital($this->getReference('ComponenteDigital-TEMPLATE OFÍCIO'));
        $chatMensagem->setMensagem('MENSAGEM 0001');

        // Persist entity
        $this->manager->persist($chatMensagem);

        $chatMensagem = new ChatMensagem();
        $chatMensagem->setChat($this->getReference('Chat1'));
        $chatMensagem->setUsuario($this->getReference('Usuario-00000000006'));
        $chatMensagem->setComponenteDigital($this->getReference('ComponenteDigital-TEMPLATE OFÍCIO'));
        $chatMensagem->setMensagem('MENSAGEM 0002');

        // Persist entity
        $this->manager->persist($chatMensagem);

        $chatMensagem = new ChatMensagem();
        $chatMensagem->setChat($this->getReference('Chat1'));
        $chatMensagem->setUsuario($this->getReference('Usuario-00000000010'));
        $chatMensagem->setComponenteDigital($this->getReference('ComponenteDigital-TEMPLATE OFÍCIO'));
        $chatMensagem->setMensagem('MENSAGEM 0003');

        // Persist entity
        $this->manager->persist($chatMensagem);

        $chatMensagem = new ChatMensagem();
        $chatMensagem->setChat($this->getReference('Chat2'));
        $chatMensagem->setUsuario($this->getReference('Usuario-00000000002'));
        $chatMensagem->setComponenteDigital($this->getReference('ComponenteDigital-MODELO DESPACHO DE APROVAÇÃO'));
        $chatMensagem->setMensagem('MENSAGEM 0004');

        // Persist entity
        $this->manager->persist($chatMensagem);

        $chatMensagem = new ChatMensagem();
        $chatMensagem->setChat($this->getReference('Chat2'));
        $chatMensagem->setUsuario($this->getReference('Usuario-00000000006'));
        $chatMensagem->setComponenteDigital($this->getReference('ComponenteDigital-MODELO DESPACHO DE APROVAÇÃO'));
        $chatMensagem->setMensagem('MENSAGEM 0005');

        // Persist entity
        $this->manager->persist($chatMensagem);

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
