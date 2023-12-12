<?php
declare(strict_types=1);

namespace App\Sorting;

use App\Entity\Card;
use App\Enums\GlobalSortedCardKeys;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ColorSortingStrategy extends SortingStrategy implements SortingStrategyInterface
{
    /**
     * @return Card[]
     */
    public function sortCards(): array {

        if (!empty($this->globalCardsArray[GlobalSortedCardKeys::colorSorted->name])) {
            return $this->globalCardsArray;
        }

        $cards = array_merge([], $this->globalCardsArray[GlobalSortedCardKeys::initial->name]);

        usort($cards, function ($a, $b) {
            return strcmp($a->getColor(), $b->getColor());
        });

        $this->globalCardsArray[GlobalSortedCardKeys::colorSorted->name] = array_merge([], $cards);
        unset($cards);

        return $this->globalCardsArray;
    }

}