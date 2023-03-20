<?php

use PHPUnit\Framework\TestCase;

class ControladorTest extends TestCase
{
    private $controlador;

    protected function setUp(): void       {$this->controlador = new Controlador();}

    protected function tearDown(): void    {$this->controlador = null;}

    public function test_Cargar_Controlador()
    {
        $this->controlador->Cargar_Controlador('negocios');
        $this->assertInstanceOf('negocios', $this->controlador->controlador);
    }

    public function test_Cargar_Modelo()
    {
        $this->controlador->Cargar_Modelo('negocios');
        $this->assertInstanceOf('Negocios_Class', $this->controlador->modelo);
    }

    public function test_Validacion()
    {
        $this->controlador->Validacion('Viviendas');
        $this->assertInstanceOf('Viviendas_Validacion', $this->controlador->validacion);
    }

    public function test_Codificar()
    {
        $string = 'ejemplo de string';
        $codificado = $this->controlador->Codificar($string);
        $esperado = "VjJ4Rk9WQlRUbWhhZWpBNVNURndVbEJVTUdwWmJFVTVVRk5PYWxGVU1EbEpNa3BDVUZRd2FsbHVZemxRVTA1S1VWUXdPVWt4Y0VKUVZEQnFWMnhGT1ZCVFRrcFJWREE1U1RKT00xQlVNR3BhUlVVNVVGTk9hbHA2TURsSk1rWlNVRlF3YWxsdFl6bFFVMDVoWkhvd09VbDNQVDA9";
        $this->assertEquals($esperado, $codificado);
    }

    public function test_Decodificar()
    {
        $string = 'VjJ4Rk9WQlRUbWhhZWpBNVNURndVbEJVTUdwWmJFVTVVRk5PYWxGVU1EbEpNa3BDVUZRd2FsbHVZemxRVTA1S1VWUXdPVWt4Y0VKUVZEQnFWMnhGT1ZCVFRrcFJWREE1U1RKT00xQlVNR3BhUlVVNVVGTk9hbHA2TURsSk1rWlNVRlF3YWxsdFl6bFFVMDVoWkhvd09VbDNQVDA9';
        $decodificado = $this->controlador->Decodificar($string);
        $esperado = "ejemplo de string";
        $this->assertEquals($esperado, $decodificado);
    }

    public function test_Seguridad_Password()
    {
        $cadena_codificada = $this->controlador->Seguridad_Password('cadena', 1);
        $this->assertEquals('cadena', $this->controlador->Seguridad_Password($cadena_codificada, 0));
    }

    public function test_GenerateRSAKeys()
    {
        $keys = ['clave1', 'clave2', 'clave3'];
        $privateKey = $this->controlador->GenerateRSAKeys($keys);
        $this->assertIsArray($privateKey);
    }

    public function test_EncryptBits()
    {
        $this->assertEquals('!', $this->controlador->EncryptBits('1'));
        $this->assertEquals('X', $this->controlador->EncryptBits('0'));
        $this->assertEquals('A?', $this->controlador->EncryptBits('23'));
    }

    public function test_EscribirJSON()
    {
        $this->controlador = new Controlador();
        ob_start();
        $this->controlador->Escribir_JSON(['nombre' => 'Juan', 'edad' => 35]);
        $output = ob_get_contents();
        ob_end_clean();
        $this->assertJsonStringEqualsJsonString('{"nombre":"Juan","edad":35}', $output);
    }

    public function test_VerArray()
    {
        ob_start();
        $this->controlador->Ver_Array(['nombre' => 'Juan', 'edad' => 35]);
        $output = ob_get_contents();
        ob_end_clean();
        $this->assertStringContainsString('array(2)', $output);
        $this->assertStringContainsString('["nombre"]=>', $output);
        $this->assertStringContainsString('["edad"]=>', $output);
    }
}
