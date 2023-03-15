<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Prod/LoadServidorEmailData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Test;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\ServidorEmail;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadServidorEmailData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadServidorEmailData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $servidorEmail = new ServidorEmail();
        $servidorEmail->setDescricao('Descrição 1');
        $servidorEmail->setNome('Nome 1');
        $servidorEmail->setHost('Host 1');
        $servidorEmail->setPorta(587);
        $servidorEmail->setProtocolo('IMAP');
        $servidorEmail->setMetodoEncriptacao('SMTP STARTTLS ');
        $servidorEmail->setAtivo(false);
        $servidorEmail->setValidaCertificado(false);
        $servidorEmail->setCriadoEm(new \DateTime('now'));
        $servidorEmail->setCriadoPor($this->getReference('Usuario-00000000004'));

        $this->manager->persist($servidorEmail);

        $this->addReference('ServidorEmail-'.$servidorEmail->getNome(), $servidorEmail);

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
