<?php

declare(strict_types=1);

namespace Dagweb\PhpPublicHoliday;

interface PublicHolidayInterface
{
    public static function getDate(self $case, ?int $year = null): \DateTimeImmutable;

    /**
     * @return array<string, \DateTimeImmutable>
     *
     * @psalm-api
     */
    public static function getPublicHolidays(?int $year = null): array;
}
