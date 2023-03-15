<?php

declare(strict_types=1);
/**
 * /src/Api/V1/DTO/TipoDossie.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\DTO;

use SuppCore\AdministrativoBackend\DTO\RestDto;
use SuppCore\AdministrativoBackend\DTO\Traits\Ativo;
use SuppCore\AdministrativoBackend\DTO\Traits\Blameable;
use SuppCore\AdministrativoBackend\DTO\Traits\Descricao;
use SuppCore\AdministrativoBackend\DTO\Traits\IdUuid;
use SuppCore\AdministrativoBackend\DTO\Traits\Nome;
use SuppCore\AdministrativoBackend\DTO\Traits\Sigla;
use SuppCore\AdministrativoBackend\DTO\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\DTO\Traits\Timeblameable;
use SuppCore\AdministrativoBackend\Form\Annotations as Form;
use SuppCore\AdministrativoBackend\Mapper\Annotations as DTOMapper;
use SuppCore\AdministrativoBackend\Validator\Constraints as AppAssert;
use OpenApi\Annotations as OA;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class TipoDossie.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 *
 * @AppAssert\DtoUniqueEntity(
 *     fieldMapping = {"nome": "nome"},
 *     entityClass="SuppCore\AdministrativoBackend\Entity\TipoDossie",
 *     message = "Campo já está em utilização!"
 * )
 *
 * @DTOMapper\JsonLD(
 *     jsonLDId="/v1/administrativo/tipo_dossie/{id}",
 *     jsonLDType="TipoDossie",
 *     jsonLDContext="/api/doc/#model-TipoDossie"
 * )
 *
 * @Form\Form()
 */
class TipoDossie extends RestDto
{
    use Timeblameable;
    use Blameable;
    use Softdeleteable;
    use IdUuid;
    use Nome;
    use Sigla;
    use Descricao;
    use Ativo;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\TextType",
     *     required=false
     * )
     * @Assert\Length(
     *     max = 40,
     *     maxMessage = "O campo deve ter no máximo 40 caracteres!"
     * )
     *
     * @OA\Property(type="string")
     * @DTOMapper\Property()
     */
    protected string $fonteDados;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\NumberType",
     *     required=false
     * )
     *
     * @OA\Property(type="integer", default=0)
     * @DTOMapper\Property()
     */
    protected ?int $periodoGuarda = null;

    /**
     * @Form\Field(
     *     "Symfony\Component\Form\Extension\Core\Type\CheckboxType",
     *     required=false
     * )
     *
     * @OA\Property(type="boolean")
     * @DTOMapper\Property()
     */
    protected ?bool $datalake = null;

    /**
     * Set datalake.
     *
     * @param bool|null $datalake
     *
     * @return self
     */
    public function setDatalake(?bool $datalake): self
    {
        $this->setVisited('datalake');

        $this->datalake = $datalake;

        return $this;
    }

    /**
     * Get datalake|null.
     *
     * @return bool|null
     */
    public function getDatalake(): ?bool
    {
        return $this->datalake;
    }

    /**
     * @return string
     */
    public function getFonteDados(): string
    {
        return $this->fonteDados;
    }

    /**
     * @param string $fonteDados
     * @return TipoDossie
     */
    public function setFonteDados(string $fonteDados): self
    {
        $this->setVisited('fonteDados');

        $this->fonteDados = $fonteDados;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPeriodoGuarda(): ?int
    {
        return $this->periodoGuarda;
    }

    /**
     * @param int $periodoGuarda
     * @return TipoDossie
     */
    public function setPeriodoGuarda(int $periodoGuarda): self
    {
        $this->setVisited('periodoGuarda');
        $this->periodoGuarda = $periodoGuarda;

        return $this;
    }
}
