<?php

namespace App\Enums;

enum Color
{
    case Diamond; //Le carreau
    case Heart; // Le coeur
    case Spade; // Le pique
    case Club; // Le trefle

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