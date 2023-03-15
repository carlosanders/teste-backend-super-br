<?php

declare(strict_types=1);
/**
 * /src/JsonLD/Annotations/JsonLD.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Mapper\Annotations;

use Doctrine\Common\Annotations\Annotation;

/**
 * Class JsonLD.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @Annotation
 */
class JsonLD extends Annotation
{
    public string $jsonLDType;

    public string $jsonLDId;

    public string $jsonLDContext;

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
