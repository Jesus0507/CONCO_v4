<?php

use PHPUnit\Framework\TestCase;

class VistaTest extends TestCase
{
    public function testCargarVistas()
    {
        $vista       = new Vista();
        $mockRequire = $this->getMockBuilder(stdClass::class)->setMethods(['__invoke'])->getMock();
        $mockRequire->expects($this->once())->method('__invoke')->with($this->equalTo('vista/test.php'));
        $vista->setRequireFunction($mockRequire);
        $vista->Cargar_Vistas('test');
    }

    public function testCargarVistas()
    {
        // Crear una instancia de la clase Vista
        $vista = new Vista();
        $this->expectException(\PHPUnit\Framework\Error\Error::class);
        $this->expectExceptionMessage('require(vista/nombre_vista.php): failed to open stream: No such file or directory');
        $vista->Cargar_Vistas('nombre_vista');
    }

    public function testSesion()
    {
        // Crear una instancia de la clase Vista
        $vista = new Vista();
        $vista->_SESSION_('nombre_sesion');
        $this->assertEquals('nombre_sesion', $vista->SESSION());
    }

}
