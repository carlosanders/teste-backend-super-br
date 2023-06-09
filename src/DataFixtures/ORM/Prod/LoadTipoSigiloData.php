<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Prod/LoadTipoSigiloData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Prod;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\TipoSigilo;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadTipoSigiloData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadTipoSigiloData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $tipoSigilo = new TipoSigilo();
        $tipoSigilo->setNome('SIGILO LEGAL');
        $tipoSigilo->setDescricao('SIGILO LEGAL');
        $tipoSigilo->setNivelAcesso(1);
        $tipoSigilo->setLeiAcessoInformacao(false);
        $tipoSigilo->setPrazoAnos(100);

        $this->manager->persist($tipoSigilo);

        $this->addReference('TipoSigilo-'.$tipoSigilo->getNome(), $tipoSigilo);

        $tipoSigilo = new TipoSigilo();
        $tipoSigilo->setNome('SIGILO JUDICIAL');
        $tipoSigilo->setDescricao('SIGILO JUDICIAL');
        $tipoSigilo->setNivelAcesso(1);
        $tipoSigilo->setLeiAcessoInformacao(false);
        $tipoSigilo->setPrazoAnos(100);

        $this->manager->persist($tipoSigilo);

        $this->addReference('TipoSigilo-'.$tipoSigilo->getNome(), $tipoSigilo);

        $tipoSigilo = new TipoSigilo();
        $tipoSigilo->setNome('SIGILO INTIMIDADE, VIDA PRIVADA, HONRA E IMAGEM');
        $tipoSigilo->setDescricao('SIGILO INTIMIDADE, VIDA PRIVADA, HONRA E IMAGEM');
        $tipoSigilo->setNivelAcesso(1);
        $tipoSigilo->setLeiAcessoInformacao(false);
        $tipoSigilo->setPrazoAnos(100);

        $this->manager->persist($tipoSigilo);

        $this->addReference('TipoSigilo-'.$tipoSigilo->getNome(), $tipoSigilo);

        $tipoSigilo = new TipoSigilo();
        $tipoSigilo->setNome('RESERVADO (LAI)');
        $tipoSigilo->setDescricao('RESERVADO (LAI)');
        $tipoSigilo->setNivelAcesso(2);
        $tipoSigilo->setLeiAcessoInformacao(true);
        $tipoSigilo->setPrazoAnos(5);

        $this->manager->persist($tipoSigilo);

        $this->addReference('TipoSigilo-'.$tipoSigilo->getNome(), $tipoSigilo);

        $tipoSigilo = new TipoSigilo();
        $tipoSigilo->setNome('SECRETO (LAI)');
        $tipoSigilo->setDescricao('SECRETO (LAI)');
        $tipoSigilo->setNivelAcesso(3);
        $tipoSigilo->setLeiAcessoInformacao(true);
        $tipoSigilo->setPrazoAnos(15);

        $this->manager->persist($tipoSigilo);

        $this->addReference('TipoSigilo-'.$tipoSigilo->getNome(), $tipoSigilo);

        $tipoSigilo = new TipoSigilo();
        $tipoSigilo->setNome('ULTRASSECRETO (LAI)');
        $tipoSigilo->setDescricao('ULTRASSECRETO (LAI)');
        $tipoSigilo->setNivelAcesso(4);
        $tipoSigilo->setLeiAcessoInformacao(true);
        $tipoSigilo->setPrazoAnos(25);

        $this->manager->persist($tipoSigilo);

        $this->addReference('TipoSigilo-'.$tipoSigilo->getNome(), $tipoSigilo);

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
        return ['prod', 'dev', 'test'];
    }
}
