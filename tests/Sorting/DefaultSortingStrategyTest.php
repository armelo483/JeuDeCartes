<?php
declare(strict_types=1);
namespace App\Tests\Sorting;

use App\Entity\Card;
use App\Enums\Color;
use App\Enums\Value;
use App\Sorting\ColorSortingStrategy;
use Generator;
use Exception;
use App\Enums\GlobalSortedCardKeys;
use App\Service\CardGenerator;
use App\Sorting\DefaultSortingStrategy;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class DefaultSortingStrategyTest extends KernelTestCase
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

        $cardGenerator = new CardGenerator();
        $sortingStrategy = new DefaultSortingStrategy($cardGenerator);
        $sortingStrategy->setGlobalCardsArray([GlobalSortedCardKeys::initial->name => $initialCards]);

        $sortedCards = $sortingStrategy->sortCards();

        $this->assertArrayHasKey(GlobalSortedCardKeys::initial->name, $sortedCards);
        $this->assertEquals($expectedSortedCards, $sortedCards[GlobalSortedCardKeys::initial->name]);
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
                new Card(Color::Diamond->name, 1),
                new Card(Color::Club->name, 7)
            ],
            [
                new Card(Color::Heart->name, Value::Ace->name),
                new Card(Color::Heart->name, Value::Ace->name),
                new Card(Color::Spade->name, Value::Queen->name),
                new Card(Color::Diamond->name, 1),
                new Card(Color::Club->name, 7)
            ]
        ];

    }

}