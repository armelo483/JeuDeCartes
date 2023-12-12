<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\Card;
use App\Enums\GlobalSortedCardKeys;
use App\Sorting\SortingStrategyInterface;
use App\Traits\CardGeneratorPropertiesTrait;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CardSorter
{
    /**
     * @var SortingStrategyInterface
     */
    private SortingStrategyInterface $sortingStrategy;

    /**
     * @param SortingStrategyInterface $sortingStrategy
     * @return void
     */
    public function setSortingStrategy(SortingStrategyInterface $sortingStrategy): void
    {
        $this->sortingStrategy = $sortingStrategy;
    }

    /**
     * @return Card[]
     */
    public function sortCards(): array {
        return $this->sortingStrategy->sortCards();
    }

}
