<?php

declare(strict_types=1);

namespace Dagweb\PhpPublicHoliday;

use Dagweb\PhpPublicHoliday\Exception\UnsupportedCountryCode;

/**
 * @psalm-api
 */
enum SupportedCountries: string
{
    case France = 'FR';
    case Monaco = 'MC';

    public static function isSupported(string $country): bool
    {
        return in_array($country, array_map(fn (self $case) => $case->value, self::cases()), true);
    }

    /**
     * @throws UnsupportedCountryCode
     *
     * @return class-string<PublicHolidayInterface>
     */
    public static function getPublicHolidaysEnum(string $countryCode): string
    {
        return match ($countryCode) {
            'FR' => France\PublicHoliday::class,
            'MC' => Monaco\PublicHoliday::class,
            default => throw new UnsupportedCountryCode($countryCode),
        };
    }
}
