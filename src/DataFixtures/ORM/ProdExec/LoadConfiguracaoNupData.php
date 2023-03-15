<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/ProdExec/LoadConfiguracaoNupData.php.
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\ProdExec;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\ConfiguracaoNup;
use SuppCore\AdministrativoBackend\NUP\NUPProviderManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadConfiguracaoNupData.
 */
class LoadConfiguracaoNupData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
{
    private ContainerInterface $container;
    private ObjectManager $manager;
    private ?NUPProviderManager $nupProviderManager = null;

    /**
     * Setter for container.
     *
     * @param ContainerInterface|null $container
     */
    public function setContainer(?ContainerInterface $container = null): void
    {
        if (null !== $container) {
            $this->container = $container;
            $this->nupProviderManager = $container->get('SuppCore\AdministrativoBackend\NUP\NUPProviderManager');
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
        foreach ($this->nupProviderManager->getAllNupProviders() as $provider) {
            $configuracaoNup = new ConfiguracaoNup();
            $configuracaoNup->setNome($provider->getNome());
            $configuracaoNup->setDescricao($provider->getDescricao());
            $configuracaoNup->setSigla($provider->getSigla());
            $configuracaoNup->setDataHoraInicioVigencia($provider->getDataHoraInicioVigencia());
            $configuracaoNup->setDataHoraFimVigencia($provider->getDataHoraFimVigencia());
            $this->manager->persist($configuracaoNup);
            $this->addReference('ConfiguracaoNup-'.$configuracaoNup->getNome(), $configuracaoNup);
        }

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
        return 1;
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
