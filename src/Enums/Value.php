<?php

namespace App\Enums;

enum Value
{
    case Queen; // La dame
    case King; // Le roi
    case Jack; // Le valet
    case Ace; // L'as

    /**
     * @return array
     */
    public static function strings(): array
    {
        $strings = [];
        foreach(self::cases() as $case) {
            $strings[] = $case->name;
        }
        return $strings;
    }
}
