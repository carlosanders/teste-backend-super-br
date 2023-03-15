<?php

declare(strict_types=1);
/**
 * /src/Validator/Constraints/CpfCnpjValidador.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Validator\Constraints;

use function preg_match;
use function strlen;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class CpfCnpjValidator.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class CpfCnpjValidator extends ConstraintValidator
{
    private ParameterBagInterface $parameterBag;

    public function __construct(
        ParameterBagInterface $parameterBag
    ) {
        $this->parameterBag = $parameterBag;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($value, Constraint $constraint): void
    {
        if ('dev' === $this->parameterBag->get('kernel.environment')) {
            return;
        }

        if (!$value) {
            return;
        }

        $valueLen = strlen($value);

        if (11 !== $valueLen && 14 !== $valueLen) {
            /* @noinspection PhpUndefinedFieldInspection */
            $this->context->addViolation(
                $constraint->message,
                [
                    '{{ value }}' => $value,
                ]
            );

            return;
        }

        if (14 === $valueLen && !$this->isCnpjValid($value)) {
            /* @noinspection PhpUndefinedFieldInspection */
            $this->context->addViolation(
                $constraint->message,
                [
                    '{{ value }}' => $value,
                ]
            );

            return;
        }

        if (11 === $valueLen && !$this->isCpfValid($value)) {
            /* @noinspection PhpUndefinedFieldInspection */
            $this->context->addViolation(
                $constraint->message,
                [
                    '{{ value }}' => $value,
                ]
            );
        }
    }

    /**
     * @param string $cnpj
     *
     * @return bool
     */
    private function isCnpjValid(string $cnpj): bool
    {
        if (0 === preg_match('/(\d)\1{14}/', $cnpj)) {
            for ($i = 0, $j = 5, $soma = 0; $i < 12; ++$i) {
                $soma += (int) $cnpj[$i] * $j;
                $j = (2 === $j) ? 9 : $j - 1;
            }
            $resto = $soma % 11;
            if ((int) $cnpj[12] === ($resto < 2 ? 0 : 11 - $resto)) {
                for ($i = 0, $j = 6, $soma = 0; $i < 13; ++$i) {
                    $soma += (int) $cnpj[$i] * $j;
                    $j = (2 === $j) ? 9 : $j - 1;
                }
                $resto = $soma % 11;

                return (int) $cnpj[13] === ($resto < 2 ? 0 : 11 - $resto);
            }
        }

        return false;
    }

    /**
     * @param string $cpf
     *
     * @return bool
     */
    private function isCpfValid(string $cpf): bool
    {
        if (0 === preg_match('/(\d)\1{10}/', $cpf)) {
            for ($t = 9; $t < 11; ++$t) {
                for ($d = 0, $c = 0; $c < $t; ++$c) {
                    $d += (int) $cpf[$c] * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;

                return (int) $cpf[$c] === $d;
            }
        }

        return false;
    }
}
