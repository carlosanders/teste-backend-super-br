<?php

declare(strict_types=1);
/**
 * /src/Helpers/SuppParameterBag.php.
 *
 * @author  Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Helpers;

use DateTime;
use SuppCore\AdministrativoBackend\Api\V1\Resource\ConfigModuloResource;
use SuppCore\AdministrativoBackend\Entity\ConfigModulo as ConfigModuloEntity;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

/**
 * Class SuppParameterBag
 * @package SuppCore\AdministrativoBackend\Helpers
 *
 * @author  Advocacia-Geral da União <supp@agu.gov.br>
 */
class SuppParameterBag
{

    public function __construct(
        private ConfigModuloResource $configModuloResource,
        private ParameterBagInterface $parameterBag
    ) {
    }

//    public function clear()
//    {
//        // TODO: Implement clear() method.
//    }
//
//    public function add(array $parameters)
//    {
//        // TODO: Implement add() method.
//    }
//
//    public function all()
//    {
//        // TODO: Implement all() method.
//    }

    /**
     * @param string $paramId
     *
     * @return float|DateTime|array|bool|int|string|null
     */
    public function get(string $paramId): float|DateTime|array|bool|int|string|null
    {
        /** @var ConfigModuloEntity $config */
        $config = $this->configModuloResource->getRepository()->findOneBy(['nome' => $paramId]);
        if ($config) {
            return $config->getValue();
        }
        /** @var ConfigModuloEntity $config */
        $config = $this->configModuloResource->getRepository()->findOneBy(['sigla' => $paramId]);
        if ($config) {
            return $config->getValue();
        }

        return $this->parameterBag->get($paramId);
    }

//    public function remove(string $name)
//    {
//        // TODO: Implement remove() method.
//    }
//
//    public function set(string $name, $value)
//    {
//        // TODO: Implement set() method.
//    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function has(string $name): bool
    {
        /** @var ConfigModuloEntity $config */
        $config = $this->configModuloResource->getRepository()->findOneBy(['nome' => $name]);
        if (!$config) {
            return $this->parameterBag->has($name);
        }

        return true;
    }

//    public function resolve()
//    {
//        // TODO: Implement resolve() method.
//    }
//
//    public function resolveValue($value)
//    {
//        // TODO: Implement resolveValue() method.
//    }
//
//    public function escapeValue($value)
//    {
//        // TODO: Implement escapeValue() method.
//    }
//
//    public function unescapeValue($value)
//    {
//        // TODO: Implement unescapeValue() method.
//    }
}
