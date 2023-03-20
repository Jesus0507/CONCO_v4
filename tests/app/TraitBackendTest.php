<?php

use PHPUnit\Framework\TestCase;

require_once 'Backend.php'; // Incluimos el archivo con el trait

class TraitBackendTest extends TestCase
{
    use Backend; // Usamos el trait en la clase de prueba

    public function testMensaje()
    {
        $this->mensaje = "Hola Mundo";
        $this->assertEquals("Hola Mundo", $this->mensaje);
    }

    public function testErrores()
    {
        $this->Errores = ["Error 1", "Error 2"];
        $this->assertIsArray($this->Errores);
        $this->assertCount(2, $this->Errores);
        $this->assertContains("Error 1", $this->Errores);
        $this->assertContains("Error 2", $this->Errores);
    }

    public function testDatos()
    {
        $this->datos = ["Nombre" => "Juan", "Edad" => 30];
        $this->assertIsArray($this->datos);
        $this->assertCount(2, $this->datos);
        $this->assertArrayHasKey("Nombre", $this->datos);
        $this->assertArrayHasKey("Edad", $this->datos);
        $this->assertEquals("Juan", $this->datos["Nombre"]);
        $this->assertEquals(30, $this->datos["Edad"]);
    }
}
