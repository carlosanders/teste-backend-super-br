<?php


namespace SuppCore\AdministrativoBackend\Utils;


use Knp\Snappy\Pdf;
use Psr\Log\LoggerInterface;
use RuntimeException;
use Symfony\Component\Process\Process;

/**
 * Class PDFTools
 * @package SuppCore\AdministrativoBackend\Utils
 */
class PDFTools implements PDFToolsInterface
{
    public const DEFAULT_TIMEOUT = 120;

    private float $timeout = self::DEFAULT_TIMEOUT;

    /**
     * PDFTools constructor.
     * @param LoggerInterface $logger
     * @param Pdf $pdfManager
     */
    public function __construct(private LoggerInterface $logger,
                                private Pdf $pdfManager)
    {
    }

    /**
     * @param float $timeout
     * @return PDFToolsInterface
     */
    public function setTimeout(float $timeout): PDFToolsInterface
    {
        $this->timeout = $timeout;

        return $this;
    }

    /**
     * Informa se existem imagens dentro do PDF
     * @param string $path
     * @return bool
     */
    public function hasImages(string $path): bool
    {
        $process = Process::fromShellCommandline(
            "pdfimages $path -list",
            timeout: $this->timeout
        );
        $process->setTimeout($this->timeout);
        $resultCode = $process->run();
        $process->wait();

        if ($resultCode !== 0) {
            $this->logger->error($process->getErrorOutput());
            throw new RuntimeException('Erro ao verificar imagens do PDF.');
        }


        return substr_count($process->getOutput(), "\n") > 1;
    }

    /**
     * Converte um PDF para Imagem
     * @param string $path
     * @param string $output
     */
    public function pdfToImage(string $path, string $output): void
    {
        $process = Process::fromShellCommandline(
            "convert"
            . " -density 300"
            . " $path"
            . " -depth 8"
            . " -quality 90"
            . " -strip"
            . " -background white"
            . " -alpha off"
            . " -append"
            . " $output",
            timeout: $this->timeout
        );
        $resultCode = $process->run();
        $process->wait();

        if ($resultCode !== 0) {
            $this->logger->error($process->getErrorOutput());
            throw new RuntimeException('Erro ao converter PDF em imagem.');
        }
    }

    /**
     * Extrai o texto do PDF
     * @param string $path
     * @return string
     */
    public function getText(string $path): string
    {
        $process = Process::fromShellCommandline(
            "pdftotext -layout $path -",
            timeout: $this->timeout
        );
        $resultCode = $process->run();
        $process->wait();

        if ($resultCode !== 0) {
            $this->logger->error($process->getErrorOutput());
            throw new RuntimeException('Erro ao extrair texto do PDF.');
        }

        return trim($process->getOutput());
    }

    /**
     * Informa se o pdf contem texto
     * @param string $path
     * @return bool
     */
    public function hasText(string $path): bool
    {
        return !empty(trim(preg_replace('/\s+/S', " ", $this->getText($path))));
    }

    /**
     * Convert text to PDF
     * @param string $text
     * @return string
     */
    public function textToPDF(string $text): string
    {
        return $this->pdfManager->getOutputFromHtml($text);
    }
}
