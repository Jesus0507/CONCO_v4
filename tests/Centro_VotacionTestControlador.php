<?php

require_once "controlador/centro_votacion_controlador.php";
require_once "modelo/centro_votacion_class.php";

use PHPUnit\Framework\TestCase;

$_SESSION['cedula_usuario']  = "7654321";
$_SESSION['Centro_Votacion'] = [
    "consultar" => 1,
    "registrar" => 1,
    "eliminar"  => 1,
    "modificar" => 1,
];
$_POST = [
    'estado' => [
        "tabla"  => "centro_votacion",
        "id"     => "id_centro_votacion",
        "data"   => 1,
        "estado" => 1,
    ],
    'datos'  => [
        'id_centro_votacion' => 1,
        'cedula_votante'     => "7654321",
        'estado'             => 1,
    ],
    'sql'    => 'SQL_1',
    'accion' => 'registro exitoso',
];

class Centro_VotacionTestControlador extends TestCase
{
   
    private $Centro_Votacion;

    protected function setUp(): void{$this->Centro_Votacion = new Centro_Votacion();}

    protected function tearDown(): void{$this->Centro_Votacion = null;}

    // Centro_Votacion
    public function test_Cargar_Vistas()
    {
        $this->Centro_Votacion->vista = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Centro_Votacion->vista->expects($this->once())->method('Cargar_Vistas')->with('centro_votacion/consultar');
        $this->Centro_Votacion->Cargar_Vistas();
        $this->assertTrue(true);
    }

    public function test_Establecer_Consultas()
    {
        $this->Centro_Votacion->Establecer_Consultas();
        $this->assertNotEmpty($this->Centro_Votacion->Get_Datos_Vista());
    }

    public function test_Getters()
    {
        $this->assertIsString($this->Centro_Votacion->Get_Sql());
        $this->assertIsString($this->Centro_Votacion->Get_Accion());
        $this->assertIsString($this->Centro_Votacion->Get_Mensaje());
        $this->assertIsArray($this->Centro_Votacion->Get_Datos());
        $this->assertIsArray($this->Centro_Votacion->Get_Estado());
        $this->assertIsArray($this->Centro_Votacion->Get_Estado_Ejecutar());
    }

    public function test_Administrar_Consultas_Registros_Vistas()
    {
        $this->Centro_Votacion->vista = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Centro_Votacion->vista->expects($this->once())->method('Cargar_Vistas')->with('centro_votacion/consultar');
        $this->Centro_Votacion->Administrar("Consultas");
        $this->Centro_Votacion->vista->expects($this->once())->method('Cargar_Vistas')->with('centro_votacion/registrar');
        $this->Centro_Votacion->Administrar("Registros");
        $this->assertTrue(true);
    }

    public function test_Administrar_Registrar()
    {
        $this->Centro_Votacion->modelo     = $this->getMockBuilder(Centro_Votacion_Class::class)->disableOriginalConstructor()->getMock();
        $this->Centro_Votacion->validacion = $this->getMockBuilder(Centro_Votacion_Validacion::class)->disableOriginalConstructor()->getMock();
        $this->Centro_Votacion->validacion->expects($this->once())->method('Validacion_Registro')->willReturn(true);
        $this->Centro_Votacion->modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $this->Centro_Votacion->Administrar("Registrar");
        $this->assertTrue(true);
    }

    public function test_Administrar_Consulta_Ajax()
    {
        $this->Centro_Votacion->modelo = $this->getMockBuilder(Centro_Votacion_Class::class)->disableOriginalConstructor()->getMock();
        $result                  = $this->Centro_Votacion->Administrar("Consulta_Ajax");
        $this->expectOutputString($result);
    }

    public function test_Administrar_Editar()
    {
        $this->Centro_Votacion->modelo     = $this->getMockBuilder(Centro_Votacion_Class::class)->disableOriginalConstructor()->getMock();
        $this->Centro_Votacion->validacion = $this->getMockBuilder(Centro_Votacion_Validacion::class)->disableOriginalConstructor()->getMock();
        $this->Centro_Votacion->validacion->expects($this->once())->method('Validacion_Registro')->willReturn(true);
        $this->Centro_Votacion->modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $this->Centro_Votacion->Administrar("Editar");
        $this->assertTrue(true);
    }

    public function test_Administrar_Eliminar()
    {
        $this->Centro_Votacion->modelo     = $this->getMockBuilder(Centro_Votacion_Class::class)->disableOriginalConstructor()->getMock();
        $this->Centro_Votacion->modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $this->Centro_Votacion->Administrar("Eliminar");
        $this->assertTrue(true);
    }
    // =================================================================
}
