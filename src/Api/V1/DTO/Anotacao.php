<?php

declare(strict_types=1);

namespace SuppCore\AdministrativoBackend\Api\V1\DTO;

use SuppCore\AdministrativoBackend\DTO\RestDto;
use SuppCore\AdministrativoBackend\DTO\Traits\Ativo;
use SuppCore\AdministrativoBackend\DTO\Traits\Descricao;
use SuppCore\AdministrativoBackend\DTO\Traits\IdUuid;
use SuppCore\AdministrativoBackend\Form\Annotations as Form;

/**
 * Class Anotacao.
 * @Form\Form()
 */
class Anotacao extends RestDto
{
    use IdUuid;
    use Descricao;
    use Ativo;
}
