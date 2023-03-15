<?php

declare(strict_types=1);
/**
 * /src/Diagnostics/Check/Messenger.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Diagnostics\Check;

use Laminas\Diagnostics\Check\CheckInterface;
use Laminas\Diagnostics\Result\Failure;
use Laminas\Diagnostics\Result\Success;
use Laminas\Diagnostics\Result\Warning;
use SuppCore\AdministrativoBackend\Diagnostics\Message\Test;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Process\Process;

/**
 * Check Messenger component.
 */
class Messenger implements CheckInterface
{
    /**
     * Define o tempo estimado para a execução do teste.
     */
    private const ESTIMATED_TIME = 1.5;

    public function __construct(
        private MessageBusInterface $bus
    ) {
    }

    public function check(): Failure|Success|Warning
    {
        $startTime = microtime(true);

        try {
            $hash = hash('sha256', (string) rand());
            $object = new \stdClass();
            $object->hash = $hash;

            $this->bus->dispatch(new Test(serialize($object)));

            $process = Process::fromShellCommandline(
                'php bin/console messenger:consume test_liip_monitor --time-limit=5'
            );

            $process->start();

            $fileName = '/tmp/'.$hash.'.txt';

            while ($process->isRunning()) {
                if (is_readable($fileName)) {
                    $process->stop();
                }
            }

            $fp = fopen($fileName, 'r');
            $conteudo = fread($fp, filesize($fileName));
            fclose($fp);
            unlink($fileName);

            if ($hash !== $conteudo) {
                throw new \UnexpectedValueException('O arquivo contém um valor inesperado');
            }

            $endTime = microtime(true);
        } catch (\Throwable $e) {
            return new Failure($e->getMessage());
        }

        $time = $endTime - $startTime;

        if ($time > self::ESTIMATED_TIME) {
            return new Warning(sprintf('Teste executado em %f segundos', $time));
        }

        return new Success(sprintf('Teste executado em %f segundos', $time));
    }

    public function getLabel(): string
    {
        return 'Messenger';
    }
}
