<?php

declare(strict_types=1);
/**
 * /src/Counter/CounterManager.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Counter;

use function ksort;
use Symfony\Component\Messenger\MessageBusInterface;

/**
 * Class CounterManager.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class CounterManager
{
    /**
     * @var CounterInterface[]
     */
    protected array $counter = [];

    private MessageBusInterface $bus;

    /**
     * @return CounterInterface[]
     */
    public function getCounter(): array
    {
        return $this->counter;
    }

    /**
     * CounterManager constructor.
     *
     * @param MessageBusInterface $bus
     */
    public function __construct(
        MessageBusInterface $bus
    ) {
        $this->bus = $bus;
    }

    /**
     * @param CounterInterface $counter
     */
    public function addCounter(CounterInterface $counter): void
    {
        $this->counter[$counter->getOrder()][] = $counter;
    }

    public function proccess(): void
    {
        ksort($this->counter);

        foreach ($this->counter as $counterOrdered) {
            /** @var CounterInterface $counter */
            foreach ($counterOrdered as $counter) {
                foreach ($counter->getMessages() as $message) {
                    $this->bus->dispatch($message);
                }
            }
        }
    }
}
