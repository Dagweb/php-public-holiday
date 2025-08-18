<?php

declare(strict_types=1);

namespace Dagweb\PhpPublicHoliday\France;

use Dagweb\PhpPublicHoliday\PublicHolidayInterface;
use Dagweb\PhpPublicHoliday\Service\PublicHolidayDateService;

enum PublicHoliday: string implements PublicHolidayInterface
{
    private const string DATE_JOUR_DE_L_AN = '01-01';
    private const string DATE_FETE_DU_TRAVAIL = '05-01';
    private const string DATE_VICTOIRE_1945 = '05-08';
    private const string DATE_FETE_NATIONALE = '07-14';
    private const string DATE_ASCENSION = '08-15';
    private const string DATE_TOUSSAINT = '11-01';
    private const string DATE_ARMISTICE_1918 = '11-11';
    private const string DATE_JOUR_DE_NOEL = '12-25';

    case JourDeLAn = 'JourDeLAn';
    case LundiDePaques = 'LundiDePaques';
    case FeteDuTravail = 'FeteDuTravail';
    case Victoire1945 = 'Victoire1945';
    case Ascension = 'Ascension';
    case LundiDePentecote = 'LundiDePentecote';
    case FeteNationale = 'FeteNationale';
    case Assomption = 'Assomption';
    case Toussaint = 'Toussaint';
    case Armistice1918 = 'Armistice1918';
    case JourDeNoel = 'JourDeNoel';

    #[\Override]
    public static function getDate(PublicHolidayInterface $case, ?int $year = null): \DateTimeInterface
    {
        $year ??= (int) (new \DateTimeImmutable('now'))->format('Y');
        $easter = PublicHolidayDateService::calculateEaster($year);

        $calculatedDate = match ($case) {
            self::JourDeLAn => \DateTimeImmutable::createFromFormat('Y-m-d', "$year-" . self::DATE_JOUR_DE_L_AN),
            self::LundiDePaques => (clone $easter)->add(new \DateInterval('P1D')),
            self::FeteDuTravail => \DateTimeImmutable::createFromFormat('Y-m-d', "$year-" . self::DATE_FETE_DU_TRAVAIL),
            self::Victoire1945 => \DateTimeImmutable::createFromFormat('Y-m-d', "$year-" . self::DATE_VICTOIRE_1945),
            self::Ascension => (clone $easter)->add(new \DateInterval('P39D')),
            self::LundiDePentecote => (clone $easter)->add(new \DateInterval('P50D')),
            self::FeteNationale => \DateTimeImmutable::createFromFormat('Y-m-d', "$year-" . self::DATE_FETE_NATIONALE),
            self::Assomption => \DateTimeImmutable::createFromFormat('Y-m-d', "$year-" . self::DATE_ASCENSION),
            self::Toussaint => \DateTimeImmutable::createFromFormat('Y-m-d', "$year-" . self::DATE_TOUSSAINT),
            self::Armistice1918 => \DateTimeImmutable::createFromFormat('Y-m-d', "$year-" . self::DATE_ARMISTICE_1918),
            self::JourDeNoel => \DateTimeImmutable::createFromFormat('Y-m-d', "$year-" . self::DATE_JOUR_DE_NOEL),
        };

        assert($calculatedDate instanceof \DateTimeInterface);

        return $calculatedDate;
    }

    /**
     * @return array<string, \DateTimeInterface>
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
}
