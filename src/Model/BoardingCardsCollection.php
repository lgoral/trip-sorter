<?php

namespace TripSorter\Model;

use ArrayIterator;

class BoardingCardsCollection extends ArrayIterator
{
    /**
     * {@inheritdoc}
     */
    public function __construct(array $array = [])
    {
        foreach ($array as $object) {
            if (!is_a($object, BoardingCardInterface::class)) {
                throw new \Exception(
                    'Invalid object passed to ' . __METHOD__ . ', expected type ' . BoardingCardInterface::class
                );
            }
        }
        parent::__construct($array);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return iterator_to_array($this);
    }
}
