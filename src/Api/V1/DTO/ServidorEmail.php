<?php

declare(strict_types=1);
/**
 * /src/Api/V1/DTO/ServidorEmail.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\DTO;

use DMS\Filter\Rules as Filter;
use SuppCore\AdministrativoBackend\DTO\RestDto;
use SuppCore\AdministrativoBackend\DTO\Traits\Ativo;
use SuppCore\AdministrativoBackend\DTO\Traits\Blameable;
use SuppCore\AdministrativoBackend\DTO\Traits\Descricao;
use SuppCore\AdministrativoBackend\DTO\Traits\IdUuid;
use SuppCore\AdministrativoBackend\DTO\Traits\Nome;
use SuppCore\AdministrativoBackend\DTO\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\DTO\Traits\Timeblameable;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Form\Annotations as Form;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;
use OpenApi\Annotations as OA;
use Symfony\Component\Validator\Constraints as Assert;
use SuppCore\AdministrativoBackend\Validator\Constraints as AppAssert;

/**
 * Class ServidorEmail.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @AppAssert\DtoUniqueEntity(
 *     fieldMapping = {"nome": "nome"},
 *     entityClass="SuppCore\AdministrativoBackend\Entity\ServidorEmail",
 *     message = "Campo já está em utilização!"
 * )
 * @DTOMapper\JsonLD(
 *     jsonLDId="/v1/administrativo/servidor_email/{id}",
 *     jsonLDType="ServidorEmail",
 *     jsonLDContext="/api/doc/#model-ServidorEmail"
 * )
 *
 * @Form\Form()
 */
class ServidorEmail extends RestDto
{
    use IdUuid;
    use Timeblameable;
    use Blameable;
    use Softdeleteable;
    use Nome;
    use Descricao;
    use Ativo;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=true
     * )
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Assert\NotBlank(
     *     message="O campo não pode estar em branco!"
     * )
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     * @Assert\Length(
     *     min = 3,
     *     minMessage = "O campo deve ter no mínimo 3 caracteres!",
     *     max = 255,
     *     maxMessage = "O campo deve ter no máximo 255 caracteres!"
     * )
     *
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $host = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\NumberType",
     *     required=true
     * )
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Assert\NotBlank(
     *     message="O campo não pode estar em branco!"
     * )
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     * @Assert\Length(
     *     min = 2,
     *     minMessage = "O campo deve ter no mínimo 2 caracteres!",
     *     max = 255,
     *     maxMessage = "O campo deve ter no máximo 255 caracteres!"
     * )
     *
     * @OA\Property(type="integer", default=0)
     * @DTOMapper\Property()
     */
    protected int $porta = 0;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=true
     * )
     * @Filter\ToUpper(encoding="UTF-8")
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Assert\NotBlank(
     *     message="O campo não pode estar em branco!"
     * )
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     * @Assert\Length(
     *     min = 3,
     *     minMessage = "O campo deve ter no mínimo 3 caracteres!",
     *     max = 255,
     *     maxMessage = "O campo deve ter no máximo 255 caracteres!"
     * )
     *
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $protocolo = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=true
     * )
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\ToUpper(encoding="UTF-8")
     * @Filter\StripNewlines()
     * @Assert\Length(
     *     max = 255,
     *     maxMessage = "O campo deve ter no máximo 255 caracteres!"
     * )
     *
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $metodoEncriptacao = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\CheckboxType",
     *     required=false
     * )
     *
     * @OA\Property(type="boolean", default=true)
     * @DTOMapper\Property()
     */
    protected ?bool $validaCertificado = true;

    /**
     * @return string|null
     */
    public function getHost(): ?string
    {
        return $this->host;
    }

    /**
     * @param string|null $host
     * @return EntityInterface
     */
    public function setHost(?string $host): EntityInterface
    {
        $this->setVisited('host');
        $this->host = $host;

        return $this;
    }

    /**
     * @return int
     */
    public function getPorta(): int
    {
        return $this->porta;
    }

    /**
     * @param int $porta
     * @return EntityInterface
     */
    public function setPorta(int $porta): EntityInterface
    {
        $this->setVisited('porta');
        $this->porta = $porta;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getProtocolo(): ?string
    {
        return $this->protocolo;
    }

    /**
     * @param string|null $protocolo
     * @return EntityInterface
     */
    public function setProtocolo(?string $protocolo): EntityInterface
    {
        $this->setVisited('protocolo');
        $this->protocolo = $protocolo;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMetodoEncriptacao(): ?string
    {
        return $this->metodoEncriptacao;
    }

    /**
     * @param string|null $metodoEncriptacao
     * @return EntityInterface
     */
    public function setMetodoEncriptacao(?string $metodoEncriptacao): EntityInterface
    {
        $this->setVisited('metodoEncriptacao');
        $this->metodoEncriptacao = $metodoEncriptacao;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getValidaCertificado(): ?bool
    {
        return $this->validaCertificado;
    }

    /**
     * @param bool|null $validaCertificado
     * @return EntityInterface
     */
    public function setValidaCertificado(?bool $validaCertificado): EntityInterface
    {
        $this->setVisited('validaCertificado');
        $this->validaCertificado = $validaCertificado;

        return $this;
    }
}
