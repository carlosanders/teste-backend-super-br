<?php

declare(strict_types=1);
/**
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Doctrine\ORM\Enableable;

use Doctrine\Common\Annotations\Annotation;

/**
 * Class Enableable.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @Annotation
 */
class Enableable extends Annotation
{
    public string $fieldName = 'ativo';

    public array $options = [];

    /**
     * @param string $name
     * @param mixed  $value
     */
    public function __set($name, $value)
    {
        $this->options[$name] = $value;
    }

    /**
     * @param $name
     */
    public function __isset($name)
    {
    }
}
