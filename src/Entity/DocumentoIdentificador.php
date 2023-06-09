<?php

declare(strict_types=1);
/**
 * /src/Entity/DocumentoIdentificador.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Entity;

use DateTime;
use DMS\Filter\Rules as Filter;
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
 * Class DocumentoIdentificador.
 *
 *  @ORM\Table(
 *     name="ad_doc_identificador"
 * )
 * @ORM\Entity()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @Gedmo\SoftDeleteable(fieldName="apagadoEm")
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class DocumentoIdentificador implements EntityInterface
{
    // Traits
    use Blameable;
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
     * @Assert\NotBlank(
     *     message="O campo não pode estar em branco!"
     * )
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     * @Assert\Length(
     *     max = 255,
     *     maxMessage = "O campo deve ter no máximo 255 caracteres!"
     * )
     *
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Filter\ToUpper(encoding="UTF-8")
     * @ORM\Column(
     *     name="codigo_documento",
     *     type="string",
     *     nullable=false
     * )
     */
    protected string $codigoDocumento;

    /**
     * @Assert\NotBlank(
     *     message="O campo não pode estar em branco!"
     * )
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     * @Assert\Length(
     *     max = 255,
     *     maxMessage = "O campo deve ter no máximo 255 caracteres!"
     * )
     *
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Filter\ToUpper(encoding="UTF-8")
     * @ORM\Column(
     *     name="emissor_documento",
     *     type="string",
     *     nullable=false
     * )
     */
    protected string $emissorDocumento;

    /**
     * @ORM\Column(
     *     type="date",
     *     name="data_emissao",
     *     nullable=true
     * )
     */
    protected ?DateTime $dataEmissao = null;

    /**
     * @Assert\Length(
     *     max = 255,
     *     maxMessage = "O campo deve ter no máximo 255 caracteres!"
     * )
     *
     * @Filter\StripTags()
     * @Filter\Trim()
     * @Filter\StripNewlines()
     * @Filter\ToUpper(encoding="UTF-8")
     * @ORM\Column(
     *     type="string",
     *     nullable=true
     * )
     */
    protected ?string $nome = null;

    /**
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(
     *     targetEntity="ModalidadeDocumentoIdentificador"
     * )
     * @ORM\JoinColumn(
     *     name="mod_doc_identificador_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected ModalidadeDocumentoIdentificador $modalidadeDocumentoIdentificador;

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
     * @Assert\NotNull(
     *     message="O campo não pode ser nulo!"
     * )
     *
     * @ORM\ManyToOne(
     *     targetEntity="Pessoa",
     *     inversedBy="documentosIdentificadores"
     * )
     * @ORM\JoinColumn(
     *     name="pessoa_id",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected Pessoa $pessoa;

    /**
     * @return string
     */
    public function getCodigoDocumento(): string
    {
        return $this->codigoDocumento;
    }

    /**
     * @param string $codigoDocumento
     *
     * @return DocumentoIdentificador
     */
    public function setCodigoDocumento(string $codigoDocumento): self
    {
        $this->codigoDocumento = $codigoDocumento;

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
     * @return DocumentoIdentificador
     */
    public function setOrigemDados(?OrigemDados $origemDados): self
    {
        $this->origemDados = $origemDados;

        return $this;
    }

    /**
     * @return Pessoa
     */

    /**
     * @return Pessoa
     */
    public function getPessoa(): Pessoa
    {
        return $this->pessoa;
    }

    /**
     * @param Pessoa $pessoa
     *
     * @return DocumentoIdentificador
     */
    public function setPessoa(Pessoa $pessoa): self
    {
        $this->pessoa = $pessoa;

        return $this;
    }

    /**
     * @return string
     */

    /**
     * @return string
     */
    public function getEmissorDocumento(): string
    {
        return $this->emissorDocumento;
    }

    /**
     * @param string $emissorDocumento
     *
     * @return DocumentoIdentificador
     */
    public function setEmissorDocumento(string $emissorDocumento): self
    {
        $this->emissorDocumento = $emissorDocumento;

        return $this;
    }

    /**
     * @return string|null
     */

    /**
     * @return string|null
     */
    public function getNome(): ?string
    {
        return $this->nome;
    }

    /**
     * @param string|null $nome
     *
     * @return DocumentoIdentificador
     */
    public function setNome(?string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * @return ModalidadeDocumentoIdentificador
     */

    /**
     * @return ModalidadeDocumentoIdentificador
     */
    public function getModalidadeDocumentoIdentificador(): ModalidadeDocumentoIdentificador
    {
        return $this->modalidadeDocumentoIdentificador;
    }

    /**
     * @param ModalidadeDocumentoIdentificador $modalidadeDocumentoIdentificador
     *
     * @return DocumentoIdentificador
     */
    public function setModalidadeDocumentoIdentificador(
        ModalidadeDocumentoIdentificador $modalidadeDocumentoIdentificador
    ): self {
        $this->modalidadeDocumentoIdentificador = $modalidadeDocumentoIdentificador;

        return $this;
    }

    /**
     * @return DateTime|null
     */

    /**
     * @return DateTime|null
     */
    public function getDataEmissao(): ?DateTime
    {
        return $this->dataEmissao;
    }

    /**
     * @param DateTime|null $dataEmissao
     *
     * @return DocumentoIdentificador
     */
    public function setDataEmissao(?DateTime $dataEmissao): self
    {
        $this->dataEmissao = $dataEmissao;

        return $this;
    }
}
