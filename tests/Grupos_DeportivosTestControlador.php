<?php

require_once "controlador/grupos_deportivos_controlador.php";
require_once "modelo/grupos_deportivos_class.php";

use PHPUnit\Framework\TestCase;

$_SESSION['cedula_usuario']    = "7654321";
$_SESSION['Grupos_Deportivos'] = [
    "consultar" => 1,
    "registrar" => 1,
    "eliminar"  => 1,
    "modificar" => 1,
];
$_POST = [
    'estado' => [
        "tabla"  => "grupos_deportivos",
        "id"     => "id_grupos_deportivos",
        "data"   => 1,
        "estado" => 1,
    ],
    'datos'  => [
        'id_deporte'             => 1,
        'nombre_grupo_deportivo' => "BLUES",
        'descripcion'            => "EQUIPO DE FOOTBALL",
        'estado'                 => 1,
    ],
    'sql'    => 'SQL_1',
    'accion' => 'registro exitoso',
];

class Grupos_DeportivosTestControlador extends TestCase
{
    private $Grupos_Deportivos;

    protected function setUp(): void
    {$this->Grupos_Deportivos = new Grupos_Deportivos();}

    protected function tearDown(): void
    {$this->Grupos_Deportivos = null;}

     public function test_Cargar_Vistas()
    {
        $this->Grupos_Deportivos->vista = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Grupos_Deportivos->vista->expects($this->once())->method('Cargar_Vistas')->with('Grupos_Deportivos/consultar');
        $this->Grupos_Deportivos->Cargar_Vistas();
        $this->assertTrue(true);
    }

    public function test_Establecer_Consultas()
    {
        $this->Grupos_Deportivos->Establecer_Consultas();
        $this->assertNotEmpty($this->Grupos_Deportivos->Get_Datos_Vista());
    }

    public function test_Getters()
    {
        $this->assertIsString($this->Grupos_Deportivos->Get_Sql());
        $this->assertIsString($this->Grupos_Deportivos->Get_Accion());
        $this->assertIsString($this->Grupos_Deportivos->Get_Mensaje());
        $this->assertIsArray($this->Grupos_Deportivos->Get_Datos());
        $this->assertIsArray($this->Grupos_Deportivos->Get_Estado());
        $this->assertIsArray($this->Grupos_Deportivos->Get_Estado_Ejecutar());
    }

    public function test_Administrar_Consultas_Registros_Vistas()
    {
        $this->Grupos_Deportivos->vista = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Grupos_Deportivos->vista->expects($this->once())->method('Cargar_Vistas')->with('Grupos_Deportivos/consultar');
        $this->Grupos_Deportivos->Administrar("Consultas");
        $this->Grupos_Deportivos->vista->expects($this->once())->method('Cargar_Vistas')->with('Grupos_Deportivos/registrar');
        $this->Grupos_Deportivos->Administrar("Registros");
        $this->assertTrue(true);
    }

    public function test_Administrar_Registrar()
    {
        $this->Grupos_Deportivos->modelo     = $this->getMockBuilder(Grupos_Deportivos_Class::class)->disableOriginalConstructor()->getMock();
        $this->Grupos_Deportivos->validacion = $this->getMockBuilder(Grupos_Deportivos_Validacion::class)->disableOriginalConstructor()->getMock();
        $this->Grupos_Deportivos->validacion->expects($this->once())->method('Validacion_Registro')->willReturn(true);
        $this->Grupos_Deportivos->modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $this->Grupos_Deportivos->Administrar("Registrar");
        $this->assertTrue(true);
    }

    public function test_Administrar_Consulta_Ajax()
    {
        $this->Grupos_Deportivos->modelo = $this->getMockBuilder(Bitoacora_Class::class)->disableOriginalConstructor()->getMock();
        $result                  = $this->Bitoacora->Administrar("Consulta_Ajax");
        $this->expectOutputString($result);
    }

    public function test_Administrar_Editar()
    {
        $this->Grupos_Deportivos->modelo     = $this->getMockBuilder(Grupos_Deportivos_Class::class)->disableOriginalConstructor()->getMock();
        $this->Grupos_Deportivos->validacion = $this->getMockBuilder(Grupos_Deportivos_Validacion::class)->disableOriginalConstructor()->getMock();
        $this->Grupos_Deportivos->validacion->expects($this->once())->method('Validacion_Registro')->willReturn(true);
        $this->Grupos_Deportivos->modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $this->Grupos_Deportivos->Administrar("Editar");
        $this->assertTrue(true);
    }

    public function test_Administrar_Eliminar()
    {
        $this->Grupos_Deportivos->modelo     = $this->getMockBuilder(Grupos_Deportivos_Class::class)->disableOriginalConstructor()->getMock();
        $this->Grupos_Deportivos->modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $this->Grupos_Deportivos->Administrar("Eliminar");
        $this->assertTrue(true);
    }
    // =================================================================
}
