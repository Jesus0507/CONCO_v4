<?php

require_once 'Herramientas.php';

use PHPUnit\Framework\TestCase;

class HerramientasTest extends TestCase
{
    use Herramientas;
    public function testVerArray()
    {

        $expected = "<pre>string(5) \"hello\"</pre>";
        $this->expectOutputString($expected);
        $this->Ver_Array("hello");
    }
}
