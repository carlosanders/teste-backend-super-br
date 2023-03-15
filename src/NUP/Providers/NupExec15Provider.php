<?php

declare(strict_types=1);
/**
 * /src/NUP/NupExec15Provider.php.
 */

namespace SuppCore\AdministrativoBackend\NUP\Providers;

use DateTime;
use Exception;
use SuppCore\AdministrativoBackend\Api\V1\DTO\Processo as ProcessoDTO;
use SuppCore\AdministrativoBackend\Entity\Processo as ProcessoEntity;
use SuppCore\AdministrativoBackend\NUP\NumeroUnicoProtocoloInterface;
use SuppCore\AdministrativoBackend\Rules\RulesTranslate;

/**
 * Class NupExec15Provider.
 */
class NupExec15Provider implements NumeroUnicoProtocoloInterface
{
    private RulesTranslate $rulesTranslate;

    /**
     * NupExec15Provider constructor.
     *
     * @param RulesTranslate $rulesTranslate
     */
    public function __construct(
        RulesTranslate $rulesTranslate
    ) {
        $this->rulesTranslate = $rulesTranslate;
    }

    /**
     * @param ProcessoDTO $processo
     *
     * @return string
     *
     * @throws Exception
     */
    public function gerarNumeroUnicoProtocolo(ProcessoDTO $processo): string
    {
        throw new Exception('Esse gerador de NUP não possui mais validade!');
    }

    /**
     * @param ProcessoDTO $processo
     * @param string|null $errorMessage
     *
     * @return bool
     *
     * @throws Exception
     */
    public function validarNumeroUnicoProtocolo(ProcessoDTO $processo, string &$errorMessage = null): bool
    {
        try {
            if ((ProcessoEntity::UA_PROCESSO !== $processo->getUnidadeArquivistica() &&
                        ProcessoEntity::UA_DOCUMENTO_AVULSO !== $processo->getUnidadeArquivistica()) ||
                    $processo->getNupInvalido()) {
                return true;
            }

                $digitos = str_replace(['-', '.', '/', '\\', ' '], '', $processo->getNUP());
                $tamanho = (mb_strlen($digitos, 'UTF-8'));
            if (15 !== $tamanho) {
                throw new Exception($this->rulesTranslate->translate('processo', '0012'));
            }
                // pega o digito verificador informado
                $dvInformado = substr($digitos, -2);
            for ($dv1 = 0, $i = ($tamanho - 3), $peso = 2; $i >= 0; $i--, $peso++) {
                $dv1 += $digitos[$i] * $peso;
            }
            if (($dv1 = 11 - (int) bcmod((string) $dv1, '11')) >= 10) {
                $dv1 -= 10;
            }
                // calculo de dv2 esperado
                $digitos .= $dv1;
            for ($dv2 = 0, $i = ($tamanho - 2), $peso = 2; $i >= 0; $i--, $peso++) {
                $dv2 += $digitos[$i] * $peso;
            }
            if (($dv2 = 11 - (int) bcmod((string) $dv2, '11')) >= 10) {
                $dv2 -= 10;
            }
                $dvEsperado = (string) $dv1.(string) $dv2;

            if ($dvInformado !== $dvEsperado) {
                throw new Exception($this->rulesTranslate->translate('processo', '0014', [$dvEsperado]));
            }

                return true;
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return false;
        }
    }

    /**
     * @param string $nup
     *
     * @return string
     */
    public function formatarNumeroUnicoProtocolo(string $nup): string
    {
        return substr($nup, 0, 5).'.'.
            substr($nup, 5, 6).'/'.
            substr($nup, 11, 2).'-'.
            substr($nup, 13, 2);
    }

    /**
     * @return string
     */
    public function getNome(): string
    {
        return 'NUP DO PODER EXECUTIVO FEDERAL DE 15 DÍGITOS';
    }

    /**
     * @return string
     */
    public function getSigla(): string
    {
        return 'NUPEXEC15';
    }

    /**
     * @return DateTime
     */
    public function getDataHoraInicioVigencia(): DateTime
    {
        return DateTime::createFromFormat('YmdHis', '19700101000000');
    }

    /**
     * @return DateTime|null
     */
    public function getDataHoraFimVigencia(): ?DateTime
    {
        return DateTime::createFromFormat('YmdHis', '20030305235959');
    }

    /**
     * @return string
     */
    public function getDescricao(): string
    {
        return 'NÚMERO ÚNICO DE PROTOCOLO DO PODER EXECUTIVO FEDERAL DE 15 DÍGITOS';
    }

    /**
     * @return int
     */
    public function getOrder(): int
    {
        return 20;
    }
}
