<?php

declare(strict_types=1);

namespace Dagweb\PhpPublicHoliday\Tests\Unit\France;

use PHPUnit\Framework\Attributes\DataProvider;
use Dagweb\PhpPublicHoliday\France\PublicHoliday;
use Dagweb\PhpPublicHoliday\Tests\AbstractTestCase;

class PublicHolidayTest extends AbstractTestCase
{
    #[DataProvider('getJsonDataProvider')]
    public function testGetDate(string $publicHolidayName, ?int $year, string $expected): void
    {
        static::assertSame($expected, PublicHoliday::getDate(PublicHoliday::from($publicHolidayName), $year)->format('Y-m-d'));
    }

    #[DataProvider('getJsonDataProvider')]
    public function testGetPublicHolidays(?int $year, array $expected): void
    {
        static::assertSame($expected, array_map(fn (\DateTimeInterface $dateTime) => $dateTime->format('Y-m-d'), PublicHoliday::getPublicHolidays($year)));
    }
}
