<?php

use TripSorter\Model\BoardingCardsCollection;
use TripSorter\Model\BusBoardingCard;
use TripSorter\Model\FlightBoardingCard;
use TripSorter\Model\TrainBoardingCard;
use TripSorter\TripPrinter;

class TripPrinterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var TripPrinter
     */
    private $tripPrinter;

    public function setUp()
    {
        $this->tripPrinter = new TripPrinter();
    }

    public function testShouldPrintInformationWhenThereIsNotCards()
    {
        // given
        $collection = new BoardingCardsCollection([]);
        $this->expectOutputString("No trip defined.\n");

        // when
        $this->tripPrinter->printTrip($collection);
    }

    public function testShouldPrintTripPlan()
    {
        // given
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

        $collection = new BoardingCardsCollection([
            $fromStockholm,
            $fromMadrid,
            $fromBarcelona,
            $fromGerona,
        ]);

        $this->expectOutputString("1. From Stockholm Airport, take flight SK22 to New York. Gate 22, seat 7B
2. Take train 78A from Madrid to Barcelona. Sit in seat 45B
3. Take the airport bus from Barcelona to Gerona Airport. No seat assignment
4. From Gerona Airport, take flight SK455 to Stockholm. Gate 45B, seat 3A
5. You have arrived at your final destination.\n");

        // when
        $this->tripPrinter->printTrip($collection);
    }
}
