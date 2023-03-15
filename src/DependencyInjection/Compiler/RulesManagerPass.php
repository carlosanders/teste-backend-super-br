<?php
/**
 * /src/DependencyInjection/Compiler/RulesManagerPass.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
declare(strict_types=1);

namespace SuppCore\AdministrativoBackend\DependencyInjection\Compiler;

use function array_keys;
use SuppCore\AdministrativoBackend\Rules\RulesManager;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class RulesManager.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class RulesManagerPass implements CompilerPassInterface
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
        if (!$container->has(RulesManager::class)) {
            return;
        }

        $rulesManager = $container->getDefinition(RulesManager::class);

        foreach (array_keys($container->findTaggedServiceIds('rules_manager.rule')) as $id) {
            $rulesManager->addMethodCall('addRule', [new Reference($id)]);
        }
    }
}
