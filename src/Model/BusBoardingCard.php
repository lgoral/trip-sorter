<?php

namespace TripSorter\Model;

class BusBoardingCard extends AbstractBoardingCard
{
    /**
     * {@inheritdoc}
     */
    public function getInformation(): string
    {
        return sprintf(
            'Take the airport bus from %s to %s Airport. No seat assignment',
            $this->source,
            $this->destination
        );
    }
}
