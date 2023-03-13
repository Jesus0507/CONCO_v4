<?php

require_once "controlador/negocios_controlador.php";
require_once "modelo/negocios_class.php";

use PHPUnit\Framework\TestCase;

$_SESSION['cedula_usuario'] = "7654321";
$_SESSION['Negocios']       = [
    "consultar" => 1,
    "registrar" => 1,
    "eliminar"  => 1,
    "modificar" => 1,
];
$_POST = [
    'estado' => [
        "tabla"  => "negocios",
        "id"     => "id_negocios",
        "data"   => 1,
        "estado" => 1,
    ],
    'datos'  => [
        "id_calle"           => 1,
        "nombre_negocio"     => "LA GUADALUPE",
        "direccion_negocio"  => "CALLE 16 ENTRE 2 Y 3",
        "cedula_propietario" => "7654321",
        "rif_negocio"        => "J261423266",
        "estado"             => 1,
    ],
    'sql'    => 'SQL_1',
    'accion' => 'registro exitoso',
];

class NegociosTestControlador extends TestCase
{
    private $Negocios;

    protected function setUp(): void
    {
        $this->Negocios = new Negocios();
    }

    protected function tearDown(): void
    {$this->Negocios = null;}

    public function test_Cargar_Vistas()
    {
        $this->Negocios->vista = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Negocios->vista->expects($this->once())->method('Cargar_Vistas')->with('Negocios/consultar');
        $this->Negocios->Cargar_Vistas();
        $this->assertTrue(true);
    }

    public function test_Establecer_Consultas()
    {
        $this->Negocios->Establecer_Consultas();
        $this->assertNotEmpty($this->Negocios->Get_Datos_Vista());
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

    public function test_Administrar_Consultas_Registros_Vistas()
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
        $result                        = $this->Negocios->Administrar("Consulta_Ajax");
        $this->expectOutputString($result);
    }

    public function test_Administrar_Editar()
    {
        $this->Negocios->modelo     = $this->getMockBuilder(Negocios_Class::class)->disableOriginalConstructor()->getMock();
        $this->Negocios->validacion = $this->getMockBuilder(Negocios_Validacion::class)->disableOriginalConstructor()->getMock();
        $this->Negocios->validacion->expects($this->once())->method('Validacion_Registro')->willReturn(true);
        $this->Negocios->modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $this->Negocios->Administrar("Editar");
        $this->assertTrue(true);
    }

    public function test_Administrar_Eliminar()
    {
        $this->Negocios->modelo = $this->getMockBuilder(Negocios_Class::class)->disableOriginalConstructor()->getMock();
        $this->Negocios->modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $this->Negocios->Administrar("Eliminar");
        $this->assertTrue(true);
    }
    // =================================================================
}
