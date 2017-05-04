<?php

namespace TripSorter;

use TripSorter\Model\BoardingCardsCollection;

class TripPrinter
{
    /**
     * @param BoardingCardsCollection $boardingCards
     */
    public function printTrip(BoardingCardsCollection $boardingCards)
    {
        foreach ($boardingCards as $stepNumber => $step) {
            print_r(sprintf("%d. %s\n", ++$stepNumber, $step->getInformation()));
        }

        $information = "No trip defined.\n";
        if ($boardingCards->count()) {
            $information = sprintf("%d. You have arrived at your final destination.\n", ++$stepNumber);
        }
        print_r($information);
    }
}
