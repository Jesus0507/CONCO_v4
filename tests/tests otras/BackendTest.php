<?php

require_once 'Centro_Votacion_Validacion.php';

use PHPUnit\Framework\TestCase;

class BackendTest extends TestCase
{
    public function test_Centro_Votacion_Validacion_Backend()
    {
        $validacion = new Centro_Votacion_Validacion();
        $resultado = $validacion->Validacion_Registro();
        $this->assertFalse($resultado);
        $this->assertEquals('["Debe llenar los datos del formulario"]', $validacion->Fallo());
    }

    public function test_Centro_Votacion_Validacion_Backend()
    {
        $validacion = new Centro_Votacion_Validacion();
        $resultado = $validacion->Validacion_Registro();
        $this->assertFalse($resultado);
        $this->assertEquals('["Debe llenar los datos del formulario"]', $validacion->Fallo());
    }
}
