<?php

namespace TripSorter\Model;

class FlightBoardingCard extends AbstractBoardingCard
{
    /**
     * @var string
     */
    private $number;

    /**
     * @var string
     */
    private $gate;

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
            'From %s Airport, take flight %s to %s. Gate %s, seat %s',
            $this->source,
            $this->number,
            $this->destination,
            $this->gate,
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
     * @param string $gate
     *
     * @return $this
     */
    public function setGate(string $gate)
    {
        $this->gate = $gate;

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
