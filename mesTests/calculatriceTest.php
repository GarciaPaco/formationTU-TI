<?php
require 'mesClass/calculatrice.php';
require 'mesClass/DivisionByZeroException.php';

use Exception\DivisionByZeroException;
use PHPUnit\Framework\TestCase;
class CalculatriceTest extends TestCase {

    public function testAdd() {
        $calculatrice = new Calculatrice();
        $result = $calculatrice->add(5, 3);
        $this->assertEquals(8, $result);
    }
    public function testSoustraction() {
        $calculatrice = new Calculatrice();
        $result = $calculatrice->substract(10, 4);
        $this->assertEquals(6, $result);
    }

    public function testMultiplication() {
        $calculatrice = new Calculatrice();
        $result = $calculatrice->multiply(6, 7);
        $this->assertEquals(42, $result);
    }

    public function testDivision() {
        $calculatrice = new Calculatrice();
        $result = $calculatrice->divide(20, 4);
        $this->assertEquals(5, $result);


    }
     public function testDivisionByZero()
     {
         $calculatrice = new Calculatrice();
         $this->expectException(DivisionByZeroException::class);
         $calculatrice->divide(20, 0);
     }

}
