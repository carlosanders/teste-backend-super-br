<?php

declare(strict_types=1);
/**
 * /src/Fields/Field/NomeDestinatarioField.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Fields\Field;

use SuppCore\AdministrativoBackend\Entity\Documento;
use SuppCore\AdministrativoBackend\Fields\FieldInterface;

/**
 * Class NomeDestinatarioField.
 *
 * Nome do destinatário da comunicação
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class NomeDestinatarioField implements FieldInterface
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return 'destinatario';
    }

    /**
     * @return array
     */
    public function getConfig(): array
    {
        return [
            'info' => [
                'id' => 'supp_core.administrativo_backend.fields_nome_destinatario_field',
                'nome' => 'NOME DO DESTINATÁRIO',
                'descricao' => 'NOME DO DESTINATÁRIO DA COMUNICAÇÃO',
                'html' => '<span data-method="destinatario" data-options="" data-service="SuppCore\AdministrativoBackend\Fields\Field\NomeDestinatarioField">*nomeDestinatario*</span>',
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

        if ($documento->getDocumentoAvulsoRemessa()->getPessoaDestino()) {
            return $documento->getDocumentoAvulsoRemessa()->getPessoaDestino()->getNome();
        }

        // regra de excepcional inserida em razão de parecer da CGU
        if ($documento->getDocumentoAvulsoRemessa()->getSetorDestino() &&
            ('CONSULTORIA JURÍDICA JUNTO AO MINISTÉRIO DA SAÚDE' == $documento->getDocumentoAvulsoRemessa()->getSetorDestino()->getNome()) &&
            (
                ('CUMPRIMENTO DE DECISÃO JUDICIAL' == $documento->getDocumentoAvulsoRemessa()->getEspecieDocumentoAvulso()->getNome()) ||
                ('REITERAÇÃO DE CUMPRIMENTO DE DECISÃO JUDICIAL' == $documento->getDocumentoAvulsoRemessa()->getEspecieDocumentoAvulso()->getNome()) ||
                ('REVOGAÇÃO OU SUSPENSÃO DE CUMPRIMENTO DE DECISÃO JUDICIAL' == $documento->getDocumentoAvulsoRemessa()->getEspecieDocumentoAvulso()->getNome()) ||
                ('COMPLEMENTAÇÃO DE CUMPRIMENTO DE DECISÃO JUDICIAL' == $documento->getDocumentoAvulsoRemessa()->getEspecieDocumentoAvulso()->getNome()))
        ) {
            return 'Responsável pelo NÚCLEO DE JUDICIALIZAÇÃO DA SECRETARIA EXECUTIVA DO MINISTÉRIO DA SAÚDE';
        }

        if ($documento->getDocumentoAvulsoRemessa()->getSetorDestino()) {
            return 'Responsável pela '.$documento->getDocumentoAvulsoRemessa()->getSetorDestino(
                )->getNome();
        }

        return '';
    }
}
