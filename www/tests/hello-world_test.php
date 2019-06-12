<?php

use \PHPUnit\Framework\TestCase;
require "hello-world.php";

class HelloWorldTest extends TestCase
{
    public function testNoName()
    {
        $this->assertEquals('Hello, World!', helloworld());
    }

    public function testSampleName(){
        $this->assertEquals('Hello, Alice!', helloworld('Alice'));
    }

    public function testSampleName2(){
        $this->assertEquals('Hello, Bob!', helloworld('bob'));
    }

    public function testSampleName3(){
        $this->assertEquals('Hello, Pierre!', helloworld('PIERRE'));
    }


}