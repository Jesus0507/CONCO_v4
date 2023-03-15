<?php

require_once "controlador/reportes_controlador.php";
require_once "modelo/reportes_class.php";

use PHPUnit\Framework\TestCase;

$_SESSION['cedula_usuario'] = "7654321";

class ReportesTestControlador extends TestCase
{
    private $Reportes;

    protected function setUp(): void
    {
        $this->Reportes = new Reportes();
    }

    protected function tearDown(): void
    {$this->Reportes = null;}

    public function test_Cargar_Vistas()
    {
        $this->Reportes->vista = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Reportes->vista->expects($this->once())->method('Cargar_Vistas')->with('Reportes/reportes');
        $this->Reportes->Cargar_Vistas();
        $this->assertTrue(true);
    }

    public function test_Establecer_Consultas()
    {
        $this->Reportes->Establecer_Consultas();
        $this->assertNotEmpty($this->Reportes->Get_Datos_Vista());
    }

    public function test_Getters()
    {
        $this->assertIsString($this->Reportes->Get_Sql());
        $this->assertIsString($this->Reportes->Get_Accion());
        $this->assertIsString($this->Reportes->Get_Mensaje());
        $this->assertIsArray($this->Reportes->Get_Datos());
        $this->assertIsArray($this->Reportes->Get_Estado());
        $this->assertIsArray($this->Reportes->Get_Estado_Ejecutar());
    }

    public function test_Administrar_Reportes_PDF()
    {
        $this->Reportes->modelo = $this->getMockBuilder(Reportes_Class::class)->disableOriginalConstructor()->getMock();
        $result                 = $this->Reportes->Administrar("Consulta_Ajax");
        $this->expectOutputString($result);
    }

    // =================================================================
}
