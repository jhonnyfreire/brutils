<?php
declare (strict_types = 1);

namespace BrUtils;

class CNPJ extends \BrUtils\Base
{

    public static function validate(string $cnpj): bool
    {

        $cnpj = trim($cnpj);

        if (empty($cnpj)) {

            return false;
        }

        $cnpj = self::clear($cnpj);

        if (strlen($cnpj) != 14) {

            return false;
        }

        for ($i = 0, $j = 5, $s = 0; $i < 12; $i++) {
            $s += $cnpj{$i} * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $r = $s % 11;

        if ($cnpj{12} != ($r < 2 ? 0 : 11 - $r)) {
            return false;
        }

        for ($i = 0, $j = 6, $s = 0; $i < 13; $i++) {
            $s += $cnpj{$i} * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $r = $s % 11;

        return $cnpj{13} == ($r < 2 ? 0 : 11 - $r);

    }

    public static function format(string $cnpj): string
    {
        if (!self::validate($cnpj)) {

            return '';
        }

        return \preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '\1.\2.\3/\4-\5', $cnpj);
    }
}
