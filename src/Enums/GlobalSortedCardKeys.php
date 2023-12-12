<?php

namespace App\Enums;

enum GlobalSortedCardKeys
{
    case colorSorted; // Tri par couleur
    case valueSorted; // Tri par valeur
    case colorAndValueSorted; // Tri par couleur puis par valeur

    case initial; // Tri par defaut (sans tri)

    public static function strings(): array
    {
        $strings = [];
        foreach(self::cases() as $case) {
            $strings[] = $case->name;
        }
        return $strings;
    }

}
