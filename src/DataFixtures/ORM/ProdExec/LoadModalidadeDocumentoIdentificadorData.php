<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/ProdExec/LoadModalidadeDocumentoIdentificadorData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\ProdExec;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\ModalidadeDocumentoIdentificador;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadModalidadeDocumentoIdentificadorData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadModalidadeDocumentoIdentificadorData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $modalidadeDocumentoIdentificador = new ModalidadeDocumentoIdentificador();
        $modalidadeDocumentoIdentificador->setValor('CARTEIRA DE IDENTIDADE');
        $modalidadeDocumentoIdentificador->setDescricao('CARTEIRA DE IDENTIDADE');

        $this->manager->persist($modalidadeDocumentoIdentificador);

        $this->addReference(
            'ModalidadeDocumentoIdentificador-'.$modalidadeDocumentoIdentificador->getValor(),
            $modalidadeDocumentoIdentificador
        );

        // --- //

        $modalidadeDocumentoIdentificador = new ModalidadeDocumentoIdentificador();
        $modalidadeDocumentoIdentificador->setValor('CARTEIRA NACIONAL DE HABILITAÇÃO');
        $modalidadeDocumentoIdentificador->setDescricao('CARTEIRA NACIONAL DE HABILITAÇÃO');

        $this->manager->persist($modalidadeDocumentoIdentificador);

        $this->addReference(
            'ModalidadeDocumentoIdentificador-'.$modalidadeDocumentoIdentificador->getValor(),
            $modalidadeDocumentoIdentificador
        );

        // --- //

        $modalidadeDocumentoIdentificador = new ModalidadeDocumentoIdentificador();
        $modalidadeDocumentoIdentificador->setValor('TÍTULO DE ELEITOR');
        $modalidadeDocumentoIdentificador->setDescricao('TÍTULO DE ELEITOR');

        $this->manager->persist($modalidadeDocumentoIdentificador);

        $this->addReference(
            'ModalidadeDocumentoIdentificador-'.$modalidadeDocumentoIdentificador->getValor(),
            $modalidadeDocumentoIdentificador
        );

        // --- //

        $modalidadeDocumentoIdentificador = new ModalidadeDocumentoIdentificador();
        $modalidadeDocumentoIdentificador->setValor('CERTIDÃO DE NASCIMENTO');
        $modalidadeDocumentoIdentificador->setDescricao('CERTIDÃO DE NASCIMENTO');

        $this->manager->persist($modalidadeDocumentoIdentificador);

        $this->addReference(
            'ModalidadeDocumentoIdentificador-'.$modalidadeDocumentoIdentificador->getValor(),
            $modalidadeDocumentoIdentificador
        );

        // --- //

        $modalidadeDocumentoIdentificador = new ModalidadeDocumentoIdentificador();
        $modalidadeDocumentoIdentificador->setValor('CERTIDÃO DE CASAMENTO');
        $modalidadeDocumentoIdentificador->setDescricao('CERTIDÃO DE CASAMENTO');

        $this->manager->persist($modalidadeDocumentoIdentificador);

        $this->addReference(
            'ModalidadeDocumentoIdentificador-'.$modalidadeDocumentoIdentificador->getValor(),
            $modalidadeDocumentoIdentificador
        );

        // --- //

        $modalidadeDocumentoIdentificador = new ModalidadeDocumentoIdentificador();
        $modalidadeDocumentoIdentificador->setValor('CARTEIRA DE TRABALHO');
        $modalidadeDocumentoIdentificador->setDescricao('CARTEIRA DE TRABALHO');

        $this->manager->persist($modalidadeDocumentoIdentificador);

        $this->addReference(
            'ModalidadeDocumentoIdentificador-'.$modalidadeDocumentoIdentificador->getValor(),
            $modalidadeDocumentoIdentificador
        );

        // --- //

        $modalidadeDocumentoIdentificador = new ModalidadeDocumentoIdentificador();
        $modalidadeDocumentoIdentificador->setValor('CADASTRO NO MINISTÉRIO DA FAZENDA BRASILEIRO');
        $modalidadeDocumentoIdentificador->setDescricao('CADASTRO NO MINISTÉRIO DA FAZENDA BRASILEIRO');

        $this->manager->persist($modalidadeDocumentoIdentificador);

        $this->addReference(
            'ModalidadeDocumentoIdentificador-'.$modalidadeDocumentoIdentificador->getValor(),
            $modalidadeDocumentoIdentificador
        );

        // --- //

        $modalidadeDocumentoIdentificador = new ModalidadeDocumentoIdentificador();
        $modalidadeDocumentoIdentificador->setValor('CADASTRO ESPECÍFICO DO INSS');
        $modalidadeDocumentoIdentificador->setDescricao('CADASTRO ESPECÍFICO DO INSS');

        $this->manager->persist($modalidadeDocumentoIdentificador);

        $this->addReference(
            'ModalidadeDocumentoIdentificador-'.$modalidadeDocumentoIdentificador->getValor(),
            $modalidadeDocumentoIdentificador
        );

        // --- //

        $modalidadeDocumentoIdentificador = new ModalidadeDocumentoIdentificador();
        $modalidadeDocumentoIdentificador->setValor('NÚMERO DE IDENTIFICAÇÃO DO TRABALHO');
        $modalidadeDocumentoIdentificador->setDescricao('NÚMERO DE IDENTIFICAÇÃO DO TRABALHO');

        $this->manager->persist($modalidadeDocumentoIdentificador);

        $this->addReference(
            'ModalidadeDocumentoIdentificador-'.$modalidadeDocumentoIdentificador->getValor(),
            $modalidadeDocumentoIdentificador
        );

        // --- //

        $modalidadeDocumentoIdentificador = new ModalidadeDocumentoIdentificador();
        $modalidadeDocumentoIdentificador->setValor('CADASTRO EM CONSELHOS PROFISSIONAIS');
        $modalidadeDocumentoIdentificador->setDescricao('CADASTRO EM CONSELHOS PROFISSIONAIS');

        $this->manager->persist($modalidadeDocumentoIdentificador);

        $this->addReference(
            'ModalidadeDocumentoIdentificador-'.$modalidadeDocumentoIdentificador->getValor(),
            $modalidadeDocumentoIdentificador
        );

        // --- //

        $modalidadeDocumentoIdentificador = new ModalidadeDocumentoIdentificador();
        $modalidadeDocumentoIdentificador->setValor('IDENTIDADE FUNCIONAL');
        $modalidadeDocumentoIdentificador->setDescricao('IDENTIDADE FUNCIONAL');

        $this->manager->persist($modalidadeDocumentoIdentificador);

        $this->addReference(
            'ModalidadeDocumentoIdentificador-'.$modalidadeDocumentoIdentificador->getValor(),
            $modalidadeDocumentoIdentificador
        );

        // --- //

        $modalidadeDocumentoIdentificador = new ModalidadeDocumentoIdentificador();
        $modalidadeDocumentoIdentificador->setValor('NÚMERO DE CADASTRO NA ORDEM DOS ADVOGADOS DO BRASIL');
        $modalidadeDocumentoIdentificador->setDescricao('NÚMERO DE CADASTRO NA ORDEM DOS ADVOGADOS DO BRASIL');

        $this->manager->persist($modalidadeDocumentoIdentificador);

        $this->addReference(
            'ModalidadeDocumentoIdentificador-'.$modalidadeDocumentoIdentificador->getValor(),
            $modalidadeDocumentoIdentificador
        );

        // --- //

        $modalidadeDocumentoIdentificador = new ModalidadeDocumentoIdentificador();
        $modalidadeDocumentoIdentificador->setValor('NÚMERO DE INSCRIÇÃO EMPRESARIAL');
        $modalidadeDocumentoIdentificador->setDescricao('NÚMERO DE INSCRIÇÃO EMPRESARIAL');

        $this->manager->persist($modalidadeDocumentoIdentificador);

        $this->addReference(
            'ModalidadeDocumentoIdentificador-'.$modalidadeDocumentoIdentificador->getValor(),
            $modalidadeDocumentoIdentificador
        );

        // --- //

        $modalidadeDocumentoIdentificador = new ModalidadeDocumentoIdentificador();
        $modalidadeDocumentoIdentificador->setValor('REGISTRO DE IDENTIFICAÇÃO DO ESTRANGEIRO');
        $modalidadeDocumentoIdentificador->setDescricao('REGISTRO DE IDENTIFICAÇÃO DO ESTRANGEIRO');

        $this->manager->persist($modalidadeDocumentoIdentificador);

        $this->addReference(
            'ModalidadeDocumentoIdentificador-'.$modalidadeDocumentoIdentificador->getValor(),
            $modalidadeDocumentoIdentificador
        );

        // --- //

        $modalidadeDocumentoIdentificador = new ModalidadeDocumentoIdentificador();
        $modalidadeDocumentoIdentificador->setValor('NÚMERO NO PROGRAMA DE INTEGRAÇÃO SOCIAL');
        $modalidadeDocumentoIdentificador->setDescricao('NÚMERO NO PROGRAMA DE INTEGRAÇÃO SOCIAL');

        $this->manager->persist($modalidadeDocumentoIdentificador);

        $this->addReference(
            'ModalidadeDocumentoIdentificador-'.$modalidadeDocumentoIdentificador->getValor(),
            $modalidadeDocumentoIdentificador
        );

        // --- //

        $modalidadeDocumentoIdentificador = new ModalidadeDocumentoIdentificador();
        $modalidadeDocumentoIdentificador->setValor('PASSAPORTE');
        $modalidadeDocumentoIdentificador->setDescricao('PASSAPORTE');

        $this->manager->persist($modalidadeDocumentoIdentificador);

        $this->addReference(
            'ModalidadeDocumentoIdentificador-'.$modalidadeDocumentoIdentificador->getValor(),
            $modalidadeDocumentoIdentificador
        );

        // --- //

        $modalidadeDocumentoIdentificador = new ModalidadeDocumentoIdentificador();
        $modalidadeDocumentoIdentificador->setValor('REGISTRO INDIVIDUAL DO CIDADÃO');
        $modalidadeDocumentoIdentificador->setDescricao('REGISTRO INDIVIDUAL DO CIDADÃO');

        $this->manager->persist($modalidadeDocumentoIdentificador);

        $this->addReference(
            'ModalidadeDocumentoIdentificador-'.$modalidadeDocumentoIdentificador->getValor(),
            $modalidadeDocumentoIdentificador
        );

        // --- //

        $modalidadeDocumentoIdentificador = new ModalidadeDocumentoIdentificador();
        $modalidadeDocumentoIdentificador->setValor('MATRÍCULA SIAPE');
        $modalidadeDocumentoIdentificador->setDescricao('MATRÍCULA SIAPE');

        $this->manager->persist($modalidadeDocumentoIdentificador);

        $this->addReference(
            'ModalidadeDocumentoIdentificador-'.$modalidadeDocumentoIdentificador->getValor(),
            $modalidadeDocumentoIdentificador
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
