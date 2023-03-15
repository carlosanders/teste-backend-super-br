<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Test/LoadPessoaData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Test;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\Pessoa;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadPessoaData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadPessoaData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $pessoa = new Pessoa();
        $pessoa->setPessoaValidada(true);
        $pessoa->setPessoaConveniada(false);
        $pessoa->setNome('PESSOA 1');
        $pessoa->setModalidadeQualificacaoPessoa($this->getReference('ModalidadeQualificacaoPessoa-PESSOA FÍSICA'));
        $pessoa->setNumeroDocumentoPrincipal('12312312387');

        // Persist entity
        $this->manager->persist($pessoa);

        // Create reference for later usage
        $this->addReference(
            'Pessoa-'.$pessoa->getNumeroDocumentoPrincipal(),
            $pessoa
        );

        $pessoa = new Pessoa();
        $pessoa->setPessoaValidada(false);
        $pessoa->setPessoaConveniada(false);
        $pessoa->setNome('PESSOA 2');
        $pessoa->setModalidadeQualificacaoPessoa($this->getReference('ModalidadeQualificacaoPessoa-PESSOA FÍSICA'));
        $pessoa->setNumeroDocumentoPrincipal('12312312355');

        // Persist entity
        $this->manager->persist($pessoa);

        // Create reference for later usage
        $this->addReference(
            'Pessoa-'.$pessoa->getNumeroDocumentoPrincipal(),
            $pessoa
        );

        $pessoa = new Pessoa();
        $pessoa->setPessoaValidada(false);
        $pessoa->setPessoaConveniada(false);
        $pessoa->setNome('PESSOA 3');
        $pessoa->setModalidadeQualificacaoPessoa($this->getReference('ModalidadeQualificacaoPessoa-PESSOA FÍSICA'));
        $pessoa->setNumeroDocumentoPrincipal('30520186044');

        // Persist entity
        $this->manager->persist($pessoa);

        // Create reference for later usage
        $this->addReference(
            'Pessoa-'.$pessoa->getNumeroDocumentoPrincipal(),
            $pessoa
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
        return 2;
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
