<?php

namespace App\Sorting;

use App\Entity\Card;
use App\Service\CardGenerator;
use JetBrains\PhpStorm\NoReturn;

abstract class SortingStrategy
{

    /**
     * @param CardGenerator|null $cardGenerator
     */
    #[NoReturn]
    private function __construct(protected readonly ?CardGenerator $cardGenerator) {}

    /**
     * @var array
     */
    private static array $instances = [];

    /**
    * @var Card[]
    */
    protected array $globalCardsArray;

    #[NoReturn]
    public static function getInstance(?CardGenerator $cardGenerator = null): static
    {
        $cls = static::class;

        // Seul DefaultClass a le droit d avoir le cardGenerator
        $cardGenerator = match ($cls) {
            DefaultSortingStrategy::class => $cardGenerator,
            default => null,
        };

        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static($cardGenerator);
        }

        return self::$instances[$cls];
    }

    /**
     * @param Card[] $globalCardsArray
     * @return void
     */
    public function setGlobalCardsArray(array $globalCardsArray): void
    {
        $this->globalCardsArray = $globalCardsArray;
    }

}