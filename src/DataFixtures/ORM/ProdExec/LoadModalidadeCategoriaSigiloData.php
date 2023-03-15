<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/ProdExec/LoadModalidadeCategoriaSigiloData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\ProdExec;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\ModalidadeCategoriaSigilo;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadModalidadeCategoriaSigiloData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadModalidadeCategoriaSigiloData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $modalidadeCategoriaSigilo = new ModalidadeCategoriaSigilo();
        $modalidadeCategoriaSigilo->setValor('AGRICULTURA, EXTRATIVISMO E PESCA');
        $modalidadeCategoriaSigilo->setDescricao('AGRICULTURA, EXTRATIVISMO E PESCA');

        $this->manager->persist($modalidadeCategoriaSigilo);

        $this->addReference('ModalidadeCategoriaSigilo-'.$modalidadeCategoriaSigilo->getValor(), $modalidadeCategoriaSigilo);

        $modalidadeCategoriaSigilo = new ModalidadeCategoriaSigilo();
        $modalidadeCategoriaSigilo->setValor('CIÊNCIA, INFORMAÇÃO E COMUNICAÇÃO');
        $modalidadeCategoriaSigilo->setDescricao('CIÊNCIA, INFORMAÇÃO E COMUNICAÇÃO');

        $this->manager->persist($modalidadeCategoriaSigilo);

        $this->addReference('ModalidadeCategoriaSigilo-'.$modalidadeCategoriaSigilo->getValor(), $modalidadeCategoriaSigilo);

        $modalidadeCategoriaSigilo = new ModalidadeCategoriaSigilo();
        $modalidadeCategoriaSigilo->setValor('COMÉRCIO, SERVIÇOS E TURISMO');
        $modalidadeCategoriaSigilo->setDescricao('COMÉRCIO, SERVIÇOS E TURISMO');

        $this->manager->persist($modalidadeCategoriaSigilo);

        $this->addReference('ModalidadeCategoriaSigilo-'.$modalidadeCategoriaSigilo->getValor(), $modalidadeCategoriaSigilo);

        $modalidadeCategoriaSigilo = new ModalidadeCategoriaSigilo();
        $modalidadeCategoriaSigilo->setValor('CULTURA, LAZER E ESPORTE');
        $modalidadeCategoriaSigilo->setDescricao('CULTURA, LAZER E ESPORTE');

        $this->manager->persist($modalidadeCategoriaSigilo);

        $this->addReference('ModalidadeCategoriaSigilo-'.$modalidadeCategoriaSigilo->getValor(), $modalidadeCategoriaSigilo);

        $modalidadeCategoriaSigilo = new ModalidadeCategoriaSigilo();
        $modalidadeCategoriaSigilo->setValor('DEFESA E SEGURANÇA');
        $modalidadeCategoriaSigilo->setDescricao('DEFESA E SEGURANÇA');

        $this->manager->persist($modalidadeCategoriaSigilo);

        $this->addReference('ModalidadeCategoriaSigilo-'.$modalidadeCategoriaSigilo->getValor(), $modalidadeCategoriaSigilo);

        $modalidadeCategoriaSigilo = new ModalidadeCategoriaSigilo();
        $modalidadeCategoriaSigilo->setValor('ECONOMIA E FINANÇAS');
        $modalidadeCategoriaSigilo->setDescricao('ECONOMIA E FINANÇAS');

        $this->manager->persist($modalidadeCategoriaSigilo);

        $this->addReference('ModalidadeCategoriaSigilo-'.$modalidadeCategoriaSigilo->getValor(), $modalidadeCategoriaSigilo);

        $modalidadeCategoriaSigilo = new ModalidadeCategoriaSigilo();
        $modalidadeCategoriaSigilo->setValor('EDUCAÇÃO');
        $modalidadeCategoriaSigilo->setDescricao('EDUCAÇÃO');

        $this->manager->persist($modalidadeCategoriaSigilo);

        $this->addReference('ModalidadeCategoriaSigilo-'.$modalidadeCategoriaSigilo->getValor(), $modalidadeCategoriaSigilo);

        $modalidadeCategoriaSigilo = new ModalidadeCategoriaSigilo();
        $modalidadeCategoriaSigilo->setValor('GOVERNO E POLÍTICA');
        $modalidadeCategoriaSigilo->setDescricao('GOVERNO E POLÍTICA');

        $this->manager->persist($modalidadeCategoriaSigilo);

        $this->addReference('ModalidadeCategoriaSigilo-'.$modalidadeCategoriaSigilo->getValor(), $modalidadeCategoriaSigilo);

        $modalidadeCategoriaSigilo = new ModalidadeCategoriaSigilo();
        $modalidadeCategoriaSigilo->setValor('HABITAÇÃO, SANEAMENTO E URBANISMO');
        $modalidadeCategoriaSigilo->setDescricao('HABITAÇÃO, SANEAMENTO E URBANISMO');

        $this->manager->persist($modalidadeCategoriaSigilo);

        $this->addReference('ModalidadeCategoriaSigilo-'.$modalidadeCategoriaSigilo->getValor(), $modalidadeCategoriaSigilo);

        $modalidadeCategoriaSigilo = new ModalidadeCategoriaSigilo();
        $modalidadeCategoriaSigilo->setValor('INDÚSTRIA');
        $modalidadeCategoriaSigilo->setDescricao('INDÚSTRIA');

        $this->manager->persist($modalidadeCategoriaSigilo);

        $this->addReference('ModalidadeCategoriaSigilo-'.$modalidadeCategoriaSigilo->getValor(), $modalidadeCategoriaSigilo);

        $modalidadeCategoriaSigilo = new ModalidadeCategoriaSigilo();
        $modalidadeCategoriaSigilo->setValor('JUSTIÇA E LEGISLAÇÃO');
        $modalidadeCategoriaSigilo->setDescricao('JUSTIÇA E LEGISLAÇÃO');

        $this->manager->persist($modalidadeCategoriaSigilo);

        $this->addReference('ModalidadeCategoriaSigilo-'.$modalidadeCategoriaSigilo->getValor(), $modalidadeCategoriaSigilo);

        $modalidadeCategoriaSigilo = new ModalidadeCategoriaSigilo();
        $modalidadeCategoriaSigilo->setValor('MEIO AMBIENTE');
        $modalidadeCategoriaSigilo->setDescricao('MEIO AMBIENTE');

        $this->manager->persist($modalidadeCategoriaSigilo);

        $this->addReference('ModalidadeCategoriaSigilo-'.$modalidadeCategoriaSigilo->getValor(), $modalidadeCategoriaSigilo);

        $modalidadeCategoriaSigilo = new ModalidadeCategoriaSigilo();
        $modalidadeCategoriaSigilo->setValor('PESSOA, FAMÍLIA E SOCIEDADE');
        $modalidadeCategoriaSigilo->setDescricao('PESSOA, FAMÍLIA E SOCIEDADE');

        $this->manager->persist($modalidadeCategoriaSigilo);

        $this->addReference('ModalidadeCategoriaSigilo-'.$modalidadeCategoriaSigilo->getValor(), $modalidadeCategoriaSigilo);

        $modalidadeCategoriaSigilo = new ModalidadeCategoriaSigilo();
        $modalidadeCategoriaSigilo->setValor('RELAÇÕES INTERNACIONAIS');
        $modalidadeCategoriaSigilo->setDescricao('RELAÇÕES INTERNACIONAIS');

        $this->manager->persist($modalidadeCategoriaSigilo);

        $this->addReference('ModalidadeCategoriaSigilo-'.$modalidadeCategoriaSigilo->getValor(), $modalidadeCategoriaSigilo);

        $modalidadeCategoriaSigilo = new ModalidadeCategoriaSigilo();
        $modalidadeCategoriaSigilo->setValor('SAÚDE');
        $modalidadeCategoriaSigilo->setDescricao('SAÚDE');

        $this->manager->persist($modalidadeCategoriaSigilo);

        $this->addReference('ModalidadeCategoriaSigilo-'.$modalidadeCategoriaSigilo->getValor(), $modalidadeCategoriaSigilo);

        $modalidadeCategoriaSigilo = new ModalidadeCategoriaSigilo();
        $modalidadeCategoriaSigilo->setValor('TRABALHO');
        $modalidadeCategoriaSigilo->setDescricao('TRABALHO');

        $this->manager->persist($modalidadeCategoriaSigilo);

        $this->addReference('ModalidadeCategoriaSigilo-'.$modalidadeCategoriaSigilo->getValor(), $modalidadeCategoriaSigilo);

        $modalidadeCategoriaSigilo = new ModalidadeCategoriaSigilo();
        $modalidadeCategoriaSigilo->setValor('TRANSPORTES E TRÂNSITO');
        $modalidadeCategoriaSigilo->setDescricao('TRANSPORTES E TRÂNSITO');

        $this->manager->persist($modalidadeCategoriaSigilo);

        $this->addReference('ModalidadeCategoriaSigilo-'.$modalidadeCategoriaSigilo->getValor(), $modalidadeCategoriaSigilo);

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
        return ['prodexec'];
    }
}
