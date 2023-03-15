<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Test/LoadComponenteDigitalData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Test;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use function hash;
use function strlen;
use SuppCore\AdministrativoBackend\Entity\ComponenteDigital;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadComponenteDigitalData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadComponenteDigitalData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $componenteDigital = new ComponenteDigital();
        $componenteDigital->setFileName('DESPACHO.html');
        $componenteDigital->setConteudo('<p class="centralizado"><span data-method="cabecalho" data-options="" data-service="supp_main.template_renderer">*cabecalho*</span></p><p class="centralizado"><u><strong>DESPACHO n. <span data-method="numeroDocumento" data-options="" data-service="supp_administrativo.template_renderer">*numeroDocumento*</span></strong></u></p><p> </p><p class="esquerda"><strong>NUP: <span data-method="nup" data-options="" data-service="supp_administrativo.template_renderer">*nup*</span></strong></p><p class="esquerda"><strong>INTERESSADOS: <span data-method="interessados" data-options="" data-service="supp_administrativo.template_renderer">*interessados*</span></strong></p><p class="esquerda"><strong>ASSUNTOS: <span data-method="assuntos" data-options="" data-service="supp_administrativo.template_renderer">*assuntos*</span></strong></p><p> </p><div id="conteudoModelo">*conteudoModelo*</div><p> </p><p><span data-method="localData" data-options="" data-service="supp_main.template_renderer">*localData*</span></p><p> </p><p><span data-method="assinaturaUsuario" data-options="" data-service="supp_main.template_renderer">*assinaturaUsuario*</span></p><p><span data-method="chaveAcesso" data-options="" data-service="supp_administrativo.template_renderer">*chaveAcesso*</span></p>');
        $componenteDigital->setTamanho(strlen($componenteDigital->getConteudo()));
        $componenteDigital->setHash(hash('SHA256', $componenteDigital->getConteudo()));
        $componenteDigital->setEditavel(true);
        $componenteDigital->setExtensao('html');
        $componenteDigital->setMimetype('text/html');
        $componenteDigital->setDocumento($this->getReference('Documento-MODELO DESPACHO DE APROVAÇÃO'));
        $componenteDigital->setApagadoEm(\DateTime::createFromFormat('Y-m-d', '2021-12-05'));

        // Persist entity
        $this->manager->persist($componenteDigital);

        $componenteDigital = new ComponenteDigital();
        $componenteDigital->setFileName('DESPACHO.html');
        $componenteDigital->setConteudo('<body>COMPARA VERSÃO 1</body>');
        $componenteDigital->setTamanho(strlen($componenteDigital->getConteudo()));
        $componenteDigital->setHash(hash('SHA256', $componenteDigital->getConteudo()));
        $componenteDigital->setEditavel(true);
        $componenteDigital->setExtensao('html');
        $componenteDigital->setMimetype('text/html');
        $componenteDigital->setDocumento($this->getReference('Documento-MODELO DESPACHO DE APROVAÇÃO'));
        $componenteDigital->setAtualizadoPor($this->getReference('Usuario-00000000003'));

        // Persist entity
        $this->manager->persist($componenteDigital);

        $componenteDigital = new ComponenteDigital();
        $componenteDigital->setFileName('DESPACHO.html');
        $componenteDigital->setConteudo('<body>COMPARA VERSÃO 2</body>');
        $componenteDigital->setTamanho(strlen($componenteDigital->getConteudo()));
        $componenteDigital->setHash(hash('SHA256', $componenteDigital->getConteudo()));
        $componenteDigital->setEditavel(true);
        $componenteDigital->setExtensao('html');
        $componenteDigital->setMimetype('text/html');
        $componenteDigital->setDocumento($this->getReference('Documento-MODELO DESPACHO DE APROVAÇÃO'));
        $componenteDigital->setAtualizadoPor($this->getReference('Usuario-00000000003'));

        // Persist entity
        $this->manager->persist($componenteDigital);

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
