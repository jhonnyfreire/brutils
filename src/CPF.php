<?php
declare (strict_types = 1);

namespace BrUtils;

class CPF extends  \BrUtils\Base
{

    public static function validate(string $cpf): bool
    {
        $cpf = trim($cpf);

        if (empty($cpf)) {

            return false;
        }

        $cpf = self::clear($cpf);

        if (strlen($cpf) != 11) {

            return false;
        }

        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        for ($t = 9; $t < 11; $t++) {

            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf{$c} * (($t + 1) - $c);
            }

            $d = ((10 * $d) % 11) % 10;

            if ($cpf{$c} != $d) {

                return false;
            }
        }

        return true;
    }

    public static function format(string $cpf): string
    {
        if (!self::validate($cpf)) {

            return '';
        }

        return \preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '\1.\2.\3-\4', $cpf);
    }

}
