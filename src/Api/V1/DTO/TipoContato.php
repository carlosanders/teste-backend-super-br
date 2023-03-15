<?php

declare(strict_types=1);
/**
 * /src/Api/V1/DTO/TipoContato.php.
 */

namespace SuppCore\AdministrativoBackend\Api\V1\DTO;

use Nelmio\ApiDocBundle\Annotation\Model;
use SuppCore\AdministrativoBackend\DTO\RestDto;
use SuppCore\AdministrativoBackend\DTO\Traits\Ativo;
use SuppCore\AdministrativoBackend\DTO\Traits\Blameable;
use SuppCore\AdministrativoBackend\DTO\Traits\Descricao;
use SuppCore\AdministrativoBackend\DTO\Traits\IdUuid;
use SuppCore\AdministrativoBackend\DTO\Traits\Nome;
use SuppCore\AdministrativoBackend\DTO\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\DTO\Traits\Timeblameable;
use SuppCore\AdministrativoBackend\Form\Annotations as Form;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;

/**
 * Class TipoContato.
 *
 * @DTOMapper\JsonLD(
 *     jsonLDId="/v1/administrativo/tipo_contato/{id}",
 *     jsonLDType="TipoContato",
 *     jsonLDContext="/api/doc/#model-TipoContato"
 * )
 *
 * @Form\Form()
 */
class TipoContato extends RestDto
{
    use IdUuid;
    use Nome;
    use Descricao;
    use Ativo;
    use Timeblameable;
    use Blameable;
    use Softdeleteable;
}
