<?php

require_once "controlador/enfermos_controlador.php";
require_once "modelo/enfermos_class.php";

use PHPUnit\Framework\TestCase;

$_SESSION['cedula_usuario'] = "7654321";
$_SESSION['Enfermos']       = [
    "consultar" => 1,
    "registrar" => 1,
    "eliminar"  => 1,
    "modificar" => 1,
];
$_POST = [
    'estado' => [
        "tabla"  => "enfermos",
        "id"     => "id_enfermos",
        "data"   => 1,
        "estado" => 1,
    ],
    'datos'  => [
        'cedula_persona' => '7654321',
        'id_enfermedad'  => 1,
        'medicamentos'   => 'Paracetamol',
    ],
    'sql'    => 'SQL_1',
    'accion' => 'registro exitoso',
];

class EnfermosTestControlador extends TestCase
{
    private $Enfermos;

    protected function setUp(): void       {$this->Enfermos = new Enfermos();}

    protected function tearDown(): void    {$this->Enfermos = null;}

    public function test_Cargar_Vistas()
    {
        $this->Enfermos->vista = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Enfermos->vista->expects($this->once())->method('Cargar_Vistas')->with('Enfermos/consultar');
        $this->Enfermos->Cargar_Vistas();
        $this->assertTrue(true);
    }

    public function test_Establecer_Consultas()
    {
        $this->Enfermos->Establecer_Consultas();
        $this->assertNotEmpty($this->Enfermos->Get_Datos_Vista());
    }

    public function test_Getters()
    {
        $this->assertIsString($this->Enfermos->Get_Sql());
        $this->assertIsString($this->Enfermos->Get_Accion());
        $this->assertIsString($this->Enfermos->Get_Mensaje());
        $this->assertIsArray($this->Enfermos->Get_Datos());
        $this->assertIsArray($this->Enfermos->Get_Estado());
        $this->assertIsArray($this->Enfermos->Get_Estado_Ejecutar());
    }

    public function test_Administrar_Consultas_Registros_Vistas()
    {
        $this->Enfermos->vista = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Enfermos->vista->expects($this->once())->method('Cargar_Vistas')->with('Enfermos/consultar');
        $this->Enfermos->Administrar("Consultas");
        $this->Enfermos->vista->expects($this->once())->method('Cargar_Vistas')->with('Enfermos/registrar');
        $this->Enfermos->Administrar("Registros");
        $this->assertTrue(true);
    }

    public function test_Administrar_Registrar()
    {
        $this->Enfermos->modelo     = $this->getMockBuilder(Enfermos_Class::class)->disableOriginalConstructor()->getMock();
        $this->Enfermos->validacion = $this->getMockBuilder(Enfermos_Validacion::class)->disableOriginalConstructor()->getMock();
        $this->Enfermos->validacion->expects($this->once())->method('Validacion_Registro')->willReturn(true);
        $this->Enfermos->modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $this->Enfermos->Administrar("Registrar");
        $this->assertTrue(true);
    }

    public function test_Administrar_Consulta_Ajax()
    {
        $this->Enfermos->modelo = $this->getMockBuilder(Bitoacora_Class::class)->disableOriginalConstructor()->getMock();
        $result                        = $this->Bitoacora->Administrar("Consulta_Ajax");
        $this->expectOutputString($result);
    }

    public function test_Administrar_Editar()
    {
        $this->Enfermos->modelo     = $this->getMockBuilder(Enfermos_Class::class)->disableOriginalConstructor()->getMock();
        $this->Enfermos->validacion = $this->getMockBuilder(Enfermos_Validacion::class)->disableOriginalConstructor()->getMock();
        $this->Enfermos->validacion->expects($this->once())->method('Validacion_Registro')->willReturn(true);
        $this->Enfermos->modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $this->Enfermos->Administrar("Editar");
        $this->assertTrue(true);
    }

    public function test_Administrar_Eliminar()
    {
        $this->Enfermos->modelo = $this->getMockBuilder(Enfermos_Class::class)->disableOriginalConstructor()->getMock();
        $this->Enfermos->modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $this->Enfermos->Administrar("Eliminar");
        $this->assertTrue(true);
    }
    // =================================================================
}
