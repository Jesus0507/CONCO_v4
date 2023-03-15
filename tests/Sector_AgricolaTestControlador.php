<?php

require_once "controlador/sector_agricola_controlador.php";
require_once "modelo/sector_agricola_class.php";

use PHPUnit\Framework\TestCase;

$_SESSION['cedula_usuario']  = "7654321";
$_SESSION['Sector_Agricola'] = [
    "consultar" => 1,
    "registrar" => 1,
    "eliminar"  => 1,
    "modificar" => 1,
];
$_POST = [
    'estado' => [
        "tabla"  => "sector_agricola",
        "id"     => "id_sector_agricola",
        "data"   => 1,
        "estado" => 1,
    ],
    'datos'  => [
        'cedula_persona'       => '1234567890',
        'area_produccion'      => 'Campo abierto',
        'anios_experiencia'    => "5",
        'rubro_principal'      => 'Café',
        'rubro_alternativo'    => 'Cacao',
        'registro_INTI'        => "123456789",
        'constancia_productor' => "si",
        'senial_hierro'        => "si",
        'financiado'           => 'No',
        'agua_riego'           => "si",
        'produccion_actual'    => "tomate",
        'org_agricola'         => 'Asociación de Caficultores',
        'estado'               => 1,
    ],
    'sql'    => 'SQL_1',
    'accion' => 'registro exitoso',
];

class Sector_AgricolaTestControlador extends TestCase
{
    private $Sector_Agricola;

    protected function setUp(): void
    {
        $this->Sector_Agricola = new Sector_Agricola();
    }

    protected function tearDown(): void
    {$this->Sector_Agricola = null;}

    public function test_Cargar_Vistas()
    {
        $this->Sector_Agricola->vista = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Sector_Agricola->vista->expects($this->once())->method('Cargar_Vistas')->with('Sector_Agricola/consultar');
        $this->Sector_Agricola->Cargar_Vistas();
        $this->assertTrue(true);
    }

    public function test_Establecer_Consultas()
    {
        $this->Sector_Agricola->Establecer_Consultas();
        $this->assertNotEmpty($this->Sector_Agricola->Get_Datos_Vista());
    }

    public function test_Getters()
    {
        $this->assertIsString($this->Sector_Agricola->Get_Sql());
        $this->assertIsString($this->Sector_Agricola->Get_Accion());
        $this->assertIsString($this->Sector_Agricola->Get_Mensaje());
        $this->assertIsArray($this->Sector_Agricola->Get_Datos());
        $this->assertIsArray($this->Sector_Agricola->Get_Estado());
        $this->assertIsArray($this->Sector_Agricola->Get_Estado_Ejecutar());
    }

    public function test_Administrar_Consultas_Registros_Vistas()
    {
        $this->Sector_Agricola->vista = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Sector_Agricola->vista->expects($this->once())->method('Cargar_Vistas')->with('Sector_Agricola/consultar');
        $this->Sector_Agricola->Administrar("Consultas");
        $this->Sector_Agricola->vista->expects($this->once())->method('Cargar_Vistas')->with('Sector_Agricola/registrar');
        $this->Sector_Agricola->Administrar("Registros");
        $this->assertTrue(true);
    }

    public function test_Administrar_Registrar()
    {
        $this->Sector_Agricola->modelo     = $this->getMockBuilder(Sector_Agricola_Class::class)->disableOriginalConstructor()->getMock();
        $this->Sector_Agricola->validacion = $this->getMockBuilder(Sector_Agricola_Validacion::class)->disableOriginalConstructor()->getMock();
        $this->Sector_Agricola->validacion->expects($this->once())->method('Validacion_Registro')->willReturn(true);
        $this->Sector_Agricola->modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $this->Sector_Agricola->Administrar("Registrar");
        $this->assertTrue(true);
    }

    public function test_Administrar_Consulta_Ajax()
    {
        $this->Sector_Agricola->modelo = $this->getMockBuilder(Sector_Agricola_Class::class)->disableOriginalConstructor()->getMock();
        $result                        = $this->Sector_Agricola->Administrar("Consulta_Ajax");
        $this->expectOutputString($result);
    }

    public function test_Administrar_Editar()
    {
        $this->Sector_Agricola->modelo     = $this->getMockBuilder(Sector_Agricola_Class::class)->disableOriginalConstructor()->getMock();
        $this->Sector_Agricola->validacion = $this->getMockBuilder(Sector_Agricola_Validacion::class)->disableOriginalConstructor()->getMock();
        $this->Sector_Agricola->validacion->expects($this->once())->method('Validacion_Registro')->willReturn(true);
        $this->Sector_Agricola->modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $this->Sector_Agricola->Administrar("Editar");
        $this->assertTrue(true);
    }

    public function test_Administrar_Eliminar()
    {
        $this->Sector_Agricola->modelo = $this->getMockBuilder(Sector_Agricola_Class::class)->disableOriginalConstructor()->getMock();
        $this->Sector_Agricola->modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $this->Sector_Agricola->Administrar("Eliminar");
        $this->assertTrue(true);
    }
    // =================================================================
}
