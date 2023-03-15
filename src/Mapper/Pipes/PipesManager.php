<?php

declare(strict_types=1);
/**
 * /src/Mapper/Pipes/PipesManager.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Mapper\Pipes;

use function get_class;
use function in_array;
use function ksort;
use SuppCore\AdministrativoBackend\Doctrine\ORM\Immutable\ImmutableService;
use SuppCore\AdministrativoBackend\DTO\RestDtoInterface;
use SuppCore\AdministrativoBackend\Entity\EntityInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Stopwatch\Stopwatch;

/**
 * Class PipesManager.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class PipesManager
{
    /**
     * @var PipeInterface[]
     */
    protected array $pipes = [];

    protected array $pipesConfig = [];

    /**
     * @return PipeInterface[]
     */
    public function getPipes(): array
    {
        return $this->pipes;
    }

    /**
     * PipesManager constructor.
     *
     * @param ParameterBagInterface $params
     * @param ImmutableService      $immutableService
     */
    public function __construct(
        ParameterBagInterface $params,
        private ImmutableService $immutableService,
        private Stopwatch $stopwatch
    ) {
        $this->pipesConfig = $params->get('pipes');
    }

    /**
     * @param PipeInterface $pipe
     */
    public function addPipe(PipeInterface $pipe): void
    {
        $this->pipes[$pipe->getOrder()][] = $pipe;
    }

    /**
     * @param RestDtoInterface|null $restDto
     * @param EntityInterface       $entity
     * @param string                $context
     */
    public function proccess(
        ?RestDtoInterface &$restDto,
        EntityInterface $entity,
        string $context
    ): void {
        if ($this->immutableService->isImmutable($entity)) {
            $restDto->setImmutable(true);
        }

        $className = get_class($restDto);
        ksort($this->pipes);

        foreach ($this->pipes as $pipeOrdered) {
            /** @var PipeInterface $pipe */
            foreach ($pipeOrdered as $pipe) {
                $supports = $pipe->supports();
                if (array_key_exists($className, $supports) &&
                    in_array($context, $supports[$className], true)) {
                    $this->stopwatch->start($context.':'.get_parent_class($pipe));
                    $pipe->execute($restDto, $entity);
                    $this->stopwatch->stop($context.':'.get_parent_class($pipe));
                }
            }
        }
    }
}
