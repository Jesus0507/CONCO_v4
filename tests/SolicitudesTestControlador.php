<?php

require_once "controlador/solicitudes_controlador.php";
require_once "modelo/solicitudes_class.php";

use PHPUnit\Framework\TestCase;

$_SESSION['cedula_usuario'] = "7654321";
$_SESSION['Solicitudes']    = [
    "consultar" => 1,
    "registrar" => 1,
    "eliminar"  => 1,
    "modificar" => 1,
];
$_POST = [
    'estado' => [
        "tabla"  => "solicitudes",
        "id"     => "id_solicitudes",
        "data"   => 1,
        "estado" => 1,
    ],
    'datos'  => [
        'cedula_persona'    => '7654321',
        'tipo_constancia'   => 'constancia de residencia',
        'procesada'         => '0',
        'motivo_constancia' => 'para tramite',
        'observaciones'     => 'ninguna',
    ],
    'sql'    => 'SQL_1',
    'accion' => 'registro exitoso',
];

class SolicitudesTestControlador extends TestCase
{
    private $Solicitudes;

    protected function setUp(): void
    {
        $this->Solicitudes = new Solicitudes();
    }

    protected function tearDown(): void
    {$this->Solicitudes = null;}

    // =================================================================

    public function test_Cargar_Vistas()
    {
        $this->Solicitudes->vista = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Solicitudes->vista->expects($this->once())->method('Cargar_Vistas')->with('Solicitudes/consultar');
        $this->Solicitudes->Cargar_Vistas();
        $this->assertTrue(true);
    }

    public function test_Establecer_Consultas()
    {
        $this->Solicitudes->Establecer_Consultas();
        $this->assertNotEmpty($this->Solicitudes->Get_Datos_Vista());
    }

    public function test_Getters()
    {
        $this->assertIsString($this->Solicitudes->Get_Sql());
        $this->assertIsString($this->Solicitudes->Get_Accion());
        $this->assertIsString($this->Solicitudes->Get_Mensaje());
        $this->assertIsArray($this->Solicitudes->Get_Datos());
        $this->assertIsArray($this->Solicitudes->Get_Estado());
        $this->assertIsArray($this->Solicitudes->Get_Estado_Ejecutar());
    }

    public function test_Administrar_Consultas_Registros_Vistas()
    {
        $this->Solicitudes->vista = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Solicitudes->vista->expects($this->once())->method('Cargar_Vistas')->with('Solicitudes/consultar');
        $this->Solicitudes->Administrar("Consultas");
        $this->Solicitudes->vista->expects($this->once())->method('Cargar_Vistas')->with('Solicitudes/registrar');
        $this->Solicitudes->Administrar("Registros");
        $this->assertTrue(true);
    }

    public function test_Administrar_Registrar()
    {
        $this->Solicitudes->modelo     = $this->getMockBuilder(Solicitudes_Class::class)->disableOriginalConstructor()->getMock();
        $this->Solicitudes->validacion = $this->getMockBuilder(Solicitudes_Validacion::class)->disableOriginalConstructor()->getMock();
        $this->Solicitudes->validacion->expects($this->once())->method('Validacion_Registro')->willReturn(true);
        $this->Solicitudes->modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $this->Solicitudes->Administrar("Registrar");
        $this->assertTrue(true);
    }

    public function test_Administrar_Consulta_Ajax()
    {
        $this->Solicitudes->modelo = $this->getMockBuilder(Solicitudes_Class::class)->disableOriginalConstructor()->getMock();
        $result                        = $this->Solicitudes->Administrar("Consulta_Ajax");
        $this->expectOutputString($result);
    }

    public function test_Administrar_Editar()
    {
        $this->Solicitudes->modelo     = $this->getMockBuilder(Solicitudes_Class::class)->disableOriginalConstructor()->getMock();
        $this->Solicitudes->validacion = $this->getMockBuilder(Solicitudes_Validacion::class)->disableOriginalConstructor()->getMock();
        $this->Solicitudes->validacion->expects($this->once())->method('Validacion_Registro')->willReturn(true);
        $this->Solicitudes->modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $this->Solicitudes->Administrar("Editar");
        $this->assertTrue(true);
    }

    public function test_Administrar_Eliminar()
    {
        $this->Solicitudes->modelo = $this->getMockBuilder(Solicitudes_Class::class)->disableOriginalConstructor()->getMock();
        $this->Solicitudes->modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $this->Solicitudes->Administrar("Eliminar");
        $this->assertTrue(true);
    }
}
