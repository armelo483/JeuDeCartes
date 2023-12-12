<?php

namespace App\Tests\Service;
use App\Entity\Card;
use App\Service\CardGenerator;
use PHPUnit\Framework\TestCase;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CardGeneratorTest extends KernelTestCase
{
    public function testGenerator(): void
    {
        $cardGenerator = new CardGenerator();
        $iterator = $cardGenerator->getIterator();
        $this->assertInstanceOf(\Generator::class, $iterator);

        $generatedCards = [];

        foreach ($iterator as $card) {
            $this->assertInstanceOf(Card::class, $card);
            $generatedCards[] = $card;
        }

        $this->assertCount(Card::NB_CARDS, $generatedCards);
        $uniqueCards = array_unique($generatedCards, SORT_REGULAR);
        $this->assertCount(Card::NB_CARDS, $uniqueCards);
    }



}