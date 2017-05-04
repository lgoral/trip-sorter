<?php

namespace TripSorter\Model;

abstract class AbstractBoardingCard implements BoardingCardInterface
{
    /**
     * @var string
     */
    protected $source;

    /**
     * @var string
     */
    protected $destination;

    /**
     * {@inheritdoc}
     */
    public function getDestination(): string
    {
        return $this->destination;
    }

    /**
     * {@inheritdoc}
     */
    public function setDestination(string $destination)
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getSource(): string
    {
        return $this->source;
    }

    /**
     * {@inheritdoc}
     */
    public function setSource(string $source)
    {
        $this->source = $source;

        return $this;
    }
}
