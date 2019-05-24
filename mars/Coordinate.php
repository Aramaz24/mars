<?php

namespace mars;

class Coordinate
{
    private $coordinateX;

    private $coordinateY;

    public function __construct($coordinateX, $coordinateY)
    {
        $this->coordinateX = $coordinateX;
        $this->coordinateY = $coordinateY;
    }

    public function __toString()
    {
        return $this->coordinateX . ' ' . $this->coordinateY;
    }

    public function getCoordinateX()
    {
        return $this->coordinateX;
    }

    public function setCoordinateX($coordinateX): void
    {
        $this->coordinateX = $coordinateX;
    }

    public function getCoordinateY()
    {
        return $this->coordinateY;
    }

    public function setCoordinateY($coordinateY): void
    {
        $this->coordinateY = $coordinateY;
    }
}