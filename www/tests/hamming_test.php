<?php
use \PHPUnit\Framework\TestCase;
require "hamming.php";

class DistanceTest extends TestCase{
    public function testDistance() {
        $this->assertEquals(0, distance('A','A'));
    }

    public function testDistance1() {
        $this->assertEquals(1, distance('B','C'));
    }

    public function testDistance2(){
        $this->assertEquals(2, distance('AB', 'CD'));
    }

    public function testDistance3(){
        $this->assertEquals(1, distance('AT','BT'));
    }

    public function testDistanceFausse(){
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage(('opération invalide'), distance('AZ','BCD'));
    }
    public function testDistance4(){
        $this->assertEquals(2, distance('AGACC','CCACC'));
    }
    public function testDistance5(){
        $this->assertEquals(2, distance('ATGGAG','BTGAAG'));
    }
    public function testDistance6(){
        $this->assertEquals(6, distance('AGACCT','BCTTTS'));
    }
}