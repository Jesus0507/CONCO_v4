<?php

use PHPUnit\Framework\TestCase;

class DireccionesTest extends TestCase
{

    protected function setUp(): void
    {$this->direcciones = new Direcciones();}

    protected function tearDown(): void
    {$this->direcciones = null;}

    public function test_SeguridadCodificar()
    {
        $entrada  = 'https://127.0.0.1/CONCO_V4';
        $esperado = Direcciones::Seguridad($entrada, 'codificar');
        $this->assertIsString($esperado);
        $this->assertNotEquals($entrada, Direcciones::Seguridad($entrada, 'decodificar'));
    }

    public function test_Seguridad_Decodificar()
    {
        $entrada  = 'R3laSFNoNlpqanNUMlpMZDh4MzYzQT09';
        $esperado = Direcciones::Seguridad($entrada, 'decodificar');
        $this->assertIsString($esperado);
        $this->assertEquals("Inicio/", $esperado);
    }

    public function test_Base_URL()
    {
        $esperado = Direcciones::URL();
        $this->assertIsString($esperado);
        $this->assertNotEmpty($esperado);
    }

    public function test_000_()
    {
        ob_start();
        Direcciones::_000_('Reportes/Administrar/');
        $salida   = ob_get_clean();
        $esperado = URL . Direcciones::Seguridad('Reportes/Administrar/', 'codificar');
        $this->assertEquals($esperado, $salida);
        $this->assertNotEmpty($esperado);
    }

    public function test_Direcciones_001_045()
    {
        
        for ($i = 1; $i <= 45; $i++) {
            $nombreFuncion = '_' . str_pad($i, 3, "0", STR_PAD_LEFT) . '_';
            ob_start();
            Direcciones::$nombreFuncion();
            $esperado = ob_get_clean();
            $this->assertIsString($esperado);
            $this->assertNotEmpty($esperado);
        }
    }
}
