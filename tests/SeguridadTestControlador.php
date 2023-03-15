<?php

require_once "controlador/seguridad_controlador.php";
require_once "modelo/seguridad_class.php";

use PHPUnit\Framework\TestCase;

$_SESSION['cedula_usuario'] = "7654321";
$_SESSION['Seguridad']      = [
    "consultar" => 1,
    "registrar" => 1,
    "eliminar"  => 1,
    "modificar" => 1,
];
$_POST = [
    'estado' => [
        "tabla"  => "seguridad",
        "id"     => "id_seguridad",
        "data"   => 1,
        "estado" => 1,
    ],
    'datos'  => [
        'registrar'      => 1,
        'consultar'      => 1,
        'modificar'      => 1,
        'eliminar'       => 1,
        'cedula_usuario' => '1234567',
        'id_modulo'      => 2,
    ],
    'sql'    => 'SQL_1',
    'accion' => '',
];

class SeguridadTestControlador extends TestCase
{
    private $vista;

    protected function setUp(): void
    {
        $this->vista = new Vista();
    }

    protected function tearDown(): void
    {$this->Agenda = null;}

    // =================================================================

    public function test_Cargar_Vistas()
    {
        $this->Negocios->vista = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Negocios->vista->expects($this->once())->method('Cargar_Vistas')->with('Negocios/consultar');
        $this->Negocios->Cargar_Vistas();
        $this->assertTrue(true);
    }

    public function test_Getters()
    {
        $this->assertIsString($this->Negocios->Get_Sql());
        $this->assertIsString($this->Negocios->Get_Accion());
        $this->assertIsString($this->Negocios->Get_Mensaje());
        $this->assertIsArray($this->Negocios->Get_Datos());
        $this->assertIsArray($this->Negocios->Get_Estado());
        $this->assertIsArray($this->Negocios->Get_Estado_Ejecutar());
    }

    public function test_Administrar_Vistas_()
    {
        $this->Negocios->vista = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Negocios->vista->expects($this->once())->method('Cargar_Vistas')->with('Negocios/consultar');
        $this->Negocios->Administrar("Consultas");
        $this->Negocios->vista->expects($this->once())->method('Cargar_Vistas')->with('Negocios/registrar');
        $this->Negocios->Administrar("Registros");
        $this->assertTrue(true);
    }

    public function test_Administrar_Registrar()
    {
        $this->Negocios->modelo     = $this->getMockBuilder(Negocios_Class::class)->disableOriginalConstructor()->getMock();
        $this->Negocios->validacion = $this->getMockBuilder(Negocios_Validacion::class)->disableOriginalConstructor()->getMock();
        $this->Negocios->validacion->expects($this->once())->method('Validacion_Registro')->willReturn(true);
        $this->Negocios->modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $this->Negocios->Administrar("Registrar");
        $this->assertTrue(true);
    }

    public function test_Administrar_Consulta_Ajax()
    {
        $this->Negocios->modelo = $this->getMockBuilder(Negocios_Class::class)->disableOriginalConstructor()->getMock();
        $result                 = $this->Negocios->Administrar("Consulta_Ajax");
        $this->expectOutputString($result);
    }
}
