<?php

declare(strict_types=1);
/**
 * /src/Entity/Assinatura.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Gedmo\Mapping\Annotation as Gedmo;
use SuppCore\AdministrativoBackend\Entity\Traits\Blameable;
use SuppCore\AdministrativoBackend\Entity\Traits\Id;
use SuppCore\AdministrativoBackend\Entity\Traits\Softdeleteable;
use SuppCore\AdministrativoBackend\Entity\Traits\Timestampable;
use SuppCore\AdministrativoBackend\Entity\Traits\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Assinatura.
 *
 *  @ORM\Table(
 *     name="ad_assinatura",
 * )
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Assinatura implements EntityInterface
{
    // Traits
    use Timestampable;
    use Softdeleteable;
    use Id;
    use Uuid;

    /**
     * Constructor.
     *
     * @throws Exception
     */
    public function __construct()
    {
        $this->setUuid();
    }

    /**
     * @ORM\ManyToOne(targetEntity="SuppCore\AdministrativoBackend\Entity\Usuario")
     * @ORM\JoinColumn(
     *     name="criado_por",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?Usuario $criadoPor = null;

    /**
     * @Gedmo\Blameable(on="update")
     * @ORM\ManyToOne(
     *     targetEntity="SuppCore\AdministrativoBackend\Entity\Usuario"
     * )
     * @ORM\JoinColumn(
     *     name="atualizado_por",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?Usuario $atualizadoPor = null;

    /**
     * @return Usuario|null
     */
    public function getCriadoPor(): ?Usuario
    {
        return $this->criadoPor;
    }

    /**
     * @param Usuario|null $criadoPor
     *
     * @return $this
     */
    public function setCriadoPor(?Usuario $criadoPor = null): self
    {
        $this->criadoPor = $criadoPor;

        return $this;
    }

    /**
     * @return Usuario|null
     */
    public function getAtualizadoPor(): ?Usuario
    {
        return $this->atualizadoPor;
    }

    /**
     * @param Usuario|null $atualizadoPor
     *
     * @return $this
     */
    public function setAtualizadoPor(?Usuario $atualizadoPor = null): self
    {
        $this->atualizadoPor = $atualizadoPor;

        return $this;
    }

    /**
     * @Assert\NotBlank(
     *     message="Campo não pode estar em branco."
     * )
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     * @Assert\Length(
     *     max = 255,
     *     maxMessage = "O campo deve ter no máximo 255 caracteres!"
     * )
     * @ORM\Column(
     *     type="string",
     *     name="algoritmo_hash",
     *     nullable=false
     * )
     */
    protected string $algoritmoHash;

    /**
     * @Assert\NotBlank(
     *     message="Campo não pode estar em branco."
     * )
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     * @ORM\Column(
     *     type="text",
     *     nullable=false
     * )
     */
    protected string $assinatura;

    /**
     * @Assert\NotBlank(
     *     message="Campo não pode estar em branco."
     * )
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     * @ORM\Column(
     *     name="certificados_pem",
     *     type="text",
     *     nullable=false
     * )
     */
    protected string $cadeiaCertificadoPEM;

    /**
     * @ORM\Column(
     *     name="certificados_pki_path",
     *     type="text",
     *     nullable=true
     * )
     */
    protected ?string $cadeiaCertificadoPkiPath = null;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     * @ORM\Column(
     *     name="data_hora_assinatura",
     *     type="datetime",
     *     nullable=false
     * )
     */
    protected DateTime $dataHoraAssinatura;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(
     *     targetEntity="ComponenteDigital",
     *     inversedBy="assinaturas"
     * )
     * @ORM\JoinColumn(
     *     name="componente_digital_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected ComponenteDigital $componenteDigital;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="OrigemDados",
     *     cascade={"persist"}
     * )
     * @ORM\JoinColumn(
     *     name="origem_dados_id",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected ?OrigemDados $origemDados = null;

    /**
     * @return string
     */
    public function getAlgoritmoHash(): string
    {
        return $this->algoritmoHash;
    }

    /**
     * @param string $algoritmoHash
     *
     * @return Assinatura
     */
    public function setAlgoritmoHash(string $algoritmoHash): self
    {
        $this->algoritmoHash = $algoritmoHash;

        return $this;
    }

    /**
     * @return string
     */
    public function getAssinatura(): string
    {
        return $this->assinatura;
    }

    /**
     * @param string $assinatura
     *
     * @return Assinatura
     */
    public function setAssinatura(string $assinatura): self
    {
        $this->assinatura = $assinatura;

        return $this;
    }

    /**
     * @return string
     */
    public function getCadeiaCertificadoPEM(): string
    {
        return $this->cadeiaCertificadoPEM;
    }

    /**
     * @param string $cadeiaCertificadoPEM
     *
     * @return Assinatura
     */
    public function setCadeiaCertificadoPEM(string $cadeiaCertificadoPEM): self
    {
        $this->cadeiaCertificadoPEM = $cadeiaCertificadoPEM;

        return $this;
    }

    /**
     * @return string
     */
    public function getCadeiaCertificadoPkiPath(): ?string
    {
        return $this->cadeiaCertificadoPkiPath;
    }

    /**
     * @param string $cadeiaCertificadoPkiPath
     *
     * @return Assinatura
     */
    public function setCadeiaCertificadoPkiPath(?string $cadeiaCertificadoPkiPath): self
    {
        $this->cadeiaCertificadoPkiPath = $cadeiaCertificadoPkiPath;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDataHoraAssinatura(): DateTime
    {
        return $this->dataHoraAssinatura;
    }

    /**
     * @param DateTime $dataHoraAssinatura
     *
     * @return Assinatura
     */
    public function setDataHoraAssinatura(DateTime $dataHoraAssinatura): self
    {
        $this->dataHoraAssinatura = $dataHoraAssinatura;

        return $this;
    }

    /**
     * @return ComponenteDigital
     */
    public function getComponenteDigital(): ComponenteDigital
    {
        return $this->componenteDigital;
    }

    /**
     * @param ComponenteDigital $componenteDigital
     *
     * @return Assinatura
     */
    public function setComponenteDigital(ComponenteDigital $componenteDigital): self
    {
        $this->componenteDigital = $componenteDigital;

        return $this;
    }

    /**
     * @return OrigemDados|null
     */
    public function getOrigemDados(): ?OrigemDados
    {
        return $this->origemDados;
    }

    /**
     * @param OrigemDados|null $origemDados
     *
     * @return Assinatura
     */
    public function setOrigemDados(?OrigemDados $origemDados): self
    {
        $this->origemDados = $origemDados;

        return $this;
    }
}
