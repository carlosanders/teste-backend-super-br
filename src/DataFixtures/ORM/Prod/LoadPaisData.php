<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/Prod/LoadPaisData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\Prod;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use SuppCore\AdministrativoBackend\Entity\Pais;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadPaisData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadPaisData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
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

        $pais = new Pais();
        $pais->setCodigo('AD');
        $pais->setNome('ANDORRA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('AE');
        $pais->setNome('UNITED ARAB EMIRATES');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('AF');
        $pais->setNome('AFGHANISTAN');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('AG');
        $pais->setNome('ANTIGUA AND BARBUDA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('AI');
        $pais->setNome('ANGUILLA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('AL');
        $pais->setNome('ALBANIA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('AM');
        $pais->setNome('ARMENIA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('AO');
        $pais->setNome('ANGOLA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('AQ');
        $pais->setNome('ANTARCTICA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('AR');
        $pais->setNome('ARGENTINA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('AS');
        $pais->setNome('AMERICAN SAMOA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('AT');
        $pais->setNome('AUSTRIA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('AU');
        $pais->setNome('AUSTRALIA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('AW');
        $pais->setNome('ARUBA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('AX');
        $pais->setNome('Ã…LAND ISLANDS');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('AZ');
        $pais->setNome('AZERBAIJAN');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('BA');
        $pais->setNome('BOSNIA AND HERZEGOVINA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('BB');
        $pais->setNome('BARBADOS');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('BD');
        $pais->setNome('BANGLADESH');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('BE');
        $pais->setNome('BELGIUM');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('BF');
        $pais->setNome('BURKINA FASO');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('BG');
        $pais->setNome('BULGARIA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('BH');
        $pais->setNome('BAHRAIN');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('BI');
        $pais->setNome('BURUNDI');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('BJ');
        $pais->setNome('BENIN');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('BL');
        $pais->setNome('SAINT BARTHÃ©LEMY');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('BM');
        $pais->setNome('BERMUDA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('BN');
        $pais->setNome('BRUNEI DARUSSALAM');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('BO');
        $pais->setNome('BOLIVIA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('BQ');
        $pais->setNome('BONAIRE, SINT EUSTATIUS AND SABA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('BR');
        $pais->setNome('BRAZIL');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('BS');
        $pais->setNome('BAHAMAS');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('BT');
        $pais->setNome('BHUTAN');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('BV');
        $pais->setNome('BOUVET ISLAND (BOUVETOYA)');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('BW');
        $pais->setNome('BOTSWANA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('BY');
        $pais->setNome('BELARUS');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('BZ');
        $pais->setNome('BELIZE');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('CA');
        $pais->setNome('CANADA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('CC');
        $pais->setNome('COCOS (KEELING) ISLANDS');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('CD');
        $pais->setNome('CONGO');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('CF');
        $pais->setNome('CENTRAL AFRICAN REPUBLIC');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('CG');
        $pais->setNome('CONGO');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('CH');
        $pais->setNome('SWITZERLAND');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('CI');
        $pais->setNome('COTE D\'IVOIRE');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('CK');
        $pais->setNome('COOK ISLANDS');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('CL');
        $pais->setNome('CHILE');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('CM');
        $pais->setNome('CAMEROON');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('CN');
        $pais->setNome('CHINA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('CO');
        $pais->setNome('COLOMBIA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('CR');
        $pais->setNome('COSTA RICA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('CU');
        $pais->setNome('CUBA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('CV');
        $pais->setNome('CAPE VERDE');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('CW');
        $pais->setNome('CURAÃ§AO');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('CX');
        $pais->setNome('CHRISTMAS ISLAND');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('CY');
        $pais->setNome('CYPRUS');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('CZ');
        $pais->setNome('CZECH REPUBLIC');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('DE');
        $pais->setNome('GERMANY');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('DJ');
        $pais->setNome('DJIBOUTI');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('DK');
        $pais->setNome('DENMARK');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('DM');
        $pais->setNome('DOMINICA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('DO');
        $pais->setNome('DOMINICAN REPUBLIC');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('DZ');
        $pais->setNome('ALGERIA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('EC');
        $pais->setNome('ECUADOR');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('EE');
        $pais->setNome('ESTONIA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('EG');
        $pais->setNome('EGYPT');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('EH');
        $pais->setNome('WESTERN SAHARA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('ER');
        $pais->setNome('ERITREA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('ES');
        $pais->setNome('SPAIN');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('ET');
        $pais->setNome('ETHIOPIA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('FI');
        $pais->setNome('FINLAND');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('FJ');
        $pais->setNome('FIJI');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('FK');
        $pais->setNome('FALKLAND ISLANDS (MALVINAS)');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('FM');
        $pais->setNome('MICRONESIA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('FO');
        $pais->setNome('FAROE ISLANDS');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('FR');
        $pais->setNome('FRANCE');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('GA');
        $pais->setNome('GABON');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('GB');
        $pais->setNome('UNITED KINGDOM OF GREAT BRITAIN & NORTHERN IRELAND');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('GD');
        $pais->setNome('GRENADA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('GE');
        $pais->setNome('GEORGIA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('GF');
        $pais->setNome('FRENCH GUIANA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('GG');
        $pais->setNome('GUERNSEY');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('GH');
        $pais->setNome('GHANA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('GI');
        $pais->setNome('GIBRALTAR');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('GL');
        $pais->setNome('GREENLAND');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('GM');
        $pais->setNome('GAMBIA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('GN');
        $pais->setNome('GUINEA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('GP');
        $pais->setNome('GUADELOUPE');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('GQ');
        $pais->setNome('EQUATORIAL GUINEA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('GR');
        $pais->setNome('GREECE');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('GS');
        $pais->setNome('SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('GT');
        $pais->setNome('GUATEMALA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('GU');
        $pais->setNome('GUAM');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('GW');
        $pais->setNome('GUINEA-BISSAU');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('GY');
        $pais->setNome('GUYANA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('HK');
        $pais->setNome('HONG KONG');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('HM');
        $pais->setNome('HEARD ISLAND AND MCDONALD ISLANDS');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('HN');
        $pais->setNome('HONDURAS');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('HR');
        $pais->setNome('CROATIA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('HT');
        $pais->setNome('HAITI');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('HU');
        $pais->setNome('HUNGARY');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('ID');
        $pais->setNome('INDONESIA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('IE');
        $pais->setNome('IRELAND');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('IL');
        $pais->setNome('ISRAEL');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('IM');
        $pais->setNome('ISLE OF MAN');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('IN');
        $pais->setNome('INDIA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('IO');
        $pais->setNome('BRITISH INDIAN OCEAN TERRITORY (CHAGOS ARCHIPELAGO)');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('IQ');
        $pais->setNome('IRAQ');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('IR');
        $pais->setNome('IRAN');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('IS');
        $pais->setNome('ICELAND');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('IT');
        $pais->setNome('ITALY');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('JE');
        $pais->setNome('JERSEY');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('JM');
        $pais->setNome('JAMAICA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('JO');
        $pais->setNome('JORDAN');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('JP');
        $pais->setNome('JAPAN');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('KE');
        $pais->setNome('KENYA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('KG');
        $pais->setNome('KYRGYZ REPUBLIC');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('KH');
        $pais->setNome('CAMBODIA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('KI');
        $pais->setNome('KIRIBATI');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('KM');
        $pais->setNome('COMOROS');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('KN');
        $pais->setNome('SAINT KITTS AND NEVIS');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('KP');
        $pais->setNome('KOREA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('KR');
        $pais->setNome('KOREA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('KW');
        $pais->setNome('KUWAIT');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('KY');
        $pais->setNome('CAYMAN ISLANDS');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('KZ');
        $pais->setNome('KAZAKHSTAN');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('LA');
        $pais->setNome('LAO PEOPLE\'S DEMOCRATIC REPUBLIC');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('LB');
        $pais->setNome('LEBANON');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('LC');
        $pais->setNome('SAINT LUCIA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('LI');
        $pais->setNome('LIECHTENSTEIN');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('LK');
        $pais->setNome('SRI LANKA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('LR');
        $pais->setNome('LIBERIA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('LS');
        $pais->setNome('LESOTHO');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('LT');
        $pais->setNome('LITHUANIA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('LU');
        $pais->setNome('LUXEMBOURG');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('LV');
        $pais->setNome('LATVIA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('LY');
        $pais->setNome('LIBYA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('MA');
        $pais->setNome('MOROCCO');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('MC');
        $pais->setNome('MONACO');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('MD');
        $pais->setNome('MOLDOVA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('ME');
        $pais->setNome('MONTENEGRO');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('MF');
        $pais->setNome('SAINT MARTIN');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('MG');
        $pais->setNome('MADAGASCAR');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('MH');
        $pais->setNome('MARSHALL ISLANDS');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('MK');
        $pais->setNome('MACEDONIA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('ML');
        $pais->setNome('MALI');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('MM');
        $pais->setNome('MYANMAR');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('MN');
        $pais->setNome('MONGOLIA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('MO');
        $pais->setNome('MACAO');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('MP');
        $pais->setNome('NORTHERN MARIANA ISLANDS');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('MQ');
        $pais->setNome('MARTINIQUE');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('MR');
        $pais->setNome('MAURITANIA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('MS');
        $pais->setNome('MONTSERRAT');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('MT');
        $pais->setNome('MALTA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('MU');
        $pais->setNome('MAURITIUS');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('MV');
        $pais->setNome('MALDIVES');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('MW');
        $pais->setNome('MALAWI');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('MX');
        $pais->setNome('MEXICO');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('MY');
        $pais->setNome('MALAYSIA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('MZ');
        $pais->setNome('MOZAMBIQUE');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('NA');
        $pais->setNome('NAMIBIA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('NC');
        $pais->setNome('NEW CALEDONIA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('NE');
        $pais->setNome('NIGER');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('NF');
        $pais->setNome('NORFOLK ISLAND');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('NG');
        $pais->setNome('NIGERIA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('NI');
        $pais->setNome('NICARAGUA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('NL');
        $pais->setNome('NETHERLANDS');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('NO');
        $pais->setNome('NORWAY');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('NP');
        $pais->setNome('NEPAL');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('NR');
        $pais->setNome('NAURU');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('NU');
        $pais->setNome('NIUE');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('NZ');
        $pais->setNome('NEW ZEALAND');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('OM');
        $pais->setNome('OMAN');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('PA');
        $pais->setNome('PANAMA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('PE');
        $pais->setNome('PERU');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('PF');
        $pais->setNome('FRENCH POLYNESIA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('PG');
        $pais->setNome('PAPUA NEW GUINEA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('PH');
        $pais->setNome('PHILIPPINES');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('PK');
        $pais->setNome('PAKISTAN');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('PL');
        $pais->setNome('POLAND');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('PM');
        $pais->setNome('SAINT PIERRE AND MIQUELON');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('PN');
        $pais->setNome('PITCAIRN ISLANDS');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('PR');
        $pais->setNome('PUERTO RICO');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('PS');
        $pais->setNome('PALESTINE');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('PT');
        $pais->setNome('PORTUGAL');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('PW');
        $pais->setNome('PALAU');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('PY');
        $pais->setNome('PARAGUAY');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('QA');
        $pais->setNome('QATAR');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('RE');
        $pais->setNome('RÃ©UNION');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('RO');
        $pais->setNome('ROMANIA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('RS');
        $pais->setNome('SERBIA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('RU');
        $pais->setNome('RUSSIAN FEDERATION');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('RW');
        $pais->setNome('RWANDA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('SA');
        $pais->setNome('SAUDI ARABIA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('SB');
        $pais->setNome('SOLOMON ISLANDS');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('SC');
        $pais->setNome('SEYCHELLES');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('SD');
        $pais->setNome('SUDAN');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('SE');
        $pais->setNome('SWEDEN');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('SG');
        $pais->setNome('SINGAPORE');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('SH');
        $pais->setNome('SAINT HELENA, ASCENSION AND TRISTAN DA CUNHA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('SI');
        $pais->setNome('SLOVENIA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('SJ');
        $pais->setNome('SVALBARD & JAN MAYEN ISLANDS');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('SK');
        $pais->setNome('SLOVAKIA (SLOVAK REPUBLIC)');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('SL');
        $pais->setNome('SIERRA LEONE');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('SM');
        $pais->setNome('SAN MARINO');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('SN');
        $pais->setNome('SENEGAL');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('SO');
        $pais->setNome('SOMALIA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('SR');
        $pais->setNome('SURINAME');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('SS');
        $pais->setNome('SOUTH SUDAN');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('ST');
        $pais->setNome('SAO TOME AND PRINCIPE');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('SV');
        $pais->setNome('EL SALVADOR');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('SX');
        $pais->setNome('SINT MAARTEN (DUTCH PART)');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('SY');
        $pais->setNome('SYRIAN ARAB REPUBLIC');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('SZ');
        $pais->setNome('SWAZILAND');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('TC');
        $pais->setNome('TURKS AND CAICOS ISLANDS');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('TD');
        $pais->setNome('CHAD');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('TF');
        $pais->setNome('FRENCH SOUTHERN TERRITORIES');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('TG');
        $pais->setNome('TOGO');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('TH');
        $pais->setNome('THAILAND');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('TJ');
        $pais->setNome('TAJIKISTAN');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('TK');
        $pais->setNome('TOKELAU');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('TL');
        $pais->setNome('TIMOR-LESTE');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('TM');
        $pais->setNome('TURKMENISTAN');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('TN');
        $pais->setNome('TUNISIA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('TO');
        $pais->setNome('TONGA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('TR');
        $pais->setNome('TURKEY');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('TT');
        $pais->setNome('TRINIDAD AND TOBAGO');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('TV');
        $pais->setNome('TUVALU');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('TW');
        $pais->setNome('TAIWAN');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('TZ');
        $pais->setNome('TANZANIA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('UA');
        $pais->setNome('UKRAINE');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('UG');
        $pais->setNome('UGANDA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('UM');
        $pais->setNome('UNITED STATES MINOR OUTLYING ISLANDS');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('US');
        $pais->setNome('UNITED STATES OF AMERICA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('UY');
        $pais->setNome('URUGUAY');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('UZ');
        $pais->setNome('UZBEKISTAN');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('VA');
        $pais->setNome('HOLY SEE (VATICAN CITY STATE)');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('VC');
        $pais->setNome('SAINT VINCENT AND THE GRENADINES');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('VE');
        $pais->setNome('VENEZUELA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('VG');
        $pais->setNome('BRITISH VIRGIN ISLANDS');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('VI');
        $pais->setNome('UNITED STATES VIRGIN ISLANDS');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('VN');
        $pais->setNome('VIETNAM');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('VU');
        $pais->setNome('VANUATU');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('WF');
        $pais->setNome('WALLIS AND FUTUNA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('WS');
        $pais->setNome('SAMOA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('YE');
        $pais->setNome('YEMEN');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('YT');
        $pais->setNome('MAYOTTE');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('ZA');
        $pais->setNome('SOUTH AFRICA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('ZM');
        $pais->setNome('ZAMBIA');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

        $pais = new Pais();
        $pais->setCodigo('ZW');
        $pais->setNome('ZIMBABWE');
        $this->addReference('Pais-'.$pais->getCodigo(), $pais);
        $this->manager->persist($pais);

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
        return ['prod', 'dev', 'test'];
    }
}
