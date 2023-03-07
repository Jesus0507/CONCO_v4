<?php
// Importar la clase que se va a probar
require_once "BASE_DATOS.php";

class BASE_DATOS_Test extends PHPUnit_Framework_TestCase
{
    public function testConexion()
    {
        // Instanciar la clase BASE_DATOS
        $bd = new BASE_DATOS();
        $this->assertInstanceOf('PDO', $bd->Conectar());
        $this->assertEquals(1, $bd->Probar_Conexion());
        $this->assertEquals("No se han encontrado errores.", $bd->Error_Conexion());
    }
}
