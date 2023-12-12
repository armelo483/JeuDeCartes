<?php

declare(strict_types=1);

namespace App\Sorting;

use App\Entity\Card;
use App\Enums\GlobalSortedCardKeys;
use Exception;

class ColorAndValueSortingStrategy extends SortingStrategy  implements SortingStrategyInterface
{
    /**
     * @throws Exception
     * @return Card[]
     */
    public function sortCards(): array {

        if (!empty($this->globalCardsArray[GlobalSortedCardKeys::colorAndValueSorted->name])) {
            return $this->globalCardsArray;
        }

        $cards = array_merge([], $this->globalCardsArray[GlobalSortedCardKeys::initial->name]);

        usort($cards, function ($a, $b) {
            $cmp = strnatcmp($a->getColor(), $b->getColor());
            if ($cmp == 0) {
                return strnatcmp($a->getValue(), $b->getValue());
            }

            return $cmp;
        });

        $this->globalCardsArray[GlobalSortedCardKeys::colorAndValueSorted->name] = array_merge([], $cards);
        unset($cards);

        return $this->globalCardsArray;
    }

}