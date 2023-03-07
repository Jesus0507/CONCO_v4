<?php

require_once 'Direcciones.php';

use PHPUnit\Framework\TestCase;

class DireccionesTest extends TestCase
{
    public function testSeguridadCodificar()
    {
        $entrada  = 'https://www.google.com';
        $esperado = Direcciones::Seguridad($entrada, 'codificar');

        $this->assertIsString($esperado);
        $this->assertNotEquals($entrada, $esperado);
    }

    public function testSeguridadDecodificar()
    {
        $entrada  = 'L2ZvcnVtL2luZGV4LnBocA==';
        $esperado = Direcciones::Seguridad($entrada, 'decodificar');

        $this->assertIsString($esperado);
        $this->assertEquals('http://formulacion.php', $esperado);
    }

    public function testURL()
    {
        $esperado = Direcciones::URL();

        $this->assertIsString($esperado);
        $this->assertNotEmpty($esperado);
    }

    public function test_000_()
    {
        $entrada  = 'https://www.google.com';
        $esperado = Direcciones::Seguridad($entrada, 'codificar');

        ob_start();
        Direcciones::_000_($esperado);
        $salida = ob_get_clean();

        $this->expectOutputString(Direcciones::URL() . $esperado);
        $this->assertEquals($salida, Direcciones::URL() . $esperado);
    }
}
