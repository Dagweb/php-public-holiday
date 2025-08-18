<?php

declare(strict_types=1);

namespace Dagweb\PhpPublicHoliday\Service;

final class PublicHolidayDateService
{
    public static function calculateEaster(int $year): \DateTimeImmutable
    {
        $n = ($year % 19);
        $c = (int) ($year / 100);
        $u = ($year % 100);

        $s = (int) ($c / 4);
        $t = ($c % 4);
        $p = (int) (($c + 8) / 25);
        $q = (int) (($c - $p + 1) / 3);
        $e = (((19 * $n) + $c - $s - $q + 15) % 30);
        $d = ($u % 4);
        $b = (int) ($u / 4);
        $l = (((2 * $t) + (2 * $b) - $e - $d + 32) % 7);
        $h = (int) (($n + (11 * $e) + (22 * $l)) / 451);

        $month = (int) (($e + $l - (7 * $h) + 114) / 31);
        $day = (($e + $l - (7 * $h) + 114) % 31) + 1;

        return new \DateTimeImmutable(sprintf(
            '%d-%s-%s',
            $year,
            str_pad((string) $month, 2, '0', STR_PAD_LEFT),
            str_pad((string) $day, 2, '0', STR_PAD_LEFT)
        ));
    }
}
