<?php

declare(strict_types=1);
/**
 * /src/Fields/Field/ObservacaoComunicacaoField.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Fields\Field;

use SuppCore\AdministrativoBackend\Entity\Documento;
use SuppCore\AdministrativoBackend\Fields\FieldInterface;

/**
 * Class ObservacaoComunicacaoField.
 *
 * Observação da comunicação
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class ObservacaoComunicacaoField implements FieldInterface
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return 'observacaoComunicacao';
    }

    /**
     * @return array
     */
    public function getConfig(): array
    {
        return [
            'info' => [
                'id' => 'supp_core.administrativo_backend.fields_final_prazo_comunicacao_field',
                'nome' => 'OBSERVAÇÃO DA COMUNICAÇÃO',
                'descricao' => 'OBSERVAÇÃO DA COMUNICAÇÃO',
                'html' => '<span data-method="observacaoComunicacao" data-options="" data-service="SuppCore\AdministrativoBackend\Fields\Field\ObservacaoComunicacaoField">*observacaoComunicacao*</span>',
            ],
            'opcoes' => [],
            'dependencias' => [
                Documento::class,
            ],
        ];
    }

    /**
     * @param string $transactionId
     * @param array  $context
     * @param array  $options
     *
     * @return string
     */
    public function render(string $transactionId, $context = [], $options = []): ?string
    {
        /** @var Documento $documento */
        $documento = $context['documento'];
        if (!isset($documento) ||
            !$documento->getDocumentoAvulsoRemessa() ||
            !$documento->getDocumentoAvulsoRemessa()->getObservacao()) {
            return '';
        }

        return $documento->getDocumentoAvulsoRemessa()->getObservacao();
    }
}
