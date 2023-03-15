<?php

declare(strict_types=1);
/**
 * /src/Form/Configuration/Cacheable.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Form\Annotations;

use Doctrine\Common\Annotations\Annotation;

/**
 * Class Method.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @Annotation
 */
class Cacheable extends Annotation
{
    public ?string $expire = null;
}
