<?php

require_once "controlador/inmuebles_controlador.php";
require_once "modelo/inmuebles_class.php";

use PHPUnit\Framework\TestCase;

$_SESSION['cedula_usuario'] = "7654321";
$_SESSION['Inmuebles']      = [
    "consultar" => 1,
    "registrar" => 1,
    "eliminar"  => 1,
    "modificar" => 1,
];
$_POST = [
    'estado' => [
        "tabla"  => "inmuebles",
        "id"     => "id_inmuebles",
        "data"   => 1,
        "estado" => 1,
    ],
    'datos'  => [
        'id_calle'           => 1,
        'nombre_inmueble'    => 'Cancha',
        'direccion_inmueble' => 'Calle Principal #456',
        'id_tipo_inmueble'   => 2,
        'estado'             => '1',
    ],
    'sql'    => 'SQL_1',
    'accion' => 'registro exitoso',
];

class InmueblesTestControlador extends TestCase
{
    private $Inmuebles;

    protected function setUp(): void     {$this->Inmuebles = new Inmuebles();}

    protected function tearDown(): void  {$this->Inmuebles = null;}

    
    public function test_Cargar_Vistas()
    {
        $this->Inmuebles->vista = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Inmuebles->vista->expects($this->once())->method('Cargar_Vistas')->with('Inmuebles/consultar');
        $this->Inmuebles->Cargar_Vistas();
        $this->assertTrue(true);
    }

    public function test_Establecer_Consultas()
    {
        $this->Inmuebles->Establecer_Consultas();
        $this->assertNotEmpty($this->Inmuebles->Get_Datos_Vista());
    }

    public function test_Getters()
    {
        $this->assertIsString($this->Inmuebles->Get_Sql());
        $this->assertIsString($this->Inmuebles->Get_Accion());
        $this->assertIsString($this->Inmuebles->Get_Mensaje());
        $this->assertIsArray($this->Inmuebles->Get_Datos());
        $this->assertIsArray($this->Inmuebles->Get_Estado());
        $this->assertIsArray($this->Inmuebles->Get_Estado_Ejecutar());
    }

    public function test_Administrar_Consultas_Registros_Vistas()
    {
        $this->Inmuebles->vista = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Inmuebles->vista->expects($this->once())->method('Cargar_Vistas')->with('Inmuebles/consultar');
        $this->Inmuebles->Administrar("Consultas");
        $this->Inmuebles->vista->expects($this->once())->method('Cargar_Vistas')->with('Inmuebles/registrar');
        $this->Inmuebles->Administrar("Registros");
        $this->assertTrue(true);
    }

    public function test_Administrar_Registrar()
    {
        $this->Inmuebles->modelo     = $this->getMockBuilder(Inmuebles_Class::class)->disableOriginalConstructor()->getMock();
        $this->Inmuebles->validacion = $this->getMockBuilder(Inmuebles_Validacion::class)->disableOriginalConstructor()->getMock();
        $this->Inmuebles->validacion->expects($this->once())->method('Validacion_Registro')->willReturn(true);
        $this->Inmuebles->modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $this->Inmuebles->Administrar("Registrar");
        $this->assertTrue(true);
    }

    public function test_Administrar_Consulta_Ajax()
    {
        $this->Inmuebles->modelo = $this->getMockBuilder(Bitoacora_Class::class)->disableOriginalConstructor()->getMock();
        $result                  = $this->Bitoacora->Administrar("Consulta_Ajax");
        $this->expectOutputString($result);
    }

    public function test_Administrar_Editar()
    {
        $this->Inmuebles->modelo     = $this->getMockBuilder(Inmuebles_Class::class)->disableOriginalConstructor()->getMock();
        $this->Inmuebles->validacion = $this->getMockBuilder(Inmuebles_Validacion::class)->disableOriginalConstructor()->getMock();
        $this->Inmuebles->validacion->expects($this->once())->method('Validacion_Registro')->willReturn(true);
        $this->Inmuebles->modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $this->Inmuebles->Administrar("Editar");
        $this->assertTrue(true);
    }

    public function test_Administrar_Eliminar()
    {
        $this->Inmuebles->modelo     = $this->getMockBuilder(Inmuebles_Class::class)->disableOriginalConstructor()->getMock();
        $this->Inmuebles->modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $this->Inmuebles->Administrar("Eliminar");
        $this->assertTrue(true);
    }
    // =================================================================
}
