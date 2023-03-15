<?php

declare(strict_types=1);
/**
 * /src/Form/Configuration/Field.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Form\Annotations;

use Doctrine\Common\Annotations\Annotation;

/**
 * Class Field.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @Annotation
 */
class Field extends Annotation
{
    public ?string $name = null;

    public array $methods = [];

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
