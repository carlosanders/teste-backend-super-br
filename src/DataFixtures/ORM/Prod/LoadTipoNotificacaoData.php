<?php

/** @noinspection ProblematicWhitespace */

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Prod/LoadTipoRelatorioData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Prod;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\TipoNotificacao;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadTipoRelatorioData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadTipoNotificacaoData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $tipoNotificacao = new TipoNotificacao();
        $tipoNotificacao->setNome('PROCESSO');
        $tipoNotificacao->setDescricao('PROCESSO');
        $this->manager->persist($tipoNotificacao);

        $tipoNotificacao = new TipoNotificacao();
        $tipoNotificacao->setNome('TAREFA');
        $tipoNotificacao->setDescricao('TAREFA');
        $this->manager->persist($tipoNotificacao);

        $tipoNotificacao = new TipoNotificacao();
        $tipoNotificacao->setNome('RELATORIO');
        $tipoNotificacao->setDescricao('RELATORIO');
        $this->manager->persist($tipoNotificacao);

        $this->manager->flush();
    }

    /**
     * Get the order of this fixture.
     *
     * @return int
     */
    public function getOrder(): int
    {
        return 3;
    }

    /**
     * This method must return an array of groups
     * on which the implementing class belongs to.
     *
     * @return string[]
     */
    public static function getGroups(): array
    {
        return ['prod', 'dev', 'test', '1.4.0'];
    }
}
