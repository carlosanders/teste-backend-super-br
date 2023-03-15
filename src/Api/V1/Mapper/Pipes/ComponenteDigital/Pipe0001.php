<?php

declare(strict_types=1);
/**
 * /src/Api/V1/Pipes/ComponenteDigital/Pipe0001.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Api\V1\Mapper\Pipes\ComponenteDigital;

use Exception;
use SuppCore\AdministrativoBackend\Api\V1\DTO\ComponenteDigital as ComponenteDigitalDTO;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\ComponenteDigital as ComponenteDigitalEntity;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use SuppCore\AdministrativoBackend\Mapper\Pipes\PipeInterface;
use SuppCore\AdministrativoBackend\Repository\ComponenteDigitalRepository;

/**
 * Class Pipe0001.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class Pipe0001 implements PipeInterface
{
    public function __construct(private ComponenteDigitalRepository $componenteDigitalRepository)
    {
    }

    public function supports(): array
    {
        return [
            ComponenteDigitalDTO::class => [
                'onCreateDTOFromEntity',
            ],
        ];
    }

    /**
     * @param ComponenteDigitalDTO|RestDtoInterface|null $restDto
     * @param ComponenteDigitalEntity|EntityInterface    $entity
     *
     * @throws Exception
     */
    public function execute(?RestDtoInterface &$restDto, EntityInterface $entity): void
    {
        $restDto->setAssinado(
            $entity->getId() && $this->componenteDigitalRepository->isAssinado($entity->getId())
        );
    }

    public function getOrder(): int
    {
        return 1;
    }
}
