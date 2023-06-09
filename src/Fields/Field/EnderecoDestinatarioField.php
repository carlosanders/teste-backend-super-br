<?php

declare(strict_types=1);
/**
 * /src/Fields/Field/EnderecoDestinatarioField.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Fields\Field;

use SuppCore\AdministrativoBackend\Entity\Documento;
use SuppCore\AdministrativoBackend\Fields\FieldInterface;

/**
 * Class EnderecoDestinatarioField.
 *
 * Endereço do destinatário da comunicação
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class EnderecoDestinatarioField implements FieldInterface
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return 'endereco';
    }

    /**
     * @return array
     */
    public function getConfig(): array
    {
        return [
            'info' => [
                'id' => 'supp_core.administrativo_backend.fields_endereco_destinatario_field',
                'nome' => 'ENDEREÇO DO DESTINATÁRIO',
                'descricao' => 'ENDEREÇO DO DESTINATÁRIO DA COMUNICAÇÃO',
                'html' => '<span data-method="endereco" data-options="" data-service="SuppCore\AdministrativoBackend\Fields\Field\EnderecoDestinatarioField">*enderecoDestinatario*</span>',
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
        if ($documento->getDocumentoAvulsoRemessa()->getPessoaDestino() &&
            (count($documento->getDocumentoAvulsoRemessa()->getPessoaDestino()->getEnderecos()) > 0)) {
            return $documento->getDocumentoAvulsoRemessa()->getPessoaDestino()->getEnderecos(
            )[0]->getEnderecoFormatadoHTML();
        }
        if ($documento->getDocumentoAvulsoRemessa()->getSetorDestino() &&
            $documento->getDocumentoAvulsoRemessa()->getSetorDestino()->getEndereco()) {
            return $documento->getDocumentoAvulsoRemessa()->getSetorDestino()->getEndereco();
        }

        return '';
    }
}
