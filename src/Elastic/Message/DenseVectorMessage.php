<?php

declare(strict_types=1);
/**
 * /src/Api/V1/Triggers/Modelo/Message/DenseVectorMessage.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Elastic\Message;

/**
 * Class DenseVectorMessage.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class DenseVectorMessage
{
    private int $id;
    private string $index;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getIndex(): string
    {
        return $this->index;
    }

    /**
     * @param string $index
     */
    public function setIndex(string $index): void
    {
        $this->index = $index;
    }
}
