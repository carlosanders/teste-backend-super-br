<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Test/LoadInteressadoData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Test;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\Interessado;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadInteressadoData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadInteressadoData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $interessado = new Interessado();
        $interessado->setPessoa($this->getReference('Pessoa-12312312355'));
        $interessado->setProcesso($this->getReference('Processo-TESTE_1'));
        $interessado->setOrigemDados($this->getReference('OrigemDados-FONTE_DADOS_1'));
        $interessado->setModalidadeInteressado($this->getReference('ModalidadeInteressado-TERCEIRO'));

        $this->manager->persist($interessado);

        $this->addReference(
            'Interessado-'.$interessado->getPessoa()->getNumeroDocumentoPrincipal(),
            $interessado
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
        return ['test'];
    }
}
