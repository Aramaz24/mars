<?php

namespace mars;

class Plate
{
    private $defaultCoordinates;

    private $coordinates;

    public function __construct(Coordinate $coordinates)
    {
        $this->defaultCoordinates = new Coordinate(0, 0);
        $this->coordinates = $coordinates;
    }

    public function getNorthBorder()
    {
        return $this->coordinates->getCoordinateY();
    }

    public function getSouthBorder()
    {
        return $this->defaultCoordinates->getCoordinateY();
    }

    public function getEastBorder()
    {
        return $this->coordinates->getCoordinateX();
    }

    public function getWestBorder()
    {
        return $this->defaultCoordinates->getCoordinateX();
    }
}