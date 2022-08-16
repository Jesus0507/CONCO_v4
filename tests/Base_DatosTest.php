<?php
use PHPUnit\Framework\TestCase; 

class Base_DatosTest extends TestCase
{
    public function test_Probar_Conexion()
    {
        $modelo = new BASE_DATOS();
        $data = $modelo->Probar_Conexion();
        $this->assertEquals(count($data), true);
    }

    public function test_Error_Conexion()
    {
        $modelo = new BASE_DATOS();
        $data = $modelo->Error_Conexion();
        $this->assertEquals(count($data), true);
    }
}
