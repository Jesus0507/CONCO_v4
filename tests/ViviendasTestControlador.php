<?php

require_once "controlador/viviendas_controlador.php";
require_once "modelo/viviendas_class.php";

use PHPUnit\Framework\TestCase;

$_SESSION['cedula_usuario'] = "7654321";
$_SESSION['Viviendas']      = [
    "consultar" => 1,
    "registrar" => 1,
    "eliminar"  => 1,
    "modificar" => 1,
];
$_POST = [
    'estado' => [
        "tabla"  => "viviendas",
        "id"     => "id_viviendas",
        "data"   => 1,
        "estado" => 1,
    ],
    'datos'  => [
        'id_calle'              => 1,
        'id_tipo_vivienda'      => 2,
        'id_servicio'           => 3,
        'direccion_vivienda'    => 'Calle 17',
        'numero_casa'           => 4,
        'cantidad_habitaciones' => 3,
        'espacio_siembra'       => '1',
        'hacinamiento'          => '1',
        'banio_sanitario'       => '1',
        'condicion'             => 'Buena',
        'descripcion'           => 'Casa grande con jardín',
        'animales_domesticos'   => '0',
        'insectos_roedores'     => '0',
        'estado'                => '1',
    ],
    'sql'    => 'SQL_1',
    'accion' => '',
];

class ViviendasTestControlador extends TestCase
{
    private $Viviendas;

    protected function setUp(): void
    {$this->Viviendas = new Viviendas();}

    protected function tearDown(): void
    {$this->Viviendas = null;}

    public function test_Cargar_Vistas()
    {
        $this->Viviendas->vista = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Viviendas->vista->expects($this->once())->method('Cargar_Vistas')->with('Viviendas/consultar');
        $this->Viviendas->Cargar_Vistas();
        $this->assertTrue(true);
    }

    public function test_Establecer_Consultas()
    {
        $this->Viviendas->Establecer_Consultas();
        $this->assertNotEmpty($this->Viviendas->Get_Datos_Vista());
    }

    public function test_Getters()
    {
        $this->assertIsString($this->Viviendas->Get_Sql());
        $this->assertIsString($this->Viviendas->Get_Accion());
        $this->assertIsString($this->Viviendas->Get_Mensaje());
        $this->assertIsArray($this->Viviendas->Get_Datos());
        $this->assertIsArray($this->Viviendas->Get_Estado());
        $this->assertIsArray($this->Viviendas->Get_Estado_Ejecutar());
    }

    public function test_Administrar_Consultas_Registros_Vistas()
    {
        $this->Viviendas->vista = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Viviendas->vista->expects($this->once())->method('Cargar_Vistas')->with('Viviendas/consultar');
        $this->Viviendas->Administrar("Consultas");
        $this->Viviendas->vista->expects($this->once())->method('Cargar_Vistas')->with('Viviendas/registrar');
        $this->Viviendas->Administrar("Registros");
        $this->assertTrue(true);
    }

    public function test_Administrar_Registrar()
    {
        $this->Viviendas->modelo     = $this->getMockBuilder(Viviendas_Class::class)->disableOriginalConstructor()->getMock();
        $this->Viviendas->validacion = $this->getMockBuilder(Viviendas_Validacion::class)->disableOriginalConstructor()->getMock();
        $this->Viviendas->validacion->expects($this->once())->method('Validacion_Registro')->willReturn(true);
        $this->Viviendas->modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $this->Viviendas->Administrar("Registrar");
        $this->assertTrue(true);
    }

    public function test_Administrar_Consulta_Ajax()
    {
        $this->Viviendas->modelo = $this->getMockBuilder(Viviendas_Class::class)->disableOriginalConstructor()->getMock();
        $result                 = $this->Viviendas->Administrar("Consulta_Ajax");
        $this->expectOutputString($result);
    }

    public function test_Administrar_Editar()
    {
        $this->Viviendas->modelo     = $this->getMockBuilder(Viviendas_Class::class)->disableOriginalConstructor()->getMock();
        $this->Viviendas->validacion = $this->getMockBuilder(Viviendas_Validacion::class)->disableOriginalConstructor()->getMock();
        $this->Viviendas->validacion->expects($this->once())->method('Validacion_Registro')->willReturn(true);
        $this->Viviendas->modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $this->Viviendas->Administrar("Editar");
        $this->assertTrue(true);
    }

    public function test_Administrar_Eliminar()
    {
        $this->Viviendas->modelo = $this->getMockBuilder(Viviendas_Class::class)->disableOriginalConstructor()->getMock();
        $this->Viviendas->modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $this->Viviendas->Administrar("Eliminar");
        $this->assertTrue(true);
    }
    // =================================================================
}
