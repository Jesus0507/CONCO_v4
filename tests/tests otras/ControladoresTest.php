<?php

use PHPUnit\Framework\TestCase;

class ControladorTest extends TestCase
{
    public function testCargarControlador()
    {
        $controlador = new Controlador();
        $controlador->Cargar_Controlador('nombre_del_controlador');
        $this->assertInstanceOf('nombre_del_controlador', $controlador->controlador);
    }

    public function testCargarModelo()
    {
        $controlador = new Controlador();
        $controlador->Cargar_Modelo('nombre_del_modelo');
        $this->assertInstanceOf('nombre_del_modelo', $controlador->modelo);
    }

    public function testValidacion()
    {
        $controlador = new Controlador();
        $controlador->Validacion('nombre_del_modulo');
        $this->assertInstanceOf('nombre_del_modulo_Validacion', $controlador->validacion);
    }

    public function testCodificar()
    {
        $controlador = new Controlador();
        $this->assertEquals('cadena_codificada', $controlador->Codificar('cadena'));
    }

    public function testDecodificar()
    {
        $controlador = new Controlador();
        $this->assertEquals('cadena', $controlador->Decodificar('cadena_codificada'));
    }

    public function testSeguridadPassword()
    {
        $controlador = new Controlador();
        $cadena_codificada = $controlador->Seguridad_Password('cadena', 1);
        $this->assertEquals('cadena', $controlador->Seguridad_Password($cadena_codificada, 0));
    }

    public function testGenerateRSAKeys()
    {
        $controlador = new Controlador();
        $keys = ['clave1', 'clave2', 'clave3'];
        $privateKey = $controlador->GenerateRSAKeys($keys);
        $this->assertIsString($privateKey);
    }
}
