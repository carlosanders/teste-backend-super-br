<?php

declare(strict_types=1);

namespace SuppCore\AdministrativoBackend\Entity;

use Doctrine\ORM\Mapping as ORM;
use SuppCore\AdministrativoBackend\Entity\Traits\Id;
use SuppCore\AdministrativoBackend\Entity\Traits\Uuid;

/**
 * Class Anotacao.
 *
 *  @ORM\Table(
 *     name="ad_anotacao",
 * )
 * @ORM\Entity()
 */
class Anotacao implements EntityInterface {

    use Id;
    use Uuid;

    public function __construct()
    {
        $this->setUuid();

    }

    /**
     * @ORM\Column(
     *  type="string",
     *  nullable=false
     * )
     */
    private string $descricao = '';

    /**
     * @ORM\Column(
     *  type="boolean",
     *  nullable=true
     * )
     */
    private bool $ativo = false;

    public function setDescricao(string $descricao): self {
        $this->descricao = $descricao;
        return $this;
    }

    public function getDescricao(): string {
        return $this->descricao;
    }

    public function setAtivo(bool $ativo): self {
        $this->ativo = $ativo;
        return $this;
    }

    public function getAtivo(): bool {
        return $this->ativo;
    }

}