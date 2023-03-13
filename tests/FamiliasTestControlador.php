<?php

require_once "controlador/familias_controlador.php";
require_once "modelo/familias_class.php";

use PHPUnit\Framework\TestCase;

$_SESSION['cedula_usuario'] = "7654321";
$_SESSION['Familias']       = [
    "consultar" => 1,
    "registrar" => 1,
    "eliminar"  => 1,
    "modificar" => 1,
];
$_POST = [
    'estado' => [
        "tabla"  => "familias",
        "id"     => "id_familias",
        "data"   => 1,
        "estado" => 1,
    ],
    'datos'  => [
        'id_vivienda'           => 1,
        'condicion_ocupacion'   => 'propia',
        'nombre_familia'        => 'Familia García',
        'observacion'           => 'Sin observaciones',
        'telefono_familia'      => '04165551234',
        'ingreso_mensual_aprox' => "200",
        'estado'                => '1',
    ],
    'sql'    => 'SQL_1',
    'accion' => 'registro exitoso',
];

class FamiliasTestControlador extends TestCase
{
    private $Familias;

    protected function setUp(): void  {$this->Familias = new Familias();}

    protected function tearDown(): void  {$this->Familias = null;}

   public function test_Cargar_Vistas()
    {
        $this->Familias->vista = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Familias->vista->expects($this->once())->method('Cargar_Vistas')->with('Familias/consultar');
        $this->Familias->Cargar_Vistas();
        $this->assertTrue(true);
    }

    public function test_Establecer_Consultas()
    {
        $this->Familias->Establecer_Consultas();
        $this->assertNotEmpty($this->Familias->Get_Datos_Vista());
    }

    public function test_Getters()
    {
        $this->assertIsString($this->Familias->Get_Sql());
        $this->assertIsString($this->Familias->Get_Accion());
        $this->assertIsString($this->Familias->Get_Mensaje());
        $this->assertIsArray($this->Familias->Get_Datos());
        $this->assertIsArray($this->Familias->Get_Estado());
        $this->assertIsArray($this->Familias->Get_Estado_Ejecutar());
    }

    public function test_Administrar_Consultas_Registros_Vistas()
    {
        $this->Familias->vista = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Familias->vista->expects($this->once())->method('Cargar_Vistas')->with('Familias/consultar');
        $this->Familias->Administrar("Consultas");
        $this->Familias->vista->expects($this->once())->method('Cargar_Vistas')->with('Familias/registrar');
        $this->Familias->Administrar("Registros");
        $this->assertTrue(true);
    }

    public function test_Administrar_Registrar()
    {
        $this->Familias->modelo     = $this->getMockBuilder(Familias_Class::class)->disableOriginalConstructor()->getMock();
        $this->Familias->validacion = $this->getMockBuilder(Familias_Validacion::class)->disableOriginalConstructor()->getMock();
        $this->Familias->validacion->expects($this->once())->method('Validacion_Registro')->willReturn(true);
        $this->Familias->modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $this->Familias->Administrar("Registrar");
        $this->assertTrue(true);
    }

    public function test_Administrar_Consulta_Ajax()
    {
        $this->Familias->modelo = $this->getMockBuilder(Bitoacora_Class::class)->disableOriginalConstructor()->getMock();
        $result                  = $this->Bitoacora->Administrar("Consulta_Ajax");
        $this->expectOutputString($result);
    }

    public function test_Administrar_Editar()
    {
        $this->Familias->modelo     = $this->getMockBuilder(Familias_Class::class)->disableOriginalConstructor()->getMock();
        $this->Familias->validacion = $this->getMockBuilder(Familias_Validacion::class)->disableOriginalConstructor()->getMock();
        $this->Familias->validacion->expects($this->once())->method('Validacion_Registro')->willReturn(true);
        $this->Familias->modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $this->Familias->Administrar("Editar");
        $this->assertTrue(true);
    }

    public function test_Administrar_Eliminar()
    {
        $this->Familias->modelo     = $this->getMockBuilder(Familias_Class::class)->disableOriginalConstructor()->getMock();
        $this->Familias->modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $this->Familias->Administrar("Eliminar");
        $this->assertTrue(true);
    }
    // =================================================================
}
