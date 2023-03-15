<?php
/**
 * /src/DependencyInjection/Compiler/PipesManagerPass.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
declare(strict_types=1);

namespace SuppCore\AdministrativoBackend\DependencyInjection\Compiler;

use function array_keys;
use SuppCore\AdministrativoBackend\Mapper\Pipes\PipesManager;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class PipesManager.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class PipesManagerPass implements CompilerPassInterface
{
    /**
     * This process will attach all REST resource objects to collection class, where we can use those on certain cases.
     *
     * @codeCoverageIgnore
     *
     * @param ContainerBuilder $container
     *
     * @throws InvalidArgumentException
     * @throws ServiceNotFoundException
     */
    public function process(ContainerBuilder $container): void
    {
        // always first check if the primary service is defined
        if (!$container->has(PipesManager::class)) {
            return;
        }

        $pipesManager = $container->getDefinition(PipesManager::class);

        foreach (array_keys($container->findTaggedServiceIds('pipes_manager.pipe')) as $id) {
            $pipesManager->addMethodCall('addPipe', [new Reference($id)]);
        }
    }
}
