<?php

declare(strict_types=1);
/**
 * /src/Api/V1/Pipes/Documento/Pipe0002.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Mapper\Pipes\Documento;

use Exception;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Documento as DocumentoDTO;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\ComponenteDigital as ComponenteDigitalEntity;
use SuppCore\AdministrativoBackend\Entity\Documento as DocumentoEntity;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Mapper\Pipes\PipeInterface;
use SuppCore\AdministrativoBackend\Repository\DocumentoRepository;

/**
 * Class Pipe0002.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Pipe0002 implements PipeInterface
{
    public function __construct(private DocumentoRepository $documentoRepository)
    {
    }

    public function supports(): array
    {
        return [
            DocumentoDTO::class => [
                'onCreateDTOFromEntity',
            ],
        ];
    }

    /**
     * @param DocumentoDTO|RestDtoInterface|null $restDto
     * @param DocumentoEntity|EntityInterface    $entity
     *
     * @throws Exception
     */
    public function execute(?RestDtoInterface &$restDto, EntityInterface $entity): void
    {
        $restDto->setAssinado($this->documentoRepository->isAssinado($entity->getId()));
    }

    public function getOrder(): int
    {
        return 1;
    }
}
