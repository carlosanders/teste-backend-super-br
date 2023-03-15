<?php

declare(strict_types=1);
/**
 * /src/Annotation/RestApiDoc.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Annotation;

use Doctrine\Common\Annotations\Annotation;

/**
 * Class RestApiDoc.
 *
 * @Annotation
 * @Annotation\Target({"CLASS", "METHOD"})
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class RestApiDoc
{
    public bool $disabled = false;
}
