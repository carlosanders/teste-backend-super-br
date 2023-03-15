<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Prod/LoadModalidadeVinculacaoProcessoData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Test;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\Notificacao;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadNotificacaoData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadNotificacaoData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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
    public function load(\Doctrine\Persistence\ObjectManager $manager): void
    {
        $this->manager = $manager;

        $dataExpiracao1 = new \DateTime('now +1 day');
        $notificacao = new Notificacao();
        $notificacao->setConteudo('CONTEÚDO 1');
        $notificacao->setContexto(null);
        $notificacao->setUrgente(false);
        $notificacao->setDestinatario($this->getReference('Usuario-00000000004'));
        $notificacao->setRemetente(null);
        $notificacao->setModalidadeNotificacao($this->getReference('ModalidadeNotificacao-SISTEMA'));
        $notificacao->setDataHoraExpiracao($dataExpiracao1);
        $this->manager->persist($notificacao);

        $this->addReference('Notificacao-'.$notificacao->getConteudo(), $notificacao);

        $dataExpiracao2 = new \DateTime('now +2 day');
        $notificacao = new Notificacao();
        $notificacao->setConteudo('CONTEÚDO 2');
        $notificacao->setContexto(null);
        $notificacao->setUrgente(false);
        $notificacao->setDestinatario($this->getReference('Usuario-00000000004'));
        $notificacao->setRemetente(null);
        $notificacao->setModalidadeNotificacao($this->getReference('ModalidadeNotificacao-SISTEMA'));
        $notificacao->setDataHoraExpiracao($dataExpiracao2);
        $this->manager->persist($notificacao);

        $this->addReference('Notificacao-'.$notificacao->getConteudo(), $notificacao);

        $dataExpiracao3 = new \DateTime('now +3 day');
        $notificacao = new Notificacao();
        $notificacao->setConteudo('CONTEÚDO 3');
        $notificacao->setContexto(null);
        $notificacao->setUrgente(false);
        $notificacao->setDestinatario($this->getReference('Usuario-00000000004'));
        $notificacao->setRemetente(null);
        $notificacao->setModalidadeNotificacao($this->getReference('ModalidadeNotificacao-SISTEMA'));
        $notificacao->setDataHoraExpiracao($dataExpiracao3);
        $this->manager->persist($notificacao);

        $this->addReference('Notificacao-'.$notificacao->getConteudo(), $notificacao);

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
