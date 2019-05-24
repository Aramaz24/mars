<?php

namespace mars;

class Rover
{
    private $coordinates;

    private $direction;

    private $plate;

    static $moveCommand = 'M';

    static $rotateCommands = ['L', 'R'];

    public function __construct(Coordinate $coordinates, $direction, Plate $plate)
    {
        $this->coordinates = $coordinates;
        $this->direction = $direction;
        $this->plate = $plate;
    }

    public function handleCommands($commands)
    {
        $parsedCommands = self::parseCommands($commands);
        foreach ($parsedCommands as $command) {
            $this->executeCommand($command);
        }
        return $this->getResult();
    }

    private function executeCommand($command)
    {
        if ($command == self::$moveCommand) {
            $this->moveRover();
        } elseif (in_array($command, self::$rotateCommands)) {
            $this->rotateRover($command);
        }
    }

    static function parseCommands($commands)
    {
        return preg_split("//", $commands, -1, PREG_SPLIT_NO_EMPTY);
    }

    private function getResult()
    {
        return $this->coordinates . ' ' . $this->direction;
    }

    private function rotateRover($rotateDirection)
    {
        switch ($this->direction) {
            case 'N':
                $this->direction = $rotateDirection == 'L' ? 'W' : 'E';
                break;
            case 'S':
                $this->direction = $rotateDirection == 'L' ? 'E' : 'W';
                break;
            case 'W':
                $this->direction = $rotateDirection == 'L' ? 'S' : 'N';
                break;
            case 'E':
                $this->direction = $rotateDirection == 'L' ? 'N' : 'S';
                break;
        }
    }

    private function moveRover()
    {
        switch ($this->direction) {
            case 'N':
                $coordinateY = $this->coordinates->getCoordinateY();
                $newCoordinate = $this->checkNorthCrossBorder($coordinateY) ? $coordinateY + 1 : $coordinateY;
                $this->coordinates->setCoordinateY($newCoordinate);
                break;
            case 'S':
                $coordinateY = $this->coordinates->getCoordinateY();
                $newCoordinate = $this->checkSouthCrossBorder($coordinateY) ? $coordinateY - 1 : $coordinateY;
                $this->coordinates->setCoordinateY($newCoordinate);
                break;
            case 'W':
                $coordinateX = $this->coordinates->getCoordinateX();
                $newCoordinate = $this->checkWestCrossBorder($coordinateX) ? $coordinateX - 1 : $coordinateX;
                $this->coordinates->setCoordinateX($newCoordinate);
                break;
            case 'E':
                $coordinateX = $this->coordinates->getCoordinateX();
                $newCoordinate = $this->checkEastCrossBorder($coordinateX) ? $coordinateX + 1 : $coordinateX;
                $this->coordinates->setCoordinateX($newCoordinate);
                break;
        }
    }

    private function checkNorthCrossBorder($coordinate)
    {
        return $coordinate < $this->plate->getNorthBorder();
    }

    private function checkSouthCrossBorder($coordinate)
    {
        return $coordinate > $this->plate->getSouthBorder();
    }

    private function checkWestCrossBorder($coordinate)
    {
        return $coordinate > $this->plate->getWestBorder();
    }

    private function checkEastCrossBorder($coordinate)
    {
        return $coordinate < $this->plate->getEastBorder();
    }
}