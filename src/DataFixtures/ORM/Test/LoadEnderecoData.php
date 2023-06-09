<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Test/LoadEnderecoData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Test;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\Endereco;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadEnderecoData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadEnderecoData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $endereco = new Endereco();
        $endereco->setMunicipio($this->getReference('Municipio-SÃO PAULO-SP'));
        $endereco->setPais($this->getReference('Pais-BR'));
        $endereco->setPessoa($this->getReference('Pessoa-12312312355'));
        $endereco->setOrigemDados($this->getReference('OrigemDados-FONTE_DADOS_1'));
        $endereco->setBairro('VILA ROMANA');
        $endereco->setLogradouro('RUA VESPASIANO');
        $endereco->setNumero('178');
        $endereco->setCep('05044-050');
        $endereco->setObservacao('TESTE');
        $endereco->setPrincipal(true);

        // Persist entity
        $this->manager->persist($endereco);

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
