<?php

declare(strict_types=1);
/**
 * /src/DataFixtures/ORM/ProdExec/LoadCampoData.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\DataFixtures\ORM\ProdExec;

use BadMethodCallException;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use SuppCore\AdministrativoBackend\Entity\Campo;
use SuppCore\AdministrativoBackend\Fields\FieldsManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;

/**
 * Class LoadCampoData.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class LoadCampoData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface, FixtureGroupInterface
{
    private ?FieldsManager $fieldsManager = null;

    /**
     * Setter for container.
     *
     * @param ContainerInterface|null $container
     */
    public function setContainer(?ContainerInterface $container = null): void
    {
        if (null !== $container) {
            $this->fieldsManager = $container->get('SuppCore\AdministrativoBackend\Fields\FieldsManager');
        }
    }

    /**
     * Load data fixtures with the passed EntityManager.
     *
     * @param ObjectManager $manager
     *
     * @throws BadMethodCallException
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     * @throws ServiceCircularReferenceException
     * @throws ServiceNotFoundException
     * @throws Exception
     */
    public function load(ObjectManager $manager): void
    {
        foreach ($this->fieldsManager->getFields() as $field) {
            $fieldConfig = $field->getConfig();
            // Create new entity
            $entity = new Campo();
            $entity->setNome($fieldConfig['info']['nome']);
            $entity->setDescricao($fieldConfig['info']['descricao']);
            $entity->setHtml($fieldConfig['info']['html']);
            $entity->setAtivo(true);

            // Persist entity
            $manager->persist($entity);

            $this->addReference('Campo-'.$fieldConfig['info']['nome'], $entity);
        }

        // Flush database changes
        $manager->flush();
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
