<?php


namespace SuppCore\AdministrativoBackend\Utils;

/**
 * Interface PDFToolsInterface
 * @package SuppCore\AdministrativoBackend\Utils
 */
interface PDFToolsInterface
{

    /**
     * Informa se existem imagens dentro do PDF
     * @param string $path
     * @return bool
     */
    public function hasImages(string $path): bool;

    /**
     * Converte o PDF para Imagem
     * @param string $path
     * @param string $output
     */
    public function pdfToImage(string $path, string $output): void;

    /**
     * Extrai o texto do PDF
     * @param string $path
     * @return string
     */
    public function getText(string $path): string;

    /**
     * Informa se o pdf contem texto
     * @param string $path
     * @return bool
     */
    public function hasText(string $path): bool;

    /**
     * Convert text to PDF
     * @param string $text
     * @return string
     */
    public function textToPDF(string $text): string;

    /**
     * Seta o timeout em segundos
     * @param float $timeout
     * @return $this
     */
    public function setTimeout(float $timeout): self;

}
