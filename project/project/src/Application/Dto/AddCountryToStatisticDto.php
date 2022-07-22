<?php

declare(strict_types=1);

namespace App\Application\Dto;

final class AddCountryToStatisticDto
{
    // Нужны бы это вынести в админку и управлять справочником при необходимости. Соответственно неполный
    private static array $dictionaryCodesA2 = ['ru', 'it', 'us', 'cy', 'au', 'gb', 'ge', 'de'];

    private string $countryCode;

    public function __construct(string $countryCode)
    {
        $this->countryCode = $countryCode;
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    public static function isValidCode(string $countryCode): bool
    {
        if (in_array($countryCode, self::$dictionaryCodesA2)) {
            return true;
        }

        return false;
    }
}
