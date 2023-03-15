<?php

declare(strict_types=1);
/**
 * /src/Api/V1/DTO/TipoAcaoWorkflow.php.
 */

namespace SuppCore\AdministrativoBackend\Api\V1\DTO;

use SuppCore\AdministrativoBackend\DTO\RestDto;
use SuppCore\AdministrativoBackend\DTO\Traits\Ativo;
use SuppCore\AdministrativoBackend\DTO\Traits\Blameable;
use SuppCore\AdministrativoBackend\DTO\Traits\Descricao;
use SuppCore\AdministrativoBackend\DTO\Traits\IdUuid;
use SuppCore\AdministrativoBackend\DTO\Traits\Sigla;
use SuppCore\AdministrativoBackend\DTO\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\DTO\Traits\Timeblameable;
use SuppCore\AdministrativoBackend\DTO\Traits\Valor;
use SuppCore\AdministrativoBackend\Form\Annotations as Form;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;

/**
 * Class TipoValidacaoWorkflow.
 *
 * @DTOMapper\JsonLD(
 *     jsonLDId="/v1/administrativo/tipo_validacao_workflow/{id}",
 *     jsonLDType="TipoValidacaoWorkflow",
 *     jsonLDContext="/api/doc/#model-TipoValidacaoWorkflow"
 * )
 *
 * @Form\Form()
 * @Form\Cacheable(expire="86400")
 */
class TipoValidacaoWorkflow extends RestDto
{
    use IdUuid;
    use Valor;
    use Descricao;
    use Ativo;
    use Timeblameable;
    use Blameable;
    use Softdeleteable;
    use Sigla;
}
