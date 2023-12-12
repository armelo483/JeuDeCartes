<?php
declare(strict_types=1);
namespace App\Tests\Sorting;

use App\Entity\Card;
use App\Enums\Color;
use App\Enums\GlobalSortedCardKeys;
use App\Enums\Value;
use App\Service\CardGenerator;
use App\Sorting\ColorSortingStrategy;
use App\Sorting\DefaultSortingStrategy;
use Exception;
use Generator;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ColorSortingStrategyTest extends KernelTestCase
{
    /**
     * @dataProvider sortCardsDataProvider
     * @param Card[] $initialCards
     * @param Card[] $expectedSortedCards
     * @return void
     * @throws Exception
     */
    public function testSortCards(array $initialCards, array $expectedSortedCards): void
    {

        $sortingStrategy = new ColorSortingStrategy();
        $sortingStrategy->setGlobalCardsArray([GlobalSortedCardKeys::initial->name => $initialCards]);

        $sortedCards = $sortingStrategy->sortCards();


        $this->assertArrayHasKey(GlobalSortedCardKeys::colorSorted->name, $sortedCards);
        $this->assertArrayHasKey(GlobalSortedCardKeys::initial->name, $sortedCards);
        $this->assertEquals($expectedSortedCards, $sortedCards[GlobalSortedCardKeys::colorSorted->name]);
    }

    /**
     * @return Generator
     */
    public function sortCardsDataProvider(): Generator
    {
        yield 'Test case 1' => [
            [
                new Card(Color::Heart->name, Value::Ace->name),
                new Card(Color::Heart->name, Value::Ace->name),
                new Card(Color::Spade->name, Value::Queen->name),
                new Card(Color::Diamond->name, "1"),
                new Card(Color::Club->name, "7")
            ],
            [
                new Card(Color::Club->name, "7"),
                new Card(Color::Diamond->name, "1"),
                new Card(Color::Heart->name, Value::Ace->name),
                new Card(Color::Heart->name, Value::Ace->name),
                new Card(Color::Spade->name, Value::Queen->name),
            ],
        ];

    }
}