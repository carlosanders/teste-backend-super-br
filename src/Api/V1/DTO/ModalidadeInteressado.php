<?php

declare(strict_types=1);
/**
 * /src/Api/V1/DTO/ModalidadeInteressado.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\DTO;

use SuppCore\AdministrativoBackend\DTO\RestDto;
use SuppCore\AdministrativoBackend\DTO\Traits\Ativo;
use SuppCore\AdministrativoBackend\DTO\Traits\Blameable;
use SuppCore\AdministrativoBackend\DTO\Traits\Descricao;
use SuppCore\AdministrativoBackend\DTO\Traits\IdUuid;
use SuppCore\AdministrativoBackend\DTO\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\DTO\Traits\Timeblameable;
use SuppCore\AdministrativoBackend\DTO\Traits\Valor;
use SuppCore\AdministrativoBackend\Form\Annotations as Form;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;
use SuppCore\AdministrativoBackend\Validator\Constraints as AppAssert;

/**
 * Class ModalidadeInteressado.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @AppAssert\DtoUniqueEntity(
 *      fieldMapping = {"valor": "valor"},
 *      entityClass="SuppCore\AdministrativoBackend\Entity\ModalidadeInteressado",
 *      message = "Campo já está em utilização!"
 * )
 *
 * @DTOMapper\JsonLD(
 *     jsonLDId="/v1/administrativo/modalidade_interessado/{id}",
 *     jsonLDType="ModalidadeInteressado",
 *     jsonLDContext="/api/doc/#model-ModalidadeInteressado"
 * )
 *
 * @Form\Form()
 * @Form\Cacheable(expire="86400")
 */
class ModalidadeInteressado extends RestDto
{
    use IdUuid;
    use Valor;
    use Descricao;
    use Ativo;
    use Timeblameable;
    use Blameable;
    use Softdeleteable;
}