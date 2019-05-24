<?php

namespace mars;

class FileManager
{
    private $inputFileName = null;

    private $outputFileName = null;

    public function __construct($inputFileName, $outputFileName)
    {
        $this->inputFileName = $inputFileName;
        $this->outputFileName = $outputFileName;
    }

    public function readFile()
    {
        $result = array();
        $handle = fopen($this->inputFileName, "r");
        if ($handle) {
            while (($buffer = fgets($handle)) !== false) {
                $result[] = $buffer;
            }
            fclose($handle);
        }
        return $result;
    }

    public function writeFile($text)
    {
        return file_put_contents($this->outputFileName, $text);
    }
}
