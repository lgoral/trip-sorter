<?php

namespace TripSorter\Model;

class TrainBoardingCard extends AbstractBoardingCard
{
    /**
     * @var string
     */
    private $number;

    /**
     * @var string
     */
    private $seat;

    /**
     * {@inheritdoc}
     */
    public function getInformation(): string
    {
        return sprintf(
            'Take train %s from %s to %s. Sit in seat %s',
            $this->number,
            $this->source,
            $this->destination,
            $this->seat
        );
    }

    /**
     * @param string $number
     *
     * @return $this
     */
    public function setNumber(string $number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @param string $seat
     *
     * @return $this
     */
    public function setSeat(string $seat)
    {
        $this->seat = $seat;

        return $this;
    }
}
