<?php

declare(strict_types=1);

namespace Dagweb\PhpPublicHoliday\Monaco;

use Dagweb\PhpPublicHoliday\PublicHolidayInterface;
use Dagweb\PhpPublicHoliday\Service\PublicHolidayDateService;

/**
 * @psalm-api
 */
enum PublicHoliday: string implements PublicHolidayInterface
{
    private const string DATE_JOUR_DE_L_AN = '01-01';
    private const string DATE_SAINTE_DEVOTE = '01-27';
    private const string DATE_PREMIER_MAI = '05-01';
    private const string DATE_ASCENSION = '08-15';
    private const string DATE_TOUSSAINT = '11-01';
    private const string DATE_FETE_DU_PRINCE = '11-19';
    private const string DATE_IMMACULE_CONCEPTION = '12-08';
    private const string DATE_NOEL = '12-25';

    case JourDeLAn = 'JourDeLAn';
    case SainteDevote = 'SainteDevote';
    case LundiDePaques = 'LundiDePaques';
    case PremierMai = 'PremierMai';
    case Ascension = 'Ascension';
    case LundiDePentecote = 'LundiDePentecote';
    case FeteDieu = 'FeteDieu';
    case Assomption = 'Assomption';
    case Toussaint = 'Toussaint';
    case FeteDuPrince = 'FeteDuPrince';
    case ImmaculeeConception = 'ImmaculeeConception';
    case Noel = 'Noel';

    #[\Override]
    public static function getDate(PublicHolidayInterface $case, ?int $year = null): \DateTimeImmutable
    {
        $year ??= (int) (new \DateTimeImmutable('now'))->format('Y');
        $easter = PublicHolidayDateService::calculateEaster($year);

        $calculatedDate = match ($case) {
            self::JourDeLAn => \DateTimeImmutable::createFromFormat('Y-m-d', "$year-" . self::DATE_JOUR_DE_L_AN),
            self::SainteDevote => \DateTimeImmutable::createFromFormat('Y-m-d', "$year-" . self::DATE_SAINTE_DEVOTE),
            self::LundiDePaques => (clone $easter)->add(new \DateInterval('P1D')),
            self::PremierMai => \DateTimeImmutable::createFromFormat('Y-m-d', "$year-" . self::DATE_PREMIER_MAI),
            self::Ascension => (clone $easter)->add(new \DateInterval('P39D')),
            self::LundiDePentecote => (clone $easter)->add(new \DateInterval('P50D')),
            self::FeteDieu => (clone $easter)->add(new \DateInterval('P60D')),
            self::Assomption => \DateTimeImmutable::createFromFormat('Y-m-d', "$year-" . self::DATE_ASCENSION),
            self::Toussaint => \DateTimeImmutable::createFromFormat('Y-m-d', "$year-" . self::DATE_TOUSSAINT),
            self::FeteDuPrince => \DateTimeImmutable::createFromFormat('Y-m-d', "$year-" . self::DATE_FETE_DU_PRINCE),
            self::ImmaculeeConception => self::calculateImmaculeeConception($year),
            self::Noel => \DateTimeImmutable::createFromFormat('Y-m-d', "$year-" . self::DATE_NOEL),
        };

        assert($calculatedDate instanceof \DateTimeImmutable);

        /*
         * @see: https://legimonaco.mc/tnc/loi/1966/02-18-798/
         */
        return match($case) {
            self::JourDeLAn,
            self::PremierMai,
            self::Assomption,
            self::FeteDuPrince,
            self::Toussaint,
            self::Noel => 7 === (int) $calculatedDate->format('N') ? $calculatedDate->add(new \DateInterval('P1D')) : $calculatedDate,
            default => $calculatedDate,
        };
    }

    /**
     * @return array<string, \DateTimeImmutable>
     */
    #[\Override]
    public static function getPublicHolidays(?int $year = null): array
    {
        $year ??= (int) (new \DateTimeImmutable('now'))->format('Y');
        $publicHoliday = [];

        foreach (self::cases() as $case) {
            $publicHoliday[$case->name] = self::getDate($case, $year);
        }

        return $publicHoliday;
    }

    private static function calculateImmaculeeConception(int $year): \DateTimeImmutable
    {
        $immaculeeConception = \DateTimeImmutable::createFromFormat('Y-m-d', "$year-" . self::DATE_IMMACULE_CONCEPTION);

        assert($immaculeeConception instanceof \DateTimeImmutable);

        return 7 === (int)$immaculeeConception->format('N') ? $immaculeeConception->add(new \DateInterval('P1D')) : $immaculeeConception;
    }
}
