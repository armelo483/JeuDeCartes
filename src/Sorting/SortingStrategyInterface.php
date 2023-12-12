<?php
declare(strict_types=1);

namespace App\Sorting;

use App\Entity\Card;

interface SortingStrategyInterface
{
    /**
     * @return Card[]
     */
    public function sortCards(): array;

}