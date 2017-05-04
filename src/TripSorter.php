<?php

namespace TripSorter;

use TripSorter\Model\BoardingCardInterface;
use TripSorter\Model\BoardingCardsCollection;

class TripSorter
{
    /**
     * @param BoardingCardsCollection $boardingCards
     *
     * @return BoardingCardsCollection
     */
    public function sort(BoardingCardsCollection $boardingCards)
    {
        $table = $this->buildSourceDestinationTable($boardingCards->toArray());
        $start = $this->getSource($table['destination']);
        $table = $this->sortBoardingCards($start, $table['source']);

        return new BoardingCardsCollection($table);
    }

    /**
     * @param BoardingCardInterface[] $cards
     *
     * @return array
     */
    private function buildSourceDestinationTable(array $cards)
    {
        $reduceFunction = function ($previousValue, BoardingCardInterface $currentValue) {
            $previousValue['source'][$currentValue->getSource()] = $currentValue;
            $previousValue['destination'][$currentValue->getDestination()] = $currentValue;

            if (!isset($previousValue['source'][$currentValue->getDestination()])) {
                $previousValue['source'][$currentValue->getDestination()] = false;
            }
            if (!isset($previousValue['destination'][$currentValue->getSource()])) {
                $previousValue['destination'][$currentValue->getSource()] = false;
            }

            return $previousValue;
        };

        return array_reduce($cards, $reduceFunction, ['source' => [], 'destination' => []]);
    }

    /**
     * @param BoardingCardInterface[] $cards
     *
     * @return string
     */
    private function getSource(array $cards)
    {
        return array_search(false, $cards);
    }

    /**
     * @param string                  $start
     * @param BoardingCardInterface[] $cards
     *
     * @return array
     */
    private function sortBoardingCards(string $start, array $cards)
    {
        $sorted = [];
        while ($start) {
            $node = $cards[$start];
            $start = false;
            if ($node) {
                array_push($sorted, $node);
                $start = $node->getDestination();
            }
        }

        return $sorted;
    }
}
