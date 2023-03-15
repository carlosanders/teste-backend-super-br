<?php

declare(strict_types=1);
/**
 * /src/Rest/Controller.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Monolog\Processor;

use Monolog\Logger;

/**
 * Injects line/file:class/function where the log message came from.
 *
 * Warning: This only works if the handler processes the logs directly.
 * If you put the processor on a handler that is behind a FingersCrossedHandler
 * for example, the processor will only be called once the trigger level is reached,
 * and all the log records will have the same file/line/.. data from the call that
 * triggered the FingersCrossedHandler.
 *
 * @author Jordi Boggiano <j.boggiano@seld.be>
 */
class IntrospectionProcessor
{
    private int $level;

    private array $skipClassesPartials;

    private array $skipFunctions = [
        'call_user_func',
        'call_user_func_array',
    ];

    /**
     * IntrospectionProcessor constructor.
     *
     * @param int $level
     * @param array $skipClassesPartials
     */
    public function __construct(int $level = Logger::DEBUG, array $skipClassesPartials = [])
    {
        $this->level = Logger::toMonologLevel($level);
        $this->skipClassesPartials = [...['Monolog\\'], ...$skipClassesPartials];
    }

    public function __invoke(array $record): array
    {
        // return if the level is not high enough
        if ($record['level'] < $this->level) {
            return $record;
        }

        $trace = debug_backtrace();

        // skip first since it's always the current method
        array_shift($trace);
        // the call_user_func call is also skipped
        array_shift($trace);

        $i = 0;

        while ($this->isTraceClassOrSkippedFunction($trace, $i)) {
            if (isset($trace[$i]['class'])) {
                foreach ($this->skipClassesPartials as $part) {
                    if (str_contains($trace[$i]['class'], $part)) {
                        ++$i;
                        continue 2;
                    }
                }
            } elseif (in_array($trace[$i]['function'], $this->skipFunctions)) {
                ++$i;
                continue;
            }

            break;
        }

        // we should have the call source now
        $record['extra'] = array_merge(
            $record['extra'],
            [
                'file' => $trace[$i - 1]['file'] ?? null,
                'line' => $trace[$i - 1]['line'] ?? null,
                'class' => $trace[$i]['class'] ?? null,
                'function' => $trace[$i]['function'] ?? null,
            ]
        );

        return $record;
    }

    /**
     * @param $index
     */
    private function isTraceClassOrSkippedFunction(array $trace, $index): bool
    {
        if (!isset($trace[$index])) {
            return false;
        }

        return isset($trace[$index]['class']) || in_array($trace[$index]['function'], $this->skipFunctions);
    }
}
