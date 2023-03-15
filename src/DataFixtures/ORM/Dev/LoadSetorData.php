<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Dev/LoadSetorData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Dev;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\Setor;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadSetorData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadSetorData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $setor = new Setor();
        $setor->setNome('ADVOCACIA-GERAL DA UNIÃO');
        $setor->setSigla('AGU-SEDE');
        $setor->setPrefixoNUP('00400');
        $setor->setSequenciaInicialNUP(1);
        $setor->setGeneroSetor($this->getReference('GeneroSetor-ADMINISTRATIVO'));

        $setor->setMunicipio($this->getReference('Municipio-BRASÍLIA-DF'));
        $setor->setModalidadeOrgaoCentral($this->getReference('ModalidadeOrgaoCentral-AGU'));

        $this->manager->persist($setor);

        $this->addReference(
            'Unidade-'.$setor->getNome(),
            $setor
        );

        $this->manager->flush();

        $setor->setUnidade($this->getReference('Unidade-'.$setor->getNome()));

        $this->manager->persist($setor);

        $this->manager->flush();

        $setor = new Setor();
        $setor->setNome('PROTOCOLO');
        $setor->setSigla('PROT');
        $setor->setPrefixoNUP('00400');
        $setor->setSequenciaInicialNUP(1);
        $setor->setEspecieSetor($this->getReference('EspecieSetor-PROTOCOLO'));
        $setor->setUnidade($this->getReference('Unidade-ADVOCACIA-GERAL DA UNIÃO'));
        $setor->setParent($this->getReference('Unidade-ADVOCACIA-GERAL DA UNIÃO'));
        $setor->setMunicipio($this->getReference('Municipio-BRASÍLIA-DF'));

        $this->manager->persist($setor);

        $this->addReference(
            'Setor-'.$setor->getNome().'-'.$setor->getUnidade()->getSigla(),
            $setor
        );

        $setor = new Setor();
        $setor->setNome('ARQUIVO');
        $setor->setSigla('ARQU');
        $setor->setPrefixoNUP('00400');
        $setor->setSequenciaInicialNUP(1);
        $setor->setEspecieSetor($this->getReference('EspecieSetor-ARQUIVO'));
        $setor->setUnidade($this->getReference('Unidade-ADVOCACIA-GERAL DA UNIÃO'));
        $setor->setParent($this->getReference('Unidade-ADVOCACIA-GERAL DA UNIÃO'));
        $setor->setMunicipio($this->getReference('Municipio-BRASÍLIA-DF'));

        $this->manager->persist($setor);

        $this->addReference(
            'Setor-'.$setor->getNome().'-'.$setor->getUnidade()->getSigla(),
            $setor
        );

        $setor = new Setor();
        $setor->setNome('SECRETARIA');
        $setor->setSigla('SECR');
        $setor->setPrefixoNUP('00400');
        $setor->setSequenciaInicialNUP(1);
        $setor->setEspecieSetor($this->getReference('EspecieSetor-SECRETARIA'));
        $setor->setUnidade($this->getReference('Unidade-ADVOCACIA-GERAL DA UNIÃO'));
        $setor->setParent($this->getReference('Unidade-ADVOCACIA-GERAL DA UNIÃO'));
        $setor->setMunicipio($this->getReference('Municipio-BRASÍLIA-DF'));

        $this->manager->persist($setor);

        $this->addReference(
            'Setor-'.$setor->getNome().'-'.$setor->getUnidade()->getSigla(),
            $setor
        );

        $setor = new Setor();
        $setor->setNome('PROCURADORIA-GERAL FEDERAL');
        $setor->setSigla('PGF-SEDE');
        $setor->setPrefixoNUP('00407');
        $setor->setSequenciaInicialNUP(1);
        $setor->setGeneroSetor($this->getReference('GeneroSetor-ADMINISTRATIVO'));
        $setor->setUnidade($setor);
        $setor->setMunicipio($this->getReference('Municipio-BRASÍLIA-DF'));
        $setor->setModalidadeOrgaoCentral($this->getReference('ModalidadeOrgaoCentral-PGF'));

        $this->manager->persist($setor);

        $this->addReference(
            'Unidade-'.$setor->getNome(),
            $setor
        );

        $this->manager->flush();

        $setor->setUnidade($this->getReference('Unidade-'.$setor->getNome()));

        $this->manager->persist($setor);

        $this->manager->flush();

        $setor = new Setor();
        $setor->setNome('PROTOCOLO');
        $setor->setSigla('PROT');
        $setor->setPrefixoNUP('00400');
        $setor->setSequenciaInicialNUP(1);
        $setor->setEspecieSetor($this->getReference('EspecieSetor-PROTOCOLO'));
        $setor->setUnidade($this->getReference('Unidade-PROCURADORIA-GERAL FEDERAL'));
        $setor->setParent($this->getReference('Unidade-PROCURADORIA-GERAL FEDERAL'));
        $setor->setMunicipio($this->getReference('Municipio-BRASÍLIA-DF'));

        $this->manager->persist($setor);

        $this->addReference(
            'Setor-'.$setor->getNome().'-'.$setor->getUnidade()->getSigla(),
            $setor
        );

        $setor = new Setor();
        $setor->setNome('ARQUIVO');
        $setor->setSigla('ARQU');
        $setor->setPrefixoNUP('00400');
        $setor->setSequenciaInicialNUP(1);
        $setor->setEspecieSetor($this->getReference('EspecieSetor-ARQUIVO'));
        $setor->setUnidade($this->getReference('Unidade-PROCURADORIA-GERAL FEDERAL'));
        $setor->setParent($this->getReference('Unidade-PROCURADORIA-GERAL FEDERAL'));
        $setor->setMunicipio($this->getReference('Municipio-BRASÍLIA-DF'));

        $this->manager->persist($setor);

        $this->addReference(
            'Setor-'.$setor->getNome().'-'.$setor->getUnidade()->getSigla(),
            $setor
        );

        $setor = new Setor();
        $setor->setNome('SECRETARIA');
        $setor->setSigla('SECR');
        $setor->setPrefixoNUP('00400');
        $setor->setSequenciaInicialNUP(1);
        $setor->setEspecieSetor($this->getReference('EspecieSetor-SECRETARIA'));
        $setor->setUnidade($this->getReference('Unidade-PROCURADORIA-GERAL FEDERAL'));
        $setor->setParent($this->getReference('Unidade-PROCURADORIA-GERAL FEDERAL'));
        $setor->setMunicipio($this->getReference('Municipio-BRASÍLIA-DF'));

        $this->manager->persist($setor);

        $this->addReference(
            'Setor-'.$setor->getNome().'-'.$setor->getUnidade()->getSigla(),
            $setor
        );

        $setor = new Setor();
        $setor->setNome('CONSULTORIA-GERAL DA UNIÃO');
        $setor->setSigla('CGU-SEDE');
        $setor->setPrefixoNUP('00407');
        $setor->setSequenciaInicialNUP(1);
        $setor->setGeneroSetor($this->getReference('GeneroSetor-ADMINISTRATIVO'));
        $setor->setUnidade($setor);
        $setor->setMunicipio($this->getReference('Municipio-BRASÍLIA-DF'));
        $setor->setModalidadeOrgaoCentral($this->getReference('ModalidadeOrgaoCentral-CGU'));

        $this->manager->persist($setor);

        $this->addReference(
            'Unidade-'.$setor->getNome(),
            $setor
        );

        $this->manager->flush();

        $setor->setUnidade($this->getReference('Unidade-'.$setor->getNome()));

        $this->manager->persist($setor);

        $this->manager->flush();

        $setor = new Setor();
        $setor->setNome('PROTOCOLO');
        $setor->setSigla('PROT');
        $setor->setPrefixoNUP('00400');
        $setor->setSequenciaInicialNUP(1);
        $setor->setEspecieSetor($this->getReference('EspecieSetor-PROTOCOLO'));
        $setor->setUnidade($this->getReference('Unidade-CONSULTORIA-GERAL DA UNIÃO'));
        $setor->setParent($this->getReference('Unidade-CONSULTORIA-GERAL DA UNIÃO'));
        $setor->setMunicipio($this->getReference('Municipio-BRASÍLIA-DF'));

        $this->manager->persist($setor);

        $this->addReference(
            'Setor-'.$setor->getNome().'-'.$setor->getUnidade()->getSigla(),
            $setor
        );

        $setor = new Setor();
        $setor->setNome('ARQUIVO');
        $setor->setSigla('ARQU');
        $setor->setPrefixoNUP('00400');
        $setor->setSequenciaInicialNUP(1);
        $setor->setEspecieSetor($this->getReference('EspecieSetor-ARQUIVO'));
        $setor->setUnidade($this->getReference('Unidade-CONSULTORIA-GERAL DA UNIÃO'));
        $setor->setParent($this->getReference('Unidade-CONSULTORIA-GERAL DA UNIÃO'));
        $setor->setMunicipio($this->getReference('Municipio-BRASÍLIA-DF'));

        $this->manager->persist($setor);

        $this->addReference(
            'Setor-'.$setor->getNome().'-'.$setor->getUnidade()->getSigla(),
            $setor
        );

        $setor = new Setor();
        $setor->setNome('SECRETARIA');
        $setor->setSigla('SECR');
        $setor->setPrefixoNUP('00400');
        $setor->setSequenciaInicialNUP(1);
        $setor->setEspecieSetor($this->getReference('EspecieSetor-SECRETARIA'));
        $setor->setUnidade($this->getReference('Unidade-CONSULTORIA-GERAL DA UNIÃO'));
        $setor->setParent($this->getReference('Unidade-CONSULTORIA-GERAL DA UNIÃO'));
        $setor->setMunicipio($this->getReference('Municipio-BRASÍLIA-DF'));

        $this->manager->persist($setor);

        $this->addReference(
            'Setor-'.$setor->getNome().'-'.$setor->getUnidade()->getSigla(),
            $setor
        );

        $setor = new Setor();
        $setor->setNome('SECRETARIA-GERAL DE ADMINISTRAÇÃO');
        $setor->setSigla('SGA-SEDE');
        $setor->setPrefixoNUP('00407');
        $setor->setSequenciaInicialNUP(1);
        $setor->setGeneroSetor($this->getReference('GeneroSetor-ADMINISTRATIVO'));
        $setor->setUnidade($setor);
        $setor->setMunicipio($this->getReference('Municipio-BRASÍLIA-DF'));
        $setor->setModalidadeOrgaoCentral($this->getReference('ModalidadeOrgaoCentral-SGA'));

        $this->manager->persist($setor);

        $this->addReference(
            'Unidade-'.$setor->getNome(),
            $setor
        );

        $this->manager->flush();

        $setor->setUnidade($this->getReference('Unidade-'.$setor->getNome()));

        $this->manager->persist($setor);

        $this->manager->flush();

        $setor = new Setor();
        $setor->setNome('PROTOCOLO');
        $setor->setSigla('PROT');
        $setor->setPrefixoNUP('00400');
        $setor->setSequenciaInicialNUP(1);
        $setor->setEspecieSetor($this->getReference('EspecieSetor-PROTOCOLO'));
        $setor->setUnidade($this->getReference('Unidade-SECRETARIA-GERAL DE ADMINISTRAÇÃO'));
        $setor->setParent($this->getReference('Unidade-SECRETARIA-GERAL DE ADMINISTRAÇÃO'));
        $setor->setMunicipio($this->getReference('Municipio-BRASÍLIA-DF'));

        $this->manager->persist($setor);

        $this->addReference(
            'Setor-'.$setor->getNome().'-'.$setor->getUnidade()->getSigla(),
            $setor
        );

        $setor = new Setor();
        $setor->setNome('ARQUIVO');
        $setor->setSigla('ARQU');
        $setor->setPrefixoNUP('00400');
        $setor->setSequenciaInicialNUP(1);
        $setor->setEspecieSetor($this->getReference('EspecieSetor-ARQUIVO'));
        $setor->setUnidade($this->getReference('Unidade-SECRETARIA-GERAL DE ADMINISTRAÇÃO'));
        $setor->setParent($this->getReference('Unidade-SECRETARIA-GERAL DE ADMINISTRAÇÃO'));
        $setor->setMunicipio($this->getReference('Municipio-BRASÍLIA-DF'));

        $this->manager->persist($setor);

        $this->addReference(
            'Setor-'.$setor->getNome().'-'.$setor->getUnidade()->getSigla(),
            $setor
        );

        $setor = new Setor();
        $setor->setNome('SECRETARIA');
        $setor->setSigla('SECR');
        $setor->setPrefixoNUP('00400');
        $setor->setSequenciaInicialNUP(1);
        $setor->setEspecieSetor($this->getReference('EspecieSetor-SECRETARIA'));
        $setor->setUnidade($this->getReference('Unidade-SECRETARIA-GERAL DE ADMINISTRAÇÃO'));
        $setor->setParent($this->getReference('Unidade-SECRETARIA-GERAL DE ADMINISTRAÇÃO'));
        $setor->setMunicipio($this->getReference('Municipio-BRASÍLIA-DF'));

        $this->manager->persist($setor);

        $this->addReference(
            'Setor-'.$setor->getNome().'-'.$setor->getUnidade()->getSigla(),
            $setor
        );

        $setor = new Setor();
        $setor->setNome('PROCURADORIA-GERAL DA UNIÃO');
        $setor->setSigla('PGU-SEDE');
        $setor->setPrefixoNUP('00407');
        $setor->setSequenciaInicialNUP(1);
        $setor->setGeneroSetor($this->getReference('GeneroSetor-ADMINISTRATIVO'));
        $setor->setUnidade($setor);
        $setor->setMunicipio($this->getReference('Municipio-BRASÍLIA-DF'));
        $setor->setModalidadeOrgaoCentral($this->getReference('ModalidadeOrgaoCentral-PGU'));

        $this->manager->persist($setor);

        $this->addReference(
            'Unidade-'.$setor->getNome(),
            $setor
        );

        $this->manager->flush();

        $setor->setUnidade($this->getReference('Unidade-'.$setor->getNome()));

        $this->manager->persist($setor);

        $this->manager->flush();

        $setor = new Setor();
        $setor->setNome('PROTOCOLO');
        $setor->setSigla('PROT');
        $setor->setPrefixoNUP('00400');
        $setor->setSequenciaInicialNUP(1);
        $setor->setEspecieSetor($this->getReference('EspecieSetor-PROTOCOLO'));
        $setor->setUnidade($this->getReference('Unidade-PROCURADORIA-GERAL DA UNIÃO'));
        $setor->setParent($this->getReference('Unidade-PROCURADORIA-GERAL DA UNIÃO'));
        $setor->setMunicipio($this->getReference('Municipio-BRASÍLIA-DF'));

        $this->manager->persist($setor);

        $this->addReference(
            'Setor-'.$setor->getNome().'-'.$setor->getUnidade()->getSigla(),
            $setor
        );

        $setor = new Setor();
        $setor->setNome('ARQUIVO');
        $setor->setSigla('ARQU');
        $setor->setPrefixoNUP('00400');
        $setor->setSequenciaInicialNUP(1);
        $setor->setEspecieSetor($this->getReference('EspecieSetor-ARQUIVO'));
        $setor->setUnidade($this->getReference('Unidade-PROCURADORIA-GERAL DA UNIÃO'));
        $setor->setParent($this->getReference('Unidade-PROCURADORIA-GERAL DA UNIÃO'));
        $setor->setMunicipio($this->getReference('Municipio-BRASÍLIA-DF'));

        $this->manager->persist($setor);

        $this->addReference(
            'Setor-'.$setor->getNome().'-'.$setor->getUnidade()->getSigla(),
            $setor
        );

        $setor = new Setor();
        $setor->setNome('SECRETARIA');
        $setor->setSigla('SECR');
        $setor->setPrefixoNUP('00400');
        $setor->setSequenciaInicialNUP(1);
        $setor->setEspecieSetor($this->getReference('EspecieSetor-SECRETARIA'));
        $setor->setUnidade($this->getReference('Unidade-PROCURADORIA-GERAL DA UNIÃO'));
        $setor->setParent($this->getReference('Unidade-PROCURADORIA-GERAL DA UNIÃO'));
        $setor->setMunicipio($this->getReference('Municipio-BRASÍLIA-DF'));

        $this->manager->persist($setor);

        $this->addReference(
            'Setor-'.$setor->getNome().'-'.$setor->getUnidade()->getSigla(),
            $setor
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
        return 4;
    }

    /**
     * This method must return an array of groups
     * on which the implementing class belongs to.
     *
     * @return string[]
     */
    public static function getGroups(): array
    {
        return ['dev', 'test'];
    }
}
