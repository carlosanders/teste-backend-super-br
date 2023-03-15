<?php

declare(strict_types=1);
/**
 * /src/Fields/Field/FinalPrazoComunicacaoField.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Fields\Field;

use SuppCore\AdministrativoBackend\Entity\Documento;
use SuppCore\AdministrativoBackend\Fields\FieldInterface;

/**
 * Class FinalPrazoComunicacaoField.
 *
 * Data do final do prazo da comunicação.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class FinalPrazoComunicacaoField implements FieldInterface
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return 'finalPrazoComunicacao';
    }

    /**
     * @return array
     */
    public function getConfig(): array
    {
        return [
            'info' => [
                'id' => 'supp_core.administrativo_backend.fields_final_prazo_comunicacao_field',
                'nome' => 'DATA DO FINAL DO PRAZO DA COMUNICAÇÃO',
                'descricao' => 'DATA DO FINAL DO PRAZO DA COMUNICAÇÃO',
                'html' => '<span data-method="finalPrazoComunicacao" data-options="" data-service="SuppCore\AdministrativoBackend\Fields\Field\FinalPrazoComunicacaoField">*finalPrazoComunicacao*</span>',
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
            !$documento->getDocumentoAvulsoRemessa()) {
            return '';
        }

        return $documento->getDocumentoAvulsoRemessa()->getDataHoraFinalPrazo()->format('d-m-Y');
    }
}
