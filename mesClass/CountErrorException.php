<?php

namespace Exception;
use Exception;
class CountErrorException extends Exception
{
    public function errorInsertion():string {
        return "Error on line {$this->getLine()} in {$this->getFile()} : La comparaison de lignes en base ne s'est pas faite";
    }
}