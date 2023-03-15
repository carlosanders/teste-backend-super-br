<?php

declare(strict_types=1);
/**
 * /src/Validator/Constraints/Password.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Class Password.
 *
 * @Annotation
 * @Target({"PROPERTY"})
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Password extends Constraint
{
    public string $message = 'A senha deve conter entre 8 e 16 caracteres com pelo menos 1 letra maiúscula, 1 letra minúscula e 1 número!';
}
