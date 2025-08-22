<?php

declare(strict_types=1);

namespace Dagweb\PhpPublicHoliday;

use Dagweb\PhpPublicHoliday\Exception\UnsupportedCountryCode;

/**
 * @psalm-api
 */
final class PublicHoliday
{
    /**
     * @return array<string, array<string, \DateTimeImmutable>>
     */
    public static function getAllPublicHolidays(?int $year = null): array
    {
        $year ??= (int) (new \DateTimeImmutable())->format('Y');
        $publicHolidaysArray = [];

        foreach (SupportedCountries::cases() as $countryCase) {
            $publicHolidaysArray[$countryCase->value] = self::getPublicHolidaysForCountry($countryCase->value, $year);
        }

        return $publicHolidaysArray;
    }

    /**
     * @throws UnsupportedCountryCode
     *
     * @return array<string, \DateTimeImmutable>
     */
    public static function getPublicHolidays(string $countryCode, ?int $year = null): array
    {
        $year ??= (int) (new \DateTimeImmutable())->format('Y');

        return self::getPublicHolidaysForCountry($countryCode, $year);
    }

    /**
     * @throws UnsupportedCountryCode
     *
     * @return array<string, \DateTimeImmutable>
     */
    private static function getPublicHolidaysForCountry(string $countryCode, ?int $year = null): array
    {
        $publicHolidayEnum = SupportedCountries::getPublicHolidaysEnum($countryCode);

        return $publicHolidayEnum::getPublicHolidays($year);
    }

    public static function isSupportedCountry(string $countryCode): bool
    {
        return SupportedCountries::isSupported($countryCode);
    }
}
