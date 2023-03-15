<?php

declare(strict_types=1);
/**
 * /src/Entity/TipoDocumento.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Entity;

use Doctrine\ORM\Mapping as ORM;
use SuppCore\AdministrativoBackend\Doctrine\ORM\Immutable\Immutable;
use SuppCore\AdministrativoBackend\Entity\Traits\Descricao;
use SuppCore\AdministrativoBackend\Entity\Traits\Id;
use SuppCore\AdministrativoBackend\Entity\Traits\Nome;
use SuppCore\AdministrativoBackend\Entity\Traits\Uuid;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Class TipoDocumento.
 *
 *  @ORM\Table(
 *     name="ad_tipo_notificacao",
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(columns={"nome"}),
 *     }
 * )
 *
 * @ORM\Entity()
 * @Immutable(fieldName="nome", expression=Immutable::EXPRESSION_IN, expressionValues="env:constantes.entidades.tipo_notificacao.immutable")
 * @UniqueEntity(
 *     fields = {"nome"},
 *     message = "Nome já está em utilização para esse espécie de documento!"
 * )
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class TipoNotificacao implements EntityInterface
{
    // Traits
    use Id;
    use Nome;
    use Descricao;
    use Uuid;

    public const TN_PROCESSO = 'PROCESSO';
    public const TN_DOWNLOAD_PROCESSO = 'DOWNLOAD PROCESSO';
    public const TN_TAREFA = 'TAREFA';
    public const TN_RELATORIO = 'RELATORIO';

    /**
     * TipoNotificacao constructor.
     */
    public function __construct()
    {
        $this->setUuid();
    }
}
