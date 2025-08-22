# php-public-holiday

PHP-public-holiday is a PHP package that give you enums to retrieve public holidays dates.

Supported countries:

| Country |                         Enum                         | Listed public holidays (Official Name used By Country)                                                                                                                                                                                      |
|:--------|:----------------------------------------------------:|:--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| France  | ```\Dagweb\PhpPublicHoliday\France\PublicHolidays``` | - Jour de l'an<br/>- Lundi de Pâques<br/>- Fête du travail<br/>- Victoire 1945<br/>- Ascension<br/>- Lundi de Pentecôte<br/>- Fête Nationale<br/>- Assomption<br/>- Toussaint<br/>- Armistice 1918<br/>- Jour de Noël                       |
| Monaco  | ```\Dagweb\PhpPublicHoliday\Monaco\PublicHolidays``` | - Jour de l'an<br/>- Sainte Dévote<br/>- Lundi de Pâques<br/>- 1er Mai<br/>- Ascension<br/>- Lundi de Pentecôte<br/>- La Fête Dieu<br/>- Assomption<br/>- Toussaint<br/>- La Fête du Prince<br/>- L'immaculée Conception<br/>- Jour de Noël |

### Usage
Import Enum class and use it.

To get the spécific date, use the ```getDate(self $case, ?int $year = null): \DateTimeImmutable``` method of the Enum.

To get the list of all dates, use the ```getPublicHolidays(?int $year = null): array<string, \DateTimeImmutable>``` method of the Enum.

