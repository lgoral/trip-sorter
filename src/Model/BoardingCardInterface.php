<?php

namespace TripSorter\Model;

interface BoardingCardInterface
{
    /**
     * @return string
     */
    public function getDestination(): string;

    /**
     * @param string $destination
     *
     * @return $this
     */
    public function setDestination(string $destination);

    /**
     * @return string
     */
    public function getSource(): string;

    /**
     * @param string $source
     *
     * @return $this
     */
    public function setSource(string $source);

    /**
     * @return string
     */
    public function getInformation(): string;
}
