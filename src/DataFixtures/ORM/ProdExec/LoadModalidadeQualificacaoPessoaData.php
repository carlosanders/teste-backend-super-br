<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/ProdExec/LoadModalidadeQualificacaoPessoaData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\ProdExec;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\ModalidadeQualificacaoPessoa;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadModalidadeQualificacaoPessoaData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadModalidadeQualificacaoPessoaData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $modalidadeQualificacaoPessoa = new ModalidadeQualificacaoPessoa();
        $modalidadeQualificacaoPessoa->setValor('PESSOA FÍSICA');
        $modalidadeQualificacaoPessoa->setDescricao('PESSOA FÍSICA');

        $this->manager->persist($modalidadeQualificacaoPessoa);

        $this->addReference(
            'ModalidadeQualificacaoPessoa-'.$modalidadeQualificacaoPessoa->getValor(),
            $modalidadeQualificacaoPessoa
        );

        $modalidadeQualificacaoPessoa = new ModalidadeQualificacaoPessoa();
        $modalidadeQualificacaoPessoa->setValor('PESSOA JURÍDICA');
        $modalidadeQualificacaoPessoa->setDescricao('PESSOA JURÍDICA');

        $this->manager->persist($modalidadeQualificacaoPessoa);

        $this->addReference(
            'ModalidadeQualificacaoPessoa-'.$modalidadeQualificacaoPessoa->getValor(),
            $modalidadeQualificacaoPessoa
        );

        $modalidadeQualificacaoPessoa = new ModalidadeQualificacaoPessoa();
        $modalidadeQualificacaoPessoa->setValor('AUTORIDADE');
        $modalidadeQualificacaoPessoa->setDescricao('AUTORIDADE');

        $this->manager->persist($modalidadeQualificacaoPessoa);

        $this->addReference(
            'ModalidadeQualificacaoPessoa-'.$modalidadeQualificacaoPessoa->getValor(),
            $modalidadeQualificacaoPessoa
        );

        $modalidadeQualificacaoPessoa = new ModalidadeQualificacaoPessoa();
        $modalidadeQualificacaoPessoa->setValor('ÓRGÃO REPRESENTAÇÃO');
        $modalidadeQualificacaoPessoa->setDescricao('ÓRGÃO REPRESENTAÇÃO');

        $this->manager->persist($modalidadeQualificacaoPessoa);

        $this->addReference(
            'ModalidadeQualificacaoPessoa-'.$modalidadeQualificacaoPessoa->getValor(),
            $modalidadeQualificacaoPessoa
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
