<?php

class ValidacionTest extends PHPUnit\Framework\TestCase
{
    public function testValidarCedula()
    {
        $validacion = new Validacion();

        $this->assertTrue($validacion->Validar('cedula', '12345678'));
        $this->assertTrue($validacion->Validar('cedula', '123456789'));
        $this->assertTrue($validacion->Validar('cedula', '1234567890'));

        $this->assertFalse($validacion->Validar('cedula', '1234'));
        $this->assertFalse($validacion->Validar('cedula', '1234567a9'));
        $this->assertFalse($validacion->Validar('cedula', '12345678901'));
    }

    public function testValidarCaracteres()
    {
        $validacion = new Validacion();

        $this->assertTrue($validacion->Validar('caracteres', 'Hola123'));
        $this->assertTrue($validacion->Validar('caracteres', 'áéíóúñ'));
        $this->assertTrue($validacion->Validar('caracteres', 'Hola 123'));

        $this->assertFalse($validacion->Validar('caracteres', 'Hola*'));
        $this->assertFalse($validacion->Validar('caracteres', ''));
    }

    public function testValidarRif()
    {
        $validacion = new Validacion();

        $this->assertTrue($validacion->Validar('rif', 'V123456789'));
        $this->assertTrue($validacion->Validar('rif', 'J123456789'));

        $this->assertFalse($validacion->Validar('rif', '123456789'));
        $this->assertFalse($validacion->Validar('rif', 'V1234567890'));
    }

}
