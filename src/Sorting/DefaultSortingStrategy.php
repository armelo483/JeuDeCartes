<?php
declare(strict_types=1);

namespace App\Sorting;

use App\Entity\Card;
use App\Enums\GlobalSortedCardKeys;
use App\Exception\NoCardGeneratorException;
use App\Service\CardGenerator;
use Exception;

class DefaultSortingStrategy extends SortingStrategy implements SortingStrategyInterface
{

    /**
     * @throws Exception
     * @return Card[]
     */
    public function sortCards(): array {

        // Vérifie si le cardGenerator est défini
        if ($this->cardGenerator === null) {
            throw new NoCardGeneratorException("Le cardGenerator n'est pas défini pour cette instance de DefaultSortingStrategy.");
        }

        $cards = iterator_to_array($this->cardGenerator);
        
        if (!empty($this->globalCardsArray[GlobalSortedCardKeys::initial->name])) {
            return $this->globalCardsArray;
        }

        $this->globalCardsArray[GlobalSortedCardKeys::initial->name] = array_merge([], $cards);

        unset($cards);

        return $this->globalCardsArray;

    }

}