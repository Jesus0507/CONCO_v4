<?php

require_once "controlador/parto_humanizado_controlador.php";
require_once "modelo/parto_humanizado_class.php";

use PHPUnit\Framework\TestCase;

$_SESSION['cedula_usuario']   = "7654321";
$_SESSION['Parto_Humanizado'] = [
    "consultar" => 1,
    "registrar" => 1,
    "eliminar"  => 1,
    "modificar" => 1,
];
$_POST = [
    'estado' => [
        "tabla"  => "parto_humanizado",
        "id"     => "id_parto_humanizado",
        "data"   => 1,
        "estado" => 1,
    ],
    'datos'  => [
        'cedula_persona'         => '7654321',
        'recibe_micronutrientes' => true,
        'tiempo_gestacion'       => "32 dias",
        'fecha_aprox_parto'      => '2023-03-15',
        'estado'                 => '1',
    ],
    'sql'    => 'SQL_1',
    'accion' => 'registro exitoso',
];

class Parto_HumanizadoTestControlador extends TestCase
{
    private $Parto_Humanizado;

    protected function setUp(): void
    {
        $this->Parto_Humanizado = new Parto_Humanizado();
    }

    protected function tearDown(): void
    {$this->Parto_Humanizado = null;}

    public function test_Cargar_Vistas()
    {
        $this->Parto_Humanizado->vista = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Parto_Humanizado->vista->expects($this->once())->method('Cargar_Vistas')->with('Parto_Humanizado/consultar');
        $this->Parto_Humanizado->Cargar_Vistas();
        $this->assertTrue(true);
    }

    public function test_Establecer_Consultas()
    {
        $this->Parto_Humanizado->Establecer_Consultas();
        $this->assertNotEmpty($this->Parto_Humanizado->Get_Datos_Vista());
    }

    public function test_Getters()
    {
        $this->assertIsString($this->Parto_Humanizado->Get_Sql());
        $this->assertIsString($this->Parto_Humanizado->Get_Accion());
        $this->assertIsString($this->Parto_Humanizado->Get_Mensaje());
        $this->assertIsArray($this->Parto_Humanizado->Get_Datos());
        $this->assertIsArray($this->Parto_Humanizado->Get_Estado());
        $this->assertIsArray($this->Parto_Humanizado->Get_Estado_Ejecutar());
    }

    public function test_Administrar_Consultas_Registros_Vistas()
    {
        $this->Parto_Humanizado->vista = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Parto_Humanizado->vista->expects($this->once())->method('Cargar_Vistas')->with('Parto_Humanizado/consultar');
        $this->Parto_Humanizado->Administrar("Consultas");
        $this->Parto_Humanizado->vista->expects($this->once())->method('Cargar_Vistas')->with('Parto_Humanizado/registrar');
        $this->Parto_Humanizado->Administrar("Registros");
        $this->assertTrue(true);
    }

    public function test_Administrar_Registrar()
    {
        $this->Parto_Humanizado->modelo     = $this->getMockBuilder(Parto_Humanizado_Class::class)->disableOriginalConstructor()->getMock();
        $this->Parto_Humanizado->validacion = $this->getMockBuilder(Parto_Humanizado_Validacion::class)->disableOriginalConstructor()->getMock();
        $this->Parto_Humanizado->validacion->expects($this->once())->method('Validacion_Registro')->willReturn(true);
        $this->Parto_Humanizado->modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $this->Parto_Humanizado->Administrar("Registrar");
        $this->assertTrue(true);
    }

    public function test_Administrar_Consulta_Ajax()
    {
        $this->Parto_Humanizado->modelo = $this->getMockBuilder(Parto_Humanizado_Class::class)->disableOriginalConstructor()->getMock();
        $result                 = $this->Parto_Humanizado->Administrar("Consulta_Ajax");
        $this->expectOutputString($result);
    }

    public function test_Administrar_Editar()
    {
        $this->Parto_Humanizado->modelo     = $this->getMockBuilder(Parto_Humanizado_Class::class)->disableOriginalConstructor()->getMock();
        $this->Parto_Humanizado->validacion = $this->getMockBuilder(Parto_Humanizado_Validacion::class)->disableOriginalConstructor()->getMock();
        $this->Parto_Humanizado->validacion->expects($this->once())->method('Validacion_Registro')->willReturn(true);
        $this->Parto_Humanizado->modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $this->Parto_Humanizado->Administrar("Editar");
        $this->assertTrue(true);
    }

    public function test_Administrar_Eliminar()
    {
        $this->Parto_Humanizado->modelo = $this->getMockBuilder(Parto_Humanizado_Class::class)->disableOriginalConstructor()->getMock();
        $this->Parto_Humanizado->modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $this->Parto_Humanizado->Administrar("Eliminar");
        $this->assertTrue(true);
    }
    // =================================================================
}
