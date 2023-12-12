<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\Card;
use App\Traits\CardGeneratorPropertiesTrait;
use Generator;

class CardGenerator implements \IteratorAggregate
{
    use CardGeneratorPropertiesTrait;

    /**
     * @return Generator
     */
    public function getIterator(): Generator
    {
        $values = array_merge($this->values, range(2, 10)); // On ajoute les 9 autres valeurs restantes
        shuffle($this->values);
        shuffle($this->colors);
        $colorArraySize = count($this->colors);
        $valueArraySize = count($values);

        for ($i = 0; $i < Card::NB_CARDS; $i++) {
            $colorIndex = $i % $colorArraySize;
            $valueIndex = $i % $valueArraySize;
            $color = $this->colors[$colorIndex];
            $value = $values[$valueIndex];
            yield new Card($color, $value);
        }
    }
}
