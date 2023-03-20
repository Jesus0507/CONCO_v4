<?php

require_once "controlador/habitante_controlador.php";
require_once "modelo/habitante_class.php";

use PHPUnit\Framework\TestCase;

$_SESSION['cedula_usuario'] = "7654321";
$_SESSION['Habitante']         = [
    "consultar" => 1,
    "registrar" => 1,
    "eliminar"  => 1,
    "modificar" => 1,
];
$_POST = [
    'estado'   => [
        "tabla"  => "habitante",
        "id"     => "id_habitante",
        "data"   => 1,
        "estado" => 1,
    ],
    'sql'      => 'SQL_1',
];

class HabitanteTestControlador extends TestCase
{
    private $Habitante;

    protected function setUp(): void     {$this->Habitante = new Habitante();}

    protected function tearDown(): void  {$this->Habitante = null;}

    public function test_Cargar_Vistas()
    {
        $this->Habitante->vista = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Habitante->vista->expects($this->once())->method('Cargar_Vistas')->with('Habitante/consultar');
        $this->Habitante->Cargar_Vistas();
        $this->assertTrue(true);
    }

    public function test_Establecer_Consultas()
    {
        $this->Habitante->Establecer_Consultas();
        $this->assertNotEmpty($this->Habitante->Get_Datos_Vista());
    }

    public function test_Getters()
    {
        $this->assertIsString($this->Habitante->Get_Sql());
        $this->assertIsString($this->Habitante->Get_Accion());
        $this->assertIsString($this->Habitante->Get_Mensaje());
        $this->assertIsArray($this->Habitante->Get_Datos());
        $this->assertIsArray($this->Habitante->Get_Estado());
        $this->assertIsArray($this->Habitante->Get_Estado_Ejecutar());
    }
    // =================================================================
}
