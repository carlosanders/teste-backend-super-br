<?php

declare(strict_types=1);
/**
 * /src/Api/V1/DTO/ContaEmail.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
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
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Form\Annotations as Form;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;
use OpenApi\Annotations as OA;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Setor as SetorDTO;
use SuppCore\AdministrativoBackend\Api\V1\DTO\ServidorEmail as ServidorEmailDTO;
use Symfony\Component\Validator\Constraints as Assert;
use SuppCore\AdministrativoBackend\Validator\Constraints as AppAssert;
use DMS\Filter\Rules as Filter;
use JMS\Serializer\Annotation as Serializer;

/**
 * Class ContaEmail.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 * @AppAssert\DtoUniqueEntity(
 *     fieldMapping = {"nome": "nome","setor": "setor"},
 *     entityClass="SuppCore\AdministrativoBackend\Entity\ContaEmail",
 *     message = "Campo já está em utilização!"
 * )
 * @DTOMapper\JsonLD(
 *     jsonLDId="/v1/administrativo/conta_email/{id}",
 *     jsonLDType="ContaEmail",
 *     jsonLDContext="/api/doc/#model-ContaEmail"
 * )
 *
 * @Form\Form()
 */
class ContaEmail extends RestDto
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
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\Setor",
     *     required=false
     * )
     *
     * @OA\Property(ref=@Model(type=SetorDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\Setor")
     */
    protected ?EntityInterface $setor = null;

    /**
     * @Form\Field(
     *     "Symfony\Bridge\Doctrine\Form\Type\EntityType",
     *     class="SuppCore\AdministrativoBackend\Entity\ServidorEmail",
     *     required=true
     * )
     *
     * @OA\Property(ref=@Model(type=ServidorEmailDTO::class))
     * @DTOMapper\Property(dtoClass="SuppCore\AdministrativoBackend\Api\V1\DTO\ServidorEmail")
     */
    protected ?EntityInterface $servidorEmail = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=true
     * )
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     *
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $metodoAutenticacao = null;

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
    protected ?string $login = null;

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
     * @Serializer\Exclude
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected ?string $senha = null;

    /**
     * @return EntityInterface|null
     */
    public function getServidorEmail(): ?EntityInterface
    {
        return $this->servidorEmail;
    }

    /**
     * @param EntityInterface|null $servidorEmail
     * @return ContaEmail
     */
    public function setServidorEmail(?EntityInterface $servidorEmail): self
    {
        $this->setVisited('servidorEmail');
        $this->servidorEmail = $servidorEmail;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLogin(): ?string
    {
        return $this->login;
    }

    /**
     * @param string|null $login
     * @return ContaEmail
     */
    public function setLogin(?string $login): self
    {
        $this->setVisited('login');
        $this->login = $login;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSenha(): ?string
    {
        return $this->senha;
    }

    /**
     * @param string|null $senha
     * @return ContaEmail
     */
    public function setSenha(?string $senha): self
    {
        $this->setVisited('senha');
        $this->senha = $senha;

        return $this;
    }

    /**
     * @return EntityInterface|null
     */
    public function getSetor(): ?EntityInterface
    {
        return $this->setor;
    }

    /**
     * @param EntityInterface|null $setor
     * @return ContaEmail
     */
    public function setSetor(?EntityInterface $setor): self
    {
        $this->setVisited('setor');
        $this->setor = $setor;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMetodoAutenticacao(): ?string
    {
        return $this->metodoAutenticacao;
    }

    /**
     * @param string|null $metodoAutenticacao
     * @return ContaEmail
     */
    public function setMetodoAutenticacao(?string $metodoAutenticacao): self
    {
        $this->setVisited('metodoAutenticacao');
        $this->metodoAutenticacao = $metodoAutenticacao;

        return $this;
    }
}
