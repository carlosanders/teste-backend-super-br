<?php

declare(strict_types=1);
/**
 * /src/Form/Configuration/Form.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Form\Annotations;

use Doctrine\Common\Annotations\Annotation;

/**
 * Class Form.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @Annotation
 */
class Form extends Annotation
{
    public array $validationGroups = [];

    /**
     * @param string $name
     * @param mixed  $value
     */
    public function __set($name, $value)
    {
        $this->validationGroups[$name] = $value;
    }

    /**
     * @param $name
     */
    public function __isset($name)
    {
    }
}
