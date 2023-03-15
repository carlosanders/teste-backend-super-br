<?php

declare(strict_types=1);
/**
 * /src/Validator/Constraints/CpfCnpj.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Class CpfCnpj.
 *
 * @Annotation
 * @Target({"PROPERTY"})
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class CpfCnpj extends Constraint
{
    public string $message = 'CPF/CNPJ inválido!';
}
