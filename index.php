<?php

use mars\Coordinate;
use mars\FileManager;
use mars\Plate;
use mars\Rover;

require __DIR__ . '/vendor/autoload.php';

$inputFileName = "input.txt";
$outputFileName = "output.txt";
$outputText = '';
$plate = null;
$rover = null;
$fileManager = new FileManager($inputFileName, $outputFileName);
$commandRows = $fileManager->readFile();
$result = [];
foreach ($commandRows as $iteration => $commandRow) {
    $commands = explode(' ', $commandRow);
    if ($iteration == 0) {
        $coordinate = new Coordinate($commands[0], $commands[1]);
        $plate = new Plate($coordinate);
    }

    if ($iteration % 2 != 0 && $plate) {
        $coordinate = new Coordinate($commands[0], $commands[1]);
        $rover = new Rover($coordinate, trim($commands[2]), $plate);
    }
    if ($iteration % 2 == 0 && $rover) {
        $result[] = $rover->handleCommands($commands[0]);
    }
}
$fileManager->writeFile(implode(PHP_EOL, $result));