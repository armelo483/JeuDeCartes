<?php

namespace App\Entity;

class Card
{
    /**
     * @var string
     */
    private string $color; // Couleur
    private string $value; // Valeur

    public const NB_CARDS = 10;

    public function __construct($color, $value) {
        $this->color = $color;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }



}