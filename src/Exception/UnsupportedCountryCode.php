<?php

declare(strict_types=1);

namespace Dagweb\PhpPublicHoliday\Exception;

final class UnsupportedCountryCode extends \RuntimeException
{
    public function __construct(string $countryCode)
    {
        $countryCode = strlen($countryCode) > 2 ? substr($countryCode, 0, 2) . '...' : $countryCode;

        parent::__construct("Country code '$countryCode' is not supported.", 1);
    }
}
