<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Test/LoadContaEmailData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Test;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\ContaEmail;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadContaEmailData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadContaEmailData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $contaEmail = new ContaEmail();
        $contaEmail->setServidorEmail($this->getReference('ServidorEmail-Nome 1'));
        $contaEmail->setSetor($this->getReference('Setor-SECRETARIA-1-SECR'));
        $contaEmail->setAtivo(true);
        $contaEmail->setLogin('LOGIN');
        $contaEmail->setSenha('PASS');
        $contaEmail->setNome('NOME');
        $contaEmail->setDescricao('DESCRIÇÃO');

        // Persist entity
        $this->manager->persist($contaEmail);

        // Flush database changes
        $this->manager->flush();
    }

    /**
     * Get the order of this fixture.
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
