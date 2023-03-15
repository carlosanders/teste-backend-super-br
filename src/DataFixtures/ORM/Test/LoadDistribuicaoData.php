<?php

declare(strict_types=1);

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Test;

use BadMethodCallException;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use SuppCore\AdministrativoBackend\Entity\Distribuicao;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;

/**
 * Class LoadDistribuicaoData.
 *
 * @author Felipe Pena <felipe.pena@datainfo.inf.br>
 */
class LoadDistribuicaoData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var ObjectManager
     */
    private $manager;

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
     * Load data fixtures with the passed EntityManager.
     *
     * @param ObjectManager $manager
     *
     * @throws BadMethodCallException
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     * @throws ServiceCircularReferenceException
     * @throws ServiceNotFoundException
     * @throws Exception
     */
    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;

        $distribuicao = new Distribuicao();

        $distribuicao->setSetorAnterior(null);
        $distribuicao->setLivreBalanceamento(false);
        $distribuicao->setDistribuicaoAutomatica(false);
        $distribuicao->setDataHoraDistribuicao(\DateTime::createFromFormat('Y-m-d h:i:s', '2021-12-01 08:00:00'));
        $distribuicao->setAuditoriaDistribuicao(null);
        $distribuicao->setTarefa($this->getReference('Tarefa-TESTE_USER_LEVEL'));
        $distribuicao->setUsuarioAnterior(null);
        $distribuicao->setUsuarioPosterior($this->getReference('Usuario-00000000007'));
        $distribuicao->setSetorAnterior(null);
        $distribuicao->setSetorPosterior($this->getReference('Unidade-ADVOCACIA-GERAL DA UNIÃO'));
        $distribuicao->setTipoDistribuicao(1);

        $this->manager->persist($distribuicao);

        if (!$this->hasReference('Distribuicao-1')) {
            $this->addReference('Distribuicao-1', $distribuicao);
        }

        $distribuicao = new Distribuicao();

        $distribuicao->setLivreBalanceamento(false);
        $distribuicao->setDistribuicaoAutomatica(false);
        $distribuicao->setDataHoraDistribuicao(\DateTime::createFromFormat('Y-m-d h:i:s', '2021-12-01 08:00:00'));
        $distribuicao->setAuditoriaDistribuicao('Auditoria Distribuição 2');
        $distribuicao->setTarefa($this->getReference('Tarefa-TESTE_1'));
        $distribuicao->setUsuarioAnterior(null);
        $distribuicao->setUsuarioPosterior($this->getReference('Usuario-00000000008'));
        $distribuicao->setSetorAnterior(null);
        $distribuicao->setSetorPosterior($this->getReference('Unidade-CONSULTORIA-GERAL DA UNIÃO'));
        $distribuicao->setTipoDistribuicao(2);

        $this->manager->persist($distribuicao);

        if (!$this->hasReference('Distribuicao-2')) {
            $this->addReference('Distribuicao-2', $distribuicao);
        }

        $distribuicao = new Distribuicao();

        $distribuicao->setLivreBalanceamento(false);
        $distribuicao->setDistribuicaoAutomatica(false);
        $distribuicao->setDataHoraDistribuicao(\DateTime::createFromFormat('Y-m-d h:i:s', '2021-12-01 08:00:00'));
        $distribuicao->setAuditoriaDistribuicao('Auditoria Distribuição 3');
        $distribuicao->setTarefa($this->getReference('Tarefa-TESTE_SEM_ATIVIDADE'));
        $distribuicao->setUsuarioAnterior(null);
        $distribuicao->setUsuarioPosterior($this->getReference('Usuario-00000000010'));
        $distribuicao->setSetorAnterior(null);
        $distribuicao->setSetorPosterior($this->getReference('Unidade-ADVOCACIA-GERAL DA UNIÃO'));
        $distribuicao->setTipoDistribuicao(3);

        $this->manager->persist($distribuicao);

        if (!$this->hasReference('Distribuicao-3')) {
            $this->addReference('Distribuicao-3', $distribuicao);
        }

        $distribuicao = new Distribuicao();

        $distribuicao->setLivreBalanceamento(false);
        $distribuicao->setDistribuicaoAutomatica(false);
        $distribuicao->setDataHoraDistribuicao(\DateTime::createFromFormat('Y-m-d h:i:s', '2021-12-01 08:00:00'));
        $distribuicao->setAuditoriaDistribuicao('Auditoria Distribuição 4');
        $distribuicao->setTarefa($this->getReference('Tarefa-TESTE_SEM_ATIVIDADE'));
        $distribuicao->setUsuarioAnterior(null);
        $distribuicao->setUsuarioPosterior($this->getReference('Usuario-00000000010'));
        $distribuicao->setSetorAnterior(null);
        $distribuicao->setSetorPosterior($this->getReference('Unidade-ADVOCACIA-GERAL DA UNIÃO'));
        $distribuicao->setTipoDistribuicao(4);

        $this->manager->persist($distribuicao);

        if (!$this->hasReference('Distribuicao-4')) {
            $this->addReference('Distribuicao-4', $distribuicao);
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
        return 6;
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
