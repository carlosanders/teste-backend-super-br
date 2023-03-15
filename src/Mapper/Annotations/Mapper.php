<?php

declare(strict_types=1);
/**
 * /src/Mapper/Annotations/Mapper.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Mapper\Annotations;

use Doctrine\Common\Annotations\Annotation;

/**
 * Class Mapper.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @Annotation
 */
class Mapper extends Annotation
{
    public string $class;

    public array $options = [];

    public array $entityMapping = [];

    public array $excludePopulate = [];

    /**
     * @param string $class
     * @param mixed  $value
     */
    public function __set($class, $value)
    {
        $this->options[$class] = $value;
    }

    /**
     * @param $class
     */
    public function __isset($class)
    {
    }
}
