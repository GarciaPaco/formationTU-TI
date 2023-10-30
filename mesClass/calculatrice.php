<?php

class Calculatrice
{
    public int $first;
    public int $second;

    public function add(int $first, int $second): int
    {
        return $first + $second;
    }

    public function substract(int $first, int $second): int
    {
        return $first - $second;
    }

    public function multiply(int $first, int $second): int
    {
        return $first * $second;
    }


    public function divide(int $first, int $second): int
    {
        if ($second === 0) {
            throw new Exception('Division par zéro impossible');
        }
        return $first / $second;

    }


}