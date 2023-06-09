<?php

declare(strict_types=1);
/**
 * /src/Fields/Field/InteressadosField.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Fields\Field;

use SuppCore\AdministrativoBackend\Entity\Processo;
use SuppCore\AdministrativoBackend\Fields\FieldInterface;

/**
 * Class InteressadosField.
 *
 * Interessados do NUP
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class InteressadosField implements FieldInterface
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return 'interessados';
    }

    /**
     * @return array
     */
    public function getConfig(): array
    {
        return [
            'info' => [
                'id' => 'supp_core.administrativo_backend.fields_interessados_field',
                'nome' => 'INTERESSADOS',
                'descricao' => 'INTERESSADOS DO NUP',
                'html' => '<span data-method="interessados" data-options="" data-service="SuppCore\AdministrativoBackend\Fields\Field\InteressadosField">*interessados*</span>',
            ],
            'opcoes' => [],
            'dependencias' => [
                Processo::class,
            ],
        ];
    }

    /**
     * @param string $transactionId
     * @param array  $context
     * @param array  $options
     *
     * @return string|null
     */
    public function render(string $transactionId, $context = [], $options = []): ?string
    {
        /** @var Processo $processo */
        $processo = $context['processo'];

        if (!isset($processo) || !count($processo->getInteressados())) {
            return '';
        }

        $interessados = $processo->getInteressados();

        if (count($interessados) > 1) {
            return $interessados[0]->getPessoa()->getNome().' E OUTROS';
        } else {
            return $interessados[0]->getPessoa()->getNome();
        }
    }
}
