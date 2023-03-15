<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Test/LoadDesentranhamentoData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Test;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\Desentranhamento;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadDesentranhamentoData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadDesentranhamentoData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface
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

        $desentranhamento = new Desentranhamento();
        $desentranhamento->setJuntada($this->getReference('Juntada-TESTE_11'));
        $desentranhamento->setProcessoDestino($this->getReference('Processo-TESTE_1'));

        // Persist entity
        $this->manager->persist($desentranhamento);

        // Flush database changes
        $this->manager->flush();
    }

    /**
     * Get the order of this fixture.
     */
    public function getOrder(): int
    {
        return 7;
    }
}
