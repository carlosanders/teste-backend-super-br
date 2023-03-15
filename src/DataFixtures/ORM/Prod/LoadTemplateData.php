<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Prod/LoadTemplateData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Prod;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\Template;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadTemplateData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadTemplateData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $template = new Template();
        $template->setNome('DESPACHO');
        $template->setDescricao('DESPACHO');
        $template->setAtivo(true);
        $template->setModalidadeTemplate($this->getReference('ModalidadeTemplate-ADMINISTRATIVO'));
        $template->setDocumento($this->getReference('Documento-TEMPLATE DESPACHO'));

        $this->manager->persist($template);

        $this->addReference(
            'Template-DESPACHO',
            $template
        );

        $template = new Template();
        $template->setNome('OFÍCIO');
        $template->setDescricao('OFÍCIO');
        $template->setAtivo(true);
        $template->setModalidadeTemplate($this->getReference('ModalidadeTemplate-ADMINISTRATIVO'));
        $template->setDocumento($this->getReference('Documento-TEMPLATE OFÍCIO'));

        $this->manager->persist($template);

        $this->addReference(
            'Template-OFÍCIO',
            $template
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
        return ['prod', 'dev', 'test'];
    }
}
