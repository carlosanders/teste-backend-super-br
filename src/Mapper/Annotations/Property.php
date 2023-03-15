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
 * Class Property.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @Annotation
 */
class Property extends Annotation
{
    public ?string $name = null;

    public ?string $dtoClass = null;

    public ?string $dtoGetter = null;

    public ?string $dtoSetter = null;

    public ?string $entityGetter = null;

    public ?string $entitySetter = null;

    public bool $collection = false;

    public array $options = [];

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
