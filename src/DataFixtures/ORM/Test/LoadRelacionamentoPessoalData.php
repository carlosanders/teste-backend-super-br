<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Test/LoadRelacionamentoPessoalData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Test;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\RelacionamentoPessoal;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadRelacionamentoPessoalData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadRelacionamentoPessoalData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $relacionamentoPessoal = new RelacionamentoPessoal();
        $relacionamentoPessoal->setPessoa($this->getReference('Pessoa-12312312355'));
        $relacionamentoPessoal->setPessoaRelacionada($this->getReference('Pessoa-12312312387'));
        $relacionamentoPessoal->setOrigemDados($this->getReference('OrigemDados-FONTE_DADOS_1'));
        $relacionamentoPessoal->setModalidadeRelacionamentoPessoal($this->getReference('ModalidadeRelacionamentoPessoal-CURADORIA'));

        // Persist entity
        $this->manager->persist($relacionamentoPessoal);

        // Flush database changes
        $this->manager->flush();
    }

    /**
     * Get the order of this fixture.
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
