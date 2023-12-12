<?php
declare(strict_types=1);

namespace App\Sorting;

use App\Entity\Card;
use App\Enums\GlobalSortedCardKeys;
use App\Enums\Value;
use App\Traits\CardGeneratorPropertiesTrait;

class ValueSortingStrategy extends SortingStrategy implements SortingStrategyInterface {

    /**
     * @return Card[]
     */
    public function sortCards(): array {

        $valueSorted = GlobalSortedCardKeys::valueSorted->name;
        if (!empty($this->globalCardsArray[$valueSorted])) {
            return $this->globalCardsArray;
        }

        $cards = array_merge([], $this->globalCardsArray[GlobalSortedCardKeys::initial->name]);
        usort($cards, function ($a, $b) {
            return strnatcmp($a->getValue(), $b->getValue());
        });

        $this->globalCardsArray[$valueSorted] = array_merge([], $cards);
        unset($cards);
        return $this->globalCardsArray;

    }
}