<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Prod/LoadConfiguracaoNupData.php.
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Prod;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\TipoContato;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadTipoContatoData.
 */
class LoadTipoContatoData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $data = [
            [
                'nome' => 'UNIDADE',
                'descricao' => 'UNIDADE',
                'ativo' => true,
            ],
            [
                'nome' => 'SETOR',
                'descricao' => 'SETOR',
                'ativo' => true,
            ],
            [
                'nome' => 'USUÁRIO',
                'descricao' => 'USUÁRIO',
                'ativo' => true,
            ],
        ];

        foreach ($data as $item) {
            $tipoContato = (new TipoContato())
                ->setNome($item['nome'])
                ->setDescricao($item['descricao'])
                ->setAtivo($item['ativo']);

            $this->addReference('TipoContato-'.$tipoContato->getNome(), $tipoContato);
            $this->manager->persist($tipoContato);
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
        return ['prod', 'dev', 'test', '1.3.0'];
    }
}
