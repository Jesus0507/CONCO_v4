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

    public function testEncryptBits()
    {
        $myObject = new Controlador();
        $this->assertEquals('!AMBZ!?', $myObject->EncryptBits('1234567890'));
        $this->assertEquals('!', $myObject->EncryptBits('1'));
        $this->assertEquals('X', $myObject->EncryptBits('0'));
        $this->assertEquals('A?', $myObject->EncryptBits('23'));
    }

    public function testEscribirJSON()
    {
        $myObject = new Controlador();
        ob_start();
        $myObject->Escribir_JSON(['nombre' => 'Juan', 'edad' => 35]);
        $output = ob_get_contents();
        ob_end_clean();
        $this->assertJsonStringEqualsJsonString('{"nombre":"Juan","edad":35}', $output);
    }

    public function testVerArray()
    {
        $myObject = new Controlador();
        ob_start();
        $myObject->Ver_Array(['nombre' => 'Juan', 'edad' => 35]);
        $output = ob_get_contents();
        ob_end_clean();
        $this->assertStringContainsString('array(2)', $output);
        $this->assertStringContainsString('["nombre"]=>', $output);
        $this->assertStringContainsString('["edad"]=>', $output);
    }
}
