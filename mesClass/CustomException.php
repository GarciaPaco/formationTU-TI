<?php
namespace Exception;
use Exception;
class CustomException extends Exception
{
    public function errorMessage():string {
        return "Error on line {$this->getLine()} in {$this->getFile()} : Division par zéro impossible";
    }
}