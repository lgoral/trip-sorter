<?php

use TripSorter\Model\BoardingCardsCollection;
use TripSorter\Model\BusBoardingCard;
use TripSorter\Model\FlightBoardingCard;
use TripSorter\Model\TrainBoardingCard;
use TripSorter\TripSorter;

class TripSorterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var TripSorter
     */
    private $tripSorter;

    public function setUp()
    {
        $this->tripSorter = new TripSorter();
    }

    public function testShouldDoNothingWhenThereIsNotCards()
    {
        // given
        $collection = new BoardingCardsCollection([]);

        // when
        $sortedCollection = $this->tripSorter->sort($collection);

        // then
        $this->assertCount(0, $sortedCollection);
    }

    public function testShouldThrowExceptionWhenWrongBoardingCardPasses()
    {
        $this->expectException(\Exception::class);
        new BoardingCardsCollection([new \stdClass(),]);
    }

    /**
     * @dataProvider getRandomizedBoardingCards
     *
     * @param BoardingCardsCollection $collection
     */
    public function testShouldReturnAlwaysTheSameTripWhenBoardingCardsAreRandom(BoardingCardsCollection $collection)
    {
        // when
        $sorted = $this->tripSorter->sort($collection);

        // then
        $this->assertCount(4, $sorted);

        $this->assertEquals('Madrid', $sorted->offsetGet(0)->getSource());
        $this->assertEquals('Barcelona', $sorted->offsetGet(1)->getSource());
        $this->assertEquals('Gerona', $sorted->offsetGet(2)->getSource());
        $this->assertEquals('Stockholm', $sorted->offsetGet(3)->getSource());

        $this->assertEquals($sorted->offsetGet(1)->getSource(), $sorted->offsetGet(0)->getDestination());
        $this->assertEquals($sorted->offsetGet(2)->getSource(), $sorted->offsetGet(1)->getDestination());
        $this->assertEquals($sorted->offsetGet(3)->getSource(), $sorted->offsetGet(2)->getDestination());
    }

    public function testShouldReturnTripWithOneBoardingCardWhenNoPathsBetweenCities()
    {
        // given
        $collection = new BoardingCardsCollection([
            (new BusBoardingCard())->setSource('Madrid')->setDestination('Paris'),
            (new BusBoardingCard())->setSource('Barcelona')->setDestination('Gerona'),
        ]);

        // when
        $sorted = $this->tripSorter->sort($collection);

        // then
        $this->assertCount(1, $sorted);
    }

    /**
     * @return array
     */
    public function getRandomizedBoardingCards(): array
    {
        $fromStockholm = (new FlightBoardingCard())
            ->setSource('Stockholm')
            ->setDestination('New York')
            ->setNumber('SK22')
            ->setGate('22')
            ->setSeat('7B');
        $fromMadrid = (new TrainBoardingCard())
            ->setSource('Madrid')
            ->setDestination('Barcelona')
            ->setNumber('78A')
            ->setSeat('45B');
        $fromBarcelona = (new BusBoardingCard())
            ->setSource('Barcelona')
            ->setDestination('Gerona');
        $fromGerona = (new FlightBoardingCard())
            ->setSource('Gerona')
            ->setDestination('Stockholm')
            ->setNumber('SK455')
            ->setGate('45B')
            ->setSeat('3A');

        return [
            [
                new BoardingCardsCollection([
                    $fromStockholm,
                    $fromMadrid,
                    $fromBarcelona,
                    $fromGerona,
                ]),
            ],
            [
                new BoardingCardsCollection([
                    $fromMadrid,
                    $fromStockholm,
                    $fromGerona,
                    $fromBarcelona,
                ]),
            ],
            [
                new BoardingCardsCollection([
                    $fromGerona,
                    $fromStockholm,
                    $fromMadrid,
                    $fromBarcelona,
                ]),
            ],
        ];
    }
}
