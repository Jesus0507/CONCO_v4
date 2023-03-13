<?php

require_once "controlador/consejo_comunal_controlador.php";
require_once "modelo/consejo_comunal_class.php";

use PHPUnit\Framework\TestCase;

$_SESSION['cedula_usuario']  = "7654321";
$_SESSION['Consejo_Comunal'] = [
    "consultar" => 1,
    "registrar" => 1,
    "eliminar"  => 1,
    "modificar" => 1,
];
$_POST = [
    'estado' => [
        "tabla"  => "consejo_comunal",
        "id"     => "id_consejo_comunal",
        "data"   => 1,
        "estado" => 1,
    ],
    'datos'  => [
        'id_comite'      => 1,
        'cedula_persona' => '7654321',
        'cargo_persona'  => 'Presidente',
        'fecha_ingreso'  => '2023-02-10',
        'fecha_salida'   => '2024-02-10',
    ],
    'sql'    => 'SQL_1',
    'accion' => 'registro exitoso',
];

class Consejo_ComunalTestControlador extends TestCase
{
    private $Consejo_Comunal;

    protected function setUp(): void
    {$this->Consejo_Comunal = new Consejo_Comunal();}

    protected function tearDown(): void
    {$this->Consejo_Comunal = null;}

    public function test_Cargar_Vistas()
    {
        $this->Consejo_Comunal->vista = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Consejo_Comunal->vista->expects($this->once())->method('Cargar_Vistas')->with('Consejo_Comunal/consultar');
        $this->Consejo_Comunal->Cargar_Vistas();
        $this->assertTrue(true);
    }

    public function test_Establecer_Consultas()
    {
        $this->Consejo_Comunal->Establecer_Consultas();
        $this->assertNotEmpty($this->Consejo_Comunal->Get_Datos_Vista());
    }

    public function test_Getters()
    {
        $this->assertIsString($this->Consejo_Comunal->Get_Sql());
        $this->assertIsString($this->Consejo_Comunal->Get_Accion());
        $this->assertIsString($this->Consejo_Comunal->Get_Mensaje());
        $this->assertIsArray($this->Consejo_Comunal->Get_Datos());
        $this->assertIsArray($this->Consejo_Comunal->Get_Estado());
        $this->assertIsArray($this->Consejo_Comunal->Get_Estado_Ejecutar());
    }

    public function test_Administrar_Consultas_Registros_Vistas()
    {
        $this->Consejo_Comunal->vista = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Consejo_Comunal->vista->expects($this->once())->method('Cargar_Vistas')->with('Consejo_Comunal/consultar');
        $this->Consejo_Comunal->Administrar("Consultas");
        $this->Consejo_Comunal->vista->expects($this->once())->method('Cargar_Vistas')->with('Consejo_Comunal/registrar');
        $this->Consejo_Comunal->Administrar("Registros");
        $this->assertTrue(true);
    }

    public function test_Administrar_Registrar()
    {
        $this->Consejo_Comunal->modelo     = $this->getMockBuilder(Consejo_Comunal_Class::class)->disableOriginalConstructor()->getMock();
        $this->Consejo_Comunal->validacion = $this->getMockBuilder(Consejo_Comunal_Validacion::class)->disableOriginalConstructor()->getMock();
        $this->Consejo_Comunal->validacion->expects($this->once())->method('Validacion_Registro')->willReturn(true);
        $this->Consejo_Comunal->modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $this->Consejo_Comunal->Administrar("Registrar");
        $this->assertTrue(true);
    }

    public function test_Administrar_Consulta_Ajax()
    {
        $this->Consejo_Comunal->modelo = $this->getMockBuilder(Bitoacora_Class::class)->disableOriginalConstructor()->getMock();
        $result                        = $this->Bitoacora->Administrar("Consulta_Ajax");
        $this->expectOutputString($result);
    }

    public function test_Administrar_Editar()
    {
        $this->Consejo_Comunal->modelo     = $this->getMockBuilder(Consejo_Comunal_Class::class)->disableOriginalConstructor()->getMock();
        $this->Consejo_Comunal->validacion = $this->getMockBuilder(Consejo_Comunal_Validacion::class)->disableOriginalConstructor()->getMock();
        $this->Consejo_Comunal->validacion->expects($this->once())->method('Validacion_Registro')->willReturn(true);
        $this->Consejo_Comunal->modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $this->Consejo_Comunal->Administrar("Editar");
        $this->assertTrue(true);
    }

    public function test_Administrar_Eliminar()
    {
        $this->Consejo_Comunal->modelo = $this->getMockBuilder(Consejo_Comunal_Class::class)->disableOriginalConstructor()->getMock();
        $this->Consejo_Comunal->modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $this->Consejo_Comunal->Administrar("Eliminar");
        $this->assertTrue(true);
    }
    // =================================================================
}
