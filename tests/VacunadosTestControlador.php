<?php

require_once "controlador/vacunados_controlador.php";
require_once "modelo/vacunados_class.php";

use PHPUnit\Framework\TestCase;

$_SESSION['cedula_usuario'] = "7654321";
$_SESSION['Vacunados']      = [
    "consultar" => 1,
    "registrar" => 1,
    "eliminar"  => 1,
    "modificar" => 1,
];
$_POST = [
    'estado' => [
        "tabla"  => "vacunados",
        "id"     => "id_vacunados",
        "data"   => 1,
        "estado" => 1,
    ],
    'datos'  => [
        'cedula_persona' => "7654321",
        'dosis'          => "Primera dosis",
        'fecha_vacuna'   => '2022-01-01',
        'estado'         => '1',
    ],
    'sql'    => 'SQL_1',
    'accion' => 'registro exitoso',
];

class VacunadosTestControlador extends TestCase
{
   private $Vacunados;

    protected function setUp(): void
    {
        $this->Vacunados = new Vacunados();
    }

    protected function tearDown(): void
    {$this->Vacunados = null;}

   public function test_Cargar_Vistas()
    {
        $this->Vacunados->vista = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Vacunados->vista->expects($this->once())->method('Cargar_Vistas')->with('Vacunados/consultar');
        $this->Vacunados->Cargar_Vistas();
        $this->assertTrue(true);
    }

    public function test_Establecer_Consultas()
    {
        $this->Vacunados->Establecer_Consultas();
        $this->assertNotEmpty($this->Vacunados->Get_Datos_Vista());
    }

    public function test_Getters()
    {
        $this->assertIsString($this->Vacunados->Get_Sql());
        $this->assertIsString($this->Vacunados->Get_Accion());
        $this->assertIsString($this->Vacunados->Get_Mensaje());
        $this->assertIsArray($this->Vacunados->Get_Datos());
        $this->assertIsArray($this->Vacunados->Get_Estado());
        $this->assertIsArray($this->Vacunados->Get_Estado_Ejecutar());
    }

    public function test_Administrar_Consultas_Registros_Vistas()
    {
        $this->Vacunados->vista = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Vacunados->vista->expects($this->once())->method('Cargar_Vistas')->with('Vacunados/consultar');
        $this->Vacunados->Administrar("Consultas");
        $this->Vacunados->vista->expects($this->once())->method('Cargar_Vistas')->with('Vacunados/registrar');
        $this->Vacunados->Administrar("Registros");
        $this->assertTrue(true);
    }

    public function test_Administrar_Registrar()
    {
        $this->Vacunados->modelo     = $this->getMockBuilder(Vacunados_Class::class)->disableOriginalConstructor()->getMock();
        $this->Vacunados->validacion = $this->getMockBuilder(Vacunados_Validacion::class)->disableOriginalConstructor()->getMock();
        $this->Vacunados->validacion->expects($this->once())->method('Validacion_Registro')->willReturn(true);
        $this->Vacunados->modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $this->Vacunados->Administrar("Registrar");
        $this->assertTrue(true);
    }

    public function test_Administrar_Consulta_Ajax()
    {
        $this->Vacunados->modelo = $this->getMockBuilder(Vacunados_Class::class)->disableOriginalConstructor()->getMock();
        $result                        = $this->Vacunados->Administrar("Consulta_Ajax");
        $this->expectOutputString($result);
    }

    public function test_Administrar_Editar()
    {
        $this->Vacunados->modelo     = $this->getMockBuilder(Vacunados_Class::class)->disableOriginalConstructor()->getMock();
        $this->Vacunados->validacion = $this->getMockBuilder(Vacunados_Validacion::class)->disableOriginalConstructor()->getMock();
        $this->Vacunados->validacion->expects($this->once())->method('Validacion_Registro')->willReturn(true);
        $this->Vacunados->modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $this->Vacunados->Administrar("Editar");
        $this->assertTrue(true);
    }

    public function test_Administrar_Eliminar()
    {
        $this->Vacunados->modelo = $this->getMockBuilder(Vacunados_Class::class)->disableOriginalConstructor()->getMock();
        $this->Vacunados->modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $this->Vacunados->Administrar("Eliminar");
        $this->assertTrue(true);
    }
    
    // =================================================================
}
