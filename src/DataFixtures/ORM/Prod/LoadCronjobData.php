<?php

declare(strict_types=1);

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Prod;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\Cronjob;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadCredorData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadCronjobData extends Fixture implements
    OrderedFixtureInterface,
    ContainerAwareInterface,
    FixtureGroupInterface
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

        $cronjob1 = new Cronjob();
        $cronjob1->setComando('/usr/bin/php bin/console supp:administrativo:datalake:kafka');
        $cronjob1->setSincrono(false);
        $cronjob1->setPeriodicidade('30 * * * *');
        $cronjob1->setNome("Busca dossiês do Datalake");
        $cronjob1->setDescricao('Realiza a verificação de dados prontos junto ao Datalake');
        $cronjob1->setAtivo(true);
        $this->manager->persist($cronjob1);
        $this->addReference(
            'Cronjob-'.$cronjob1->getNome(),
            $cronjob1
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
        return [
            'prod', 'dev', 'test',
            'cronjob-datalake-prod',
            'cronjob-datalake-dev',
            'cronjob-datalake-test'
        ];
    }
}
