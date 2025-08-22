<?php

declare(strict_types=1);

namespace Dagweb\PhpPublicHoliday\Tests\Functional;

use Dagweb\PhpPublicHoliday\PublicHoliday;
use PHPUnit\Framework\Attributes\DataProvider;
use Dagweb\PhpPublicHoliday\SupportedCountries;
use Dagweb\PhpPublicHoliday\Tests\AbstractTestCase;
use Dagweb\PhpPublicHoliday\Exception\UnsupportedCountryCode;

class PublicHolidayTest extends AbstractTestCase
{
    #[DataProvider('getJsonDataProvider')]
    public function testGetAllPublicHolidays(?int $year, array $expected): void
    {
        $allPublicHolidays = PublicHoliday::getAllPublicHolidays($year);

        foreach ($allPublicHolidays as $countryCode => $publicHolidays) {
            static::assertTrue(SupportedCountries::isSupported($countryCode));

            foreach ($publicHolidays as $key => $publicHoliday) {
                static::assertInstanceOf(\DateTimeImmutable::class, $publicHoliday);
                $publicHolidays[$key] = $publicHoliday->format('Y-m-d');
            }

            $allPublicHolidays[$countryCode] = $publicHolidays;
        }

        static::assertSame($expected, $allPublicHolidays);
    }

    #[DataProvider('getJsonDataProvider')]
    public function testGetPublicHolidays(string $countryCode, ?int $year, array $expected): void
    {
        $publicHolidays = PublicHoliday::getPublicHolidays($countryCode, $year);

        static::assertTrue(PublicHoliday::isSupportedCountry($countryCode));

        foreach ($publicHolidays as $key => $publicHoliday) {
            static::assertInstanceOf(\DateTimeImmutable::class, $publicHoliday);
            $publicHolidays[$key] = $publicHoliday->format('Y-m-d');
        }

        static::assertSame($expected, $publicHolidays);
    }

    #[DataProvider('getJsonDataProvider')]
    public function testGetPublicHolidaysFail(string $countryCode, ?int $year, string $expected): void
    {
        static::expectException(UnsupportedCountryCode::class);
        static::expectExceptionMessage($expected);
        static::assertFalse(PublicHoliday::isSupportedCountry($countryCode));

        PublicHoliday::getPublicHolidays($countryCode, $year);
    }

    public function testSupportedCountries(): void
    {
        $supportedCountries = SupportedCountries::cases();

        static::assertCount(2, $supportedCountries);
        static::assertSame([
            SupportedCountries::France,
            SupportedCountries::Monaco,
        ], $supportedCountries);
    }
}
