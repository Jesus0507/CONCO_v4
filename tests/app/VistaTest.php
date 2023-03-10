<?php

use PHPUnit\Framework\TestCase;

class VistaTest extends TestCase
{
    private $vista;

    protected function setUp(): void
    {$this->vista = new Vista();}

    protected function tearDown(): void
    {$this->vista = null;}

    public function test_Cargar_Vistas()
    {
        ob_start();
        $this->vista->Cargar_Vistas('inicio/index');
        $contenido_vista = ob_get_clean();
        $this->assertNotEmpty($contenido_vista);
    }

}
