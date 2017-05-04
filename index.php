<?php

require_once __DIR__ . '/vendor/autoload.php';

use TripSorter\Model\BoardingCardsCollection;
use TripSorter\Model\BusBoardingCard;
use TripSorter\Model\FlightBoardingCard;
use TripSorter\Model\TrainBoardingCard;
use TripSorter\TripPrinter;
use TripSorter\TripSorter;

$boardingCards = new BoardingCardsCollection([
    (new FlightBoardingCard())
        ->setSource('Stockholm')
        ->setDestination('New York')
        ->setNumber('SK22')
        ->setGate('22')
        ->setSeat('7B'),
    (new TrainBoardingCard())->setSource('Madrid')->setDestination('Barcelona')->setNumber('78A')->setSeat('45B'),
    (new BusBoardingCard())->setSource('Barcelona')->setDestination('Gerona'),
    (new FlightBoardingCard())
        ->setSource('Gerona')
        ->setDestination('Stockholm')
        ->setNumber('SK455')
        ->setGate('45B')
        ->setSeat('3A'),
]);

$tripSorter = new TripSorter();
$tripPrinter = new TripPrinter();
$boardingCards = $tripSorter->sort($boardingCards);
$tripPrinter->printTrip($boardingCards);
