<?php

declare(strict_types=1);

namespace Dagweb\PhpPublicHoliday;

interface PublicHolidayInterface
{
    public static function getDate(self $case, ?int $year = null): \DateTimeInterface;

    /**
     * @return \DateTimeInterface[]
     */
    public static function getPublicHolidays(): array;
}
